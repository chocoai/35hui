<?php
define('DS','/');
define('ROOT',dirname(__FILE__).DS.'..'.DS);
define('PATH_LIB' ,'lib'.DS);
define('PATH_COMMON' ,'common'.DS);

/* 服务器配置*/
define('PIC_PATH',$_SERVER['DOCUMENT_ROOT']."/../upload");//上传图片文件夹的物理路径
define('DOMAIN',"http://www.my360dibiao.com");//------服务器
define('IMAGE_URL','http://www.my360dibiao.com/images');//网站素材图片-----服务器
define('PIC_URL',"http://35upload.my360dibiao.com");//上传图片的网络路径--------服务器
define("JS_DOMAIN","my360dibiao.com");//js域
define("BBS_DOMAIN","http://www.my360dibiao.com/bbs");//bbs
/* 服务器配置 */

define('DEFAULT_HEAD',IMAGE_URL.'/default/head_default.jpg');
define('DEFAULT_AGENT',IMAGE_URL.'/default/default_agent.jpg');
define('DEFAULT_COM',IMAGE_URL.'/default/default_com.jpg');
define('DEFAULT_NORMAL',IMAGE_URL.'/default/default_normal.gif');
define('DEFAULT_USER',IMAGE_URL.'/default/default_user.jpg');
define('DEFAULT_BUILD',IMAGE_URL.'/default/build_default.jpg');
?>