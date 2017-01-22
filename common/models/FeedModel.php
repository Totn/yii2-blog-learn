<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%feeds}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 * @property integer $created_at
 */
class FeedModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feeds}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'content', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => Yii::t('common', '用户ID'),
            'content' => Yii::t('common', '内容'),
            'created_at' => Yii::t('common', '创建时间'),
        ];
    }

    /**
     * 关联USER表
     * @return [type] [description]
     */
    public function getUser()
    {
        return $this->hasOne(UserModel::className(), ['id' => 'user_id']);
    }
}
