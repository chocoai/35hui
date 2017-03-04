<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);

require_once($yii);
require_once 'protected/components/WebApplication.php';
Yii::createApplication('WebApplication',$config)->run();
