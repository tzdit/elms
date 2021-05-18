<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //this rule for classwork route
                '<controller:[\w\-]+>/<action:[\w\-]+>/<cid:\w->/classwork' => '<controller>/<action>' 
            ],
        ],
        'hashids' => [
            'class' => 'light\hashids\Hashids',
            'salt' => 'ABDCDGAGAGA',
            'minHashLength' => 5,
            'alphabet' => 'abcdefghigLMNopkRSTuvWzyZ'
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    
    ],
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'defaultRoute'=>'auth',
];
