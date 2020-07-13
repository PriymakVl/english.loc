<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '0Ygk4CDaEA-dULJqWD_DkE-IZ08oPKH4',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
                'words' => 'word/word/index',
                'word/lesson/<action:\w+>' => 'word/word-lesson/<action>',
                'word/add-from-files' => 'word/word/add-from-files',
                'word/set-state' => 'word/word/set-state',
                'word/<action:\w+>' => 'word/word/<action>',

                'phrases' => 'phrase/phrase/index',
                'phrase/repeat' => 'phrase/phrase-lesson/repeat',
                'phrase/sounds' => 'phrase/phrase-lesson/sounds',
                'phrase/study' => 'phrase/phrase-lesson/study',
                'phrase/break-text' => 'phrase/phrase/break-text',
                'phrase/create-sub' => 'phrase/phrase/create-sub',
                'phrase/delete-all' => 'phrase/phrase/delete-all',
                'phrase/<action:\w+>' => 'phrase/phrase/<action>',

                'texts' => 'text/text/index',
                'text/words' => 'text/text-content/words',
                'text/phrases' => 'text/text-content/phrases',
                'text/<action:\w+>' => 'text/text/<action>',

                'categories' => 'category/category/index',
                'category/<action:\w+>' => 'category/category/<action>'
            ],
        ],
        
    ],
    'modules' => [
        'word' => [
            'class' => 'app\modules\word\Module',
        ],
        'phrase' => [
            'class' => 'app\modules\phrase\Module',
        ],
        'text' => [
            'class' => 'app\modules\text\Module',
        ],
        'category' => [
            'class' => 'app\modules\category\Module',
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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
