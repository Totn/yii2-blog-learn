<?php
namespace frontend\widgets\banner;

use Yii;
use yii\bootstrap\Widget;

/**
 *  图片轮播组件
 */
class BannerWidget extends Widget
{
    
    public $items = [];

    public function init()
    {
        $this->items = [
            [
                'label'     => 'demo',
                'image_url' => '/static/images/banner/b_0.jpg',
                'url'       => ['site/index'],
                'active'    => true,
                'html'      => '有趣的人',
            ],
            [
                'label'     => 'demp',
                'image_url' => '/static/images/banner/b_1.jpg',
                'url'       => ['site/index'],
                'active'    => false,
                'html'      => '有意思的人生',
            ],
            [
                'label'     => 'demq',
                'image_url' => '/static/images/banner/b_2.jpg',
                'url'       => ['site/index'],
                'active'    => false,
                'html'      => '还有什么呢？',
            ],
        ];
    }

    public function run()
    {
        $data['items'] = $this->items;
        return $this->render('index', ['data' => $data]);
    }
}

