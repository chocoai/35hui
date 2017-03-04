<?php

class MembercommentsupportController extends Controller
{
	public function actionCreate()
	{
        if(Yii::app()->user->isGuest){
            echo "请先登录！";exit;
        }
        $id = $_POST["id"];
        $mcModel = Membercomment::model()->findByPk($id);
		if(!$mcModel){
            echo "参数错误！";exit;
        }
        //检查是否已经支持过
        if(!Membercommentsupport::model()->checkCanSupport($id)){
            echo "您已经支持过本评论！";exit;
        }
        $mcModel->mc_supportnum += 1;
        $mcModel->update();
        $model = new Membercommentsupport();
        $model->mcs_userid = User::model()->getId();
        $model->mcs_mcid = $id;
        $model->mcs_createtime = time();
        $model->save();
        echo "success";exit;
	}
}