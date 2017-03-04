<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Emailgroup extends CFormModel
{
	public $addressee;
	public $emailtitle;
	public $emailcontent;
        public function rules()
	{
		return array(
			// username and password are required
			array('addressee, emailtitle, emailcontent', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'addressee' => '收件人',
			'emailtitle' => '标题',
			'emailcontent'=>'内容',
		);
	}
}
?>
