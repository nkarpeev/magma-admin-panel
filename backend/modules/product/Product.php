<?php

namespace backend\modules\product;

/**
 * Product module definition class
 */
class Product extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\product\controllers';
    public $defaultRoute = 'product/index';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
