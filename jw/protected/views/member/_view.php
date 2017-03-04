<?php
$userModel = User::model()->getUserInfoById($memberModel->mem_userid);
?>
<div class="sear_modle">
    <a href="<?=Yii::app()->createUrl("/album/index",array("id"=>$userModel->u_id))?>" target="_blank"><img src="<?=Member::model()->getLastUpdateAlbum($userModel->u_id, "_230x250")?>" width="230px" height="250px" /></a>
    <div class="s_m_tit">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id));?>" target="_blank"><?=$userModel->u_nickname?></a>
        <em><?=Memberlevel::model()->getUserLevelName($userModel->u_id)?></em>
        <span title="红牌数"><?=$memberModel->mem_redboard?></span> <span title="浏览数"><?=$userModel->u_visitnum?></span>
    </div>
    <?php $com = Member::model()->getMemberCompany($memberModel)?>
    <p title="<?=$com?>"><?=Common::strCut($com,42);?></p>
</div>