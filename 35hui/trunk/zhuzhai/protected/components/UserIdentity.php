<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
    private $role;

    public function  __construct($username,$password,$role) {
        $this->role = $role;
        parent::__construct($username,$password);
    }

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $user = null;
        if($this->role==1){//个人
            $user=User::model()->find('(LOWER(user_name)=? or LOWER(user_email)=? or LOWER(user_tel)=?) and user_role=1',array(strtolower($this->username),strtolower($this->username),strtolower($this->username)));
        }elseif($this->role==2){//经纪人
            $user=User::model()->find('(LOWER(user_name)=? or LOWER(user_email)=? or LOWER(user_tel)=?) and user_role=2',array(strtolower($this->username),strtolower($this->username),strtolower($this->username)));
        }
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->user_id;
			$this->username=$user->user_name;
            //Yii::app()->user->?
            $this->setState('role',$user->user_role);
            $this->setState('mainbusiness',$user->user_mainbusiness);
            $this->setState('mainbusinessname',User::$mainBusiness[$user->user_mainbusiness]);
		 	$auth=Yii::app()->authManager;
            if(!$auth->isAssigned($user->user_role,$this->_id))
            {
            	$auth->assign($user->user_role,$this->_id);
                $auth->save();
            }
            //如果还没有登录过论坛，要为论坛创建用户
            if(uc_user_checkname($this->username)>0){//用户名可用，就表明用户在论坛还没有注册
                $email = User::model()->getUserEmail($this->_id);
                $ucid = uc_user_register($this->username, $this->password, $email);
            }
            list($bbsuid,$username,$password,$email) = uc_user_login(strtolower($this->username),$this->password);
            uc_user_synlogin($bbsuid);

            setcookie("dibiaobbs_auth","",-86400);
            $cookie = new CHttpCookie("dibiaobbs_auth",$bbsuid);
            Yii::app()->request->cookies['dibiaobbs_auth']=$cookie;

			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	public function existname()
	{
		$user=User::model()->find('LOWER(user_name)=?',array(strtolower($this->username)));
		if($user === null)
		{
			$this->errorCode=self::ERROR_NONE;
		}
		else
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
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
	
	/**
	 * 验证后记录时间，ip
	 * 
	 */

}