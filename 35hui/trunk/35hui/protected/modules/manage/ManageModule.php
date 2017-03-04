<?php

class ManageModule extends CWebModule
{
    public $defaultController='main';
    public $layout='uadmin';
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
        /*
		$this->setImport(array(
			'manage.models.*',
			'manage.components.*',
		));*/
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
            $controllerID = $controller->getId();
            $actionID = $action->getId();
            $check = $controllerID.$actionID;
            if($check!="mainindex"&&$check!="mainuncheck"){
                //判断用户是否经过审核了
                $chk = Uagent::model()->checkUserAudit();
                if($chk=="error_0"){//还未审核
                    header("Location:".DOMAIN."/manage/main/uncheck/type/0");
                    return false;
                }
                if($chk=="error_2"){//审核未通过
                    header("Location:".DOMAIN."/manage/main/uncheck/type/2");
                    return false;
                }
            }
			return true;
		}
		else
			return false;
	}
}
