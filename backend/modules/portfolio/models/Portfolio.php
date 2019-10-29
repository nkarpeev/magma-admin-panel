<?php

namespace backend\modules\portfolio\models;

use backend\models\BaseModel;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "{{%portfolio}}".
 *
 * @property int $id
 * @property string $title
 * @property string $preview
 * @property string $content
 */
class Portfolio extends BaseModel
{

    public $image;

    public static function tableName()
    {
        return '{{%portfolio}}';
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string', 'max' => \Yii::$app->params['maxString']],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['image'], 'string'],
            [['preview'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'      => Yii::t('app', 'ID'),
            'title'   => Yii::t('app', 'Title'),
            'preview' => Yii::t('app', 'Preview'),
            'content' => Yii::t('app', 'Content'),
        ];
    }


    public function getImages($id, $storage, $preview = false): array
    {
        $files = \backend\components\Storage::getFilesOnDirectory(Yii::getAlias($storage), $id);

        if (count($files) !== 0) {
            $files = array_map(function ($file) {
                $arr = explode('/', $file);
                return array_pop($arr);
            }, $files);

            if ($preview === false) {
                $files = array_filter($files, function ($file) {
                    return $file !== $this->preview;
                });
            }
        }

        return $files;
    }

    public static function getOthersPortfolios($currentID)
    {
        $othersID = self::find()
            ->select('id')
            ->where(['not in', 'id', $currentID])
            ->asArray()
            ->all();

        $othersIDMap = ArrayHelper::map($othersID, 'id', 'id');

        if (count($othersID) < 3)
            return self::findAll($othersIDMap);

        return self::findAll(array_rand($othersIDMap, 3));
    }


}
