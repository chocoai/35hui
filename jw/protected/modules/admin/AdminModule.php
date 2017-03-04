<?php

class AdminModule extends CWebModule
{
    public $defaultController='admin';
	public function init()
	{
        $this->setImport(array('admin.models.*'));
	}
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
            if(Yii::app()->user->isGuest){//如果还没有最初的登录。则不能进入
                header("Location:".DOMAIN."/my");
            }
            $controlleraction = "admin".strtolower($controller->id.$action->id);
            $check = Yii::app()->params->adminkey;
            if($controlleraction!="adminmanageuserlogin"){//只有login是例外的 管理后台还没有登录
                if(!isset(Yii::app()->user->adminkey)||Yii::app()->user->adminkey!=$check){
                    header("Location:".DOMAIN."/admin/manageuser/login");
                }
            }else{//是login 并且已经登录了管理后台
                if(isset(Yii::app()->user->adminkey)&&Yii::app()->user->adminkey==$check){
                    header("Location:".DOMAIN."/admin");
                }
            }
			return true;
		}
		else
			return false;
	}
}