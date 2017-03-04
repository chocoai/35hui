<?php

class SubpanoramaController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    //散拍全景不显示商务中心全景
    public function actionIndex() {
        $spn_state = "";
        $criteria = new CDbCriteria;
        if(isset($_POST['spn_state'])&&$_POST['spn_state']!="") {
            $spn_state = $_POST['spn_state'];
            $criteria->addColumnCondition(array("spn_state"=>$_POST['spn_state']));
        }
        $criteria->addNotInCondition("spn_sourcetype",array("3"));
        $criteria->order = "spn_releasetime desc";
        $dataProvider=new CActiveDataProvider('Subpanorama',array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
        ));
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
                'spn_state'=>$spn_state,
        ));
    }
    public function actionView() {
        $model=$this->loadModel();
        $title = "<font color='red'>房源没有找到，或者已经下线不需要处理全景</font>";
        $criteria = new CDbCriteria;
        if($model->spn_sourcetype==1) {//写字楼
            $criteria->condition = "ob_officeid = ".$model->spn_sourceid;
            $criteria->addColumnCondition(array("ob_check"=>4));
            
            $officeInfo = Officebaseinfo::model()->find($criteria);
            
            $title = @$officeInfo->buildingInfo->sbi_buildingname;
            
        }elseif($model->spn_sourcetype==2) {//商铺
            $criteria->condition = "sb_shopid = ".$model->spn_sourceid." AND  sb_check = 4";
            
            $officeInfo = Shopbaseinfo::model()->find($criteria);
            if($officeInfo) {
                $title = $officeInfo->presentInfo->sp_shoptitle;
            }
        }elseif($model->spn_sourcetype==4) {//住宅
            $criteria->condition = "rbi_id = ".$model->spn_sourceid;
            $criteria->with = array(
                    "tag"=>array(
                            "condition"=>"rt_check = 4"
                    )
            );
            $officeInfo = Residencebaseinfo::model()->find($criteria);
            if($officeInfo) {
                $title = $officeInfo->rbi_title;
            }
        }elseif($model->spn_sourcetype==Subpanorama::cypark) {//创意园区
            $criteria->condition = "cr_id = ".$model->spn_sourceid;
            $criteria->addColumnCondition(array("cr_check"=>4));

            $info = Creativesource::model()->find($criteria);

            $title = @$info->parkbaseinfo->cp_name;
        }
        $this->render('view',array(
                'model'=>$model,
                'title'=>$title,
        ));
    }
    /**开始处理全景
     *
     */
    public function actionAudit() {
        $opeUser = Yii::app()->user->id;
        $model = $this->loadModel();

        $model->spn_state = 1;//处理中
        if(isset($_POST['unpass'])&&$_POST["unpass"]==1) {
            $model->spn_state = 3;//处理中
            if( ($userid=Subpanorama::model()->getUserId($model->spn_sourceid, $model->spn_sourcetype)) ){
                $msgModel = new Msg();
                $msgModel->msg_sendid = 0;
                $msgModel->msg_revid = $userid;
                $msgModel->msg_title = '全景处理通知';
                $msgModel->msg_content = $_POST['msg_content'].'['.Subpanorama::$sourcetype[$model->spn_sourcetype]."房源ID:".$model->spn_sourceid.']';
                $msgModel->msg_time = time();
                $msgModel->save();
            }
        }
        $model->spn_handler = $opeUser;//处理全景者
        $model->update();

        header("Location:".$_SERVER['HTTP_REFERER']);
    }
    /**
     * 打包下载鱼眼图片
     */
    public function actionDownload() {
        Yii::import('application.common.*');
        require_once('PHPZip.php');
        $id = $_GET['id'];//下载的id号
        $model = $this->loadModel();

        $pics = unserialize($model->spn_fisheyephoto);
        if(count($pics)>0) {
            foreach($pics as $key=>$value) {
                $pics[$key] = PIC_PATH.$value;
            }
            $zip = new PHPZip();
            $zip->downloadZipByFiles($pics);
        }
    }
    /**
     * 预览展示全景。只能预览散拍全景
     */
    public function actionPreView() {
        $this->layout = "frame";
        $model = Subpanorama::model()->findByPk($_GET['id']);
        $panoramaUrl = $model->spn_panoramaurl;
        $this->render('preiew',array('panoramaUrl'=>$panoramaUrl));
        
    }
    /**
     * 展示房源全景列表
     */
    public function actionSourcePanorama() {
        $sourceId = $_GET['id'];
        $type = $_GET['type'];
        $panoramas = Subpanorama::model()->findAllByAttributes(array("spn_sourcetype"=>$type,"spn_sourceid"=>$sourceId));
        $titlepanorama = "";//标题全景
        $this->render('sourcePanorama',array(
                'panoramas'=>$panoramas,
                'titlepanorama'=>$titlepanorama,
                'sourceId'=>$sourceId,
                'type'=>$type,
        ));
    }

    /**
     * 通过用户请求上传散拍全景
     */
    public function actionUpload() {
        $model = $this->loadModel();
        $fileForm = new UploadPanoramaFileForm();
        if(isset($_POST)&&$_POST) {//包含上传表单信息
            $model->spn_panoramaurl = _PANORAMA.DS.Panorama::model()->randomFolderName();
            if($fileForm->validate()) {
                $file=CUploadedFile::getInstance($fileForm, 'panoramaFile');
                $updateFileDir = $model->spn_panoramaurl;
                $uploadResult = Panorama::model()->uploadPanoramaContent($file,$updateFileDir);
                if($uploadResult) {//上传成功
                    $opeUser = Yii::app()->user->id;
                    $model->spn_handler = $opeUser;//处理全景者
                    $model->spn_state = 2;
                    $model->spn_completetime = time();
                    if($model->update()) {
                        if( !in_array($model->spn_sourcetype, array(1,2,3,4,5) ) ) return;
                        Yii::app()->user->setFlash('message','全景上传成功');
                        $userId = 0;
                        //上传全景之后查看是否已经是全景房源，没有就要改变状态。同时赠送积分和商务币
                        if($model->spn_sourcetype ==1){//写字楼
                            $officeBaseModel = Officebaseinfo::model()->findByPk($model->spn_sourceid);
                            $userId = $officeBaseModel->ob_uid;
                            if($officeBaseModel&&$officeBaseModel->ob_ispanorama==0) {
                                $officeBaseModel->ob_ispanorama = 1;
                                $officeBaseModel->update();
                                Yii::app()->user->setFlash('message','全景上传成功,并成功把此房源设置为全景房源！');
                            }
                        }elseif($model->spn_sourcetype ==2) {//商铺
                            $shopBaseModel = Shopbaseinfo::model()->findByPk($model->spn_sourceid);
                            $userId = $shopBaseModel->sb_uid;
                            if($shopBaseModel&&$shopBaseModel->sb_panorama==0) {
                                $shopBaseModel->sb_panorama = 1;
                                $shopBaseModel->sb_order+=common::getOrderConfig('subpanorama');
                                $shopBaseModel->save();
                                Yii::app()->user->setFlash('message','全景上传成功,并成功把此房源设置为全景房源！');
                            }

                        }elseif($model->spn_sourcetype ==4) {//住宅
                            $residBaseModel = Residencebaseinfo::model()->findByPk($model->spn_sourceid);
                            $userId = $residBaseModel->rbi_uid;
                            $tagModel = Residencetag::model()->findByAttributes(array("rt_rbiid"=>$model->spn_sourceid));
                            if($tagModel&&$tagModel->rt_ispanorama==0) {
                                $tagModel->rt_ispanorama = 1;
                                $tagModel->save();
                                $residBaseModel->rbi_order+=common::getOrderConfig('subpanorama');
                                $residBaseModel->save();
                                Yii::app()->user->setFlash('message','全景上传成功,并成功把此房源设置为全景房源！');
                            }
                        }elseif($model->spn_sourcetype ==Subpanorama::cypark){
                            $baseInfoModel = Creativesource::model()->findByPk($model->spn_sourceid);
                            $userId = $baseInfoModel->cr_userid;
                            if($baseInfoModel&&$baseInfoModel->cr_ispanorama==0) {
                                $baseInfoModel->cr_ispanorama = 1;
                                $baseInfoModel->update();
                                Yii::app()->user->setFlash('message','全景上传成功,并成功把此房源设置为全景房源！');
                            }
                        }
//                        $config=Oprationconfig::model()->getConfigByName('uploadPanoramaPicAndSucBinding','0');
//                        $description = "成功提交并绑定全景图片，奖励{:money}商务币";
//                        Userproperty::model()->addMoney($userId, $config, $description);
                        $config=Oprationconfig::model()->getConfigByName('uploadPanoramaPicAndSucBinding','1');
                        $description = "成功提交并绑定全景图片，奖励{:point}积分";
                        Userproperty::model()->addPoint($userId, $config, $description);
                        $modelUser=User::model()->findByPk($userId);
                        $modelUser->user_subpnum=$modelUser->user_subpnum+1;
                        $modelUser->update();

                        $this->redirect(array("view",'id'=>$model->spn_id));
                    }
                }
            }
        }
        $this->render('upload',array(
                'model'=>$model,
                'fileForm'=>$fileForm,
        ));
    }
    public function actionUpdate() {
        $model = $this->loadModel();
        $fileForm = new UploadPanoramaFileForm();
        if(isset($_POST)&&$_POST) {//包含上传表单信息
            $oldPanorama = $model->spn_panoramaurl;//旧的全景地址
            if($fileForm->validate()) {
                $file=CUploadedFile::getInstance($fileForm, 'panoramaFile');
                $model->spn_panoramaurl = _PANORAMA.DS.Panorama::model()->randomFolderName();
                $uploadResult = Panorama::model()->uploadPanoramaContent($file,$model->spn_panoramaurl);
                if($uploadResult) {
                    //删除旧的全景地址
                    common::deldir(PIC_PATH.$oldPanorama);
                    //保存新数据
                    $opeUser = Yii::app()->user->id;
                    $model->spn_handler = $opeUser;//处理全景者
                    $model->spn_completetime = time();
                    if($model->update()) {
                        Yii::app()->user->setFlash('message','全景修改成功');
                        $this->redirect(array("view",'id'=>$model->spn_id));
                    }
                }
            }
        }
        $this->render('update',array(
                'model'=>$model,
                'fileForm'=>$fileForm,
        ));
    }
    /**
     * 站点后台根据房源上传全景。只提供商务中心全景
     */
    public function actionSourceUpload() {
        $va = va();
        $va->check(array(
                'sourceId'=>array('not_blank','uint'),
                'type'=>array('not_blank',array('eq', '3')),//只有商务中心才能使用此方法
        ));
        if($va->success) {
            $model = new Subpanorama();
            $fileForm = new UploadPanoramaFileForm();
            $model->spn_panoramaurl = _PANORAMA.DS.Panorama::model()->randomFolderName();

            if(isset($_POST['Subpanorama'])) {//包含上传表单信息
                $time = time();
                $model->attributes=$_POST['Subpanorama'];
                $model->spn_sourceid = $va->valid['sourceId'];
                $model->spn_releasetime = $time;
                $model->spn_completetime = $time;
                $model->spn_sourcetype = Subpanorama::business;//
                $model->spn_state = 2;
                if($model->validate()&&$fileForm->validate()) {
                    $file=CUploadedFile::getInstance($fileForm, 'panoramaFile');
                    $updateFileDir = $model->spn_panoramaurl;
                    $uploadResult = Panorama::model()->uploadPanoramaContent($file,$updateFileDir);

                    if($uploadResult) {//上传成功
                        $opeUser = Yii::app()->user->id;
                        $model->spn_handler = $opeUser;//处理全景者
                        if($model->save()) {
                            Yii::app()->user->setFlash('uploadFile','全景上传成功');
                            $this->redirect(array('subpanorama/sourcepanorama','id'=>$va->valid['sourceId'],"type"=>$va->valid['type']));
                        }
                    }
                }
            }
            $this->render('sourceUpload',array(
                    'model'=>$model,
                    'fileForm'=>$fileForm,
                    'sourceId'=>$va->valid['sourceId'],
            ));
        }else {
            throw new CHttpException(400,'地址错误');
        }
    }
    public function actionDelete() {
        $model=$this->loadModel();
        //删除上传的鱼眼图片和缩略图
        $fisheyephoto = $model->spn_fisheyephoto;
        $fisheyephotoArr = unserialize($fisheyephoto);
        if($fisheyephotoArr) {
            foreach($fisheyephotoArr as $value) {
                Picture::model()->deleteFile(PIC_PATH.$value, Subpanorama::$standard);//删除文件
            }
        }
        //删除上传的全景图片
        common::deldir(PIC_PATH.$model->spn_panoramaurl);

        $model->delete();
        Yii::app()->user->setFlash('message','全景删除成功');
        header("Location:".$_SERVER['HTTP_REFERER']);
    }
    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model=new Subpanorama('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Subpanorama']))
            $model->attributes=$_GET['Subpanorama'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Subpanorama::model()->findbyPk($_GET['id']);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='subpanorama-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

     /**
     * 用户上传的全景纳入到楼盘全景
     */
    public function actionAdd() {
        $model = $this->loadModel();
        $panoramaModel=new Panorama;
        if(isset($_POST['Panorama']['p_type'])&&$_POST['Panorama']['p_type']!=''){
            $userId = 0;
            if($model->spn_sourcetype ==2) {//商铺
                 //赠送积分和商务币
                $shopModel = Shopbaseinfo::model()->findByPk($model->spn_sourceid);
                if($shopModel->sb_sysid){
                    $userId=$shopModel->sb_uid;
                    $panoramaModel->p_buildingid=$shopModel->sb_sysid;
                    $panoramaModel->p_ptype=1;
                }
            }else if($model->spn_sourcetype ==4) {//住宅
                 //赠送积分和商务币
                $residenceModel = Residencebaseinfo::model()->findByPk($model->spn_sourceid);
                $userId=$residenceModel->rbi_uid;
                $panoramaModel->p_buildingid=$residenceModel->rbi_communityid;
                $panoramaModel->p_ptype=2;
            }else{//其他都在officetag表中
                 //赠送积分和商务币
                $officeModel = Officebaseinfo::model()->findByPk($model->spn_sourceid);
                if($officeModel->ob_sysid){
                    $userId=$officeModel->ob_uid;
                    $panoramaModel->p_buildingid=$officeModel->ob_sysid;
                    $panoramaModel->p_ptype=1;
                }
            }
            if($userId){
                $dba = dba();
                $panoramaModel->p_id = $dba->id('35_panorama');
                $panoramaModel->p_title=$model->spn_panoramaname;
                $panoramaModel->p_url=$model->spn_panoramaurl;
                $panoramaModel->p_type=$_POST['Panorama']['p_type'];
                $panoramaModel->p_uploadtime=time();
                $panoramaModel->save();
                $config=Oprationconfig::model()->getConfigByName('panorama_attach','0');
                $description = "成功提交并绑定全景图片，奖励{:money}商务币";
                Userproperty::model()->addMoney($userId, $config, $description);
                $config=Oprationconfig::model()->getConfigByName('panorama_attach','1');
                $description = "成功提交并绑定全景图片，奖励{:point}积分";
                Userproperty::model()->addPoint($userId, $config, $description);
            }
            $this->redirect(array("view",'id'=>$model->spn_id));
        }
        $this->render('add',array(
                'model'=>$model,
                'panoramaModel'=>$panoramaModel,
        ));
    }
}