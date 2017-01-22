<?php

// 要添加的组件 banne, chat
use frontend\widgets\banner\BannerWidget;
use yii\base\Widget;
use frontend\widgets\chat\ChatWidget;
use frontend\widgets\post\PostWidget;

$this->title = 'BLOG-INDEX';
?>
<div class="row">
    <div class="col-lg-9">
        <?=BannerWidget::widget()?>
        <?=PostWidget::widget()?>
    </div>
    <div class="col-lg-3"><?=ChatWidget::widget()?></div>
</div>
