<?php
$commentUserModel = User::model()->getUserInfoById($value->usc_userid);
?>
<div class="hyline1">
    <div class="hyline2">
        <div class="hypic">
            <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$commentUserModel->u_id));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($commentUserModel, "_65x70")?>" width="30px" height="30px"></a>
        </div>
        <div class="hytxt">
            <div class="hytit"><a href=""><?=$commentUserModel->u_nickname?></a> <?=date("Y-m-d H:i",$value->usc_createtime);?></div>
            <p style="word-wrap:break-word;word-break:break-all;"><?=$value->usc_content?></p>
        </div>
    </div>
    <?php
    $huifu = Userspeakcomment::model()->getHuifu($value->usc_id);
    if($huifu) {
        foreach($huifu as $hui) {
            $huifuUserModel = User::model()->getUserInfoById($hui->usc_userid);
            ?>
    <div class="hyline4" style="padding-left: 50px;">
        <div class="hypic">
            <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$huifuUserModel->u_id));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($huifuUserModel, "_65x70")?>" width="30px" height="30px"></a>
        </div>
        <div class="hytxt">
            <div class="hytit"><a href=""><?=$huifuUserModel->u_nickname?></a> 回复：</div>
            <p style="word-wrap:break-word;word-break:break-all;"><?=$hui->usc_content?></p>
            <div class="hymsg"><?=date("Y-m-d H:i",$hui->usc_createtime);?></div>
        </div>
    </div>
            <?php
        }
    }
    ?>



</div>