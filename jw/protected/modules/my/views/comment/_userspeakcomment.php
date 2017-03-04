<?php
if($comment) {
    foreach($comment as $value) {
        $huifu = Userspeakcomment::model()->getHuifu($value->usc_id);
        $user = User::model()->getUserInfoById($value->usc_userid)
                ?>
<div class="onepunlun" style="">
    <div style="width: 35px;float: left">
        <img src="<?=User::model()->getUserHeadPhoto($user, "_65x70")?>" width="30px">
    </div>
    <div style="float:left;">
        <div style="float:left;width: 450px">
                    <?=$user->u_nickname?> <?=$value->usc_content?> <br />
                    <?=date("m-d H:i",$value->usc_createtime)?> <a href="javascript:;" onClick="huifu_punlun('<?=$domId?>',<?=$value->usc_id?>)">回复</a>
        </div>
                <?php
                if($huifu) {
                    foreach($huifu as $v) {
                        $huifuUser = User::model()->getUserInfoById($v->usc_userid)
                                ?>
        <div class="onehuifu">
            <div style="float:left">
                <img src="<?=User::model()->getUserHeadPhoto($huifuUser, "_65x70")?>" width="30px">
            </div>
            <div style="float:left;margin-left: 5px">
                                <?=$huifuUser->u_nickname?> <?=$v->usc_content?> <br />
                                <?=date("m-d H:i",$v->usc_createtime)?> <a href="javascript:;" onClick="huifu_punlun('<?=$domId?>',<?=$value->usc_id?>)">回复</a>
            </div>
        </div>
                        <?php
                    }
                }
                ?>
        <div class="onehuifu" id="<?=$domId?>_<?=$value->usc_id?>_huifu">
            <div class="huifu_area"  attr="1_<?=$searchId?>_<?=$value->usc_id?>"></div>
        </div>

    </div>
</div>
        <?php
    }
}
?>
<?php
if($showNewComment) {
    ?>
<div class="onepunlun" id="<?=$domId?>_punlun">
    <input class="huifu_div" value="我来说一句" />
    <div class="huifu_area" attr="1_<?=$searchId?>_0"></div>
</div>
    <?php
}
?>



