<?php

class UserspeakController extends Controller
{
    public $layout = "user";
	public function actionIndex()
	{
        $userModel = User::model()->findByPk($_GET['id']);
        if(!$userModel||$userModel->u_role==User::ROLE_AUDIENCE){
            throw new CHttpException(404,'页面不存在');
        }
        $this->uid = $userModel->u_id;

        /*说说*/
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("us_userid"=>$userModel->u_id));
        $criteria->order = "us_creattime desc";
        $dataProvider =  new CActiveDataProvider("Userspeak", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
		$this->render('index',array(
            "userModel"=>$userModel,
            "dataProvider"=>$dataProvider
        ));
	}
    public function actionView(){
        $speakModel = Userspeak::model()->findByPk($_GET["id"]);
        if(!$speakModel){
            throw new CHttpException(404,'页面不存在');
        }
        $userModel = User::model()->findByPk($speakModel->us_userid);
        if(!$userModel||$userModel->u_role==User::ROLE_AUDIENCE){
            throw new CHttpException(404,'页面不存在');
        }
        $this->uid = $userModel->u_id;

        /*关于此动态的所有评论*/
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("usc_usid"=>$speakModel->us_id));
        $criteria->addCondition("usc_replyuscid='0'");
        $criteria->order = "usc_createtime desc";
        $dataProvider =  new CActiveDataProvider("Userspeakcomment", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),

        ));

        $this->render('view',array(
            "speakModel"=>$speakModel,
            "userModel"=>$userModel,
            "dataProvider"=>$dataProvider
        ));
    }
    public function actionAddSpeakComment(){
        $userId = User::model()->getId();
        if(!$userId){
            echo "请先登录";exit;
        }
        $speakId = $_POST["speakId"];
        $content = $_POST["content"];

        if(Userspeakcomment::model()->addComment($speakId, 0, $content)){
            echo "success";exit;
        }
        echo "输入的内容太长";exit;
    }
    public function actionGetBoardOrder(){
        $va = $_POST["va"];
        $view = $_POST["view"];
        $templete = array("today","week","month");
        if(array_search($va,$templete)===false){
            $va = "today";//默认本日
        }
        $key = array(
            "today"=>array("mem_todayredboard","mem_todayredboardtime",date("Ymd")),
            "week"=>array("mem_weekredboard","mem_weekredboardtime",date("YW")),
            "month"=>array("mem_monthredboard","mem_monthredboardtime",date("Ym")),
        );
        /*查找所有今天没获得红牌的用户。并把时间清空*/
        Member::model()->updateAll(array($key[$va][0]=>0,$key[$va][1]=>0),$key[$va][1]."!=".$key[$va][2]." and ".$key[$va][1]."!=0");
        $criteria=new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = $key[$va][1]." desc, ".$key[$va][0]." desc";
        $boardOrder = Member::model()->findAll($criteria);
        $this->renderPartial($view,array(
            "boardOrder"=>$boardOrder,
            "va"=>$va,
            "key"=>$key
        ));
        exit;
    }
}