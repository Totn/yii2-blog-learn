<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "创建";
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-9">
        <div class="panel-title box-title">
            <span><?= $this->title ?>文章</span>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin() ?>            

            <?= $form->field($model, 'title')->textinput(['maxlength' => true]) ?>

            <?= $form->field($model, 'cat_id')->dropDownList($cats) ?>

            <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload', [
                'config' => ['domain_url' => 'http://blog.dev'],
            ]) ?>

            <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor', [
                'options' => [

                    // 'initialFrameWidth' => 850
                    'initialFrameHeight' => 400,
                    // 'toolbars' => [],
                ],
            ]) ?>

            <?= $form->field($model, 'tags')->widget('common\widgets\tags\TagWidget') ?>

            <div class="form-group">
                <?= Html::submitButton("发布", ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel-title box-title">
            <span>注意事项</span>

        </div>
        <div class="panel-body">
            <p>1. 枯藤老树昏鸦</p>
            <p>2. 小桥流水人家</p>
        </div>

    </div>
</div>