<?php

class CreativeparkbaseinfoController extends Controller
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
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Creativeparkbaseinfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Creativeparkbaseinfo']))
		{
			$model->attributes=$_POST['Creativeparkbaseinfo'];
            $this->formatAttributes($model);
			if($model->save())
				$this->redirect(array('view','id'=>$model->cp_id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Creativeparkbaseinfo']))
		{
			$model->attributes=$_POST['Creativeparkbaseinfo'];
            $this->formatAttributes($model);
			if($model->save())
				$this->redirect(array('view','id'=>$model->cp_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    protected function formatAttributes($model){
        Yii::import('application.common.Pinyin');
        $p = new Pinyin();
        $pingyin = $p->doWord($model->cp_name);

        $model->cp_openingtime = strtotime($_POST['cp_openingtime']);
        $model->cp_pinyinshortname = $pingyin['short'];
        $model->cp_pinyinlongname = $pingyin['long'];
        $model->cp_traffic = serialize(array_map('trim',$_POST['cp_traffic']));
        $model->cp_peripheral = serialize(array_map('trim',$_POST['cp_peripheral']));
        $model->cp_carport = serialize(array_map('trim',$_POST['cp_carport']));
        if($model->cp_propertyserver)
                $model->cp_propertyserver = implode(',', $model->cp_propertyserver);
        if($model->cp_roommating)
                $model->cp_roommating = implode(',', $model->cp_roommating);
        $model->cp_releasedate = time();

        $model->attributes = array_map('trim',$model->attributes);
    }
    public function actionFiltersource(){
        $model = $this->loadModel();
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("cr_cpid"=>$model->cp_id,"cr_check"=>4));
        
        $criteria->order = "cr_dayrentprice asc";
        
        $dataProvider = new CActiveDataProvider("Creativesource", array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),

		));
        $this->render("filtersource",array(
            "model"=>$model,
            "dataProvider"=>$dataProvider,
        ));
    }
    public function actionChangeXiezilouState(){
        $id = $_POST["id"];
        if(isset($_POST["chk"])&&$_POST["chk"]){
            $criteria=new CDbCriteria;
            $criteria->addInCondition("cr_id",$_POST["chk"]);
            $all = Creativesource::model()->findAll($criteria);

            $userInfo = array();
            foreach($all as $value){
                $userInfo[$value->cr_userid][] = $value->cr_id;
                //设置下线
                $value->cr_check = 8;
                $value->update();
            }
            //发布站内信
            foreach($userInfo as $key=>$value){
                $contentArr = array();
                foreach($value as $l){
                    $contentArr[] = CHtml::link($l,array("creativesource/view","id"=>$l),array("target"=>"_blank"));
                }
                $content = "房源".implode("、", $contentArr)."由于房价太低，怀疑为虚假房源，系统强制下线！";
                Msg::model()->sendMessage("0", $key, "房源下线通知", $content);
            }
        }
        Yii::app()->user->setFlash('message','房源下线成功！');
        $this->redirect(array("filtersource","id"=>$id));
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
			$this->loadModel()->delete();
            Creativedong::model()->deleteAll('cd_cpid='.$this->loadModel()->cp_id);
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Creativeparkbaseinfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Creativeparkbaseinfo']))
			$model->attributes=$_GET['Creativeparkbaseinfo'];

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
    /**
     * 创意园合并
     */
    public function actionMerger(){
       
        if($_POST&&!empty($_POST)){     
            $fromId = $_POST["fromcreativeparkid"];
            $toId = $_POST["tocreativeparkid"];

            $fromModel = Creativeparkbaseinfo::model()->findByPk($fromId);
            $toModel = Creativeparkbaseinfo::model()->findByPk($toId);

            foreach($_POST as $key=>$value){
                if($value=="on"){//要使用原创意园的数据。
                    $toModel[$key] = $fromModel[$key];
                }
            }

           $toModel->update();
           $fromModel->delete();
            //替换全景
           Panorama::model()->updateAll(array("p_buildingid"=>$toId),"p_buildingid=".$fromId." and p_ptype=3");
           // 替换图片
           Picture::model()->updateAll(array("p_sourceid"=>$toId),"p_sourceid=".$fromId." and p_sourcetype=9");
            //替换写字楼房源
           Creativesource::model()->updateAll(array("cr_cpid"=>$toId),"cr_cpid=".$fromId);
            Yii::app()->user->setFlash('message','合并创意园成功！');
            $this->redirect("merger");
        }
        $this->render("merger");
    }
    /*
     * 获取创意园资料
     */
    public function actionGetCreativeparkbaseinfo(){
       
        $id = $_GET["id"];
        $return = "error";
        $info = Creativeparkbaseinfo::model()->findByPk($id);
        if($info){
            $arr = $info->attributes;
            $arr["cp_name"] = CHtml::link($arr["cp_name"],MAINHOST."/creativeparkbaseinfo/view/id/".$arr["cp_id"],array("target"=>"_blank"));
            $model=new Creativeparkbaseinfo;
            $array=array("cp_peripheral","cp_carport","cp_traffic");
            foreach($array as $key=>$val){
             $arr[$val]=$arr[$val]?$model->getStrByArray($model->ArrayKeyReplice(unserialize($arr[$val]),$key+1),"","<br/><br/>"):"";
            }
            $return = json_encode($arr);       
        }
       echo $return;exit;
    }       
}
