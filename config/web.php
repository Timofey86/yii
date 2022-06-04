<?php

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__ . '/db_local.php')
    ? (require __DIR__ . '/db_local.php') :
    (require __DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@my_alias' => 'http://google.com',
        '@page' => '@my_alias/myPage'
    ],
    'as datecreated' => [
        'class' => \app\behaviors\LogMeBehavior::class
    ],
    'container' => [
        'singletons' => [
            '\app\base\INotification' => ['class' => '\app\components\Notification'],
            '\app\base\ILogger' => ['class' => \app\components\WebLogger::class]
        ],
        'definitions' => []
    ],
    'components' => [
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy'
        ],
        'authManager' => [
            'class' => \yii\rbac\DbManager::class
        ],
        'rbac' => ['class' => \app\components\RbacComponent::class],
        'auth' => ['class' => \app\components\AuthComponent::class],
        'activity' => [
            'class' => \app\components\ActivityComponent::class,
            'model_class' => \app\models\Activity::class
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '-OwQE6BFzI1XkI7z_s4-8vM9Xj2j89ZY',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
//            'enableSession' => false
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/event' => 'event.php'
                    ],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'enableSwiftMailerLogging' => true,
            'useFileTransport' => true
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.yandex.ru',
//                'username' => 'timofeymuhin19@yandex.ru',
//                'password' => 'password',
//                'port' => '465',
//                'encryption' => 'SSL'
//            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'rest',
                    'pluralize' => false,
                ],
                'add' => 'activity/create',
                'new' => 'activity/create',
                'events/view/<id:\w+>' => 'activity/view',
                'events/<action>' => 'activity/<action>'

            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'], //127.0.0.1', '::1
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'], //127.0.0.1', '::1
    ];
}

return $config;
