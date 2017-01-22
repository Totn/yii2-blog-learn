<?php
namespace frontend\widgets\chat;

use Yii;
use yii\bootstrap\Widget;
use yii\base\Object;
use frontend\models\FeedForm;

/**
 * 留言板组件
 */
class ChatWidget extends Widget
{
    

    public function run()
    {
        $Feed = new FeedForm;
        $data['feed'] = $Feed->getList();
        return $this->render('index', ['data' => $data]);
    }
}