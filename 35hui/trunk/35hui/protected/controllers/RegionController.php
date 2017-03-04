<?php

class RegionController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to 'column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('getSectionByDistrict','getPosition','getlistbyparentid','ajaxGetChildren'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionGetSectionByDistrict(){
        $va = va();
        $va->check(array(
            'districtId'=>array('not_blank','uint'),
        ));
        if($va->success){
            $dba = dba();
            $sections = $dba->select("select `re_id`,`re_name` from 35_region where `re_parent_id`=?",$va->valid['districtId']);
            echo json_encode($sections);
        }
    }
    
    
    
    public function actionGetPosition()
    {
    
    	if(isset($_POST['id']) && $_POST['id']!=='0')
    	{
    		$result=array();
    		$result=Region::itemparse($_POST['id']);
    		echo json_encode($result);
    	}
    	
    }
    //通过传入父id，得到子列表。
    public function actionGetListByParentId(){
        $parentid = $_GET['parentid'];
        $dba = dba();
        $list = $dba->select("select * from 35_region where `re_parent_id`=?",$parentid);
        echo json_encode($list);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Region::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='region-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    /**
     * 根据省份的id异步加载下面的城市
     */
    public function actionAjaxGetChildren(){
        if(isset($_GET['province'])){
            echo json_encode(Region::model()->getFormatChildrenData($_GET['province']));
        }elseif(isset($_GET['city'])){
            echo json_encode(Region::model()->getFormatChildrenData($_GET['city']));
        }elseif(isset($_GET['district'])){
            echo json_encode(Region::model()->getFormatChildrenData($_GET['district']));
        }elseif(isset($_GET['section'])){
            echo json_encode(Region::model()->getFormatChildrenData($_GET['section']));
        }
    }
}
