<?php

namespace backend\modules\page\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use backend\helpers\SecurityHelper;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property int $id
 * @property string $page_title
 * @property string $menu_title
 * @property string $slug
 * @property string $type
 * @property int $published
 * @property string $updated_at
 */
class Page extends \yii\db\ActiveRecord
{

    const TYPE_CONTENT = 'content';

    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'updatedAtAttribute' => 'updated_at',
                'value'              => new Expression('NOW()'),
            ]
        ];
    }

    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_title'], 'required'],
            [['published'], 'integer'],
            [['page_title', 'menu_title', 'slug', 'type'], 'string', 'max' => 255],
            [['page_title', 'menu_title'], 'default', 'value' => null],

            //filter
            [['page_title', 'menu_title', 'published'], 'filter', 'filter' => function ($val) {
                return SecurityHelper::xssGuard($val);
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'page_title' => Yii::t('app', 'Page Title'),
            'menu_title' => Yii::t('app', 'Menu Title'),
            'published'  => Yii::t('app', 'Published'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @param $slug
     * @return string
     */
    public static function getMenuTitle($slug) :string
    {
        $pages = Page::find()->indexBy('slug')->asArray()->all();
        return (strlen($pages[$slug]['menu_title']) > 0) ? $pages[$slug]['menu_title'] : $pages[$slug]['page_title'];
    }

    /**
     * @param $slug
     * @return string
     */
    public static function getPageTitle($slug) :string
    {
        return Page::find()
            ->where(['slug' => $slug])
            ->select('page_title')
            ->one()
            ->page_title;

    }


}
