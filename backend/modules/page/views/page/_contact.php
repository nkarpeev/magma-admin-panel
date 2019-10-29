<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $editModel backend\components\IContent */
/* @var $model backend\modules\page\models\Page */
/* @var $uploadModel backend\models\UploadModel */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\tinymce\TinyMce;

?>
<?php $form = ActiveForm::begin() ?>
<div class="page-form">


    <div class="col-md-1 col-lg-offset-11">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <div class="col-md-8">
        <?= $form->field($model, 'page_title')->textInput() ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'menu_title')->textInput() ?>
    </div>

</div>

<div class="home-update col-md-12">

    <div class="col-md-6">
        <?= $form->field($editModel, 'address')->textInput(); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($editModel, 'phone')->textInput(); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($editModel, 'email')->textInput(); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($editModel, 'email_callback')->textInput(); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($editModel, 'instagram_link')->textInput()
            ->hint('Абсолютный формат (https://www.instagram.com/yourlink)'); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($editModel, 'vk_link')->textInput()
            ->hint('Абсолютный формат (https://vk.com/yourlink)'); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($editModel, 'opening_hours')->textInput(); ?>
    </div>




</div>
<?php ActiveForm::end(); ?>

