<?php
$giftInfo = Giftcenter::model()->findByPk($data->gbl_giftcenterid);
?>
<div class="djmod">
    <img src="<?=$giftInfo->gc_url?>" width="210px" height="240px" />
    <p><b><?=$giftInfo->gc_name?></b></p>
    <p class="p2">价格：<?=$giftInfo->gc_price?>金币</p>
    <p>来自：<?=User::model()->getUserNameById($data->gbl_userid)?></p>
    <p>赠送时间：<?=date("Y-m-d H:i",$data->gbl_sendtime)?></p>
</div>

