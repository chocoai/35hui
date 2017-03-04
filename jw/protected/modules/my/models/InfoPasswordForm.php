<?php
//InfoPasswordForm
class InfoPasswordForm extends CFormModel
{
	public $oldpassword;
    public $newpassword;
	public $newpassword2;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('oldpassword, newpassword, newpassword2', 'required'),
            array('oldpassword, newpassword','length','min'=>6,'max'=>20,'message'=>'密码最少6位,做多20位'),
            array('newpassword2', 'compare', 'compareAttribute'=>'newpassword','message'=>'确认密码必须和密码一致'),
            array('oldpassword','oldPwdCheck'),
            array('newpassword', 'compare', 'operator'=>'!=', 'compareAttribute'=>'oldpassword','message'=>'新密码不能和旧密码一样'),
		);
	}
    /*
     *
     */
    public function init(){
        if(isset($_POST['InfoPasswordForm'])){
            $this->attributes=$_POST['InfoPasswordForm'];
            $this->setScenario(true);
        }
    }
    /**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'oldpassword'=>'原密码',
            'newpassword'=>'新密码',
            'newpassword2'=>'重复新密码',
		);
	}

    public function save(){
        if($this->validate()){
            $sql = 'UPDATE `{{user}}` SET u_password=\''.md5($this->newpassword).'\'
                WHERE u_id ='.Yii::app()->user->id.' LIMIT 1';
            return Yii::app()->getDb()->createCommand($sql)->query();
        }
        return false;
    }
    
    public function oldPwdCheck(){
        $model = User::model()->findByPk(Yii::app()->user->id);
        if(!$model || $model->u_password != md5($this->oldpassword))
            $this->addError('oldpassword', '旧密码输入错误');
    }
}
