<?php

class QuickrequireController extends Controller
{
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
        		'maxLength'=>'4',
              	'minLength'=>'4',
                'testLimit'=>'30',//三次之后更新验证码
            ),
        );
    }
	public function actionaddRequire(){
        $quicerequire=new Quickrequire;
        if(isset($_POST['ajax']) && $_POST['ajax']==='Quickrequire-form')
		{
			echo CActiveForm::validate($quicerequire);
			Yii::app()->end();
		}
        if(isset($_POST['Quickrequire']))
        {
//           if(isset($_POST['Quickrequire']['verify'])){
//                 //获取验证码内容
//                 $checkVerify = $this->createAction('captcha')->validate($_POST['Quickrequire']['verify'],false);
//                 if($checkVerify){
                                if (!$_POST['Quickrequire']["qrq_require"]||$_POST['Quickrequire']["qrq_require"] == "请在这里写下您的寻租或投资需求，我们将在一个工作日之内与您联系。（如：浦东新区 小陆家嘴附近 8块以下 高层）") {
                                    echo "请输入需求";
                                    exit;
                                } else {
                                    $post["qrq_require"] = $_POST['Quickrequire']["qrq_require"];
                                }
                                if (!$_POST['Quickrequire']["qrq_name"]||$_POST['Quickrequire']["qrq_name"] == "请输入您的姓名") {
                                    echo "请输入您的姓名";
                                    exit;
                                } else {
                                    $post["qrq_require"] = $_POST['Quickrequire']["qrq_name"];
                                }
                                if (!$_POST['Quickrequire']["qrq_tel"]||$_POST['Quickrequire']["qrq_tel"] == "请输入您的联系方式" ) {
                                    echo "请输入您的手机号码";
                                    exit;
                                } else {
                                    $post["qrq_tel"] = $_POST['Quickrequire']["qrq_tel"];
                                }
                                $post["qrq_require"] = $_POST['Quickrequire']["qrq_require"] == "请在这里写下您的寻租或投资需求，我们将在一个工作日之内与您联系。（如：浦东新区 小陆家嘴附近 8块以下 高层）" ? "" : $_POST['Quickrequire']["qrq_require"];
                                $post["qrq_name"] = $_POST['Quickrequire']["qrq_name"] == "请输入您的姓名" ? "" : $_POST['Quickrequire']["qrq_name"];
                                $post["qrq_tel"] = $_POST['Quickrequire']["qrq_tel"] == "请输入您的联系方式" ? "" : $_POST['Quickrequire']["qrq_tel"];
                                $post["qrq_email"] = $_POST['Quickrequire']["qrq_email"] == "请输入您的邮箱" ? "" : $_POST['Quickrequire']["qrq_email"];
                                $quicerequire->attributes = $post;
                                $quicerequire->qrq_releasedate = time();
                                $quicerequire->qrq_settledate = time() + (86400 * 14);
                                if ($quicerequire->save()) {
                                    echo "您的需求已成功提交，我们会再1个工作日之内联系您，谢谢!";
                                } else {
                                    echo "请输入正确的信息以便我们录入";
                                }
//                   }else{
//                         echo "验证码错误";
//                   }
//           }else{
//               echo "请输入验证码!";
//           }
            
        }
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}