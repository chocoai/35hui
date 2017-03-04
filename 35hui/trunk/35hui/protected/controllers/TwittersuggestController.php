<?php

class TwittersuggestController extends Controller
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
				'actions'=>array('create','suggest','index','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /**
     * 楼盘播报
     */
    public function actionSuggest(){
        if(!empty($_POST['buidid']) && !empty($_POST['content'])){
            $model=new Twittersuggest();
            $dba = dba();
            $model->ts_id = $dba->id('35_twittersuggest');
            $model->ts_userid = Yii::app()->user->id;
            $model->ts_buildingid = (int)$_POST['buidid'];
            $model->ts_content = trim($_POST['content']);
            $model->ts_suggesttime = time();
            $model->ts_type=(int)$_POST['buidtype'];
            if($model->save()){
                Yii::app()->user->setFlash('showMessage','播报成功');
            }else{
                Yii::app()->user->setFlash('showMessage','播报失败');
            }
            
        }
        $this->redirect(array("index"));
        
    }
    /**
     * 
     */
    public function actionIndex(){
        $userId = Yii::app()->user->id;
        switch(User::model()->getCurrentRole()) {
            case User::personal :
                $this->layout='personal';
                break;
            case User::company :
                $this->layout='ucom';
                break;
            case User::agent :
                $this->layout='uagent';
                break;
            default:
                $this->redirect('/site/error');
                break;
        }
        $buid_type = isset($_GET['type'])?(int)$_GET['type']:0;
        $buid_id = isset($_GET['id'])?(int)$_GET['id']:0;
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

        $dataProvider = new CActiveDataProvider("Twittersuggest", array(
			'criteria'=>array(
                'condition'=>'ts_userid='.Yii::app()->user->id,
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
		));
        if(isset($_GET['suggest'])){
            if($_GET['suggest']=='2'){
                $dataProvider = new CActiveDataProvider("Twitter", array(
                    'criteria'=>array(
                        'condition'=>'t_userid='.Yii::app()->user->id,
                    ),
                    'pagination'=>array(
                        'pageSize'=>20,
                    ),
                ));
            }
        }
        $this->render('index',array(
            'buid_type'=>$buid_type,
            'buid_id'=>$buid_id,
            'name'=>$name,
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionDelete(){
        if(!empty($_GET['id'])){
            $model=Twittersuggest::model()->findByPk((int)$_GET['id']);
            if($model && $model->ts_userid==Yii::app()->user->id){
                $model->delete();
                Yii::app()->user->setFlash('showMessage2','删除成功');
            }
        }
        $this->redirect(array("index"));
    }

    /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $va = va();
        $va->check(array(
            'buildingId'=>array('not_blank','uint'),
            'content'=>array('not_blank')
        ));
        if($va->success){
            $model=new Twittersuggest;
            $dba = dba();
            $model->ts_id = $dba->id('35_twittersuggest');
            $model->ts_userid = Yii::app()->user->id;
            $model->ts_buildingid = $va->valid['buildingId'];
            $model->ts_content = $va->valid['content'];
            $model->ts_suggesttime = time();
            if($model->save()){
                echo "success";
            }else{
                echo "微博太长，录入失败！";
            }
        }else{
            echo "微博不能为空！";
        }
	}
}
