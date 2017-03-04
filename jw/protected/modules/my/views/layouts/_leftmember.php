<div class="mlcont">
    <?php
    $memberModel = Member::model()->findByAttributes(array("mem_userid"=>User::model()->getId()));
    $userModel = User::model()->getUserInfoById(User::model()->getId());
    ?>
    <div class="mlccont">
        <div class="mlmodel active" style="border-right:1px solid #BBBBBB;"><p><?=$memberModel->mem_redboard?></p><p>红牌</p></div>
        <div class="mlmodel"><p><?=$memberModel->mem_blackboard?></p><p>黑牌</p></div>
        <div class="mline">
            <?php
            $all = $memberModel->mem_redboard+$memberModel->mem_blackboard;
            ?>
            好评率：<?=$all!=0?intval(($memberModel->mem_redboard/$all)*100):0?>%
            差评率：<?=$all!=0?intval(($memberModel->mem_blackboard/$all)*100):0?>%
        </div>
    </div>
    <div class="mlccont">
        <div class="mlmodel" style="border-right:1px solid #BBBBBB;"><p class="active"><?=Attention::model()->countAttentionNum($userModel->u_id)?></p><p>被关注</p></div>
        <div class="mlmodel"><p class="active"><?=Goldhome::model()->countGoldHomedNum($userModel->u_id)?></p><p>被收藏</p></div>
        <div class="mline">总浏览量：<?=$userModel->u_visitnum?></div>
    </div>
    <div class="mlcash">您现在有 <em class="active"><?=$userModel->u_goldnum?></em> 金币 > <a href="/my/accountrecharge">充值</a></div>
</div>
<div class="lf_nav">
    <ul>
        <li class="bg li_xx" onclick="location.href='<?=Yii::app()->createUrl("/my")?>'" style="cursor: pointer"><a href="javascript:;">好友动态</a></li>
        <li class="bg li_xx" onclick="location.href='<?=Yii::app()->createUrl("/my/dynamicmy/index")?>'" style="cursor: pointer"><a href="javascript:;">与我相关</a></li>
        <li class="bg li_zs" onclick="location.href='<?=Yii::app()->createUrl("/my/goldhome/index")?>'" style="cursor: pointer"><a href="javascript:;">我的金屋</a></li>
        <li class="bg li_zs" onclick="location.href='<?=Yii::app()->createUrl("/my/album/index")?>'" style="cursor: pointer"><a href="javascript:;">相册</a></li>
        <li class="bg li_dx" onclick="location.href='<?=Yii::app()->createUrl("/my/usermessage")?>'" style="cursor: pointer"><a href="javascript:;">短 信</a></li>
        <li class="bg li_da" onclick="location.href='<?=Yii::app()->createUrl("/my/info")?>'" style="cursor: pointer"><a href="javascript:;">我的档案</a></li>
        <li class="bg li_jp" onclick="location.href='<?=Yii::app()->createUrl("/my/propcenter")?>'" style="cursor: pointer"><a href="javascript:;">我的道具</a></li>
        <li class="bg li_jp" onclick="location.href='<?=Yii::app()->createUrl("/my/giftcenter")?>'" style="cursor: pointer"><a href="javascript:;">我的礼物</a></li>
        <li class="bg li_jp" onclick="location.href='<?=Yii::app()->createUrl("/my/accountrecharge")?>'" style="cursor: pointer"><a href="javascript:;">充值</a></li>
    </ul>
</div>