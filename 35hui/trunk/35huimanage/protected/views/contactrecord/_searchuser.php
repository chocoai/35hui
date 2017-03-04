<div class="view">
        <b><?=CHtml::radioButton("selectuser",'',array("value"=>$data->user_role==2?$data->agentinfo->ua_id:$data->companyinfo->uc_id,"onClick"=>"$('#search-fomr').submit();"));?></b>
        <b><?php echo CHtml::encode("姓名"); ?>:</b>
	<?php echo CHtml::encode($data->user_role==2?$data->agentinfo->ua_realname:$data->companyinfo->uc_contact); ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role')); ?>:</b>
	<?php echo CHtml::encode(User::$roleDescription[$data->user_role]); ?>
	<br />
</div>