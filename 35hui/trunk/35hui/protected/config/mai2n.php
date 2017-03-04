<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

require(dirname(__FILE__).'/define.php');//加载定义的全局变量
#================================================================
#===加载其他系统模块
require_once(ROOT.PATH_LIB.'EasyDBAccess.php');
require_once(ROOT.PATH_LIB.'Validator.php');
require_once(ROOT.PATH_LIB.'util.php');
require_once(ROOT.PATH_COMMON."common.php");

require_once(ROOT."/../bbs/config/config_ucenter.php");
require_once(ROOT."/../bbs/uc_client/client.php");

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'35Hui',
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
//        'request'=>array(//配置会出现Array to string conversion异常,暂时注释掉
//            'enableCookieValidation'=>true,
//            'enableCsrfValidation'=>true,
//        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'loginUrl' => array('site/login'),
		),
		 'authManager'=>array(
			//enable auth user by roles
            'class'=>'CDbAuthManager',
            'itemTable' => 'authitem',//认证项表名称
            'itemChildTable'=> 'authitemchild',//认证项父子关系
            'assignmentTable' =>'authassignment',//认证项赋权关系
        ),
		'cache'=>array(
             'class'=>'CDummyCache',
        ),
        'db'=>array(
		    'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=swhui',
			'emulatePrepare' => true,
			'username' => 'dev',
			'password' => 'dev',
			'charset' => 'utf8',
			'tablePrefix' => '35_',
			'schemaCachingDuration'=>3600,
// 'enableProfiling'=>true,
		),
		'dbadvert'=>array(
            'class'            => 'CDbConnection' ,
            'connectionString' => 'mysql:host=180.168.35.130;dbname=ultrax',
            'emulatePrepare' => true,
            'username' => 'devtest',
            'password' => 'devtest',
            'charset' => 'utf8',
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CProfileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
                'officesale/<id:\d+>.html'=>'officebaseinfo/saleView',
                'officerent/<id:\d+>.html'=>'officebaseinfo/rentView',
                "officerent/<search:[A-Za-z0-9%-]+>"=>"officebaseinfo/rentIndex",
                'officesale/<search:[A-Za-z0-9%-]+>'=>'officebaseinfo/saleIndex',
                'officesale/*'=>'officebaseinfo/saleIndex',
                "officerent/*"=>"officebaseinfo/rentIndex",
                'office/<id:\d+>.html'=>'officebaseinfo/view',

                'business/<id:\d+>.html'=>'businesscenter/view',
                'business/<search:[A-Za-z0-9%-]+>'=>"businesscenter/index",
                'business/*'=>"businesscenter/index",
                'shangwuzhongxin/<search:[A-Za-z0-9%-]+>'=>"businesscenter/list",
                'shangwuzhongxin/*'=>"businesscenter/list",

                "build/<id:\d+>.html"=>"systembuildinginfo/view",
                "build/*"=>"systembuildinginfo/index",
                "buildlist/<search:[A-Za-z0-9%-]+>"=>"systembuildinginfo/buildlist",
                "buildlist/*"=>"systembuildinginfo/buildlist",
                'shop/<id:\d+>.html'=>'shop/view',
                "shoprent/<search:[A-Za-z0-9%-]+>"=>"shop/rentIndex",
                "shopsale/<search:[A-Za-z0-9%-]+>"=>"shop/sellIndex",
                "shoprent/*"=>"shop/rentIndex",
                "shopsale/*"=>"shop/sellIndex",

                "square/<id:\d+>.html"=>"systembuildinginfo/viewshop",
                "square"=>"systembuildinginfo/shopIndex",
                'sauqrelist/<search:[A-Za-z0-9%-]+>'=>'systembuildinginfo/shopbuildlist',
                'sauqrelist/*'=>'systembuildinginfo/shopbuildlist',

                "news/<nid:\d+>.html"=>"news/newsbyid",

                "zhuzhai/<id:\d+>.html"=>"communitybaseinfo/viewResidence",
                "zhuzhai/*"=>"communitybaseinfo/index",
                "ershoufang/<id:\d+>.html"=>"communitybaseinfo/viewSell",
                "zufang/<id:\d+>.html"=>"communitybaseinfo/viewRent",
                'ershoufang/<search:[A-Za-z0-9%-]+>'=>'communitybaseinfo/sellIndex',
                'zufang/<search:[A-Za-z0-9%-]+>'=>'communitybaseinfo/rentIndex',
                "ershoufang/*"=>"communitybaseinfo/sellIndex",
                "zufang/*"=>"communitybaseinfo/rentIndex",
                'dtershoufang/<search:[A-Za-z0-9%-]+>'=>"communitybaseinfo/dtsellIndex",
                'dtzufang/<search:[A-Za-z0-9%-]+>'=>"communitybaseinfo/dtrentIndex",
                "dtershoufang/*"=>"communitybaseinfo/dtsellIndex",
                "dtzufang/*"=>"communitybaseinfo/dtrentIndex",

                "xiaoqu/<id:\d+>.html"=>"communitybaseinfo/view",
                'xiaoqu/<search:[A-Za-z0-9%-]+>'=>'communitybaseinfo/searchIndex',
                "xiaoqu/*"=>"communitybaseinfo/searchIndex",

                'juagent/<search:[A-Za-z0-9%-]+>'=>'uagent/showuagent',
                "juagent/<uaid:\d+>.html"=>"viewuagent/index",
                "juagent/*"=>"uagent/showuagent",

                'zhongjie/<search:[A-Za-z0-9%-]+>'=>'ucom/showcompany',
                "zhongjie/<ucid:\d+>.html"=>"viewucom/index",
                "zhongjie/*"=>"ucom/showcompany",

                "agentrent/<search:[A-Za-z0-9%-]+>"=>"uagent/officerent",
                'agentrent/*'=>'uagent/officerent',
                "agentsale/<search:[A-Za-z0-9%-]+>"=>"uagent/officesale",
                'agentsale/*'=>'uagent/officesale',
                "agentcreative/<search:[A-Za-z0-9%-]+>"=>"uagent/creativesource",
                'agentcreative/*'=>'uagent/creativesource',
                'agent/<id:\d+>.html'=>'uagent/index',

                'creative/<id:\d+>.html'=>'creativesource/view',
                "creative/<search:[A-Za-z0-9%-]+>"=>"creativesource/index",
                'creative/*'=>'creativesource/index',

                'creativepark/<id:\d+>.html'=>'creativeparkbaseinfo/view',
				"chuangyiyuanqu/<search:[A-Za-z0-9%-]+>"=>"creativeparkbaseinfo/creativelist",
                'chuangyiyuanqu/*'=>'creativeparkbaseinfo/creativelist',
            ),
        ),
	),
    'modules'=>array(
		"manage",
		"api",
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'huihenet',
//                'ipFilters'=>array('192.168.1.101'),//如果用IP访问,这里需配置相应的IP
        )
    ),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);