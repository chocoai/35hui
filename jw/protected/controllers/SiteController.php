<?php

class SiteController extends Controller
{
	public $layout='main';
	
    public function actionIndex(){
        $this->layout = "login";
        if(!Yii::app()->user->isGuest) {
            $this->redirect(array('/site/home'));
        }
        $model=new LoginForm;
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
            $model->attributes=$_POST;
            if($model->validate() && $model->login()){
                echo "success";exit;
            }
            echo "error";exit;
        }
        if(isset($_POST['LoginForm'])) {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('index',array('model'=>$model));
    }
    public function actionHome(){
        $albumRecommend = Albumrecommend::model()->getAllRecommend(12);
        $memberRecommend = Memberrecommend::model()->getAllRecommend(14);
		$this->render('home',array(
            "albumRecommend"=>$albumRecommend,
            "memberRecommend"=>$memberRecommend
        ));
	}

    public function actionCheckemail(){
        $errorMsg='链接地址错误';
        if(!empty($_GET['id']) && !empty($_GET['token'])){
            $time = time();
            $model = Emailcheck::model()->findByPk($_GET['id']);
            if($model && $model->ec_token==$_GET['token']){
                $user = User::model()->findByPk($model->ec_userid);
                if($user->u_emailcheck==1){//已经认证了
                    $errorMsg = '邮箱已经认证';
                }else{
                    $user->u_emailcheck = 1;
                    $user->update();
                    
                    $model->ec_acttime = $time;
                    $model->update();
                    $errorMsg = '邮箱验证成功';
                }
            }
        }
        $this->renderText($errorMsg);
    }
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

    public function actionAuthManageCreate(){
        $auth=Yii::app()->authManager;
        foreach (User::$authRolesName as $role => $name){
            if($auth->getAuthItem($role) === NULL){
                $auth->createRole($role);
                echo 'Create '.$name.' Auth<br/>';
            }else{
                echo $name.' Auth is exists<br/>';
            }
        }
        $auth->save();
    }
}