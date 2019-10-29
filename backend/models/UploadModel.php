<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use backend\components\IStorage;

class UploadModel extends Model
{
    const SCENARIO_UPLOAD_MULTIPLE = 'upload_multiple';
    const SCENARIO_UPLOAD_SINGLE = 'upload_single';

    public $image;
    public $preview;


    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT         => ['image'],
            self::SCENARIO_UPLOAD_MULTIPLE => ['image'],
            self::SCENARIO_UPLOAD_SINGLE   => ['image'],
        ];
    }

    public function rules()
    {
        return [
            [['image'], 'file',
                'skipOnEmpty'              => true,
                'extensions'               => ['jpg', 'png'],
                'checkExtensionByMimeType' => true,
                'maxSize'                  => $this->getMaxFileSize(),
                'maxFiles'                 => 0,
                'on'                       => self::SCENARIO_UPLOAD_MULTIPLE
            ],

            [['image'], 'file',
                'skipOnEmpty'              => true,
                'extensions'               => ['jpg', 'png'],
                'checkExtensionByMimeType' => true,
                'maxSize'                  => $this->getMaxFileSize(),
                'on'                       => self::SCENARIO_UPLOAD_SINGLE
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image' => Yii::t('app', 'Image'),
        ];
    }

    public function upload($file, $attribute, IStorage $storage)
    {
        if ($this->validate()) {
            $this->$attribute = ($file instanceof UploadedFile) ? $storage->saveUploadedFile($file) : false;
            return true;
        }

        return false;
    }

    public function uploadMultiple(array $files, IStorage $storage)
    {
        if ($this->validate()) {

            foreach ($files as $file) {
                if ($file instanceof UploadedFile) $storage->saveUploadedFile($file);
            }
            return true;
        }

        return false;
    }

    public function getMaxFileSize(): int
    {
        return Yii::$app->params['maxFileSize'];
    }
}