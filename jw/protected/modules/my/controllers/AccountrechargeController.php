<?php

class AccountrechargeController extends Controller {
    public function filters() {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules() {
        return array(
                array("allow",
                        "actions"=>array("alipaynotify","buysuccess"),
                        'users'=>array('*'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'roles'=>array(
                                User::ROLE_MEMBER,
                                User::ROLE_AUDIENCE,
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionIndex() {
        $userId = User::model()->getId();
        $userModel = User::model()->getUserInfoById($userId);
        $rmb_to_gold = Config::model()->getValueByKey("rmb_to_gold");
        $this->render("index",array(
                "userModel"=>$userModel,
                "rmb_to_gold"=>$rmb_to_gold
        ));
    }
    public function actionRecharge() {
        $this->layout = "frame";
        $userId = User::model()->getId();
        if(isset($_POST["submitprice"])&&$_POST["submitprice"]) {
            $money = intval($_POST["submitprice"]);
            if($money>=10) {//最小充值10块钱。
                //先记录本地数据。在去支付。
                $accountRechargeModel = new Accountrecharge();
                $accountRechargeModel->arc_ordernum = date("Ymdhms").rand("00", "99");//订单编号
                $accountRechargeModel->arc_userid = $userId;
                $accountRechargeModel->arc_moneynum = $money;
                $accountRechargeModel->arc_releasetime = time();
                $accountRechargeModel->arc_state = 0;
                $accountRechargeModel->save();

                $name = Yii::app()->params->name;
                $return  = Accountrecharge::model()->alipayTo($accountRechargeModel->arc_ordernum, $name."充值",$name."充值",$accountRechargeModel->arc_moneynum);
                $this->render('recharge',array("return"=>$return));
            }
        }else {
            $this->redirect(array("index"));
        }
    }
    /**
     * 交易成功支付宝异步通知页面。此页面不能做调整处理。此方法要所有用户都能访问。
     */
    public function actionAlipayNotify() {
        Yii::import('application.extensions.alipay.*');
        require_once("class/alipay_notify.php");
        require_once("alipay_config.php");

        $alipay = new alipay_notify($partner,$key,$sign_type,$_input_charset,$transport);    //构造通知函数信息
        $verify_result = $alipay->notify_verify();  //计算得出通知验证结果

        if($verify_result) {
            $dingdan           = $_POST['out_trade_no'];	//获取支付宝传递过来的订单号
            $total             = $_POST['total_fee'];		//获取支付宝传递过来的总价格

            if($_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {    //交易成功结束
                //判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                Accountrecharge::model()->oprateOrderByOrderNum($dingdan,$_POST['trade_no']);
                echo "success";		//请不要修改或删除
            }
            else {
                echo "success";		//其他状态判断。普通即时到帐中，其他状态不用判断，直接打印success。
            }
        }
        else {
            //验证失败
            echo "fail";
        }
    }
    /**
     * 支付成功后跳转页面此方法要所有用户都能访问。
     */
    public function actionBuySuccess() {
        $this->layout="frame";
        Yii::import('application.extensions.alipay.*');
        require_once("class/alipay_notify.php");
        require_once("alipay_config.php");

        //构造通知函数信息
        $alipay = new alipay_notify($partner,$key,$sign_type,$_input_charset,$transport);
        //计算得出通知验证结果
        $verify_result = $alipay->return_verify();

        $return = false;
        if($verify_result) {//验证成功
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            $dingdan           = $_GET['out_trade_no'];    //获取订单号
            $total_fee         = $_GET['total_fee'];	    //获取总价格

            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                Accountrecharge::model()->oprateOrderByOrderNum($dingdan, $_GET['trade_no']);
                $return  = true;
            }
        }
        $this->render('buysuccess',array(
                'dingdan'=>$_GET['out_trade_no'],
                "total_fee"=>$_GET['total_fee'],
                "return"=>$return,
        ));
    }


    /**
     * 充值记录
     */
    public function actionRechargeLog() {
        $userId = User::model()->getId();
        $userModel = User::model()->getUserInfoById($userId);

        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("arc_userid"=>$userId,"arc_state"=>1));
        $criteria->order = "arc_rechargetime desc";
        $dataProvider =  new CActiveDataProvider("Accountrecharge", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),
        ));

        $this->render("rechargelog",array(
                "userModel"=>$userModel,
                "dataProvider"=>$dataProvider
        ));
    }
    /**消费记录
     *
     */
    public function actionConsumeLog() {
        $userId = User::model()->getId();
        $userModel = User::model()->getUserInfoById($userId);

        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("cl_userid"=>$userId));
        $criteria->order = "cl_recodetime desc";
        $dataProvider =  new CActiveDataProvider("Consumelog", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),
        ));
        $this->render("consumelog",array(
                "userModel"=>$userModel,
                "dataProvider"=>$dataProvider
        ));
    }
}