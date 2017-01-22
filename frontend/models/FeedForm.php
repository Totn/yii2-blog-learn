<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\FeedModel;

/**
 * 留言板模型
 */
class FeedForm extends Model
{
    // 表单需要接收数据
    public $content;

    // 错误记录
    public $_lastError;

    /**
     * 表单规则
     * @return  array
     */
    public function rules()
    {
        return [
            ['content', 'required'],
            ['content', 'string', 'max' => '255'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => Yii::t('common', '内容'),
        ];
    }

    /**
     * 获取留言记录
     * 10条， 倒序
     * @return [type] [description]
     */
    public function getList()
    {
        $Model = new FeedModel;

        $list = $Model->find()
            ->with('user')
            ->limit(10)
            ->orderBy(['id' => SORT_DESC])
            ->asArray()
            ->all();

        return $list ?: [];

    }
}