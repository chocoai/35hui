<?php
class MainController extends Controller
{
    public $defaultCenterAction = "/manage/main/newindex";
    public function filters()
    {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }
    
    public function accessRules()
    {
        return array(
                array("allow",
                        "actions"=>array("comindex"),
                        'roles'=>array(
                                Yii::app()->params['company']
                        ),
                ),
                array("allow",
                        "actions"=>array("uagentindex"),
                        'roles'=>array(
                                Yii::app()->params['agent']
                        ),
                ),
                array("allow",
                        "actions"=>array("perindex"),
                        'roles'=>array(
                                Yii::app()->params['personal']
                        ),
                ),
                array('allow',
                        'actions'=>array("index","NewIndex",'Error',"uncheck"),
                        'users'=>array('@'),//注册用户都可以使用
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionIndex()
    {
        $this->layout="default";
        isset($_GET["url"])&&$_GET["url"]?$this->defaultCenterAction = $_GET["url"]:"";
        $this->render('index');
    }
    /**
     * 还未审核
     */
    public function actionUnCheck(){
        $type = @$_GET["type"];
        $this->render('uncheck',array("type"=>$type));
    }
    public function actionNewIndex(){
        switch(User::model()->getCurrentRole()) {
            case User::personal:
                $this->redirect(array('perindex'));
                break;
            case User::company:
                $this->redirect(array('comindex'));
                break;
            case User::agent:
                $this->redirect(array('uagentindex'));
                break;
        }
    }
    public function actionPerIndex(){
        $usrid = Yii::app()->user->id;

        $noRead=Msg::model()->unreadcount($usrid);//未读短消息
        $pointLogs = Log::model()->getCurrentUserLogsByType(Log::integral);
        $moneyLogs = Log::model()->getCurrentUserLogsByType(Log::money);

        $notice = Post::model()->getNewestPost();//最新公告
        $this->render('perindex',array(
                'noRead'=>$noRead,
                "pointLogs"=>$pointLogs,
                "moneyLogs"=>$moneyLogs,
                "notice"=>$notice,
        ));
    }
    public function actionComIndex(){
        $this->render('comindex',array(
        ));
    }
    public function actionUagentIndex(){
        $usrid = Yii::app()->user->id;
        $noRead=Msg::model()->unreadcount($usrid);//未读短消息
        $pointLogs = Log::model()->getCurrentUserLogsByType(Log::integral);
        $notice = Post::model()->getNewestPost();//最新公告
        $this->render('uagentindex',array(
                'noRead'=>$noRead,
                "pointLogs"=>$pointLogs,
                'notice'=>$notice,
        ));
    }
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if( ($error=Yii::app()->errorHandler->error) ) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }else{
             $this->render('error');
        }
    }
}