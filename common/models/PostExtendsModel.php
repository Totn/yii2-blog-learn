<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "{{%post_extends}}".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $browser
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class PostExtendsModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_extends}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => Yii::t('common', '自增ID'),
            'post_id' => Yii::t('common', '文章id'),
            'browser' => Yii::t('common', '浏览量'),
            'collect' => Yii::t('common', '收藏量'),
            'praise'  => Yii::t('common', '点赞'),
            'comment' => Yii::t('common', '评论'),
        ];
    }

    /**
     * 更新文章浏览量 - 统计
     * @param  array  $cond      查找条件/属性
     * @param  string $attribute 要更新的属性
     * @param  integer $num      变更的值
     * @return [type]            [description]
     */
    public function upCounter($cond, $attribute, $num = 1)
    {
        // 查找对应记录
        $counter = $this->findOne($cond);

        // 无记录则新增
        if (!$counter) {
            // 设置模型属性
            $this->setAttributes($cond);
            $this->$attribute = $num;
            if (!$this->save()) {
                throw new \Exception("新增文章浏览记录失败");
            }

        // 更新
        } else {
            // 要更新的字段
            $countData[$attribute] = $num;
            $counter->updateCounters($countData);
        }

        return;
    }
}
