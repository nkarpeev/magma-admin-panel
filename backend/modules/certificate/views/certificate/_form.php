<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\modules\certificate\models\Certificate */
/* @var $form yii\widgets\ActiveForm */
/* @var $uploadModel backend\models\UploadModel */

?>

<?= $this->blocks['errors'] ?>

<div class="certificate-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <div class="certificate-context row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-10">
            <?= $form->field($model, 'content')->textarea()->widget(TinyMce::className(), [
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
    </div>

    <div class="col-md-6">
        <?php
        echo $form->field($uploadModel, 'image')->fileInput();

        echo Html::img($model->getImage($model->image, Yii::getAlias(Yii::$app->params['certificateImgUri']), $model->id),
            [
                'width' => '500px',
                'alt'   => $model->image
            ]);
        ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
