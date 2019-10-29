<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Product */
/* @var $errors backend\modules\product\models\Product */
/* @var $uploadModel backend\models\UploadModel */



$this->title = Yii::t('app', 'Update Product') . ": $model->title";
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <?php $this->beginBlock('menu_left') ?>
    <?= Html::a('', ['/page', 'edit' => 'product', 'type' => 'item'],
        ['class' => 'glyphicon glyphicon-menu-left btn btn-default']) ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <h4>ID: <?= Html::encode($model->id) ?></h4>


    <?= $this->render('_form', [
        'model'  => $model,
        'errors' => $errors,
        'uploadModel' => $uploadModel,
    ]) ?>

</div>
<hr>
<div class="product-view col-md-6">
    <?php try {
        DetailView::widget([
            'model'      => $model,
            'attributes' => [
                'created_at',
                'updated_at',
            ],
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    } ?>
</div>
