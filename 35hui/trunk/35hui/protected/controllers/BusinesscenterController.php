<?php

class BusinesscenterController extends Controller {

    public $layout='office';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;
    public function actionIndex(){
        $url = "businesscenter/index";
        $this->ListFunction($url);
    }
    public function actionList(){
        $url = "businesscenter/list";
        $this->ListFunction($url);
    }
    private function ListFunction($url){
        $get = SearchMenu::explodeAllParamsToArray();
        $regionParamToColumn = array(
                'district'=>'bc_district',
        );
        $criteria=new CDbCriteria();

        if(isset($get['keyword']) && $get['keyword']!="") {
            $keyword = $get['keyword'];
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['businessIndex'],"array");
            $criteria->addInCondition('bc_id', $idArr);
        }

        $regionParams = SearchMenu::getRegionParams();//得到地区搜索条件参数名称集合
        foreach($regionParams as $regionParam) {
            if(isset($get[$regionParam]) && $get[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$get[$regionParam]));
                }
            }
        }
        $criteria = Businesscenter::model()->getTempleteSearchCriteria($criteria, $get);
        //排序
        $criteria->order = "bc_releasetime desc";
        if(isset($get["order"])){
            $get["order"]=="zu"?$criteria->order = "bc_rentprice":"";//租金由低到高
            $get["order"]=="zd"?$criteria->order = "bc_rentprice desc":"";//租金由高到低
            $get["order"]=="ju"?$criteria->order = "bc_completetime":"";//竣工时间由旧到新
            $get["order"]=="jd"?$criteria->order = "bc_completetime desc":"";//竣工时间由新到旧
        }
//        echo "<pre>";print_r($criteria);exit;
        $dataProvider=new CActiveDataProvider('Businesscenter', array(
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
                        'criteria'=>$criteria,
        ));

        $seotkd = Seotkd::model()->findByPk(4);
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
                'options'=>$get,//生成的数组。在前台生成连接时使用
                'seotkd'=>$seotkd,//SEO优化
                'url'=>$url,//url
        ));
    }
    /**
     * 楼盘周边配套
     */
    public function ViewAround(){
        $model = $this->loadModel();
        $sysModel = Systembuildinginfo::model()->findByPk($model->bc_sysid);
        if(!$sysModel) $sysModel = new Systembuildinginfo();
        $model = $this->loadModel();
        $this->render('around',array(
            'model'=>$model,
            'sysModel'=>$sysModel,
        ));
    }
    public function ViewAlbum(){
        $model = $this->loadModel();
        $sysModel = Systembuildinginfo::model()->findByPk($model->bc_sysid);
        if(!$sysModel) $sysModel = new Systembuildinginfo();
        $this->render('album',array(
            'model'=>$model,
            'sysModel'=>$sysModel,
        ));
    }
    /**
     * 楼盘详细参数
     */
    public function ViewDetails(){
        $model = $this->loadModel();
        $sysModel = Systembuildinginfo::model()->findByPk($model->bc_sysid);
        if(!$sysModel) $sysModel = new Systembuildinginfo();
        $this->render('details',array(
            'model'=>$model,
            'sysModel'=>$sysModel,
        ));
    }

    /**
     * 商务中心查看分发器
     */
    public function actionView(){
        $tag = @$_GET["tag"];
        switch ($tag){
            default:
                $this->ViewIndex();break;
            case "album":
                $this->ViewAlbum();break;
            case "around":
                $this->ViewAround();break;
            case "details":
                $this->ViewDetails();break;
        }
    }
    private function ViewIndex(){
        $model = $this->loadModel();
        $sysModel = Systembuildinginfo::model()->findByPk($model->bc_sysid);
        if(!$sysModel) $sysModel = new Systembuildinginfo();
        if(common::isCanAddVisit('businesscenter_visit_ids', $model->bc_id)){
            $model->bc_visit++;
            $model->update();
        }
        $viewedBuilds = $model->businessViewMemory($model->bc_id);//访问历史
        $this->render('view',array(
            'model'=>$model,
            'sysModel'=>$sysModel,
            'viewedBuilds'=>array_slice($viewedBuilds, -3),
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
        $pkbuilds = Businesscenter::model()->findAll('bc_id IN('.implode(',', $pkids).')');
        $this->render('compare',array(
            'pkbuilds'=>$pkbuilds,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Businesscenter::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'很抱歉，您所访问的商务中心不存在或已删除！');
        }
        return $this->_model;
    }
    /**
     * 商务中心图片展示
     */
    public function actionPicList(){
        $albums="";
        $id="";
        if(isset($_GET["id"])&&$_GET["id"]){
            $id=$_GET["id"];
             $albums = Picture::model()->findAll(array('condition'=>'p_sourcetype=3 AND p_sourceid='.$id));
        }
       $this->renderPartial('piclist',array(
            "data"=>$albums,
       ));

    }
}
