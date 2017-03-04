<?php
$userModel = User::model()->getUserInfoById($data->ac_userid);
?>
<div class="xcpline">
    <span class="x_01">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel, "_65x70")?>" width="60px" /></a>
    </span>
    <span class="x_02" style="width: 620px">
        <h4><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id));?>" target="_blank"><?=$userModel->u_nickname?></a> <em><?=User::$authRolesName[$userModel->u_role]?></em>（<?=date("Y-m-d H:i",$data->ac_createtime)?>）</h4>
        <p><?=CHtml::encode($data->ac_content)?></p>
    </span>
</div>