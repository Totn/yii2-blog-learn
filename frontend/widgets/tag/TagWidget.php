<?php
namespace frontend\widgets\tag;
use yii\bootstrap\Widget;
use common\models\TagsModel;
use Yii;

/**
 * 标签云组件 
 */
class TagWidget extends Widget
{
	public $title = '';

	public $limit = 6;

    public function run()
    {
        // 取出标签数据
    	$res = TagsModel::find()
    		->orderBy(['post_num' => SORT_DESC])
    		->limit($this->limit)
    		->all();
    	$data['title'] = $this->title ?: '标签云';
    	$data['body'] = $res ?: [];

        return $this->render('tag', ['data' => $data]);
    }
}