<?php

namespace backend\helpers;

use yii\helpers\HtmlPurifier;

class SecurityHelper extends HtmlPurifier
{

    public static function xssGuard($val) {
        return parent::process(trim($val));
    }

}