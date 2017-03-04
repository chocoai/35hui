<?php
define("DS","/");
define('ROOT',dirname(__FILE__).DS.'..'.DS);
define('PATH_LIB' ,'lib'.DS);
define('PIC_PATH',$_SERVER['DOCUMENT_ROOT']."/../"."upload");//图片文件夹的物理路径
define("RECYCLE", PIC_PATH.DS."recycle");
define("_PANORAMA", DS."panorama");
define('ERROR_DATA',"错误数据");//出错时的提示
define('PATH_COMMON' ,'common'.DS);

/*服务器*/
define('PIC_URL',"http://35upload.my360dibiao.com");//图片的网络路径
define('IMAGE_URL','http://my35mag.huihenet.com/images');//网站素材图片
define("MAINHOST","http://www.my360dibiao.com");//新地标域名
/*服务器*/

define('DEFAULT_HEAD',MAINHOST.'/images/default/head_default.jpg');
define('DEFAULT_AGENT',MAINHOST.'/images/default/default_agent.jpg');
define('DEFAULT_COM',MAINHOST.'/images/default/default_com.jpg');
define('DEFAULT_USER',MAINHOST.'/images/default/default_user.jpg');
define('DEFAULT_BUILD',MAINHOST.'/images/default/build_default.jpg');
?>
