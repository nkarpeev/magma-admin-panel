<?php

namespace backend\models;

use Yii;
use backend\components\IContent;

/**
 * This is the model class for table "{{%tech_content}}".
 *
 * @property int $id
 * @property string $content_1
 * @property string $image_1
 * @property string $content_2
 * @property string $image_2
 * @property string $content_3
 * @property string $image_3
 * @property string $content_4
 * @property string $image_4
 */
class TechContent extends BaseModel implements IContent
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tech_content}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_1', 'content_2', 'content_3', 'content_4'], 'string'],
            [['image_1', 'image_2', 'image_3', 'image_4'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content_1' => Yii::t('app', 'Content 1'),
            'image_1' => Yii::t('app', 'Image 1'),
            'content_2' => Yii::t('app', 'Content 2'),
            'image_2' => Yii::t('app', 'Image 2'),
            'content_3' => Yii::t('app', 'Content 3'),
            'image_3' => Yii::t('app', 'Image 3'),
            'content_4' => Yii::t('app', 'Content 4'),
            'image_4' => Yii::t('app', 'Image 4'),
        ];
    }
}
