<?php
$propInfo = Propcenter::model()->findByPk($data->pbl_propcenterid);
?>
<div class="djmod">
    <img src="<?=$propInfo->pc_url?>" width="210px" height="240px" />
    <p><b><?=$propInfo->pc_name?></b></p>
    <p>
        <span style="float: left;width: 190px;overflow: hidden;height: 20px">使用：<?=$propInfo->pc_describe?></span>
        <span style="float:right;color:#FF7F27;cursor: pointer" onclick="showdescribe(this)">详细</span>
    </p>
    <p class="p2">价格：<?=$propInfo->pc_price?>金币</p>
    <p>赠送：<?=User::model()->getUserNameById($data->pbl_consumeuser)?></p>
    <p>赠送时间：<?=date("Y-m-d H:i",$data->pbl_buytime)?></p>
</div>

