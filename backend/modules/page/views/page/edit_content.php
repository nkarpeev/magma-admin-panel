<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>

<div class="page-index col-md-12">

    <h1><?= Yii::t('app', "Edit") . ": $model->page_title" ?></h1>

</div>

<div class="content-block col-md-12">

    <?php if (count($errors) > 0) : ?>
        <div class="error-summary">
            <?php foreach ($errors as $error) : ?>
                <span><?= $error ?></span>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <hr>
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