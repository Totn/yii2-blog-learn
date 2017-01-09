<?php
namespace frontend\models;
use yii\base\Model;
use common\models\TagsModel;

/**
* 标签表单模型
*/
class TagForm extends Model
{
    
    // 模型属性
    public $id;
    public $tags;

    // 模型规则
    public function rules()
    {
        return [
            ['tags', 'required'],
            ['tags', 'each', 'rule' => ['string']],
        ];
    }

    /**
     * 保存标签合集
     * @return [type] [description]
     */
    public function saveTags()
    {
        $ids = [];
        if (!empty($this->tags)) {
            foreach ($this->tags as $tag) {
                $ids[] = $this->_saveTag($tag);
            }
        }

        return $ids;
    }

    /**
     * 保存单个标签
     * @param  [type] $tag [description]
     * @return [type]      [description]
     */
    private function _saveTag($tag)
    {
        $TagM = new TagsModel();
        // 查找id对应的Tag
        $one = $TagM->find()->where(['tag_name' => $tag])->one();

        if (!$one) {
            // 无则插入
            $TagM->tag_name = $tag;
            $TagM->post_num = 1;
            if (!$TagM->save()) {
                throw new Exception("新增标签失败！", 1);
            }
            return $TagM->id;
        } else {
            // 原有基础上加1
            $one->updateCounters(['post_num' => 1]);
        }

        return $one->id;
    }
}