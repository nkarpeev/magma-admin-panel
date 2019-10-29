<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 10/12/18
 * Time: 10:24 PM
 */

namespace backend\helpers;

class StringHelper extends \yii\helpers\StringHelper
{

    public static function getSubAfterDelimiter($str, $del) {
        return mb_substr($str,mb_stripos($str, $del));
    }

}