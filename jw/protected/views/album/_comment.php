<?php
$userModel = User::model()->getUserInfoById($value->ac_userid)
?>
<div class="xcpline">
    <span class="x_01">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id))?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel,"_65x70")?>" width="60px" height="60px" /></a>
    </span>
    <span class="x_04" style="width: 750px">
        <h4><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id))?>"><?=$userModel->u_nickname?></a> <em><?=User::$authRolesName[$userModel->u_role]?></em>（<?=date("Y-m-d H:i",$value->ac_createtime)?>）</h4>
        <p style="word-break:break-all;"><?=CHtml::encode($value->ac_content)?></p>
    </span>
</div>