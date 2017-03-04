<?php

class FundsconfigController extends Controller
{
	 
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
            array(
                "allow",
                "actions"=>array("alipaynotify","buysuccess"),
                'users'=>array('*'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array("recharge", "alipayto", "buylist","delrecharge"),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionBuyList(){
        $usrid = Yii::app()->user->id;
        
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("arc_uid"=>$usrid));
        $criteria->order = "arc_releasetime desc";
        $list = Accountrecharge::model()->findAll($criteria);
        $this->render('buylist',array(
            "list"=>$list,
		));
    }
    /**
     * 交易成功支付宝异步通知页面。此页面不能做调整处理。此方法要所有用户都能访问。
     */
    public function actionAlipayNotify(){
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
    public function actionBuySuccess(){
        $this->layout="frame";
        $usrid = Yii::app()->user->id;
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
     * 充值
     */
    public function actionRecharge(){
        $usrid = Yii::app()->user->id;
        $model = $this->loadModel();
        if(isset($_POST)&&$_POST){
            $this->layout = "frame";
            $return = "很遗憾，参数错误！操作失败！";
            if(isset($_GET["arcid"])&&$_GET["arcid"]){//如果有传递充值记录表主键，则要判断记录是否属于当前用户
                $accountRechargeModel = Accountrecharge::model()->findByPk($_GET["arcid"]);
                if($accountRechargeModel&&$accountRechargeModel->arc_uid==$usrid&&$accountRechargeModel->arc_state==0){//只有在记录属于当前用户，并且还没有付款时才可以使用
                    $return  = Accountrecharge::model()->alipayTo($accountRechargeModel->arc_ordernum, "新地标充值","新地标充值",$model->fc_rmbprice);
                }else{
                    Yii::app()->user->setFlash('message','此订单已经付款成功，不能重复付款！');
                }
            }else{
                //先记录本地数据。在去支付。
                $accountRechargeModel = new Accountrecharge();
                $accountRechargeModel->arc_ordernum = date("Ymdhms").rand("00", "99");//订单编号
                $accountRechargeModel->arc_uid = $usrid;
                $accountRechargeModel->arc_fcid = $_GET['id'];
                $accountRechargeModel->arc_releasetime = time();
                if($accountRechargeModel->save()){
                    $return  = Accountrecharge::model()->alipayTo($accountRechargeModel->arc_ordernum, "新地标充值","新地标充值",$model->fc_rmbprice);
                }
            }
            $this->render('alipayTo',array(
                "return"=>$return
            ));
            exit;
        }
        Yii::import('application.extensions.alipay.*');
        require_once('alipay_config.php');
        $this->render('recharge',array(
            "model"=>$model,
		));
    }
    /**
     * 删除一条没有付款的购买记录
     */
    public function actionDelRecharge(){
        $arcid = $_GET["arcid"];
        $usrid = Yii::app()->user->id;
        $arcModel = Accountrecharge::model()->findByPk($arcid);
        if($arcModel&&$arcModel->arc_uid==$usrid&&$arcModel->arc_state==0){//只删除属于当前用户的，并且还没有付款的记录
            $arcModel->delete();
        }
        header("Location:".$_SERVER["HTTP_REFERER"]);
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Fundsconfig::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='fundsconfig-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
