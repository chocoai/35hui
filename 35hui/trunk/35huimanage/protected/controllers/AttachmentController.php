<?php

class AttachmentController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    private $_buidmodel;

    /**
     * Displays a particular model.
     */
    public function actionView() {
        $this->render('view',array(
                'model'=>$this->loadModel(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionDownload() {
        $attachment = Attachment::model()->findByPk($_GET['id']);
        if(!$attachment) {
            //echo 'bb';exit;
            $this->Redirect(array("/site/error"));
        }
        $file_name   =   Attachment::$attTypeName[$attachment->att_type].'附件'.substr($attachment->path,strrpos($attachment->path, '.'));
        $file_path   =   PIC_PATH.'/attachment/'.$attachment->path;
        if (!file_exists($file_path)) {   //检查文件是否存在
            //echo 'cc';exit;
            $this->Redirect(array("/site/error"));
        }   else {
            $file   =   fopen($file_path, "r ");   //   打开文件
            //   输入文件标签
            Header( "Content-type:   application/octet-stream ");
            Header( "Accept-Ranges:   bytes ");
            Header( "Accept-Length:   ".filesize($file_path));
            Header( "Content-Disposition:   attachment;   filename= " . $file_name);
            //   输出文件内容
            echo fread($file,filesize($file_path));
            fclose($file);
        }
    }


    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        if(Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel();
            $file = PIC_PATH.'/attachment/'.$this->_model->path;
            $this->changeBuidModel($this->_model->buid_id, $this->_model->buid_type, $this->_model->att_type, 0);
            $upUid = $this->_model->up_uid;
            $description = "您上传的".Attachment::$buidTypeName[$this->_model->buid_type].$this->_model->buid_id . Attachment::$attTypeName[$this->_model->att_type]."未通过审核，感谢您对我们的支持。";
            $this->_model->delete();
            file_exists($file) && unlink($file);
            $msgModel = new Msg();
            $msgModel->msg_sendid = 0;
            $msgModel->msg_revid = $upUid;
            $msgModel->msg_title = '附件审核通知';
            $msgModel->msg_content = $description;
            $msgModel->msg_time = time();
            $msgModel->save();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    /*
     array(
			'msg_id' => 'Msg',
			'msg_sendid' => '发信人',
			'msg_revid' => '收信人',
			'msg_title' => '标题',
			'msg_content' => '正文',
			'msg_type' => '类型',
			'msg_time' => '发送时间',
			'msg_senddel' => '发送者是否删除',
			'msg_revdel' => '接收者是否删除',
			'msg_isread' => '是否阅读',
		);
     * 
     */
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionChecked() {
        if(Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $_GET['id'] = $_POST['id'];
            $this->loadModel();
            $this->_model->isuse=1;
            $this->_model->money = empty($_POST['downloadmoney'])?'0':(int)$_POST['downloadmoney'];
            $this->changeBuidModel($this->_model->buid_id, $this->_model->buid_type, $this->_model->att_type, $this->_model->id);
            $this->_model->save();

            $money = empty($_POST['remoney'])?'0':(int)$_POST['remoney'];
            if ($money) {
                $description = "您上传的".Attachment::$buidTypeName[$this->_model->buid_type].$this->_model->buid_id . Attachment::$attTypeName[$this->_model->att_type]."通过审核，系统赠送{:money}商务币";
                Userproperty::model()->addMoney($this->_model->up_uid, $money, $description);
            }
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria;
        $defaut = TRUE;
        if( ! empty ($_GET['atttype']) ) {
            $criteria->addColumnCondition(array("att_type"=>$_GET['atttype']));
            $defaut = FALSE;
        }
        if( ! empty ($_GET['buidtype']) ) {
            $criteria->addColumnCondition(array("buid_type"=>$_GET['buidtype']));
            $defaut = FALSE;
        }
        if( ! empty ($_GET['buidid']) ) {
            $criteria->addColumnCondition(array("buid_type"=>$_GET['buidid']));
            $defaut = FALSE;
        }
        //$_GET['buidid'] = '123';
        //$criteria->addNotInCondition("spn_sourcetype",array("3"));
        //$criteria->group = 'up_uid';//buid_id,up_uid
        $criteria->order = "id desc";
        $dataProvider=new CActiveDataProvider('Attachment',array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
        ));
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
    /**
     * .
     */
    public function actionCreate() {
        $maxSize = 10;//单位MB
        if( ! empty($_FILES)) {
            //print_r($_FILES['attachment']);exit;
            $attext = strtolower(substr($_FILES['attachment']['name'],strrpos($_FILES['attachment']['name'], '.')+1));
            if( ! in_array($attext, array('rar','zip'))) {
                throw new CHttpException(404,'The type of the upload file\'s extensions is not supported.');
            }
            if( ! $_FILES['attachment']['size'] > $maxSize*1048576){
                throw new CHttpException(404,'The size of the upload file is out of '.$maxSize.'MB.');
            }
            $buid_type = $_POST['buidtype'];
            $buid_id = $_POST['buidid'];
            $att_type = $_POST['atttype'];
            $money = empty($_POST['downloadmoney'])?'0':$_POST['downloadmoney'];

            $path = PIC_PATH.'/attachment/'.date('Y');
            !is_dir($path) && mkdir($path);
            $path.='/'.date('m');
            !is_dir($path) && mkdir($path);
            $attext = md5(microtime()).'.'.$attext;
            $targetFile =  rtrim($path, "/\\").'/'.$attext;
            //echo strlen(date('Y/m/').$attext),'<br />',date('Y/m/').$attext;
            $tempFile = $_FILES['attachment']['tmp_name'];

            if(move_uploaded_file($tempFile,$targetFile)) {
                $model = new Attachment();
                $model->buid_type = $buid_type;
                $model->buid_id = $buid_id;
                $model->att_type = $att_type;
                $model->up_uid = Yii::app()->user->id;
                $model->path = date('Y/m/').$attext;
                $model->isuse = 1;//直接通过
                $model->money = $money;
                $model->time = time();
                if($model->save() )
                    $this->changeBuidModel($model->buid_id, $model->buid_type, $model->att_type, $model->id);
                Yii::app()->user->setFlash('showMessage','附件上传成功');
                Yii::app()->user->setFlash('seconds','3');

                $this->Redirect(array("/attachment/index","menu"=>@$_GET['menu']));
            }else
                throw new CHttpException(404,'Move uploaed file error.');
        }
        $buid_type = isset($_GET['type'])?(int)$_GET['type']:0;
        $buid_id = isset($_GET['id'])?(int)$_GET['id']:0;
        $att_type = isset($_GET['atttype'])?(int)$_GET['atttype']:0;
        $name = '';
        if( $buid_id ) {
            if($buid_type === 1) {
                $mode=Systembuildinginfo::model()->findbyPk($buid_id);
                if($mode) $name = $mode->sbi_buildingname;
            }elseif($buid_type === 2) {
                $mode=Communitybaseinfo::model()->findbyPk($buid_id);
                if($mode) $name = $mode->comy_name;
            }
        }
        if(empty($name)) exit("Buiding not exists.");
        $this->render('create',array(
                'buidtype'=>$buid_type,
                'atttype'=>$att_type,
                'buidid'=>$buid_id,
                'name'=>$name,
                'maxSize'=>$maxSize,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model=new Attachment('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Attachment']))
            $model->attributes=$_GET['Attachment'];

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
                $this->_model=Attachment::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function changeBuidModel($id,$type,$attType,$isuse) {
        if($type == 1) {
            $mode=Systembuildinginfo::model()->findbyPk($id);
            if( $mode ) {
                if($attType == 1)
                    $mode->sbi_loushu = $isuse;
                else
                    $mode->sbi_hetong = $isuse;
            }
        } else {
            $mode=Communitybaseinfo::model()->findbyPk($id);
            if( $mode ) {
                if($attType == 1)
                    $mode->comy_loushu = $isuse;
                else
                    $mode->comy_hetong = $isuse;
            }
        }
        if( ! $mode )
            throw new CHttpException(404,'没有找到相应的楼盘。');
        else
            if(!$mode->save() ) print_r($mode->errors);
    }
    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='attachment-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
