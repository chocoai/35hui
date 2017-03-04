<?php $userModel = User::model()->getUserInfoById(User::model()->getId());?>
<div class="mlcont">
    <div class="mlcash">您现在有 <em class="active"><?=$userModel->u_goldnum?></em> 金币 > <a href="/my/accountrecharge">充值</a></div>
</div>
<div class="lf_nav">
    <ul>
        <li class="bg li_xx" onclick="location.href='<?=Yii::app()->createUrl("/my")?>'" style="cursor: pointer"><a href="#">好友动态</a></li>
        <li class="bg li_xx" onclick="location.href='<?=Yii::app()->createUrl("/my/dynamicmy/index")?>'" style="cursor: pointer"><a href="#">与我相关</a></li>
        <li class="bg li_zs" onclick="location.href='<?=Yii::app()->createUrl("/my/attention/index")?>'" style="cursor: pointer"><a href="#">我的关注</a></li>
        <li class="bg li_zs" onclick="location.href='<?=Yii::app()->createUrl("/my/goldhome/index")?>'" style="cursor: pointer"><a href="#">我的金屋</a></li>
        <li class="bg li_zs" onclick="location.href='<?=Yii::app()->createUrl("/my/album/index")?>'" style="cursor: pointer"><a href="#">相册</a></li>
        <li class="bg li_dx" onclick="location.href='<?=Yii::app()->createUrl("/my/usermessage")?>'" style="cursor: pointer"><a href="#">短 信</a></li>
        <li class="bg li_da" onclick="location.href='<?=Yii::app()->createUrl("/my/info")?>'" style="cursor: pointer"><a href="#">我的档案</a></li>
        <li class="bg li_jp" onclick="location.href='<?=Yii::app()->createUrl("/my/userboard")?>'" style="cursor: pointer"><a href="#">我的金牌</a></li>
    </ul>
</div>