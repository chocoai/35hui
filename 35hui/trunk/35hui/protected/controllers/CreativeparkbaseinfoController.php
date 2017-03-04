<?php

class CreativeparkbaseinfoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='office';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Creativeparkbaseinfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
    /**
     * 楼盘详细参数
     */
    public function ViewDetails(){
        $this->layout='office';
        $model = $this->loadModel();
        $this->render('details',array(
            'model'=>$model,
        ));
    }
    /**
     * 楼盘经纪人
     */
    public function ViewAgent(){
        $this->layout='office';
        $model = $this->loadModel();
        $sql='SELECT t2.* FROM `{{creativesource}}` t1
            RIGHT JOIN `{{uagent}}` t2 ON t1.`cr_userid`=t2.`ua_uid` LEFT JOIN `{{user}}` t3 ON t3.user_id=t2.ua_uid
            WHERE t1.`cr_cpid`='.$model->cp_id.' AND t1.`cr_check`=4 GROUP BY t1.`cr_userid` ORDER BY t3.`user_lasttime` DESC';
        $sqlCount='SELECT COUNT(*) FROM (SELECT t2.`ua_uid` FROM `{{creativesource}}` t1
            RIGHT JOIN `{{uagent}}` t2 ON t1.`cr_userid`=t2.`ua_uid`
            WHERE t1.`cr_cpid`='.$model->cp_id.' AND t1.`cr_check`=4 GROUP BY t1.`cr_userid`) tttt ';
        $count = Yii::app()->db->createCommand($sqlCount)->queryScalar();
        $page=!empty($_GET['page'])?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $pageSize = 10;
        $offect = ($page - 1)*$pageSize;
        $limit = ' LIMIT '.$offect.','.$pageSize;
        $uagents = Yii::app()->db->createCommand($sql.$limit)->queryAll();

        $this->render('agent',array(
            'model'=>$model,
            'uagents'=>$uagents,
            'count'=>$count,
            'pageSize'=>$pageSize,
        ));
    }
    /**
     * 楼盘经纪人
     */
    public function ViewBlog(){
        $this->layout='office';
        $model = $this->loadModel();
        $this->render('blog',array(
            'model'=>$model,
        ));
    }
    /**
     * 楼盘周边配套
     */
    public function ViewAround(){
        $this->layout='office';
        $model = $this->loadModel();
        $this->render('around',array(
            'model'=>$model,
        ));
    }
    /**
     * 楼盘详细参数
     */
    public function ViewAlbum(){
        $model = $this->loadModel();
        $this->render('album',array(
            'model'=>$model,
        ));
    }

    /**
     * 楼盘主页
     */
    public function actionView(){
        $this->layout='office';
        $tag = @$_GET["tag"];
        switch ($tag){
            default:
                $this->ViewIndex();break;
            case "album":
                $this->ViewAlbum();break;
            case "around":
                $this->ViewAround();break;
            case "agent":
                $this->ViewAgent();break;
            case "details":
                $this->ViewDetails();break;
        }
    }
    private function ViewIndex(){
        $model = $this->loadModel();
        if(common::isCanAddVisit('creativeparkbaseinfo_visit_ids', $model->cp_id)){
            $model->cp_visit++;
            $model->update();
        }

        //楼盘访问历史
        $viewedBuilds = $model->buildViewMemory($model->cp_id);
        $request = array_map('trim',array_merge($_GET,$_POST));
        $_GET = array();
        foreach(array('id','srtp','floor','order','prst','pred','arst','ared','page') as $k){
            if(!empty($request[$k]))
                $_GET[$k] = $request[$k];
        }

        $criteria=new CDbCriteria(array(
			'condition'=>'cr_cpid='.$model->cp_id,
		));
        $criteria->addCondition('cr_check=4');
        $criteria->with[] = 'user';

        /* 排序 */
        $order='';
        if(!isset($request['order'])) $request['order'] = '';
        $order = $request['order'];
        $orders=array(
            'arasc'  => 'cr_area',
            'ardesc' => 'cr_area DESC',
            'prasc'  => 'cr_dayrentprice',
            'prdesc' => 'cr_dayrentprice DESC',
            'aprasc'  => 'cr_monthrentprice',
            'aprdesc' => 'cr_monthrentprice DESC',
        );

        $prst = $pred = 0;//价格范围
        if(!empty($request['prst'])){
            $prst = (int)$request['prst'];
        }
        if(!empty($request['pred'])){
            $pred = (int)$request['pred'];
        }
        if($prst && $pred && $prst>$pred){
            $_temp = $prst;
            $prst = $pred;
            $pred = $_temp;
        }
        if($prst)
            $criteria->addCondition('cr_dayrentprice>='.$prst);

        if($pred)
            $criteria->addCondition('cr_dayrentprice<='.$prst);

        if($order=='prasc') $criteria->order = $orders['prasc'];
        if($order=='prdesc') $criteria->order = $orders['prdesc'];
        if($order=='aprasc') $criteria->order = $orders['aprasc'];
        if($order=='aprdesc') $criteria->order = $orders['aprdesc'];

        $arst = $ared = 0;//面积范围
        if(!empty($request['arst'])){
            $arst = (int)$request['arst'];
        }
        if(!empty($request['ared'])){
            $ared = (int)$request['ared'];
        }
        if($arst && $ared && $arst>$ared){
            $_temp = $arst;
            $arst = $ared;
            $ared = $_temp;
            $request['arst'] = $arst;
            $request['ared'] = $ared;
        }
        if($arst) $criteria->addCondition('cr_area>='.$arst);
        if($ared) $criteria->addCondition('cr_area<='.$ared);

        if($order=='arasc') $criteria->order = $orders['arasc'];
        if($order=='ardesc') $criteria->order = $orders['ardesc'];

        $floor='';//楼层位置
        if(isset($request['floor']) && isset(Officebaseinfo::$ob_floortype[$request['floor']-1])){
            $floor = --$request['floor'];
            $criteria->addCondition('cr_floortype='.$floor);
        }
        //$criteria->select = 'ob_officeid,ob_uid,ob_sellorrent,ob_floortype,ob_officearea,ob_rentprice,ob_monthrentprice,ob_avgprice,ob_sumprice';

        $dataProvider = new CActiveDataProvider('Creativesource', array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>10,
			),
		));

        $this->render('view',array(
            'model'=>$model,
            'dataProvider'=>$dataProvider,
            'request'=>$request,
            'viewedBuilds'=>array_slice($viewedBuilds, -3),//最多最近访问3个楼盘
        ));
    }
    public function actionCompare(){
        $pkids = array();
        if(!empty($_GET['pk'])){
            foreach(explode('|', $_GET['pk']) as $id){
                $id = (int)$id;
                if($id)
                    $pkids[]=$id;
            }
            $pkids = array_unique($pkids);//去重
        }
        $count = count($pkids);
        if($count<2 || $count>3){
            throw new CHttpException(302,'只能对两个或者三个楼盘进行比较');
        }
        $pkbuilds = Creativeparkbaseinfo::model()->findAll('cp_id IN('.implode(',', $pkids).')');
        $this->render('compare',array(
            'pkbuilds'=>$pkbuilds,
        ));
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Creativeparkbaseinfo::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='creativeparkbaseinfo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	//创意园 LIST START
	public function actionCreativeList()
	{
		$get = SearchMenu::explodeAllParamsToArray();
		
        $dataProvider = self::getDataProvider($get);

        $seotkd = Seotkd::model()->findByPk(12);
        $this->render('creativeparklist',array(
                'dataProvider'=>$dataProvider,
                'options'=>$get,//生成的数组。在前台生成连接时使用
                'seotkd'=>$seotkd,//SEO优化
                'url'=>"creativeparkbaseinfo/creativelist",//url
        ));
	}
	private function  getDataProvider($get) {
        $regionParamToColumn = array(
                'district'=>'cp_district',
        );
        $criteria=new CDbCriteria();
		//关键字判断
		 if(isset($get['keyword']) && $get['keyword']!="") {
            $keyword = $get['keyword'];
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['creativeParkIndex'],"array");
            $criteria->addInCondition('cp_id', $idArr);
        }
		//得到地区搜索条件参数名称集合
		$regionParams = SearchMenu::getRegionParams();
        foreach($regionParams as $regionParam) {
            if(isset($get[$regionParam]) && $get[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$get[$regionParam]));
                }
            }
        }
		
		$criteria->addCondition("cp_id!=''");
		//租金判断
		if(isset($get['rPrice'])){	
			$rPrice=Searchcondition::model()->find("sc_id={$get['rPrice']}");
			$criteria->compare("cp_avgrentprice","<={$rPrice->sc_maxvalue}");
			$criteria->compare("cp_avgrentprice",">={$rPrice->sc_minvalue}");
		}
		if(isset($get['rPricea'])){		
			$criteria->compare("cp_avgrentprice",">={$get['rPricea']}");
		}
		if(isset($get['rPriceb'])){		
			$criteria->compare("cp_avgrentprice","<={$get['rPriceb']}");
		}
        //排序
        $criteria->order = "cp_releasedate desc";
        if(isset($get["order"])){
            $get["order"]=="wa"?$criteria->order = "cp_propertyprice":"";//物业管理费从低到高
            $get["order"]=="wd"?$criteria->order = "cp_propertyprice desc":"";//物业管理费从高到低
            $get["order"]=="da"?$criteria->order = "cp_defanglv":"";//得房率从低到高
            $get["order"]=="dd"?$criteria->order = "cp_defanglv desc":"";//得房率从高到低
            $get["order"]=="zu"?$criteria->order = "cp_avgrentprice":"";//租金从低到高
            $get["order"]=="zd"?$criteria->order = "cp_avgrentprice desc":"";//租金从高到低
            $get["order"]=="ju"?$criteria->order = "cp_openingtime":"";//改建年月从低到高
            $get["order"]=="jd"?$criteria->order = "cp_openingtime desc":"";//改建年月从高到低
        }
		//echo "<pre>";print_r($criteria);exit;
        $dataProvider=new CActiveDataProvider('Creativeparkbaseinfo', array(
                        'pagination'=>array(
								'pageSize'=>10,
                        ),
                        'criteria'=>$criteria,       
        ));
        return $dataProvider;
    }
	//创意园 LIST END
    /**
     * 创意园区图片展示
     */
    public function actionPicList(){
        $albums="";
        $id="";
        if(isset($_GET["id"])&&$_GET["id"]){
            $id=$_GET["id"];
             $albums = Picture::model()->findAll(array('condition'=>'p_sourcetype=9 AND p_sourceid='.$id));
        }
       $this->renderPartial('piclist',array(
            "data"=>$albums,
       ));

    }
}
