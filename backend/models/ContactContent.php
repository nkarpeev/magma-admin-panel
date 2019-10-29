<?php

namespace backend\models;

use Yii;
use backend\components\IContent;
use backend\components\ContentService;

/**
 * This is the model class for table "{{%contact_content}}".
 *
 * @property int $id
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $instagram_link
 * @property string $vk_link
 * @property string $email_callback
 * @property string $opening_hours
 * @property string $coordinates
 */
class ContactContent extends BaseModel implements IContent
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_content}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'phone', 'email', 'instagram_link', 'vk_link', 'email_callback', 'opening_hours', 'coordinates'], 'required'],
            [['address', 'phone', 'email', 'instagram_link', 'vk_link', 'email_callback', 'opening_hours', 'coordinates'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'             => Yii::t('app', 'ID'),
            'address'        => Yii::t('app', 'Address'),
            'phone'          => Yii::t('app', 'Phone'),
            'email'          => Yii::t('app', 'Email'),
            'instagram_link' => Yii::t('app', 'Instagram Link'),
            'vk_link'        => Yii::t('app', 'Vk Link'),
            'email_callback' => Yii::t('app', 'Email Callback'),
            'opening_hours'  => Yii::t('app', 'Opening Hours'),
            'coordinates'    => Yii::t('app', 'Coordinates'),
        ];
    }

    /**
     * @return IContent
     */
    public static function getModel(): ContactContent
    {
        $contentService = new ContentService(ContactContent::className());
        return $contentService->getContentModel(ContactContent::SLUG_CONTACT);
    }
}
