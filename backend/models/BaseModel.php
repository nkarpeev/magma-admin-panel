<?php

namespace backend\models;

use common\components\ImageHelperTrait;
use Yii;
use yii\db\ActiveRecord;
use backend\components\IStorage;
use yii\web\UploadedFile;

class BaseModel extends ActiveRecord
{

    const SLUG_HOME = 'home';
    const SLUG_PORTFOLIO = 'portfolio';
    const SLUG_PRODUCT = 'product';
    const SLUG_MACHINE = 'machine';
    const SLUG_TECH = 'tech';
    const SLUG_CERTIFICATE = 'certificate';
    const SLUG_CONTACT = 'contact';

    use ImageHelperTrait;

}