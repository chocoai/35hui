<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
             <a href="<?php echo Yii::app()->createUrl('officebaseinfo/view',array('id'=>$data->ob_officeid));?>" target="_blank"><?=$data->ob_officeid?></a><br />
        </div>
    </div>
    <div style="float:left;padding:15px 10px;">
    <input id="pid_<?=$data->ob_officeid?>" type="checkbox" name="pids[]" value="<?=$data->ob_officeid?>">
    </div>
	<b>所属楼盘:</b>
    <?if(isset($data->buildingInfo)){?>
        <a href="<?php  echo MAINHOST;echo Yii::app()->createUrl('systembuildinginfo/view',array('id'=>$data->buildingInfo->sbi_buildingid));?>"
        target="_blank"><?=CHtml::encode(@$data->buildingInfo->sbi_buildingname)?></a>
    <?}else{
        echo "<font style='color:red'>:楼盘信息为空</font>";
    }?>
    <br />

	<b>用户:</b>
    
	<?=isset($data->user)?CHtml::encode($data->user->user_name):""?>[<?=$data->ob_uid?>]
	<br />
    <b>状态:</b><?=  Officebaseinfo::$checktype[$data->ob_check]?>
	<br />
</div>