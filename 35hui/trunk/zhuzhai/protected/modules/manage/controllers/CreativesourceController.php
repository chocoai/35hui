<?php

class CreativesourceController extends Controller
{
    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array('rentrelease',"RentUpdate","showlikename","getparkinfo"),
                        'roles'=>array(
                                Yii::app()->params['agent'],
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionRentRelease()
    {
        $model = new Creativesource();
        $userId = Yii::app()->user->id;
        if(isset($_POST['cr_cpid'])){
            $model = $this->saveBaseInfo($model);
            if(isset($_POST['submit'])&&$_POST['submit']!==null){//提交
                if($model->validate()){
                    $integral = Oprationconfig::model()->getConfigByName('release',3);
                    if(User::model()->validateRelease($userId, 1,4)=="success"){
                        if($model->save()){
                            $crId = $model->cr_id;
                            //保存图片
                            Picture::model()->insertImg($_POST['picture'],$crId,Picture::$sourceType['cyparksource']);//默认使用最后上传的图片做为标题图

                            $description = "创意园区房源".$crId."发布成功，奖励{:point}积分";
                            Userproperty::model()->addPoint($userId, $integral, $description);
                            Medal::model()->piwikMedal($userId, 9, 1);//连续发房源任务
                            Yii::app()->user->setFlash('message','创意园区房源发布成功！'.CHtml::link("为该房源添加一份全景",array("/manage/subpanorama/index","type"=>Subpanorama::cypark,"id"=>$crId),array("style"=>"color:blue")) );

                            $modelUser = User::model()->findByPk($userId);//增加统计数
                            $modelUser->user_housenum=$modelUser->user_housenum+1;
                            $modelUser->user_cyparknum=$modelUser->user_cyparknum+1;
                            $modelUser->update();
                        }else{
                            Yii::app()->user->setFlash('message','发布创意园区房源信息失败！');
                        }
                        $this->redirect(array('manage/rent','sourceType'=>'4'));
                    }
                }
            }elseif(isset($_POST['sketch'])&&$_POST['sketch']!==null){//保存为草稿
                $model->cr_check=8;
                if($model->validate()){
                    $validateResult=User::model()->validateRelease($userId,2,4);
                    if($validateResult=="success"){
                        if($model->save()){
                            $crId = $model->cr_id;
                            //保存图片
                            Picture::model()->insertImg($_POST['picture'],$crId,Picture::$sourceType['cyparksource']);
                            Yii::app()->user->setFlash('message','保存草稿成功！');
                        }else{
                            Yii::app()->user->setFlash('message','保存草稿失败！');
                        }
                        $this->redirect(array('manage/rent','tag'=>'draft','sourceType'=>'4'));
                    }
                }
            }else{
                $this->redirect(array('main/error'));
            }
        }
        $modelSelect = Creativesource::model()->getSelectOffice($userId);//曾经选过的创意园；
        $this->render('rentrelease',array(
                'model'=>$model,
                'modelSelect'=>$modelSelect,
        ));
    }
    public function actionRentUpdate(){
        $userId = Yii::app()->user->id;
        
        $model = $this->loadModel();
        if($model->cr_userid!=$userId){
            throw new CHttpException(404,'The requested page does not exist.');
        }
        if(isset($_POST['cr_cpid'])){
            $model = $this->saveBaseInfo($model);
            $model->cr_check=8;
            $model->update();
            Yii::app()->user->setFlash('message','修改出租房源信息成功！');
            $this->redirect(array('manage/rent','sourceType'=>'4',"tag"=>"draft"));
        }
        $this->render('rentupdate',array(
                'model'=>$model,
        ));
    }
    /**
     * 从get中保存信息
     * @param <type> $model
     * @return <type>
     */
    private function saveBaseInfo($model){
        foreach($_POST as $key=>$value){
            !is_array($value)?$_POST[$key] = trim($value):"";
        }
        $time = time();
        $model->attributes=$_POST;
        $model->cr_userid = Yii::app()->user->id;
        $model->cr_releasedate = $time;
        $model->cr_updatedate = $time;
        $model->cr_expiredate = 86400*$model->cr_expiredate;
        $model->cr_check=4;
        return $model;
    }
    public function actionShowLikeName(){
        $keyw=$_POST['keyw'];
        $dba = dba();
        $sql = "select `cp_id`,`cp_name`,`cp_address` from 35_creativeparkbaseinfo where `cp_name` like '%".$keyw."%' limit 10";
        $list = $dba->select($sql);
        echo json_encode($list);
        exit;
    }
    /**
     * ajax 通过传入的park id，得到park的所有信息。
     */
    public function actionGetParkInfo(){
        $cpid = $_GET['cpid'];
        $dba = dba();
        $_model = $dba->select_row("select cp_id,cp_name,cp_address,cp_avgrentprice from 35_creativeparkbaseinfo where `cp_id`=?",$cpid);
        echo CJSON::encode($_model);
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
                $this->_model=Creativesource::model()->findbyPk($_GET['id']);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='creativerent-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
