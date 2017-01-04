<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

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
}