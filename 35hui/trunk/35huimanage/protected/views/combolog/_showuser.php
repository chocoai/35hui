<div class="view">	
<div class="problock" style="width:50px">ID:<?php echo CHtml::link(CHtml::encode($data->cbl_id), array('view', 'id'=>$data->cbl_id)); ?></div>
<div class="problock" style="width:200px"><?php echo CHtml::encode($data->cbl_content); ?></div>
<div class="problock"><?php echo date("Y-m-d",$data->cbl_starttime); ?></div>
<div class="problock" ><?php echo date("Y-m-d",$data->cbl_endtime); ?></div>
<?$allMangeuser=Manageuser::model()->findAllByAttributes(array("mag_role"=>"2"));
  $mangeuser=array();
  foreach($allMangeuser as $value){
         $mangeuser[$value->mag_userid] = $value->mag_realname;
  }?>
<div class="problock" ><input type="hidden" value="<?=$data->cbl_id?>">
        <?=$data->cbl_endtime >time()?$mangeuser=CHtml::dropDownList("mangeuser",$data->cbl_muid?$data->cbl_muid:'',$mangeuser,array("empty"=>"暂无")):$mangeuser=$data->cbl_muid?Manageuser::model()->findByPk($data->cbl_muid)->mag_realname:'暂无'?></div>
<??>
<?;?>

<div class="problock" style="width:50px;"><font color="<?echo $color=$data->cbl_endtime > time()?'#009900':'#CCCCCC'; ?>"><?echo $color=$data->cbl_endtime > time()?'使用中':'已过期'; ?></font></div>
<div class="clear"></div>
</div>