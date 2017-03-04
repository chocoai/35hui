<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'',
	// this is used in error pages
	'adminEmail'=>'webmaster@example.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
    //default city is ShangHai
    'defaultCity'=>35,//9在数据库中对应的是上海,但是这是省。35是城市,详见表35_region
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
	//角色对应列表
	
	'personal'=>1,
	'agent'=>2,
	'company'=>3,
	'mapkey'=>"3117f145e3f0e42657f6a6fcabbe37a929013c19310f4b688a463cc018444c9f8590cb3ef58c8aac",//地图key值

    'buildIndex'=>"build_main",//sphinx楼盘索引名称,返回id为35_systembuildinginfo.sbi_buildingid
    'officeIndex'=>"office_main",//sphinx房源索引名称,返回id为35_officebaseinfo.ob_officeid
    'agentIndex'=>"agent_main",//sphinx经纪人索引名称,返回id为35_uagent.ua_id
    'companyIndex'=>"company_main",//sphinx中介公司索引名称,返回id为35_ucom.uc_id
    'newsIndex'=>"news_main",//sphinx资讯索引名称,返回id为35_news.n_id
);
