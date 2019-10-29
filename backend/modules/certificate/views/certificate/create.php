<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\certificate\models\Certificate */
/* @var $uploadModel backend\models\UploadModel */


$this->title = Yii::t('app', 'Create Certificate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificate-create">

    <?= Html::a('', ['/page', 'edit' => 'certificate', 'type' => 'item'],
        ['class' => 'glyphicon glyphicon-menu-left btn btn-default']) ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'       => $model,
        'uploadModel' => $uploadModel,
        'errors'      => $model->getErrorSummary(true),
    ]) ?>

</div>
