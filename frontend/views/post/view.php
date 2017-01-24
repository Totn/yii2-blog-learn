<?php
use yii\helpers\Url;

$this->title = $data['title'] ?: '查看文章';
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-9">
        <div class="page-title">
            <h1><?=$data['title']?></h1>
            <span>作者：<?=$data['user_name']?></span>
            <span>发布：<?=date('Y-m-d', $data['created_at'])?></span>
            <span>浏览：<?=isset($data['extend']['browser'])?$data['extend']['browser']:0 ?> 次</span>
        </div>
        <?=$data['content']?>
        <div class="page-tag">
            标签：
            <?php foreach ($data['tags'] as $tag):?>
                <span><a href="#"><?=$tag?></a></span>
            <?php endforeach;?>
        </div>
    </div>
    <div class="col-lg-3">
        <?php if(!\Yii::$app->user->isGuest):?>
        <!-- 编辑与创建 -->
        <div class="panel">
            <a class="btn btn-success btn-block btn-post" href="<?=Url::to(['post/create'])?>">添加新文章</a>
            <?php if(\Yii::$app->user->identity->id == $data['user_id']):?>
            <a class="btn btn-primary btn-block btn-post" href="<?=Url::to(['post/edit', 'id' => $data['id']])?>">编辑本文</a>
            <?php endif;?>
        </div>
        <?php endif;?>
    </div>
</div>