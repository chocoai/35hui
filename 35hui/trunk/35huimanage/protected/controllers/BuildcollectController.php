<?php

class BuildcollectController extends Controller
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
	public function actionView()
	{
        $model=$this->loadModel();
        $buildname=trim($model->bc_buildname);
        $buildname=str_replace(array('广场','大厦','大楼','上海'),'',$buildname);
        //Shopbaseinfo::model()->findAll('ob_');
        $likeBuilds=Systembuildinginfo::model()->findAll(array(
            'select'=>'sbi_buildingid,sbi_buildingname,sbi_district,sbi_section,sbi_loop,sbi_address','condition'=>"`sbi_buildingname` LIKE '%{$buildname}%'")
            );
		$this->render('view',array(
			'model'=>$model,
            'likeBuilds'=>$likeBuilds,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
        $model = $this->loadModel();
        if($model&&$model->bc_state!=0){
            $model->delete();
            $this->Redirect(array("index"));
        }else{
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria=new CDbCriteria;
        $state=isset($_GET['state']) && strstr('012',$_GET['state'])?$_GET['state']:0;
        $criteria->addCondition("bc_state='$state'");
        $criteria->order = "bc_releasetime desc";
		$dataProvider=new CActiveDataProvider('Buildcollect',array(
                'criteria'=>$criteria,
                'pagination'=>array(
                        'pageSize'=>20,
                )
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'state' => $state,
            'bc_state' => Buildcollect::$bc_state
		));
	}

    public function actionAudit(){
        $type = $_GET['type'];
        $model = $this->loadModel();
        if($model&&$model->bc_state==0){//只有未审核状态才能审核
            if($type=="pass"){//审核通过
                $model->delete();
                $this->redirect(array('/systembuildinginfo/update','id'=>$model->bc_sysid));//systembuildinginfo/update/id/1325
            }elseif($type=="unpass"){//审核不通过
                //删除楼盘表数据
                $sysmodel = Systembuildinginfo::model()->findByPk($model->bc_sysid);
                if($sysmodel){
                    $sysmodel->delete();
                }
                //$model->bc_state = 2;
                $model->delete();
            }
        }
        $this->Redirect(array("index"));
    }
    /**
     * 匹配已有楼盘
     */
    public function actionMatch(){
        $model = $this->loadModel();
        $matchSB = Systembuildinginfo::model()->findByPk($_GET['mid']);
        if($matchSB){//sbi_buildingid ob_releasedate
            Officebaseinfo::model()->updateAll(array(
                'ob_sysid'=>$matchSB->sbi_buildingid,
                'ob_officename'=>$matchSB->sbi_buildingname), 'ob_sysid='.$model->bc_sysid);
            Shopbaseinfo::model()->updateAll(array('sb_sysid'=>$matchSB->sbi_buildingid,), 'sb_sysid='.$model->bc_sysid);
            if( ($old=Systembuildinginfo::model()->findByPk($model->bc_sysid)) ) {
                $old->delete();
            }
            $model->delete();
        }
        $this->redirect(array("index"));
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
				$this->_model=Buildcollect::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
