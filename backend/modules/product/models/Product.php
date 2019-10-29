<?php

namespace backend\modules\product\models;

use backend\models\BaseModel;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $attribute
 * @property int $price
 * @property int $price_max
 * @property string $image
 * @property int $published
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ProductCategory $category
 */
class Product extends BaseModel
{

    public function behaviors()
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
        return '{{%product}}';
    }

    public function rules()
    {
        return [
            [['category_id', 'price', 'price_max', 'published'], 'integer'],
            [['title', 'price', 'category_id'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['attribute'], 'string', 'max' => \Yii::$app->params['maxString']],
            [['image'], 'string'],
            ['title', 'unique', 'targetClass' => 'backend\modules\product\models\Product', 'message' => 'This product name has already been taken.'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['category_id' => 'id']],

            [['published'], 'default', 'value' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title'       => Yii::t('app', 'Title'),
            'price'       => Yii::t('app', 'Price'),
            'price_max'   => Yii::t('app', 'Price Max'),
            'image'       => Yii::t('app', 'Image'),
            'published'   => Yii::t('app', 'Published'),
            'created_at'  => Yii::t('app', 'Created At'),
            'updated_at'  => Yii::t('app', 'Updated At'),
            'attribute'  => Yii::t('app', 'Attribute'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    public static function getCategoriesMap(): array
    {

        return ArrayHelper::map(
            ProductCategory::find()
                ->select(['id', 'title'])
                ->asArray()
                ->all(),
            'id', 'title'
        );
    }

    public static function getCategories() :array {

        return ProductCategory::find()
            ->select(['id', 'title', 'icon'])
            ->all();
    }

    public function numberFormat($price) {
        return is_numeric($price) ? (number_format($price, 0, '', ' ')) : $price;
    }


}
