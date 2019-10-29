<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\modules\page\models\Page;


$this->title = Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>

<div class="page-index col-md-12">

    <h1><?= Yii::t('app', "Edit") . ": $model->page_title" ?></h1>

    <?php if($model->type !== Page::TYPE_CONTENT) : ?>
    <div class="page-form">
        <?php $form = ActiveForm::begin() ?>

        <div class="col-md-1 col-lg-offset-11">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'page_title')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'menu_title')->textInput() ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
    <?php endif; ?>
</div>

<div class="content-block col-md-12">

    <?php if (count($errors) > 0) : ?>
        <div class="error-summary">
            <?php foreach ($errors as $error) : ?>
                <span><?= $error ?></span>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <div class="content-block col-md-12">
            <?= $this->render("_$model->slug", [
                'model'        => $model,
                'editModel'    => $editModel,
                'dataProvider' => $dataProvider,
                'searchModel'  => $searchModel,
                'uploadModel'  => $uploadModel,
                'errors'       => $errors,
            ]) ?>
        </div>
    <?php endif; ?>

</div>