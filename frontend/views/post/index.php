<?php
use frontend\widgets\post\PostWidget;
use yii\base\Widget;
use frontend\widgets\hot\HotWidget;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-lg-9">
        <?=PostWidget::widget()?>
    </div>
    <div class="col-lg-3">
        <?=HotWidget::widget(['title' => '热门之选'])?>

        <?php if (!\Yii::$app->user->isGuest):?>
        <div class="panel">
            <a class="btn btn-success btn-block btn-post" href="<?=Url::to(['post/create'])?>">添加新文章</a>
        </div>
        <?php endif;?>
    </div>
</div>