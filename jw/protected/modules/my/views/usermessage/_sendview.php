<?php $userModel = User::model()->getUserInfoById($data->um_userid);?>
<div class="dxline">
    <span class="dx_01"><input type="checkbox" name="id[]" value="<?=$data->um_id?>"></span>
    <span class="dx_02"><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$data->um_userid))?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel, "_65x70")?>" width="60px"></a></span>
    <span class="dx_03">
        <h5>
            <code>
                <?=date("Y-m-d H:i",$data->um_createtime)?>
                <a href="javascript:;" onclick="return showMessageInfo('<?=$data->um_id?>')">查看</a>
            </code>
            <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$data->um_userid))?>" target="_blank"><?=$userModel->u_nickname?></a>
            <em><?=User::$authRolesName[$userModel->u_role]?></em>
        </h5>
        <?php
            $replyModel = Usermessage::model()->findByPk($data->um_replyidumid);
            if($replyModel){
        ?>
        <fieldset>
            <legend>回复<?=$userModel->u_nickname?>&nbsp;<?=date("Y-m-d H:i",$replyModel->um_createtime)?>&nbsp;</legend>
            <p class="quote_content"><?=CHtml::encode($replyModel->um_title)?></p>
        </fieldset>
        <?php
            }
        ?>
        <p onclick="showMessageInfo(<?=$data->um_id?>)" style="cursor: pointer"><?=CHtml::encode($data->um_title)?></p>
    </span>
</div>