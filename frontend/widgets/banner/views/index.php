<?php
use yii\helpers\Url;
?>
<div class="panel">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php foreach($data['items'] as $k=>$item):?>
            <li data-target="#myCarousel" data-slide-to="<?=$k?>" <?=(!empty($item['active']))?'class="active"':''?>></li>
            <?php endforeach;?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php foreach($data['items'] as $k=>$item):?>
            <div class="item<?=(!empty($item['active']))?' active':''?>">
                <a href="<?=Url::to($item['url'])?>">
                    <img src="<?=$item['image_url']?>" alt="<?=$item['label']?>">
                </a>
                <div class="carousel-caption"><?=$item['html']?></div>
            </div>
            <?php endforeach;?>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only"><<</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">>></span>
        </a>
    </div>
</div>