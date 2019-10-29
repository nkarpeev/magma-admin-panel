<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\certificate\models\Certificate */
/* @var $uploadModel backend\models\UploadModel */

$this->title = Yii::t('app', 'Update Certificate: ') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="certificate-update">

    <?= Html::a('', ['/page', 'edit' => 'certificate', 'type' => 'item'],
        ['class' => 'glyphicon glyphicon-menu-left btn btn-default']) ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <h4>ID: <?= Html::encode($model->id) ?></h4>

    <?= $this->render('_form', [
        'model'       => $model,
        'uploadModel' => $uploadModel,
        'errors'      => $model->getErrorSummary(true),
    ]) ?>

</div>
