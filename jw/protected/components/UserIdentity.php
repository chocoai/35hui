<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
    /**
     * 邮件未认证
     */
    const ERROR_EMAIL_UNCHECK=10;
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=User::model()->find('LOWER(u_email)=?',array(strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(md5($this->password)!=$user->u_password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
        elseif($user->u_emailcheck==0){
            $this->errorCode=self::ERROR_EMAIL_UNCHECK;
        }else
		{
			$this->_id=$user->u_id;
			$this->username=$user->u_email;
            $this->setState('role',$user->u_role);
            $auth=Yii::app()->authManager;

            $user->u_logintime = time();
            $user->update();
            if(!$auth->isAssigned($user->u_role,$this->_id))
            {
            	$auth->assign($user->u_role,$this->_id);
                $auth->save();
            }
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}