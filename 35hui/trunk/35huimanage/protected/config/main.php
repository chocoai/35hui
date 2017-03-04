<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
#===加载其他系统模块
require_once(ROOT.PATH_COMMON."common.php");

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'新地标 后台管理系统',
	'language'=>'zh_cn',
	'timeZone' => 'Asia/Shanghai',
	// preloading 'log' component
    //'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
        'application.models.*',
		'application.components.*',
        'application.lib.EasyDBAccess',
        'application.lib.Validator',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
        'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=swhui',
			'emulatePrepare' => true,
			'username' => 'dev',
			'password' => 'dev',
			'charset' => 'utf8',
			'tablePrefix' => '35_',
		),
		'dbadvert'=>array(
            'class'            => 'CDbConnection' ,
            'connectionString' => 'mysql:host=180.168.35.130;dbname=ultrax',
            'emulatePrepare' => true,
            'username' => 'devtest',
            'password' => 'devtest',
            'charset' => 'utf8',
        ),
        'cache'=>array(
            'class'=>'CDummyCache',
         ),
        'authManager'=>array(
            //enable auth user by roles
            'class'=>'CDbAuthManager',
            'itemTable' => 'auth_item',//认证项表名称
            'itemChildTable'=> 'auth_item_child',//认证项父子关系
            'assignmentTable' =>'auth_assignment',//认证项赋权关系
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(/*
//                'officesale/<id:\d+>.html'=>'officebaseinfo/saleView',
//                'officerent/<id:\d+>.html'=>'officebaseinfo/rentView',
//                'officesale/*'=>'officebaseinfo/saleIndex',
//                "officerent/*"=>"officebaseinfo/rentIndex",
                'office/<id:\d+>.html'=>'office/view',
//
//                "business/*"=>"officebaseinfo/businessIndex",
//                "businesssearch/*"=>"officebaseinfo/rentBusinessList",
                "business1/<opid:\d+>.html"=>"officebaseinfo/businessSummarize",//商务中心概述
//                "business2/<opid:\d+>.html"=>"officebaseinfo/businessDetail",//商务中心详情
//                "business3/<opid:\d+>.html"=>"officebaseinfo/businessIchnography",//平面图
//                "business4/<opid:\d+>.html"=>"officebaseinfo/businessOtherPicture",//房源照片
//                "business5/<opid:\d+>.html"=>"officebaseinfo/businessComments",//点评
//                "business6/<opid:\d+>.html"=>"officebaseinfo/allBusinessComments",//所有商务中心评论

                "build/<id:\d+>.html"=>"systembuildinginfo/view",
//                "build/*"=>"systembuildinginfo/index",
//                "buildlist/*"=>"systembuildinginfo/buildlist",

                'shop/<id:\d+>.html'=>'shop/view',
//                "shoprent/*"=>"shop/rentIndex",
//                "shopsale/*"=>"shop/sellIndex",

                "square/<id:\d+>.html"=>"systembuildinginfo/viewshop",
//                "square"=>"systembuildinginfo/shopIndex",
//                'sauqrelist/*'=>'systembuildinginfo/shopbuildlist',
//
//                "news/<nid:\d+>.html"=>"news/newsbyid"*/
            ),
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				'routes'=>array(
                    array(
                        'class'=>'CWebLogRoute',
                        'levels'=>'trace, info, error, warning',
                        'categories'=>'cn.sl.*,system.db.*',
                    ),
				*/
			),
		),
        'DRedirect'=>array(
                    'class'=>'ext.DRedirect',
        ),
		'CFile'=>array(
                    'class'=>'ext.CFile',
		),
	),
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'huihenet',
            //'ipFilters'=>array('192.168.1.101'),//如果用IP访问,这里需配置相应的IP
        )
    ),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);