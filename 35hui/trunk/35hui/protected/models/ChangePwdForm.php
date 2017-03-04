<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ChangePwdForm extends CFormModel
{
	public $originpwd;
	public $newpwd;
	public $renewpwd;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('originpwd, newpwd, renewpwd', 'required'),
			array('newpwd', 'compare', 'compareAttribute'=>'renewpwd','message'=>'确认密码必须和新密码一致'),
			array('originpwd, newpwd, renewpwd','length','min'=>6,'max'=>20,'message'=>'密码最少6位'),
			// password needs to be authenticated
			
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'originpwd' => '初始密码',
			'newpwd' => '新密码',
			'renewpwd'=>'确认新密码',
		);
	}

}
