<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
	 * @var string the default layout for the controller view. Defaults to 'application.views.layouts.column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
//	public $layout='application.views.layouts';
    /**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    /**
     * 用来作为需要运用到view之外的layout的临时变量
     * @var <type>
     */
    public $temp = array();
    public function getTopUserState(){
        $return = "";
        if(isset(Yii::app()->user->id)&&!empty(Yii::app()->user->id)) {
            $return = CHtml::link(Yii::app()->user->name,User::model()->getUrl())."您好，欢迎来新地标！".CHtml::link('退出',array('site/logout'));
            $return .= CHtml::link("找写字楼",Yii::app()->createUrl('/site/index'))."|";
            $return .= CHtml::link("找商铺",Yii::app()->createUrl('/shop/index'))."";
        }else {
            $return = '您好，欢迎来新地标找房！'.CHtml::link("登录",Yii::app()->createUrl('/site/agentlogin'))."|";
            $return .= CHtml::link("注册",Yii::app()->createUrl('/site/agentregister'))."|";
            $return .= CHtml::link("找写字楼",Yii::app()->createUrl('/site/index'))."|";
            $return .= CHtml::link("找商铺",Yii::app()->createUrl('/shop/index'))."";
           // $return .= CHtml::link("新地标房产经纪",Yii::app()->createUrl('/site/agentlogin'));
        }
        return $return;
    }
}