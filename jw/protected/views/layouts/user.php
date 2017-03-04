<?php 
$this->beginContent('application.views.layouts.main'); 
Yii::app()->clientScript->registerCssFile("/css/css.css");
Yii::app()->clientScript->registerCssFile("/css/hy.css");
$userModel = User::model()->findByPk($this->uid);
switch ($userModel->u_role){
    case User::ROLE_AUDIENCE :
//        $this->renderPartial('_audienceview');
        break;
    case User::ROLE_MEMBER :
        $this->renderPartial('/layouts/_member',array("userModel"=>$userModel));
        break;
}
echo $content;
$this->endContent();

?>