<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<div class="panel">
    <div class="panel-title box-title">
        <span><?=$data['title']?></span>
        <?php if ($this->context->more):?>
        <span class="pull-right"><a href="<?=$data['more']?>" class="font-12">更多»</a></span>
        <?php endif; ?>
        <span></span>
    </div>
    <div class="new-list">
    <!-- 列表Foreach -->
    <?php foreach ($data['body'] as $list):?>
        <div class="panel-body border-bottom">
            <?php // 显示图片 ?>
            <div class="row">
                <div class="col-lg-4 label-img-size">
                <a href="" class="post-label">
                    <img src="<?=$list['label_img'] ? \Yii::$app->params['upload_url'] . $list['label_img'] : \Yii::$app->params['default_label_img'] ;?>" alt="<?= $list['title'] ?>">
                </a>
                </div>
                <?php // <!-- 显示标题 -->  ?>
                <div class="col-lg-8 btn-group">
                    <h1><a href="<?=Url::to(['post/detail', 'id' => $list['id']])?>"><?=$list['title']?></a></h1>
                    <span class="post-tags">
                        <span class="glyphicon glyphicon-user"></span>
                        <a href="<?=Url::to(['member/index', 'id'=>$list['user_id']]);?>"><?=$list['user_name']?></a>&nbsp;
                        <span class="glyphicon glyphicon-time"></span>
                        <?=date('Y-m-d', $list['created_at'])?>&nbsp;
                        <span class="glyphincon glyphincon-eye-open"></span>
                        <?=isset($list['extend']['browser'])?$list['extend']['browser']:0?>&nbsp;
                        <span class="glyphicon glyphicon-comment"></span>
                        <a href="<?=Url::to(['post/index', 'id' => $list['id']])?>"><?=isset($list['extend']['comment'])?isset($list['extend']['comment']):0?></a>
                    </span>
                    <?php // <!-- 显示summary -->  ?>
                    <p class="post-content"><?=$list['summary']?></p>
                    <a href="<?=Url::to(['post/view', 'id' => $list['id']])?>"><button class="btn btn-warning no-radius btn-sm pull-right">阅读全文</button></a>
                </div>
            </div>
            <!-- Tags -->
            <div class="tags">
                <?php if (!empty($list['tags'])):?>
                <span class="fa fa-tags"></span>
                    <?php foreach ($list['tags'] as $tag): ?>
                    <a href="#"><?=$tag?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach;?>
    </div>
    <?php if ($this->context->page):?>
    <div class="page"><?=LinkPager::widgets(['pagination=' => $data['page']]);?></div>
    <?php endif; ?>
</div>