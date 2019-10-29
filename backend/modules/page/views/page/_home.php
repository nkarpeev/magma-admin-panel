<?php

/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */


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

<div class="home-update col-md-12">
    <h3>Главный экран</h3>

    <div class="col-md-6">
        <?= $form->field($editModel, 'header_title')->textInput()->widget(TinyMce::className(), [
            'options'       => ['rows' => 3],
            'language'      => 'ru',
            'clientOptions' => [
                'plugins' => [
                    "anchor",
                    "code",
                ],
                'toolbar' => "undo redo"]])->label('Заголовок') ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($editModel, 'header_button_text')->textInput(['maxlength' => true])->label('Название кнопки со ссылкой на проекты') ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($uploadModel, 'image[header_image]')->fileInput();

        echo Html::img($editModel->getImage($editModel->header_image, Yii::getAlias(Yii::$app->params['contentImgUri'])),
            [
                'width' => '500px',
                'alt'   => $editModel->header_image
            ]);
        ?>
    </div>
</div>
<hr>
<div class="home-update col-md-12">
    <h3>О компании</h3>
    <div class="col-md-6">
        <?= $form->field($editModel, 'about_title')->textInput(['maxlength' => true])->label('Заголовок') ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($editModel, 'about_text')->textarea()->widget(TinyMce::className(), [
            'options'       => ['rows' => 8],
            'language'      => 'ru',
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            ]
        ])->label('Текстовой описание'); ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($uploadModel, 'image[about_image]')->fileInput();

        echo Html::img($editModel->getImage($editModel->about_image, Yii::getAlias(Yii::$app->params['contentImgUri'])),
            [
                'width' => '500px',
                'alt'   => $editModel->about_image
            ]);
        ?>
    </div>
</div>
<hr>
<div class="home-update col-md-12">
    <h3>Почему выбирают нас</h3>
    <div class="col-md-6">
        <?= $form->field($editModel, 'whywe_title')->textInput(['maxlength' => true])->label('Заголовок') ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($editModel, 'whywe_text_1')->textarea()->widget(TinyMce::className(), [
            'options'       => ['rows' => 8],
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

        <?= $form->field($editModel, 'whywe_text_2')->textarea()->widget(TinyMce::className(), [
            'options'       => ['rows' => 8],
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

        <?= $form->field($editModel, 'whywe_text_3')->textarea()->widget(TinyMce::className(), [
            'options'       => ['rows' => 8],
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
    <hr>
    <div class="home-update col-md-12">
        <h3>Наши клиенты</h3>
        <div class="col-md-6">
            <?= $form->field($editModel, 'client_title')->textInput(['maxlength' => true])->label('Заголовок') ?>
        </div>
    </div>
    <div class="col-md-1 col-lg-offset-11">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

