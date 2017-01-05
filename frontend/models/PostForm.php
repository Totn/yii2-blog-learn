<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\PostsModel;

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
            $model->user_id = Yii::$app->user->identity->id;
            $model->user_name = Yii::$app->user->identity->username;
            $model->is_valid = PostsModel::IS_VALID;
            $model->created_at = time();
            $model->updated_at = time();

            if (!$model->save()) {
                throw new \Exception("文章保存失败", 1);  
            }

            $this->id = $model->id;
            // 调用事件，以免文件过长
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
     * @param  array $data   
     * @return [type]        [description]
     */
    public function _eventAddTag($data)
    {
        # code...
    }
}