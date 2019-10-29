<?php

namespace backend\components;

use yii\web\UploadedFile;


interface IStorage
{
    public function saveUploadedFile(UploadedFile $file);

    public function getStorageNormalizePath();

    public function getStoragePath();

    public function foundFile(string $directory);

    public function removeFile($filename);

    public function removeDirectory($path);
}