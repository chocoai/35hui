<?php

class OfficebaseinfoController extends Controller
{

    const PAGE_SIZE=10;

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
                        'actions'=>array('rentrelease',"rentupdate","salerelease","saleupdate","ValidateNum","ShowLikeName"),
                        'users'=>array('@'),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionShowLikeName(){
        $keyw=$_POST['keyw'];
        $dba = dba();
        $sql = "select `sbi_buildingid`,`sbi_buildingname`,`sbi_address` from 35_systembuildinginfo where `sbi_buildingname` like '%".$keyw."%' limit 10";
        $list = $dba->select($sql);
        echo json_encode($list);
		exit;
	}
    /**
     * 验证是否可以发布或者保存
     */
    public function actionValidateNum(){
        $userId = Yii::app()->user->id;
        $type = 2;
        if($_GET['name']=="submit"){//发布
            $type = 1;
        }
        $return = User::model()->validateRelease($userId, $type, 1);
        echo $return;
        exit;
    }
    public function actionSaleRelease(){
        $model = new Officebaseinfo;
        $userId = Yii::app()->user->id;
        if(isset($_POST['ob_sysid'])){
            $model = $this->saveOfficeBaseInfo($model, 2);
            if(isset($_POST['submit'])&&$_POST['submit']!==null){
                if($model->validate()){
                    //计算要奖励的积分
                    $integral = Oprationconfig::model()->getConfigByName('release',3);
                    if(User::model()->validateRelease($userId, 1,1)=="success"){
                        if($model->save()){
                            $officeId = $model->ob_officeid;
                            Picture::model()->insertImg($_POST['picture'],$officeId,Picture::$sourceType['officebaseinfo']);//默认使用最先上传的图片做为标题图
                            $description = "写字楼出售房源".$officeId."发布成功，奖励{:point}积分";
                            Userproperty::model()->addPoint($userId, $integral, $description);
                            Medal::model()->piwikMedal($userId, 9, 1);//连续发房源任务
                            Yii::app()->user->setFlash('message','发布出售房源信息成功！'.CHtml::link("为该房源添加一份全景",array('/manage/subpanorama/index',"type"=>'1',"id"=>$officeId),array("style"=>"color:blue")) );

                            $modelUser = User::model()->findByPk($userId);//增加统计数
                            $modelUser->user_housenum=$modelUser->user_housenum+1;
                            $modelUser->user_officenum=$modelUser->user_officenum+1;
                            $modelUser->update();
                        }else{
                            Yii::app()->user->setFlash('message','发布出售房源信息失败！');
                        }
                        $this->redirect(array('manage/sell','sourceType'=>'1'));
                    }
                }
            }elseif(isset($_POST['sketch'])&&$_POST['sketch']!==null){
                if($model->validate()){
                    if(User::model()->validateRelease($userId,2,1)=="success"){
                        $model->ob_check=8;
                        if($model->save()){
                            $officeId = $model->ob_officeid;
                            Picture::model()->insertImg($_POST['picture'],$officeId,Picture::$sourceType['officebaseinfo']);
                            Yii::app()->user->setFlash('message','保存草稿成功！');
                        }else{
                            Yii::app()->user->setFlash('message','保存草稿失败！');
                        }
                        $this->redirect(array('manage/sell','tag'=>'draft','sourceType'=>'1'));
                    }
                }
            }else{
                $this->redirect(array('main/error'));
            }
        }

        $modelSelect = Officebaseinfo::model()->getSelectOffice($userId,2);//曾经选过的楼盘；
        $this->render('salerelease',array(
                'model'=>$model,
                'modelSelect'=>$modelSelect,
        ));
    }
    public function actionSaleUpdate()
    {
        $userId = Yii::app()->user->id;
        //修改需要的最少新币
        $model = $this->loadModel();
        if($model->ob_uid!=$userId){
            throw new CHttpException(404,'The requested page does not exist.');
        }
        if(isset($_POST['ob_sysid'])){
            $model = $this->saveOfficeBaseInfo($model, 2);
            $model->ob_check=8;
            $model->update();
            Yii::app()->user->setFlash('message','修改出售房源信息成功！');
            $this->redirect(array('manage/sell','sourceType'=>'1',"tag"=>"draft"));
        }
        $this->render('saleupdate',array(
                'model'=>$model,
        ));
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionRentRelease()
    {
        $model = new Officebaseinfo();
        $userId = Yii::app()->user->id;
        if(isset($_POST['ob_sysid'])){
            $model = $this->saveOfficeBaseInfo($model, 1);
            if(isset($_POST['submit'])&&$_POST['submit']!==null){//提交
                if($model->validate()){
                    $integral = Oprationconfig::model()->getConfigByName('release',3);
                    if(User::model()->validateRelease($userId, 1,1)=="success"){
                        if($model->save()){
                            $officeId = $model->ob_officeid;
                            //保存图片
                            Picture::model()->insertImg($_POST['picture'],$officeId,Picture::$sourceType['officebaseinfo']);//默认使用最后上传的图片做为标题图

                            $description = "写字楼出租房源".$officeId."发布成功，奖励{:point}积分";
                            Userproperty::model()->addPoint($userId, $integral, $description);
                            Medal::model()->piwikMedal($userId, 9, 1);//连续发房源任务
                            Yii::app()->user->setFlash('message','发布出租房源信息成功！'.CHtml::link("为该房源添加一份全景",array("/manage/subpanorama/index","type"=>1,"id"=>$officeId),array("style"=>"color:blue")) );

                            $modelUser = User::model()->findByPk($userId);//增加统计数
                            $modelUser->user_housenum=$modelUser->user_housenum+1;
                            $modelUser->user_officenum=$modelUser->user_officenum+1;
                            $modelUser->update();
                        }else{
                            Yii::app()->user->setFlash('message','发布出租房源信息失败！');
                        }
                        $this->redirect(array('manage/rent','sourceType'=>'1'));
                    }
                }
            }elseif(isset($_POST['sketch'])&&$_POST['sketch']!==null){//保存为草稿
                $model->ob_check=8;
                if($model->validate()){
                    $validateResult=User::model()->validateRelease($userId,2,1);
                    if($validateResult=="success"){
                        if($model->save()){
                            $officeId = $model->ob_officeid;
                            //保存图片
                            Picture::model()->insertImg($_POST['picture'],$officeId,Picture::$sourceType['officebaseinfo']);
                            Yii::app()->user->setFlash('message','保存草稿成功！');
                        }else{
                            Yii::app()->user->setFlash('message','保存草稿失败！');
                        }
                        $this->redirect(array('manage/rent','tag'=>'draft','sourceType'=>'1'));
                    }
                }
            }else{
                $this->redirect(array('main/error'));
            }
        }
        $modelSelect = Officebaseinfo::model()->getSelectOffice($userId,1);//曾经选过的楼盘；
        $this->render('rentrelease',array(
                'model'=>$model,
                'modelSelect'=>$modelSelect,
        ));
    }
    public function actionRentUpdate()
    {
        $userId = Yii::app()->user->id;
        //修改需要的最少新币
        $model = $this->loadModel();
        if($model->ob_uid!=$userId){
            throw new CHttpException(404,'The requested page does not exist.');
        }
        if(isset($_POST['ob_sysid'])){
            $model = $this->saveOfficeBaseInfo($model, 1);
            $model->ob_check=8;
            $model->update();
            Yii::app()->user->setFlash('message','修改出租房源信息成功！');
            $this->redirect(array('manage/rent','sourceType'=>'1',"tag"=>"draft"));
        }
        $this->render('rentupdate',array(
                'model'=>$model,
        ));
    }
    /**
     *
     * @param <type> $model
     * @param <type> $rentOrSale 1租2售
     * @return <type>
     */
    private function saveOfficeBaseInfo($model,$rentOrSale){
        foreach($_POST as $key=>$value){
            !is_array($value)?$_POST[$key] = trim($value):"";
        }
        $time = time();
        $model->attributes=$_POST;
        $model->ob_uid = Yii::app()->user->id;
        $model->ob_sellorrent = $rentOrSale;
        $model->ob_releasedate = $time;
        $model->ob_updatedate = $time;
        $model->ob_expiredate = 86400*$model->ob_expiredate;

        if($rentOrSale==1){
            $model->ob_avgprice = 0;
            $model->ob_sumprice = 0;
        }else{
            $model->ob_rentprice = 0;
            $model->ob_monthrentprice = 0;
        }
        $model->ob_check=4;
        return $model;
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete()
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            if(isset($_GET['orid']))
            {
                $orid = $_GET['orid'];
                $fact = $this->judgeUser($orid);
                if(!$fact)
                {
                    $this->redirect(array('/site/error'));
                }
                try
                {
                    $model = $this->loadModel();
                    if($model->ot_check!==2)//初始状态不是recycle则不可以修改
                    {
                        $this->redirect('/site/error');
                    }
                    $connection = Yii::app()->db;

                    $sql = 'UPDATE {{officetag}} SET `ot_check`=1 WHERE `ot_officeid`='.$orid;
                    $command = $connection->createCommand($sql);
                    $command->execute();
                }catch(Exception $e){
                }
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_POST['ajax']))
                $this->redirect(array('index'));
        }else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
            {
                $this->_model = Officebaseinfo::model()->findbyPk($_GET['id']);

            }
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}
