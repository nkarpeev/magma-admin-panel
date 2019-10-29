<?php

namespace backend\models;

use backend\components\IContent;
use Yii;

/**
 * This is the model class for table "{{%home_content}}".
 *
 * @property int $id
 * @property string $header_title
 * @property string $header_button_text
 * @property string $header_image
 * @property string $about_title
 * @property string $about_text
 * @property string $about_image
 * @property string $whywe_title
 * @property string $whywe_text_1
 * @property string $whywe_text_2
 * @property string $whywe_text_3
 * @property string $client_title
 */
class HomeContent extends BaseModel implements IContent
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%home_content}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about_text', 'whywe_text_1', 'whywe_text_2', 'whywe_text_3'], 'string'],
            [['header_title', 'header_button_text', 'header_image', 'about_title', 'about_image', 'whywe_title', 'client_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'header_title' => Yii::t('app', 'Header Title'),
            'header_button_text' => Yii::t('app', 'Header Button Text'),
            'header_image' => Yii::t('app', 'Header Image'),
            'about_title' => Yii::t('app', 'About Title'),
            'about_text' => Yii::t('app', 'About Text'),
            'about_image' => Yii::t('app', 'About Image'),
            'whywe_title' => Yii::t('app', 'Whywe Title'),
            'whywe_text_1' => Yii::t('app', 'Whywe Text 1'),
            'whywe_text_2' => Yii::t('app', 'Whywe Text 2'),
            'whywe_text_3' => Yii::t('app', 'Whywe Text 3'),
            'client_title' => Yii::t('app', 'Client Title'),
        ];
    }
}
