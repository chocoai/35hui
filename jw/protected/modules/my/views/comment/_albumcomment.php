<?php
if($comment) {
    foreach($comment as $value) {
        $user = User::model()->getUserInfoById($value->ac_userid)
        ?>
<div class="onepunlun" style="">
    <div style="width: 35px;float: left">
        <img src="<?=User::model()->getUserHeadPhoto($user, "_65x70")?>" width="30px">
    </div>
    <div style="float:left;">
        <div style="float:left;width: 450px">
            <?=$user->u_nickname?> <?=CHtml::encode($value->ac_content)?> <br />
            <?=date("m-d H:i",$value->ac_createtime)?>
        </div>
         
    </div>
</div>
        <?php
    }
}
?>