<div class="view" >
<div class="problock"><?='['.CHtml::encode($data->cbl_uid).']'; ?></div>
<div class="problock"><?=Combolog::model()->getUserShowLink($data->cbl_uid);?></div>
<div class="problock"style="width:200px;"><?php echo CHtml::encode($data->cbl_content); ?></div>
<div class="problock"style="width:100px;" id="Muid"><?=$data->cbl_muid?Manageuser::model()->findByPk($data->cbl_muid)->mag_realname:'暂无';?></div>
<div class="problock"style="width:100px;text-align:right"><font color="<?echo $color=$data->cbl_endtime > time()?'#009900':'#CCCCCC'; ?>"><?echo $color=$data->cbl_endtime >time()?'使用中':'已过期'; ?></font></div>
<div class="clear"></div>
<div class="problock"style="width:250px;float:right"><font color="<?php echo $color=$data->cbl_endtime>time()?$data->cbl_endtime<strtotime('+30day')?"#FF0000":"#000000":"#CCCCCC";?>"><?php echo date("Y-m-d",$data->cbl_endtime); ?>&nbsp;&nbsp;到期</font></div>

</div>