<?php

namespace backend\modules\administrator;

/**
 * Administrator module definition class
 */
class Administrator extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\administrator\controllers';
    public $defaultRoute = 'administrator/index';


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
