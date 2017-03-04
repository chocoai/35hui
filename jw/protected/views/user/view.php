<?php
$this->topbreadcrumbs = array(
    "展示"=>array("/member/list"),
    $userModel->u_nickname
);
switch ($userModel->u_role){
    case User::ROLE_AUDIENCE :
        $this->renderPartial('_audienceview');
        break;
    case User::ROLE_MEMBER :
        $this->renderPartial('_memberview',array(
            "userModel"=>$userModel,
            "memberModel"=>Member::model()->findByAttributes(array("mem_userid"=>$userModel->u_id)),
        ));
        break;
}
?>