<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Product */
/* @var $errors backend\modules\product\models\Product */
/* @var $uploadModel backend\models\UploadModel */


$this->title = Yii::t('app', 'Create Product');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= Html::a('', ['/page', 'edit' => 'product', 'type' => 'item'],
        ['class' => 'glyphicon glyphicon-menu-left btn btn-default']) ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'  => $model,
        'errors' => $errors,
        'uploadModel' => $uploadModel,

    ]) ?>

</div>
