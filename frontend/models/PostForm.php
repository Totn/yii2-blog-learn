<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\PostsModel;
use common\models\RelationPostTagsModel;
use yii\db\Query;
use yii\web\NotFoundHttpException;

/**
* 文章表单模型
*/
class PostForm extends Model
{

    public $id;
    public $title;
    public $content;
    public $label_img;
    public $cat_id;
    public $tags;

    public $_lastError = "";

    /**
     * 定义场景
     * SCENARIOS_CREATE 创建
     * SCENARIOS_CREATE 更新
     */
    const SCENARIOS_CREATE = 'create';
    const SCENARIOS_UPDATE = 'update';

    /**
     * 定义事件
     */
    const EVENT_AFTER_CREATE = 'eventAfterCreate';
    const EVENT_AFTER_UPDATE = 'eventAfterUpdate';

    public function rules()
    {
        return [
            [['id', 'title', 'content', 'cat_id'], 'required'],
            [['id', 'cat_id'], 'integer'],
            ['title', 'string', 'min'=>4, 'max'=>50]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'      => Yii::t('post', 'ID'),
            'title'   => Yii::t('post', 'Title'),
            'content' => Yii::t('post', 'Content' ),
            'label_img' => yii::t('post', 'Label Img'),
            'cat_id'  => Yii::t('post', 'Cate ID'),
            'tags'    => Yii::t('post', 'Tags'),
        ];
    }

    public function scenarios()
    {
        $scenarios = [
            self::SCENARIOS_CREATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
            self::SCENARIOS_UPDATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
        ];
        return array_merge(parent::scenarios(), $scenarios);
    }

    /**
     * 文章创建
     * @return [type] [description]
     */
    public function create()
    {
        // 事务
        $transaction = Yii::$app->db->beginTransaction();

        try {
            // 写入数据
            $model = new PostsModel();
            $model->setAttributes($this->attributes);
            $model->summary = $this->_getSummary();

            // 登陆之后才有Yii::$app->user, 需要先判断是否已登陆
            $model->user_id    = Yii::$app->user->identity->id;
            $model->user_name  = Yii::$app->user->identity->username;
            $model->is_valid   = PostsModel::IS_VALID;
            $model->created_at = time();
            $model->updated_at = time();

            if (!$model->save()) {
                throw new \Exception("文章保存失败", 1);  
            }

            $this->id = $model->id;
            // 调用事件，以免方法或文件过长
            $data = array_merge($this->getAttributes(), $model->getAttributes());
            $this->_eventAfterCreate($data);

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            // 回滚
            $transaction->rollBack();

            $this->_lastError = $e->getMessage();

            return false;
            // 记录错误日志
        }
    }

    public function getViewById($id)
    {
        // 需要取出关联标签数据
        // 两层关系 relate：关联的标签ID ==> 标签数据
        // 自动调用 getRelate与getTag
        // 添加与extend的关系
        $res = PostsModel::find()->with(['relate.tag', 'extend'])
        ->where(['id' => $id])->asArray()->one();

        if (!$res) {
            throw new NotFoundHttpException("文章不存在");
        }
        $res['tags'] = [];
        if (isset($res['relate']) && !empty($res['relate'])) {
            # code...
            foreach ($res['relate'] as $val) {
                $res['tags'][] = $val['tag']['tag_name'];
            }

        }
        unset($res['relate']);
        return $res;
    }

    /**
     *  截取文章简介
     * @param  integer $start [description]
     * @param  integer $end   [description]
     * @param  string  $char  [description]
     * @return [type]         [description]
     */
    public function _getSummary($start = 0, $end = 90, $char = 'utf-8')
    {
        if (empty($this->content)) {
            return '';
        }
        $content = strip_tags($this->content);
        $content = str_replace('&nbsp;', ' ', $content);

        return mb_substr($content, $start, $end, $char);
    }

    /**
     * 创建完成后事件
     * @return [type] [description]
     */
    public function _eventAfterCreate($data)
    {
        // $this->on(name, handle);
        // 添加事件
        $this->on(self::EVENT_AFTER_CREATE, [$this, '_eventAddTag'], $data);
        // $this->on(self::EVENT_AFTER_CREATE, [$this, '_eventAddOne'], $data);

        // 触发事件
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    /**
     * 添加标签
     * @param  array $event  事件的数据
     * @return [type]        [description]
     */
    public function _eventAddTag($event)
    {
        $TagFM = new TagForm();
        $TagFM->tags = $event->data['tags'];

        // 判断标签有没有存在
        $tagids = $TagFM->saveTags();

        // 删除原来的关联，再保存新的
        RelationPostTagsModel::deleteAll(['post_id' => $event->data['id']]);

        // 批量保存文章和标签的关系
        if (!empty($tagids)) {
            
            foreach ($tagids as $k => $id) {
                $rows[$k]['post_id'] = $this->id;
                $rows[$k]['tag_id'] = $id;
            }

            // 批量插入
            $res = (new Query())->createCommand()
            // ('table_name', ['volumn'], [data])
            ->batchInsert(RelationPostTagsModel::tableName(), ['post_id', 'tag_id'], $rows)
            ->execute();

            if (!$res) {
                throw new \Exception("保存文章与标签失败", 1);
            }
        }

    }
}