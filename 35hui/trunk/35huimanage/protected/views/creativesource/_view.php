
<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
             <a href="<?php echo Yii::app()->createUrl('creativesource/view',array('id'=>$data->cr_id));?>" target="_blank"><?=$data->cr_id?></a><br />
        </div>
    </div>
    <div style="float:left;padding:15px 10px;">
    <input id="pid_<?=$data->cr_id?>" type="checkbox" name="pids[]" value="<?=$data->cr_id?>">
    </div>
	<b>所属楼盘:</b>
    <?if(isset($data->parkbaseinfo)){?>
            <a href="<?php  echo MAINHOST;echo Yii::app()->createUrl('creativeparkbaseinfo/view',array('id'=>$data->parkbaseinfo->cp_id));?>"
        target="_blank"><?=CHtml::encode(@$data->parkbaseinfo->cp_name)?></a>
    <?}else{
        echo "<font style='color:red'>:楼盘信息为空</font>";
    }?>
    <br />
    
    <b>楼栋名称</b><a href="<?php  echo MAINHOST;echo Yii::app()->createUrl('creativesource/view',array('id'=>$data->cr_id));?>"target="_blank"><?=$data->cr_dongname ?></a>
    <br />
    
	<b>用户:</b>
    
	<?=isset($data->user)?CHtml::encode($data->user->user_name):""; ?>[<?=$data->cr_userid;?>]
	<br />
    <b>状态:</b><?= Creativesource::$checktype[$data->cr_check] ?>
    <?//=CHtml::link("下线",array(""),array('submit'=>array('changetag','id'=>$data->cr_id,"state"=>8,"sourceType"=>4,"uid"=>$data->user->user_id,"buildname"=>isset($data->parkbaseinfo)?@$data->parkbaseinfo->cp_name:""),'confirm'=>'确定下线此房源吗?'))?>
    <?//
    //=CHtml::link("删除",array(""),array('submit'=>array('changetag','id'=>$data->cr_id,"state"=>1,"sourceType"=>4,"uid"=>$data->user->user_id,"buildname"=>isset($data->parkbaseinfo)?@$data->parkbaseinfo->cp_name:""),'confirm'=>'确定删除此房源吗?'))?>
	<br />

</div>