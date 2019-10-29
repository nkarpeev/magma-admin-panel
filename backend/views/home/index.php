<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $about backend\modules\certificate\models\Certificate */
/* @var $uploadModel backend\models\UploadModel */

$this->title = Yii::t('app', 'Update Home page: ');
$this->params['breadcrumbs'][] = Yii::t('app', 'Update Home page');
?>
<div class="home-update col-md-12">
    <?php $form = ActiveForm::begin([]); ?>
    <div class="col-md-12">
        <h3>Главный экран</h3>

        <div class="col-md-6">
            <?= $form->field($firstScreen, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($firstScreen, 'value')->textInput(['maxlength' => true])->label('Название кнопки со ссылкой на проекты') ?>
        </div>

        <div class="col-md-4 offset-8">
            <?= $form->field($uploadFirstScreen, 'image')->fileInput();

            echo Html::img($firstScreen->getImage($firstScreen->image, Yii::getAlias(Yii::$app->params['contentImgUri'])),
                [
                    'width' => '500px',
                    'alt'   => $firstScreen->image
                ]);
            ?>
        </div>
    </div>
    <div class="col-md-12">
        <h3>О компании</h3>

        <div class="col-md-6 offset-6">
            <?= $form->field($about, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($about, 'value')->textarea()->widget(TinyMce::className(), [
                'options'       => ['rows' => 15],
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
        <div class="col-md-4">
            <?= $form->field($uploadAbout, 'image')->fileInput();

            echo Html::img($about->getImage($about->image, Yii::getAlias(Yii::$app->params['contentImgUri'])),
                [
                    'width' => '500px',
                    'alt'   => $about->image
                ]);
            ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>