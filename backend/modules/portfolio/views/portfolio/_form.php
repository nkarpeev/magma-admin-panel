<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;


/* @var $this yii\web\View */
/* @var $model backend\modules\portfolio\models\Portfolio */
/* @var $form yii\widgets\ActiveForm */
/* @var $uploadModel backend\models\UploadModel */

?>

<?= $this->blocks['errors'] ?>

<div class="portfolio-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-10">

        <?= $form->field($model, 'content')->textarea(['rows' => 8])->widget(TinyMce::className(), [
            'options'       => ['rows' => 10],
            'language'      => 'ru',
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            ]
        ]); ?>
    </div>

    <div class="col-md-6">
        <?php
        echo $form->field($uploadPreview, 'preview')->fileInput();

        echo Html::img($model->getImage($model->preview, Yii::getAlias(Yii::$app->params['portfolioImgUri']), $model->id),
            [
                'width' => '300px',
                'alt'   => $model->preview
            ]);
        ?>
    </div>

    <div class="col-md-12">

        <?= $form->field($uploadModel, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*']); ?>

        <?php $files = $model->getImages($model->id, Yii::$app->params['portfolioImgPath']); ?>

        <?php foreach ($files as $image) : ?>

            <div class="div col-md-4">

                <?= Html::a(Yii::t('app', 'remove file'), \yii\helpers\Url::to(['portfolio/delete-file', 'id' => $model->id, 'file' => $image])); ?>

                <?= Html::img($model->getImage($image, Yii::getAlias(Yii::$app->params['portfolioImgUri']), $model->id),
                    [
                        'width' => '200px',
                        'alt'   => $model->image
                    ]); ?>
            </div>

        <?php endforeach; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
