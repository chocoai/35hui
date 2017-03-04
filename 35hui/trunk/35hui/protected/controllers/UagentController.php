<?php

class UagentController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';
    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    public function actionOfficeRent() {
        $this->layout = "office";
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = self::getOfficeSearchDataProvider($get, 1); //默认条件:上海城市的租房信息
        $onlineUser = User::model()->getAllOnLineUserId();
        $seotkd = Seotkd::model()->findByPk(9);
        $this->render('searchIndex', array(
            'dataProvider' => $dataProvider,
            'options' => $get, //生成的数组。在前台生成连接时使用
            'seotkd' => $seotkd, //SEO优化
            'saleOrRent' => 1,
            'onlineUser' => $onlineUser,
            'url' => "uagent/officerent", //url
        ));
    }

    public function actionOfficeSale() {
        $this->layout = "office";
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = self::getOfficeSearchDataProvider($get, 2); //默认条件:上海城市的租房信息
        $onlineUser = User::model()->getAllOnLineUserId();
        $seotkd = Seotkd::model()->findByPk(10);
        $this->render('searchIndex', array(
            'dataProvider' => $dataProvider,
            'options' => $get, //生成的数组。在前台生成连接时使用
            'seotkd' => $seotkd, //SEO优化
            'saleOrRent' => 2,
            'onlineUser' => $onlineUser,
            'url' => "uagent/officesale", //url
        ));
    }

    public function actionAjaxgetofficesource() {
        $start = $_GET["start"];
        $saleOrRent = $_GET["saleOrRent"];
        ;
        $userId = $_GET["userId"];
        $condition = $_GET["condition"];

        $all = Officebaseinfo::model()->getSaleOrRentSourceByUagnet($userId, $saleOrRent, $condition);
        $all = Officebaseinfo::model()->getTmpSourceByUagent($all, $start, 5, $saleOrRent);
        echo json_encode($all);
        exit;
    }

    private function getOfficeSearchDataProvider($get, $rentOrSale) {
        $regionParamToColumn = array(
            'district' => 'sbi_district',
            'section' => 'sbi_section',
        );
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array("ob_check" => 4, "ob_sellorrent" => $rentOrSale));
        $criteria->addCondition("ua_id is not null");
        $criteria->select = "count(ob_uid) as num,ob_uid";
        if (isset($get['keyword']) && $get['keyword'] != "") {
            $keyword = $get['keyword'];
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['agentIndex'], "array");
            $criteria->addInCondition('ob_uid', $idArr);
        }

        $regionParams = SearchMenu::getRegionParams(); //得到地区搜索条件参数名称集合
        foreach ($regionParams as $regionParam) {
            if (isset($get[$regionParam]) && $get[$regionParam] != "") {
                if (array_key_exists($regionParam, $regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam] => $get[$regionParam]));
                }
            }
        }
        $criteria = Officebaseinfo::model()->getTempleteSearchCriteria($criteria, $rentOrSale, $get);
        //排序
        $criteria->order = "ua_combo desc, user_lasttime desc";
        if (isset($get["order"])) {
            $get["order"] == "sa" ? $criteria->order = "ua_source" : ""; //按经纪人综合分由低到高
            $get["order"] == "sd" ? $criteria->order = "ua_source desc" : ""; //按经纪人综合分由高到低
            $get["order"] == "ya" ? $criteria->order = "ua_congyeyear" : ""; //按从业年限由低到高
            $get["order"] == "yd" ? $criteria->order = "ua_congyeyear desc" : ""; //按从业年限由高到低
        }
        $criteria->group = "ob_uid";
        $criteria->join = "left join 35_uagent on {{uagent}}.`ua_uid`=`ob_uid`";
        $criteria->join .= "left join 35_user on {{user}}.`user_id`=`ob_uid`";
        $criteria->with["buildingInfo"] = array("select" => "sbi_buildingid"); //要搜索。所有必须有
//        echo "<pre>";print_r($criteria);exit;
        $dataProvider = new CActiveDataProvider('Officebaseinfo', array(
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                    'criteria' => $criteria,
                    'totalItemCount' => count(Officebaseinfo::model()->findAll($criteria)),
                ));
        return $dataProvider;
    }

    public function actionCreativesource() {
        $this->layout = "office";
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = self::getCreativeSearchDataProvider($get); //默认条件:上海城市的租房信息
        $onlineUser = User::model()->getAllOnLineUserId();
        $seotkd = Seotkd::model()->findByPk(13);
        $this->render('creativesourceIndex', array(
            'dataProvider' => $dataProvider,
            'options' => $get, //生成的数组。在前台生成连接时使用
            'seotkd' => $seotkd, //SEO优化
            'onlineUser' => $onlineUser,
            'url' => "uagent/creativesource", //url
        ));
    }

    public function actionShopTransfer() {
        $this->layout = "shop";
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = self::getShopSearchDataProvider($get,3); //默认条件:上海城市的租房信息

        $onlineUser = User::model()->getAllOnLineUserId();
        $seotkd = Seotkd::model()->findByPk(19);
        $this->render('shopIndex', array(
            'dataProvider' => $dataProvider,
            'options' => $get, //生成的数组。在前台生成连接时使用
            'seotkd' => $seotkd, //SEO优化
            'onlineUser' => $onlineUser,
            'url' => "uagent/shoptransfer", //url
            "type"=>"3",
        ));
    }
     public function actionShopRent() {
        $this->layout = "shop";
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = self::getShopSearchDataProvider($get,1); //默认条件:上海城市的租房信息

        $onlineUser = User::model()->getAllOnLineUserId();
        $seotkd = Seotkd::model()->findByPk(17);
        $this->render('shopIndex', array(
            'dataProvider' => $dataProvider,
            'options' => $get, //生成的数组。在前台生成连接时使用
            'seotkd' => $seotkd, //SEO优化
            'onlineUser' => $onlineUser,
            'url' => "uagent/shoprent", //url
            "type"=>"1",
        ));
    }
     public function actionShopSale() {
        $this->layout = "shop";
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = self::getShopSearchDataProvider($get,2); //默认条件:上海城市的租房信息

        $onlineUser = User::model()->getAllOnLineUserId();
        $seotkd = Seotkd::model()->findByPk(18);
        $this->render('shopIndex', array(
            'dataProvider' => $dataProvider,
            'options' => $get, //生成的数组。在前台生成连接时使用
            'seotkd' => $seotkd, //SEO优化
            'onlineUser' => $onlineUser,
            'url' => "uagent/shopsale", //url
            "type"=>"2",
        ));
    }

    private function getShopSearchDataProvider($get,$type) {
        $regionParamToColumn = array(
            'district' => 'sb_district',
        );
        
        if($type==3){
            $rentOrsell=1;
        }else{
            $rentOrsell=$type;
        }
        $criteria = new CDbCriteria();

        $criteria->addColumnCondition(array("sb_check" => 4, "sb_sellorrent " => $rentOrsell));
        $criteria->addCondition("sb_shopid!=''");
        $criteria->select = "count(sb_uid) as num,sb_uid";
        if($type==3||$type==1){
            if($type==3){
                $renttype=2;
            }else{
                $renttype=1;
            }
            $criteria->with = array(
                'rentInfo' => array(
                    "condition"=>"sr_renttype ={$renttype}",
                )
            );
        }else{
            $criteria->with = array(
                'sellInfo' => array(
                )
            );
        }
        $regionParams = SearchMenu::getRegionParams(); //得到地区搜索条件参数名称集合

        foreach ($regionParams as $regionParam) {
            if (isset($get[$regionParam]) && $get[$regionParam] != "") {
                if (array_key_exists($regionParam, $regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam] => $get[$regionParam]));
                }
            }
        }
        $criteria = Shopbaseinfo::model()->getTempleteSearchCriteria($criteria, $get);
        $criteria->group = "sb_uid";
        // $criteria->with["parkbaseinfo"] = array("select" => "cp_id");
        $criteria->join = "left join 35_uagent on {{uagent}}.`ua_uid`=`sb_uid`";
        $criteria->join .= "left join 35_user on {{user}}.`user_id`=`sb_uid`";
        //排序
        $criteria->order = "ua_combo desc, user_lasttime desc";
        if (isset($get["order"])) {
            $get["order"] == "sa" ? $criteria->order = "ua_source" : ""; //按经纪人综合分由低到高
            $get["order"] == "sd" ? $criteria->order = "ua_source desc" : ""; //按经纪人综合分由高到低
            $get["order"] == "ya" ? $criteria->order = "ua_congyeyear" : ""; //按从业年限由低到高
            $get["order"] == "yd" ? $criteria->order = "ua_congyeyear desc" : ""; //按从业年限由高到低
        }
        if (isset($get['keyword']) && $get['keyword'] != "") {
            $keyword = urldecode($get['keyword']);
            $criteria->addColumnCondition(array("ua_realname" => $keyword,));
        }
        
        $dataProvider = new CActiveDataProvider('Shopbaseinfo', array(
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                    'criteria' => $criteria,
                    'totalItemCount' => count(Shopbaseinfo::model()->findAll($criteria)), //因为有group。CActiveDataProvider统计总条数有问题
                ));
        return $dataProvider;
    }
    public function actionAjaxgetshop() {
        $start = $_GET["start"];
        $userId = $_GET["userId"];
        $condition = $_GET["condition"];
        $type = $_GET["type"];
        $all = Shopbaseinfo::model()->getSourceByUagnet($userId, $condition,$type);
        $all = Shopbaseinfo::model()->getTmpSourceByUagent($all, $start, 5);
        echo json_encode($all);
        exit;
    }
    private function getCreativeSearchDataProvider($get) {
        $regionParamToColumn = array(
            'district' => 'cp_district',
        );
        $criteria = new CDbCriteria();

        $criteria->addColumnCondition(array("cr_check" => 4));
        $criteria->addCondition("cr_cpid!=''");
        $criteria->select = "count(cr_userid) as num,cr_userid";
        if (isset($get['keyword']) && $get['keyword'] != "") {
            $keyword = $get['keyword'];
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['agentIndex'], "array");
            $criteria->addInCondition('cr_userid', $idArr);
        }

        $regionParams = SearchMenu::getRegionParams(); //得到地区搜索条件参数名称集合
        foreach ($regionParams as $regionParam) {
            if (isset($get[$regionParam]) && $get[$regionParam] != "") {
                if (array_key_exists($regionParam, $regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam] => $get[$regionParam]));
                }
            }
        }
        $criteria = Creativesource::model()->getTempleteSearchCriteria($criteria, $get);
        $criteria->group = "cr_userid";
        $criteria->with["parkbaseinfo"] = array("select" => "cp_id");
        $criteria->join = "left join 35_uagent on {{uagent}}.`ua_uid`=`cr_userid`";
        $criteria->join .= "left join 35_user on {{user}}.`user_id`=`cr_userid`";
        //排序
        $criteria->order = "ua_combo desc, user_lasttime desc";
        if (isset($get["order"])) {
            $get["order"] == "sa" ? $criteria->order = "ua_source" : ""; //按经纪人综合分由低到高
            $get["order"] == "sd" ? $criteria->order = "ua_source desc" : ""; //按经纪人综合分由高到低
            $get["order"] == "ya" ? $criteria->order = "ua_congyeyear" : ""; //按从业年限由低到高
            $get["order"] == "yd" ? $criteria->order = "ua_congyeyear desc" : ""; //按从业年限由高到低
        }
//        echo "<pre>";print_r($criteria);exit;
        $dataProvider = new CActiveDataProvider('Creativesource', array(
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                    'criteria' => $criteria,
                    'totalItemCount' => count(Creativesource::model()->findAll($criteria)), //因为有group。CActiveDataProvider统计总条数有问题
                ));
        return $dataProvider;
    }

    public function actionAjaxgetcreativesource() {
        $start = $_GET["start"];
        $userId = $_GET["userId"];
        $condition = $_GET["condition"];
        $all = Creativesource::model()->getSourceByUagnet($userId, $condition);
        $all = Creativesource::model()->getTmpSourceByUagent($all, $start, 5);
        echo json_encode($all);
        exit;
    }

    /**
     * 经纪人列表信息
     * @param <type> $district 行政区
     * @param <type> $section 版块
     * @param <type> $keyword 关键字
     * @return CActiveDataProvider
     */
    public function showAll($district, $section, $keyword) {
        $pageSize = Yii::app()->params['postsPerPage']; //每页数量
        $criteria = new CDbCriteria(array(
                    'condition' => 'user_role=:user_role',
                    'params' => array(":user_role" => User::agent),
                    'order' => 'user_lasttime DESC',
                    'with' => array("agentinfo"),
                ));
        if ($district) {
            $criteria->addColumnCondition(array('ua_district' => $district));
        }
        if ($section) {
            $criteria->addColumnCondition(array('ua_section' => $section));
        }
        if ($keyword) {
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['agentIndex'], "array");
            $criteria->addInCondition('ua_id', $idArr);
        }
        $dataProvider = new CActiveDataProvider('User', array(
                    'pagination' => array(
                        'pageSize' => $pageSize,
                    ),
                    'criteria' => $criteria,
                        )
        );
        return $dataProvider;
    }

    //得到当前登录者的积分
    public function getCurrentUserInfo() {
        $userId = Yii::app()->user->id;
        $userPoint = User::model()->with('property')->findByPk($userId);
        return $userPoint;
    }

    //经纪人搜索首页(默认搜索全部)
    public function actionShowUagent() {
        header("Location:" . DOMAIN);
        $sortAgentInfo = $this->getAgentSortByPoint(); //侧边积分排行
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = $this->showAll(@$get['district'], @$get['section'], @$get['keyword']);
        //推荐中介公司。
        $recommendcompany = Buyproduct::model()->getProductByPageAndPosition(8, 12);
        $newAgentList = $this->newUagentList(); //最新加入经纪人列表
        $seotkd = Seotkd::model()->findByPk(9); //SEO优化
        $this->render('showuagent', array(
            'sortAgentInfo' => $sortAgentInfo,
            'newAgentList' => $newAgentList, //最新加入经纪人列表
            'section' => @$get['section'],
            'dataProvider' => $dataProvider,
            'recommendcompany' => $recommendcompany, //推荐中介公司。
            'seotkd' => $seotkd, //SEO优化
        ));
    }

    //根据区域id查地段
    public static function ShowSectiont($id) {
        $criteria = new CDbCriteria;
        $criteria->condition = "re_parent_id=" . $id;
        $district = Region::model()->findAll($criteria);
        return $district;
    }

    //查询省份下的行政区
    public function showDistrict() {
        $criteria = new CDbCriteria;
        $criteria->condition = "re_parent_id=9";
        $dislist = Region::model()->findAll($criteria);
        return $dislist;
    }

    //经纪人总积分排行
    public function getAgentSortByPoint() {
        $dba = dba();
        $agentInfo = $dba->select("SELECT *
                        FROM 35_uagent agent
                          INNER JOIN 35_userproperty property
                            ON agent.`ua_uid` = property.`m_userid`
                        ORDER BY `m_point` desc limit 0,10");
        return $agentInfo;
    }

    //最新加入
    public function NewAdd() {
        $criteria = new CDbCriteria(array(
                    'order' => "user_regtime desc",
                ));
        $detail = Uagent::model()->with('userInfo', 'region')->find($criteria);
        return $detail;
    }

    //最新加入列表
    public function newUagentList() {
        $criteria = new CDbCriteria(array(
                    'order' => "user_regtime desc",
                    'limit' => 10,
                ));
        $newlist = Uagent::model()->with('userInfo', 'region')->findAll($criteria);
        return $newlist;
    }

    public function actionIndex() {
        $this->layout = "office";
        $model = $this->loadModel();
        $model->ua_visitnum++;
        $model->update();
        
        $_userModel = User::model()->findByPk($model->ua_uid);
        //勋章
        $Medals = Medal::model()->findAll('md_uid=' . $_userModel->user_id);
        $missionName = array(
            '1' => '一路有你', //登陆
            '4' => '呼风唤雨', //邀请
            '9' => '房源控', //连续发房源
        );
        $medalstr = '';
        if ($Medals) {
            foreach ($Medals as $medal) {
                $title = isset($missionName[$medal->md_type]) ? $missionName[$medal->md_type] : '';
                if ($medal->md_rank)
                    $medalstr .= CHtml::image("/images/medal/" . $medal->md_type . "/" . $medal->md_rank . '.gif', $title, array('title' => $title));
            }
        }
        //房源分布
        /*         * ****   按照区域
          $sql = 'SELECT COUNT(*) as c,t2.`sbi_titlepic`,t2.`sbi_district`,t3.`re_name`
          FROM `{{officebaseinfo}}` t1 LEFT JOIN `{{systembuildinginfo}}` t2 ON t1.`ob_sysid`=t2.`sbi_buildingid`
          LEFT JOIN `{{region}}` t3 ON t2.`sbi_district`=t3.`re_id`
          WHERE t1.`ob_check`=4 AND t1.`ob_uid`='.$_userModel->user_id.' AND t2.`sbi_buildingid` IS NOT NULL
          GROUP BY t2.`sbi_district` ORDER BY `c` DESC';
         *
         */
        $sql = 'SELECT COUNT(*) as c,t2.`sbi_buildingname`
            FROM `{{officebaseinfo}}` t1 LEFT JOIN `{{systembuildinginfo}}` t2 ON t1.`ob_sysid`=t2.`sbi_buildingid`
            WHERE t1.`ob_check`=4 AND t1.`ob_uid`=' . $_userModel->user_id . '
            GROUP BY t2.`sbi_buildingid` ORDER BY `c` DESC';
        $loups = Yii::app()->db->createCommand($sql)->queryAll();
//        $criteria=new CDbCriteria;
//        $criteria->condition="ob_check=4 and ob_uid =".$_userModel->user_id;
//        $criteria->join="left join 35_systembuildinginfo on sbi_buildingid=ob_sysid";
//        $loups=  Officebaseinfo::model()->findAll($criteria);
        $pieDate = array();
        $orther = $allNumes = 0;
        foreach ($loups as $k => $loup) {
            $allNumes += $loup['c'];
            if ($k < 6)
                $pieDate[] = $loup['sbi_buildingname'] . '|' . $loup['c'];
            else
                $orther += $loup['c'];
        }
        if ($orther)
            $pieDate[] = '其它|' . $orther;

        $this->render('index', array(
            'model' => $model,
            '_userModel' => $_userModel,
            'pieDate' => $pieDate,
            'allNumes' => $allNumes,
            'medalstr' => $medalstr,
        ));
    }

    public function actionMoreInfo() {
        if (empty($_GET['uid']) || empty($_GET['offset']))
            exit();
        $userid = (int) $_GET['uid'];
        $limit = !empty($_GET['limit']) ? (int) $_GET['limit'] : 10;
        $offset = (int) $_GET['offset'];
        $sql = 'SELECT * FROM {{successinfo}} WHERE si_userid=' . $userid . ' ORDER BY si_successtime desc LIMIT ' . $offset . ',' . $limit;
        //echo $sql;exit;
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        $return = '';
        if ($rs) {
            foreach ($rs as $r) {
                $return .= '<tr>
                    <td class="txt">' . date('Y-m-d', $r['si_successtime']) . '</td>
                    <td class="txt">' . CHtml::encode($r['si_companyname']) . '</td>
                    <td class="txt">' . CHtml::link($r['si_buildname'], array('/systembuildinginfo/view', 'id' => $r['si_buildid'])) . '</td>
                    <td class="txt">' . CHtml::encode(Successinfo::$si_floortype[$r['si_floortype']]) . '</td>
                    <td class="txt">' . CHtml::encode($r['si_area']) . '</td>
                    </tr>';
            }
        }
        echo $return;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = Uagent::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'uagent-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
