<?php
class MemberrecommendController extends Controller {
    public $layout = "manage";
    public function actionView() {
        $userId = $_GET["uid"];
        $memberModel = Member::model()->findByAttributes(array ("mem_userid"=>$userId));
        if(!$memberModel){
            throw new CHttpException(404,'页面不存在');
        }
        /*推荐记录*/
        
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("mr_userid"=>$memberModel->mem_userid));
        $criteria->order = "mr_recommendtime desc";
        $memberRecommend = Memberrecommend::model()->findAll($criteria);
        $userModel = User::model()->getUserInfoById($memberModel->mem_userid);
        $this->render("view",array(
            "memberRecommend"=>$memberRecommend,
            "memberModel"=>$memberModel,
            "userModel"=>$userModel
        ));
    }
    public function actionCreate(){
        $userId = $_POST["usreid"];
        if(!Memberrecommend::model()->checkCanRecommend($userId)){
            echo "今日此用户已经推荐！不能重复推荐！";exit;
        }
        $model = new Memberrecommend();
        $model->mr_userid = $userId;
        $model->mr_recommendtime = strtotime(date("Y-m-d"));
        $model->mr_createtime = time();
        $model->save();
        //修改总推荐数目;
        $memberModel = Member::model()->findByAttributes(array ("mem_userid"=>$userId));
        $memberModel->mem_allrecommentnum += 1;
        $memberModel->mem_lastrecommenttime = $model->mr_recommendtime;
        $memberModel->update();
        echo "success";exit;
    }
}