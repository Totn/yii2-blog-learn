<?php
namespace frontend\widgets\hot;

use yii\bootstrap\Widget;
use yii\db\Query;

use common\models\PostsModel;
use common\models\PostExtendsModel;

/**
 * 热门浏览组件
 * 按浏览量返回数据
 */
class HotWidget extends Widget
{
    // 组件标题
    public $title = '';

    // 显示条数
    public $limit = 6;

    public function run()
    {
        $res = (new Query())
            ->select(['e.browser', 'p.id', 'p.title'])
            ->from(['e' => PostExtendsModel::tableName()])
            ->join('LEFT JOIN', ['p' => PostsModel::tableName()], 'e.post_id = p.id')
            ->where('p.is_valid = ' . PostsModel::IS_VALID)
            ->orderBy(['e.browser' => SORT_DESC, 'p.id' => SORT_DESC])
            ->limit($this->limit)
            ->all();

        $result = [
            'title' => $this->title ?: '热门浏览',
            'body' => $res ?: [],
        ];
        return $this->render('hot', ['data' => $result]);
    }
}