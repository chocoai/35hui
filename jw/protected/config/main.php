<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require(dirname(__FILE__).'/define.php');//加载定义的全局变量

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'jw',
    'language'=>'zh_cn',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.common.*',
	),

	'defaultController'=>'site',

	// application components
	'components'=>array(
		'user'=>array(
			'allowAutoLogin'=>true,
            'loginUrl' => array('/site/index'),
		),
        'authManager'=>array(
            //enable auth user by roles
            'class'=>'CDbAuthManager',
        ),
		'db'=>array(
			'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=192.168.1.100;dbname=jw',
			'emulatePrepare' => true,
			'username' => 'dev',
			'password' => 'dev',
			'charset' => 'utf8',
			'tablePrefix' => 'jw_',
			'schemaCachingDuration'=>3600,
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path',
            'showScriptName'=>false,
        	'rules'=>array(
        	),
        ),
        'log'=>array(
                        'class'=>'CLogRouter',
                        'routes'=>array(
                        /*
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                 *
                        */
                        // uncomment the following to show log messages on web pages
                                //array(
                                        //'class'=>'CWebLogRoute',
                                        // 'levels'=>'trace,info,profile',
                                        //'levels'=>'profile',
                                        //
                                        // I include *vardump* but you
                                        // can include more separated by commas
                                        //'categories'=>'vardump',
                                        //
                                        // This is self-explanatory right?
                                        //'showInFireBug'=>true

                                //),
                            array(
                                'class'=>'CProfileLogRoute',
                            ),

                        ),
                ),
	),
    'modules'=>array(
        "my",
        "admin",
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'jw',
        )
    ),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);