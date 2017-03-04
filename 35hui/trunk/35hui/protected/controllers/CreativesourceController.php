<?php

class CreativesourceController extends Controller
{
    public $layout='office';
    private $_model;
	public function actionIndex()
	{
		$get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = self::getDataProvider($get);

        $seotkd = Seotkd::model()->findByPk(12);
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
                'options'=>$get,//生成的数组。在前台生成连接时使用
                'seotkd'=>$seotkd,//SEO优化
                'url'=>"creativesource/index",//url
        ));
	}
    public function actionView(){
        $model = $this->loadModel();
        $sysModel = Creativeparkbaseinfo::model()->findByPk($model->cr_cpid);
        $agentModel = Uagent::model()->find('ua_uid='.$model->cr_userid);
        if(common::isCanAddVisit('creativesource_visit_ids', $model->cr_id)){
            $model->cr_visit++;
            $model->update();
        }
        $ownerInfo = User::model()->findByPk($model->cr_userid);//得到发布者的user信息
        if(!$ownerInfo || !$sysModel){
            throw new CHttpException(404,'此房源已过期，访问失败！');
        }
        $pictures = Picture::model()->findAll('`p_sourceid`='.$model->cr_id.' AND `p_sourcetype`=10');
        $this->render('view',array(
            'model'=>$model,
            'sysModel'=>$sysModel,
            'agentModel'=>$agentModel,
            'pictures'=>$pictures,
        ));
    }
    /**
     * 查询符合条件的数据
     * @param <array> get参数集合
     * @return <type>
     */
    private function  getDataProvider($get) {
        $regionParamToColumn = array(
                'district'=>'cp_district',
        );
        $criteria=new CDbCriteria();

        $criteria->addColumnCondition(array("cr_check"=>4));
        $criteria->addCondition("cr_cpid!=''");
        $criteria->select = "max(cr_updatedate) as cr_updatedate,cr_cpid";
        if(isset($get['keyword']) && $get['keyword']!="") {
            $keyword = $get['keyword'];
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['creativeParkIndex'],"array");
            $criteria->addInCondition('cr_cpid', $idArr);
        }

        $regionParams = SearchMenu::getRegionParams();//得到地区搜索条件参数名称集合
        foreach($regionParams as $regionParam) {
            if(isset($get[$regionParam]) && $get[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$get[$regionParam]));
                }
            }
        }
        $criteria = Creativesource::model()->getTempleteSearchCriteria($criteria, $get);
        $criteria->group = "cr_cpid";
        $criteria->with["parkbaseinfo"] = array("select" => "cp_id");
        //排序
        $criteria->order = "cr_updatedate desc";
        if(isset($get["order"])){
            $get["order"]=="wa"?$criteria->order = "cp_propertyprice":"";//物业管理费从低到高
            $get["order"]=="wd"?$criteria->order = "cp_propertyprice desc":"";//物业管理费从高到低
            $get["order"]=="da"?$criteria->order = "cp_defanglv":"";//得房率从低到高
            $get["order"]=="dd"?$criteria->order = "cp_defanglv desc":"";//得房率从高到低
            $get["order"]=="zu"?$criteria->order = "cp_avgrentprice":"";//租金从低到高
            $get["order"]=="zd"?$criteria->order = "cp_avgrentprice desc":"";//租金从高到低
            $get["order"]=="ju"?$criteria->order = "cp_openingtime":"";//竣工年月从低到高
            $get["order"]=="jd"?$criteria->order = "cp_openingtime desc":"";//竣工年月从高到低
        }
//        echo "<pre>";print_r($criteria);exit;
        $dataProvider=new CActiveDataProvider('Creativesource', array(
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
                        'criteria'=>$criteria,
            'totalItemCount'=>count(Creativesource::model()->findAll($criteria)),//因为有group。CActiveDataProvider统计总条数有问题
        ));
        return $dataProvider;
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Creativesource::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'很抱歉，您所访问的创意园区房源不存在！');
        }
        return $this->_model;
    }
     public function actionAjaxGetSource(){
        $start = $_GET["start"];
        $buildid = $_GET["buildid"];
        $condition = $_GET["condition"];

        $all = Creativesource::model()->getRentSourceByCondition($buildid, $condition);
        $all = Creativesource::model()->getTmpSource($all,$start,5);
        echo json_encode($all);
        exit;
    }
}