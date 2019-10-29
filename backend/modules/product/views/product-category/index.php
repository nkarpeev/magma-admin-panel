<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\product\models\ProductCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Product Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--    <p>-->
    <!--        Html::a(Yii::t('app', 'Create Product Category'), ['create'], ['class' => 'btn btn-success'])-->
    <!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'published:boolean',
            'updated_at',

            [
                'class'    => 'yii\grid\ActionColumn',
                'header'     => Yii::t('app', 'Actions'),
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
