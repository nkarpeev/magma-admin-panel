<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\product\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php Pjax::begin(); ?>

    <!--<div class="col-md-3 col-lg-offset-9">-->
    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['/certificate/create'], ['class' => 'btn btn-success']) ?>
    </p>
    <!--<p>-->
    <!--    Html::a(Yii::t('app', 'Create Product category'), ['/product-category/create'], ['class' => 'btn btn-success'])-->
    <!--</p>-->
    <!--</div>-->

<?php
try {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute'      => 'content',
                'format'         => 'html',
                'value'          => function ($data) {
                    return backend\helpers\StringHelper::truncate($data->content, Yii::$app->params['commonQuoteSize']);
                },
                'contentOptions' => [
                    'class' => 'quote-content',
                ]
            ],
            [
                'attribute' => 'image',
                'format'    => 'html',
                'value'     => function ($data) {

                    return Html::img($data->getImage($data->image, Yii::getAlias(Yii::$app->params['certificateImgUri']), $data->id),
                        [
                            'width'  => '70px',
                            'height' => '70px',
                            'alt'    => $data->image
                        ]);
                },
            ],
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


Pjax::end();
?>