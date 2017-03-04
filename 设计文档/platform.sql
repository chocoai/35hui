/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : swhui

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2010-02-21 09:56:16
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `35_businessbaseinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_businessbaseinfo`;
CREATE TABLE `35_businessbaseinfo` (
  `bb_businessid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bb_uid` int(11) unsigned NOT NULL,
  `bb_businesstype` set('餐饮美食','娱乐休闲','百货零售','公司工厂','其他服务业') NOT NULL,
  `bb_province` varchar(20) NOT NULL,
  `bb_city` varchar(20) NOT NULL,
  `bb_businessaddress` varchar(200) NOT NULL,
  `bb_buildingarea` float NOT NULL,
  `bb_businessprice` float NOT NULL,
  `bb_propertytype` set('租赁','自有') NOT NULL,
  `bb_companytype` set('个体工商户','个人独资','国内合资','中外合资','外方独资') NOT NULL,
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
  `bb_rleasedate` date NOT NULL,
  `bb_expiredate` date DEFAULT NULL,
  PRIMARY KEY (`bb_businessid`),
  KEY `FK_UID004` (`bb_uid`),
  CONSTRAINT `FK_UID004` FOREIGN KEY (`bb_uid`) REFERENCES `35_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_businessbaseinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_businesspresentinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_businesspresentinfo`;
CREATE TABLE `35_businesspresentinfo` (
  `bp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bp_businessid` int(11) unsigned NOT NULL,
  `bp_businesstitle` varchar(50) NOT NULL,
  `bp_serialnum` varchar(50) DEFAULT NULL,
  `bp_businessdesc` text,
  `bp_traffice` varchar(50) DEFAULT NULL,
  `bp_carparking` varchar(50) DEFAULT NULL,
  `bp_facilityaround` varchar(50) DEFAULT NULL,
  `bp_ichnographyurl` varchar(200) DEFAULT NULL,
  `bp_outdoorpicurl` varchar(200) DEFAULT NULL,
  `bp_indoorpicurl` varchar(200) DEFAULT NULL,
  `bp_titlepicurl` varchar(200) DEFAULT NULL,
  `bp_outdoorvideourl` varchar(200) DEFAULT NULL,
  `bp_indoorvideourl` varchar(200) DEFAULT NULL,
  `bp_3durl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`bp_id`),
  KEY `FK_BID` (`bp_businessid`),
  CONSTRAINT `FK_BID` FOREIGN KEY (`bp_businessid`) REFERENCES `35_businessbaseinfo` (`bb_businessid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_businesspresentinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_businessrentinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_businessrentinfo`;
CREATE TABLE `35_businessrentinfo` (
  `br_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `br_businessid` int(11) unsigned NOT NULL,
  `br_rentprice` float NOT NULL,
  `br_iscontainprocost` set('1','0') NOT NULL,
  `br_renttype` set('整租','合租','其他') NOT NULL,
  `br_payway` set('面议','一次性','按揭') NOT NULL,
  `br_basetime` float NOT NULL,
  PRIMARY KEY (`br_id`),
  KEY `FK_BID002` (`br_businessid`),
  CONSTRAINT `FK_BID002` FOREIGN KEY (`br_businessid`) REFERENCES `35_businessbaseinfo` (`bb_businessid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_businessrentinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_businesssellinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_businesssellinfo`;
CREATE TABLE `35_businesssellinfo` (
  `bs_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bs_businessid` int(11) unsigned NOT NULL,
  `bs_sellprice` float NOT NULL,
  PRIMARY KEY (`bs_id`),
  KEY `FK_BID003` (`bs_businessid`),
  CONSTRAINT `FK_BID003` FOREIGN KEY (`bs_businessid`) REFERENCES `35_businessbaseinfo` (`bb_businessid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_businesssellinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_businesstag`
-- ----------------------------
DROP TABLE IF EXISTS `35_businesstag`;
CREATE TABLE `35_businesstag` (
  `bt_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bt_businessid` int(11) unsigned NOT NULL,
  `bt_ishigh` set('1','0') DEFAULT '0',
  `bt_isrecommend` set('1','0') DEFAULT '0',
  `bt_ishomepage` set('1','0') DEFAULT '0',
  `bt_isvideo` set('1','0') DEFAULT '0',
  `bt_is3d` set('1','0') DEFAULT '0',
  `bt_isconsign` set('1','0') DEFAULT '0',
  `bt_consignid` int(11) DEFAULT '-1',
  `bt_isnew` set('1','0') DEFAULT '0',
  `bt_ishurry` set('1','0') DEFAULT '0',
  `bt_check` set('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`bt_id`),
  KEY `FK_BID004` (`bt_businessid`),
  CONSTRAINT `FK_BID004` FOREIGN KEY (`bt_businessid`) REFERENCES `35_businessbaseinfo` (`bb_businessid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='			';

-- ----------------------------
-- Records of 35_businesstag
-- ----------------------------

-- ----------------------------
-- Table structure for `35_factorybaseinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_factorybaseinfo`;
CREATE TABLE `35_factorybaseinfo` (
  `fb_factoryid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fb_uid` int(11) unsigned NOT NULL,
  `fb_province` varchar(20) NOT NULL,
  `fb_city` varchar(20) NOT NULL,
  `fb_factoryname` varchar(50) NOT NULL,
  `fb_administrativearea` varchar(20) NOT NULL,
  `fb_district` varchar(20) NOT NULL,
  `fb_tradecircle` varchar(20) DEFAULT NULL,
  `fb_busway` varchar(200) DEFAULT NULL,
  `fb_propertyinfo` set('限价房','央产房','个人产权','使用权','单位产权','经济适用房','军产房') NOT NULL,
  `fb_buildingarea` float NOT NULL,
  `fb_coverarea` float DEFAULT NULL,
  `fb_sparearea` float DEFAULT NULL,
  `fb_buildingage` varchar(20) DEFAULT NULL,
  `fb_plotratio` float DEFAULT NULL,
  `fb_greenratio` float DEFAULT NULL,
  `fb_suittarde` set('加工制造业','物流仓储业','电子信息业','科研业','冶炼业','农牧种植业','化工行业','医疗行业','其他') NOT NULL,
  `fb_factorytype` set('厂房','仓库','土地','研发大楼','其他') NOT NULL,
  `fb_floor` set('单层','双层','多层','其他') DEFAULT NULL,
  `fb_structure` set('框架','砖混','砖木','剪力墙','框架剪力墙','钢') DEFAULT NULL,
  `fb_crane` float DEFAULT NULL,
  `fb_loadbearing` float DEFAULT NULL,
  `fb_elecpower` float DEFAULT NULL,
  `fb_water` float DEFAULT NULL,
  `fb_adrondegree` set('豪华装修','精装修','中等装修','简装修','毛坯') DEFAULT NULL,
  `fb_communication` varchar(50) DEFAULT NULL,
  `fb_facilityaround` varchar(200) DEFAULT NULL,
  `fb_facilityindoor` varchar(200) DEFAULT NULL,
  `fb_sellorrent` set('r','s') NOT NULL,
  `fb_rleasedate` date NOT NULL,
  `fb_expiredate` date DEFAULT NULL,
  PRIMARY KEY (`fb_factoryid`),
  KEY `FK_UID005` (`fb_uid`),
  CONSTRAINT `FK_UID005` FOREIGN KEY (`fb_uid`) REFERENCES `35_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_factorybaseinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_factorypresentinfo`
-- ----------------------------
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
  `fp_ichnographyurl` varchar(200) DEFAULT NULL,
  `fp_outdoorpicurl` varchar(200) DEFAULT NULL,
  `fp_indoorpicurl` varchar(200) DEFAULT NULL,
  `fp_titlepicurl` varchar(200) DEFAULT NULL,
  `fp_outdoorvideourl` varchar(200) DEFAULT NULL,
  `fp_indoorvideourl` varchar(200) DEFAULT NULL,
  `fp_3durl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fp_id`),
  KEY `FK_FID001` (`fp_factoryid`),
  CONSTRAINT `FK_FID001` FOREIGN KEY (`fp_factoryid`) REFERENCES `35_factorybaseinfo` (`fb_factoryid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_factorypresentinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_factoryrentinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_factoryrentinfo`;
CREATE TABLE `35_factoryrentinfo` (
  `fr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fr_factoryid` int(11) unsigned NOT NULL,
  `fr_rentprice` float NOT NULL,
  `fr_iscontainprocost` set('1','0') NOT NULL,
  `fr_renttype` set('整租','合租','其他') NOT NULL,
  `fr_payway` set('面议','一次性','按揭') NOT NULL,
  `fr_basetime` float NOT NULL,
  PRIMARY KEY (`fr_id`),
  KEY `FK_FID002` (`fr_factoryid`),
  CONSTRAINT `FK_FID002` FOREIGN KEY (`fr_factoryid`) REFERENCES `35_factorybaseinfo` (`fb_factoryid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_factoryrentinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_factorysellinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_factorysellinfo`;
CREATE TABLE `35_factorysellinfo` (
  `fs_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fs_factoryid` int(11) unsigned NOT NULL,
  `fs_sellprice` float NOT NULL,
  PRIMARY KEY (`fs_id`),
  KEY `FK_FID003` (`fs_factoryid`),
  CONSTRAINT `FK_FID003` FOREIGN KEY (`fs_factoryid`) REFERENCES `35_factorybaseinfo` (`fb_factoryid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_factorysellinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_factorytag`
-- ----------------------------
DROP TABLE IF EXISTS `35_factorytag`;
CREATE TABLE `35_factorytag` (
  `ft_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ft_factoryid` int(11) unsigned NOT NULL,
  `ft_ishigh` set('1','0') DEFAULT '0',
  `ft_isrecommend` set('1','0') DEFAULT '0',
  `ft_ishomepage` set('1','0') DEFAULT '0',
  `ft_isvideo` set('1','0') DEFAULT '0',
  `ft_is3d` set('1','0') DEFAULT '0',
  `ft_isconsign` set('1','0') DEFAULT '0',
  `ft_consignid` int(11) DEFAULT '-1',
  `ft_isnew` set('1','0') DEFAULT '0',
  `ft_ishurry` set('1','0') DEFAULT '0',
  `ft_check` set('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`ft_id`),
  KEY `FK_FID004` (`ft_factoryid`),
  CONSTRAINT `FK_FID004` FOREIGN KEY (`ft_factoryid`) REFERENCES `35_factorybaseinfo` (`fb_factoryid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_factorytag
-- ----------------------------

-- ----------------------------
-- Table structure for `35_officebaseinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_officebaseinfo`;
CREATE TABLE `35_officebaseinfo` (
  `ob_officeid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ob_uid` int(11) unsigned NOT NULL,
  `ob_province` varchar(20) NOT NULL,
  `ob_city` varchar(20) NOT NULL,
  `ob_buildingtype` set('商务中心','创意办公室','写字楼') NOT NULL,
  `ob_officename` varchar(50) NOT NULL,
  `ob_officetype` set('商住楼','纯写字楼','商业综合体楼','酒店写字楼') NOT NULL,
  `ob_administrativearea` varchar(20) NOT NULL,
  `ob_district` varchar(20) NOT NULL,
  `ob_tradecircle` varchar(20) NOT NULL,
  `ob_busway` varchar(200) NOT NULL,
  `ob_officeaddress` varchar(200) NOT NULL,
  `ob_propertycomname` varchar(50) DEFAULT NULL,
  `ob_propertycost` float NOT NULL,
  `ob_foreign` set('1','0') DEFAULT NULL,
  `ob_officearea` float NOT NULL,
  `ob_floor` int(11) NOT NULL,
  `ob_buildingage` varchar(20) DEFAULT NULL,
  `ob_cancut` set('1','0') DEFAULT NULL,
  `ob_adrondegree` set('豪华装','精装修','中装修','简装修','毛坯') DEFAULT NULL,
  `ob_officedegree` set('甲级','乙级','丙级') NOT NULL,
  `ob_sellorrent` set('s','r') NOT NULL,
  `ob_releasedate` date NOT NULL,
  `ob_expireDate` date NOT NULL,
  PRIMARY KEY (`ob_officeid`),
  KEY `FK_UID006` (`ob_uid`),
  CONSTRAINT `FK_UID006` FOREIGN KEY (`ob_uid`) REFERENCES `35_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_officebaseinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_officefacilityinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_officefacilityinfo`;
CREATE TABLE `35_officefacilityinfo` (
  `of_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `of_officeid` int(11) unsigned NOT NULL,
  `of_carparking` set('0','1') NOT NULL DEFAULT '0',
  `of_warming` set('0','1') NOT NULL DEFAULT '0',
  `of_network` set('0','1') NOT NULL DEFAULT '0',
  `of_electricity` set('0','1') NOT NULL DEFAULT '0',
  `of_water` set('0','1') NOT NULL DEFAULT '0',
  `of_elevator` set('0','1') NOT NULL DEFAULT '0',
  `of_gas` set('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`of_id`),
  KEY `FK_OID001` (`of_officeid`),
  CONSTRAINT `FK_OID001` FOREIGN KEY (`of_officeid`) REFERENCES `35_officebaseinfo` (`ob_officeid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_officefacilityinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_officepresentinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_officepresentinfo`;
CREATE TABLE `35_officepresentinfo` (
  `op_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `op_officeid` int(11) unsigned NOT NULL,
  `op_officetitle` varchar(50) NOT NULL,
  `op_serialnum` varchar(50) NOT NULL,
  `op_officedesc` text NOT NULL,
  `op_traffice` varchar(50) DEFAULT NULL,
  `op_carparking` varchar(50) DEFAULT NULL,
  `op_facilityaround` varchar(50) DEFAULT NULL,
  `op_ichnographyurl` varchar(200) DEFAULT NULL,
  `op_outdoorpicurl` varchar(200) DEFAULT NULL,
  `op_indoorpicurl` varchar(200) DEFAULT NULL,
  `op_titlepicurl` varchar(200) DEFAULT NULL,
  `op_outdoorvideourl` varchar(200) DEFAULT NULL,
  `op_indoorvideourl` varchar(200) DEFAULT NULL,
  `op_3durl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`op_id`),
  KEY `FK_OID002` (`op_officeid`),
  CONSTRAINT `FK_OID002` FOREIGN KEY (`op_officeid`) REFERENCES `35_officebaseinfo` (`ob_officeid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_officepresentinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_officerentinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_officerentinfo`;
CREATE TABLE `35_officerentinfo` (
  `or_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `or_officeid` int(11) unsigned NOT NULL,
  `or_rentprice` float NOT NULL,
  `or_iscontainprocost` set('1','0') NOT NULL,
  `or_renttype` set('整租','合租','其他') NOT NULL,
  `or_payway` set('面议','一次性','按揭') NOT NULL,
  `or_basetime` float NOT NULL,
  PRIMARY KEY (`or_id`),
  KEY `FK_OID003` (`or_officeid`),
  CONSTRAINT `FK_OID003` FOREIGN KEY (`or_officeid`) REFERENCES `35_officebaseinfo` (`ob_officeid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_officerentinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_officesellinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_officesellinfo`;
CREATE TABLE `35_officesellinfo` (
  `os_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `os_officeid` int(11) unsigned NOT NULL,
  `os_sellprice` float NOT NULL,
  PRIMARY KEY (`os_id`),
  KEY `FK_OID004` (`os_officeid`),
  CONSTRAINT `FK_OID004` FOREIGN KEY (`os_officeid`) REFERENCES `35_officebaseinfo` (`ob_officeid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_officesellinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_officetag`
-- ----------------------------
DROP TABLE IF EXISTS `35_officetag`;
CREATE TABLE `35_officetag` (
  `ot_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ot_officeid` int(11) unsigned NOT NULL,
  `ot_ishigh` set('1','0') DEFAULT '0',
  `ot_isrecommend` set('1','0') DEFAULT '0',
  `ot_ishomepage` set('1','0') DEFAULT '0',
  `ot_isvideo` set('1','0') DEFAULT '0',
  `ot_is3d` set('1','0') DEFAULT '0',
  `ot_isconsign` set('1','0') DEFAULT '0',
  `ot_consignid` int(11) DEFAULT '-1',
  `ot_isnew` set('1','0') DEFAULT '0',
  `ot_ishurry` set('1','0') DEFAULT '0',
  `ot_check` set('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`ot_id`),
  KEY `FK_OID005` (`ot_officeid`),
  CONSTRAINT `FK_OID005` FOREIGN KEY (`ot_officeid`) REFERENCES `35_officebaseinfo` (`ob_officeid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_officetag
-- ----------------------------

-- ----------------------------
-- Table structure for `35_projectbaseinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_projectbaseinfo`;
CREATE TABLE `35_projectbaseinfo` (
  `pb_projectid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pb_uid` int(11) unsigned NOT NULL,
  `pb_province` varchar(20) NOT NULL,
  `pb_city` varchar(20) NOT NULL,
  `pb_projcetaddress` varchar(200) DEFAULT NULL,
  `pb_transactionway` set('出租','出售','合作') NOT NULL,
  `pb_price` float NOT NULL,
  `pb_releasedate` date NOT NULL,
  `pb_expiredate` date DEFAULT NULL,
  PRIMARY KEY (`pb_projectid`),
  KEY `FK_UID007` (`pb_uid`),
  CONSTRAINT `FK_UID007` FOREIGN KEY (`pb_uid`) REFERENCES `35_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_projectbaseinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_projectpresentinfo`
-- ----------------------------
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
  `pp_ichnographyurl` varchar(200) DEFAULT NULL,
  `pp_outdoorpicurl` varchar(200) DEFAULT NULL,
  `pp_indoorpicurl` varchar(200) DEFAULT NULL,
  `pp_titlepicurl` varchar(200) DEFAULT NULL,
  `pp_outdoorvideourl` varchar(200) DEFAULT NULL,
  `pp_indoorvideourl` varchar(200) DEFAULT NULL,
  `pp_3durl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`pp_id`),
  KEY `FK_PID001` (`pp_projectid`),
  CONSTRAINT `FK_PID001` FOREIGN KEY (`pp_projectid`) REFERENCES `35_projectbaseinfo` (`pb_projectid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_projectpresentinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_projecttag`
-- ----------------------------
DROP TABLE IF EXISTS `35_projecttag`;
CREATE TABLE `35_projecttag` (
  `pt_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pt_projectid` int(11) unsigned NOT NULL,
  `pt_ishigh` set('1','0') DEFAULT '0',
  `pt_isrecommend` set('1','0') DEFAULT '0',
  `pt_ishomepage` set('1','0') DEFAULT '0',
  `pt_isvideo` set('1','0') DEFAULT '0',
  `pt_is3d` set('1','0') DEFAULT '0',
  `pt_isconsign` set('1','0') DEFAULT '0',
  `pt_consignid` int(11) DEFAULT '-1',
  `pt_isnew` set('1','0') DEFAULT '0',
  `pt_ishurry` set('1','0') DEFAULT '0',
  `pt_check` set('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`pt_id`),
  KEY `FK_PID002` (`pt_projectid`),
  CONSTRAINT `FK_PID002` FOREIGN KEY (`pt_projectid`) REFERENCES `35_projectbaseinfo` (`pb_projectid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_projecttag
-- ----------------------------

-- ----------------------------
-- Table structure for `35_shopbaseinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_shopbaseinfo`;
CREATE TABLE `35_shopbaseinfo` (
  `sb_shopid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sb_uid` int(11) unsigned NOT NULL,
  `sb_province` varchar(20) NOT NULL,
  `sb_city` varchar(20) NOT NULL,
  `sb_shopname` varchar(50) NOT NULL,
  `sb_shoptype` set('住宅底商','商业街商铺','酒店底商','旅游商铺','社区商铺','沿街门脸','写字楼配套底商','购物中心/综合体卖场') NOT NULL,
  `sb_selltype` set('店铺','摊位','柜台') NOT NULL,
  `sb_businesstype` set('餐饮美食','娱乐休闲','百货零售','公司工厂','其他服务业') NOT NULL,
  `sb_buildingname` varchar(50) NOT NULL,
  `sb_administrativearea` varchar(20) NOT NULL,
  `sb_district` varchar(20) NOT NULL,
  `sb_tradecircle` varchar(20) DEFAULT NULL,
  `sb_busway` varchar(200) NOT NULL,
  `sb_shopaddress` varchar(200) NOT NULL,
  `sb_proprtycomname` varchar(50) DEFAULT NULL,
  `sb_propertycost` float NOT NULL,
  `sb_shoparea` float NOT NULL,
  `sb_shopusablearea` float DEFAULT NULL,
  `sb_floor` set('单层','双层','多层') DEFAULT NULL,
  `sb_buildingage` varchar(20) DEFAULT NULL,
  `sb_cancut` set('1','0') DEFAULT NULL,
  `sb_adrondegree` set('豪华装','精装修','中装','简装修','毛坯') DEFAULT NULL,
  `sb_sellorrent` set('s','r') NOT NULL,
  `sb_releasedate` date NOT NULL,
  `sb_expiredate` date DEFAULT NULL,
  PRIMARY KEY (`sb_shopid`),
  KEY `FK_UID008` (`sb_uid`),
  CONSTRAINT `FK_UID008` FOREIGN KEY (`sb_uid`) REFERENCES `35_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_shopbaseinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_shopfacilityinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_shopfacilityinfo`;
CREATE TABLE `35_shopfacilityinfo` (
  `sf_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sf_shopid` int(11) unsigned NOT NULL,
  `sf_carparking` set('1','0') NOT NULL DEFAULT '0',
  `sf_warming` set('1','0') NOT NULL DEFAULT '0',
  `sf_network` set('1','0') NOT NULL DEFAULT '0',
  `sf_electricity` set('1','0') NOT NULL DEFAULT '0',
  `sf_water` set('1','0') NOT NULL DEFAULT '0',
  `sf_elevator` set('1','0') NOT NULL DEFAULT '0',
  `of_gas` set('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`sf_id`),
  KEY `FK_SID001` (`sf_shopid`),
  CONSTRAINT `FK_SID001` FOREIGN KEY (`sf_shopid`) REFERENCES `35_shopbaseinfo` (`sb_shopid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_shopfacilityinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_shoppresentinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_shoppresentinfo`;
CREATE TABLE `35_shoppresentinfo` (
  `sp_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '''',
  `sp_shopid` int(11) unsigned NOT NULL,
  `sp_shoptitle` varchar(50) NOT NULL,
  `sp_serialnum` varchar(50) DEFAULT NULL,
  `sp_shopdesc` text,
  `sp_traffice` varchar(50) DEFAULT NULL,
  `sp_carparking` varchar(50) DEFAULT NULL,
  `sp_facilityaround` varchar(50) DEFAULT NULL,
  `sp_ichnographurl` varchar(200) DEFAULT NULL,
  `sp_outdoorpicurl` varchar(200) DEFAULT NULL,
  `sp_indoorpciurl` varchar(200) DEFAULT NULL,
  `sp_titlepicurl` varchar(200) DEFAULT NULL,
  `sp_outdoorvideourl` varchar(200) DEFAULT NULL,
  `sp_indoorvideourl` varchar(200) DEFAULT NULL,
  `sp_3durl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`sp_id`),
  KEY `FK_SID002` (`sp_shopid`),
  CONSTRAINT `FK_SID002` FOREIGN KEY (`sp_shopid`) REFERENCES `35_shopbaseinfo` (`sb_shopid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

-- ----------------------------
-- Records of 35_shoppresentinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_shoprentinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_shoprentinfo`;
CREATE TABLE `35_shoprentinfo` (
  `sr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sr_shopid` int(11) unsigned NOT NULL,
  `sr_rentprice` float NOT NULL,
  `sr_iscontainprocost` set('1','0') NOT NULL,
  `sr_renttype` set('整租','合租','其他') NOT NULL,
  `sr_payway` set('面议','一次性','按揭') NOT NULL,
  `sr_basetime` float NOT NULL,
  PRIMARY KEY (`sr_id`),
  KEY `FK_SID003` (`sr_shopid`),
  CONSTRAINT `FK_SID003` FOREIGN KEY (`sr_shopid`) REFERENCES `35_shopbaseinfo` (`sb_shopid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_shoprentinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_shopsellinfo`
-- ----------------------------
DROP TABLE IF EXISTS `35_shopsellinfo`;
CREATE TABLE `35_shopsellinfo` (
  `ss_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ss_shopid` int(11) unsigned NOT NULL,
  `ss_sellprice` float NOT NULL,
  PRIMARY KEY (`ss_id`),
  KEY `FK_SID004` (`ss_shopid`),
  CONSTRAINT `FK_SID004` FOREIGN KEY (`ss_shopid`) REFERENCES `35_shopbaseinfo` (`sb_shopid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_shopsellinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `35_shoptag`
-- ----------------------------
DROP TABLE IF EXISTS `35_shoptag`;
CREATE TABLE `35_shoptag` (
  `st_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `st_shopid` int(11) unsigned NOT NULL,
  `st_ishigh` set('1','0') DEFAULT '0',
  `st_isrecommend` set('1','0') DEFAULT '0',
  `st_ishomepage` set('1','0') DEFAULT '0',
  `st_isvideo` set('1','0') DEFAULT '0',
  `st_is3d` set('1','0') DEFAULT '0',
  `st_isconsign` set('1','0') DEFAULT '0',
  `st_consignid` int(11) DEFAULT '-1',
  `st_isnew` set('1','0') DEFAULT '0',
  `st_ishurry` set('1','0') DEFAULT '0',
  `st_check` set('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`st_id`),
  KEY `FK_SID005` (`st_shopid`),
  CONSTRAINT `FK_SID005` FOREIGN KEY (`st_shopid`) REFERENCES `35_shopbaseinfo` (`sb_shopid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_shoptag
-- ----------------------------

-- ----------------------------
-- Table structure for `35_uagent`
-- ----------------------------
DROP TABLE IF EXISTS `35_uagent`;
CREATE TABLE `35_uagent` (
  `ua_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ua_uid` int(11) unsigned NOT NULL,
  `ua_city` varchar(20) NOT NULL,
  `ua_district` varchar(20) NOT NULL,
  `ua_section` varchar(20) NOT NULL,
  `ua_realname` varchar(20) DEFAULT NULL,
  `ua_tel` varchar(20) DEFAULT NULL,
  `ua_msn` varchar(50) DEFAULT NULL,
  `ua_comid` int(11) DEFAULT NULL,
  `ua_photourl` varchar(200) DEFAULT NULL,
  `ua_scardurl` varchar(200) DEFAULT NULL,
  `ua_bcardurl` varchar(200) DEFAULT NULL,
  `ua_scardid` varchar(20) DEFAULT NULL,
  `uacheck` set('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`ua_id`),
  KEY `FK_UID003` (`ua_uid`),
  CONSTRAINT `FK_UID003` FOREIGN KEY (`ua_uid`) REFERENCES `35_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_uagent
-- ----------------------------

-- ----------------------------
-- Table structure for `35_ucom`
-- ----------------------------
DROP TABLE IF EXISTS `35_ucom`;
CREATE TABLE `35_ucom` (
  `uc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uc_uid` int(11) unsigned NOT NULL,
  `uc_city` varchar(20) NOT NULL,
  `uc_province` varchar(20) NOT NULL,
  `uc_district` varchar(20) NOT NULL,
  `uc_section` varchar(20) NOT NULL,
  `uc_address` varchar(200) NOT NULL,
  `uc_fullname` varchar(50) NOT NULL,
  `uc_shortname` varchar(50) NOT NULL,
  `uc_belongcom` varchar(50) DEFAULT NULL,
  `uc_officetel` varchar(20) DEFAULT NULL,
  `uc_contact` varchar(20) NOT NULL,
  `uc_tel` varchar(20) NOT NULL,
  `uc_msn` varchar(50) DEFAULT NULL,
  `uc_email` varchar(50) NOT NULL,
  `uc_recogniseurl` varchar(200) DEFAULT NULL,
  `uc_check` set('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`uc_id`),
  KEY `FK_UID002` (`uc_uid`),
  CONSTRAINT `FK_UID002` FOREIGN KEY (`uc_uid`) REFERENCES `35_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_ucom
-- ----------------------------

-- ----------------------------
-- Table structure for `35_unormal`
-- ----------------------------
DROP TABLE IF EXISTS `35_unormal`;
CREATE TABLE `35_unormal` (
  `puser_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `puser_uid` int(11) unsigned NOT NULL,
  `puser_tel` varchar(20) NOT NULL,
  `puser_email` varchar(50) NOT NULL,
  `puser_logopath` varchar(200) DEFAULT NULL,
  `puser_vip` set('1','0') DEFAULT '0',
  PRIMARY KEY (`puser_id`),
  KEY `FK_UID001` (`puser_uid`),
  CONSTRAINT `FK_UID001` FOREIGN KEY (`puser_uid`) REFERENCES `35_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_unormal
-- ----------------------------

-- ----------------------------
-- Table structure for `35_user`
-- ----------------------------
DROP TABLE IF EXISTS `35_user`;
CREATE TABLE `35_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_salt` varchar(50) NOT NULL,
  `user_pwd` varchar(50) NOT NULL,
  `user_role` set('personal','agent','company','shop','admin') NOT NULL,
  `user_regtime` date DEFAULT NULL,
  `user_logintime` date DEFAULT NULL,
  `user_lasttime` date DEFAULT NULL,
  `user_lastip` varchar(50) DEFAULT NULL,
  `user_value` float DEFAULT '0',
  `user_point` float DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 35_user
-- ----------------------------

-- ----------------------------
-- View structure for `35_viewbusrent`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewbusrent`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewbusrent` AS select `35_businessrentinfo`.`br_id` AS `br_id`,`35_businessrentinfo`.`br_rentprice` AS `br_rentprice`,`35_businessrentinfo`.`br_iscontainprocost` AS `br_iscontainprocost`,`35_businessrentinfo`.`br_renttype` AS `br_renttype`,`35_businessrentinfo`.`br_payway` AS `br_payway`,`35_businessrentinfo`.`br_basetime` AS `br_basetime`,`35_businesspresentinfo`.`bp_id` AS `bp_id`,`35_businesspresentinfo`.`bp_businesstitle` AS `bp_businesstitle`,`35_businesspresentinfo`.`bp_serialnum` AS `bp_serialnum`,`35_businesspresentinfo`.`bp_businessdesc` AS `bp_businessdesc`,`35_businesspresentinfo`.`bp_traffice` AS `bp_traffice`,`35_businesspresentinfo`.`bp_carparking` AS `bp_carparking`,`35_businesspresentinfo`.`bp_facilityaround` AS `bp_facilityaround`,`35_businesspresentinfo`.`bp_ichnographyurl` AS `bp_ichnographyurl`,`35_businesspresentinfo`.`bp_outdoorpicurl` AS `bp_outdoorpicurl`,`35_businesspresentinfo`.`bp_indoorpicurl` AS `bp_indoorpicurl`,`35_businesspresentinfo`.`bp_titlepicurl` AS `bp_titlepicurl`,`35_businesspresentinfo`.`bp_outdoorvideourl` AS `bp_outdoorvideourl`,`35_businesspresentinfo`.`bp_indoorvideourl` AS `bp_indoorvideourl`,`35_businesspresentinfo`.`bp_3durl` AS `bp_3durl`,`35_businesstag`.`bt_id` AS `bt_id`,`35_businesstag`.`bt_ishigh` AS `bt_ishigh`,`35_businesstag`.`bt_isrecommend` AS `bt_isrecommend`,`35_businesstag`.`bt_ishomepage` AS `bt_ishomepage`,`35_businesstag`.`bt_isvideo` AS `bt_isvideo`,`35_businesstag`.`bt_is3d` AS `bt_is3d`,`35_businesstag`.`bt_isconsign` AS `bt_isconsign`,`35_businesstag`.`bt_consignid` AS `bt_consignid`,`35_businesstag`.`bt_isnew` AS `bt_isnew`,`35_businesstag`.`bt_ishurry` AS `bt_ishurry`,`35_businesstag`.`bt_check` AS `bt_check`,`35_businessbaseinfo`.`bb_businessid` AS `bb_businessid`,`35_businessbaseinfo`.`bb_businesstype` AS `bb_businesstype`,`35_businessbaseinfo`.`bb_province` AS `bb_province`,`35_businessbaseinfo`.`bb_city` AS `bb_city`,`35_businessbaseinfo`.`bb_businessaddress` AS `bb_businessaddress`,`35_businessbaseinfo`.`bb_buildingarea` AS `bb_buildingarea`,`35_businessbaseinfo`.`bb_businessprice` AS `bb_businessprice`,`35_businessbaseinfo`.`bb_propertytype` AS `bb_propertytype`,`35_businessbaseinfo`.`bb_companytype` AS `bb_companytype`,`35_businessbaseinfo`.`bb_registerfunds` AS `bb_registerfunds`,`35_businessbaseinfo`.`bb_mainservice` AS `bb_mainservice`,`35_businessbaseinfo`.`bb_turnoverly` AS `bb_turnoverly`,`35_businessbaseinfo`.`bb_profitly` AS `bb_profitly`,`35_businessbaseinfo`.`bb_salestaxly` AS `bb_salestaxly`,`35_businessbaseinfo`.`bb_incometaxly` AS `bb_incometaxly`,`35_businessbaseinfo`.`bb_runtime` AS `bb_runtime`,`35_businessbaseinfo`.`bb_consumptionperson` AS `bb_consumptionperson`,`35_businessbaseinfo`.`bb_staffnum` AS `bb_staffnum`,`35_businessbaseinfo`.`bb_vipnum` AS `bb_vipnum`,`35_businessbaseinfo`.`bb_stocktransfer` AS `bb_stocktransfer`,`35_businessbaseinfo`.`bb_rleasedate` AS `bb_rleasedate`,`35_businessbaseinfo`.`bb_expiredate` AS `bb_expiredate`,`35_businessbaseinfo`.`bb_uid` AS `bb_uid`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value` from ((((`35_businessbaseinfo` join `35_businesspresentinfo` on((`35_businessbaseinfo`.`bb_businessid` = `35_businesspresentinfo`.`bp_businessid`))) join `35_businessrentinfo` on((`35_businessbaseinfo`.`bb_businessid` = `35_businessrentinfo`.`br_businessid`))) join `35_businesstag` on((`35_businessbaseinfo`.`bb_businessid` = `35_businesstag`.`bt_businessid`))) join `35_user` on((`35_user`.`user_id` = `35_businessbaseinfo`.`bb_uid`)));

-- ----------------------------
-- View structure for `35_viewbussell`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewbussell`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewbussell` AS select `35_businessbaseinfo`.`bb_businessid` AS `bb_businessid`,`35_businessbaseinfo`.`bb_uid` AS `bb_uid`,`35_businessbaseinfo`.`bb_businesstype` AS `bb_businesstype`,`35_businessbaseinfo`.`bb_province` AS `bb_province`,`35_businessbaseinfo`.`bb_city` AS `bb_city`,`35_businessbaseinfo`.`bb_businessaddress` AS `bb_businessaddress`,`35_businessbaseinfo`.`bb_buildingarea` AS `bb_buildingarea`,`35_businessbaseinfo`.`bb_businessprice` AS `bb_businessprice`,`35_businessbaseinfo`.`bb_propertytype` AS `bb_propertytype`,`35_businessbaseinfo`.`bb_companytype` AS `bb_companytype`,`35_businessbaseinfo`.`bb_registerfunds` AS `bb_registerfunds`,`35_businessbaseinfo`.`bb_mainservice` AS `bb_mainservice`,`35_businessbaseinfo`.`bb_turnoverly` AS `bb_turnoverly`,`35_businessbaseinfo`.`bb_profitly` AS `bb_profitly`,`35_businessbaseinfo`.`bb_salestaxly` AS `bb_salestaxly`,`35_businessbaseinfo`.`bb_incometaxly` AS `bb_incometaxly`,`35_businessbaseinfo`.`bb_runtime` AS `bb_runtime`,`35_businessbaseinfo`.`bb_consumptionperson` AS `bb_consumptionperson`,`35_businessbaseinfo`.`bb_staffnum` AS `bb_staffnum`,`35_businessbaseinfo`.`bb_vipnum` AS `bb_vipnum`,`35_businessbaseinfo`.`bb_stocktransfer` AS `bb_stocktransfer`,`35_businessbaseinfo`.`bb_rleasedate` AS `bb_rleasedate`,`35_businessbaseinfo`.`bb_expiredate` AS `bb_expiredate`,`35_businesstag`.`bt_id` AS `bt_id`,`35_businesstag`.`bt_ishigh` AS `bt_ishigh`,`35_businesstag`.`bt_isrecommend` AS `bt_isrecommend`,`35_businesstag`.`bt_ishomepage` AS `bt_ishomepage`,`35_businesstag`.`bt_isvideo` AS `bt_isvideo`,`35_businesstag`.`bt_is3d` AS `bt_is3d`,`35_businesstag`.`bt_isconsign` AS `bt_isconsign`,`35_businesstag`.`bt_consignid` AS `bt_consignid`,`35_businesstag`.`bt_isnew` AS `bt_isnew`,`35_businesstag`.`bt_ishurry` AS `bt_ishurry`,`35_businesstag`.`bt_check` AS `bt_check`,`35_businesssellinfo`.`bs_id` AS `bs_id`,`35_businesssellinfo`.`bs_sellprice` AS `bs_sellprice`,`35_businesspresentinfo`.`bp_id` AS `bp_id`,`35_businesspresentinfo`.`bp_businesstitle` AS `bp_businesstitle`,`35_businesspresentinfo`.`bp_serialnum` AS `bp_serialnum`,`35_businesspresentinfo`.`bp_businessdesc` AS `bp_businessdesc`,`35_businesspresentinfo`.`bp_traffice` AS `bp_traffice`,`35_businesspresentinfo`.`bp_carparking` AS `bp_carparking`,`35_businesspresentinfo`.`bp_facilityaround` AS `bp_facilityaround`,`35_businesspresentinfo`.`bp_ichnographyurl` AS `bp_ichnographyurl`,`35_businesspresentinfo`.`bp_outdoorpicurl` AS `bp_outdoorpicurl`,`35_businesspresentinfo`.`bp_indoorpicurl` AS `bp_indoorpicurl`,`35_businesspresentinfo`.`bp_titlepicurl` AS `bp_titlepicurl`,`35_businesspresentinfo`.`bp_outdoorvideourl` AS `bp_outdoorvideourl`,`35_businesspresentinfo`.`bp_indoorvideourl` AS `bp_indoorvideourl`,`35_businesspresentinfo`.`bp_3durl` AS `bp_3durl`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value` from ((((`35_businessbaseinfo` join `35_businesspresentinfo` on((`35_businesspresentinfo`.`bp_businessid` = `35_businessbaseinfo`.`bb_businessid`))) join `35_businesssellinfo` on((`35_businesssellinfo`.`bs_businessid` = `35_businessbaseinfo`.`bb_businessid`))) join `35_businesstag` on((`35_businessbaseinfo`.`bb_businessid` = `35_businesstag`.`bt_businessid`))) join `35_user` on((`35_user`.`user_id` = `35_businessbaseinfo`.`bb_uid`)));

-- ----------------------------
-- View structure for `35_viewfactrent`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewfactrent`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewfactrent` AS select `35_factorypresentinfo`.`fp_id` AS `fp_id`,`35_factorypresentinfo`.`fp_factorytitle` AS `fp_factorytitle`,`35_factorypresentinfo`.`fp_serialnum` AS `fp_serialnum`,`35_factorypresentinfo`.`fp_factorydesc` AS `fp_factorydesc`,`35_factorypresentinfo`.`fp_traffice` AS `fp_traffice`,`35_factorypresentinfo`.`fp_carparking` AS `fp_carparking`,`35_factorypresentinfo`.`fp_facilityaround` AS `fp_facilityaround`,`35_factorypresentinfo`.`fp_ichnographyurl` AS `fp_ichnographyurl`,`35_factorypresentinfo`.`fp_outdoorpicurl` AS `fp_outdoorpicurl`,`35_factorypresentinfo`.`fp_indoorpicurl` AS `fp_indoorpicurl`,`35_factorypresentinfo`.`fp_titlepicurl` AS `fp_titlepicurl`,`35_factorypresentinfo`.`fp_outdoorvideourl` AS `fp_outdoorvideourl`,`35_factorypresentinfo`.`fp_indoorvideourl` AS `fp_indoorvideourl`,`35_factorypresentinfo`.`fp_3durl` AS `fp_3durl`,`35_factoryrentinfo`.`fr_id` AS `fr_id`,`35_factoryrentinfo`.`fr_rentprice` AS `fr_rentprice`,`35_factoryrentinfo`.`fr_iscontainprocost` AS `fr_iscontainprocost`,`35_factoryrentinfo`.`fr_renttype` AS `fr_renttype`,`35_factoryrentinfo`.`fr_payway` AS `fr_payway`,`35_factoryrentinfo`.`fr_basetime` AS `fr_basetime`,`35_factorybaseinfo`.`fb_factoryid` AS `fb_factoryid`,`35_factorybaseinfo`.`fb_uid` AS `fb_uid`,`35_factorybaseinfo`.`fb_province` AS `fb_province`,`35_factorybaseinfo`.`fb_city` AS `fb_city`,`35_factorybaseinfo`.`fb_factoryname` AS `fb_factoryname`,`35_factorybaseinfo`.`fb_administrativearea` AS `fb_administrativearea`,`35_factorybaseinfo`.`fb_district` AS `fb_district`,`35_factorybaseinfo`.`fb_tradecircle` AS `fb_tradecircle`,`35_factorybaseinfo`.`fb_busway` AS `fb_busway`,`35_factorybaseinfo`.`fb_propertyinfo` AS `fb_propertyinfo`,`35_factorybaseinfo`.`fb_buildingarea` AS `fb_buildingarea`,`35_factorybaseinfo`.`fb_coverarea` AS `fb_coverarea`,`35_factorybaseinfo`.`fb_sparearea` AS `fb_sparearea`,`35_factorybaseinfo`.`fb_buildingage` AS `fb_buildingage`,`35_factorybaseinfo`.`fb_plotratio` AS `fb_plotratio`,`35_factorybaseinfo`.`fb_greenratio` AS `fb_greenratio`,`35_factorybaseinfo`.`fb_suittarde` AS `fb_suittarde`,`35_factorybaseinfo`.`fb_factorytype` AS `fb_factorytype`,`35_factorybaseinfo`.`fb_floor` AS `fb_floor`,`35_factorybaseinfo`.`fb_structure` AS `fb_structure`,`35_factorybaseinfo`.`fb_crane` AS `fb_crane`,`35_factorybaseinfo`.`fb_loadbearing` AS `fb_loadbearing`,`35_factorybaseinfo`.`fb_elecpower` AS `fb_elecpower`,`35_factorybaseinfo`.`fb_water` AS `fb_water`,`35_factorybaseinfo`.`fb_adrondegree` AS `fb_adrondegree`,`35_factorybaseinfo`.`fb_communication` AS `fb_communication`,`35_factorybaseinfo`.`fb_facilityaround` AS `fb_facilityaround`,`35_factorybaseinfo`.`fb_facilityindoor` AS `fb_facilityindoor`,`35_factorybaseinfo`.`fb_sellorrent` AS `fb_sellorrent`,`35_factorybaseinfo`.`fb_rleasedate` AS `fb_rleasedate`,`35_factorybaseinfo`.`fb_expiredate` AS `fb_expiredate`,`35_factorytag`.`ft_id` AS `ft_id`,`35_factorytag`.`ft_ishigh` AS `ft_ishigh`,`35_factorytag`.`ft_isrecommend` AS `ft_isrecommend`,`35_factorytag`.`ft_ishomepage` AS `ft_ishomepage`,`35_factorytag`.`ft_isvideo` AS `ft_isvideo`,`35_factorytag`.`ft_is3d` AS `ft_is3d`,`35_factorytag`.`ft_isconsign` AS `ft_isconsign`,`35_factorytag`.`ft_consignid` AS `ft_consignid`,`35_factorytag`.`ft_isnew` AS `ft_isnew`,`35_factorytag`.`ft_ishurry` AS `ft_ishurry`,`35_factorytag`.`ft_check` AS `ft_check`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value` from ((((`35_factorybaseinfo` join `35_factorypresentinfo` on((`35_factorypresentinfo`.`fp_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_factoryrentinfo` on((`35_factoryrentinfo`.`fr_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_factorytag` on((`35_factorytag`.`ft_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_user` on((`35_user`.`user_id` = `35_factorybaseinfo`.`fb_uid`)));

-- ----------------------------
-- View structure for `35_viewfactsell`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewfactsell`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewfactsell` AS select `35_factorybaseinfo`.`fb_uid` AS `fb_uid`,`35_factorybaseinfo`.`fb_province` AS `fb_province`,`35_factorybaseinfo`.`fb_city` AS `fb_city`,`35_factorybaseinfo`.`fb_factoryname` AS `fb_factoryname`,`35_factorybaseinfo`.`fb_administrativearea` AS `fb_administrativearea`,`35_factorybaseinfo`.`fb_district` AS `fb_district`,`35_factorybaseinfo`.`fb_tradecircle` AS `fb_tradecircle`,`35_factorybaseinfo`.`fb_busway` AS `fb_busway`,`35_factorybaseinfo`.`fb_propertyinfo` AS `fb_propertyinfo`,`35_factorybaseinfo`.`fb_buildingarea` AS `fb_buildingarea`,`35_factorybaseinfo`.`fb_coverarea` AS `fb_coverarea`,`35_factorybaseinfo`.`fb_sparearea` AS `fb_sparearea`,`35_factorybaseinfo`.`fb_buildingage` AS `fb_buildingage`,`35_factorybaseinfo`.`fb_plotratio` AS `fb_plotratio`,`35_factorybaseinfo`.`fb_greenratio` AS `fb_greenratio`,`35_factorybaseinfo`.`fb_suittarde` AS `fb_suittarde`,`35_factorybaseinfo`.`fb_factorytype` AS `fb_factorytype`,`35_factorybaseinfo`.`fb_floor` AS `fb_floor`,`35_factorybaseinfo`.`fb_structure` AS `fb_structure`,`35_factorybaseinfo`.`fb_crane` AS `fb_crane`,`35_factorybaseinfo`.`fb_loadbearing` AS `fb_loadbearing`,`35_factorybaseinfo`.`fb_elecpower` AS `fb_elecpower`,`35_factorybaseinfo`.`fb_water` AS `fb_water`,`35_factorybaseinfo`.`fb_adrondegree` AS `fb_adrondegree`,`35_factorybaseinfo`.`fb_communication` AS `fb_communication`,`35_factorybaseinfo`.`fb_facilityaround` AS `fb_facilityaround`,`35_factorybaseinfo`.`fb_facilityindoor` AS `fb_facilityindoor`,`35_factorybaseinfo`.`fb_sellorrent` AS `fb_sellorrent`,`35_factorybaseinfo`.`fb_rleasedate` AS `fb_rleasedate`,`35_factorybaseinfo`.`fb_expiredate` AS `fb_expiredate`,`35_factorytag`.`ft_id` AS `ft_id`,`35_factorytag`.`ft_ishigh` AS `ft_ishigh`,`35_factorytag`.`ft_isrecommend` AS `ft_isrecommend`,`35_factorytag`.`ft_ishomepage` AS `ft_ishomepage`,`35_factorytag`.`ft_isvideo` AS `ft_isvideo`,`35_factorytag`.`ft_is3d` AS `ft_is3d`,`35_factorytag`.`ft_isconsign` AS `ft_isconsign`,`35_factorytag`.`ft_consignid` AS `ft_consignid`,`35_factorytag`.`ft_isnew` AS `ft_isnew`,`35_factorytag`.`ft_ishurry` AS `ft_ishurry`,`35_factorytag`.`ft_check` AS `ft_check`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_factorypresentinfo`.`fp_id` AS `fp_id`,`35_factorypresentinfo`.`fp_factorytitle` AS `fp_factorytitle`,`35_factorypresentinfo`.`fp_serialnum` AS `fp_serialnum`,`35_factorypresentinfo`.`fp_factorydesc` AS `fp_factorydesc`,`35_factorypresentinfo`.`fp_traffice` AS `fp_traffice`,`35_factorypresentinfo`.`fp_carparking` AS `fp_carparking`,`35_factorypresentinfo`.`fp_facilityaround` AS `fp_facilityaround`,`35_factorypresentinfo`.`fp_ichnographyurl` AS `fp_ichnographyurl`,`35_factorypresentinfo`.`fp_outdoorpicurl` AS `fp_outdoorpicurl`,`35_factorypresentinfo`.`fp_indoorpicurl` AS `fp_indoorpicurl`,`35_factorypresentinfo`.`fp_titlepicurl` AS `fp_titlepicurl`,`35_factorypresentinfo`.`fp_outdoorvideourl` AS `fp_outdoorvideourl`,`35_factorypresentinfo`.`fp_indoorvideourl` AS `fp_indoorvideourl`,`35_factorypresentinfo`.`fp_3durl` AS `fp_3durl`,`35_factorybaseinfo`.`fb_factoryid` AS `fb_factoryid`,`35_factorysellinfo`.`fs_id` AS `fs_id`,`35_factorysellinfo`.`fs_sellprice` AS `fs_sellprice` from ((((`35_factorybaseinfo` join `35_factorypresentinfo` on((`35_factorypresentinfo`.`fp_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_factorysellinfo` on((`35_factorysellinfo`.`fs_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_factorytag` on((`35_factorytag`.`ft_factoryid` = `35_factorybaseinfo`.`fb_factoryid`))) join `35_user` on((`35_user`.`user_id` = `35_factorybaseinfo`.`fb_uid`)));

-- ----------------------------
-- View structure for `35_viewoffirent`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewoffirent`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewoffirent` AS select `35_officebaseinfo`.`ob_officeid` AS `ob_officeid`,`35_officebaseinfo`.`ob_uid` AS `ob_uid`,`35_officebaseinfo`.`ob_province` AS `ob_province`,`35_officebaseinfo`.`ob_city` AS `ob_city`,`35_officebaseinfo`.`ob_buildingtype` AS `ob_buildingtype`,`35_officebaseinfo`.`ob_officename` AS `ob_officename`,`35_officebaseinfo`.`ob_officetype` AS `ob_officetype`,`35_officebaseinfo`.`ob_administrativearea` AS `ob_administrativearea`,`35_officebaseinfo`.`ob_district` AS `ob_district`,`35_officebaseinfo`.`ob_tradecircle` AS `ob_tradecircle`,`35_officebaseinfo`.`ob_busway` AS `ob_busway`,`35_officebaseinfo`.`ob_officeaddress` AS `ob_officeaddress`,`35_officebaseinfo`.`ob_propertycomname` AS `ob_propertycomname`,`35_officebaseinfo`.`ob_propertycost` AS `ob_propertycost`,`35_officebaseinfo`.`ob_foreign` AS `ob_foreign`,`35_officebaseinfo`.`ob_officearea` AS `ob_officearea`,`35_officebaseinfo`.`ob_floor` AS `ob_floor`,`35_officebaseinfo`.`ob_buildingage` AS `ob_buildingage`,`35_officebaseinfo`.`ob_cancut` AS `ob_cancut`,`35_officebaseinfo`.`ob_adrondegree` AS `ob_adrondegree`,`35_officebaseinfo`.`ob_officedegree` AS `ob_officedegree`,`35_officebaseinfo`.`ob_sellorrent` AS `ob_sellorrent`,`35_officebaseinfo`.`ob_releasedate` AS `ob_releasedate`,`35_officebaseinfo`.`ob_expireDate` AS `ob_expireDate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_officepresentinfo`.`op_id` AS `op_id`,`35_officepresentinfo`.`op_officetitle` AS `op_officetitle`,`35_officepresentinfo`.`op_serialnum` AS `op_serialnum`,`35_officepresentinfo`.`op_officedesc` AS `op_officedesc`,`35_officepresentinfo`.`op_traffice` AS `op_traffice`,`35_officepresentinfo`.`op_carparking` AS `op_carparking`,`35_officepresentinfo`.`op_facilityaround` AS `op_facilityaround`,`35_officepresentinfo`.`op_ichnographyurl` AS `op_ichnographyurl`,`35_officepresentinfo`.`op_outdoorpicurl` AS `op_outdoorpicurl`,`35_officepresentinfo`.`op_indoorpicurl` AS `op_indoorpicurl`,`35_officepresentinfo`.`op_titlepicurl` AS `op_titlepicurl`,`35_officepresentinfo`.`op_outdoorvideourl` AS `op_outdoorvideourl`,`35_officepresentinfo`.`op_indoorvideourl` AS `op_indoorvideourl`,`35_officepresentinfo`.`op_3durl` AS `op_3durl`,`35_officefacilityinfo`.`of_id` AS `of_id`,`35_officefacilityinfo`.`of_carparking` AS `of_carparking`,`35_officefacilityinfo`.`of_warming` AS `of_warming`,`35_officefacilityinfo`.`of_network` AS `of_network`,`35_officefacilityinfo`.`of_electricity` AS `of_electricity`,`35_officefacilityinfo`.`of_water` AS `of_water`,`35_officefacilityinfo`.`of_elevator` AS `of_elevator`,`35_officefacilityinfo`.`of_gas` AS `of_gas`,`35_officerentinfo`.`or_id` AS `or_id`,`35_officerentinfo`.`or_rentprice` AS `or_rentprice`,`35_officerentinfo`.`or_iscontainprocost` AS `or_iscontainprocost`,`35_officerentinfo`.`or_renttype` AS `or_renttype`,`35_officerentinfo`.`or_payway` AS `or_payway`,`35_officerentinfo`.`or_basetime` AS `or_basetime`,`35_officetag`.`ot_id` AS `ot_id`,`35_officetag`.`ot_ishigh` AS `ot_ishigh`,`35_officetag`.`ot_isrecommend` AS `ot_isrecommend`,`35_officetag`.`ot_ishomepage` AS `ot_ishomepage`,`35_officetag`.`ot_isvideo` AS `ot_isvideo`,`35_officetag`.`ot_is3d` AS `ot_is3d`,`35_officetag`.`ot_isconsign` AS `ot_isconsign`,`35_officetag`.`ot_consignid` AS `ot_consignid`,`35_officetag`.`ot_isnew` AS `ot_isnew`,`35_officetag`.`ot_ishurry` AS `ot_ishurry`,`35_officetag`.`ot_check` AS `ot_check` from (((((`35_officebaseinfo` join `35_officefacilityinfo` on((`35_officefacilityinfo`.`of_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_officepresentinfo` on((`35_officepresentinfo`.`op_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_officerentinfo` on((`35_officerentinfo`.`or_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_officetag` on((`35_officetag`.`ot_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_user` on((`35_user`.`user_id` = `35_officebaseinfo`.`ob_uid`)));

-- ----------------------------
-- View structure for `35_viewoffisell`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewoffisell`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewoffisell` AS select `35_officebaseinfo`.`ob_officeid` AS `ob_officeid`,`35_officebaseinfo`.`ob_uid` AS `ob_uid`,`35_officebaseinfo`.`ob_province` AS `ob_province`,`35_officebaseinfo`.`ob_city` AS `ob_city`,`35_officebaseinfo`.`ob_buildingtype` AS `ob_buildingtype`,`35_officebaseinfo`.`ob_officename` AS `ob_officename`,`35_officebaseinfo`.`ob_officetype` AS `ob_officetype`,`35_officebaseinfo`.`ob_administrativearea` AS `ob_administrativearea`,`35_officebaseinfo`.`ob_district` AS `ob_district`,`35_officebaseinfo`.`ob_tradecircle` AS `ob_tradecircle`,`35_officebaseinfo`.`ob_busway` AS `ob_busway`,`35_officebaseinfo`.`ob_officeaddress` AS `ob_officeaddress`,`35_officebaseinfo`.`ob_propertycomname` AS `ob_propertycomname`,`35_officebaseinfo`.`ob_propertycost` AS `ob_propertycost`,`35_officebaseinfo`.`ob_foreign` AS `ob_foreign`,`35_officebaseinfo`.`ob_officearea` AS `ob_officearea`,`35_officebaseinfo`.`ob_floor` AS `ob_floor`,`35_officebaseinfo`.`ob_buildingage` AS `ob_buildingage`,`35_officebaseinfo`.`ob_cancut` AS `ob_cancut`,`35_officebaseinfo`.`ob_adrondegree` AS `ob_adrondegree`,`35_officebaseinfo`.`ob_officedegree` AS `ob_officedegree`,`35_officebaseinfo`.`ob_sellorrent` AS `ob_sellorrent`,`35_officebaseinfo`.`ob_releasedate` AS `ob_releasedate`,`35_officebaseinfo`.`ob_expireDate` AS `ob_expireDate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_officefacilityinfo`.`of_id` AS `of_id`,`35_officefacilityinfo`.`of_carparking` AS `of_carparking`,`35_officefacilityinfo`.`of_warming` AS `of_warming`,`35_officefacilityinfo`.`of_network` AS `of_network`,`35_officefacilityinfo`.`of_electricity` AS `of_electricity`,`35_officefacilityinfo`.`of_water` AS `of_water`,`35_officefacilityinfo`.`of_elevator` AS `of_elevator`,`35_officefacilityinfo`.`of_gas` AS `of_gas`,`35_officepresentinfo`.`op_id` AS `op_id`,`35_officepresentinfo`.`op_officetitle` AS `op_officetitle`,`35_officepresentinfo`.`op_serialnum` AS `op_serialnum`,`35_officepresentinfo`.`op_officedesc` AS `op_officedesc`,`35_officepresentinfo`.`op_traffice` AS `op_traffice`,`35_officepresentinfo`.`op_carparking` AS `op_carparking`,`35_officepresentinfo`.`op_facilityaround` AS `op_facilityaround`,`35_officepresentinfo`.`op_ichnographyurl` AS `op_ichnographyurl`,`35_officepresentinfo`.`op_outdoorpicurl` AS `op_outdoorpicurl`,`35_officepresentinfo`.`op_indoorpicurl` AS `op_indoorpicurl`,`35_officepresentinfo`.`op_titlepicurl` AS `op_titlepicurl`,`35_officepresentinfo`.`op_outdoorvideourl` AS `op_outdoorvideourl`,`35_officepresentinfo`.`op_indoorvideourl` AS `op_indoorvideourl`,`35_officepresentinfo`.`op_3durl` AS `op_3durl`,`35_officesellinfo`.`os_id` AS `os_id`,`35_officesellinfo`.`os_sellprice` AS `os_sellprice`,`35_officetag`.`ot_id` AS `ot_id`,`35_officetag`.`ot_ishigh` AS `ot_ishigh`,`35_officetag`.`ot_isrecommend` AS `ot_isrecommend`,`35_officetag`.`ot_ishomepage` AS `ot_ishomepage`,`35_officetag`.`ot_isvideo` AS `ot_isvideo`,`35_officetag`.`ot_is3d` AS `ot_is3d`,`35_officetag`.`ot_isconsign` AS `ot_isconsign`,`35_officetag`.`ot_consignid` AS `ot_consignid`,`35_officetag`.`ot_isnew` AS `ot_isnew`,`35_officetag`.`ot_ishurry` AS `ot_ishurry`,`35_officetag`.`ot_check` AS `ot_check` from (((((`35_officebaseinfo` join `35_officefacilityinfo` on((`35_officefacilityinfo`.`of_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_officepresentinfo` on((`35_officepresentinfo`.`op_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_officesellinfo` on((`35_officesellinfo`.`os_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_officetag` on((`35_officetag`.`ot_officeid` = `35_officebaseinfo`.`ob_officeid`))) join `35_user` on((`35_user`.`user_id` = `35_officebaseinfo`.`ob_uid`)));

-- ----------------------------
-- View structure for `35_viewproject`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewproject`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewproject` AS select `35_projectbaseinfo`.`pb_projectid` AS `pb_projectid`,`35_projectbaseinfo`.`pb_uid` AS `pb_uid`,`35_projectbaseinfo`.`pb_province` AS `pb_province`,`35_projectbaseinfo`.`pb_city` AS `pb_city`,`35_projectbaseinfo`.`pb_projcetaddress` AS `pb_projcetaddress`,`35_projectbaseinfo`.`pb_transactionway` AS `pb_transactionway`,`35_projectbaseinfo`.`pb_price` AS `pb_price`,`35_projectbaseinfo`.`pb_releasedate` AS `pb_releasedate`,`35_projectbaseinfo`.`pb_expiredate` AS `pb_expiredate`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_projecttag`.`pt_id` AS `pt_id`,`35_projecttag`.`pt_ishigh` AS `pt_ishigh`,`35_projecttag`.`pt_isrecommend` AS `pt_isrecommend`,`35_projecttag`.`pt_ishomepage` AS `pt_ishomepage`,`35_projecttag`.`pt_isvideo` AS `pt_isvideo`,`35_projecttag`.`pt_is3d` AS `pt_is3d`,`35_projecttag`.`pt_isconsign` AS `pt_isconsign`,`35_projecttag`.`pt_consignid` AS `pt_consignid`,`35_projecttag`.`pt_isnew` AS `pt_isnew`,`35_projecttag`.`pt_ishurry` AS `pt_ishurry`,`35_projecttag`.`pt_check` AS `pt_check`,`35_projectpresentinfo`.`pp_id` AS `pp_id`,`35_projectpresentinfo`.`pp_projecttitle` AS `pp_projecttitle`,`35_projectpresentinfo`.`pp_serialnum` AS `pp_serialnum`,`35_projectpresentinfo`.`pp_projectdesc` AS `pp_projectdesc`,`35_projectpresentinfo`.`pp_traffice` AS `pp_traffice`,`35_projectpresentinfo`.`pp_carparking` AS `pp_carparking`,`35_projectpresentinfo`.`pp_facilityaround` AS `pp_facilityaround`,`35_projectpresentinfo`.`pp_ichnographyurl` AS `pp_ichnographyurl`,`35_projectpresentinfo`.`pp_outdoorpicurl` AS `pp_outdoorpicurl`,`35_projectpresentinfo`.`pp_indoorpicurl` AS `pp_indoorpicurl`,`35_projectpresentinfo`.`pp_titlepicurl` AS `pp_titlepicurl`,`35_projectpresentinfo`.`pp_outdoorvideourl` AS `pp_outdoorvideourl`,`35_projectpresentinfo`.`pp_indoorvideourl` AS `pp_indoorvideourl`,`35_projectpresentinfo`.`pp_3durl` AS `pp_3durl` from (((`35_projectbaseinfo` join `35_projectpresentinfo` on((`35_projectpresentinfo`.`pp_projectid` = `35_projectbaseinfo`.`pb_projectid`))) join `35_projecttag` on((`35_projecttag`.`pt_projectid` = `35_projectbaseinfo`.`pb_projectid`))) join `35_user` on((`35_user`.`user_id` = `35_projectbaseinfo`.`pb_uid`)));

-- ----------------------------
-- View structure for `35_viewshoprent`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewshoprent`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewshoprent` AS select `35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_shopbaseinfo`.`sb_shopid` AS `sb_shopid`,`35_shopbaseinfo`.`sb_uid` AS `sb_uid`,`35_shopbaseinfo`.`sb_province` AS `sb_province`,`35_shopbaseinfo`.`sb_city` AS `sb_city`,`35_shopbaseinfo`.`sb_shopname` AS `sb_shopname`,`35_shopbaseinfo`.`sb_shoptype` AS `sb_shoptype`,`35_shopbaseinfo`.`sb_selltype` AS `sb_selltype`,`35_shopbaseinfo`.`sb_businesstype` AS `sb_businesstype`,`35_shopbaseinfo`.`sb_buildingname` AS `sb_buildingname`,`35_shopbaseinfo`.`sb_administrativearea` AS `sb_administrativearea`,`35_shopbaseinfo`.`sb_district` AS `sb_district`,`35_shopbaseinfo`.`sb_tradecircle` AS `sb_tradecircle`,`35_shopbaseinfo`.`sb_busway` AS `sb_busway`,`35_shopbaseinfo`.`sb_shopaddress` AS `sb_shopaddress`,`35_shopbaseinfo`.`sb_proprtycomname` AS `sb_proprtycomname`,`35_shopbaseinfo`.`sb_propertycost` AS `sb_propertycost`,`35_shopbaseinfo`.`sb_shoparea` AS `sb_shoparea`,`35_shopbaseinfo`.`sb_shopusablearea` AS `sb_shopusablearea`,`35_shopbaseinfo`.`sb_floor` AS `sb_floor`,`35_shopbaseinfo`.`sb_buildingage` AS `sb_buildingage`,`35_shopbaseinfo`.`sb_cancut` AS `sb_cancut`,`35_shopbaseinfo`.`sb_adrondegree` AS `sb_adrondegree`,`35_shopbaseinfo`.`sb_sellorrent` AS `sb_sellorrent`,`35_shopbaseinfo`.`sb_releasedate` AS `sb_releasedate`,`35_shopbaseinfo`.`sb_expiredate` AS `sb_expiredate`,`35_shopfacilityinfo`.`sf_id` AS `sf_id`,`35_shopfacilityinfo`.`sf_carparking` AS `sf_carparking`,`35_shopfacilityinfo`.`sf_warming` AS `sf_warming`,`35_shopfacilityinfo`.`sf_network` AS `sf_network`,`35_shopfacilityinfo`.`sf_electricity` AS `sf_electricity`,`35_shopfacilityinfo`.`sf_water` AS `sf_water`,`35_shopfacilityinfo`.`sf_elevator` AS `sf_elevator`,`35_shopfacilityinfo`.`of_gas` AS `of_gas`,`35_shoppresentinfo`.`sp_id` AS `sp_id`,`35_shoppresentinfo`.`sp_shoptitle` AS `sp_shoptitle`,`35_shoppresentinfo`.`sp_serialnum` AS `sp_serialnum`,`35_shoppresentinfo`.`sp_shopdesc` AS `sp_shopdesc`,`35_shoppresentinfo`.`sp_traffice` AS `sp_traffice`,`35_shoppresentinfo`.`sp_carparking` AS `sp_carparking`,`35_shoppresentinfo`.`sp_facilityaround` AS `sp_facilityaround`,`35_shoppresentinfo`.`sp_ichnographurl` AS `sp_ichnographurl`,`35_shoppresentinfo`.`sp_outdoorpicurl` AS `sp_outdoorpicurl`,`35_shoppresentinfo`.`sp_indoorpciurl` AS `sp_indoorpciurl`,`35_shoppresentinfo`.`sp_titlepicurl` AS `sp_titlepicurl`,`35_shoppresentinfo`.`sp_outdoorvideourl` AS `sp_outdoorvideourl`,`35_shoppresentinfo`.`sp_indoorvideourl` AS `sp_indoorvideourl`,`35_shoppresentinfo`.`sp_3durl` AS `sp_3durl`,`35_shoptag`.`st_id` AS `st_id`,`35_shoptag`.`st_ishigh` AS `st_ishigh`,`35_shoptag`.`st_isrecommend` AS `st_isrecommend`,`35_shoptag`.`st_ishomepage` AS `st_ishomepage`,`35_shoptag`.`st_isvideo` AS `st_isvideo`,`35_shoptag`.`st_is3d` AS `st_is3d`,`35_shoptag`.`st_isconsign` AS `st_isconsign`,`35_shoptag`.`st_consignid` AS `st_consignid`,`35_shoptag`.`st_isnew` AS `st_isnew`,`35_shoptag`.`st_ishurry` AS `st_ishurry`,`35_shoptag`.`st_check` AS `st_check`,`35_shoprentinfo`.`sr_id` AS `sr_id`,`35_shoprentinfo`.`sr_rentprice` AS `sr_rentprice`,`35_shoprentinfo`.`sr_iscontainprocost` AS `sr_iscontainprocost`,`35_shoprentinfo`.`sr_renttype` AS `sr_renttype`,`35_shoprentinfo`.`sr_payway` AS `sr_payway`,`35_shoprentinfo`.`sr_basetime` AS `sr_basetime` from (((((`35_shopbaseinfo` join `35_shopfacilityinfo` on((`35_shopfacilityinfo`.`sf_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoppresentinfo` on((`35_shoppresentinfo`.`sp_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoprentinfo` on((`35_shoprentinfo`.`sr_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoptag` on((`35_shoptag`.`st_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_user` on((`35_user`.`user_id` = `35_shopbaseinfo`.`sb_uid`)));

-- ----------------------------
-- View structure for `35_viewshopsell`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewshopsell`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewshopsell` AS select `35_user`.`user_name` AS `user_name`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_value` AS `user_value`,`35_shopsellinfo`.`ss_id` AS `ss_id`,`35_shopsellinfo`.`ss_sellprice` AS `ss_sellprice`,`35_shoptag`.`st_id` AS `st_id`,`35_shoptag`.`st_ishigh` AS `st_ishigh`,`35_shoptag`.`st_isrecommend` AS `st_isrecommend`,`35_shoptag`.`st_ishomepage` AS `st_ishomepage`,`35_shoptag`.`st_isvideo` AS `st_isvideo`,`35_shoptag`.`st_is3d` AS `st_is3d`,`35_shoptag`.`st_isconsign` AS `st_isconsign`,`35_shoptag`.`st_consignid` AS `st_consignid`,`35_shoptag`.`st_isnew` AS `st_isnew`,`35_shoptag`.`st_ishurry` AS `st_ishurry`,`35_shoptag`.`st_check` AS `st_check`,`35_shoppresentinfo`.`sp_id` AS `sp_id`,`35_shoppresentinfo`.`sp_shoptitle` AS `sp_shoptitle`,`35_shoppresentinfo`.`sp_serialnum` AS `sp_serialnum`,`35_shoppresentinfo`.`sp_shopdesc` AS `sp_shopdesc`,`35_shoppresentinfo`.`sp_traffice` AS `sp_traffice`,`35_shoppresentinfo`.`sp_carparking` AS `sp_carparking`,`35_shoppresentinfo`.`sp_facilityaround` AS `sp_facilityaround`,`35_shoppresentinfo`.`sp_ichnographurl` AS `sp_ichnographurl`,`35_shoppresentinfo`.`sp_outdoorpicurl` AS `sp_outdoorpicurl`,`35_shoppresentinfo`.`sp_indoorpciurl` AS `sp_indoorpciurl`,`35_shoppresentinfo`.`sp_titlepicurl` AS `sp_titlepicurl`,`35_shoppresentinfo`.`sp_outdoorvideourl` AS `sp_outdoorvideourl`,`35_shoppresentinfo`.`sp_indoorvideourl` AS `sp_indoorvideourl`,`35_shoppresentinfo`.`sp_3durl` AS `sp_3durl`,`35_shopfacilityinfo`.`sf_id` AS `sf_id`,`35_shopfacilityinfo`.`sf_carparking` AS `sf_carparking`,`35_shopfacilityinfo`.`sf_warming` AS `sf_warming`,`35_shopfacilityinfo`.`sf_network` AS `sf_network`,`35_shopfacilityinfo`.`sf_electricity` AS `sf_electricity`,`35_shopfacilityinfo`.`sf_water` AS `sf_water`,`35_shopfacilityinfo`.`sf_elevator` AS `sf_elevator`,`35_shopfacilityinfo`.`of_gas` AS `of_gas`,`35_shopbaseinfo`.`sb_shopid` AS `sb_shopid`,`35_shopbaseinfo`.`sb_province` AS `sb_province`,`35_shopbaseinfo`.`sb_city` AS `sb_city`,`35_shopbaseinfo`.`sb_shopname` AS `sb_shopname`,`35_shopbaseinfo`.`sb_shoptype` AS `sb_shoptype`,`35_shopbaseinfo`.`sb_selltype` AS `sb_selltype`,`35_shopbaseinfo`.`sb_businesstype` AS `sb_businesstype`,`35_shopbaseinfo`.`sb_buildingname` AS `sb_buildingname`,`35_shopbaseinfo`.`sb_administrativearea` AS `sb_administrativearea`,`35_shopbaseinfo`.`sb_district` AS `sb_district`,`35_shopbaseinfo`.`sb_tradecircle` AS `sb_tradecircle`,`35_shopbaseinfo`.`sb_busway` AS `sb_busway`,`35_shopbaseinfo`.`sb_shopaddress` AS `sb_shopaddress`,`35_shopbaseinfo`.`sb_proprtycomname` AS `sb_proprtycomname`,`35_shopbaseinfo`.`sb_propertycost` AS `sb_propertycost`,`35_shopbaseinfo`.`sb_shoparea` AS `sb_shoparea`,`35_shopbaseinfo`.`sb_shopusablearea` AS `sb_shopusablearea`,`35_shopbaseinfo`.`sb_floor` AS `sb_floor`,`35_shopbaseinfo`.`sb_buildingage` AS `sb_buildingage`,`35_shopbaseinfo`.`sb_cancut` AS `sb_cancut`,`35_shopbaseinfo`.`sb_adrondegree` AS `sb_adrondegree`,`35_shopbaseinfo`.`sb_sellorrent` AS `sb_sellorrent`,`35_shopbaseinfo`.`sb_releasedate` AS `sb_releasedate`,`35_shopbaseinfo`.`sb_expiredate` AS `sb_expiredate`,`35_shopbaseinfo`.`sb_uid` AS `sb_uid` from (((((`35_shopbaseinfo` join `35_shopfacilityinfo` on((`35_shopfacilityinfo`.`sf_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoppresentinfo` on((`35_shoppresentinfo`.`sp_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shopsellinfo` on((`35_shopsellinfo`.`ss_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_shoptag` on((`35_shoptag`.`st_shopid` = `35_shopbaseinfo`.`sb_shopid`))) join `35_user` on((`35_user`.`user_id` = `35_shopbaseinfo`.`sb_uid`)));

-- ----------------------------
-- View structure for `35_viewuagent`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewuagent`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewuagent` AS select `35_uagent`.`ua_id` AS `ua_id`,`35_uagent`.`ua_city` AS `ua_city`,`35_uagent`.`ua_district` AS `ua_district`,`35_uagent`.`ua_section` AS `ua_section`,`35_uagent`.`ua_realname` AS `ua_realname`,`35_uagent`.`ua_tel` AS `ua_tel`,`35_uagent`.`ua_msn` AS `ua_msn`,`35_uagent`.`ua_comid` AS `ua_comid`,`35_uagent`.`ua_photourl` AS `ua_photourl`,`35_uagent`.`ua_scardurl` AS `ua_scardurl`,`35_uagent`.`ua_bcardurl` AS `ua_bcardurl`,`35_uagent`.`ua_scardid` AS `ua_scardid`,`35_uagent`.`uacheck` AS `uacheck`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_pwd` AS `user_pwd`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_regtime` AS `user_regtime`,`35_user`.`user_logintime` AS `user_logintime`,`35_user`.`user_lasttime` AS `user_lasttime`,`35_user`.`user_lastip` AS `user_lastip`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_id` AS `user_id`,`35_user`.`user_salt` AS `user_salt` from (`35_user` join `35_uagent` on((`35_uagent`.`ua_uid` = `35_user`.`user_id`)));

-- ----------------------------
-- View structure for `35_viewucom`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewucom`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewucom` AS select `35_user`.`user_name` AS `user_name`,`35_user`.`user_pwd` AS `user_pwd`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_regtime` AS `user_regtime`,`35_user`.`user_logintime` AS `user_logintime`,`35_user`.`user_lasttime` AS `user_lasttime`,`35_user`.`user_lastip` AS `user_lastip`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_ucom`.`uc_id` AS `uc_id`,`35_ucom`.`uc_city` AS `uc_city`,`35_ucom`.`uc_province` AS `uc_province`,`35_ucom`.`uc_district` AS `uc_district`,`35_ucom`.`uc_section` AS `uc_section`,`35_ucom`.`uc_address` AS `uc_address`,`35_ucom`.`uc_fullname` AS `uc_fullname`,`35_ucom`.`uc_shortname` AS `uc_shortname`,`35_ucom`.`uc_belongcom` AS `uc_belongcom`,`35_ucom`.`uc_officetel` AS `uc_officetel`,`35_ucom`.`uc_contact` AS `uc_contact`,`35_ucom`.`uc_tel` AS `uc_tel`,`35_ucom`.`uc_msn` AS `uc_msn`,`35_ucom`.`uc_email` AS `uc_email`,`35_ucom`.`uc_recogniseurl` AS `uc_recogniseurl`,`35_ucom`.`uc_check` AS `uc_check`,`35_user`.`user_id` AS `user_id`,`35_user`.`user_salt` AS `user_salt` from (`35_ucom` join `35_user` on((`35_ucom`.`uc_uid` = `35_user`.`user_id`)));

-- ----------------------------
-- View structure for `35_viewunormal`
-- ----------------------------
DROP VIEW IF EXISTS `35_viewunormal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `35_viewunormal` AS select `35_unormal`.`puser_id` AS `puser_id`,`35_unormal`.`puser_tel` AS `puser_tel`,`35_unormal`.`puser_email` AS `puser_email`,`35_unormal`.`puser_logopath` AS `puser_logopath`,`35_unormal`.`puser_vip` AS `puser_vip`,`35_user`.`user_name` AS `user_name`,`35_user`.`user_pwd` AS `user_pwd`,`35_user`.`user_role` AS `user_role`,`35_user`.`user_regtime` AS `user_regtime`,`35_user`.`user_logintime` AS `user_logintime`,`35_user`.`user_lasttime` AS `user_lasttime`,`35_user`.`user_lastip` AS `user_lastip`,`35_user`.`user_value` AS `user_value`,`35_user`.`user_point` AS `user_point`,`35_user`.`user_id` AS `user_id`,`35_user`.`user_salt` AS `user_salt` from (`35_user` join `35_unormal` on((`35_unormal`.`puser_uid` = `35_user`.`user_id`)));
