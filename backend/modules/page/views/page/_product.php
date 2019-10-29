<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\modules\product\models\Product;

/* @var $this yii\web\View */
/* @var $model backend\modules\page\models\Page */
/* @var $searchModel backend\modules\product\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php Pjax::begin(); ?>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<!--<div class="col-md-3 col-lg-offset-9">-->
<p>
    <?= Html::a(Yii::t('app', 'Create Product'), ['/product/create'], ['class' => 'btn btn-success']) ?>
</p>
<!--<p>-->
<!--    Html::a(Yii::t('app', 'Create Product category'), ['/product-category/create'], ['class' => 'btn btn-success'])-->
<!--</p>-->
<!--</div>-->
<div class="col-md-12">
<?php
try {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'category_id',
                'value'     => 'category.title',
                'filter'    => Html::activeDropDownList($searchModel, 'category_id', Product::getCategoriesMap(), ['prompt' => 'Все'])
            ],
            'title',
            [
                'attribute' => 'price',
                'value'     => function ($model) {
                    return $model->numberFormat($model->price);
                }
            ],
            [
                'attribute' => 'price_max',
                'value'     => function ($model) {
                    return $model->numberFormat($model->price_max);
                }
            ],
            [
                'attribute' => 'image',
                'format'    => 'html',
                'value'     => function ($data) {

                    return Html::img($data->getImage($data->image, Yii::getAlias(Yii::$app->params['productImgUri']), $data->id),
                        ['width'  => '70px',
                         'height' => '70px',
                         'alt'    => $data->image
                        ]);
                },

            ],
            'published:boolean',
            //            [
            //                'label' => 'Published',
            //                'value' => function ($model) {
            //                    return ($model->published) ? Yii::t('app', 'Published') : Yii::t('app', 'Hidden');
            //                }
            //            ],

            [
                'class'      => 'yii\grid\ActionColumn',
                'header'     => Yii::t('app', 'Actions'),
                'template'   => '{update} {delete}',
                'urlCreator' => function ($action, $data, $key, $index) use ($model) {
                    if ($action === 'update')
                        return Url::to(["/$model->slug/update", 'id' => $data->id]);

                    if ($action === 'delete')
                        return Url::to(["/$model->slug/delete", 'id' => $data->id]);
                }
            ],
        ],
    ]);
} catch (Exception $e) {
    echo $e->getMessage() . ', line: ' . $e->getLine();
}

Pjax::end(); ?>
</div>