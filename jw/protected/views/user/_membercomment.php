<?php
$userModel = User::model()->getUserInfoById($value->mc_fromuserid)
?>
<div class="hyline">
    <div class="hypic">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id))?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel,"_65x70")?>"/></a>
    </div>
    <div class="hytxt">
        <div class="hytit">
            <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id))?>"><?=$userModel->u_nickname?></a>
            <em><?=User::$authRolesName[$userModel->u_role]?></em>&nbsp;&nbsp;<?=date("Y-m-d H:i", $value->mc_createtime)?>
            <span style="float:right;font-size: 12px"><span><?=$value->mc_supportnum?></span> <a href="javascript:;" onclick="memberCommentSupport(this)" attr="<?=$value->mc_id?>">有用</a></span>
        </div>
        <p style="word-break:break-all;"><?=CHtml::encode($value->mc_content)?></p>
    </div>
</div>