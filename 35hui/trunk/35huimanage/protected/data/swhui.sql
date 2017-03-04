/*
SQLyog Trial v8.3 
MySQL - 5.1.43-community : Database - swhui
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`swhui` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `swhui`;

/*Table structure for table `35_areacoordinates` */

DROP TABLE IF EXISTS `35_areacoordinates`;

CREATE TABLE `35_areacoordinates` (
  `rp_id` int(10) NOT NULL COMMENT '主键id',
  `rp_regionid` int(10) NOT NULL COMMENT '关联地区id',
  `rp_type` tinyint(2) NOT NULL COMMENT '关联表类型1地区表2地铁表',
  `rp_x` varchar(200) NOT NULL DEFAULT '' COMMENT 'x坐标',
  `rp_y` varchar(200) NOT NULL DEFAULT '' COMMENT 'y坐标',
  `rp_buildname` varchar(200) NOT NULL DEFAULT '' COMMENT '建筑名称',
  PRIMARY KEY (`rp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='区域坐标表';

/*Data for the table `35_areacoordinates` */

/*Table structure for table `35_bargindata` */

DROP TABLE IF EXISTS `35_bargindata`;

CREATE TABLE `35_bargindata` (
  `bar_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id,主键',
  `bar_area` double NOT NULL COMMENT '成交面积',
  `bar_sale` int(11) NOT NULL COMMENT '成交套数',
  `bar_price` float NOT NULL COMMENT '成交价格',
  `bar_state` tinyint(3) unsigned zerofill NOT NULL COMMENT '成交方式,1表示出售，0表示出租',
  `bar_date` date NOT NULL COMMENT '成交日期',
  `bar_address` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '区域，地址',
  `bar_type` tinyint(4) NOT NULL COMMENT '成交类型，1表示写字楼，0表示土地',
  PRIMARY KEY (`bar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `35_bargindata` */

insert  into `35_bargindata`(`bar_id`,`bar_area`,`bar_sale`,`bar_price`,`bar_state`,`bar_date`,`bar_address`,`bar_type`) values (1,25,25,10000,001,'2010-07-05','aaa',1),(2,22,12,88686,000,'2010-07-14','bbb',1);

/*Table structure for table `35_businessbaseinfo` */

DROP TABLE IF EXISTS `35_businessbaseinfo`;

CREATE TABLE `35_businessbaseinfo` (
  `bb_businessid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bb_sysid` int(11) DEFAULT NULL,
  `bb_uid` int(11) unsigned NOT NULL,
  `bb_businesstype` int(11) NOT NULL,
  `bb_province` int(10) NOT NULL,
  `bb_city` int(10) NOT NULL,
  `bb_businessaddress` varchar(200) NOT NULL,
  `bb_buildingarea` float NOT NULL,
  `bb_businessprice` float NOT NULL,
  `bb_propertytype` int(11) NOT NULL,
  `bb_companytype` int(11) NOT NULL,
  `bb_registerfunds` float NOT NULL,
  `bb_mainservice` varchar(100) DEFAULT NULL,
  `bb_turnoverly` float DEFAULT NULL,
  `bb_profitly` float DEFAULT NULL,
  `bb_salestaxly` float DEFAULT NULL,
  `bb_incometaxly` float DEFAULT NULL,
  `bb_runtime` float DEFAULT NULL,
  `bb_consumptionperson` float DEFAULT NULL,
  `bb_staffnum` float DEFAULT NULL,
  `bb_vipnum` int(11) DEFAULT NULL,
  `bb_stocktransfer` float DEFAULT NULL,
  `bb_releasedate` int(11) NOT NULL,
  `bb_expiredate` int(11) DEFAULT NULL,
  PRIMARY KEY (`bb_businessid`),
  KEY `FK_UID004` (`bb_uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_businessbaseinfo` */

insert  into `35_businessbaseinfo`(`bb_businessid`,`bb_sysid`,`bb_uid`,`bb_businesstype`,`bb_province`,`bb_city`,`bb_businessaddress`,`bb_buildingarea`,`bb_businessprice`,`bb_propertytype`,`bb_companytype`,`bb_registerfunds`,`bb_mainservice`,`bb_turnoverly`,`bb_profitly`,`bb_salestaxly`,`bb_incometaxly`,`bb_runtime`,`bb_consumptionperson`,`bb_staffnum`,`bb_vipnum`,`bb_stocktransfer`,`bb_releasedate`,`bb_expiredate`) values (1,NULL,56,11,22,33,'33',33,33,1,0,33,'33',33,44,0,0,0,0,0,0,0,0,0),(2,NULL,53,1,12,2,'12321',1321,312,2,16,123,'',0,0,0,0,0,0,0,0,0,2010,2010);

/*Table structure for table `35_businesscomment` */

DROP TABLE IF EXISTS `35_businesscomment`;

CREATE TABLE `35_businesscomment` (
  `bc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bc_cid` int(11) unsigned NOT NULL,
  `bc_businessid` int(11) unsigned NOT NULL,
  `bc_traffice` int(11) NOT NULL,
  `bc_facility` int(11) NOT NULL,
  `bc_adorn` int(11) NOT NULL,
  `bc_comment` varchar(200) NOT NULL,
  `bc_comdate` int(11) NOT NULL,
  PRIMARY KEY (`bc_id`),
  KEY `FK_UID000021` (`bc_cid`) USING BTREE,
  KEY `FK_BID0005` (`bc_businessid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_businesscomment` */

/*Table structure for table `35_businesspresentinfo` */

DROP TABLE IF EXISTS `35_businesspresentinfo`;

CREATE TABLE `35_businesspresentinfo` (
  `bp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bp_businessid` int(11) unsigned NOT NULL,
  `bp_businesstitle` varchar(50) NOT NULL,
  `bp_serialnum` varchar(50) DEFAULT NULL,
  `bp_businessdesc` text NOT NULL,
  `bp_traffice` varchar(50) DEFAULT NULL,
  `bp_carparking` varchar(50) DEFAULT NULL,
  `bp_facilityaround` varchar(50) DEFAULT NULL,
  `bp_titlepicurl` int(11) DEFAULT NULL,
  PRIMARY KEY (`bp_id`),
  KEY `FK_BID` (`bp_businessid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_businesspresentinfo` */

insert  into `35_businesspresentinfo`(`bp_id`,`bp_businessid`,`bp_businesstitle`,`bp_serialnum`,`bp_businessdesc`,`bp_traffice`,`bp_carparking`,`bp_facilityaround`,`bp_titlepicurl`) values (1,1,'44','000000000','','','','',NULL),(2,2,'dad','000000000','asd','','','',NULL);

/*Table structure for table `35_businessrentinfo` */

DROP TABLE IF EXISTS `35_businessrentinfo`;

CREATE TABLE `35_businessrentinfo` (
  `br_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `br_businessid` int(11) unsigned NOT NULL,
  `br_rentprice` float NOT NULL,
  `br_iscontainprocost` int(11) NOT NULL,
  `br_renttype` int(11) NOT NULL,
  `br_payway` int(11) NOT NULL,
  `br_basetime` float NOT NULL,
  PRIMARY KEY (`br_id`),
  KEY `FK_BID002` (`br_businessid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_businessrentinfo` */

insert  into `35_businessrentinfo`(`br_id`,`br_businessid`,`br_rentprice`,`br_iscontainprocost`,`br_renttype`,`br_payway`,`br_basetime`) values (1,1,44,0,0,0,44);

/*Table structure for table `35_businessrequire` */

DROP TABLE IF EXISTS `35_businessrequire`;

CREATE TABLE `35_businessrequire` (
  `br_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `br_uid` int(11) unsigned NOT NULL,
  `br_province` int(11) NOT NULL,
  `br_city` int(11) NOT NULL,
  `br_district` int(11) DEFAULT NULL,
  `br_address` varchar(200) NOT NULL,
  `br_title` varchar(50) NOT NULL,
  `br_desc` text,
  `br_sellbrrent` int(11) NOT NULL,
  `br_releasedate` int(11) NOT NULL,
  `br_expiredate` int(4) NOT NULL,
  PRIMARY KEY (`br_id`),
  KEY `FK_UID0008` (`br_uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_businessrequire` */

/*Table structure for table `35_businesssellinfo` */

DROP TABLE IF EXISTS `35_businesssellinfo`;

CREATE TABLE `35_businesssellinfo` (
  `bs_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bs_businessid` int(11) unsigned NOT NULL,
  `bs_sellprice` float NOT NULL,
  PRIMARY KEY (`bs_id`),
  KEY `FK_BID003` (`bs_businessid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_businesssellinfo` */

insert  into `35_businesssellinfo`(`bs_id`,`bs_businessid`,`bs_sellprice`) values (1,2,1321);

/*Table structure for table `35_businesstag` */

DROP TABLE IF EXISTS `35_businesstag`;

CREATE TABLE `35_businesstag` (
  `bt_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bt_businessid` int(11) unsigned NOT NULL,
  `bt_ishigh` int(11) DEFAULT '0',
  `bt_isrecommend` int(11) DEFAULT '0',
  `bt_ishomepage` int(11) DEFAULT '0',
  `bt_isvideo` int(11) DEFAULT '0',
  `bt_is3d` int(11) DEFAULT '0',
  `bt_isconsign` int(11) DEFAULT '0',
  `bt_consignid` int(11) DEFAULT '-1',
  `bt_isnew` int(11) DEFAULT '0',
  `bt_ishurry` int(11) DEFAULT '0',
  `bt_check` int(11) NOT NULL,
  PRIMARY KEY (`bt_id`),
  KEY `FK_BID004` (`bt_businessid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='			';

/*Data for the table `35_businesstag` */

insert  into `35_businesstag`(`bt_id`,`bt_businessid`,`bt_ishigh`,`bt_isrecommend`,`bt_ishomepage`,`bt_isvideo`,`bt_is3d`,`bt_isconsign`,`bt_consignid`,`bt_isnew`,`bt_ishurry`,`bt_check`) values (1,1,2,2,2,2,2,2,-1,2,1,2),(2,2,2,2,2,2,2,2,-1,2,1,64);

/*Table structure for table `35_buyproduct` */

DROP TABLE IF EXISTS `35_buyproduct`;

CREATE TABLE `35_buyproduct` (
  `sp_id` int(10) NOT NULL DEFAULT '0' COMMENT '主键',
  `sp_positionid` int(10) NOT NULL DEFAULT '0' COMMENT '关联position位置id',
  `sp_sourceid` int(10) unsigned zerofill NOT NULL COMMENT '资源id',
  `sp_onlinetime` int(10) NOT NULL DEFAULT '0' COMMENT '上线时间',
  `sp_exptime` int(10) NOT NULL DEFAULT '0' COMMENT '能在线时间',
  `sp_state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态 0排队1上线2下线',
  `sp_recodetime` int(10) NOT NULL DEFAULT '0' COMMENT '购买时间',
  PRIMARY KEY (`sp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户购买精品表';

/*Data for the table `35_buyproduct` */

/*Table structure for table `35_comment` */

DROP TABLE IF EXISTS `35_comment`;

CREATE TABLE `35_comment` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `n_id` int(11) NOT NULL COMMENT '新闻id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `c_comment` text COMMENT '新闻评论',
  `c_date` datetime NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `35_comment` */

insert  into `35_comment`(`c_id`,`n_id`,`user_id`,`c_comment`,`c_date`) values (1,1,51,'fasddsafsafsfas','2010-07-20 16:34:02'),(2,1,51,'gfdfgsgfds','2010-07-20 16:34:30'),(3,1,33,'fdsfasdfa','2010-07-19 16:34:33'),(4,1,33,'dsafsda','2010-07-21 16:34:40');

/*Table structure for table `35_factorybaseinfo` */

DROP TABLE IF EXISTS `35_factorybaseinfo`;

CREATE TABLE `35_factorybaseinfo` (
  `fb_factoryid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fb_uid` int(11) unsigned NOT NULL,
  `fb_province` int(10) NOT NULL,
  `fb_city` int(10) NOT NULL,
  `fb_factoryname` varchar(50) NOT NULL,
  `fb_district` int(10) NOT NULL,
  `fb_section` int(10) NOT NULL,
  `fb_loop` int(10) DEFAULT NULL,
  `fb_tradecircle` int(10) DEFAULT NULL,
  `fb_busway` varchar(200) DEFAULT NULL,
  `fb_propertyinfo` int(11) NOT NULL,
  `fb_buildingarea` float NOT NULL,
  `fb_coverarea` float DEFAULT NULL,
  `fb_sparearea` float DEFAULT NULL,
  `fb_buildingage` varchar(20) DEFAULT NULL,
  `fb_plotratio` float DEFAULT NULL,
  `fb_greenratio` float DEFAULT NULL,
  `fb_suittrade` int(11) NOT NULL,
  `fb_factorytype` int(11) NOT NULL,
  `fb_floor` int(11) DEFAULT NULL,
  `fb_structure` int(11) DEFAULT NULL,
  `fb_crane` float DEFAULT NULL,
  `fb_loadbearing` float DEFAULT NULL,
  `fb_elecpower` float DEFAULT NULL,
  `fb_water` float DEFAULT NULL,
  `fb_adrondegree` int(11) DEFAULT NULL,
  `fb_communication` varchar(50) DEFAULT NULL,
  `fb_facilityaround` varchar(200) DEFAULT NULL,
  `fb_facilityindoor` varchar(200) DEFAULT NULL,
  `fb_sellorrent` int(11) NOT NULL,
  `fb_releasedate` int(11) NOT NULL,
  `fb_expiredate` int(11) DEFAULT NULL,
  PRIMARY KEY (`fb_factoryid`),
  KEY `FK_UID005` (`fb_uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_factorybaseinfo` */

insert  into `35_factorybaseinfo`(`fb_factoryid`,`fb_uid`,`fb_province`,`fb_city`,`fb_factoryname`,`fb_district`,`fb_section`,`fb_loop`,`fb_tradecircle`,`fb_busway`,`fb_propertyinfo`,`fb_buildingarea`,`fb_coverarea`,`fb_sparearea`,`fb_buildingage`,`fb_plotratio`,`fb_greenratio`,`fb_suittrade`,`fb_factorytype`,`fb_floor`,`fb_structure`,`fb_crane`,`fb_loadbearing`,`fb_elecpower`,`fb_water`,`fb_adrondegree`,`fb_communication`,`fb_facilityaround`,`fb_facilityindoor`,`fb_sellorrent`,`fb_releasedate`,`fb_expiredate`) values (1,56,0,0,'dfsdf',0,0,NULL,0,'',1,12,0,0,'',0,0,1,1,1,1,0,0,0,0,0,'','','',1,2010,0);

/*Table structure for table `35_factorycomment` */

DROP TABLE IF EXISTS `35_factorycomment`;

CREATE TABLE `35_factorycomment` (
  `fc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fc_cid` int(11) unsigned NOT NULL,
  `fc_factoryid` int(11) unsigned NOT NULL,
  `fc_traffice` int(11) NOT NULL,
  `fc_facility` int(11) NOT NULL,
  `fc_adorn` int(11) NOT NULL,
  `fc_comment` varchar(200) NOT NULL,
  `fc_comdate` int(11) NOT NULL,
  PRIMARY KEY (`fc_id`),
  KEY `FIK_UID00022` (`fc_cid`) USING BTREE,
  KEY `FK_FID0005` (`fc_factoryid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_factorycomment` */

/*Table structure for table `35_factorypresentinfo` */

DROP TABLE IF EXISTS `35_factorypresentinfo`;

CREATE TABLE `35_factorypresentinfo` (
  `fp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fp_factoryid` int(11) unsigned NOT NULL,
  `fp_factorytitle` varchar(50) NOT NULL,
  `fp_serialnum` varchar(50) DEFAULT NULL,
  `fp_factorydesc` text,
  `fp_traffice` varchar(50) DEFAULT NULL,
  `fp_carparking` varchar(50) DEFAULT NULL,
  `fp_facilityaround` varchar(200) DEFAULT NULL,
  `fp_titlepicurl` int(11) DEFAULT NULL,
  PRIMARY KEY (`fp_id`),
  KEY `FK_FID001` (`fp_factoryid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_factorypresentinfo` */

insert  into `35_factorypresentinfo`(`fp_id`,`fp_factoryid`,`fp_factorytitle`,`fp_serialnum`,`fp_factorydesc`,`fp_traffice`,`fp_carparking`,`fp_facilityaround`,`fp_titlepicurl`) values (1,1,'df','000000000','','','','',NULL);

/*Table structure for table `35_factoryrentinfo` */

DROP TABLE IF EXISTS `35_factoryrentinfo`;

CREATE TABLE `35_factoryrentinfo` (
  `fr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fr_factoryid` int(11) unsigned NOT NULL,
  `fr_rentprice` float NOT NULL,
  `fr_iscontainprocost` int(11) NOT NULL,
  `fr_renttype` int(11) NOT NULL,
  `fr_payway` int(11) NOT NULL,
  `fr_basetime` float NOT NULL,
  PRIMARY KEY (`fr_id`),
  KEY `FK_FID002` (`fr_factoryid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_factoryrentinfo` */

/*Table structure for table `35_factoryrequire` */

DROP TABLE IF EXISTS `35_factoryrequire`;

CREATE TABLE `35_factoryrequire` (
  `fr_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '''',
  `fr_uid` int(11) unsigned NOT NULL,
  `fr_province` int(11) NOT NULL,
  `fr_city` int(11) NOT NULL,
  `fr_district` int(11) DEFAULT NULL,
  `fr_address` varchar(200) DEFAULT NULL,
  `fr_factorytype` int(11) NOT NULL,
  `fr_factoryareamin` float NOT NULL,
  `fr_factoryareamax` float NOT NULL,
  `fr_facility` varchar(200) DEFAULT NULL,
  `fr_title` varchar(50) NOT NULL,
  `fr_desc` text,
  `fr_sellorrent` int(11) NOT NULL,
  `fr_costmin` float NOT NULL,
  `fr_costmax` float NOT NULL,
  `fr_releasedate` int(11) NOT NULL,
  `fr_expiredate` int(11) NOT NULL,
  PRIMARY KEY (`fr_id`),
  KEY `FK_UID0009` (`fr_uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_factoryrequire` */

/*Table structure for table `35_factorysellinfo` */

DROP TABLE IF EXISTS `35_factorysellinfo`;

CREATE TABLE `35_factorysellinfo` (
  `fs_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fs_factoryid` int(11) unsigned NOT NULL,
  `fs_sellprice` float NOT NULL,
  PRIMARY KEY (`fs_id`),
  KEY `FK_FID003` (`fs_factoryid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_factorysellinfo` */

insert  into `35_factorysellinfo`(`fs_id`,`fs_factoryid`,`fs_sellprice`) values (1,1,23);

/*Table structure for table `35_factorytag` */

DROP TABLE IF EXISTS `35_factorytag`;

CREATE TABLE `35_factorytag` (
  `ft_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ft_factoryid` int(11) unsigned NOT NULL,
  `ft_ishigh` int(11) DEFAULT '0',
  `ft_isrecommend` int(11) DEFAULT '0',
  `ft_ishomepage` int(11) DEFAULT '0',
  `ft_isvideo` int(11) DEFAULT '0',
  `ft_is3d` int(11) DEFAULT '0',
  `ft_isconsign` int(11) DEFAULT '0',
  `ft_consignid` int(11) DEFAULT '-1',
  `ft_isnew` int(11) DEFAULT '0',
  `ft_ishurry` int(11) DEFAULT '0',
  `ft_check` int(11) NOT NULL,
  PRIMARY KEY (`ft_id`),
  KEY `FK_FID004` (`ft_factoryid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_factorytag` */

insert  into `35_factorytag`(`ft_id`,`ft_factoryid`,`ft_ishigh`,`ft_isrecommend`,`ft_ishomepage`,`ft_isvideo`,`ft_is3d`,`ft_isconsign`,`ft_consignid`,`ft_isnew`,`ft_ishurry`,`ft_check`) values (1,1,2,2,2,2,2,2,-1,2,2,0);

/*Table structure for table `35_feadback_messages` */

DROP TABLE IF EXISTS `35_feadback_messages`;

CREATE TABLE `35_feadback_messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cellphone` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `post_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_feadback_messages` */

/*Table structure for table `35_findcondition` */

DROP TABLE IF EXISTS `35_findcondition`;

CREATE TABLE `35_findcondition` (
  `fc_id` int(10) unsigned NOT NULL COMMENT '主键',
  `fc_puserid` int(10) unsigned DEFAULT NULL COMMENT '普通用户表外键id',
  `fc_officetype` tinyint(1) unsigned DEFAULT NULL COMMENT '房源类型',
  `fc_rentorsell` tinyint(1) unsigned DEFAULT NULL COMMENT '租或售',
  `fc_conditionstr` varchar(500) DEFAULT NULL COMMENT '条件协议',
  `fc_recordtime` int(10) unsigned DEFAULT NULL COMMENT '入库时间',
  PRIMARY KEY (`fc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_findcondition` */

insert  into `35_findcondition`(`fc_id`,`fc_puserid`,`fc_officetype`,`fc_rentorsell`,`fc_conditionstr`,`fc_recordtime`) values (7,11,1,1,'{\"loop\":\"17\",\"source\":\"57\",\"area\":\"8\"}',1281342818),(8,11,1,1,'{\"rPrice\":\"32\",\"fitment\":\"53\",\"source\":\"57\",\"loop\":\"17\"}',1281416195);

/*Table structure for table `35_housecollect` */

DROP TABLE IF EXISTS `35_housecollect`;

CREATE TABLE `35_housecollect` (
  `hc_id` int(10) unsigned NOT NULL COMMENT '主键',
  `hc_puserid` int(10) unsigned DEFAULT NULL COMMENT '普通用户表的外键id',
  `hc_officetype` tinyint(1) unsigned DEFAULT NULL COMMENT '房源类型',
  `hc_presentid` int(10) unsigned DEFAULT NULL COMMENT '房源id',
  `hc_rentorsell` tinyint(1) unsigned DEFAULT NULL COMMENT '租或售',
  `hc_recordtime` int(10) unsigned DEFAULT NULL COMMENT '入库时间',
  PRIMARY KEY (`hc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_housecollect` */

insert  into `35_housecollect`(`hc_id`,`hc_puserid`,`hc_officetype`,`hc_presentid`,`hc_rentorsell`,`hc_recordtime`) values (8,11,1,3,1,1281514115),(9,11,1,4,1,1281518830),(10,11,2,3,1,1281520124),(11,11,2,4,1,1281520134);

/*Table structure for table `35_impression` */

DROP TABLE IF EXISTS `35_impression`;

CREATE TABLE `35_impression` (
  `im_id` int(10) unsigned NOT NULL COMMENT '主键',
  `im_sourceid` int(10) unsigned DEFAULT NULL COMMENT '房源id',
  `im_sourcetype` int(10) unsigned DEFAULT NULL COMMENT '房源类型',
  `im_description` varchar(50) DEFAULT NULL COMMENT '印象描述',
  `im_pro` int(10) unsigned DEFAULT '0' COMMENT '支持次数',
  PRIMARY KEY (`im_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_impression` */

insert  into `35_impression`(`im_id`,`im_sourceid`,`im_sourcetype`,`im_description`,`im_pro`) values (1,1,1,'还行',1),(2,1,1,'不错',0),(3,1,1,'信春哥,得永生.春哥纯爷们,铁血真汉子.',0),(4,1,1,'非常差啊.!简直不可以相信',0),(5,1,1,'我认为还不错.',0),(7,1,1,'爱爱爱',0),(8,1,1,'爱爱爱',0),(9,1,1,'爱爱爱',0),(10,1,1,'爱爱爱',0),(11,1,1,'爱爱爱',0),(12,1,1,'爱爱爱',0),(13,1,1,'水电费多方式发',0),(14,1,1,'啊啊',0),(15,1,1,'1',0),(16,1,1,'2',0),(17,1,1,'3',0),(18,1,1,'very good.',0),(19,1,1,'你猜啊.',0),(20,1,1,'哈哈.非常好',0),(21,1,1,'哎.',0),(22,1,1,'长江后浪推前浪',0),(23,1,1,'我是真的不知道啊',0),(24,1,1,'我操',0),(25,1,1,'shit',0),(26,1,1,'b',0),(27,1,1,'ddfs',0),(28,1,1,'fdsf',0),(29,1,1,'fdsf',0),(30,1,1,'fdsf',0),(31,1,1,'fsfs',0),(32,1,1,'dfsd',0),(33,1,1,'aaa',0),(34,1,1,'ffff',0),(35,1,1,'eee',0),(36,1,1,'sss',0),(37,1,1,'eee',0),(38,1,1,'jjj',0),(39,1,1,'cccc',0),(40,1,1,'我操',0),(41,1,1,'法教科书了费了框架',0),(42,1,1,'我顶你个肺',0),(43,1,1,'猴子爱吃香蕉',0),(44,2,1,'哈哈.沙发',0);

/*Table structure for table `35_kefu_customerlist` */

DROP TABLE IF EXISTS `35_kefu_customerlist`;

CREATE TABLE `35_kefu_customerlist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kefu_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `new_message` varchar(10) NOT NULL,
  `last_request_time` datetime NOT NULL,
  `evaluation` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_kefu_customerlist` */

/*Table structure for table `35_log` */

DROP TABLE IF EXISTS `35_log`;

CREATE TABLE `35_log` (
  `lg_id` int(10) NOT NULL COMMENT '主键',
  `lg_userid` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `lg_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型1精品',
  `lg_scores` int(10) NOT NULL DEFAULT '0' COMMENT '所花费积分',
  `lg_describe` text NOT NULL COMMENT '描述',
  `lg_recodetime` int(10) NOT NULL DEFAULT '0' COMMENT '操做时间',
  PRIMARY KEY (`lg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户操作日志表';

/*Data for the table `35_log` */

/*Table structure for table `35_lookup` */

DROP TABLE IF EXISTS `35_lookup`;

CREATE TABLE `35_lookup` (
  `lp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lp_name` varchar(128) NOT NULL,
  `lp_code` varchar(128) NOT NULL,
  `lp_type` varchar(128) NOT NULL,
  `lp_pos` int(11) NOT NULL,
  PRIMARY KEY (`lp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `35_lookup` */

insert  into `35_lookup`(`lp_id`,`lp_name`,`lp_code`,`lp_type`,`lp_pos`) values (1,'餐饮美食( 包括中餐、西餐、小吃、咖啡、茶坊、熟食、面包房、快餐、奶茶铺 )','1','businesstype',1),(10,'国内合资','3','companytype',3),(11,'中外合资','4','companytype',4),(12,'外方独资','5','companytype',5),(13,'整租','1','renttype',1),(14,'合租','2','renttype',2),(15,'其他','3','renttype',3),(16,'面议','1','payway',1),(17,'一次性','2','payway',2),(18,'按揭','3','payway',3),(19,'是','1','judgenum',1),(2,'娱乐休闲( 包括夜总会、酒吧、KTV歌城、足浴、桑拿、会所、健身中心、网吧、美容美发、游艺厅 )','2','businesstype',2),(20,'否','0','judgenum',2),(21,'是','y','judgelettler',1),(22,'否','n','judgelettler',2),(3,'百货零售( 包括服装店、鞋店、超市、大卖场、便利店、医药店、婚纱店、母婴用品店、烟酒店、眼镜店、文具店 )','3','businesstype',3),(4,'公司工厂','4','businesstype',4),(5,'其他服务业 ( 包括宾馆酒店、文化教育、洗衣清洁、维修配件、宠物、房产中介、电脑复印、旅行社、人才中介、法律服务、养老院、摄影店、会计服务 )','5','businesstype',5),(6,'租赁','0','propertytype',1),(7,'自有','1','propertytype',2),(8,'个体工商户','1','companytype',1),(9,'个人独资','2','companytype',2),(23,'商务中心','1','officebuildingtype',1),(24,'创意办公室','2','officebuildingtype',2),(25,'写字楼','3','officebuildingtype',3),(26,'商住楼','1','officetype',1),(27,'纯写字楼','2','officetype',2),(28,'商业综合体楼','3','officetype',3),(29,'酒店写字楼','4','officetype',4),(30,'豪华装','1','adrondegree',1),(31,'精装修','2','adrondegree',2),(32,'中装修','3','adrondegree',3),(33,'简装修','4','adrondegree',4),(34,'毛坯','5','adrondegree',5),(35,'甲级','1','officedegree',1),(36,'乙级','2','officedegree',2),(37,'丙级','3','officedegree',3),(38,'住宅底商','1','shoptype',1),(39,'商业街商铺','2','shoptype',2),(40,'酒店底商','3','shoptype',3),(41,'旅游商铺','4','shoptype',4),(42,'社区商铺','5','shoptype',5),(43,'沿街门脸','6','shoptype',6),(44,'写字楼配套底商','7','shoptype',7),(45,'购物中心/综合体卖场','8','shoptype',8),(46,'店铺','1','selltype',1),(47,'摊位','2','selltype',2),(48,'柜台','3','selltype',3),(49,'限价房','1','propertyinfo',1),(50,'央产房','2','propertyinfo',2),(51,'个人产权','3','propertyinfo',3),(52,'使用权','4','propertyinfo',4),(53,'单位产权','5','propertyinfo',5),(54,'经济适用房','6','propertyinfo',6),(55,'军产房','7','propertyinfo',7),(56,'加工制造业','1','suittrade',1),(57,'物流仓储业','2','suittrade',2),(58,'电子信息业','3','suittrade',3),(59,'科研业','4','suittrade',4),(60,'冶炼业','5','suittrade',5),(61,'农牧种植业','6','suittrade',6),(62,'化工行业','7','suittrade',7),(63,'医疗行业','8','suittrade',8),(64,'其他','9','suittrade',9),(65,'厂房','1','factorytype',1),(66,'仓库','2','factorytype',2),(67,'土地','3','factorytype',3),(68,'研发大楼','4','factorytype',4),(69,'其他','5','factorytype',5),(70,'单层','1','floor',1),(71,'双层','2','floor',2),(72,'多层','3','floor',3),(73,'其他','4','floor',4),(74,'框架','1','structure',1),(75,'砖混','2','structure',2),(76,'砖木','3','structure',3),(77,'剪力墙','4','structure',4),(78,'框架剪力墙','5','structure',5),(79,'钢','6','structure',6),(80,'出租','1','transactionway',1),(81,'出售','2','transactionway',2),(82,'合作','3','transactionway',3),(83,'出租','0','sorrtype',1),(84,'出售','1','sorrtype',2),(85,'好','2','judgecomment',1),(86,'中','1','judgecomment',2),(87,'差','0','judgecomment',3),(88,'求租','0','reqsrtype',1),(89,'求购','1','reqsrtype',2),(90,'出租','0','relsrtype',1),(91,'出售','1','relsrtype',2),(92,'写字楼','1','usetype',1),(93,'店铺','2','usetype',2),(94,'厂房','3','usetype',3),(95,'生意转让','4','usetype',4),(96,'大型项目','5','usetype',5),(100,'回收站','2','fangyuanstatus',2),(101,'下线','3','fangyuanstatus',3),(102,'已发布','4','fangyuanstatus',4),(103,'未通过审核','5','fangyuanstatus',5),(104,'审核中','6','fangyuanstatus',6),(105,'已提交','7','fangyuanstatus',8),(106,'草稿','8','fangyuanstatus',0),(97,'提交','submited','infostatus',1),(98,'草稿','sketch','infostatus',2),(99,'已删除','1','fangyuanstatus',1);

/*Table structure for table `35_managemenu` */

DROP TABLE IF EXISTS `35_managemenu`;

CREATE TABLE `35_managemenu` (
  `m_id` int(10) unsigned NOT NULL COMMENT '菜单主键',
  `m_name` varchar(100) DEFAULT NULL COMMENT '菜单名称',
  `m_link` varchar(200) DEFAULT NULL COMMENT '菜单链接',
  `m_parentid` int(10) unsigned DEFAULT NULL COMMENT '菜单父键',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_managemenu` */

insert  into `35_managemenu`(`m_id`,`m_name`,`m_link`,`m_parentid`) values (1,'会员管理','',0),(2,'房源管理','',0),(3,'精选房源管理',NULL,0),(4,'快速登记管理',NULL,0),(5,'咨询管理',NULL,0),(6,'系统设置',NULL,0),(7,'经纪人管理',NULL,1),(8,'门店管理',NULL,1),(9,'普通用户管理',NULL,1),(10,'写字楼房源管理','',2),(11,'基本信息编辑','officebaseinfo/index',10),(12,'展示信息编辑','officepresentinfo/index',10),(13,'出租/售信息管理',NULL,10),(14,'图片管理','picture/index',0),(15,'视频管理',NULL,10),(16,'全景管理',NULL,10),(17,'楼盘管理',NULL,2),(18,'基本信息管理','systembuildinginfo/index',17),(19,'图片管理','picture/buildingIndex',17),(20,'视频管理',NULL,17),(21,'全景管理',NULL,17),(22,'评论管理',NULL,17),(23,'印象管理',NULL,17),(24,'商铺管理',NULL,2),(25,'工业厂房管理',NULL,2),(26,'大型项目管理',NULL,2),(27,'快速发布房源管理',NULL,4),(28,'快速发布需求管理',NULL,4),(29,'图片新闻',NULL,5),(30,'今日头条',NULL,5),(31,'市场新闻',NULL,5),(32,'政治新闻',NULL,5),(33,'成交数据',NULL,5),(34,'调查报告',NULL,5),(35,'研究报告',NULL,5),(36,'地区信息管理','region/index',0),(37,'菜单设置','managemenu/index',6);

/*Table structure for table `35_msg` */

DROP TABLE IF EXISTS `35_msg`;

CREATE TABLE `35_msg` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_sendid` int(11) DEFAULT NULL,
  `msg_revid` int(11) DEFAULT NULL,
  `msg_title` varchar(50) DEFAULT NULL,
  `msg_content` varchar(1024) DEFAULT NULL,
  `msg_type` tinyint(4) DEFAULT '0',
  `msg_time` int(11) DEFAULT NULL,
  `msg_senddel` tinyint(4) DEFAULT '0' COMMENT '标识发送是否删除',
  `msg_revdel` tinyint(4) DEFAULT '0' COMMENT '标识接收者是否删除',
  `msg_isread` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `35_msg` */

/*Table structure for table `35_news` */

DROP TABLE IF EXISTS `35_news`;

CREATE TABLE `35_news` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '新闻ID',
  `n_title` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '新闻标题',
  `n_content` text CHARACTER SET utf8 NOT NULL COMMENT '新闻内容',
  `n_date` datetime NOT NULL COMMENT '新闻日期',
  `n_picture` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '新闻图片',
  `n_from` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '新闻来源',
  `n_state` tinyint(4) NOT NULL COMMENT '新闻类型',
  `n_click` int(11) NOT NULL COMMENT '点击率',
  `n_keyword` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '关键字',
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `35_news` */

insert  into `35_news`(`n_id`,`n_title`,`n_content`,`n_date`,`n_picture`,`n_from`,`n_state`,`n_click`,`n_keyword`) values (1,'a','ddsdfsdefea','2010-07-13 18:09:57','thjlsjal.jpg','11',3,14,'aa'),(2,'bbbbbb','jlsjflsjljalsddsa','2010-07-15 15:25:14','falsdja.gif','jsljfl',1,9,'dd'),(3,'fjsl','slajflsdjewsad','2010-07-15 15:25:40','sfafda.gif','sfjlasfjdl',0,7,'vv'),(4,'jfaljflsdl','dsadfsfeeeeeeeeeeeeeeeeeeefdsada','2010-07-15 15:25:57','dsafds.jpg','sfjlajfldsjlaj',2,7,'bb'),(5,'fasjfdlsj','kasddjdfkdhihsddddifhfii','2010-07-16 15:34:17','fiajfs.jpg','dieiiwiwif',0,9,'bbb'),(6,'hkshafkh','hkshakdhskahfk','2010-07-19 11:09:01','jsfaj.jpg','fhakshfk',3,7,'ddddd'),(7,'bb','jsljfalsjflsaj','2010-07-19 15:41:34','jslaj.gig','sjfalsjf',2,7,'bb'),(8,'bbb','jslfajl','2010-07-19 15:42:17','jslj.gif','jfslkajfls',2,5,'bb'),(9,'cc','fjslafjlsaj','2010-07-20 16:02:40','dasfa.jpg','jfslajl',2,4,'dd');

/*Table structure for table `35_officebaseinfo` */

DROP TABLE IF EXISTS `35_officebaseinfo`;

CREATE TABLE `35_officebaseinfo` (
  `ob_officeid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `ob_sysid` int(11) DEFAULT NULL COMMENT '关联楼盘id',
  `ob_uid` int(11) unsigned NOT NULL COMMENT '用户id',
  `ob_province` int(10) NOT NULL COMMENT '省份',
  `ob_city` int(10) NOT NULL COMMENT '城市',
  `ob_buildingtype` int(11) NOT NULL COMMENT '楼盘类型',
  `ob_officename` varchar(50) NOT NULL COMMENT '写字楼名称',
  `ob_officetype` int(11) NOT NULL COMMENT '写字楼性质',
  `ob_district` int(10) NOT NULL COMMENT '行政区域',
  `ob_section` int(10) NOT NULL COMMENT '板块',
  `ob_loop` int(10) DEFAULT NULL COMMENT '几环',
  `ob_tradecircle` int(10) NOT NULL COMMENT '商圈',
  `ob_busway` varchar(200) NOT NULL COMMENT '附近轨交',
  `ob_officeaddress` varchar(200) NOT NULL COMMENT '写字楼地址',
  `ob_propertycomname` varchar(50) DEFAULT NULL COMMENT '物业公司',
  `ob_propertycost` float NOT NULL COMMENT '物业费',
  `ob_foreign` int(11) DEFAULT NULL COMMENT '是否涉外',
  `ob_officearea` float NOT NULL COMMENT '面积,单位:平方米',
  `ob_floor` int(11) NOT NULL COMMENT '楼层',
  `ob_allfloor` int(11) NOT NULL COMMENT '总楼层',
  `ob_floornature` int(11) NOT NULL COMMENT '楼层性质(1:单层2:多层3:整栋)',
  `ob_property` varchar(200) DEFAULT NULL COMMENT '产权情况',
  `ob_industry` int(11) DEFAULT NULL COMMENT '适用行业',
  `ob_towards` tinyint(1) unsigned zerofill NOT NULL COMMENT '朝向(0代表不知)',
  `ob_buildingera` int(11) DEFAULT NULL COMMENT '建筑年代',
  `ob_cancut` int(11) DEFAULT NULL COMMENT '是否可以分割',
  `ob_adrondegree` int(11) DEFAULT NULL COMMENT '装修程度',
  `ob_officedegree` int(11) NOT NULL COMMENT '写字楼级别',
  `ob_sellorrent` int(11) NOT NULL COMMENT '售或租',
  `ob_releasedate` int(11) NOT NULL COMMENT '发布时间',
  `ob_updatedate` int(11) NOT NULL COMMENT '最近更新时间',
  `ob_expiredate` int(11) NOT NULL COMMENT '截止时间',
  `ob_tag` varchar(200) DEFAULT NULL COMMENT '标签',
  PRIMARY KEY (`ob_officeid`),
  KEY `FK_UID006` (`ob_uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_officebaseinfo` */

insert  into `35_officebaseinfo`(`ob_officeid`,`ob_sysid`,`ob_uid`,`ob_province`,`ob_city`,`ob_buildingtype`,`ob_officename`,`ob_officetype`,`ob_district`,`ob_section`,`ob_loop`,`ob_tradecircle`,`ob_busway`,`ob_officeaddress`,`ob_propertycomname`,`ob_propertycost`,`ob_foreign`,`ob_officearea`,`ob_floor`,`ob_allfloor`,`ob_floornature`,`ob_property`,`ob_industry`,`ob_towards`,`ob_buildingera`,`ob_cancut`,`ob_adrondegree`,`ob_officedegree`,`ob_sellorrent`,`ob_releasedate`,`ob_updatedate`,`ob_expiredate`,`ob_tag`) values (1,1,51,9,9,1,'汤臣中心',1,47,124,1,58,'4,2','张杨路188号','置家物业',500,0,501,1,15,0,NULL,NULL,0,20,0,1,1,2,1273204073,1274691342,1273204073,NULL),(2,1,59,9,9,1,'万景大楼',1,35,55,1,58,'4,2','黄浦区老西门111号','安心物业',600,0,40,1,21,0,NULL,NULL,0,90,0,2,1,2,1273204073,1274691142,1273204073,NULL),(3,1,53,9,9,1,'金融中心',1,47,124,1,58,'2,3','陆家嘴金融中心','宝贝家物业公司',700,0,1000,15,150,1,'全权拥有',1,1,2008,0,1,1,1,1273204096,1274691145,1273204073,NULL),(4,1,51,9,9,1,'大大楼',1,37,69,1,58,'4,3,1','徐汇区上海体育馆','佳佳物业公司',1000,0,5000,1,1,1,'全权拥有',1,1,2000,0,1,1,1,1273204096,1274691145,1273204073,NULL),(5,NULL,66,0,0,3,'小促销楼',0,0,0,0,0,'','','',0,0,0,0,0,0,NULL,NULL,0,0,0,0,0,2,1280918097,1280972038,0,NULL),(6,NULL,66,0,0,3,'万体中心',0,0,0,0,0,'','','',0,0,0,0,0,0,NULL,NULL,0,0,0,0,0,2,1280918110,1280972038,0,NULL),(7,NULL,66,0,0,1,'心中的喽',0,0,0,0,0,'','','',0,0,0,0,0,0,NULL,NULL,0,0,0,0,0,2,1280918114,0,0,NULL),(9,NULL,66,0,0,0,'忍者大楼',0,0,0,0,0,'','','',0,0,0,0,0,0,NULL,NULL,0,0,0,0,0,1,1280974732,0,0,NULL);

/*Table structure for table `35_officecomment` */

DROP TABLE IF EXISTS `35_officecomment`;

CREATE TABLE `35_officecomment` (
  `oc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `oc_cid` int(11) unsigned NOT NULL,
  `oc_officeid` int(11) unsigned NOT NULL,
  `oc_traffice` int(11) NOT NULL,
  `oc_facility` int(11) NOT NULL,
  `oc_adorn` int(11) NOT NULL,
  `oc_comment` varchar(200) NOT NULL,
  `oc_comdate` int(11) NOT NULL,
  PRIMARY KEY (`oc_id`),
  KEY `FK_UID00023` (`oc_cid`) USING BTREE,
  KEY `FK_OID0005` (`oc_officeid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_officecomment` */

/*Table structure for table `35_officefacilityinfo` */

DROP TABLE IF EXISTS `35_officefacilityinfo`;

CREATE TABLE `35_officefacilityinfo` (
  `of_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `of_officeid` int(11) unsigned NOT NULL COMMENT '关联的officebaseinfo表的主键',
  `of_carparking` tinyint(1) NOT NULL DEFAULT '0' COMMENT '停车位',
  `of_warming` tinyint(1) NOT NULL DEFAULT '0' COMMENT '暖气',
  `of_network` tinyint(1) NOT NULL DEFAULT '0' COMMENT '网络',
  `of_elecwater` tinyint(1) NOT NULL DEFAULT '0' COMMENT '水电',
  `of_elevator` tinyint(1) NOT NULL DEFAULT '0' COMMENT '货梯',
  `of_lift` tinyint(1) NOT NULL DEFAULT '0' COMMENT '电梯',
  `of_gas` tinyint(1) NOT NULL DEFAULT '0' COMMENT '天然气',
  `of_aircondition` tinyint(1) NOT NULL DEFAULT '0' COMMENT '空调',
  `of_tv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '电视',
  `of_door` tinyint(1) NOT NULL DEFAULT '0' COMMENT '防盗门',
  PRIMARY KEY (`of_id`),
  KEY `FK_OID001` (`of_officeid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_officefacilityinfo` */

insert  into `35_officefacilityinfo`(`of_id`,`of_officeid`,`of_carparking`,`of_warming`,`of_network`,`of_elecwater`,`of_elevator`,`of_lift`,`of_gas`,`of_aircondition`,`of_tv`,`of_door`) values (1,3,1,0,1,1,1,1,0,1,1,1),(2,5,0,0,0,0,0,0,0,0,0,0),(3,6,0,0,0,0,0,0,0,0,0,0),(4,7,0,0,0,0,0,0,0,0,0,0),(5,8,0,0,0,0,0,0,0,0,0,0),(6,9,0,0,0,0,0,0,0,0,0,0);

/*Table structure for table `35_officepresentinfo` */

DROP TABLE IF EXISTS `35_officepresentinfo`;

CREATE TABLE `35_officepresentinfo` (
  `op_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `op_officeid` int(11) unsigned NOT NULL COMMENT '关联officebaseinfo表主键',
  `op_officetitle` varchar(50) NOT NULL COMMENT '名称',
  `op_serialnum` varchar(50) NOT NULL COMMENT '经纪公司内容序列号',
  `op_officedesc` text NOT NULL COMMENT '描述',
  `op_traffice` varchar(50) DEFAULT NULL COMMENT '交通',
  `op_carparking` varchar(50) DEFAULT NULL COMMENT '停车位',
  `op_facilityaround` varchar(50) DEFAULT NULL COMMENT '周围设施',
  `op_titlepicurl` int(11) DEFAULT NULL,
  PRIMARY KEY (`op_id`),
  KEY `FK_OID002` (`op_officeid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_officepresentinfo` */

insert  into `35_officepresentinfo`(`op_id`,`op_officeid`,`op_officetitle`,`op_serialnum`,`op_officedesc`,`op_traffice`,`op_carparking`,`op_facilityaround`,`op_titlepicurl`) values (1,1,'汤臣中心','1','这就是伟大的上海最贵的汤臣中心了.','693公交车','有停车位','篮球场,游泳池',1),(2,2,'万景大楼','2','知道为什么叫做万景大楼吗?就是因为这里的景色非常好.','787公交车','没有停车位','锻炼器材',2),(3,3,'金融中心','3','上海金融中心,很高的大楼.','隧道六线','有停车位','高级会所,咖啡吧,SPA,台球馆',7),(4,4,'万体中心','4','上海万人体育馆,这里有几乎所有的运动设施.','地铁4号线','有停车位','几乎所有的运动设施',4),(5,5,'','000000000','','','','',NULL),(6,6,'','000000000','','','','',NULL),(7,7,'','000000000','','','','',NULL),(8,8,'','000000000','','','','',NULL),(9,9,'','000000000','','','','',19);

/*Table structure for table `35_officerentinfo` */

DROP TABLE IF EXISTS `35_officerentinfo`;

CREATE TABLE `35_officerentinfo` (
  `or_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `or_officeid` int(11) unsigned NOT NULL COMMENT '关联officebaseinfo表的id',
  `or_rentprice` float NOT NULL COMMENT '租金价格',
  `or_iscontainprocost` int(11) NOT NULL COMMENT '是否包含物业费',
  `or_renttype` int(11) NOT NULL COMMENT '出租方式',
  `or_payway` int(11) NOT NULL COMMENT '支付方法',
  `or_basetime` float NOT NULL COMMENT '起租年限',
  PRIMARY KEY (`or_id`),
  KEY `FK_OID003` (`or_officeid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_officerentinfo` */

insert  into `35_officerentinfo`(`or_id`,`or_officeid`,`or_rentprice`,`or_iscontainprocost`,`or_renttype`,`or_payway`,`or_basetime`) values (1,3,2000,1,1,1,1),(2,4,4500,2,2,1,1);

/*Table structure for table `35_officerequire` */

DROP TABLE IF EXISTS `35_officerequire`;

CREATE TABLE `35_officerequire` (
  `or_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `or_uid` int(11) unsigned NOT NULL,
  `or_province` int(11) NOT NULL,
  `or_city` int(11) NOT NULL,
  `or_district` int(11) DEFAULT NULL,
  `or_address` varchar(200) DEFAULT NULL,
  `or_buildingtype` int(11) NOT NULL,
  `or_officetype` int(11) NOT NULL,
  `or_officeareamin` float NOT NULL,
  `or_officeareamax` float NOT NULL,
  `or_floor` int(11) NOT NULL,
  `or_cancut` int(11) DEFAULT NULL,
  `or_adrondegree` int(11) NOT NULL,
  `or_officedegree` int(11) NOT NULL,
  `or_facility` varchar(200) DEFAULT NULL,
  `or_title` varchar(50) NOT NULL,
  `or_desc` text,
  `or_sellorrent` int(11) NOT NULL,
  `or_costmin` float NOT NULL,
  `or_costmax` float NOT NULL,
  `or_releasedate` int(11) NOT NULL,
  `or_expiredate` int(11) NOT NULL,
  PRIMARY KEY (`or_id`),
  KEY `FK_UID00019` (`or_uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_officerequire` */

/*Table structure for table `35_officesellinfo` */

DROP TABLE IF EXISTS `35_officesellinfo`;

CREATE TABLE `35_officesellinfo` (
  `os_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `os_officeid` int(11) unsigned NOT NULL COMMENT '关联officebaseinfo表的id',
  `os_avgprice` int(10) unsigned NOT NULL COMMENT '平均售价',
  `os_sumprice` int(10) unsigned NOT NULL COMMENT '房源总价',
  PRIMARY KEY (`os_id`),
  KEY `FK_OID004` (`os_officeid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_officesellinfo` */

insert  into `35_officesellinfo`(`os_id`,`os_officeid`,`os_avgprice`,`os_sumprice`) values (1,1,30000,10000000),(2,2,20000,8000000),(3,5,0,0),(4,6,0,0),(5,7,0,0),(6,8,0,0),(7,9,0,0);

/*Table structure for table `35_officetag` */

DROP TABLE IF EXISTS `35_officetag`;

CREATE TABLE `35_officetag` (
  `ot_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ot_officeid` int(11) unsigned NOT NULL COMMENT '关联officebaseinfo表主键',
  `ot_ishigh` int(11) DEFAULT '0' COMMENT '是否优质',
  `ot_isrecommend` int(11) DEFAULT '0' COMMENT '是否推荐',
  `ot_ishomepage` int(11) DEFAULT '0' COMMENT '是否首页显示',
  `ot_isvideo` int(11) DEFAULT '0' COMMENT '是否有视频',
  `ot_is3d` int(11) DEFAULT '0' COMMENT '是否有3D视频',
  `ot_isconsign` int(11) DEFAULT '0' COMMENT '是否委托',
  `ot_consignid` int(11) DEFAULT '-1' COMMENT '-1表示没有，0表示所有人，0以上指经纪人的ID',
  `ot_isnew` int(11) DEFAULT '0' COMMENT '是否新房源',
  `ot_ishurry` int(11) DEFAULT '0' COMMENT '是否急房源',
  `ot_check` int(11) NOT NULL COMMENT '审核状态:1删除2回收站3下线4已发布5未审核6审核中7已提交8草稿',
  PRIMARY KEY (`ot_id`),
  KEY `FK_OID005` (`ot_officeid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_officetag` */

insert  into `35_officetag`(`ot_id`,`ot_officeid`,`ot_ishigh`,`ot_isrecommend`,`ot_ishomepage`,`ot_isvideo`,`ot_is3d`,`ot_isconsign`,`ot_consignid`,`ot_isnew`,`ot_ishurry`,`ot_check`) values (1,5,0,0,0,0,0,0,-1,0,0,4),(2,6,0,0,0,0,0,0,-1,0,0,4),(3,7,0,0,0,0,0,0,-1,0,0,4),(4,8,0,0,0,0,0,0,-1,0,0,8),(5,9,0,0,0,0,0,0,-1,0,0,8);

/*Table structure for table `35_picture` */

DROP TABLE IF EXISTS `35_picture`;

CREATE TABLE `35_picture` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `p_sourceid` int(10) unsigned DEFAULT NULL COMMENT '房源id',
  `p_sourcetype` int(10) unsigned DEFAULT NULL COMMENT '房源类型(1.楼盘2.写字楼3.商务中心)',
  `p_type` int(10) unsigned DEFAULT NULL COMMENT '图片类型(1.平面图2.外景图3.内景图4.外景视频5.内景视频6.3D交互图7.全景视频)',
  `p_img` varchar(200) DEFAULT NULL COMMENT '大图图片路径',
  `p_tinyimg` varchar(200) DEFAULT NULL COMMENT '缩略图图片路径',
  `p_uploadtime` int(10) unsigned DEFAULT NULL COMMENT '上传时间',
  PRIMARY KEY (`p_id`),
  KEY `p_sourceid` (`p_sourceid`),
  KEY `p_sourcetype` (`p_sourcetype`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `35_picture` */

insert  into `35_picture`(`p_id`,`p_sourceid`,`p_sourcetype`,`p_type`,`p_img`,`p_tinyimg`,`p_uploadtime`) values (1,1,1,1,'/ichnopic/1/200x150c.jpg','/ichnopic/1/200x150c.jpg',1278305153),(2,1,1,1,'/ichnopic/1/200x150d.jpg','/ichnopic/1/200x150d.jpg',1278305153),(3,1,1,1,'/ichnopic/1/a.jpg','/ichnopic/1/a.jpg',1278305153),(4,1,1,1,'/ichnopic/1/DSCF0195.JPG','/ichnopic/1/DSCF0195.JPG',1278305153),(5,1,1,2,'/outdoorpic/1/8f6dc877_la.JPG','/outdoorpic/1/8f6dc877_la.JPG',1278305153),(6,1,1,2,'/outdoorpic/1/66c7b0fe_la.JPG','/outdoorpic/1/66c7b0fe_la.JPG',1278305153),(7,3,2,1,'/ichnopic/1/200x150c.jpg','/ichnopic/1/200x150c.jpg',1278305153),(8,3,2,1,'/ichnopic/1/200x150d.jpg','/ichnopic/1/200x150d.jpg',1278305153),(9,3,2,1,'/ichnopic/1/a.jpg','/ichnopic/1/a.jpg',1278305153),(10,3,2,2,'/outdoorpic/1/8f6dc877_la.JPG','/outdoorpic/1/8f6dc877_la.JPG',1278305153),(11,3,2,2,'/outdoorpic/1/66c7b0fe_la.JPG','/outdoorpic/1/66c7b0fe_la.JPG',1278305153),(12,3,2,3,'/indoorpic/1/420x315.jpg','/indoorpic/1/420x315.jpg',1278305153),(13,1,3,1,'/indoorpic/1/a.jpg','/indoorpic/1/a.jpg',1278305153),(14,1,1,1,'/indoorpic/1/a.jpg','/indoorpic/1/a.jpg',1278305153),(16,9,1,2,'/outdoorpic/128176716871.jpg','/outdoorpic/128176716871_tiny.jpg',1281767168),(15,9,1,1,'/ichnopic/128176634065.jpg','/ichnopic/128176634065_tiny.jpg',1281766340);

/*Table structure for table `35_post` */

DROP TABLE IF EXISTS `35_post`;

CREATE TABLE `35_post` (
  `post_id` int(11) NOT NULL,
  `post_title` int(50) DEFAULT NULL,
  `post_content` varchar(1000) DEFAULT NULL,
  `post_role` tinyint(4) DEFAULT NULL COMMENT 'all=>0,personal=>1,agent=>2，company=>3',
  `post_status` int(11) DEFAULT '0',
  `post_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `35_post` */

/*Table structure for table `35_productgrid` */

DROP TABLE IF EXISTS `35_productgrid`;

CREATE TABLE `35_productgrid` (
  `p_id` int(10) NOT NULL DEFAULT '0' COMMENT '主键',
  `p_page` int(10) NOT NULL DEFAULT '0' COMMENT '具体页面',
  `p_position` int(10) NOT NULL DEFAULT '0' COMMENT '页面位置',
  `p_index` int(10) NOT NULL DEFAULT '0' COMMENT '页面精品位置(1-6)分别表示不同格子',
  `p_positiontype` tinyint(4) NOT NULL DEFAULT '0' COMMENT '页面位置类型1租2售3经纪人',
  `p_pay` int(10) NOT NULL DEFAULT '0' COMMENT '每个位置需要的积分数',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='推荐精品具体位置花费表';

/*Data for the table `35_productgrid` */

insert  into `35_productgrid`(`p_id`,`p_page`,`p_position`,`p_index`,`p_positiontype`,`p_pay`) values (1,4,5,1,1,20),(2,4,5,2,1,20),(3,4,5,3,1,20),(4,4,5,4,1,20),(8,4,5,5,1,10),(7,4,5,6,1,10),(9,4,5,1,2,10),(5,4,5,2,2,20),(6,4,5,3,2,10),(10,4,5,4,2,10),(11,4,5,5,2,10),(12,4,5,6,2,10),(13,5,3,1,1,0),(14,5,3,2,1,0),(15,5,3,3,1,0),(16,5,3,4,1,0),(17,5,3,5,1,0),(18,5,3,6,1,0),(19,6,3,1,2,0),(20,6,3,2,2,0),(21,6,3,3,2,0),(22,6,3,4,2,0),(23,6,3,5,2,0),(24,6,3,6,2,0),(25,1,1,1,1,0),(26,1,1,2,1,0),(27,1,1,3,1,0),(28,1,1,4,1,0),(29,1,1,5,1,0),(30,1,1,6,1,0);

/*Table structure for table `35_projectbaseinfo` */

DROP TABLE IF EXISTS `35_projectbaseinfo`;

CREATE TABLE `35_projectbaseinfo` (
  `pb_projectid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pb_uid` int(11) unsigned NOT NULL,
  `pb_province` int(10) NOT NULL,
  `pb_city` int(10) NOT NULL,
  `pb_projcetaddress` varchar(200) DEFAULT NULL,
  `pb_transactionway` int(11) NOT NULL,
  `pb_price` float NOT NULL,
  `pb_releasedate` int(11) NOT NULL,
  `pb_expiredate` int(11) DEFAULT NULL,
  PRIMARY KEY (`pb_projectid`),
  KEY `FK_UID007` (`pb_uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_projectbaseinfo` */

insert  into `35_projectbaseinfo`(`pb_projectid`,`pb_uid`,`pb_province`,`pb_city`,`pb_projcetaddress`,`pb_transactionway`,`pb_price`,`pb_releasedate`,`pb_expiredate`) values (1,53,1,2,'',1,12,2010,2010);

/*Table structure for table `35_projectcomment` */

DROP TABLE IF EXISTS `35_projectcomment`;

CREATE TABLE `35_projectcomment` (
  `pc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pc_cid` int(11) unsigned NOT NULL,
  `pc_projectid` int(11) unsigned NOT NULL,
  `pc_traffice` int(11) NOT NULL,
  `pc_facility` int(11) NOT NULL,
  `pc_adorn` int(11) NOT NULL,
  `pc_comment` varchar(200) NOT NULL,
  `pc_comdate` int(11) NOT NULL,
  PRIMARY KEY (`pc_id`),
  KEY `FK_UID00024` (`pc_cid`) USING BTREE,
  KEY `FK_PID0005` (`pc_projectid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_projectcomment` */

/*Table structure for table `35_projectpresentinfo` */

DROP TABLE IF EXISTS `35_projectpresentinfo`;

CREATE TABLE `35_projectpresentinfo` (
  `pp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pp_projectid` int(11) unsigned NOT NULL,
  `pp_projecttitle` varchar(50) NOT NULL,
  `pp_serialnum` varchar(50) DEFAULT NULL,
  `pp_projectdesc` text,
  `pp_traffice` varchar(50) DEFAULT NULL,
  `pp_carparking` varchar(50) DEFAULT NULL,
  `pp_facilityaround` varchar(50) DEFAULT NULL,
  `pp_titlepicurl` int(11) DEFAULT NULL,
  PRIMARY KEY (`pp_id`),
  KEY `FK_PID001` (`pp_projectid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_projectpresentinfo` */

insert  into `35_projectpresentinfo`(`pp_id`,`pp_projectid`,`pp_projecttitle`,`pp_serialnum`,`pp_projectdesc`,`pp_traffice`,`pp_carparking`,`pp_facilityaround`,`pp_titlepicurl`) values (1,1,'12321','000000000','31231','','','',NULL);

/*Table structure for table `35_projectrequire` */

DROP TABLE IF EXISTS `35_projectrequire`;

CREATE TABLE `35_projectrequire` (
  `pr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pr_uid` int(11) unsigned NOT NULL,
  `pr_province` int(11) NOT NULL,
  `pr_city` int(11) NOT NULL,
  `pr_district` int(11) DEFAULT NULL,
  `pr_address` varchar(200) DEFAULT NULL,
  `pr_title` varchar(50) NOT NULL,
  `pr_desc` text,
  `pr_sellorrent` int(11) NOT NULL,
  `pr_costmin` float NOT NULL,
  `pr_costmax` float NOT NULL,
  `pr_releasedate` int(11) NOT NULL,
  `pr_expiredate` int(11) NOT NULL,
  PRIMARY KEY (`pr_id`),
  KEY `FK_UID00011` (`pr_uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_projectrequire` */

/*Table structure for table `35_projecttag` */

DROP TABLE IF EXISTS `35_projecttag`;

CREATE TABLE `35_projecttag` (
  `pt_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pt_projectid` int(11) unsigned NOT NULL,
  `pt_ishigh` int(11) DEFAULT '0',
  `pt_isrecommend` int(11) DEFAULT '0',
  `pt_ishomepage` int(11) DEFAULT '0',
  `pt_isvideo` int(11) DEFAULT '0',
  `pt_is3d` int(11) DEFAULT '0',
  `pt_isconsign` int(11) DEFAULT '0',
  `pt_consignid` int(11) DEFAULT '-1',
  `pt_isnew` int(11) DEFAULT '0',
  `pt_ishurry` int(11) DEFAULT '0',
  `pt_check` int(11) NOT NULL,
  PRIMARY KEY (`pt_id`),
  KEY `FK_PID002` (`pt_projectid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_projecttag` */

insert  into `35_projecttag`(`pt_id`,`pt_projectid`,`pt_ishigh`,`pt_isrecommend`,`pt_ishomepage`,`pt_isvideo`,`pt_is3d`,`pt_isconsign`,`pt_consignid`,`pt_isnew`,`pt_ishurry`,`pt_check`) values (1,1,2,2,2,2,2,2,-1,2,2,64);

/*Table structure for table `35_quickrelease` */

DROP TABLE IF EXISTS `35_quickrelease`;

CREATE TABLE `35_quickrelease` (
  `qrl_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `qrl_province` int(10) NOT NULL,
  `qrl_city` int(10) NOT NULL,
  `qrl_district` int(10) DEFAULT NULL,
  `qrl_address` varchar(200) NOT NULL,
  `qrl_rstype` int(11) NOT NULL,
  `qrl_usetype` int(11) NOT NULL,
  `qrl_title` varchar(50) NOT NULL,
  `qrl_desc` text NOT NULL,
  `qrl_picurl` varchar(200) DEFAULT NULL,
  `qrl_contact` varchar(20) NOT NULL,
  `qrl_telephone` varchar(20) NOT NULL,
  `qrl_qq` varchar(20) DEFAULT NULL,
  `qrl_msn` varchar(20) DEFAULT NULL,
  `qrl_releasedate` int(11) NOT NULL,
  `qrl_expiredate` int(11) NOT NULL,
  PRIMARY KEY (`qrl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_quickrelease` */

insert  into `35_quickrelease`(`qrl_id`,`qrl_province`,`qrl_city`,`qrl_district`,`qrl_address`,`qrl_rstype`,`qrl_usetype`,`qrl_title`,`qrl_desc`,`qrl_picurl`,`qrl_contact`,`qrl_telephone`,`qrl_qq`,`qrl_msn`,`qrl_releasedate`,`qrl_expiredate`) values (1,0,0,NULL,'上海',2,1,'出租写字楼','暂无','','李先生','13162654052','','',0,2010);

/*Table structure for table `35_quickrequire` */

DROP TABLE IF EXISTS `35_quickrequire`;

CREATE TABLE `35_quickrequire` (
  `qrq_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `qrq_rstype` int(11) NOT NULL,
  `qrq_usetype` int(11) NOT NULL,
  `qrq_province` int(10) NOT NULL,
  `qrq_city` int(10) NOT NULL,
  `qrq_district` int(10) NOT NULL,
  `qrq_address` varchar(200) NOT NULL,
  `qrq_title` varchar(50) NOT NULL,
  `qrq_desc` text,
  `qrq_contact` varchar(20) NOT NULL,
  `qrq_telephone` varchar(20) NOT NULL,
  `qrq_qq` varchar(20) NOT NULL,
  `qrq_msn` varchar(20) DEFAULT NULL,
  `qrq_releasedate` int(11) NOT NULL,
  `qrq_expiredate` int(11) NOT NULL,
  PRIMARY KEY (`qrq_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_quickrequire` */

/*Table structure for table `35_recommend` */

DROP TABLE IF EXISTS `35_recommend`;

CREATE TABLE `35_recommend` (
  `rm_id` int(11) unsigned NOT NULL COMMENT '主键',
  `rm_sid` int(11) unsigned DEFAULT NULL COMMENT '关联的资源id',
  `rm_userid` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `rm_type` int(11) unsigned DEFAULT NULL COMMENT '资源类型',
  `rm_consumevalue` int(11) unsigned DEFAULT NULL COMMENT '消耗值',
  `rm_recordtime` int(11) unsigned DEFAULT NULL COMMENT '记录时间',
  `rm_updatetime` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`rm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_recommend` */

insert  into `35_recommend`(`rm_id`,`rm_sid`,`rm_userid`,`rm_type`,`rm_consumevalue`,`rm_recordtime`,`rm_updatetime`) values (1,1,53,1,10,1276159010,1276159010),(2,2,53,1,9,1276159010,1276159010),(3,3,53,1,8,1276159010,1276159010),(4,4,53,1,7,1276159010,1276159010),(5,5,53,1,10,1276159010,1276159010);

/*Table structure for table `35_region` */

DROP TABLE IF EXISTS `35_region`;

CREATE TABLE `35_region` (
  `re_id` int(10) unsigned NOT NULL COMMENT 'id',
  `re_name` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '名称',
  `re_parent_id` int(10) unsigned NOT NULL COMMENT '父级id',
  PRIMARY KEY (`re_id`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `35_region` */

insert  into `35_region`(`re_id`,`re_name`,`re_parent_id`) values (1,'北京市',0),(2,'天津市',0),(3,'河北省',0),(4,'山西省',0),(5,'内蒙古自治区',0),(6,'辽宁省',0),(7,'吉林省',0),(8,'黑龙江省',0),(9,'上海市',0),(10,'江苏省',0),(11,'浙江省',0),(12,'安徽省',0),(13,'福建省',0),(14,'江西省',0),(15,'河南省',0),(16,'湖北省',0),(17,'湖南省',0),(18,'广东省',0),(19,'广西壮族自治区',0),(20,'海南省',0),(21,'重庆市',0),(22,'四川省',0),(23,'贵州省',0),(24,'云南省',0),(25,'西藏自治区',0),(26,'陕西省',0),(27,'甘肃省',0),(28,'青海省',0),(29,'宁夏回族自治区',0),(30,'新疆维吾尔自治区',0),(31,'台湾省',0),(32,'香港特别行政区',0),(33,'澳门特别行政区',0),(34,'山东省',0),(36,'黄浦区‎',35),(86,'曹杨地区‎',41),(85,'同乐坊‎',40),(84,'‎南京西路‎',40),(83,'‎静安寺',40),(82,'曹家渡',40),(81,'‎中山公园',39),(80,'‎新华路',39),(79,'‎天山',39),(78,'上海影城',39),(77,'虹桥机场‎',39),(76,'‎虹桥‎',39),(75,'古北',39),(73,'音乐学院‎‎',38),(72,'徐家汇‎',38),(71,'‎田林‎',38),(70,'‎体育场',38),(69,'‎上海南站',38),(68,'‎龙华',38),(67,'‎衡山路',38),(66,'‎复兴西路',38),(65,'丁香花园',38),(64,'漕河泾‎',38),(63,'新天地‎',37),(62,'瑞金宾馆区‎',37),(61,'‎淮海路‎',37),(60,'打浦桥',37),(59,'‎外滩‎‎',36),(58,'人民广场',36),(57,'‎南京东路‎',36),(56,'老西门',36),(55,'城隍庙‎',36),(54,'崇明县',35),(53,'奉贤区',35),(52,'南汇区',35),(51,'青浦区',35),(50,'松江区',35),(49,'金山区',35),(48,'浦东新区',35),(47,'嘉定区',35),(46,'宝山区',35),(45,'闵行区',35),(44,'杨浦区',35),(43,'虹口区',35),(42,'闸北区',35),(41,'普陀区',35),(40,'静安区',35),(74,'动物园‎',39),(39,'长宁区',35),(38,'徐汇区',35),(37,'卢湾区',35),(87,'长风公园',41),(88,'‎长寿路‎',41),(89,'甘泉地区‎',41),(90,'华师大',41),(91,'‎梅川路',41),(92,'‎中山北路‎‎',41),(93,'大宁地区‎',42),(94,'火车站',42),(95,'‎彭浦新村‎‎‎',42),(96,'北外滩‎',43),(97,'江湾镇‎',43),(98,'凉城‎',43),(99,'鲁迅公园‎',43),(100,'曲阳地区‎',43),(101,'四川北路',43),(102,'‎四平路‎‎‎‎',43),(103,'大学区',44),(104,'‎黄兴公园',44),(105,'‎控江地区',44),(106,'‎平凉路‎',44),(107,'五角场‎',44),(108,'中原地区‎‎‎‎',44),(109,'春申地区',45),(110,'‎古美地区',45),(111,'‎虹桥镇',45),(112,'‎老闵行‎',45),(113,'龙柏‎',45),(114,'罗阳‎',45),(115,'南方商城',45),(116,'‎七宝',45),(117,'‎莘庄‎‎‎‎',45),(118,'长江西路‎',46),(119,'大华地区',46),(120,'‎上大',46),(121,'‎吴淞‎‎‎‎',46),(122,'八佰伴',125),(123,'‎川沙‎',48),(124,'金桥',48),(125,'‎陆家嘴',48),(126,'‎上南地区‎',48),(127,'世纪公园‎',48),(128,'塘桥',48),(129,'‎外高桥',48),(130,'‎源深体育中心',48),(131,'‎张江‎‎‎‎',48),(35,'上海市',9),(133,'11',1000),(134,'11',10000),(135,'11',1000);

/*Table structure for table `35_role` */

DROP TABLE IF EXISTS `35_role`;

CREATE TABLE `35_role` (
  `ur_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ur_rolename` varchar(20) NOT NULL,
  PRIMARY KEY (`ur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `35_role` */

insert  into `35_role`(`ur_id`,`ur_rolename`) values (1,'中介'),(2,'个人');

/*Table structure for table `35_searchcondition` */

DROP TABLE IF EXISTS `35_searchcondition`;

CREATE TABLE `35_searchcondition` (
  `sc_id` int(10) unsigned NOT NULL,
  `sc_title` varchar(200) NOT NULL,
  `sc_parentid` int(10) unsigned NOT NULL,
  `sc_maxvalue` int(10) NOT NULL,
  `sc_minvalue` int(10) NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_searchcondition` */

insert  into `35_searchcondition`(`sc_id`,`sc_title`,`sc_parentid`,`sc_maxvalue`,`sc_minvalue`) values (1,'类型',0,0,0),(2,'出租',1,1,1),(3,'出售',1,2,2),(4,'求租',1,3,3),(5,'求购',1,4,4),(6,'面积',0,0,0),(7,'50平米以下',6,50,0),(8,'50-100平米',6,100,50),(9,'100-200平米',6,200,100),(10,'200-300平米',6,300,200),(11,'300-500平米',6,500,300),(12,'500-800平米',6,800,500),(13,'800-1000平米',6,1000,800),(14,'1000平米以上',6,100000000,1000),(15,'地段',0,0,0),(16,'内环以内',15,1,1),(17,'中环以内',15,2,2),(18,'中外环之间',15,3,3),(19,'外环以外',15,4,4),(20,'售价',0,0,0),(21,'0-100万',20,1000000,0),(22,'100万-200万',20,2000000,1000000),(23,'200万-300万',20,3000000,2000000),(24,'300万-500万',20,5000000,3000000),(25,'500万-800万',20,8000000,5000000),(26,'800万-1000万',20,10000000,8000000),(27,'1000万-1500万',20,15000000,10000000),(28,'1500万-2000万',20,20000000,15000000),(29,'2000万以上',20,2147483647,20000000),(30,'租金',0,0,0),(31,'500以下',30,500,0),(32,'500-1000',30,1000,500),(33,'1000-2000',30,2000,1000),(34,'2000-3000',30,3000,2000),(35,'3000-4000',30,4000,3000),(36,'4000-5000',30,5000,4000),(37,'5000-8000',30,8000,5000),(38,'8000-10000',30,10000,8000),(39,'10000以上',30,2147483647,10000),(40,'附近交通',0,0,0),(41,'1号线',40,1,1),(42,'2号线',40,2,2),(43,'3号线',40,3,3),(44,'4号线',40,4,4),(45,'5号线',40,5,5),(46,'6号线',40,6,6),(47,'7号线',40,7,7),(48,'8号线',40,8,8),(49,'9号线',40,9,9),(50,'11号线',40,11,11),(51,'装修',0,0,0),(52,'毛坯',51,1,1),(53,'简单装修',51,2,2),(54,'精装修',51,3,3),(55,'豪华装修',51,4,4),(56,'房源',0,0,0),(57,'中介',56,1,1),(58,'个人',56,2,2),(59,'适用行业',0,0,0),(60,'商铺',59,1,1);

/*Table structure for table `35_searchfor` */

DROP TABLE IF EXISTS `35_searchfor`;

CREATE TABLE `35_searchfor` (
  `sf_id` int(10) unsigned NOT NULL COMMENT '主键',
  `sf_name` varchar(200) DEFAULT NULL COMMENT '名称',
  `sf_value` int(10) unsigned DEFAULT NULL COMMENT '值',
  `sf_type` int(10) unsigned DEFAULT NULL COMMENT '类型',
  PRIMARY KEY (`sf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_searchfor` */

insert  into `35_searchfor`(`sf_id`,`sf_name`,`sf_value`,`sf_type`) values (1,'教育',1,1),(2,'办公',2,1),(3,'金融',3,1);

/*Table structure for table `35_shopbaseinfo` */

DROP TABLE IF EXISTS `35_shopbaseinfo`;

CREATE TABLE `35_shopbaseinfo` (
  `sb_shopid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sb_sysid` int(11) DEFAULT NULL,
  `sb_uid` int(11) unsigned NOT NULL,
  `sb_province` int(10) NOT NULL,
  `sb_city` int(10) NOT NULL,
  `sb_shopname` varchar(50) NOT NULL,
  `sb_shoptype` int(11) NOT NULL,
  `sb_selltype` int(11) NOT NULL,
  `sb_businesstype` int(11) NOT NULL,
  `sb_buildingname` varchar(50) NOT NULL,
  `sb_district` int(10) NOT NULL,
  `sb_section` int(10) NOT NULL,
  `sb_loop` int(10) DEFAULT NULL,
  `sb_tradecircle` int(10) DEFAULT NULL,
  `sb_busway` varchar(200) NOT NULL,
  `sb_shopaddress` varchar(200) NOT NULL,
  `sb_proprtycomname` varchar(50) DEFAULT NULL,
  `sb_propertycost` float NOT NULL,
  `sb_shoparea` float NOT NULL,
  `sb_shopusablearea` float DEFAULT NULL,
  `sb_floor` int(11) DEFAULT NULL,
  `sb_allfloor` int(11) DEFAULT NULL,
  `sb_buildingage` varchar(20) DEFAULT NULL,
  `sb_cancut` int(11) DEFAULT NULL,
  `sb_adrondegree` int(11) DEFAULT NULL,
  `sb_sellorrent` int(11) NOT NULL,
  `sb_releasedate` int(11) NOT NULL,
  `sb_expiredate` int(11) DEFAULT NULL,
  `sb_mainservice` int(11) NOT NULL,
  `sb_tag` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`sb_shopid`),
  KEY `FK_UID008` (`sb_uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_shopbaseinfo` */

/*Table structure for table `35_shopcomment` */

DROP TABLE IF EXISTS `35_shopcomment`;

CREATE TABLE `35_shopcomment` (
  `sc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sc_cid` int(11) unsigned NOT NULL,
  `sc_shopid` int(11) unsigned NOT NULL,
  `sc_traffice` int(11) NOT NULL,
  `sc_facility` int(11) NOT NULL,
  `sc_adorn` int(11) NOT NULL,
  `sc_comment` varchar(200) NOT NULL,
  `sc_comdate` int(11) NOT NULL,
  PRIMARY KEY (`sc_id`),
  KEY `FK_UID00026` (`sc_cid`) USING BTREE,
  KEY `FK_SID0005` (`sc_shopid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_shopcomment` */

/*Table structure for table `35_shopfacilityinfo` */

DROP TABLE IF EXISTS `35_shopfacilityinfo`;

CREATE TABLE `35_shopfacilityinfo` (
  `sf_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sf_shopid` int(11) unsigned NOT NULL,
  `sf_carparking` int(11) NOT NULL DEFAULT '0',
  `sf_warming` int(11) NOT NULL DEFAULT '0',
  `sf_network` int(11) NOT NULL DEFAULT '0',
  `sf_elecwater` int(11) NOT NULL DEFAULT '0',
  `sf_elevator` int(11) NOT NULL DEFAULT '0',
  `sf_lift` int(11) NOT NULL DEFAULT '0',
  `sf_gas` int(11) NOT NULL DEFAULT '0',
  `sf_aircondition` int(11) NOT NULL DEFAULT '0',
  `sf_tv` int(11) NOT NULL DEFAULT '0',
  `sf_door` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sf_id`),
  KEY `FK_SID001` (`sf_shopid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_shopfacilityinfo` */

/*Table structure for table `35_shoppresentinfo` */

DROP TABLE IF EXISTS `35_shoppresentinfo`;

CREATE TABLE `35_shoppresentinfo` (
  `sp_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '''',
  `sp_shopid` int(11) unsigned NOT NULL,
  `sp_shoptitle` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sp_serialnum` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sp_shopdesc` text CHARACTER SET utf8,
  `sp_traffice` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sp_carparking` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sp_facilityaround` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sp_titlepicurl` int(11) DEFAULT NULL,
  PRIMARY KEY (`sp_id`),
  KEY `FK_SID002` (`sp_shopid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin5 ROW_FORMAT=COMPACT;

/*Data for the table `35_shoppresentinfo` */

/*Table structure for table `35_shoprentinfo` */

DROP TABLE IF EXISTS `35_shoprentinfo`;

CREATE TABLE `35_shoprentinfo` (
  `sr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sr_shopid` int(11) unsigned NOT NULL,
  `sr_rentprice` float NOT NULL,
  `sr_iscontainprocost` int(11) NOT NULL,
  `sr_renttype` int(11) NOT NULL,
  `sr_payway` int(11) NOT NULL,
  `sr_basetime` float NOT NULL,
  PRIMARY KEY (`sr_id`),
  KEY `FK_SID003` (`sr_shopid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_shoprentinfo` */

/*Table structure for table `35_shoprequire` */

DROP TABLE IF EXISTS `35_shoprequire`;

CREATE TABLE `35_shoprequire` (
  `sr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sr_uid` int(11) unsigned NOT NULL,
  `sr_province` int(11) NOT NULL,
  `sr_city` int(11) NOT NULL,
  `sr_district` int(11) NOT NULL,
  `sr_address` varchar(200) DEFAULT NULL,
  `sr_shoptype` int(11) NOT NULL,
  `sr_selltype` int(11) NOT NULL,
  `sr_businesstype` int(11) NOT NULL,
  `sr_shopareamin` float NOT NULL,
  `sr_shopareamax` float NOT NULL,
  `sr_cancut` int(11) DEFAULT NULL,
  `sr_floor` int(11) DEFAULT NULL,
  `sr_adrondegree` int(11) DEFAULT NULL,
  `sr_facility` varchar(200) DEFAULT NULL,
  `sr_title` varchar(50) NOT NULL,
  `sr_desc` text NOT NULL,
  `sr_sellorrent` int(11) NOT NULL,
  `sr_costmin` float NOT NULL,
  `sr_costmax` float NOT NULL,
  `sr_releasedate` int(11) NOT NULL,
  `sr_expiredate` int(11) NOT NULL,
  PRIMARY KEY (`sr_id`),
  KEY `FK_UID00020` (`sr_uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_shoprequire` */

/*Table structure for table `35_shopsellinfo` */

DROP TABLE IF EXISTS `35_shopsellinfo`;

CREATE TABLE `35_shopsellinfo` (
  `ss_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ss_shopid` int(11) unsigned NOT NULL,
  `ss_sellprice` float NOT NULL,
  PRIMARY KEY (`ss_id`),
  KEY `FK_SID004` (`ss_shopid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_shopsellinfo` */

/*Table structure for table `35_shoptag` */

DROP TABLE IF EXISTS `35_shoptag`;

CREATE TABLE `35_shoptag` (
  `st_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `st_shopid` int(11) unsigned NOT NULL,
  `st_ishigh` int(11) DEFAULT '0',
  `st_isrecommend` int(11) DEFAULT '0',
  `st_ishomepage` int(11) DEFAULT '0',
  `st_isvideo` int(11) DEFAULT '0',
  `st_is3d` int(11) DEFAULT '0',
  `st_isconsign` int(11) DEFAULT '0',
  `st_consignid` int(11) DEFAULT '-1',
  `st_isnew` int(11) DEFAULT '0',
  `st_ishurry` int(11) DEFAULT '0',
  `st_check` int(11) NOT NULL,
  PRIMARY KEY (`st_id`),
  KEY `FK_SID005` (`st_shopid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_shoptag` */

/*Table structure for table `35_subway` */

DROP TABLE IF EXISTS `35_subway`;

CREATE TABLE `35_subway` (
  `sw_id` int(10) unsigned NOT NULL COMMENT '主键id',
  `sw_stationid` int(10) unsigned DEFAULT NULL COMMENT '站点的id',
  `sw_stationname` varchar(200) DEFAULT NULL COMMENT '站点的名称',
  `sw_parentid` int(10) unsigned DEFAULT NULL COMMENT '站点的父级id',
  PRIMARY KEY (`sw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_subway` */

insert  into `35_subway`(`sw_id`,`sw_stationid`,`sw_stationname`,`sw_parentid`) values (1,1,'上海市',0),(2,2,'1号线',1),(3,3,'2号线',1),(4,4,'3号线',1),(5,5,'4号线',1),(6,6,'5号线',1),(7,7,'6号线',1),(8,8,'7号线',1),(9,9,'8号线',1),(10,10,'9号线',1),(11,11,'10号线',1),(12,12,'11号线',1),(13,13,'13号线',1),(14,14,'莘庄',2),(15,15,'外环路',2),(16,16,'莲花路',2),(17,17,'锦江乐园',2),(18,18,'上海南站',2),(19,19,'漕宝路',2),(123,123,'大木桥路',5),(21,21,'徐家汇',2),(22,22,'衡山路',2),(23,23,'常熟路',2),(24,24,'陕西南路',2),(25,25,'黄陂南路',2),(26,26,'人民广场',2),(27,27,'新闸路',2),(28,28,'汉中路',2),(29,29,'上海火车站',2),(30,30,'中山北路',2),(31,31,'延长路',2),(32,32,'上海马戏城',2),(33,33,'汶水路',2),(34,34,'彭浦新村',2),(35,35,'共康路',2),(36,36,'通河新村',2),(37,37,'呼兰路',2),(38,38,'共富新村',2),(39,39,'宝安公路',2),(40,40,'友谊西路',2),(41,41,'富锦路',2),(42,42,'徐泾东',3),(43,43,'虹桥火车站',3),(44,44,'虹桥2号航站楼',3),(45,45,'淞虹路',3),(46,46,'北新泾',3),(47,47,'威宁路',3),(48,48,'娄山关路',3),(49,49,'中山公园',3),(50,50,'江苏路',3),(51,51,'静安寺',3),(52,52,'南京西路',3),(53,26,'人民广场',3),(54,54,'南京东路',3),(55,55,'陆家嘴',3),(56,56,'东昌路',3),(57,57,'世纪大道',3),(58,58,'上海科技馆',3),(59,59,'世纪公园',3),(60,60,'龙阳路',3),(61,61,'张江高科',3),(62,62,'金科路',3),(63,63,'广兰路',3),(64,64,'唐镇',3),(65,65,'创新中路',3),(66,66,'华夏东路',3),(67,67,'川沙',3),(68,68,'凌空路',3),(69,69,'远东大道',3),(70,70,'海天三路',3),(71,71,'浦东国际机场',3),(72,18,'上海南站',4),(73,73,'石龙路',4),(74,74,'龙漕路',4),(75,75,'漕溪路',4),(76,76,'宜山路',4),(77,77,'虹桥路',4),(78,78,'延安西路',4),(79,49,'中山公园',4),(80,80,'金沙江路',4),(81,81,'曹杨路',4),(82,82,'镇坪路',4),(83,83,'中潭路',4),(84,29,'上海火车站',4),(85,85,'宝山路',4),(86,86,'东宝兴路',4),(87,87,'虹口足球场',4),(88,88,'赤峰路',4),(89,89,'大柏树',4),(90,90,'江湾镇',4),(91,91,'殷高西路',4),(92,92,'长江南路',4),(93,93,'淞发路',4),(94,94,'张华浜',4),(95,95,'淞滨路',4),(96,96,'水产路',4),(97,97,'宝杨路',4),(98,98,'友谊路',4),(99,99,'铁力路',4),(100,100,'江杨北路',4),(124,124,'东安路',5),(122,122,'鲁班路',5),(121,121,'西藏南路',5),(120,120,'南浦大桥',5),(119,119,'塘桥',5),(118,118,'蓝村路',5),(117,117,'浦电路',5),(116,57,'世纪大道',5),(115,115,'浦东大道',5),(114,114,'杨树浦路',5),(113,113,'大连路',5),(112,112,'临平路',5),(111,111,'海伦路',5),(110,85,'宝山路',5),(109,29,'上海火车站',5),(108,83,'中潭路',5),(107,82,'镇坪路',5),(106,81,'曹杨路',5),(105,80,'金沙江路',5),(104,49,'中山公园',5),(103,78,'延安西路',5),(102,77,'虹桥路',5),(101,76,'宜山路',5),(125,125,'上海体育场',5),(126,20,'上海体育馆',5),(127,14,'莘庄',6),(128,128,'春申路',6),(129,129,'银都路',6),(130,130,'颛桥',6),(131,131,'北桥',6),(132,132,'剑川路',6),(133,133,'东川路',6),(134,134,'金平路',6),(135,135,'华宁路',6),(136,136,'文井路',6),(137,137,'闵行开发区',6),(138,138,'港城路',7),(139,139,'外高桥保税区北',7),(140,140,'航津路',7),(141,141,'外高桥保税区南',7),(142,142,'洲海路',7),(143,143,'五洲大道',7),(144,144,'东靖路',7),(145,145,'巨峰路',7),(146,146,'五莲路',7),(147,147,'博兴路',7),(148,148,'金桥路',7),(149,149,'云山路',7),(150,150,'德平路',7),(151,151,'北洋泾路',7),(152,152,'民生路',7),(153,153,'源深体育中心',7),(154,57,'世纪大道',7),(155,117,'浦电路',7),(156,118,'蓝村路',7),(157,157,'上海儿童医学中心',7),(158,158,'临沂新村',7),(159,159,'高科西路',7),(160,160,'东明路',7),(161,161,'高青路',7),(162,162,'华夏西路',7),(163,163,'上南路',7),(164,164,'灵岩南路',7),(165,165,'花木路',8),(166,60,'龙阳路',8),(167,167,'芳华路',8),(168,168,'锦绣路',8),(169,169,'杨高南路',8),(170,159,'高科西路',8),(171,171,'云台路',8),(172,172,'耀华路',8),(173,173,'长清路',8),(174,174,'后滩',8),(175,175,'船厂路',8),(176,124,'东安路',8),(177,177,'肇嘉浜路',8),(178,23,'常熟路',8),(179,51,'静安寺',8),(180,180,'昌平路',8),(181,181,'长寿路',8),(182,82,'镇坪路',8),(183,183,'岚皋路',8),(184,184,'新村路',8),(185,185,'大华三路',8),(186,186,'行知路',8),(187,187,'大场镇',8),(188,188,'场中路',8),(189,189,'上大路',8),(190,190,'南陈路',8),(191,191,'上海大学',8),(192,192,'市光路',9),(193,193,'嫩江路',9),(194,194,'翔殷路',9),(195,195,'黄兴公园',9),(196,196,'延吉中路',9),(197,197,'黄兴路',9),(198,198,'江浦路',9),(199,199,'鞍山新村',9),(200,200,'四平路',9),(201,201,'曲阳路',9),(202,87,'虹口足球场',9),(203,203,'西藏北路',9),(204,204,'中兴路',9),(205,205,'曲阜路',9),(206,26,'人民广场',9),(207,207,'大世界',9),(208,208,'老西门',9),(209,209,'陆家浜路',9),(210,121,'西藏南路',9),(211,172,'耀华路',9),(212,212,'成山路',9),(213,213,'杨思',9),(214,214,'凌兆新村',9),(215,215,'芦恒路',9),(216,216,'浦江镇',9),(217,217,'江月路',9),(218,218,'联航路',9),(219,219,'航天博物馆',9),(220,220,'松江新城',10),(221,221,'松江大学城',10),(222,222,'洞泾',10),(223,223,'佘山',10),(224,224,'泗泾',10),(225,225,'九亭',10),(226,226,'中春路',10),(227,227,'七宝',10),(228,228,'星中路',10),(229,229,'合川路',10),(230,230,'漕河泾开发区',10),(231,231,'桂林路',10),(232,76,'宜山路',10),(233,21,'徐家汇',10),(234,177,'肇嘉浜路',10),(235,235,'嘉善路',10),(236,236,'打浦桥',10),(237,237,'马当路',10),(238,209,'陆家浜路',10),(239,239,'小南门',10),(240,240,'商城路',10),(241,57,'世纪大道',10),(242,242,'杨高中路',10),(243,243,'航中路',11),(244,244,'紫藤路',11),(245,245,'龙柏新村',11),(246,246,'龙溪路',11),(247,247,'水城路',11),(248,248,'伊犁路',11),(249,249,'宋园路',11),(250,77,'虹桥路',11),(251,251,'交通大学',11),(252,252,'上海图书馆',11),(253,24,'陕西南路',11),(254,254,'新天地',11),(255,208,'老西门',11),(256,256,'豫园',11),(257,54,'南京东路',11),(258,258,'天潼路',11),(259,259,'四川北路',11),(260,111,'海伦路',11),(261,261,'邮电新村',11),(262,200,'四平路',11),(263,263,'同济大学',11),(264,264,'国权路',11),(265,265,'五角场',11),(266,266,'江湾体育场',11),(267,267,'三门路',11),(268,268,'殷高东路',11),(269,269,'新江湾城',11),(270,50,'江苏路',12),(271,271,'隆德路',12),(272,81,'曹杨路',12),(273,273,'枫桥路',12),(274,274,'真如',12),(275,275,'上海西站',12),(276,276,'李子园',12),(277,277,'祁连山路',12),(278,278,'武威路',12),(279,279,'桃浦新村',12),(280,280,'南翔',12),(281,281,'马陆',12),(282,282,'嘉定新城',12),(283,283,'白银路',12),(284,284,'嘉定西',12),(285,285,'嘉定北',12),(286,286,'上海赛车场',12),(287,287,'上海汽车城',12),(288,288,'安亭',12),(289,237,'马当路',13),(290,290,'卢浦大桥',13),(291,291,'世博大道',13),(20,20,'上海体育馆',2);

/*Table structure for table `35_systembuildingcomment` */

DROP TABLE IF EXISTS `35_systembuildingcomment`;

CREATE TABLE `35_systembuildingcomment` (
  `sbc_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sbc_cid` int(11) unsigned NOT NULL COMMENT '评论者ID',
  `sbc_buildingid` int(11) unsigned NOT NULL COMMENT '系统房源编号的ID',
  `sbc_traffice` int(11) NOT NULL COMMENT '交通(共10个数字,代表5颗星)',
  `sbc_facility` int(11) NOT NULL COMMENT '周围设施(共10个数字,代表5颗星)',
  `sbc_adorn` int(11) NOT NULL COMMENT '装潢(共10个数字,代表5颗星)',
  `sbc_comment` varchar(200) NOT NULL COMMENT '点评内容',
  `sbc_comdate` int(11) NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`sbc_id`),
  KEY `FK_UID000028` (`sbc_cid`) USING BTREE,
  KEY `FK_SYI0001` (`sbc_buildingid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_systembuildingcomment` */

insert  into `35_systembuildingcomment`(`sbc_id`,`sbc_cid`,`sbc_buildingid`,`sbc_traffice`,`sbc_facility`,`sbc_adorn`,`sbc_comment`,`sbc_comdate`) values (1,55,1,1,1,1,'很好很强大的楼盘,四通八达啊.',1276226526),(2,56,1,2,3,1,'楼盘不错,在内环啊',1276226510),(3,58,1,3,2,1,'恩,很好的楼盘',1276226426),(4,58,1,2,3,2,'我觉得一般,没有什么亮点.',1276229426),(5,58,1,9,10,5,'床前明月光,疑是地上霜.抬头望明月,低头思故乡.',1277809132),(6,56,1,10,5,3,'一般般吧.其他有别的亮点.',1277809332),(7,55,1,4,7,4,'楼盘实在太差了..哎...',1277809432),(8,55,1,5,6,10,'你好,测试是否评论成功',1277979394),(9,55,1,8,9,5,'第二次测试',1277979613),(12,55,7,7,6,4,'ASDFAFAF',1279687048),(14,55,7,4,5,7,'CESHICE',1279687206),(16,55,7,7,6,5,'阿斯顿发地方',1279689152),(18,55,1,6,5,5,'aaaaaaaaa',1281706984);

/*Table structure for table `35_systembuildinginfo` */

DROP TABLE IF EXISTS `35_systembuildinginfo`;

CREATE TABLE `35_systembuildinginfo` (
  `sbi_buildingid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sbi_buildingname` varchar(50) NOT NULL COMMENT '楼盘名称',
  `sbi_pinyinshortname` varchar(50) NOT NULL COMMENT '拼音缩写',
  `sbi_province` int(10) NOT NULL COMMENT '省份',
  `sbi_city` int(10) NOT NULL COMMENT '城市',
  `sbi_district` int(10) DEFAULT NULL COMMENT '行政区',
  `sbi_section` int(10) DEFAULT NULL COMMENT '版块',
  `sbi_loop` int(10) DEFAULT NULL COMMENT '几环',
  `sbi_tradecircle` int(10) DEFAULT NULL COMMENT '商圈',
  `sbi_busway` varchar(200) DEFAULT NULL COMMENT '临近轨道',
  `sbi_address` varchar(200) DEFAULT NULL COMMENT '地址',
  `sbi_foreign` int(11) DEFAULT NULL COMMENT '是否涉外',
  `sbi_openingtime` int(11) DEFAULT NULL COMMENT '开盘时间',
  `sbi_propertyname` varchar(50) DEFAULT NULL COMMENT '物业名称',
  `sbi_developer` varchar(50) DEFAULT NULL COMMENT '开发商',
  `sbi_berthnum` int(11) DEFAULT NULL COMMENT '车位数量',
  `sbi_rentberth` float DEFAULT NULL COMMENT '车位租金',
  `sbi_propertyprice` float NOT NULL COMMENT '物业管理费，单位元/m2/月',
  `sbi_propertydegree` int(11) DEFAULT NULL COMMENT '物业级别，甲乙丙',
  `sbi_elevatornum` int(11) DEFAULT NULL COMMENT '电梯数量',
  `sbi_fireelevatornum` int(11) DEFAULT NULL COMMENT '消防电梯数量',
  `sbi_buildingarea` float DEFAULT NULL COMMENT '建筑总面积',
  `sbi_floorarea` float DEFAULT NULL COMMENT '标准层面积',
  `sbi_floor` int(11) DEFAULT NULL COMMENT '层数',
  `sbi_floordownground` int(11) DEFAULT NULL COMMENT '地下层数',
  `sbi_floorupground` int(11) DEFAULT NULL COMMENT '地上层数',
  `sbi_traffic` varchar(200) DEFAULT NULL COMMENT '交通情况',
  `sbi_roomnum` int(11) unsigned DEFAULT NULL COMMENT '房间套数',
  `sbi_buildingdesc` text COMMENT '楼盘描述',
  `sbi_titlepic` int(10) unsigned DEFAULT NULL COMMENT '标题图片id(对应picture表中的主键)',
  `sbi_avgrentprice` int(11) DEFAULT NULL COMMENT '平均租金',
  `sbi_avgsellprice` int(11) DEFAULT NULL COMMENT '平均售价',
  `sbi_isnew` int(11) DEFAULT NULL COMMENT '是否是新楼盘',
  `sbi_x` varchar(200) DEFAULT NULL COMMENT 'x坐标',
  `sbi_y` varchar(200) DEFAULT NULL COMMENT '坐标Y轴',
  `sbi_tag` varchar(200) DEFAULT NULL COMMENT '标签',
  `sbi_recordtime` int(11) unsigned NOT NULL COMMENT '入库时间',
  `sbi_updatetime` int(11) unsigned NOT NULL COMMENT '最近更新时间',
  PRIMARY KEY (`sbi_buildingid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_systembuildinginfo` */

insert  into `35_systembuildinginfo`(`sbi_buildingid`,`sbi_buildingname`,`sbi_pinyinshortname`,`sbi_province`,`sbi_city`,`sbi_district`,`sbi_section`,`sbi_loop`,`sbi_tradecircle`,`sbi_busway`,`sbi_address`,`sbi_foreign`,`sbi_openingtime`,`sbi_propertyname`,`sbi_developer`,`sbi_berthnum`,`sbi_rentberth`,`sbi_propertyprice`,`sbi_propertydegree`,`sbi_elevatornum`,`sbi_fireelevatornum`,`sbi_buildingarea`,`sbi_floorarea`,`sbi_floor`,`sbi_floordownground`,`sbi_floorupground`,`sbi_traffic`,`sbi_roomnum`,`sbi_buildingdesc`,`sbi_titlepic`,`sbi_avgrentprice`,`sbi_avgsellprice`,`sbi_isnew`,`sbi_x`,`sbi_y`,`sbi_tag`,`sbi_recordtime`,`sbi_updatetime`) values (1,'万科大楼','wankedalou',9,35,47,124,1,1,'4,2,1','浦东新区张杨路177号',1,1275987044,'安心物业','王邦地产开发',200,100,50,1,50,10,2008,130,30,2,28,'良好',50,'这个楼盘很好,很强大.',1,5000,300000,1,'121.55814170837402','31.21625150406156','14',1275987044,1275987044),(2,'海景楼盘','aceanPlace',9,35,47,130,4,1,'2,1','金沙区某某路',0,1275990215,'安心物业','王邦地产开发',200,100,50,1,50,10,2008,130,30,2,28,'良好',30,'这个楼盘很好,很强大.',2,1000,1000000,1,'121.46364212036133','31.22887612990235','12',1275990215,1275990215),(3,'小洋人楼盘','littleman',9,35,47,141,3,1,'2,1','某城某区小城',0,1276056120,'安心物业','王邦地产开发',200,100,50,1,50,10,2008,130,30,2,28,'良好',50,'这个楼盘很好,很强大.',3,2000,9000000,1,'121.43008232116699','31.210525827369935','11',1276056120,1276056120),(4,'绿巨人楼盘','greenman',9,35,47,125,1,1,'2,14','外星',0,1276056120,'安心物业','王邦地产开发',200,100,50,1,50,10,2008,130,30,2,28,'良好',30,'这个楼盘很好,很强大.',4,1200,1250000,1,'121.4260482788086','31.164634492211114','10',1276056120,1276056120),(5,'野地楼盘','littleman',9,35,47,124,2,1,'2,1','某城某区小城',0,1276059451,'安心物业','王邦地产开发',200,100,50,1,50,10,2008,130,30,2,28,'良好',50,'这个楼盘很好,很强大.',5,2100,1000000,1,'121.52157783508301','31.14252528930545','13',1276059451,1276059451),(6,'超人楼盘','greenman',9,35,47,127,2,1,'2,1','外星',0,1276059451,'安心物业','王邦地产开发',200,100,50,1,50,10,2008,130,30,2,28,'良好',30,'这个楼盘很好,很强大.',6,3000,3360000,1,'121.48690223693848','31.109241587245783','10',1276059451,1276059451),(7,'灰太狼楼盘','littleman',9,35,47,126,3,1,'2,1','某城某区小城',0,1278604800,'安心物业','王邦地产开发',200,100,50,1,50,10,2008,130,30,2,28,'良好',50,'这个楼盘很好,很强大.',7,1800,991000,1,'121.50635361671448','31.236123517910816','11',1276059471,1276059471),(8,'新颖楼盘','greenman',9,35,47,129,4,1,'2,1','外星',0,1278604800,'安心物业','王邦地产开发',200,100,50,1,50,10,2008,130,30,2,28,'良好',30,'这个楼盘很好,很强大.',8,2200,1450000,1,'121.61358833312988','31.24201275794166','13',1276059471,1276059471),(9,'海上景庭','hsjt',9,35,48,125,1,122,'','',0,1278432000,'','',NULL,NULL,110,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'',NULL,NULL,NULL,0,'aa','aa','',1281696317,1281698039);

/*Table structure for table `35_tagrelation` */

DROP TABLE IF EXISTS `35_tagrelation`;

CREATE TABLE `35_tagrelation` (
  `id` int(11) NOT NULL,
  `tr_tagid` int(11) NOT NULL COMMENT '关联35_tags表的主键ID',
  `tr_sourceid` int(11) NOT NULL COMMENT '房源ID',
  `tr_type` int(11) NOT NULL COMMENT '房源类别。1:表示系统房源 2:写字楼房源 3:工业厂房房源 4:商铺房源 5:大型项目房源 6:生意转让房源',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_tagrelation` */

insert  into `35_tagrelation`(`id`,`tr_tagid`,`tr_sourceid`,`tr_type`) values (1,1,1,2),(2,1,2,2),(3,7,3,2),(4,7,4,2),(5,2,1,2),(6,2,2,2),(7,8,3,2),(8,3,1,2),(9,4,1,2),(10,5,1,2),(13,8,4,2),(14,9,4,2);

/*Table structure for table `35_tags` */

DROP TABLE IF EXISTS `35_tags`;

CREATE TABLE `35_tags` (
  `tag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(128) NOT NULL,
  `tag_belong` int(11) NOT NULL DEFAULT '0' COMMENT '隶属于哪种房源类型；1:表示系统房源 2:写字楼房源 3:工业厂房房源 4:商铺房源 5:大型项目房源 6:生意转让房源',
  `tag_frequency` int(11) DEFAULT '0',
  `markettype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '租售类型 0：为租 1：为售',
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `35_tags` */

insert  into `35_tags`(`tag_id`,`tag_name`,`tag_belong`,`tag_frequency`,`markettype`) values (1,'全新装修',2,0,1),(2,'创意办公',2,0,1),(3,'架空地板',2,0,1),(4,'环景办公',2,0,1),(5,'房型方正',2,0,1),(6,'上午别墅',2,0,1),(7,'地铁办公',2,0,0),(8,'高得房',2,0,0),(9,'景观落地窗',2,0,0),(10,'豪华装修',1,1,0),(11,'经济办公',1,2,0),(12,'商务氛围',1,3,0),(13,'环境优雅',1,1,0),(14,'交通便利',1,5,1);

/*Table structure for table `35_twitter` */

DROP TABLE IF EXISTS `35_twitter`;

CREATE TABLE `35_twitter` (
  `t_id` int(10) unsigned NOT NULL COMMENT '主键id',
  `t_sourceid` int(10) unsigned DEFAULT NULL COMMENT '房源id',
  `t_sourcetype` int(10) unsigned DEFAULT NULL COMMENT '房源类型',
  `t_message` varchar(200) DEFAULT NULL COMMENT '微博信息',
  `t_recordtime` int(10) unsigned DEFAULT NULL COMMENT '发表时间',
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_twitter` */

insert  into `35_twitter`(`t_id`,`t_sourceid`,`t_sourcetype`,`t_message`,`t_recordtime`) values (1,1,1,'万科大楼,让你乐呵呵.',1279009727);

/*Table structure for table `35_uagent` */

DROP TABLE IF EXISTS `35_uagent`;

CREATE TABLE `35_uagent` (
  `ua_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `ua_uid` int(11) unsigned NOT NULL COMMENT 'user表外键',
  `ua_province` int(10) NOT NULL COMMENT '省份外键',
  `ua_city` int(10) NOT NULL COMMENT '城市外键',
  `ua_district` int(10) NOT NULL COMMENT '行政区外键',
  `ua_section` int(10) NOT NULL COMMENT '版块外键',
  `ua_realname` varchar(20) DEFAULT NULL COMMENT '真实姓名',
  `ua_tel` varchar(20) DEFAULT NULL COMMENT '电话号码',
  `ua_msn` varchar(50) DEFAULT NULL COMMENT 'msn',
  `ua_email` varchar(50) NOT NULL COMMENT 'Email',
  `ua_comid` int(11) DEFAULT NULL COMMENT '公司id外键',
  `ua_photourl` varchar(200) DEFAULT NULL COMMENT '照片地址',
  `ua_scardurl` varchar(200) DEFAULT NULL COMMENT '身份证地址',
  `ua_bcardurl` varchar(200) DEFAULT NULL COMMENT '名片地址',
  `ua_scardid` varchar(20) DEFAULT NULL COMMENT '身份证号码',
  `ua_check` set('1','0') NOT NULL DEFAULT '0' COMMENT '审核状态(-1未通过,0审核中,1通过)',
  `ua_level` int(11) NOT NULL DEFAULT '0' COMMENT '经纪人等级',
  `ua_post` text COMMENT '经纪人公告',
  PRIMARY KEY (`ua_id`),
  KEY `FK_UID003` (`ua_uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_uagent` */

insert  into `35_uagent`(`ua_id`,`ua_uid`,`ua_province`,`ua_city`,`ua_district`,`ua_section`,`ua_realname`,`ua_tel`,`ua_msn`,`ua_email`,`ua_comid`,`ua_photourl`,`ua_scardurl`,`ua_bcardurl`,`ua_scardid`,`ua_check`,`ua_level`,`ua_post`) values (1,51,0,0,0,0,'demo','12312','adad123','dsada',1,'/ua/demoagent/photo/liuchuanfeng.jpg','%2Fua%2Fdemoagent%2Fscard%2F1267263096000000.jpg','%2Fua%2Fdemoagent%2Fbcard%2F1267263452000000.jpg','12312321312','0',0,NULL),(2,55,0,0,0,0,'','','','xiaping217@hotamail.com',0,'/ua/demoagent/photo/1267200571000000.jpg',NULL,NULL,'','0',0,NULL),(3,59,11,11,11,11,'','','','11',0,'/ua/demoagent/photo/1267200571000000.jpg',NULL,NULL,'','0',0,NULL),(4,53,9,9,47,0,'钱国忠','13871777742','sony@hotmail.com','sony@hotmail.com',1,'/ua/demoagent/photo/1267200571000000.jpg','%2Fua%2Fdemoagent%2Fphoto%2F1267200571000000.jpg','%2Fua%2Fdemoagent%2Fphoto%2F1267200571000000.jpg','121313213','0',3,NULL),(7,66,0,0,0,0,'戴朝清','13773171051','','daqing0909@163.com',0,'%2Fua%2Fdaqing4%2Fphoto%2F1280972096000000.jpg','%2FUpload%2Fua%2Fdaqing4%2Fscard%2F1280917725000000.gif',NULL,'530423198609090613','0',0,NULL);

/*Table structure for table `35_uagentcomment` */

DROP TABLE IF EXISTS `35_uagentcomment`;

CREATE TABLE `35_uagentcomment` (
  `uac_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uac_cid` int(11) unsigned NOT NULL,
  `uac_agentid` int(11) unsigned NOT NULL,
  `uac_quality` int(11) NOT NULL,
  `uac_service` int(11) NOT NULL,
  `uac_comment` varchar(200) NOT NULL,
  `uac_comdate` int(11) NOT NULL,
  PRIMARY KEY (`uac_id`),
  KEY `FK_UID00030` (`uac_cid`) USING BTREE,
  KEY `FK_AID0001` (`uac_agentid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_uagentcomment` */

insert  into `35_uagentcomment`(`uac_id`,`uac_cid`,`uac_agentid`,`uac_quality`,`uac_service`,`uac_comment`,`uac_comdate`) values (1,59,3,1,1,'test',2010);

/*Table structure for table `35_ucom` */

DROP TABLE IF EXISTS `35_ucom`;

CREATE TABLE `35_ucom` (
  `uc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uc_uid` int(11) unsigned NOT NULL COMMENT 'user外键id',
  `uc_city` int(10) NOT NULL COMMENT '城市',
  `uc_province` int(10) NOT NULL COMMENT '省份',
  `uc_district` int(10) NOT NULL COMMENT '行政区',
  `uc_section` int(10) NOT NULL COMMENT '版块',
  `uc_address` varchar(200) NOT NULL COMMENT '详细地址',
  `uc_fullname` varchar(50) NOT NULL COMMENT '公司全称',
  `uc_officetel` varchar(20) DEFAULT NULL COMMENT '固定电话',
  `uc_contact` varchar(20) NOT NULL COMMENT '业务联系人',
  `uc_tel` varchar(20) NOT NULL COMMENT '联系人电话',
  `uc_msn` varchar(50) DEFAULT NULL COMMENT '联系人msn',
  `uc_email` varchar(50) NOT NULL COMMENT '联系人email',
  `uc_recogniseurl` varchar(200) DEFAULT NULL COMMENT '运营执照保存路径(文件夹)',
  `uc_logo` varchar(200) DEFAULT NULL COMMENT 'logo图片地址',
  `uc_check` set('1','0') NOT NULL DEFAULT '0' COMMENT '-1未通过审核,0审核中,1审核通过',
  `uc_post` text,
  PRIMARY KEY (`uc_id`),
  KEY `FK_UID002` (`uc_uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_ucom` */

insert  into `35_ucom`(`uc_id`,`uc_uid`,`uc_city`,`uc_province`,`uc_district`,`uc_section`,`uc_address`,`uc_fullname`,`uc_officetel`,`uc_contact`,`uc_tel`,`uc_msn`,`uc_email`,`uc_recogniseurl`,`uc_logo`,`uc_check`,`uc_post`) values (1,50,0,0,0,123,'dkahsdkasjdlsajkd','顺诚房地产公司','1231231','dkadcn','12345','214423','sda@da..com','%2FUpload%2Fua%2Fdemocom%2Frecognise%2F1267270979000000.jpg',NULL,'0',NULL),(2,58,0,11,111,111,'111','111','','11','11','','11',NULL,NULL,'0',NULL);

/*Table structure for table `35_ucompanycomment` */

DROP TABLE IF EXISTS `35_ucompanycomment`;

CREATE TABLE `35_ucompanycomment` (
  `ucc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ucc_cid` int(11) unsigned NOT NULL,
  `ucc_comid` int(11) unsigned NOT NULL,
  `ucc_quality` int(11) NOT NULL,
  `ucc_service` int(11) NOT NULL,
  `ucc_comment` varchar(200) NOT NULL,
  `ucc_comdate` int(11) NOT NULL,
  PRIMARY KEY (`ucc_id`),
  KEY `FK_UID00031` (`ucc_cid`) USING BTREE,
  KEY `FK_CID0001` (`ucc_comid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_ucompanycomment` */

/*Table structure for table `35_unormal` */

DROP TABLE IF EXISTS `35_unormal`;

CREATE TABLE `35_unormal` (
  `puser_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `puser_uid` int(11) unsigned NOT NULL COMMENT 'user表外键',
  `puser_tel` varchar(20) NOT NULL COMMENT '电话',
  `puser_email` varchar(50) NOT NULL COMMENT '电子邮件',
  `puser_logopath` varchar(200) DEFAULT NULL COMMENT '头像路径',
  `puser_vip` set('1','0') DEFAULT '0' COMMENT '是否vip',
  PRIMARY KEY (`puser_id`),
  KEY `FK_UID001` (`puser_uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_unormal` */

insert  into `35_unormal`(`puser_id`,`puser_uid`,`puser_tel`,`puser_email`,`puser_logopath`,`puser_vip`) values (1,33,'21321','231231',NULL,'0'),(2,34,'12345678900','123213123',NULL,'0'),(3,52,'123213','1232131',NULL,'0'),(4,53,'12321312','13213121','%2Fpuser%2Fdemopuser2%2Flogo%2F1272969842000000.jpg','0'),(5,54,'','',NULL,'0'),(6,56,'feng','feng',NULL,'0'),(7,57,'1111','1111',NULL,'0'),(8,60,'13773171051','da@a.c','%2Fpuser%2Fdaqing1%2Flogo%2F1280916886000000.jpg','0'),(9,62,'13773171051','daqing0909@163.com',NULL,'0'),(10,63,'13773171051','daqing0909@163.com',NULL,'0'),(11,67,'15001756216','zouliming@sina.com','/puser/12815294551.jpg','0');

/*Table structure for table `35_upersoncomment` */

DROP TABLE IF EXISTS `35_upersoncomment`;

CREATE TABLE `35_upersoncomment` (
  `upc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `upc_cid` int(11) unsigned NOT NULL,
  `upc_personid` int(11) unsigned NOT NULL,
  `upc_quality` int(11) NOT NULL,
  `upc_service` int(11) NOT NULL,
  `upc_comment` varchar(200) NOT NULL,
  `upc_comdate` int(11) NOT NULL,
  PRIMARY KEY (`upc_id`),
  KEY `FK_UID00032` (`upc_cid`) USING BTREE,
  KEY `FK_PID0001` (`upc_personid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_upersoncomment` */

insert  into `35_upersoncomment`(`upc_id`,`upc_cid`,`upc_personid`,`upc_quality`,`upc_service`,`upc_comment`,`upc_comdate`) values (1,56,6,1,1,'test',2010);

/*Table structure for table `35_user` */

DROP TABLE IF EXISTS `35_user`;

CREATE TABLE `35_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL COMMENT '名字',
  `user_salt` varchar(50) NOT NULL,
  `user_pwd` varchar(50) NOT NULL COMMENT '密码',
  `user_role` int(11) NOT NULL COMMENT '角色',
  `user_regtime` int(11) DEFAULT NULL COMMENT '注册时间',
  `user_loginnum` int(11) DEFAULT '0' COMMENT '登录次数',
  `user_lasttime` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `user_lastip` varchar(50) DEFAULT NULL COMMENT '最后登录ip',
  `user_value` float DEFAULT '0' COMMENT '贡献值',
  `user_point` float DEFAULT '0' COMMENT '拥有的积分',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `35_user` */

insert  into `35_user`(`user_id`,`user_name`,`user_salt`,`user_pwd`,`user_role`,`user_regtime`,`user_loginnum`,`user_lasttime`,`user_lastip`,`user_value`,`user_point`) values (33,'12312','17476c11681f657e8dd6634ec916cc6f','333d926743c037dcf1b6fa5d96c04d90',1,2010,0,NULL,NULL,0,0),(50,'democom','923bdea7afdeb28b2b0c9f8b261c7108','090cef4513c577b98ef867688aa375db',4,2010,17,2010,'180.120.39.250',0,0),(51,'demoagent','bceeb5c891379e9f0e31706ff953d2be','51b2ed00266669862bc43a9fa4a98476',1,2010,6,2010,'222.190.112.112',0,0),(52,'pdemo','9ae24bda0af965f23f87effd9250061b','7aa75d803532da6914b603b928d96e76',1,2010,0,NULL,NULL,0,0),(53,'李嘉诚','f30ca36712e7ae9b5420ce7641e05d6f','d915aa33d9d1607d5b89abbcc674a975',1,2010,23,2010,'221.230.10.151',0,0),(54,'demopuser','6193040352ea95e1f9644b5383c3c754','780d8a5c585d622ab776bbe28007348c',1,2010,0,NULL,NULL,0,0),(55,'xiaping','e328cb28f1e50a6465a57846c33d9c57','66dbe7f85142b1266c528fdd303485b7',2,2010,0,NULL,NULL,0,0),(56,'feng','20476ec9b5c329160a40a9c3ce9a634d','91e9baa70c0c170b9cffa81d2e099855',1,2010,23,2010,'127.0.0.1',0,100),(57,'feng1','d3ea62842e280a640a2d19f280c2338b','44ae3c62c20022bc9bb8a7125036d00a',1,2010,5,1280627832,'218.82.182.76',0,100),(58,'顺诚','85f8eabc5736745b147edb22e4de15c7','4ae7bcba424e831646873715057df78e',4,2010,1,2010,'222.65.208.161',0,100),(59,'feng2','d6caa1cb2a7faf73f17a7b75995f6ed5','b8ef0b3c8c35212c68783d7a06c60b41',2,2010,2,2010,'127.0.0.1',0,100),(60,'daqing1','11f8a6a7f2af0c1c8cbd0025d52ff229','9dd8e64ab4106972165e1cd1ebb7cd80',1,1278052195,22,1280916267,'127.0.0.1',0,100),(61,'crcrcr','11f8a6a7f2af0c1c8cbd0025d52ff229','9dd8e64ab4106972165e1cd1ebb7cd80',1,1278555000,37,1280480966,'222.65.3.0',0,100),(62,'daqing2','e7741401b2585e281c0c5f034a86fda3','dbaf482a50598713fc0b57186e95b90a',1,1280478847,2,1280481104,'222.65.3.0',0,0),(63,'daqing3','f3f63882c6b909c8871f827cad6e18ee','0488c32381084e1e1a55afdd5e8b3460',1,1280481749,5,1280919558,'222.65.3.0',0,0),(66,'daqing4','a81578e899ae2d5ad38fbe110c522b44','59b26a672e56944e254a6949ba8ee8de',2,1280917344,10,1280971332,'222.65.3.0',0,0),(67,'zouliming','2b119ae616980ab6a7510dfce690d22f','524c38ae028c016b6d9f1b77098e597a',1,1280982771,8,1281498588,'127.0.0.1',0,0);

/*Table structure for table `35_userimpression` */

DROP TABLE IF EXISTS `35_userimpression`;

CREATE TABLE `35_userimpression` (
  `ui_userid` int(10) unsigned NOT NULL COMMENT '用户的id',
  `ui_impressionid` int(10) unsigned NOT NULL COMMENT '印象id的外键',
  `ui_recordtime` int(10) unsigned NOT NULL COMMENT '提交印象的时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_userimpression` */

insert  into `35_userimpression`(`ui_userid`,`ui_impressionid`,`ui_recordtime`) values (1,1,1278923510),(1,8,1278928974),(1,7,1278928577),(1,9,1278929018),(1,10,1278929076),(1,11,1278929085),(1,12,1278929092),(1,13,1278929193),(1,14,1278933594),(1,15,1278933686),(1,16,1278934333),(1,17,1278934338),(1,18,1278934507),(1,19,1278934519),(1,20,1278934524),(1,21,1278934530),(1,22,1278934538),(1,23,1278934544),(1,24,1278934549),(1,25,1278934555),(1,26,1278936254),(1,27,1278936324),(1,28,1278936328),(1,29,1278936333),(1,30,1278936339),(1,31,1278991239),(1,32,1278991242),(1,33,1278991245),(1,34,1278991248),(1,35,1278991251),(1,36,1278991254),(1,37,1278991257),(1,38,1278991261),(1,39,1278991268),(1,40,1278991273),(1,41,1278991279),(1,42,1278991294),(1,43,1278991302),(1,44,1279012615);

/*Table structure for table `35_visitcount` */

DROP TABLE IF EXISTS `35_visitcount`;

CREATE TABLE `35_visitcount` (
  `vc_id` int(11) NOT NULL COMMENT '主键id',
  `vc_type` int(11) NOT NULL COMMENT '房源或者用户的类型编号',
  `vc_tid` int(11) NOT NULL COMMENT '房源或者用户的id ',
  `vc_value` int(11) NOT NULL COMMENT '访问量数值',
  PRIMARY KEY (`vc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `35_visitcount` */

insert  into `35_visitcount`(`vc_id`,`vc_type`,`vc_tid`,`vc_value`) values (1,1,1,10),(2,1,2,1),(3,1,3,3),(4,1,4,4),(5,1,5,5),(6,1,6,6),(7,1,7,7),(8,1,8,8),(9,2,1,100);

/*Table structure for table `res` */

DROP TABLE IF EXISTS `res`;

CREATE TABLE `res` (
  `ATTRIB` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL,
  PRIMARY KEY (`ATTRIB`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `res` */

insert  into `res`(`ATTRIB`,`ID`) values ('35_systembuildingcomment',18),('35_findcondition',8),('35_housecollect',12),('35_region',162),('35_picture',19);

/*Table structure for table `35_viewbusrent` */

DROP TABLE IF EXISTS `35_viewbusrent`;

/*!50001 DROP VIEW IF EXISTS `35_viewbusrent` */;
/*!50001 DROP TABLE IF EXISTS `35_viewbusrent` */;

/*!50001 CREATE TABLE  `35_viewbusrent`(
 `br_id` int(11) unsigned ,
 `br_rentprice` float ,
 `br_iscontainprocost` int(11) ,
 `br_renttype` int(11) ,
 `br_payway` int(11) ,
 `br_basetime` float ,
 `bt_id` int(11) unsigned ,
 `bt_ishigh` int(11) ,
 `bt_isrecommend` int(11) ,
 `bt_ishomepage` int(11) ,
 `bt_isvideo` int(11) ,
 `bt_is3d` int(11) ,
 `bt_isconsign` int(11) ,
 `bt_consignid` int(11) ,
 `bt_isnew` int(11) ,
 `bt_ishurry` int(11) ,
 `bt_check` int(11) ,
 `bb_businessid` int(11) unsigned ,
 `bb_businesstype` int(11) ,
 `bb_province` int(10) ,
 `bb_city` int(10) ,
 `bb_businessaddress` varchar(200) ,
 `bb_buildingarea` float ,
 `bb_businessprice` float ,
 `bb_propertytype` int(11) ,
 `bb_companytype` int(11) ,
 `bb_registerfunds` float ,
 `bb_mainservice` varchar(100) ,
 `bb_turnoverly` float ,
 `bb_profitly` float ,
 `bb_salestaxly` float ,
 `bb_incometaxly` float ,
 `bb_runtime` float ,
 `bb_consumptionperson` float ,
 `bb_staffnum` float ,
 `bb_vipnum` int(11) ,
 `bb_stocktransfer` float ,
 `bb_uid` int(11) unsigned ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_point` float ,
 `user_value` float ,
 `bb_releasedate` int(11) ,
 `bb_expiredate` int(11) ,
 `bp_id` int(11) unsigned ,
 `bp_businesstitle` varchar(50) ,
 `bp_serialnum` varchar(50) ,
 `bp_businessdesc` text ,
 `bp_traffice` varchar(50) ,
 `bp_carparking` varchar(50) ,
 `bp_facilityaround` varchar(50) ,
 `bp_titlepicurl` int(11) 
)*/;

/*Table structure for table `35_viewbusreq` */

DROP TABLE IF EXISTS `35_viewbusreq`;

/*!50001 DROP VIEW IF EXISTS `35_viewbusreq` */;
/*!50001 DROP TABLE IF EXISTS `35_viewbusreq` */;

/*!50001 CREATE TABLE  `35_viewbusreq`(
 `br_id` int(11) unsigned ,
 `br_uid` int(11) unsigned ,
 `br_province` int(11) ,
 `br_city` int(11) ,
 `br_address` varchar(200) ,
 `br_title` varchar(50) ,
 `br_desc` text ,
 `br_sellbrrent` int(11) ,
 `br_releasedate` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_value` float ,
 `user_point` float ,
 `br_expiredate` int(4) ,
 `br_district` int(11) 
)*/;

/*Table structure for table `35_viewbussell` */

DROP TABLE IF EXISTS `35_viewbussell`;

/*!50001 DROP VIEW IF EXISTS `35_viewbussell` */;
/*!50001 DROP TABLE IF EXISTS `35_viewbussell` */;

/*!50001 CREATE TABLE  `35_viewbussell`(
 `bb_businessid` int(11) unsigned ,
 `bb_uid` int(11) unsigned ,
 `bb_businesstype` int(11) ,
 `bb_province` int(10) ,
 `bb_city` int(10) ,
 `bb_businessaddress` varchar(200) ,
 `bb_buildingarea` float ,
 `bb_businessprice` float ,
 `bb_propertytype` int(11) ,
 `bb_companytype` int(11) ,
 `bb_registerfunds` float ,
 `bb_mainservice` varchar(100) ,
 `bb_turnoverly` float ,
 `bb_profitly` float ,
 `bb_salestaxly` float ,
 `bb_incometaxly` float ,
 `bb_runtime` float ,
 `bb_consumptionperson` float ,
 `bb_staffnum` float ,
 `bb_vipnum` int(11) ,
 `bb_stocktransfer` float ,
 `bb_expiredate` int(11) ,
 `bt_id` int(11) unsigned ,
 `bt_ishigh` int(11) ,
 `bt_isrecommend` int(11) ,
 `bt_ishomepage` int(11) ,
 `bt_isvideo` int(11) ,
 `bt_is3d` int(11) ,
 `bt_isconsign` int(11) ,
 `bt_consignid` int(11) ,
 `bt_isnew` int(11) ,
 `bt_ishurry` int(11) ,
 `bt_check` int(11) ,
 `bs_id` int(11) unsigned ,
 `bs_sellprice` float ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_point` float ,
 `user_value` float ,
 `bb_releasedate` int(11) ,
 `bp_serialnum` varchar(50) ,
 `bp_businesstitle` varchar(50) ,
 `bp_businessdesc` text ,
 `bp_traffice` varchar(50) ,
 `bp_carparking` varchar(50) ,
 `bp_facilityaround` varchar(50) ,
 `bp_id` int(11) unsigned ,
 `bp_titlepicurl` int(11) 
)*/;

/*Table structure for table `35_viewfactrent` */

DROP TABLE IF EXISTS `35_viewfactrent`;

/*!50001 DROP VIEW IF EXISTS `35_viewfactrent` */;
/*!50001 DROP TABLE IF EXISTS `35_viewfactrent` */;

/*!50001 CREATE TABLE  `35_viewfactrent`(
 `fp_id` int(11) unsigned ,
 `fp_factorytitle` varchar(50) ,
 `fp_serialnum` varchar(50) ,
 `fp_factorydesc` text ,
 `fp_traffice` varchar(50) ,
 `fp_carparking` varchar(50) ,
 `fr_id` int(11) unsigned ,
 `fr_rentprice` float ,
 `fr_iscontainprocost` int(11) ,
 `fr_renttype` int(11) ,
 `fr_payway` int(11) ,
 `fr_basetime` float ,
 `fb_factoryid` int(11) unsigned ,
 `fb_uid` int(11) unsigned ,
 `fb_province` int(10) ,
 `fb_city` int(10) ,
 `fb_factoryname` varchar(50) ,
 `fb_tradecircle` int(10) ,
 `fb_busway` varchar(200) ,
 `fb_propertyinfo` int(11) ,
 `fb_buildingarea` float ,
 `fb_coverarea` float ,
 `fb_sparearea` float ,
 `fb_buildingage` varchar(20) ,
 `fb_plotratio` float ,
 `fb_greenratio` float ,
 `fb_factorytype` int(11) ,
 `fb_floor` int(11) ,
 `fb_structure` int(11) ,
 `fb_crane` float ,
 `fb_loadbearing` float ,
 `fb_elecpower` float ,
 `fb_water` float ,
 `fb_adrondegree` int(11) ,
 `fb_communication` varchar(50) ,
 `fb_facilityaround` varchar(200) ,
 `fb_facilityindoor` varchar(200) ,
 `fb_sellorrent` int(11) ,
 `fb_expiredate` int(11) ,
 `ft_id` int(11) unsigned ,
 `ft_ishigh` int(11) ,
 `ft_isrecommend` int(11) ,
 `ft_ishomepage` int(11) ,
 `ft_isvideo` int(11) ,
 `ft_is3d` int(11) ,
 `ft_isconsign` int(11) ,
 `ft_consignid` int(11) ,
 `ft_isnew` int(11) ,
 `ft_ishurry` int(11) ,
 `ft_check` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_point` float ,
 `user_value` float ,
 `fb_releasedate` int(11) ,
 `fb_suittrade` int(11) ,
 `fb_district` int(10) ,
 `fb_section` int(10) ,
 `fb_loop` int(10) ,
 `fp_facilityaround` varchar(200) ,
 `fp_titlepicurl` int(11) 
)*/;

/*Table structure for table `35_viewfactreq` */

DROP TABLE IF EXISTS `35_viewfactreq`;

/*!50001 DROP VIEW IF EXISTS `35_viewfactreq` */;
/*!50001 DROP TABLE IF EXISTS `35_viewfactreq` */;

/*!50001 CREATE TABLE  `35_viewfactreq`(
 `fr_id` int(11) unsigned ,
 `fr_uid` int(11) unsigned ,
 `fr_province` int(11) ,
 `fr_city` int(11) ,
 `fr_address` varchar(200) ,
 `fr_factorytype` int(11) ,
 `fr_factoryareamin` float ,
 `fr_factoryareamax` float ,
 `fr_facility` varchar(200) ,
 `fr_title` varchar(50) ,
 `fr_desc` text ,
 `fr_costmin` float ,
 `fr_costmax` float ,
 `fr_releasedate` int(11) ,
 `fr_expiredate` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_value` float ,
 `user_point` float ,
 `fr_sellorrent` int(11) ,
 `fr_district` int(11) 
)*/;

/*Table structure for table `35_viewfactsell` */

DROP TABLE IF EXISTS `35_viewfactsell`;

/*!50001 DROP VIEW IF EXISTS `35_viewfactsell` */;
/*!50001 DROP TABLE IF EXISTS `35_viewfactsell` */;

/*!50001 CREATE TABLE  `35_viewfactsell`(
 `fb_uid` int(11) unsigned ,
 `fb_province` int(10) ,
 `fb_city` int(10) ,
 `fb_factoryname` varchar(50) ,
 `fb_tradecircle` int(10) ,
 `fb_busway` varchar(200) ,
 `fb_propertyinfo` int(11) ,
 `fb_buildingarea` float ,
 `fb_coverarea` float ,
 `fb_sparearea` float ,
 `fb_buildingage` varchar(20) ,
 `fb_plotratio` float ,
 `fb_greenratio` float ,
 `fb_factorytype` int(11) ,
 `fb_floor` int(11) ,
 `fb_structure` int(11) ,
 `fb_crane` float ,
 `fb_loadbearing` float ,
 `fb_elecpower` float ,
 `fb_water` float ,
 `fb_adrondegree` int(11) ,
 `fb_communication` varchar(50) ,
 `fb_facilityaround` varchar(200) ,
 `fb_facilityindoor` varchar(200) ,
 `fb_sellorrent` int(11) ,
 `fb_expiredate` int(11) ,
 `ft_id` int(11) unsigned ,
 `ft_ishigh` int(11) ,
 `ft_isrecommend` int(11) ,
 `ft_ishomepage` int(11) ,
 `ft_isvideo` int(11) ,
 `ft_is3d` int(11) ,
 `ft_isconsign` int(11) ,
 `ft_consignid` int(11) ,
 `ft_isnew` int(11) ,
 `ft_ishurry` int(11) ,
 `ft_check` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_point` float ,
 `user_value` float ,
 `fp_id` int(11) unsigned ,
 `fp_factorytitle` varchar(50) ,
 `fp_serialnum` varchar(50) ,
 `fp_factorydesc` text ,
 `fp_traffice` varchar(50) ,
 `fp_carparking` varchar(50) ,
 `fp_facilityaround` varchar(200) ,
 `fb_factoryid` int(11) unsigned ,
 `fs_id` int(11) unsigned ,
 `fs_sellprice` float ,
 `fb_releasedate` int(11) ,
 `fb_suittrade` int(11) ,
 `fb_section` int(10) ,
 `fb_district` int(10) ,
 `fb_loop` int(10) ,
 `fp_titlepicurl` int(11) 
)*/;

/*Table structure for table `35_viewoffirent` */

DROP TABLE IF EXISTS `35_viewoffirent`;

/*!50001 DROP VIEW IF EXISTS `35_viewoffirent` */;
/*!50001 DROP TABLE IF EXISTS `35_viewoffirent` */;

/*!50001 CREATE TABLE  `35_viewoffirent`(
 `ob_officeid` int(11) unsigned ,
 `ob_uid` int(11) unsigned ,
 `ob_province` int(10) ,
 `ob_city` int(10) ,
 `ob_buildingtype` int(11) ,
 `ob_officename` varchar(50) ,
 `ob_officetype` int(11) ,
 `ob_tradecircle` int(10) ,
 `ob_busway` varchar(200) ,
 `ob_officeaddress` varchar(200) ,
 `ob_propertycomname` varchar(50) ,
 `ob_propertycost` float ,
 `ob_foreign` int(11) ,
 `ob_officearea` float ,
 `ob_floor` int(11) ,
 `ob_buildingera` int(11) ,
 `ob_cancut` int(11) ,
 `ob_adrondegree` int(11) ,
 `ob_officedegree` int(11) ,
 `ob_sellorrent` int(11) ,
 `ob_releasedate` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_value` float ,
 `user_point` float ,
 `op_id` int(11) unsigned ,
 `op_officetitle` varchar(50) ,
 `op_serialnum` varchar(50) ,
 `op_officedesc` text ,
 `op_traffice` varchar(50) ,
 `op_carparking` varchar(50) ,
 `op_facilityaround` varchar(50) ,
 `or_id` int(11) unsigned ,
 `or_rentprice` float ,
 `or_iscontainprocost` int(11) ,
 `or_renttype` int(11) ,
 `or_payway` int(11) ,
 `or_basetime` float ,
 `ot_id` int(11) unsigned ,
 `ot_ishigh` int(11) ,
 `ot_isrecommend` int(11) ,
 `ot_ishomepage` int(11) ,
 `ot_isvideo` int(11) ,
 `ot_is3d` int(11) ,
 `ot_isconsign` int(11) ,
 `ot_consignid` int(11) ,
 `ot_isnew` int(11) ,
 `ot_ishurry` int(11) ,
 `ot_check` int(11) ,
 `ob_expiredate` int(11) ,
 `ob_tag` varchar(200) ,
 `of_id` int(11) unsigned ,
 `of_carparking` tinyint(1) ,
 `of_warming` tinyint(1) ,
 `of_network` tinyint(1) ,
 `of_elecwater` tinyint(1) ,
 `of_elevator` tinyint(1) ,
 `of_lift` tinyint(1) ,
 `of_gas` tinyint(1) ,
 `of_aircondition` tinyint(1) ,
 `of_tv` tinyint(1) ,
 `of_door` tinyint(1) ,
 `ob_district` int(10) ,
 `ob_section` int(10) ,
 `ob_loop` int(10) ,
 `op_titlepicurl` int(11) 
)*/;

/*Table structure for table `35_viewoffireq` */

DROP TABLE IF EXISTS `35_viewoffireq`;

/*!50001 DROP VIEW IF EXISTS `35_viewoffireq` */;
/*!50001 DROP TABLE IF EXISTS `35_viewoffireq` */;

/*!50001 CREATE TABLE  `35_viewoffireq`(
 `or_id` int(11) unsigned ,
 `or_uid` int(11) unsigned ,
 `or_province` int(11) ,
 `or_city` int(11) ,
 `or_address` varchar(200) ,
 `or_buildingtype` int(11) ,
 `or_officetype` int(11) ,
 `or_officeareamin` float ,
 `or_officeareamax` float ,
 `or_floor` int(11) ,
 `or_cancut` int(11) ,
 `or_adrondegree` int(11) ,
 `or_officedegree` int(11) ,
 `or_facility` varchar(200) ,
 `or_title` varchar(50) ,
 `or_desc` text ,
 `or_sellorrent` int(11) ,
 `or_costmin` float ,
 `or_costmax` float ,
 `or_releasedate` int(11) ,
 `or_expiredate` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_point` float ,
 `user_value` float ,
 `or_district` int(11) 
)*/;

/*Table structure for table `35_viewoffisell` */

DROP TABLE IF EXISTS `35_viewoffisell`;

/*!50001 DROP VIEW IF EXISTS `35_viewoffisell` */;
/*!50001 DROP TABLE IF EXISTS `35_viewoffisell` */;

/*!50001 CREATE TABLE  `35_viewoffisell`(
 `ob_uid` int(11) unsigned ,
 `ob_province` int(10) ,
 `ob_city` int(10) ,
 `ob_buildingtype` int(11) ,
 `ob_officename` varchar(50) ,
 `ob_officetype` int(11) ,
 `ob_tradecircle` int(10) ,
 `ob_busway` varchar(200) ,
 `ob_officeaddress` varchar(200) ,
 `ob_propertycomname` varchar(50) ,
 `ob_officeid` int(11) unsigned ,
 `ob_propertycost` float ,
 `ob_foreign` int(11) ,
 `ob_officearea` float ,
 `ob_floor` int(11) ,
 `ob_buildingera` int(11) ,
 `ob_cancut` int(11) ,
 `ob_adrondegree` int(11) ,
 `ob_officedegree` int(11) ,
 `ob_sellorrent` int(11) ,
 `ob_releasedate` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_value` float ,
 `user_point` float ,
 `op_id` int(11) unsigned ,
 `op_officetitle` varchar(50) ,
 `op_serialnum` varchar(50) ,
 `op_officedesc` text ,
 `op_traffice` varchar(50) ,
 `op_carparking` varchar(50) ,
 `op_facilityaround` varchar(50) ,
 `os_id` int(11) unsigned ,
 `ot_id` int(11) unsigned ,
 `ot_ishigh` int(11) ,
 `ot_isrecommend` int(11) ,
 `ot_ishomepage` int(11) ,
 `ot_isvideo` int(11) ,
 `ot_is3d` int(11) ,
 `ot_isconsign` int(11) ,
 `ot_consignid` int(11) ,
 `ot_isnew` int(11) ,
 `ot_ishurry` int(11) ,
 `ot_check` int(11) ,
 `ob_expiredate` int(11) ,
 `ob_tag` varchar(200) ,
 `of_id` int(11) unsigned ,
 `of_carparking` tinyint(1) ,
 `of_warming` tinyint(1) ,
 `of_network` tinyint(1) ,
 `of_elecwater` tinyint(1) ,
 `of_elevator` tinyint(1) ,
 `of_lift` tinyint(1) ,
 `of_gas` tinyint(1) ,
 `of_aircondition` tinyint(1) ,
 `of_tv` tinyint(1) ,
 `of_door` tinyint(1) ,
 `ob_district` int(10) ,
 `ob_section` int(10) ,
 `ob_loop` int(10) ,
 `ob_sysid` int(11) ,
 `os_avgprice` int(10) unsigned ,
 `os_sumprice` int(10) unsigned ,
 `ob_allfloor` int(11) ,
 `ob_floornature` int(11) ,
 `ob_property` varchar(200) ,
 `ob_industry` int(11) ,
 `ob_towards` tinyint(1) unsigned zerofill ,
 `ob_updatedate` int(11) ,
 `op_titlepicurl` int(11) 
)*/;

/*Table structure for table `35_viewproject` */

DROP TABLE IF EXISTS `35_viewproject`;

/*!50001 DROP VIEW IF EXISTS `35_viewproject` */;
/*!50001 DROP TABLE IF EXISTS `35_viewproject` */;

/*!50001 CREATE TABLE  `35_viewproject`(
 `pb_projectid` int(11) unsigned ,
 `pb_uid` int(11) unsigned ,
 `pb_province` int(10) ,
 `pb_city` int(10) ,
 `pb_projcetaddress` varchar(200) ,
 `pb_transactionway` int(11) ,
 `pb_price` float ,
 `pb_releasedate` int(11) ,
 `pb_expiredate` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_point` float ,
 `user_value` float ,
 `pt_id` int(11) unsigned ,
 `pt_ishigh` int(11) ,
 `pt_isrecommend` int(11) ,
 `pt_ishomepage` int(11) ,
 `pt_isvideo` int(11) ,
 `pt_is3d` int(11) ,
 `pt_isconsign` int(11) ,
 `pt_consignid` int(11) ,
 `pt_isnew` int(11) ,
 `pt_ishurry` int(11) ,
 `pt_check` int(11) ,
 `pp_id` int(11) unsigned ,
 `pp_projecttitle` varchar(50) ,
 `pp_serialnum` varchar(50) ,
 `pp_projectdesc` text ,
 `pp_traffice` varchar(50) ,
 `pp_carparking` varchar(50) ,
 `pp_facilityaround` varchar(50) ,
 `pp_titlepicurl` int(11) 
)*/;

/*Table structure for table `35_viewprojreq` */

DROP TABLE IF EXISTS `35_viewprojreq`;

/*!50001 DROP VIEW IF EXISTS `35_viewprojreq` */;
/*!50001 DROP TABLE IF EXISTS `35_viewprojreq` */;

/*!50001 CREATE TABLE  `35_viewprojreq`(
 `pr_id` int(11) unsigned ,
 `pr_uid` int(11) unsigned ,
 `pr_province` int(11) ,
 `pr_city` int(11) ,
 `pr_address` varchar(200) ,
 `pr_title` varchar(50) ,
 `pr_desc` text ,
 `pr_costmin` float ,
 `pr_costmax` float ,
 `pr_releasedate` int(11) ,
 `pr_expiredate` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_value` float ,
 `user_point` float ,
 `pr_sellorrent` int(11) ,
 `pr_district` int(11) 
)*/;

/*Table structure for table `35_viewshoprent` */

DROP TABLE IF EXISTS `35_viewshoprent`;

/*!50001 DROP VIEW IF EXISTS `35_viewshoprent` */;
/*!50001 DROP TABLE IF EXISTS `35_viewshoprent` */;

/*!50001 CREATE TABLE  `35_viewshoprent`(
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_point` float ,
 `user_value` float ,
 `sb_shopid` int(11) unsigned ,
 `sb_uid` int(11) unsigned ,
 `sb_province` int(10) ,
 `sb_city` int(10) ,
 `sb_shopname` varchar(50) ,
 `sb_shoptype` int(11) ,
 `sb_selltype` int(11) ,
 `sb_businesstype` int(11) ,
 `sb_buildingname` varchar(50) ,
 `sb_tradecircle` int(10) ,
 `sb_busway` varchar(200) ,
 `sb_shopaddress` varchar(200) ,
 `sb_proprtycomname` varchar(50) ,
 `sb_propertycost` float ,
 `sb_shoparea` float ,
 `sb_shopusablearea` float ,
 `sb_floor` int(11) ,
 `sb_buildingage` varchar(20) ,
 `sb_cancut` int(11) ,
 `sb_adrondegree` int(11) ,
 `sb_sellorrent` int(11) ,
 `sb_releasedate` int(11) ,
 `sb_expiredate` int(11) ,
 `sp_id` int(11) unsigned ,
 `sp_shoptitle` varchar(50) ,
 `sp_serialnum` varchar(50) ,
 `sp_shopdesc` text ,
 `sp_traffice` varchar(50) ,
 `sp_carparking` varchar(50) ,
 `sp_facilityaround` varchar(50) ,
 `st_id` int(11) unsigned ,
 `st_ishigh` int(11) ,
 `st_isrecommend` int(11) ,
 `st_ishomepage` int(11) ,
 `st_isvideo` int(11) ,
 `st_is3d` int(11) ,
 `st_isconsign` int(11) ,
 `st_consignid` int(11) ,
 `st_isnew` int(11) ,
 `st_ishurry` int(11) ,
 `st_check` int(11) ,
 `sr_id` int(11) unsigned ,
 `sr_rentprice` float ,
 `sr_iscontainprocost` int(11) ,
 `sr_renttype` int(11) ,
 `sr_payway` int(11) ,
 `sr_basetime` float ,
 `sb_tag` varchar(200) ,
 `sf_id` int(11) unsigned ,
 `sf_carparking` int(11) ,
 `sf_warming` int(11) ,
 `sf_network` int(11) ,
 `sf_elecwater` int(11) ,
 `sf_elevator` int(11) ,
 `sf_lift` int(11) ,
 `sf_gas` int(11) ,
 `sf_aircondition` int(11) ,
 `sf_tv` int(11) ,
 `sf_door` int(11) ,
 `sb_mainservice` int(11) ,
 `sb_district` int(10) ,
 `sb_section` int(10) ,
 `sb_loop` int(10) ,
 `sp_titlepicurl` int(11) 
)*/;

/*Table structure for table `35_viewshopreq` */

DROP TABLE IF EXISTS `35_viewshopreq`;

/*!50001 DROP VIEW IF EXISTS `35_viewshopreq` */;
/*!50001 DROP TABLE IF EXISTS `35_viewshopreq` */;

/*!50001 CREATE TABLE  `35_viewshopreq`(
 `sr_id` int(11) unsigned ,
 `sr_uid` int(11) unsigned ,
 `sr_province` int(11) ,
 `sr_city` int(11) ,
 `sr_address` varchar(200) ,
 `sr_shoptype` int(11) ,
 `sr_selltype` int(11) ,
 `sr_businesstype` int(11) ,
 `sr_shopareamin` float ,
 `sr_shopareamax` float ,
 `sr_cancut` int(11) ,
 `sr_floor` int(11) ,
 `sr_adrondegree` int(11) ,
 `sr_facility` varchar(200) ,
 `sr_title` varchar(50) ,
 `sr_desc` text ,
 `sr_costmin` float ,
 `sr_costmax` float ,
 `sr_releasedate` int(11) ,
 `sr_expiredate` int(11) ,
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_point` float ,
 `user_value` float ,
 `sr_sellorrent` int(11) ,
 `sr_district` int(11) 
)*/;

/*Table structure for table `35_viewshopsell` */

DROP TABLE IF EXISTS `35_viewshopsell`;

/*!50001 DROP VIEW IF EXISTS `35_viewshopsell` */;
/*!50001 DROP TABLE IF EXISTS `35_viewshopsell` */;

/*!50001 CREATE TABLE  `35_viewshopsell`(
 `user_name` varchar(30) ,
 `user_role` int(11) ,
 `user_point` float ,
 `user_value` float ,
 `ss_id` int(11) unsigned ,
 `ss_sellprice` float ,
 `st_id` int(11) unsigned ,
 `st_ishigh` int(11) ,
 `st_isrecommend` int(11) ,
 `st_ishomepage` int(11) ,
 `st_isvideo` int(11) ,
 `st_is3d` int(11) ,
 `st_isconsign` int(11) ,
 `st_consignid` int(11) ,
 `st_isnew` int(11) ,
 `st_ishurry` int(11) ,
 `st_check` int(11) ,
 `sp_id` int(11) unsigned ,
 `sp_shoptitle` varchar(50) ,
 `sp_serialnum` varchar(50) ,
 `sp_shopdesc` text ,
 `sp_traffice` varchar(50) ,
 `sp_carparking` varchar(50) ,
 `sp_facilityaround` varchar(50) ,
 `sb_shopid` int(11) unsigned ,
 `sb_province` int(10) ,
 `sb_city` int(10) ,
 `sb_shopname` varchar(50) ,
 `sb_shoptype` int(11) ,
 `sb_selltype` int(11) ,
 `sb_businesstype` int(11) ,
 `sb_buildingname` varchar(50) ,
 `sb_tradecircle` int(10) ,
 `sb_busway` varchar(200) ,
 `sb_shopaddress` varchar(200) ,
 `sb_proprtycomname` varchar(50) ,
 `sb_propertycost` float ,
 `sb_shoparea` float ,
 `sb_shopusablearea` float ,
 `sb_floor` int(11) ,
 `sb_buildingage` varchar(20) ,
 `sb_cancut` int(11) ,
 `sb_adrondegree` int(11) ,
 `sb_sellorrent` int(11) ,
 `sb_releasedate` int(11) ,
 `sb_expiredate` int(11) ,
 `sb_uid` int(11) unsigned ,
 `sb_tag` varchar(200) ,
 `sf_id` int(11) unsigned ,
 `sf_carparking` int(11) ,
 `sf_warming` int(11) ,
 `sf_network` int(11) ,
 `sf_elecwater` int(11) ,
 `sf_elevator` int(11) ,
 `sf_lift` int(11) ,
 `sf_gas` int(11) ,
 `sf_aircondition` int(11) ,
 `sf_tv` int(11) ,
 `sf_door` int(11) ,
 `sb_mainservice` int(11) ,
 `sb_district` int(10) ,
 `sb_section` int(10) ,
 `sb_loop` int(10) ,
 `sp_titlepicurl` int(11) 
)*/;

/*Table structure for table `35_viewuagent` */

DROP TABLE IF EXISTS `35_viewuagent`;

/*!50001 DROP VIEW IF EXISTS `35_viewuagent` */;
/*!50001 DROP TABLE IF EXISTS `35_viewuagent` */;

/*!50001 CREATE TABLE  `35_viewuagent`(
 `ua_id` int(11) unsigned ,
 `ua_province` int(10) ,
 `ua_city` int(10) ,
 `ua_district` int(10) ,
 `ua_section` int(10) ,
 `ua_realname` varchar(20) ,
 `ua_tel` varchar(20) ,
 `ua_msn` varchar(50) ,
 `ua_email` varchar(50) ,
 `ua_comid` int(11) ,
 `ua_photourl` varchar(200) ,
 `ua_scardurl` varchar(200) ,
 `ua_bcardurl` varchar(200) ,
 `ua_scardid` varchar(20) ,
 `ua_check` set('1','0') ,
 `user_id` int(11) unsigned ,
 `user_name` varchar(30) ,
 `user_salt` varchar(50) ,
 `user_pwd` varchar(50) ,
 `user_role` int(11) ,
 `user_regtime` int(11) ,
 `user_loginnum` int(11) ,
 `user_lasttime` int(11) ,
 `user_lastip` varchar(50) ,
 `user_value` float ,
 `user_point` float ,
 `ua_post` text ,
 `ua_level` int(11) 
)*/;

/*Table structure for table `35_viewucom` */

DROP TABLE IF EXISTS `35_viewucom`;

/*!50001 DROP VIEW IF EXISTS `35_viewucom` */;
/*!50001 DROP TABLE IF EXISTS `35_viewucom` */;

/*!50001 CREATE TABLE  `35_viewucom`(
 `user_id` int(11) unsigned ,
 `user_name` varchar(30) ,
 `user_salt` varchar(50) ,
 `user_pwd` varchar(50) ,
 `user_role` int(11) ,
 `user_regtime` int(11) ,
 `user_loginnum` int(11) ,
 `user_lasttime` int(11) ,
 `user_lastip` varchar(50) ,
 `user_value` float ,
 `user_point` float ,
 `uc_id` int(11) unsigned ,
 `uc_city` int(10) ,
 `uc_province` int(10) ,
 `uc_district` int(10) ,
 `uc_section` int(10) ,
 `uc_address` varchar(200) ,
 `uc_fullname` varchar(50) ,
 `uc_officetel` varchar(20) ,
 `uc_contact` varchar(20) ,
 `uc_tel` varchar(20) ,
 `uc_msn` varchar(50) ,
 `uc_email` varchar(50) ,
 `uc_recogniseurl` varchar(200) ,
 `uc_check` set('1','0') ,
 `uc_logo` varchar(200) ,
 `uc_post` text 
)*/;

/*Table structure for table `35_viewunormal` */

DROP TABLE IF EXISTS `35_viewunormal`;

/*!50001 DROP VIEW IF EXISTS `35_viewunormal` */;
/*!50001 DROP TABLE IF EXISTS `35_viewunormal` */;

/*!50001 CREATE TABLE  `35_viewunormal`(
 `user_id` int(11) unsigned ,
 `user_name` varchar(30) ,
 `user_salt` varchar(50) ,
 `user_pwd` varchar(50) ,
 `user_role` int(11) ,
 `user_regtime` int(11) ,
 `user_loginnum` int(11) ,
 `user_lasttime` int(11) ,
 `user_lastip` varchar(50) ,
 `user_value` float ,
 `user_point` float ,
 `puser_id` int(11) unsigned ,
 `puser_tel` varchar(20) ,
 `puser_email` varchar(50) ,
 `puser_logopath` varchar(200) ,
 `puser_vip` set('1','0') 
)*/;

/*View structure for view 35_viewbusrent */

/*!50001 DROP TABLE IF EXISTS `35_viewbusrent` */;
/*!50001 DROP VIEW IF EXISTS `35_viewbusrent` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewbusrent` AS select `35_businessrentinfo`.`br_id` AS `br_id`,`35_businessrentinfo`.`br_rentprice` AS `br_rentprice`,`35_businessrentinfo`.`br_iscontainprocost` AS `br_iscontainprocost`,`35_businessrentinfo`.`br_renttype` AS `br_renttype`,`35_businessrentinfo`.`br_payway` AS `br_payway`,`35_businessrentinfo`.`br_basetime` AS `br_basetime`,`35_businesstag`.`bt_id` AS `bt_id`,`35_businesstag`.`bt_ishigh` AS `bt_ishigh`,`35_businesstag`.`bt_isrecommend` AS `bt_isrecommend`,`35_businesstag`.`bt_ishomepage` AS `bt_ishomepage`,`35_businesstag`.`bt_isvideo` AS `bt_isvideo`,`35_businesstag`.`bt_is3d` AS `bt_is3d`,`35_businesstag`.`bt_isconsign` AS `bt_isconsign`,`35_businesstag`.`bt_consignid` AS `bt_consignid`,`35_businesstag`.`bt_isnew` AS `bt_isnew`,`35_businesstag`.`bt_ishurry` AS `bt_ishurry`,`35_businesstag`.`bt_check` AS `bt_check`,`35_businessbaseinfo`.`bb_businessid` AS `bb_businessid`,`35_businessbaseinfo`.`bb_businesstype` AS `bb_businesstype`,`35_businessbaseinfo`.`bb_province` AS `bb_province`,`35_businessbaseinfo`.`bb_city` AS `bb_city`,`35_businessbaseinfo`.`bb_businessaddress` AS `bb_businessaddress`,`35_businessbaseinfo`.`bb_buildingarea` AS `bb_buildingarea`,`35_businessbaseinfo`.`bb_businessprice` AS `bb_businessprice`,`35_businessbaseinfo`.`bb_propertytype` AS `bb_propertytype`,`35_businessbaseinfo`.`bb_companytype` AS `bb_companytype`,`35_businessbaseinfo`.`bb_registerfunds` AS `bb_registerfunds`,`35_businessbaseinfo`.`bb_mainservice` AS `bb_mainservice`,`35_businessbaseinfo`.`bb_turnoverly` AS `bb_turnoverly`,`35_businessbaseinfo`.`bb_profitly` AS `bb_profitly`,`35_businessbaseinfo`.`bb_salestaxly` AS `bb_salestaxly`,`35_businessbaseinfo`.`bb_incometaxly` AS `bb_incometaxly`,`35_businessbaseinfo`.`bb_runtime` AS `bb_runtime`,`35_businessbaseinfo`.`bb_consumptionperson` AS `bb_consumptionperson`,`35_businessbaseinfo`.`bb_staffnum` AS `bb_staffnum`,`35_businessbaseinfo`.`bb_vipnum` AS `bb_vipnum`,`35_businessbaseinfo`.`bb_stocktransfer` AS `bb_stocktransfer`,`35_businessbaseinfo`.`bb_uid` AS `bb_uid`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_businessbaseinfo`.`bb_releasedate` AS `bb_releasedate`,`35_businessbaseinfo`.`bb_expiredate` AS `bb_expiredate`,`35_businesspresentinfo`.`bp_id` AS `bp_id`,`35_businesspresentinfo`.`bp_businesstitle` AS `bp_businesstitle`,`35_businesspresentinfo`.`bp_serialnum` AS `bp_serialnum`,`35_businesspresentinfo`.`bp_businessdesc` AS `bp_businessdesc`,`35_businesspresentinfo`.`bp_traffice` AS `bp_traffice`,`35_businesspresentinfo`.`bp_carparking` AS `bp_carparking`,`35_businesspresentinfo`.`bp_facilityaround` AS `bp_facilityaround`,`35_businesspresentinfo`.`bp_titlepicurl` AS `bp_titlepicurl` from ((((`35_businessbaseinfo` join `35_businesspresentinfo` on((`35_businessbaseinfo`.`bb_businessid` = `35_businesspresentinfo`.`bp_businessid`))) join `35_businessrentinfo` on((`35_businessbaseinfo`.`bb_businessid` = `35_businessrentinfo`.`br_businessid`))) join `35_businesstag` on((`35_businessbaseinfo`.`bb_businessid` = `35_businesstag`.`bt_businessid`))) join `35_user` on((`35_user`.`user_id` = `35_businessbaseinfo`.`bb_uid`))) */;

/*View structure for view 35_viewbusreq */

/*!50001 DROP TABLE IF EXISTS `35_viewbusreq` */;
/*!50001 DROP VIEW IF EXISTS `35_viewbusreq` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewbusreq` AS select `35_businessrequire`.`br_id` AS `br_id`,`35_businessrequire`.`br_uid` AS `br_uid`,`35_businessrequire`.`br_province` AS `br_province`,`35_businessrequire`.`br_city` AS `br_city`,`35_businessrequire`.`br_address` AS `br_address`,`35_businessrequire`.`br_title` AS `br_title`,`35_businessrequire`.`br_desc` AS `br_desc`,`35_businessrequire`.`br_sellbrrent` AS `br_sellbrrent`,`35_businessrequire`.`br_releasedate` AS `br_releasedate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_businessrequire`.`br_expiredate` AS `br_expiredate`,`35_businessrequire`.`br_district` AS `br_district` from (`35_businessrequire` join `35_user` on((`35_businessrequire`.`br_uid` = `35_user`.`user_id`))) */;

/*View structure for view 35_viewbussell */

/*!50001 DROP TABLE IF EXISTS `35_viewbussell` */;
/*!50001 DROP VIEW IF EXISTS `35_viewbussell` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewbussell` AS select `35_businessbaseinfo`.`bb_businessid` AS `bb_businessid`,`35_businessbaseinfo`.`bb_uid` AS `bb_uid`,`35_businessbaseinfo`.`bb_businesstype` AS `bb_businesstype`,`35_businessbaseinfo`.`bb_province` AS `bb_province`,`35_businessbaseinfo`.`bb_city` AS `bb_city`,`35_businessbaseinfo`.`bb_businessaddress` AS `bb_businessaddress`,`35_businessbaseinfo`.`bb_buildingarea` AS `bb_buildingarea`,`35_businessbaseinfo`.`bb_businessprice` AS `bb_businessprice`,`35_businessbaseinfo`.`bb_propertytype` AS `bb_propertytype`,`35_businessbaseinfo`.`bb_companytype` AS `bb_companytype`,`35_businessbaseinfo`.`bb_registerfunds` AS `bb_registerfunds`,`35_businessbaseinfo`.`bb_mainservice` AS `bb_mainservice`,`35_businessbaseinfo`.`bb_turnoverly` AS `bb_turnoverly`,`35_businessbaseinfo`.`bb_profitly` AS `bb_profitly`,`35_businessbaseinfo`.`bb_salestaxly` AS `bb_salestaxly`,`35_businessbaseinfo`.`bb_incometaxly` AS `bb_incometaxly`,`35_businessbaseinfo`.`bb_runtime` AS `bb_runtime`,`35_businessbaseinfo`.`bb_consumptionperson` AS `bb_consumptionperson`,`35_businessbaseinfo`.`bb_staffnum` AS `bb_staffnum`,`35_businessbaseinfo`.`bb_vipnum` AS `bb_vipnum`,`35_businessbaseinfo`.`bb_stocktransfer` AS `bb_stocktransfer`,`35_businessbaseinfo`.`bb_expiredate` AS `bb_expiredate`,`35_businesstag`.`bt_id` AS `bt_id`,`35_businesstag`.`bt_ishigh` AS `bt_ishigh`,`35_businesstag`.`bt_isrecommend` AS `bt_isrecommend`,`35_businesstag`.`bt_ishomepage` AS `bt_ishomepage`,`35_businesstag`.`bt_isvideo` AS `bt_isvideo`,`35_businesstag`.`bt_is3d` AS `bt_is3d`,`35_businesstag`.`bt_isconsign` AS `bt_isconsign`,`35_businesstag`.`bt_consignid` AS `bt_consignid`,`35_businesstag`.`bt_isnew` AS `bt_isnew`,`35_businesstag`.`bt_ishurry` AS `bt_ishurry`,`35_businesstag`.`bt_check` AS `bt_check`,`35_businesssellinfo`.`bs_id` AS `bs_id`,`35_businesssellinfo`.`bs_sellprice` AS `bs_sellprice`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_businessbaseinfo`.`bb_releasedate` AS `bb_releasedate`,`35_businesspresentinfo`.`bp_serialnum` AS `bp_serialnum`,`35_businesspresentinfo`.`bp_businesstitle` AS `bp_businesstitle`,`35_businesspresentinfo`.`bp_businessdesc` AS `bp_businessdesc`,`35_businesspresentinfo`.`bp_traffice` AS `bp_traffice`,`35_businesspresentinfo`.`bp_carparking` AS `bp_carparking`,`35_businesspresentinfo`.`bp_facilityaround` AS `bp_facilityaround`,`35_businesspresentinfo`.`bp_id` AS `bp_id`,`35_businesspresentinfo`.`bp_titlepicurl` AS `bp_titlepicurl` from ((((`35_businessbaseinfo` join `35_businesspresentinfo` on((`35_businesspresentinfo`.`bp_businessid` = `35_businessbaseinfo`.`bb_businessid`))) join `35_businesssellinfo` on((`35_businesssellinfo`.`bs_businessid` = `35_businessbaseinfo`.`bb_businessid`))) join `35_businesstag` on((`35_businessbaseinfo`.`bb_businessid` = `35_businesstag`.`bt_businessid`))) join `35_user` on((`35_user`.`user_id` = `35_businessbaseinfo`.`bb_uid`))) */;

/*View structure for view 35_viewfactrent */

/*!50001 DROP TABLE IF EXISTS `35_viewfactrent` */;
/*!50001 DROP VIEW IF EXISTS `35_viewfactrent` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewfactrent` AS select `35_factorypresentinfo`.`fp_id` AS `fp_id`,`35_factorypresentinfo`.`fp_factorytitle` AS `fp_factorytitle`,`35_factorypresentinfo`.`fp_serialnum` AS `fp_serialnum`,`35_factorypresentinfo`.`fp_factorydesc` AS `fp_factorydesc`,`35_factorypresentinfo`.`fp_traffice` AS `fp_traffice`,`35_factorypresentinfo`.`fp_carparking` AS `fp_carparking`,`35_factoryrentinfo`.`fr_id` AS `fr_id`,`35_factoryrentinfo`.`fr_rentprice` AS `fr_rentprice`,`35_factoryrentinfo`.`fr_iscontainprocost` AS `fr_iscontainprocost`,`35_factoryrentinfo`.`fr_renttype` AS `fr_renttype`,`35_factoryrentinfo`.`fr_payway` AS `fr_payway`,`35_factoryrentinfo`.`fr_basetime` AS `fr_basetime`,`35_factorybaseinfo`.`fb_factoryid` AS `fb_factoryid`,`35_factorybaseinfo`.`fb_uid` AS `fb_uid`,`35_factorybaseinfo`.`fb_province` AS `fb_province`,`35_factorybaseinfo`.`fb_city` AS `fb_city`,`35_factorybaseinfo`.`fb_factoryname` AS `fb_factoryname`,`35_factorybaseinfo`.`fb_tradecircle` AS `fb_tradecircle`,`35_factorybaseinfo`.`fb_busway` AS `fb_busway`,`35_factorybaseinfo`.`fb_propertyinfo` AS `fb_propertyinfo`,`35_factorybaseinfo`.`fb_buildingarea` AS `fb_buildingarea`,`35_factorybaseinfo`.`fb_coverarea` AS `fb_coverarea`,`35_factorybaseinfo`.`fb_sparearea` AS `fb_sparearea`,`35_factorybaseinfo`.`fb_buildingage` AS `fb_buildingage`,`35_factorybaseinfo`.`fb_plotratio` AS `fb_plotratio`,`35_factorybaseinfo`.`fb_greenratio` AS `fb_greenratio`,`35_factorybaseinfo`.`fb_factorytype` AS `fb_factorytype`,`35_factorybaseinfo`.`fb_floor` AS `fb_floor`,`35_factorybaseinfo`.`fb_structure` AS `fb_structure`,`35_factorybaseinfo`.`fb_crane` AS `fb_crane`,`35_factorybaseinfo`.`fb_loadbearing` AS `fb_loadbearing`,`35_factorybaseinfo`.`fb_elecpower` AS `fb_elecpower`,`35_factorybaseinfo`.`fb_water` AS `fb_water`,`35_factorybaseinfo`.`fb_adrondegree` AS `fb_adrondegree`,`35_factorybaseinfo`.`fb_communication` AS `fb_communication`,`35_factorybaseinfo`.`fb_facilityaround` AS `fb_facilityaround`,`35_factorybaseinfo`.`fb_facilityindoor` AS `fb_facilityindoor`,`35_factorybaseinfo`.`fb_sellorrent` AS `fb_sellorrent`,`35_factorybaseinfo`.`fb_expiredate` AS `fb_expiredate`,`35_factorytag`.`ft_id` AS `ft_id`,`35_factorytag`.`ft_ishigh` AS `ft_ishigh`,`35_factorytag`.`ft_isrecommend` AS `ft_isrecommend`,`35_factorytag`.`ft_ishomepage` AS `ft_ishomepage`,`35_factorytag`.`ft_isvideo` AS `ft_isvideo`,`35_factorytag`.`ft_is3d` AS `ft_is3d`,`35_factorytag`.`ft_isconsign` AS `ft_isconsign`,`35_factorytag`.`ft_consignid` AS `ft_consignid`,`35_factorytag`.`ft_isnew` AS `ft_isnew`,`35_factorytag`.`ft_ishurry` AS `ft_ishurry`,`35_factorytag`.`ft_check` AS `ft_check`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_factorybaseinfo`.`fb_releasedate` AS `fb_releasedate`,`35_factorybaseinfo`.`fb_suittrade` AS `fb_suittrade`,`35_factorybaseinfo`.`fb_district` AS `fb_district`,`35_factorybaseinfo`.`fb_section` AS `fb_section`,`35_factorybaseinfo`.`fb_loop` AS `fb_loop`,`35_factorypresentinfo`.`fp_facilityaround` AS `fp_facilityaround`,`35_factorypresentinfo`.`fp_titlepicurl` AS `fp_titlepicurl` from ((((`35_factorybaseinfo` join `35_factorypresentinfo` on((`35_factorypresentinfo`.`fp_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_factoryrentinfo` on((`35_factoryrentinfo`.`fr_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_factorytag` on((`35_factorytag`.`ft_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_user` on((`35_user`.`user_id` = `35_factorybaseinfo`.`fb_uid`))) */;

/*View structure for view 35_viewfactreq */

/*!50001 DROP TABLE IF EXISTS `35_viewfactreq` */;
/*!50001 DROP VIEW IF EXISTS `35_viewfactreq` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewfactreq` AS select `35_factoryrequire`.`fr_id` AS `fr_id`,`35_factoryrequire`.`fr_uid` AS `fr_uid`,`35_factoryrequire`.`fr_province` AS `fr_province`,`35_factoryrequire`.`fr_city` AS `fr_city`,`35_factoryrequire`.`fr_address` AS `fr_address`,`35_factoryrequire`.`fr_factorytype` AS `fr_factorytype`,`35_factoryrequire`.`fr_factoryareamin` AS `fr_factoryareamin`,`35_factoryrequire`.`fr_factoryareamax` AS `fr_factoryareamax`,`35_factoryrequire`.`fr_facility` AS `fr_facility`,`35_factoryrequire`.`fr_title` AS `fr_title`,`35_factoryrequire`.`fr_desc` AS `fr_desc`,`35_factoryrequire`.`fr_costmin` AS `fr_costmin`,`35_factoryrequire`.`fr_costmax` AS `fr_costmax`,`35_factoryrequire`.`fr_releasedate` AS `fr_releasedate`,`35_factoryrequire`.`fr_expiredate` AS `fr_expiredate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_factoryrequire`.`fr_sellorrent` AS `fr_sellorrent`,`35_factoryrequire`.`fr_district` AS `fr_district` from (`35_factoryrequire` join `35_user` on((`35_factoryrequire`.`fr_uid` = `35_user`.`user_id`))) */;

/*View structure for view 35_viewfactsell */

/*!50001 DROP TABLE IF EXISTS `35_viewfactsell` */;
/*!50001 DROP VIEW IF EXISTS `35_viewfactsell` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewfactsell` AS select `35_factorybaseinfo`.`fb_uid` AS `fb_uid`,`35_factorybaseinfo`.`fb_province` AS `fb_province`,`35_factorybaseinfo`.`fb_city` AS `fb_city`,`35_factorybaseinfo`.`fb_factoryname` AS `fb_factoryname`,`35_factorybaseinfo`.`fb_tradecircle` AS `fb_tradecircle`,`35_factorybaseinfo`.`fb_busway` AS `fb_busway`,`35_factorybaseinfo`.`fb_propertyinfo` AS `fb_propertyinfo`,`35_factorybaseinfo`.`fb_buildingarea` AS `fb_buildingarea`,`35_factorybaseinfo`.`fb_coverarea` AS `fb_coverarea`,`35_factorybaseinfo`.`fb_sparearea` AS `fb_sparearea`,`35_factorybaseinfo`.`fb_buildingage` AS `fb_buildingage`,`35_factorybaseinfo`.`fb_plotratio` AS `fb_plotratio`,`35_factorybaseinfo`.`fb_greenratio` AS `fb_greenratio`,`35_factorybaseinfo`.`fb_factorytype` AS `fb_factorytype`,`35_factorybaseinfo`.`fb_floor` AS `fb_floor`,`35_factorybaseinfo`.`fb_structure` AS `fb_structure`,`35_factorybaseinfo`.`fb_crane` AS `fb_crane`,`35_factorybaseinfo`.`fb_loadbearing` AS `fb_loadbearing`,`35_factorybaseinfo`.`fb_elecpower` AS `fb_elecpower`,`35_factorybaseinfo`.`fb_water` AS `fb_water`,`35_factorybaseinfo`.`fb_adrondegree` AS `fb_adrondegree`,`35_factorybaseinfo`.`fb_communication` AS `fb_communication`,`35_factorybaseinfo`.`fb_facilityaround` AS `fb_facilityaround`,`35_factorybaseinfo`.`fb_facilityindoor` AS `fb_facilityindoor`,`35_factorybaseinfo`.`fb_sellorrent` AS `fb_sellorrent`,`35_factorybaseinfo`.`fb_expiredate` AS `fb_expiredate`,`35_factorytag`.`ft_id` AS `ft_id`,`35_factorytag`.`ft_ishigh` AS `ft_ishigh`,`35_factorytag`.`ft_isrecommend` AS `ft_isrecommend`,`35_factorytag`.`ft_ishomepage` AS `ft_ishomepage`,`35_factorytag`.`ft_isvideo` AS `ft_isvideo`,`35_factorytag`.`ft_is3d` AS `ft_is3d`,`35_factorytag`.`ft_isconsign` AS `ft_isconsign`,`35_factorytag`.`ft_consignid` AS `ft_consignid`,`35_factorytag`.`ft_isnew` AS `ft_isnew`,`35_factorytag`.`ft_ishurry` AS `ft_ishurry`,`35_factorytag`.`ft_check` AS `ft_check`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_factorypresentinfo`.`fp_id` AS `fp_id`,`35_factorypresentinfo`.`fp_factorytitle` AS `fp_factorytitle`,`35_factorypresentinfo`.`fp_serialnum` AS `fp_serialnum`,`35_factorypresentinfo`.`fp_factorydesc` AS `fp_factorydesc`,`35_factorypresentinfo`.`fp_traffice` AS `fp_traffice`,`35_factorypresentinfo`.`fp_carparking` AS `fp_carparking`,`35_factorypresentinfo`.`fp_facilityaround` AS `fp_facilityaround`,`35_factorybaseinfo`.`fb_factoryid` AS `fb_factoryid`,`35_factorysellinfo`.`fs_id` AS `fs_id`,`35_factorysellinfo`.`fs_sellprice` AS `fs_sellprice`,`35_factorybaseinfo`.`fb_releasedate` AS `fb_releasedate`,`35_factorybaseinfo`.`fb_suittrade` AS `fb_suittrade`,`35_factorybaseinfo`.`fb_section` AS `fb_section`,`35_factorybaseinfo`.`fb_district` AS `fb_district`,`35_factorybaseinfo`.`fb_loop` AS `fb_loop`,`35_factorypresentinfo`.`fp_titlepicurl` AS `fp_titlepicurl` from ((((`35_factorybaseinfo` join `35_factorypresentinfo` on((`35_factorypresentinfo`.`fp_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_factorysellinfo` on((`35_factorysellinfo`.`fs_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_factorytag` on((`35_factorytag`.`ft_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_user` on((`35_user`.`user_id` = `35_factorybaseinfo`.`fb_uid`))) */;

/*View structure for view 35_viewoffirent */

/*!50001 DROP TABLE IF EXISTS `35_viewoffirent` */;
/*!50001 DROP VIEW IF EXISTS `35_viewoffirent` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewoffirent` AS select `35_officebaseinfo`.`ob_officeid` AS `ob_officeid`,`35_officebaseinfo`.`ob_uid` AS `ob_uid`,`35_officebaseinfo`.`ob_province` AS `ob_province`,`35_officebaseinfo`.`ob_city` AS `ob_city`,`35_officebaseinfo`.`ob_buildingtype` AS `ob_buildingtype`,`35_officebaseinfo`.`ob_officename` AS `ob_officename`,`35_officebaseinfo`.`ob_officetype` AS `ob_officetype`,`35_officebaseinfo`.`ob_tradecircle` AS `ob_tradecircle`,`35_officebaseinfo`.`ob_busway` AS `ob_busway`,`35_officebaseinfo`.`ob_officeaddress` AS `ob_officeaddress`,`35_officebaseinfo`.`ob_propertycomname` AS `ob_propertycomname`,`35_officebaseinfo`.`ob_propertycost` AS `ob_propertycost`,`35_officebaseinfo`.`ob_foreign` AS `ob_foreign`,`35_officebaseinfo`.`ob_officearea` AS `ob_officearea`,`35_officebaseinfo`.`ob_floor` AS `ob_floor`,`35_officebaseinfo`.`ob_buildingera` AS `ob_buildingera`,`35_officebaseinfo`.`ob_cancut` AS `ob_cancut`,`35_officebaseinfo`.`ob_adrondegree` AS `ob_adrondegree`,`35_officebaseinfo`.`ob_officedegree` AS `ob_officedegree`,`35_officebaseinfo`.`ob_sellorrent` AS `ob_sellorrent`,`35_officebaseinfo`.`ob_releasedate` AS `ob_releasedate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_officepresentinfo`.`op_id` AS `op_id`,`35_officepresentinfo`.`op_officetitle` AS `op_officetitle`,`35_officepresentinfo`.`op_serialnum` AS `op_serialnum`,`35_officepresentinfo`.`op_officedesc` AS `op_officedesc`,`35_officepresentinfo`.`op_traffice` AS `op_traffice`,`35_officepresentinfo`.`op_carparking` AS `op_carparking`,`35_officepresentinfo`.`op_facilityaround` AS `op_facilityaround`,`35_officerentinfo`.`or_id` AS `or_id`,`35_officerentinfo`.`or_rentprice` AS `or_rentprice`,`35_officerentinfo`.`or_iscontainprocost` AS `or_iscontainprocost`,`35_officerentinfo`.`or_renttype` AS `or_renttype`,`35_officerentinfo`.`or_payway` AS `or_payway`,`35_officerentinfo`.`or_basetime` AS `or_basetime`,`35_officetag`.`ot_id` AS `ot_id`,`35_officetag`.`ot_ishigh` AS `ot_ishigh`,`35_officetag`.`ot_isrecommend` AS `ot_isrecommend`,`35_officetag`.`ot_ishomepage` AS `ot_ishomepage`,`35_officetag`.`ot_isvideo` AS `ot_isvideo`,`35_officetag`.`ot_is3d` AS `ot_is3d`,`35_officetag`.`ot_isconsign` AS `ot_isconsign`,`35_officetag`.`ot_consignid` AS `ot_consignid`,`35_officetag`.`ot_isnew` AS `ot_isnew`,`35_officetag`.`ot_ishurry` AS `ot_ishurry`,`35_officetag`.`ot_check` AS `ot_check`,`35_officebaseinfo`.`ob_expiredate` AS `ob_expiredate`,`35_officebaseinfo`.`ob_tag` AS `ob_tag`,`35_officefacilityinfo`.`of_id` AS `of_id`,`35_officefacilityinfo`.`of_carparking` AS `of_carparking`,`35_officefacilityinfo`.`of_warming` AS `of_warming`,`35_officefacilityinfo`.`of_network` AS `of_network`,`35_officefacilityinfo`.`of_elecwater` AS `of_elecwater`,`35_officefacilityinfo`.`of_elevator` AS `of_elevator`,`35_officefacilityinfo`.`of_lift` AS `of_lift`,`35_officefacilityinfo`.`of_gas` AS `of_gas`,`35_officefacilityinfo`.`of_aircondition` AS `of_aircondition`,`35_officefacilityinfo`.`of_tv` AS `of_tv`,`35_officefacilityinfo`.`of_door` AS `of_door`,`35_officebaseinfo`.`ob_district` AS `ob_district`,`35_officebaseinfo`.`ob_section` AS `ob_section`,`35_officebaseinfo`.`ob_loop` AS `ob_loop`,`35_officepresentinfo`.`op_titlepicurl` AS `op_titlepicurl` from (((((`35_officebaseinfo` join `35_officefacilityinfo` on((`35_officefacilityinfo`.`of_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_officepresentinfo` on((`35_officepresentinfo`.`op_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_officerentinfo` on((`35_officerentinfo`.`or_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_officetag` on((`35_officetag`.`ot_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_user` on((`35_user`.`user_id` = `35_officebaseinfo`.`ob_uid`))) */;

/*View structure for view 35_viewoffireq */

/*!50001 DROP TABLE IF EXISTS `35_viewoffireq` */;
/*!50001 DROP VIEW IF EXISTS `35_viewoffireq` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewoffireq` AS select `35_officerequire`.`or_id` AS `or_id`,`35_officerequire`.`or_uid` AS `or_uid`,`35_officerequire`.`or_province` AS `or_province`,`35_officerequire`.`or_city` AS `or_city`,`35_officerequire`.`or_address` AS `or_address`,`35_officerequire`.`or_buildingtype` AS `or_buildingtype`,`35_officerequire`.`or_officetype` AS `or_officetype`,`35_officerequire`.`or_officeareamin` AS `or_officeareamin`,`35_officerequire`.`or_officeareamax` AS `or_officeareamax`,`35_officerequire`.`or_floor` AS `or_floor`,`35_officerequire`.`or_cancut` AS `or_cancut`,`35_officerequire`.`or_adrondegree` AS `or_adrondegree`,`35_officerequire`.`or_officedegree` AS `or_officedegree`,`35_officerequire`.`or_facility` AS `or_facility`,`35_officerequire`.`or_title` AS `or_title`,`35_officerequire`.`or_desc` AS `or_desc`,`35_officerequire`.`or_sellorrent` AS `or_sellorrent`,`35_officerequire`.`or_costmin` AS `or_costmin`,`35_officerequire`.`or_costmax` AS `or_costmax`,`35_officerequire`.`or_releasedate` AS `or_releasedate`,`35_officerequire`.`or_expiredate` AS `or_expiredate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_officerequire`.`or_district` AS `or_district` from (`35_officerequire` join `35_user` on((`35_officerequire`.`or_uid` = `35_user`.`user_id`))) */;

/*View structure for view 35_viewoffisell */

/*!50001 DROP TABLE IF EXISTS `35_viewoffisell` */;
/*!50001 DROP VIEW IF EXISTS `35_viewoffisell` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`dev_root`@`%` SQL SECURITY DEFINER VIEW `35_viewoffisell` AS select `swhui`.`35_officebaseinfo`.`ob_uid` AS `ob_uid`,`swhui`.`35_officebaseinfo`.`ob_province` AS `ob_province`,`swhui`.`35_officebaseinfo`.`ob_city` AS `ob_city`,`swhui`.`35_officebaseinfo`.`ob_buildingtype` AS `ob_buildingtype`,`swhui`.`35_officebaseinfo`.`ob_officename` AS `ob_officename`,`swhui`.`35_officebaseinfo`.`ob_officetype` AS `ob_officetype`,`swhui`.`35_officebaseinfo`.`ob_tradecircle` AS `ob_tradecircle`,`swhui`.`35_officebaseinfo`.`ob_busway` AS `ob_busway`,`swhui`.`35_officebaseinfo`.`ob_officeaddress` AS `ob_officeaddress`,`swhui`.`35_officebaseinfo`.`ob_propertycomname` AS `ob_propertycomname`,`swhui`.`35_officebaseinfo`.`ob_officeid` AS `ob_officeid`,`swhui`.`35_officebaseinfo`.`ob_propertycost` AS `ob_propertycost`,`swhui`.`35_officebaseinfo`.`ob_foreign` AS `ob_foreign`,`swhui`.`35_officebaseinfo`.`ob_officearea` AS `ob_officearea`,`swhui`.`35_officebaseinfo`.`ob_floor` AS `ob_floor`,`swhui`.`35_officebaseinfo`.`ob_buildingera` AS `ob_buildingera`,`swhui`.`35_officebaseinfo`.`ob_cancut` AS `ob_cancut`,`swhui`.`35_officebaseinfo`.`ob_adrondegree` AS `ob_adrondegree`,`swhui`.`35_officebaseinfo`.`ob_officedegree` AS `ob_officedegree`,`swhui`.`35_officebaseinfo`.`ob_sellorrent` AS `ob_sellorrent`,`swhui`.`35_officebaseinfo`.`ob_releasedate` AS `ob_releasedate`,`swhui`.`35_user`.`user_name` AS `user_name`,`swhui`.`35_user`.`user_role` AS `user_role`,`swhui`.`35_user`.`user_value` AS `user_value`,`swhui`.`35_user`.`user_point` AS `user_point`,`swhui`.`35_officepresentinfo`.`op_id` AS `op_id`,`swhui`.`35_officepresentinfo`.`op_officetitle` AS `op_officetitle`,`swhui`.`35_officepresentinfo`.`op_serialnum` AS `op_serialnum`,`swhui`.`35_officepresentinfo`.`op_officedesc` AS `op_officedesc`,`swhui`.`35_officepresentinfo`.`op_traffice` AS `op_traffice`,`swhui`.`35_officepresentinfo`.`op_carparking` AS `op_carparking`,`swhui`.`35_officepresentinfo`.`op_facilityaround` AS `op_facilityaround`,`swhui`.`35_officesellinfo`.`os_id` AS `os_id`,`swhui`.`35_officetag`.`ot_id` AS `ot_id`,`swhui`.`35_officetag`.`ot_ishigh` AS `ot_ishigh`,`swhui`.`35_officetag`.`ot_isrecommend` AS `ot_isrecommend`,`swhui`.`35_officetag`.`ot_ishomepage` AS `ot_ishomepage`,`swhui`.`35_officetag`.`ot_isvideo` AS `ot_isvideo`,`swhui`.`35_officetag`.`ot_is3d` AS `ot_is3d`,`swhui`.`35_officetag`.`ot_isconsign` AS `ot_isconsign`,`swhui`.`35_officetag`.`ot_consignid` AS `ot_consignid`,`swhui`.`35_officetag`.`ot_isnew` AS `ot_isnew`,`swhui`.`35_officetag`.`ot_ishurry` AS `ot_ishurry`,`swhui`.`35_officetag`.`ot_check` AS `ot_check`,`swhui`.`35_officebaseinfo`.`ob_expiredate` AS `ob_expiredate`,`swhui`.`35_officebaseinfo`.`ob_tag` AS `ob_tag`,`swhui`.`35_officefacilityinfo`.`of_id` AS `of_id`,`swhui`.`35_officefacilityinfo`.`of_carparking` AS `of_carparking`,`swhui`.`35_officefacilityinfo`.`of_warming` AS `of_warming`,`swhui`.`35_officefacilityinfo`.`of_network` AS `of_network`,`swhui`.`35_officefacilityinfo`.`of_elecwater` AS `of_elecwater`,`swhui`.`35_officefacilityinfo`.`of_elevator` AS `of_elevator`,`swhui`.`35_officefacilityinfo`.`of_lift` AS `of_lift`,`swhui`.`35_officefacilityinfo`.`of_gas` AS `of_gas`,`swhui`.`35_officefacilityinfo`.`of_aircondition` AS `of_aircondition`,`swhui`.`35_officefacilityinfo`.`of_tv` AS `of_tv`,`swhui`.`35_officefacilityinfo`.`of_door` AS `of_door`,`swhui`.`35_officebaseinfo`.`ob_district` AS `ob_district`,`swhui`.`35_officebaseinfo`.`ob_section` AS `ob_section`,`swhui`.`35_officebaseinfo`.`ob_loop` AS `ob_loop`,`swhui`.`35_officebaseinfo`.`ob_sysid` AS `ob_sysid`,`swhui`.`35_officesellinfo`.`os_avgprice` AS `os_avgprice`,`swhui`.`35_officesellinfo`.`os_sumprice` AS `os_sumprice`,`swhui`.`35_officebaseinfo`.`ob_allfloor` AS `ob_allfloor`,`swhui`.`35_officebaseinfo`.`ob_floornature` AS `ob_floornature`,`swhui`.`35_officebaseinfo`.`ob_property` AS `ob_property`,`swhui`.`35_officebaseinfo`.`ob_industry` AS `ob_industry`,`swhui`.`35_officebaseinfo`.`ob_towards` AS `ob_towards`,`swhui`.`35_officebaseinfo`.`ob_updatedate` AS `ob_updatedate`,`swhui`.`35_officepresentinfo`.`op_titlepicurl` AS `op_titlepicurl` from (((((`35_officebaseinfo` join `35_officefacilityinfo` on((`swhui`.`35_officefacilityinfo`.`of_officeid` = `swhui`.`35_officebaseinfo`.`ob_officeid`))) join `35_officepresentinfo` on((`swhui`.`35_officepresentinfo`.`op_officeid` = `swhui`.`35_officebaseinfo`.`ob_officeid`))) join `35_officesellinfo` on((`swhui`.`35_officesellinfo`.`os_officeid` = `swhui`.`35_officebaseinfo`.`ob_officeid`))) join `35_officetag` on((`swhui`.`35_officetag`.`ot_officeid` = `swhui`.`35_officebaseinfo`.`ob_officeid`))) join `35_user` on((`swhui`.`35_user`.`user_id` = `swhui`.`35_officebaseinfo`.`ob_uid`))) */;

/*View structure for view 35_viewproject */

/*!50001 DROP TABLE IF EXISTS `35_viewproject` */;
/*!50001 DROP VIEW IF EXISTS `35_viewproject` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewproject` AS select `35_projectbaseinfo`.`pb_projectid` AS `pb_projectid`,`35_projectbaseinfo`.`pb_uid` AS `pb_uid`,`35_projectbaseinfo`.`pb_province` AS `pb_province`,`35_projectbaseinfo`.`pb_city` AS `pb_city`,`35_projectbaseinfo`.`pb_projcetaddress` AS `pb_projcetaddress`,`35_projectbaseinfo`.`pb_transactionway` AS `pb_transactionway`,`35_projectbaseinfo`.`pb_price` AS `pb_price`,`35_projectbaseinfo`.`pb_releasedate` AS `pb_releasedate`,`35_projectbaseinfo`.`pb_expiredate` AS `pb_expiredate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_projecttag`.`pt_id` AS `pt_id`,`35_projecttag`.`pt_ishigh` AS `pt_ishigh`,`35_projecttag`.`pt_isrecommend` AS `pt_isrecommend`,`35_projecttag`.`pt_ishomepage` AS `pt_ishomepage`,`35_projecttag`.`pt_isvideo` AS `pt_isvideo`,`35_projecttag`.`pt_is3d` AS `pt_is3d`,`35_projecttag`.`pt_isconsign` AS `pt_isconsign`,`35_projecttag`.`pt_consignid` AS `pt_consignid`,`35_projecttag`.`pt_isnew` AS `pt_isnew`,`35_projecttag`.`pt_ishurry` AS `pt_ishurry`,`35_projecttag`.`pt_check` AS `pt_check`,`35_projectpresentinfo`.`pp_id` AS `pp_id`,`35_projectpresentinfo`.`pp_projecttitle` AS `pp_projecttitle`,`35_projectpresentinfo`.`pp_serialnum` AS `pp_serialnum`,`35_projectpresentinfo`.`pp_projectdesc` AS `pp_projectdesc`,`35_projectpresentinfo`.`pp_traffice` AS `pp_traffice`,`35_projectpresentinfo`.`pp_carparking` AS `pp_carparking`,`35_projectpresentinfo`.`pp_facilityaround` AS `pp_facilityaround`,`35_projectpresentinfo`.`pp_titlepicurl` AS `pp_titlepicurl` from (((`35_projectbaseinfo` join `35_projectpresentinfo` on((`35_projectpresentinfo`.`pp_projectid` = `35_projectbaseinfo`.`pb_projectid`))) join `35_projecttag` on((`35_projecttag`.`pt_projectid` = `35_projectbaseinfo`.`pb_projectid`))) join `35_user` on((`35_user`.`user_id` = `35_projectbaseinfo`.`pb_uid`))) */;

/*View structure for view 35_viewprojreq */

/*!50001 DROP TABLE IF EXISTS `35_viewprojreq` */;
/*!50001 DROP VIEW IF EXISTS `35_viewprojreq` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewprojreq` AS select `35_projectrequire`.`pr_id` AS `pr_id`,`35_projectrequire`.`pr_uid` AS `pr_uid`,`35_projectrequire`.`pr_province` AS `pr_province`,`35_projectrequire`.`pr_city` AS `pr_city`,`35_projectrequire`.`pr_address` AS `pr_address`,`35_projectrequire`.`pr_title` AS `pr_title`,`35_projectrequire`.`pr_desc` AS `pr_desc`,`35_projectrequire`.`pr_costmin` AS `pr_costmin`,`35_projectrequire`.`pr_costmax` AS `pr_costmax`,`35_projectrequire`.`pr_releasedate` AS `pr_releasedate`,`35_projectrequire`.`pr_expiredate` AS `pr_expiredate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_projectrequire`.`pr_sellorrent` AS `pr_sellorrent`,`35_projectrequire`.`pr_district` AS `pr_district` from (`35_projectrequire` join `35_user` on((`35_projectrequire`.`pr_uid` = `35_user`.`user_id`))) */;

/*View structure for view 35_viewshoprent */

/*!50001 DROP TABLE IF EXISTS `35_viewshoprent` */;
/*!50001 DROP VIEW IF EXISTS `35_viewshoprent` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewshoprent` AS select `35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_shopbaseinfo`.`sb_shopid` AS `sb_shopid`,`35_shopbaseinfo`.`sb_uid` AS `sb_uid`,`35_shopbaseinfo`.`sb_province` AS `sb_province`,`35_shopbaseinfo`.`sb_city` AS `sb_city`,`35_shopbaseinfo`.`sb_shopname` AS `sb_shopname`,`35_shopbaseinfo`.`sb_shoptype` AS `sb_shoptype`,`35_shopbaseinfo`.`sb_selltype` AS `sb_selltype`,`35_shopbaseinfo`.`sb_businesstype` AS `sb_businesstype`,`35_shopbaseinfo`.`sb_buildingname` AS `sb_buildingname`,`35_shopbaseinfo`.`sb_tradecircle` AS `sb_tradecircle`,`35_shopbaseinfo`.`sb_busway` AS `sb_busway`,`35_shopbaseinfo`.`sb_shopaddress` AS `sb_shopaddress`,`35_shopbaseinfo`.`sb_proprtycomname` AS `sb_proprtycomname`,`35_shopbaseinfo`.`sb_propertycost` AS `sb_propertycost`,`35_shopbaseinfo`.`sb_shoparea` AS `sb_shoparea`,`35_shopbaseinfo`.`sb_shopusablearea` AS `sb_shopusablearea`,`35_shopbaseinfo`.`sb_floor` AS `sb_floor`,`35_shopbaseinfo`.`sb_buildingage` AS `sb_buildingage`,`35_shopbaseinfo`.`sb_cancut` AS `sb_cancut`,`35_shopbaseinfo`.`sb_adrondegree` AS `sb_adrondegree`,`35_shopbaseinfo`.`sb_sellorrent` AS `sb_sellorrent`,`35_shopbaseinfo`.`sb_releasedate` AS `sb_releasedate`,`35_shopbaseinfo`.`sb_expiredate` AS `sb_expiredate`,`35_shoppresentinfo`.`sp_id` AS `sp_id`,`35_shoppresentinfo`.`sp_shoptitle` AS `sp_shoptitle`,`35_shoppresentinfo`.`sp_serialnum` AS `sp_serialnum`,`35_shoppresentinfo`.`sp_shopdesc` AS `sp_shopdesc`,`35_shoppresentinfo`.`sp_traffice` AS `sp_traffice`,`35_shoppresentinfo`.`sp_carparking` AS `sp_carparking`,`35_shoppresentinfo`.`sp_facilityaround` AS `sp_facilityaround`,`35_shoptag`.`st_id` AS `st_id`,`35_shoptag`.`st_ishigh` AS `st_ishigh`,`35_shoptag`.`st_isrecommend` AS `st_isrecommend`,`35_shoptag`.`st_ishomepage` AS `st_ishomepage`,`35_shoptag`.`st_isvideo` AS `st_isvideo`,`35_shoptag`.`st_is3d` AS `st_is3d`,`35_shoptag`.`st_isconsign` AS `st_isconsign`,`35_shoptag`.`st_consignid` AS `st_consignid`,`35_shoptag`.`st_isnew` AS `st_isnew`,`35_shoptag`.`st_ishurry` AS `st_ishurry`,`35_shoptag`.`st_check` AS `st_check`,`35_shoprentinfo`.`sr_id` AS `sr_id`,`35_shoprentinfo`.`sr_rentprice` AS `sr_rentprice`,`35_shoprentinfo`.`sr_iscontainprocost` AS `sr_iscontainprocost`,`35_shoprentinfo`.`sr_renttype` AS `sr_renttype`,`35_shoprentinfo`.`sr_payway` AS `sr_payway`,`35_shoprentinfo`.`sr_basetime` AS `sr_basetime`,`35_shopbaseinfo`.`sb_tag` AS `sb_tag`,`35_shopfacilityinfo`.`sf_id` AS `sf_id`,`35_shopfacilityinfo`.`sf_carparking` AS `sf_carparking`,`35_shopfacilityinfo`.`sf_warming` AS `sf_warming`,`35_shopfacilityinfo`.`sf_network` AS `sf_network`,`35_shopfacilityinfo`.`sf_elecwater` AS `sf_elecwater`,`35_shopfacilityinfo`.`sf_elevator` AS `sf_elevator`,`35_shopfacilityinfo`.`sf_lift` AS `sf_lift`,`35_shopfacilityinfo`.`sf_gas` AS `sf_gas`,`35_shopfacilityinfo`.`sf_aircondition` AS `sf_aircondition`,`35_shopfacilityinfo`.`sf_tv` AS `sf_tv`,`35_shopfacilityinfo`.`sf_door` AS `sf_door`,`35_shopbaseinfo`.`sb_mainservice` AS `sb_mainservice`,`35_shopbaseinfo`.`sb_district` AS `sb_district`,`35_shopbaseinfo`.`sb_section` AS `sb_section`,`35_shopbaseinfo`.`sb_loop` AS `sb_loop`,`35_shoppresentinfo`.`sp_titlepicurl` AS `sp_titlepicurl` from (((((`35_shopbaseinfo` join `35_shopfacilityinfo` on((`35_shopfacilityinfo`.`sf_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoppresentinfo` on((`35_shoppresentinfo`.`sp_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoprentinfo` on((`35_shoprentinfo`.`sr_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoptag` on((`35_shoptag`.`st_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_user` on((`35_user`.`user_id` = `35_shopbaseinfo`.`sb_uid`))) */;

/*View structure for view 35_viewshopreq */

/*!50001 DROP TABLE IF EXISTS `35_viewshopreq` */;
/*!50001 DROP VIEW IF EXISTS `35_viewshopreq` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewshopreq` AS select `35_shoprequire`.`sr_id` AS `sr_id`,`35_shoprequire`.`sr_uid` AS `sr_uid`,`35_shoprequire`.`sr_province` AS `sr_province`,`35_shoprequire`.`sr_city` AS `sr_city`,`35_shoprequire`.`sr_address` AS `sr_address`,`35_shoprequire`.`sr_shoptype` AS `sr_shoptype`,`35_shoprequire`.`sr_selltype` AS `sr_selltype`,`35_shoprequire`.`sr_businesstype` AS `sr_businesstype`,`35_shoprequire`.`sr_shopareamin` AS `sr_shopareamin`,`35_shoprequire`.`sr_shopareamax` AS `sr_shopareamax`,`35_shoprequire`.`sr_cancut` AS `sr_cancut`,`35_shoprequire`.`sr_floor` AS `sr_floor`,`35_shoprequire`.`sr_adrondegree` AS `sr_adrondegree`,`35_shoprequire`.`sr_facility` AS `sr_facility`,`35_shoprequire`.`sr_title` AS `sr_title`,`35_shoprequire`.`sr_desc` AS `sr_desc`,`35_shoprequire`.`sr_costmin` AS `sr_costmin`,`35_shoprequire`.`sr_costmax` AS `sr_costmax`,`35_shoprequire`.`sr_releasedate` AS `sr_releasedate`,`35_shoprequire`.`sr_expiredate` AS `sr_expiredate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_shoprequire`.`sr_sellorrent` AS `sr_sellorrent`,`35_shoprequire`.`sr_district` AS `sr_district` from (`35_shoprequire` join `35_user` on((`35_shoprequire`.`sr_uid` = `35_user`.`user_id`))) */;

/*View structure for view 35_viewshopsell */

/*!50001 DROP TABLE IF EXISTS `35_viewshopsell` */;
/*!50001 DROP VIEW IF EXISTS `35_viewshopsell` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewshopsell` AS select `35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_shopsellinfo`.`ss_id` AS `ss_id`,`35_shopsellinfo`.`ss_sellprice` AS `ss_sellprice`,`35_shoptag`.`st_id` AS `st_id`,`35_shoptag`.`st_ishigh` AS `st_ishigh`,`35_shoptag`.`st_isrecommend` AS `st_isrecommend`,`35_shoptag`.`st_ishomepage` AS `st_ishomepage`,`35_shoptag`.`st_isvideo` AS `st_isvideo`,`35_shoptag`.`st_is3d` AS `st_is3d`,`35_shoptag`.`st_isconsign` AS `st_isconsign`,`35_shoptag`.`st_consignid` AS `st_consignid`,`35_shoptag`.`st_isnew` AS `st_isnew`,`35_shoptag`.`st_ishurry` AS `st_ishurry`,`35_shoptag`.`st_check` AS `st_check`,`35_shoppresentinfo`.`sp_id` AS `sp_id`,`35_shoppresentinfo`.`sp_shoptitle` AS `sp_shoptitle`,`35_shoppresentinfo`.`sp_serialnum` AS `sp_serialnum`,`35_shoppresentinfo`.`sp_shopdesc` AS `sp_shopdesc`,`35_shoppresentinfo`.`sp_traffice` AS `sp_traffice`,`35_shoppresentinfo`.`sp_carparking` AS `sp_carparking`,`35_shoppresentinfo`.`sp_facilityaround` AS `sp_facilityaround`,`35_shopbaseinfo`.`sb_shopid` AS `sb_shopid`,`35_shopbaseinfo`.`sb_province` AS `sb_province`,`35_shopbaseinfo`.`sb_city` AS `sb_city`,`35_shopbaseinfo`.`sb_shopname` AS `sb_shopname`,`35_shopbaseinfo`.`sb_shoptype` AS `sb_shoptype`,`35_shopbaseinfo`.`sb_selltype` AS `sb_selltype`,`35_shopbaseinfo`.`sb_businesstype` AS `sb_businesstype`,`35_shopbaseinfo`.`sb_buildingname` AS `sb_buildingname`,`35_shopbaseinfo`.`sb_tradecircle` AS `sb_tradecircle`,`35_shopbaseinfo`.`sb_busway` AS `sb_busway`,`35_shopbaseinfo`.`sb_shopaddress` AS `sb_shopaddress`,`35_shopbaseinfo`.`sb_proprtycomname` AS `sb_proprtycomname`,`35_shopbaseinfo`.`sb_propertycost` AS `sb_propertycost`,`35_shopbaseinfo`.`sb_shoparea` AS `sb_shoparea`,`35_shopbaseinfo`.`sb_shopusablearea` AS `sb_shopusablearea`,`35_shopbaseinfo`.`sb_floor` AS `sb_floor`,`35_shopbaseinfo`.`sb_buildingage` AS `sb_buildingage`,`35_shopbaseinfo`.`sb_cancut` AS `sb_cancut`,`35_shopbaseinfo`.`sb_adrondegree` AS `sb_adrondegree`,`35_shopbaseinfo`.`sb_sellorrent` AS `sb_sellorrent`,`35_shopbaseinfo`.`sb_releasedate` AS `sb_releasedate`,`35_shopbaseinfo`.`sb_expiredate` AS `sb_expiredate`,`35_shopbaseinfo`.`sb_uid` AS `sb_uid`,`35_shopbaseinfo`.`sb_tag` AS `sb_tag`,`35_shopfacilityinfo`.`sf_id` AS `sf_id`,`35_shopfacilityinfo`.`sf_carparking` AS `sf_carparking`,`35_shopfacilityinfo`.`sf_warming` AS `sf_warming`,`35_shopfacilityinfo`.`sf_network` AS `sf_network`,`35_shopfacilityinfo`.`sf_elecwater` AS `sf_elecwater`,`35_shopfacilityinfo`.`sf_elevator` AS `sf_elevator`,`35_shopfacilityinfo`.`sf_lift` AS `sf_lift`,`35_shopfacilityinfo`.`sf_gas` AS `sf_gas`,`35_shopfacilityinfo`.`sf_aircondition` AS `sf_aircondition`,`35_shopfacilityinfo`.`sf_tv` AS `sf_tv`,`35_shopfacilityinfo`.`sf_door` AS `sf_door`,`35_shopbaseinfo`.`sb_mainservice` AS `sb_mainservice`,`35_shopbaseinfo`.`sb_district` AS `sb_district`,`35_shopbaseinfo`.`sb_section` AS `sb_section`,`35_shopbaseinfo`.`sb_loop` AS `sb_loop`,`35_shoppresentinfo`.`sp_titlepicurl` AS `sp_titlepicurl` from (((((`35_shopbaseinfo` join `35_shopfacilityinfo` on((`35_shopfacilityinfo`.`sf_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoppresentinfo` on((`35_shoppresentinfo`.`sp_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shopsellinfo` on((`35_shopsellinfo`.`ss_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoptag` on((`35_shoptag`.`st_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_user` on((`35_user`.`user_id` = `35_shopbaseinfo`.`sb_uid`))) */;

/*View structure for view 35_viewuagent */

/*!50001 DROP TABLE IF EXISTS `35_viewuagent` */;
/*!50001 DROP VIEW IF EXISTS `35_viewuagent` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewuagent` AS select `35_uagent`.`ua_id` AS `ua_id`,`35_uagent`.`ua_province` AS `ua_province`,`35_uagent`.`ua_city` AS `ua_city`,`35_uagent`.`ua_district` AS `ua_district`,`35_uagent`.`ua_section` AS `ua_section`,`35_uagent`.`ua_realname` AS `ua_realname`,`35_uagent`.`ua_tel` AS `ua_tel`,`35_uagent`.`ua_msn` AS `ua_msn`,`35_uagent`.`ua_email` AS `ua_email`,`35_uagent`.`ua_comid` AS `ua_comid`,`35_uagent`.`ua_photourl` AS `ua_photourl`,`35_uagent`.`ua_scardurl` AS `ua_scardurl`,`35_uagent`.`ua_bcardurl` AS `ua_bcardurl`,`35_uagent`.`ua_scardid` AS `ua_scardid`,`35_uagent`.`ua_check` AS `ua_check`,`35_user`.`user_id` AS `user_id`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_salt` AS `user_salt`,`35_user`.`user_pwd` AS `user_pwd`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_regtime` AS `user_regtime`,`35_user`.`user_loginnum` AS `user_loginnum`,`35_user`.`user_lasttime` AS `user_lasttime`,`35_user`.`user_lastip` AS `user_lastip`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_uagent`.`ua_post` AS `ua_post`,`35_uagent`.`ua_level` AS `ua_level` from (`35_user` join `35_uagent` on((`35_uagent`.`ua_uid` = `35_user`.`user_id`))) */;

/*View structure for view 35_viewucom */

/*!50001 DROP TABLE IF EXISTS `35_viewucom` */;
/*!50001 DROP VIEW IF EXISTS `35_viewucom` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`dev`@`%` SQL SECURITY DEFINER VIEW `35_viewucom` AS select `swhui`.`35_user`.`user_id` AS `user_id`,`swhui`.`35_user`.`user_name` AS `user_name`,`swhui`.`35_user`.`user_salt` AS `user_salt`,`swhui`.`35_user`.`user_pwd` AS `user_pwd`,`swhui`.`35_user`.`user_role` AS `user_role`,`swhui`.`35_user`.`user_regtime` AS `user_regtime`,`swhui`.`35_user`.`user_loginnum` AS `user_loginnum`,`swhui`.`35_user`.`user_lasttime` AS `user_lasttime`,`swhui`.`35_user`.`user_lastip` AS `user_lastip`,`swhui`.`35_user`.`user_value` AS `user_value`,`swhui`.`35_user`.`user_point` AS `user_point`,`swhui`.`35_ucom`.`uc_id` AS `uc_id`,`swhui`.`35_ucom`.`uc_city` AS `uc_city`,`swhui`.`35_ucom`.`uc_province` AS `uc_province`,`swhui`.`35_ucom`.`uc_district` AS `uc_district`,`swhui`.`35_ucom`.`uc_section` AS `uc_section`,`swhui`.`35_ucom`.`uc_address` AS `uc_address`,`swhui`.`35_ucom`.`uc_fullname` AS `uc_fullname`,`swhui`.`35_ucom`.`uc_officetel` AS `uc_officetel`,`swhui`.`35_ucom`.`uc_contact` AS `uc_contact`,`swhui`.`35_ucom`.`uc_tel` AS `uc_tel`,`swhui`.`35_ucom`.`uc_msn` AS `uc_msn`,`swhui`.`35_ucom`.`uc_email` AS `uc_email`,`swhui`.`35_ucom`.`uc_recogniseurl` AS `uc_recogniseurl`,`swhui`.`35_ucom`.`uc_check` AS `uc_check`,`swhui`.`35_ucom`.`uc_logo` AS `uc_logo`,`swhui`.`35_ucom`.`uc_post` AS `uc_post` from (`35_user` join `35_ucom` on((`swhui`.`35_ucom`.`uc_uid` = `swhui`.`35_user`.`user_id`))) */;

/*View structure for view 35_viewunormal */

/*!50001 DROP TABLE IF EXISTS `35_viewunormal` */;
/*!50001 DROP VIEW IF EXISTS `35_viewunormal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewunormal` AS select `35_user`.`user_id` AS `user_id`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_salt` AS `user_salt`,`35_user`.`user_pwd` AS `user_pwd`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_regtime` AS `user_regtime`,`35_user`.`user_loginnum` AS `user_loginnum`,`35_user`.`user_lasttime` AS `user_lasttime`,`35_user`.`user_lastip` AS `user_lastip`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_unormal`.`puser_id` AS `puser_id`,`35_unormal`.`puser_tel` AS `puser_tel`,`35_unormal`.`puser_email` AS `puser_email`,`35_unormal`.`puser_logopath` AS `puser_logopath`,`35_unormal`.`puser_vip` AS `puser_vip` from (`35_user` join `35_unormal` on((`35_unormal`.`puser_uid` = `35_user`.`user_id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
