<?php
$userModel = User::model()->findByPk($data['gh_userid']);
$userBoard = Userboard::model()->getNumByUserId($data["gh_golehomeuserid"], $data['gh_userid']);
?>
<div class="gzline">
    <span class="dx_02">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$data['gh_userid']))?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel, "_65x70")?>" width="60px"></a>
    </span>
    <span class="dx_04">
        <h5> <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$data['gh_userid']))?>" class="ff0080" target="_blank"><?=$userModel->u_nickname?></a> <?=date("Y-m-d H:i",$data->gh_createtime)?> 收藏</h5>

        <p>累计打赏给我<code>红牌<?=$userBoard["red"]?></code>枚<b>黑牌<?=$userBoard["black"]?></b>枚&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:;" onclick="sendUserMessage('<?=$data['gh_userid']?>')">发送短信</a> </p>
    </span>
</div>