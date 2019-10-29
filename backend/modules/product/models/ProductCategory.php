<?php

namespace backend\modules\product\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "{{%product_category}}".
 *
 * @property int $id
 * @property string $title
 * @property int $published
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Product[] $products
 */
class ProductCategory extends \yii\db\ActiveRecord
{

    function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%product_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['published'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['published'], 'default', 'value' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'title'      => Yii::t('app', 'Title'),
            'published'  => Yii::t('app', 'Published'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
}
