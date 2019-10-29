<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $editModel backend\components\IContent */
/* @var $model backend\modules\page\models\Page */
/* @var $uploadModel backend\models\UploadModel */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\tinymce\TinyMce;

?>
<?php $form = ActiveForm::begin() ?>
<div class="page-form">


    <div class="col-md-1 col-lg-offset-11">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <div class="col-md-8">
        <?= $form->field($model, 'page_title')->textInput() ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'menu_title')->textInput() ?>
    </div>

</div>

<div class="tech-update col-md-12">
    <div class="col-md-8">
        <?= $form->field($editModel, 'content_1')->textarea()->widget(TinyMce::className(), [
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
        ])->label('Текстовой описание 1'); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($uploadModel, 'image[image_1]')->fileInput();

        echo Html::img($editModel->getImage($editModel->image_1, Yii::getAlias(Yii::$app->params['contentImgUri'])),
            [
                'width' => '300px',
                'alt'   => $editModel->image_1
            ]);
        ?>
    </div>
    <div class="col-md-8">
        <?= $form->field($editModel, 'content_2')->textarea()->widget(TinyMce::className(), [
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
        ])->label('Текстовой описание 2'); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($uploadModel, 'image[image_2]')->fileInput();

        echo Html::img($editModel->getImage($editModel->image_2, Yii::getAlias(Yii::$app->params['contentImgUri'])),
            [
                'width' => '300px',
                'alt'   => $editModel->image_2
            ]);
        ?>
    </div>

    <div class="col-md-8">
        <?= $form->field($editModel, 'content_3')->textarea()->widget(TinyMce::className(), [
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
        ])->label('Текстовой описание 3'); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($uploadModel, 'image[image_3]')->fileInput();

        echo Html::img($editModel->getImage($editModel->image_3, Yii::getAlias(Yii::$app->params['contentImgUri'])),
            [
                'width' => '300px',
                'alt'   => $editModel->image_3
            ]);
        ?>
    </div>

    <div class="col-md-8">
        <?= $form->field($editModel, 'content_4')->textarea()->widget(TinyMce::className(), [
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
        ])->label('Текстовой описание 4'); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($uploadModel, 'image[image_4]')->fileInput();

        echo Html::img($editModel->getImage($editModel->image_4, Yii::getAlias(Yii::$app->params['contentImgUri'])),
            [
                'width' => '300px',
                'alt'   => $editModel->image_4
            ]);
        ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

