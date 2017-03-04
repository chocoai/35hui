<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'',
	// this is used in error pages
	'adminEmail'=>'zouliming888@gmail.com',
	'mapkey'=>"ffab7a19e5ea1d4db89857bb5a171bc6a21c936ae31a819c78ea5d329e5b3a53f4cfdd39ea30d830",//http://test35mag.huihenet.com
    //'mapkey'=>"e427c5ee0a7a728e760385eeeeac409dd042bd42e51e9a478e7cb2f768b1652c338d13f39c8c106c",//http://my35mag.huihenet.com
    "indexpanorama"=>"/panorama/index/panoramaName.txt",//首页全景的文件名保存文件
    'systemAdministrator'=>'administrator',//系统管理员角色 拥有最高权限
    'autoAddOperation'=>TRUE,//自动添加操作到 authItemTable 默认TRUE
    'authMenueCacheFix'=>'navigation_tree_by_maguid_',
    //综合排名
    'orderConfig'=>array(
        'new'=>3090,//新房源
        'daycut'=>103,//按天减&预约刷新+
        'flush'=>103,//刷新加
        'recommend'=>20,//推荐
        'hurry'=>10,//急
        'point'=>30,//积分
        'subpanorama'=>350,//全景房源
        'high'=>430,//优质
        'visit'=>array('50'=>10,'200'=>15,'350'=>10,'500'=>5),//查看次数 (string)key
        'userleve'=>array('1'=>100,'2'=>150,'3'=>200),//用户等级
        'vip'=>100,//vip
    ),
);
