<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

require(dirname(__FILE__).'/define.php');//加载定义的全局变量
#================================================================
#===加载其他系统模块


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'image',
	//language setting
	'language'=>'zh_cn',
	'timeZone' => 'Asia/Shanghai',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'ext.mail.Message'
	),
    
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		 
        'db'=>array(
		    'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=192.168.1.100;dbname=swhui',
			'emulatePrepare' => true,
			'username' => 'dev',
			'password' => 'dev',
			'charset' => 'utf8',
			'tablePrefix' => '35_',
			'schemaCachingDuration'=>3600,
		),
		'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
         'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
           
		),
        'mailer' => array(
          'class' => 'application.extensions.mailer.EMailer',
          'pathViews' => 'application.views.email',
          'pathLayouts' => 'application.views.email.layouts'
       ),
	),
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'zouliming',
//                'ipFilters'=>array('192.168.1.101'),//如果用IP访问,这里需配置相应的IP
        )
    ),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);