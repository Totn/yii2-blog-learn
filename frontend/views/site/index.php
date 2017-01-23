<?php

// 要添加的组件 banne, chat
use frontend\widgets\banner\BannerWidget;
use yii\base\Widget;
use frontend\widgets\chat\ChatWidget;
use frontend\widgets\post\PostWidget;
use frontend\widgets\hot\HotWidget;

$this->title = 'BLOG-INDEX';
?>
<div class="row">
    <div class="col-lg-9">
        <!-- 图片轮播 -->
        <?=BannerWidget::widget()?>
        <!-- 文章列表 -->
        <?=PostWidget::widget()?>
    </div>
    <div class="col-lg-3">
        <!-- 留言板 -->
        <?=ChatWidget::widget()?>
        <!-- 热门浏览 -->
        <?=HotWidget::widget()?>
    </div>
</div>
