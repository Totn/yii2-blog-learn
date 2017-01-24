<?php
use yii\helpers\Url;
?>

<div class="panel-title box-title">
    <span><strong><?=$data['title']?></strong></span>
</div>
<div class="panel-body padding-left-0">
    <?php foreach ($data['body'] as $list):?>
    <div class="tag-cloud"><a href="<?=Url::to(['post/index', 'tag' => $list['tag_name']]) ?>"><?=$list['tag_name']?></a></div>
    <?php endforeach; ?>
</div>