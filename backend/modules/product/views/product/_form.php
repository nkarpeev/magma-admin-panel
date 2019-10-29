<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use backend\modules\product\models\Product;


/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Product */
/* @var $errors backend\modules\product\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $uploadModel backend\models\UploadModel */

?>

<?php $this->beginBlock('errors') ?>

<?php if (count($errors) > 0) : ?>
    <div class="error-summary">
        <?php foreach ($errors as $error) : ?>
            <span><?= $error ?></span>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php $this->endBlock() ?>


<?= $this->blocks['errors'] ?>


<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <div class="product-context row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'category_id')->dropDownList(Product::getCategoriesMap()) //TODO show category name ?>
            <?= $form->field($model, 'price')->textInput() ?>
            <?= $form->field($model, 'price_max')->textInput() ?>
            <?= $form->field($model, 'published')->checkbox() ?>
        </div>

        <div class="col-md-6">
            <?php
            echo $form->field($uploadModel, 'image')->fileInput();

            echo Html::img($model->getImage($model->image, Yii::getAlias(Yii::$app->params['productImgUri']), $model->id),
                [
                    'width' => '500px',
                    'alt'   => $model->image
                ]);
            ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'attribute')->textarea(['rows' => 10])->widget(TinyMce::className(), [
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

    <?php ActiveForm::end(); ?>

</div>
