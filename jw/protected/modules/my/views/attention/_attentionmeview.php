<?php
$userModel = User::model()->findByPk($data['at_userid']);
?>
<div class="gzline">
    <span class="dx_02">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$data['at_userid']));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel, "_65x70")?>" width="60px" /></a>
    </span>
    <?php
    if($type==User::ROLE_AUDIENCE) {//普通会员
        ?>
    <span class="dx_04">
        <h5><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$data['at_userid']));?>" target="_blank"><?=$userModel->u_nickname?></a>&nbsp; <b class="ff0080">观众</b>&nbsp; <?=date("Y-m-d H:i",$data->at_createtime)?> 关注</h5>
        <?php $count = Userboard::model()->getNumByUserId(User::model()->getId(), $data['at_userid']);?>
        <p>给您打赏 红牌<code><?=$count["red"]?></code>枚 黑牌<code><?=$count["black"]?></code>枚 </p>
    </span>
        <?php
    }else {
        ?>
    <span class="dx_04">
        <h5><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$data['at_userid']));?>" target="_blank" class="ff0080"><?=$userModel->u_nickname?></a>&nbsp; <b class="ff0080"><?=Memberlevel::model()->getUserLevelName($data['at_userid'])?></b>&nbsp; <?=date("Y-m-d H:i",$data->at_createtime)?> 关注</h5>
        <p>
            <?php
            $menberModel = Member::model()->findByAttributes(array("mem_userid"=>$data['at_userid']));
            ?>
            <?=Region::model()->getNameById($userModel->u_district)?>
            <?=Region::model()->getNameById($userModel->u_section)?>
            <?=Companymanage::model()->getNameById($menberModel->mem_company)?>
            <code><?=Attention::model()->countAttentionNum($data['at_userid'])?></code>人关注她
            <code><?=$menberModel->mem_redboard?></code>枚红牌
        </p>
    </span>
        <?php
    }
    ?>

</div>