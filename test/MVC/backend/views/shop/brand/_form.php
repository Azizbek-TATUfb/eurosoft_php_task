<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\entities\Shop\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card card-default">
        <div class="card-header"><?=Yii::t('app','Common')?></div>
        <div class="card-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-header"><?=Yii::t('app','SEO')?></div>
        <div class="card-body">
            <?= $form->field($model->meta, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>

            <?= $form->field($model->meta, 'keywords')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
