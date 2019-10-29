<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-backend',
    'name'                => Yii::t('app', 'Management panel'),
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log'],

    'sourceLanguage' => 'en',
    'language' => 'ru-RU',

    'defaultRoute' => 'administrator/administrator/index',

    'modules'    => [
        'administrator' => [
            'class' => 'backend\modules\administrator\Administrator',
        ],
        'product'       => [
            'class' => 'backend\modules\product\Product',
        ],
        'certificate' => [
            'class' => 'backend\modules\certificate\Certificate',
        ],
        'portfolio' => [
            'class' => 'backend\modules\portfolio\Portfolio',
        ],
        'content' => [
            'class' => 'backend\modules\content\Content',
        ],
        'page'          => [
            'class' => 'backend\modules\page\Page',
        ],
    ],
    'components' => [
        'request'      => [
            'csrfParam' => '_csrf-backend',
            'baseUrl'   => '/sm-admin',
        ],
        'user'         => [
            'identityClass'   => 'backend\modules\administrator\models\Administrator',
            'enableAutoLogin' => true,
            'loginUrl'        => ['administrator/administrator/login'],
            'identityCookie'  => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                //admin module
                'administrator/<action:\w+>/'    => 'administrator/administrator/<action>',
                'administrator/<action>'         => 'administrator/administrator/<action>',

                //product module
                'product/<action:\w+>/'          => 'product/product/<action>',
                'product-category/<action:\w+>/' => 'product/product-category/<action>',

                //certificate module
                'certificate/<action:\w+>/'          => 'certificate/certificate/<action>',

                //portfolio module
                'portfolio/<action:\w+>/'          => 'portfolio/portfolio/<action>',

                //content module
                'content/<action:\w+>/'          => 'content/content/<action>',

                //page module
                'page/<action:\w+>/'             => 'page/page/<action>',

                //default
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
    ],
    'params'     => $params,
];
