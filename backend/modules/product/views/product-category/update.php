<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\ProductCategory */

$this->title = Yii::t('app', 'Update Product Category') . ": $model->title";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-category-update">

    <?= Html::a('', ['/product-category/index'],
        ['class' => 'glyphicon glyphicon-menu-left btn btn-default']) ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<hr>
<div class="product-view col-md-6">
    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'created_at',
            'updated_at',
        ],
    ]) ?>
</div>