<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\portfolio\models\Portfolio */
/* @var $uploadModel backend\models\UploadModel */


$this->title = Yii::t('app', 'Create Portfolio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Portfolios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-create">

    <?= Html::a('', ['/page', 'edit' => 'portfolio', 'type' => 'item'],
    ['class' => 'glyphicon glyphicon-menu-left btn btn-default']) ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <h4>ID: <?= Html::encode($model->id) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'uploadModel' => $uploadModel,
        'uploadPreview' => $uploadPreview,
        'errors' => $model->getErrorSummary(true),

    ]) ?>

</div>
