<?php

class BusinesscenterController extends Controller
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
		$model=new Businesscenter;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Businesscenter']))
		{
			$model->attributes=$_POST['Businesscenter'];
            $model->bc_releasetime = time();
            $this->formatAttributes($model);

			if($model->save())
				$this->redirect(array('view','id'=>$model->bc_id));
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

		if(isset($_POST['Businesscenter']))
		{
			$model->attributes=$_POST['Businesscenter'];
            $this->formatAttributes($model);
			if($model->save())
				$this->redirect(array('view','id'=>$model->bc_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    protected function formatAttributes($model){
        Yii::import('application.common.Pinyin');
        $p = new Pinyin();
        $pingyin = $p->doWord($model->bc_name);
        
        $model->bc_completetime = strtotime($_POST['bc_completetime']);
        $model->bc_pinyinshortname = $pingyin['short'];
        $model->bc_pinyinlongname = $pingyin['long'];
        $model->bc_traffic = Systembuildinginfo::model()->formatSerializeValue("bc_traffic", array("轨道交通","高架","机场","公交车","火车站"));
        $model->bc_peripheral = Systembuildinginfo::model()->formatSerializeValue("bc_peripheral", array("临近商街","商场","酒店","银行","餐饮"));
        if($model->bc_freeserver)
                $model->bc_freeserver = implode(',', $model->bc_freeserver);
        if($model->bc_payserver)
                $model->bc_payserver = implode(',', $model->bc_payserver);

        $model->attributes = array_map('trim',$model->attributes);
    }
    /**
     * 序列化输入的参数
     * @param <string> $key post中的键名
     * @param <array> $templete 保存的所有数据
     * @param <string or array> $emptyValue 没有传值时使用的数据 如果是string则表示全部都使用此值，array只指定其中的部分空值，未指定的使用空
     * @return <type> 可用于保存的数据
     */
    protected function formatSerializeValue($key,$templete,$emptyValue=""){
        $return = array();
        foreach($templete as $value){
            $postkey = "\'".$value."\'";
            if(isset($_POST[$key])&&isset($_POST[$key][$postkey])){
                $return[$value] = $_POST[$key][$postkey];
            }else{
                if(is_array($emptyValue)){
                    if(array_key_exists($value, $emptyValue)){//假如指定了空值
                        $return[$value] = $emptyValue[$value];
                    }else{
                        $return[$value] = "";
                    }
                }else{
                    $return[$value] = $emptyValue;
                }
            }
        }
        return serialize($return);
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
		$dataProvider=new CActiveDataProvider('Businesscenter');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Businesscenter('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Businesscenter']))
			$model->attributes=$_GET['Businesscenter'];

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
				$this->_model=Businesscenter::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='businesscenter-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
     /**
     * 商务中心合并
     */
    public function actionMerger(){

        if($_POST&&!empty($_POST)){
          //  print_r($_POST);
            $fromId = $_POST["frombusinesscenterid"];
            $toId = $_POST["tobusinesscenterid"];

            $fromModel = Businesscenter::model()->findByPk($fromId);
            $toModel = Businesscenter::model()->findByPk($toId);

            foreach($_POST as $key=>$value){
                if($value=="on"){//要使用原商务中心的数据。
                    $toModel[$key] = $fromModel[$key];
                }
            }

           $toModel->update();
           
           $fromModel->delete();

            //替换全景
           Subpanorama::model()->updateAll(array("spn_sourceid"=>$toId),"spn_sourceid=".$fromId." and spn_sourcetype=3");
           // 替换图片
           Picture::model()->updateAll(array("p_sourceid"=>$toId),"p_sourceid=".$fromId." and p_sourcetype=3");
          
            Yii::app()->user->setFlash('message','合并商务中心成功！');
            $this->redirect("merger");
        }
        $this->render("merger");
    }
    /*
     * 获取商务中心资料
     */
    public function actionGetBusinesscenter(){

        $id = $_GET["id"];
        $return = "error";
        $info = Businesscenter::model()->findByPk($id);
        if($info){
            $arr = $info->attributes;
            $arr["bc_name"] = CHtml::link($arr["bc_name"],MAINHOST."/Businesscenter/view/id/".$arr["bc_id"],array("target"=>"_blank"));
            $array=array("bc_traffic","bc_peripheral");
            foreach($array as $val){
                $arr[$val]=$arr[$val]?Creativeparkbaseinfo::model()->getStrByArray(unserialize($arr[$val]),"","<br/><br/>"):"";
            }
            $return = json_encode($arr);
        }
      
       echo $return;exit;
    }
  

}
