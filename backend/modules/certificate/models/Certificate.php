<?php

namespace backend\modules\certificate\models;

use backend\models\BaseModel;
use Yii;

/**
 * This is the model class for table "{{%certificate}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property int $sort_num
 */
class Certificate extends BaseModel
{
    public static function tableName()
    {
        return '{{%certificate}}';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string', 'max' => \Yii::$app->params['maxString']],
            [['sort_num'], 'integer'],
            [['title'], 'string', 'max' => 255],

            [['image'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'       => Yii::t('app', 'ID'),
            'title'    => Yii::t('app', 'Title'),
            'content'  => Yii::t('app', 'Content'),
            'image'    => Yii::t('app', 'Image'),
            'sort_num' => Yii::t('app', 'Sort Num'),
        ];
    }

}
