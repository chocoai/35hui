<?php

class ManageuserController extends Controller
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

    public function actionCheckuser() {
        $model = Manageuser::model()->findByAttributes(array("mag_username"=>$_POST['name']));
        if($model) {
            echo "1";//用户名重复
        }else {
            echo "0";
        }
        exit;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model=new Manageuser;

        if(isset($_POST)&&$_POST) {
            $model->attributes = $_POST;
            $model->mag_releasetime = time();
            if($model->validate()) {
                $checkModel = Manageuser::model()->findByAttributes(array("mag_username"=>$_POST['mag_username']));
                if($checkModel) {
                    $model->addError("mag_username","用户名不可用");
                }else {
                    $model->mag_password = md5($model->mag_password);//md5加密
                    $model->save();
                    $role = trim($_POST['assignment']);
                    $auth = Yii::app()->getAuthManager();
                    if( $role && $role != 'norole' && ($auth->getAuthItem($role)!==NULL) )
                        $auth->assign($role,$model->mag_userid);
                    $this->redirect(array('index'));
                }
            }
        }
        $auth = Yii::app()->getAuthManager()->getRoles();
        $roles = array();
        $roles['norole']='暂不指定角色';
        foreach ($auth as $role) {
            if($role->getName() == Yii::app()->params['systemAdministrator'])
                continue;
            $roles[$role->getName()]="[{$role->getName()}]".$role->getDescription();
        }
        $this->render('create',array(
                'model'=>$model,
                'roles'=>$roles,
        ));
    }
	/**
	 * 用户授权
	 */
	public function actionAuthorization()
	{
        if(isset($_POST['userid']) && !empty($_POST['authItems'])) {
            $userId = trim($_POST['userid']);
            $authItems = $_POST['authItems'];
            
            $deleteQueue = array();//待删除项目
            $haveItems = array();  //修改之前的项目
            $publicAuth = array(); //本次提交与$haveItems的重合项目

            if( ! empty($_POST['oldAccessItems']) ) {
                $haveItems = explode(',', $_POST['oldAccessItems']);
                $publicAuth = array_intersect($haveItems, $authItems);//重复的授权
                $deleteQueue = array_diff($haveItems, $publicAuth);
            }
            if(is_string($authItems)) $authItems=(array)$authItems;
            $addQueue = array_diff($authItems, $publicAuth);//待添加项目
            $auth = Yii::app()->getAuthManager();
            foreach($addQueue as $item)
                $auth->assign($item,$userId);
            foreach ($deleteQueue as $value)
                $auth->revoke($value,$userId);
            Manageuser::model()->clearUserMenuCache($userId);
            //echo '<script>alert("cache Workding delete by '.Manageuser::model()->clearUserMenuCache($userId).'");</script>';
            $this->redirect(array('index'));
        }
		$model=$this->loadModel();
        $auth = Yii::app()->getAuthManager();
        $sql="SELECT name, description FROM {$auth->itemTable} WHERE type!='0' ORDER BY type DESC, name ASC; ";
		$command=$auth->db->createCommand($sql);
        $allAuthItems = $command->queryAll($sql);

        $sql="SELECT itemname FROM {$auth->assignmentTable} WHERE userid=:userid";
		$command=$auth->db->createCommand($sql);
		$command->bindValue(':userid',$model->mag_userid);
		$assignments=array();
		foreach($command->queryAll($sql) as $row)
			$assignments[]=$row['itemname'];

		$this->render('authorization',array(
			'model'=>$model,
            'allAuthItems'=>$allAuthItems,
            'assignments'=>$assignments,
		));
	}
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        $model = $this->loadModel();
        if($model->mag_role!=1) {//不能删除管理员
            $model->mag_state = 2;
            $model->update();
        }
        $this->redirect(array("index"));
    }
    public function actionUpdateState() {
        $model = $this->loadModel();
        if($model->mag_role!=1&&$model->mag_state!=2) {//不能锁定管理员。不能处理已删除的
            $model->mag_state = $model->mag_state==1?0:1;//只处理0和1状态的
            $model->update();
        }
        $this->redirect(array("index"));
    }
    /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
        $model=$this->loadModel();
        if($model->mag_role!=2||$model->mag_state!=0){
            $this->redirect(array('index'));
        }
    	if(isset($_POST['Manageuser']))
		{
			$model->attributes=$_POST['Manageuser'];
			if($model->save()){
                $this->redirect(array('index'));
				//$this->redirect(array('view','id'=>$model->mag_userid));
            }else{
                echo "<script>window.location.href=window.location.href;alert('修改失败');</script>";
            }
		}

		$this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider=new CActiveDataProvider('Manageuser');
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Manageuser::model()->findbyPk($_GET['id']);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='manageuser-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
