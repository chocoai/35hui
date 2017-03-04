<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
             <a href="<?php echo Yii::app()->createUrl('shopbaseinfo/view',array('id'=>$data->sb_shopid));?>" target="_blank"><?=$data->sb_shopid?></a><br />
        </div>
    </div>
    <div style="float:left;padding:15px 10px;">
    <input id="pid_<?=$data->sb_shopid?>" type="checkbox" name="pids[]" value="<?=$data->sb_shopid?>">
    </div>
	

	<b>用户:</b>

	<?=isset($data->user)?CHtml::encode($data->user->user_name):""?>[<?=$data->sb_uid?>]
	<br />
    <b>状态:</b><?=  Officebaseinfo::$checktype[$data->sb_check]?>
	<br />
    <b>类型:</b><?
    if($data->sb_sellorrent==2){
        echo Shopbaseinfo::$sb_sellorrent[$data->sb_sellorrent]; 
    }else {
        if(isset($data->rentInfo->sr_renttype))
                echo Shopbaseinfo::$renttype[$data->rentInfo->sr_renttype];
    }?>
	<br />
</div>