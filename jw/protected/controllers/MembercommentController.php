<?php

class MembercommentController extends Controller
{
	public function actionCreate()
	{
		$fromuserid = $_POST["userId"];
        $content = $_POST["content"];
        $model = new Membercomment();
        $model->mc_userid = $fromuserid;
        $model->mc_fromuserid = User::model()->getId();
        $model->mc_content = $content;
        $model->mc_createtime = time();
        if($model->save()){
            echo "success";exit;
        }
        echo "输入内容太长";exit;
	}
}