<?php
class PanoramaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

    /**
	 * Displays a particular model.
	 */
	public function actionPanoramaView()
	{
        $this->layout = "frame";
        $model = $this->loadModel();
		$this->render('panoramaView',array(
			'panoramaUrl'=>$model->p_url,
		));
	}
    public function actionUploadPanorama(){
        $p_ptype = 1;
        if(isset($_GET['p_ptype']) && in_array($_GET['p_ptype'], array(1,2,3))){
            $p_ptype = $_GET['p_ptype'];
        }
        if($p_ptype == 2){
            $building = Communitybaseinfo::model()->findByPk($_GET['id']);//小区信息
        }elseif($p_ptype == 3){
            $building = Creativeparkbaseinfo::model()->findByPk($_GET['id']);//创意园区
        }else{
            $building = Systembuildinginfo::model()->findByPk($_GET['id']);//楼盘信息
        }     
        if($building){
            $model = new Panorama;
            $model->p_buildingid = (int)$_GET['id'];
            $model->p_url = _PANORAMA.DS.Panorama::model()->randomFolderName();
            $fileForm = new UploadPanoramaFileForm();
            if(isset($_POST['Panorama'])) {//包含上传表单信息
                $model->attributes=$_POST['Panorama'];
                $uploadType = $_POST['uploadType'];
                if($model->validate()){
                    if($uploadType==1){//直接上传全景
                        if($fileForm->validate()){
                            $file=CUploadedFile::getInstance($fileForm, 'panoramaFile');
                            $updateFileDir = $model->p_url;
                            $uploadResult = Panorama::model()->uploadPanoramaContent($file,$updateFileDir);
                            if($uploadResult){//上传成功
                                $dba = dba();
                                $model->p_id = $dba->id('35_panorama');
                                $model->p_uploadtime = time();
                                $model->p_ptype = $p_ptype;
                                if($model->save()){
                                    Yii::app()->user->setFlash('uploadFile','全景上传成功');
                                }
                            }else{
                                Yii::app()->user->setFlash('buildingView','全景上传失败');
                            }
                            $this->redirect(array("buildingView",'id'=>$model->p_buildingid, 'p_ptype'=>$p_ptype));
                        }
                    }else{//稍后上传全景
                        $dba = dba();
                        $model->p_id = $dba->id('35_panorama');
                        $model->p_uploadtime = time();
                        Panorama::model()->uploadPanoramaLater($model->p_url);
                        if($model->save()){
                            Yii::app()->user->setFlash('uploadFile','全景文件夹生成成功，请尽快上传全景');
                            if($p_ptype == 2){
                                $this->redirect(array("buildingView",'id'=>$building->comy_id, 'p_ptype'=>$p_ptype));
                            } else {
                                $this->redirect(array("buildingView",'id'=>$building->sbi_buildingid, 'p_ptype'=>$p_ptype));
                            }
                        }
                    }
                }
            }
            $this->render('uploadPanorama',array(
                'model'=>$model,
                'fileForm'=>$fileForm,
                'building'=>$building,
                'titleDescription'=>'上传全景房源'
            ));
        }else{//没有找到楼盘信息
            throw new CHttpException(400,'非法的请求. 请不要再访问这个链接.');
        }
    }
    /**
     * 设为楼盘标题全景
     */
    public function actionSetTitle(){
        $sysid = $_GET['sysid'];
        $pid = $_GET['pid'];
        $model = Panorama::model()->findByPk($pid);
        if($model){
            $sysmodel = Systembuildinginfo::model()->findByPk($sysid);
            if($sysmodel){
                $sysmodel->sbi_titlepanorama = $pid;
                if($sysmodel->save()){
                    Yii::app()->user->setFlash('uploadFile','设置标题图成功');
                }else{
                    Yii::app()->user->setFlash('uploadFile','设置标题图失败');
                }
            }
        }
        $this->Redirect(array("buildingView","id"=>$sysid));
    }
	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Panorama']))
		{   
			$model->attributes=$_POST['Panorama'];
			if($model->save()){
                $this->redirect(array('view','id'=>$model->p_id));
            }				
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel();
            $filePath = PIC_PATH.$model->p_url;
            $this->throwToRecycle($filePath);

            $model->delete();//不用去判断文件是否删除掉
            Yii::app()->user->setFlash('uploadFile','全景删除成功');
           
            if(!isset($_GET['ajax']))
                header('Location:'.$_SERVER['HTTP_REFERER']);//返回上一个页面
		}
		else
			throw new CHttpException(400,'非法的请求.请不要再重复访问这个链接.');
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        //都跑到管理页面去
        $this->Redirect(array("admin"));
//		$dataProvider=new CActiveDataProvider('Systembuildinginfo');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
	}
    /**
     * 楼盘全景展示
     */
    public function actionBuildingView()
	{
        $p_ptype = 1;
        if(isset($_GET['p_ptype']) && in_array($_GET['p_ptype'], array(1,2,3))){
            $p_ptype = $_GET['p_ptype'];
        }
        if ($p_ptype == 2) {
            $model = Communitybaseinfo::model()->findByPk($_GET['id']);
        }elseif($p_ptype == 3){
            $model = Creativeparkbaseinfo::model()->findByPk($_GET['id']);
        } else {
            $model = Systembuildinginfo::model()->findByPk($_GET['id']);
        }
        $allPanoramas = Panorama::model()->findAllByAttributes(array('p_buildingid'=>$_GET['id'], 'p_ptype'=>$p_ptype));
        $allPanoramas = $this->groupPanoramasByType($allPanoramas);
		$this->render('buildingView',array(
            'p_ptype'=>$p_ptype,
            'model'=>$model,
			'allPanoramas'=>$allPanoramas,
		));
    }
    protected function groupPanoramasByType($panoramas){
        $result = array();
        $typeArray = array_keys(Panorama::$typeDescription);
        foreach($panoramas as $panorama){
            if(in_array($panorama->p_type,$typeArray)){
                $result[$panorama->p_type][] = $panorama;
            }
        }
        return $result;
    }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Panorama('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Panorama']))
			$model->attributes=$_GET['Panorama'];

		$this->render('admin',array(
			'model'=>$model,
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
				$this->_model=Panorama::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='panorama-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    //将文件扔到回收站里
    protected function throwToRecycle($filePath){
        //不扔回收站，要直接删除全景
        common::deldir($filePath);
        return true;
    }
}
