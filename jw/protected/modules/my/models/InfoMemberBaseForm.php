<?php

class InfoMemberBaseForm extends CFormModel
{
    public $mem_telephone;
    public $mem_telhide;
	public $mem_qq;
    public $mem_qqhide;

	public $mem_birthday;
    public $u_district;
    public $u_section;
    public $u_nativeprovince;
    
	public $mem_height;
    public $mem_weight;
    public $mem_threesize;//{胸,腰,臀}
    public $xiongsize;
    public $yaosize;
    public $tunsize;

    public $xiongsizedanwei;
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
            array('mem_telephone,xiongsize,yaosize,tunsize,u_section,u_nativeprovince,mem_threesize,mem_birthday', 'required'),
            array('mem_qq, xiongsize,yaosize,tunsize, mem_height,mem_weight,mem_birthday', 'numerical', 'integerOnly'=>true,"message"=>"必须为整数"),
            array('mem_telephone', 'match', 'pattern'=>'/^1[0-9]{10}$/', 'message'=>'请输入正确的手机号码'),

            array('mem_birthday', 'CNumberValidator', 'min'=>0, 'tooSmall'=>'请选择出生日期'),

            array('mem_qq', 'length', 'max'=>15, 'message'=>'请输入正确的QQ号码'),
            array('mem_qq', 'length', 'min'=>6, 'message'=>'请输入正确的QQ号码'),
            
            array('mem_height', 'CNumberValidator', 'max'=>250, 'tooBig'=>'身高范围在130-250cm以内'),
            array('mem_height', 'CNumberValidator', 'min'=>130, 'tooSmall'=>'身高范围在130-250cm以内'),

            array('mem_weight', 'CNumberValidator', 'max'=>150, 'tooBig'=>'体重范围在30-150公斤以内'),
            array('mem_weight', 'CNumberValidator', 'min'=>30, 'tooSmall'=>'体重范围在30-150公斤以内'),

            array('xiongsize,yaosize,tunsize', 'CNumberValidator', 'max'=>300, 'tooBig'=>'请输入正确的三围数'),

            array('u_section', 'match', 'pattern'=>'/^[0-9]*$/', 'message'=>'所在地不能为空'),
            array("mem_threesize","safe"),
		);
	}
    public function attributeLabels()
	{
		return array(
            'mem_telephone'=>"",
            'mem_telhide'=>"隐藏",
            'mem_qq'=>"",
            'mem_qqhide'=>"隐藏",
            'mem_birthday'=>"",
            'u_district'=>"",
            'u_section'=>"",
            'mem_height'=>"",
            'mem_weight'=>"",
            'mem_threesize'=>"",
            'xiongsize'=>"",
            'yaosize'=>"",
            'tunsize'=>"",
            'u_nativeprovince'=>"籍贯",
		);
	}
    /*
     * 
     */
    public function init(){
        if(isset($_POST['InfoMemberBaseForm'])){
            $post = array_map('trim',$_POST['InfoMemberBaseForm']);
            $this->setAttributes($post,false);
            $this->mem_threesize = $this->xiongsize.$this->xiongsizedanwei.','.$this->yaosize.','.$this->tunsize;
            
        }else{
            $userId = User::model()->getId();
            $userModel = User::model()->getUserInfoById($userId);
            $this->setAttributes($userModel->attributes,false);
            $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$userId));
            $this->setAttributes($memberModel->attributes,false);
            
            if($this->mem_threesize){
                $_3s = explode(',', $this->mem_threesize);
                $xiongAll = $_3s[0];//包含单位
                $this->xiongsize = substr($xiongAll,0,strlen($xiongAll)-1);
                $this->xiongsizedanwei = substr($xiongAll,strlen($xiongAll)-1);
                $this->yaosize = @$_3s[1];
                $this->tunsize = @$_3s[2];
                $this->mem_birthday = date('Y-m-d',$this->mem_birthday);
            }
        }
    }
    
    public function update(){
        $this->mem_birthday = strtotime($this->mem_birthday);
        if($this->validate()){
            $userId = User::model()->getId();
            $userModel = User::model()->getUserInfoById($userId);
            $userModel->setAttributes($this->attributes,false);
            $userModel->update();
            $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$userId));
            $memberModel->setAttributes($this->attributes,false);
            $memberModel->update();
            return true;
        }else{
            $this->mem_birthday = date('Y-m-d',$this->mem_birthday);
        }
        return false;
    }
}