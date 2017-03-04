<?php

class SearchController extends CController
{
    private $_db;
    public function getDb(){
        if($this->_db === null)
            $this->_db = Yii::app()->db;
        return $this->_db;
    }
    public function actionIndex(){
        echo 'test';
        foreach($_GET as $k => $v)
            echo $k,'=>',$v,' ';
    }
    /**
     * 区域 [GET] city
     */
    public function actionRegion(){
        if(empty($_GET['city']))
            $city = 0;
        else
            $city = (int)$_GET['city'];
        $data = array();
        foreach($this->getDb()->createCommand('SELECT `re_id`,`re_name` FROM `{{region}}` WHERE `re_parent_id` ='.$city.' ORDER BY `re_order` ASC')->queryAll()
                as $v){
                $data[$v['re_id']] = $v['re_name'];
        }
        $this->returnData($data);
    }
    /**
     * 单一楼盘
     */
    public function actionBuildingone(){
        $sub = !empty($_GET['sub'])?$_GET['sub']:'office';
        $id = !empty($_GET['id'])?(int)$_GET['id']:0;
        $data = array();
        if($sub=='creative_park'){
            $sql = 'SELECT * FROM `{{creativeparkbaseinfo}}` WHERE `cp_id`='.$id;
            $pic_sql = 'SELECT `p_img`,`p_type`,`p_title` FROM {{picture}} WHERE p_sourcetype=9 AND p_sourceid = '.$id;
            $data['cp_propertyserver'] = Creativeparkbaseinfo::$cp_propertyserver;
            $data['cp_roommating'] = Creativeparkbaseinfo::$cp_roommating;
        }elseif($sub=='office'){
            $sql = 'SELECT * FROM `{{systembuildinginfo}} ` WHERE `sbi_buildingid`='.$id;
            $pic_sql = 'SELECT `p_img`,`p_type`,`p_title` FROM {{picture}} WHERE p_sourcetype=2 AND p_sourceid = '.$id;
        }else{//business_center
            $sql = 'SELECT t1.*,t2.sbi_buildingname,t2.sbi_x,t2.sbi_y
                FROM `{{businesscenter}}` t1 LEFT JOIN `{{systembuildinginfo}}` t2 ON t1.bc_sysid=t2.sbi_buildingid
                WHERE t1.`bc_id`='.$id;
            $pic_sql = 'SELECT `p_img`,`p_type`,`p_title` FROM {{picture}} WHERE p_sourcetype=3 AND p_sourceid = '.$id;
            $data['serverconfig'] = Yii::app()->db->createCommand('select * from {{businessserverconfig}}')->queryAll();
        }
        $data['data'] = $this->getDb()->createCommand($sql)->queryRow();
        if(!empty($data['data'])){
            $data['count'] = 1;
            //$data['sql'] = $data['data'] = $this->getDb()->createCommand($sql)->text;
            $data['picture'] = $this->getDb()->createCommand($pic_sql)->queryAll();
        }else
            $data['count'] = 0;
        $this->returnData($data);
    }

    /**
     * 商务中心搜索接口 [GET]
     */
    public function actionBusiness_center(){
        $where = array();
        if(!empty($_GET['q']))
            $where[] = 't1.`bc_name` LIKE \'%'.$_GET['q'].'%\'';
        if(!empty($_GET['district']))
            $where[] = 't1.`bc_district` = '.$_GET['district'];
        if(!empty($_GET['pricea']))
            $where[] = 't1.`bc_rentprice` > '.$_GET['pricea'];
        if(!empty($_GET['priceb']))
            $where[] = 't1.`bc_rentprice` < '.$_GET['priceb'];
        $page = 1;
        if(!empty($_GET['page']))
            $page = (int)$_GET['page'];
        if($page < 1) $page = 1;
        $pageSize = 10;

        $limit = ' LIMIT '.(($page-1)*$pageSize).','.$pageSize;
        if($where){
            $sqlwhere = ' WHERE '.implode(' AND ', $where);
        }else
            $sqlwhere = '';
        $sql = 'SELECT t1.`bc_id` id,t1.`bc_name` name,t1.`bc_district` d,t1.`bc_address` address,t1.`bc_rentprice` price,
            t1.`bc_serverbrand` ptname,t1.`bc_completetime` open,t2.`p_img`
            FROM `{{businesscenter}}` AS t1
            LEFT JOIN `{{picture}}` AS t2 ON t1.`bc_titlepic` = t2.p_id'.$sqlwhere.$limit;
        $data = array();
        $data['total'] = $this->getDb()->createCommand('SELECT COUNT(*) FROM {{businesscenter}} AS t1'.$sqlwhere)->queryScalar();
        $data['data']  = $this->getDb()->createCommand($sql)->queryAll();
        if($data['total'])
            $data['maxPage'] = ceil($data['total']/$pageSize);
        else
            $data['maxPage'] = 0;
        $this->returnData($data);
    }
    /**
     * 创意园区搜索接口 [GET]
     */
    public function actionCreative_park(){
        $where = array();
        if(!empty($_GET['q']))
            $where[] = 't1.`cp_name` LIKE \'%'.$_GET['q'].'%\'';
        if(!empty($_GET['district']))
            $where[] = 't1.`cp_district` = '.$_GET['district'];
        if(!empty($_GET['pricea']))
            $where[] = 't1.`cp_avgrentprice` > '.$_GET['pricea'];
        if(!empty($_GET['priceb']))
            $where[] = 't1.`cp_avgrentprice` < '.$_GET['priceb'];
        $page = 1;
        if(!empty($_GET['page']))
            $page = (int)$_GET['page'];
        if($page < 1) $page = 1;
        $pageSize = 10;

        $limit = ' LIMIT '.(($page-1)*$pageSize).','.$pageSize;
        if($where){
            $sqlwhere = ' WHERE '.implode(' AND ', $where);
        }else
            $sqlwhere = '';
        $sql = 'SELECT t1.`cp_id` id,t1.`cp_name` name,t1.`cp_district` d,t1.`cp_address` address,t1.`cp_avgrentprice` price,
            t1.`cp_propertyprice` ptprice,t1.`cp_propertyname` ptname,t1.`cp_openingtime` open,t1.`cp_defanglv` lv,t2.`p_img`
            FROM `{{creativeparkbaseinfo}}` AS t1
            LEFT JOIN `{{picture}}` AS t2 ON t1.`cp_titlepic` = t2.p_id'.$sqlwhere.$limit;
        $data = array();
        $data['total'] = $this->getDb()->createCommand('SELECT COUNT(*) FROM {{creativeparkbaseinfo}} AS t1'.$sqlwhere)->queryScalar();
        $data['data']  = $this->getDb()->createCommand($sql)->queryAll();
        if($data['total'])
            $data['maxPage'] = ceil($data['total']/$pageSize);
        else
            $data['maxPage'] = 0;
        $this->returnData($data);
    }
    /**
     * 写字楼搜索接口 [GET]
     */
    public function actionOffice(){
        $where = array();
        if(!empty($_GET['q']))
            $where[] = 't1.`sbi_buildingname` LIKE \'%'.$_GET['q'].'%\'';
        if(!empty($_GET['district']))
            $where[] = 't1.`sbi_district` = '.$_GET['district'];
        if(!empty($_GET['pricea']))
            $where[] = 't1.`sbi_avgrentprice` > '.$_GET['pricea'];
        if(!empty($_GET['priceb']))
            $where[] = 't1.`sbi_avgrentprice` < '.$_GET['priceb'];
        if(!empty($_GET['salea']))
            $where[] = 't1.`sbi_avgsellprice` > '.$_GET['salea'];
        if(!empty($_GET['saleb']))
            $where[] = 't1.`sbi_avgsellprice` < '.$_GET['saleb'];
        $page = 1;
        if(!empty($_GET['page']))
            $page = (int)$_GET['page'];
        if($page < 1) $page = 1;
        $pageSize = 10;

        $limit = ' LIMIT '.(($page-1)*$pageSize).','.$pageSize;
        if($where){
            $sqlwhere = ' WHERE '.implode(' AND ', $where);
        }else
            $sqlwhere = '';
        $sql = 'SELECT t1.`sbi_buildingid` id,t1.`sbi_buildingname` name,t1.`sbi_district` d,t1.`sbi_address` address,
            t1.`sbi_openingtime` open,t1.`sbi_propertyname` ptname,t1.`sbi_propertyprice` ptprice,t1.`sbi_avgrentprice` price,
            t1.`sbi_avgsellprice` sale,t1.`sbi_defanglv` lv,t2.`p_img`
            FROM `{{systembuildinginfo}}` AS t1
            LEFT JOIN `{{picture}}` AS t2 ON t1.`sbi_titlepic` = t2.p_id'.$sqlwhere.$limit;
        $data = array();
        $data['total'] = $this->getDb()->createCommand('SELECT COUNT(*) FROM {{systembuildinginfo}} AS t1'.$sqlwhere)->queryScalar();
        $data['data']  = $this->getDb()->createCommand($sql)->queryAll();
        if($data['total'])
            $data['maxPage'] = ceil($data['total']/$pageSize);
        else
            $data['maxPage'] = 0;
        $this->returnData($data);
    }
    public function actionPanorama(){
        $id = !empty($_GET['id'])?(int)$_GET['id']:'';
        $type = '';
        if(!empty($_GET['type']) && in_array($_GET['type'],array('1','7')))
                $type = $_GET['type'];

        if(!$id || !$type || !Panoxml::model()->checkHavePano($id, $type)){
            echo 'document.write(\'<img alt="" src="http://www.360dibiao.com/images/default/default_loupan.jpg">\');';
            return;
        }
        $size = array(500,400);
        if(!empty($_GET['size']) && stripos($_GET['size'],'x')!==FALSE){
            $temp = explode('x', $_GET['size']);
            $temp[0] = abs((int)$temp[0]);
            $temp[1] = abs((int)$temp[1]);
            if($temp[0] && $temp[1]){
                $size[0] = $temp[0];
                $size[1] = $temp[1];
            }
        }
        $xml = Panoxml::model()->getPanoXml($id, $type);
        $param = "mainXml=".$xml;
        echo 'document.write(\'<embed width="'.$size[0].'" height="'.$size[1].'" allowfullscreen="true" src="'.PIC_URL.'/pano/panoPlayer_1.4.swf?'.$param.'" type="application/x-shockwave-flash" />\');';
    }
    public function returnData($data,$type='json'){
        if(empty($data)) exit();
        echo json_encode($data);
    }
}

?>
