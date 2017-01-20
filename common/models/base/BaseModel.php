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
            $query = $query->andFilerWhere($search);
        }
        $data['count'] = $query->count();

        if (!$data['count']) {
            return [
                'count'    => 0,
                'curPage'  => $curPage,
                'pageSize' => $pageSize,
                'start'    => 0,
                'end'      => 0,
                'data'     => []
            ];
        }

        // 处理分页数据
        $max_page = ceil($data['count']/$pageSize);
        // 最小为1 ，最大max_page的限制
        $curPage  = min($max_page, max(1, $curPage));
        $data += [
            'curPage'  => $curPage,
            'pageSize' => $pageSize,
            'start'    => ($curPage - 1) * $pageSize + 1,
            // 可能不足一页
            'end'      => $max_page == $curPage 
                ? $data['count'] : $curPage * $pageSize,
            'data'     => $query->offset(($curPage - 1) * $pageSize)
                ->limit($pageSize)
                ->asArray()
                ->all(),
        ];

        return $data;

    }

}