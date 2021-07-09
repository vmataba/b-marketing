<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'timeZone' => 'Africa/Nairobi',
    'components' => [

//        'mail' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com', // e.g. smtp.mandrillapp.com or smtp.gmail.com
//                'username' => 'eacbram@gmail.com',
//                'password' => 'bram@2020',
//                'port' => '587', // Port 25 is a very common port too
//                'encryption' => 'tls', // It is often used, check your provider or mail server specs
//            ],
//        ],
        

        
//                'mail' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
//                'username' => 'elizabeth.minja88@gmail.com',
//               'password' => '19Enatalis83',
//                'port' => '587', // Port 25 is a very common port too
//                'encryption' => 'tls', // It is often used, check your provider or mail server specs
//            ],
//        ],
        

        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false
                ]
            ]
        ],

        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.office365.com', // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' =>'noreply@lvfo.org',
                'password' => 'Kampala_2020',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],
        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Q9SR1keZPP8iKr4Yqq6i5OGWRskvd0j0',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 1200, 
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
        /*
          'urlManager' => [
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'rules' => [
          ],
          ],
         */
    ],
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
        'payroll' => [
            'class' => 'app\modules\payroll\PayrollModule',
        ],
        'recruitment' => [
            'class' => 'app\modules\recruitment\RecruitmentModule'
        ]
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
        //'allowedIPs' => ['127.0.0.1'],
        'generators' => [//here
            'module' => [// generator name
                'class' => 'app\modules\gii\generators\module\Generator', // generator class
                'templates' => [//setting for out templates
                    'app_module' => '@app/modules/gii/generators/module/default', // template name => path to template
                ]
            ],
            'model' => [
                'class' => 'app\modules\gii\generators\model\Generator', // generator class
                'templates' => [//setting for out templates
                    'app_model' => '@app/modules/generators/model/default', // template name => path to template
                ]
            ],
            'crud' => [// generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [//setting for out templates
                    'app_crud' => '@app/modules/gii/generators/crud/default', // template name => path to template
                ]
            ],
        ],
    ];
   // $config['modules']['gii']['generators'] = [
   //     'kartikgii-crud' => ['class' => 'warrence\kartikgii\crud\Generator'],
   // ];
}

return $config;
