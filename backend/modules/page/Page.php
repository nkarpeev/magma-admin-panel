<?php

namespace backend\modules\page;

/**
 * page module definition class
 */
class Page extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\page\controllers';
    public $defaultRoute = 'page/index';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
