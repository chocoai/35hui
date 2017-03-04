<?php

/**
 * This is the model class for table "{{accountrecharge}}".
 *
 * The followings are the available columns in table '{{accountrecharge}}':
 * @property integer $arc_id
 * @property string $arc_ordernum
 * @property integer $arc_moneynum
 * @property integer $arc_userid
 * @property string $arc_alipaynum
 * @property integer $arc_rechargetime
 * @property integer $arc_state
 * @property integer $arc_releasetime
 */
class Accountrecharge extends CActiveRecord
{
    /**
     * 状态
     * @var <type> 
     */
    public static $arc_state = array(
        "0"=>"未付款",
        "1"=>"已付款"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Accountrecharge the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{accountrecharge}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('arc_ordernum, arc_moneynum, arc_userid, arc_releasetime', 'required'),
			array('arc_moneynum, arc_userid, arc_rechargetime, arc_state, arc_releasetime', 'numerical', 'integerOnly'=>true),
			array('arc_ordernum, arc_alipaynum', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('arc_id, arc_ordernum, arc_moneynum, arc_userid, arc_alipaynum, arc_rechargetime, arc_state, arc_releasetime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'arc_id' => 'Arc',
			'arc_ordernum' => 'Arc Ordernum',
			'arc_moneynum' => 'Arc Moneynum',
			'arc_userid' => 'Arc Userid',
			'arc_alipaynum' => 'Arc Alipaynum',
			'arc_rechargetime' => 'Arc Rechargetime',
			'arc_state' => 'Arc State',
			'arc_releasetime' => 'Arc Releasetime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('arc_id',$this->arc_id);

		$criteria->compare('arc_ordernum',$this->arc_ordernum,true);

		$criteria->compare('arc_moneynum',$this->arc_moneynum);

		$criteria->compare('arc_userid',$this->arc_userid);

		$criteria->compare('arc_alipaynum',$this->arc_alipaynum,true);

		$criteria->compare('arc_rechargetime',$this->arc_rechargetime);

		$criteria->compare('arc_state',$this->arc_state);

		$criteria->compare('arc_releasetime',$this->arc_releasetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *支付宝接口
     * @param <type> $out_trade_no 订单号
     * @param <type> $subject 订单名称，显示在支付宝收银台里的“商品名称”里，显示在支付宝的交易管理的“商品名称”的列表里。
     * @param <type> $body 订单描述、订单详细、订单备注，显示在支付宝收银台里的“商品描述”里
     * @param <type> $total_fee 总价
     * @return <type>
     */
    public function alipayTo($out_trade_no, $subject, $body, $total_fee){
        $total_fee = $total_fee/1000;
        Yii::import('application.extensions.alipay.*');
        require_once("alipay_config.php");
        require_once("class/alipay_service.php");
        /*以下参数是需要通过下单时的订单数据传入进来获得*/
        //必填参数
//        $out_trade_no = date("Ymdhms");		//请与贵网站订单系统中的唯一订单号匹配
//        $subject      = "asdf";	//
//        $body         = "描述";
//        $total_fee    = $pirce;

        //扩展功能参数——默认支付方式
        $pay_mode	  = $_POST['pay_bank'];
        if ($pay_mode == "directPay") {
            $paymethod    = "directPay";	//默认支付方式，四个值可选：bankPay(网银); cartoon(卡通); directPay(余额); CASH(网点支付)
            $defaultbank  = "";
        }
        else {
            $paymethod    = "bankPay";		//默认支付方式，四个值可选：bankPay(网银); cartoon(卡通); directPay(余额); CASH(网点支付)
            $defaultbank  = $pay_mode;		//默认网银代号，代号列表见http://club.alipay.com/read.php?tid=8681379
        }


        //扩展功能参数——防钓鱼
        //请慎重选择是否开启防钓鱼功能
        //exter_invoke_ip、anti_phishing_key一旦被使用过，那么它们就会成为必填参数
        //开启防钓鱼功能后，服务器、本机电脑必须支持远程XML解析，请配置好该环境。
        //若要使用防钓鱼功能，请打开class文件夹中alipay_function.php文件，找到该文件最下方的query_timestamp函数，根据注释对该函数进行修改
        //建议使用POST方式请求数据
        $anti_phishing_key  = '';			//防钓鱼时间戳
        $exter_invoke_ip = '';				//获取客户端的IP地址，建议：编写获取客户端IP地址的程序
        //如：
        //$exter_invoke_ip = '202.1.1.1';
        //$anti_phishing_key = query_timestamp($partner);		//获取防钓鱼时间戳函数

        //扩展功能参数——其他
        $extra_common_param = '';			//自定义参数，可存放任何内容（除=、&等特殊字符外），不会显示在页面上
        $buyer_email		= '';			//默认买家支付宝账号

        //扩展功能参数——分润(若要使用，请按照注释要求的格式赋值)
        $royalty_type		= "";			//提成类型，该值为固定值：10，不需要修改
        $royalty_parameters	= "";
        //提成信息集，与需要结合商户网站自身情况动态获取每笔交易的各分润收款账号、各分润金额、各分润说明。最多只能设置10条
        //各分润金额的总和须小于等于total_fee
        //提成信息集格式为：收款方Email_1^金额1^备注1|收款方Email_2^金额2^备注2
        //如：
        //royalty_type = "10"
        //royalty_parameters	= "111@126.com^0.01^分润备注一|222@126.com^0.01^分润备注二"


        /////////////////////////////////////////////////

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service"			=> "create_direct_pay_by_user",	//接口名称，不需要修改
            "payment_type"		=> "1",               			//交易类型，不需要修改

            //获取配置文件(alipay_config.php)中的值
            "partner"			=> $partner,
            "seller_email"		=> $seller_email,
            "return_url"		=> $return_url,
            "notify_url"		=> $notify_url,
            "_input_charset"	=> $_input_charset,
            "show_url"			=> $show_url,

            //从订单数据中动态获取到的必填参数
            "out_trade_no"		=> $out_trade_no,
            "subject"			=> $subject,
            "body"				=> $body,
            "total_fee"			=> $total_fee,

            //扩展功能参数——网银提前
            "paymethod"			=> $paymethod,
            "defaultbank"		=> $defaultbank,

            //扩展功能参数——防钓鱼
            "anti_phishing_key"	=> $anti_phishing_key,
            "exter_invoke_ip"	=> $exter_invoke_ip,

            //扩展功能参数——自定义参数
            "buyer_email"		=> $buyer_email,
            "extra_common_param"=> $extra_common_param,

            //扩展功能参数——分润
            "royalty_type"		=> $royalty_type,
            "royalty_parameters"=> $royalty_parameters
        );

        //构造请求函数
        $alipay = new alipay_service($parameter,$key,$sign_type);
        $sHtmlText = $alipay->build_form();
        return $sHtmlText;
    }
    /**
     *通过用户传入的订单号，处理订单。
     * @param <type> $orderNum 订单号
     */
    public function oprateOrderByOrderNum($orderNum, $alipaynum){
        //如果订单已经为已付款状态，则不处理，如果是未付款状态，要变成已付款，并且执行赠送物品
        $model = $this->findByAttributes(array("arc_ordernum"=>$orderNum,"arc_state"=>0));
        if(!$model){//错误订单号和已付款的都不处理
            return false;
        }
        $rmb_to_gold = Config::model()->getValueByKey("rmb_to_gold");
        $getGold = $model->arc_moneynum*$rmb_to_gold;
        
        $model->arc_state = 1;
        $model->arc_alipaynum = $alipaynum;//支付宝交易号
        $model->arc_rechargetime = time();
        $model->arc_goldnum = $getGold;
        $model->update();

        $logDescription = "用户充值";
        User::model()->addGoldNum($model->arc_userid, $getGold, $logDescription);
        return true;
    }
    /**
     * 统计未付款过期的条数
     * @return <type>
     */
    public function countOutTimeUnPayInfo(){
        return $this->count($this->getOutTimeCDbCriteria());
    }
    /**
     * 删除未付款过期的充值记录
     * @return <type>
     */
    public function delOutTimeUnPayInfo(){
        return $this->deleteAll($this->getOutTimeCDbCriteria());
    }
    private function getOutTimeCDbCriteria(){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array ("arc_state"=>0));
        $time = time()-(86400*Config::model()->getValueByKey("recharge_unpay_outtime"));
        $criteria->addCondition("arc_releasetime<".$time);
        return $criteria;
    }
}