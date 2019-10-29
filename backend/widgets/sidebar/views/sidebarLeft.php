<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\helpers\StringHelper;

$current = Url::current();
?>

<ul class="nav sidebar-widget">
    <?php foreach ($data as $label => $link) : //TODO active class ?>
        <li class="sidebar-widget-elem <?= (StringHelper::getSubAfterDelimiter($link, '=') === StringHelper::getSubAfterDelimiter($current, '=')) ? 'active' : ''; ?>"><?= Html::a($label, $link); ?></li>
    <?php endforeach; ?>
</ul>
<hr>
<ul class="nav sidebar-widget">
    <li class="sidebar-widget-elem <?= ($current === '/sm-admin/product-category/index') ? 'active' : ''; ?>"><?= Html::a(Yii::t('app', 'Category list'), Url::to(['/product-category/index'])); ?></li>
</ul>
