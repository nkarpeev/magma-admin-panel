<?php

namespace backend\components;

use yii\web\UploadedFile;


interface IContentService
{

    public function __construct(string $modelName);

    public function getContentModel($slug);

}