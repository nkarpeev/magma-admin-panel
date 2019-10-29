<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>

<ul class="nav sidebar-widget sidebar-right">
    <?php foreach ($data as $label => $link) : ?>
        <li class="sidebar-link sidebar-widget-elem"><?= Html::a($label, $link, ['class' => 'pjax-link']); ?></li>
    <?php endforeach; ?>
</ul>
