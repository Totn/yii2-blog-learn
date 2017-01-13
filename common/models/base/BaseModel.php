<?php 
namespace common\models\base;

/**
* 基础模型
*/
use Yii;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{


    public function getPages($query, $curPage = 1, $pageSize = 10, $search = null)
    {
        // 如果有搜索条件
        if ($search) {

        }
    }

}