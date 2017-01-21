<?php

// 要添加的组件 banne, chat
use frontend\widgets\banner\BannerWidget;
use yii\base\Widget;
use frontend\widgets\chat\ChatWidget;
use frontend\widgets\post\PostWidget;

$this->title = 'BLOG-INDEX';
?>
<div class="row">
    <div class="col-lg-9"><?=BannerWidget::widget()?></div>
    <div class="col-lg-3">You Are A Dreamer !</div>
    <div class="col-lg-9"><?=PostWidget::widget()?></div>
</div>
