<?php
namespace frontend\widgets\post;

use Yii;
use yii\base\Widget;
use common\models\PostsModel;
use frontend\models\PostForm;
use yii\helpers\Url;
use yii\data\Pagination;

/**
 * 文章组件
 */
class PostWidget extends Widget
{
    /**
     * 文件列表的标题
     * @var string
     */
    public $title = '';

    /**
     * 显示条数
     * @var integer
     */
    public $limit = 6;

    /**
     * 是否显示更多
     * @var boolean
     */
    public $more = true;

    /**
     * 是否显示分页
     * @var boolean
     */
    public $page = false;

    public function run()
    {
        $curPage = Yii::$app->request->get('page', 1);
        // 查询条件
        $cond = ['=', 'is_valid', PostsModel::IS_VALID];

        // 根据条件，当前页数取值
        //返回
        $list = PostForm::getList($cond, $curPage, $this->limit);

        // 返回结果
        $result['title'] = $this->title ?: '最新文章';
        $result = [
            'title' => $this->title ?: '最新文章',
            'more'  => Url::to('post/index'),
            'body'  => $list['data'] ?: [],
        ];

        // 显示分页
        if ($this->page) {
            $pages = new Pagination(['totalCount' => $list['count'], 'pageSize' => $list['pageSize']]);
            $result['page'] = $pages;
        }
        return $this->render('index', ['data' => $result]);
    }
}