<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'',
	// this is used in error pages
	'adminEmail'=>'account@360dibiao.com',
	// number of posts displayed per page
	'postsPerPage'=>20,
    //default city is ShangHai
    'defaultCity'=>35,//9在数据库中对应的是上海,但是这是省。35是城市,详见表35_region
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
	//APC缓存时间
	'duration'=>"1800",
    'dataDurationIndex'=>'1800',//综合页面数据缓存
    'dataDurationView'=>'1800',
    //角色对应列表
	'personal'=>1,
	'agent'=>2,
	'company'=>3,
	//'mapkey'=>"b92dc455b280de13cdc752a12a54e441c6e4c830518463e8f03a781d674dae2d8943aeffa0ec05a5",//http://www.test360dibiao.com
    'mapkey'=>"b97cd31f511a53ab7d45acbe5ecd6efb2ab0cea401342defd927e9452dc6779bec4bb94308fbe0a0",//http://www.my360dibiao.com
    "indexpanorama"=>"/panorama/index/panoramaName.txt",//首页全景的文件名保存文件

    'buildIndex'=>"build_main",//sphinx楼盘索引名称,返回id为35_systembuildinginfo.sbi_buildingid
    'officeIndex'=>"office_main",//sphinx房源索引名称,返回id为35_officebaseinfo.ob_officeid
    'agentIndex'=>"agent_main",//sphinx经纪人索引名称,返回id为35_uagent.ua_id
    'companyIndex'=>"company_main",//sphinx中介公司索引名称,返回id为35_ucom.uc_id
    'newsIndex'=>"news_main",//sphinx资讯索引名称,返回id为35_news.n_id
    'shopIndex'=>"shop_main",//sphinx商铺索引名称,返回id为35_shopbaseinfo.sb_shopid
    'communityIndex'=>"community_main",//sphinx小区索引名称,返回id为35_communitybaseinfo.comy_id
    'residenceIndex'=>"residence_main",//sphinx住宅索引名称,返回id为35_residencebaseinfo.rbi_id
	'businessIndex'=>"business_main",//sphinx商务中心索引名称,返回id为35_businesscenter.bc_id
    'creativeParkIndex'=>"creative_main",//sphinx创意园区索引名称,返回id为35_creativeparkbaseinfo.cp_id
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
