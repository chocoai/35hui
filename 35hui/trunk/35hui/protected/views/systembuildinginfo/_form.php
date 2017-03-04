<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'systembuildinginfo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_buildingname'); ?>
		<?php echo $form->textField($model,'sbi_buildingname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sbi_buildingname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_pinyinshortname'); ?>
		<?php echo $form->textField($model,'sbi_pinyinshortname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sbi_pinyinshortname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_province'); ?>
		<?php echo $form->textField($model,'sbi_province'); ?>
		<?php echo $form->error($model,'sbi_province'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_city'); ?>
		<?php echo $form->textField($model,'sbi_city'); ?>
		<?php echo $form->error($model,'sbi_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_district'); ?>
		<?php echo $form->textField($model,'sbi_district'); ?>
		<?php echo $form->error($model,'sbi_district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_section'); ?>
		<?php echo $form->textField($model,'sbi_section'); ?>
		<?php echo $form->error($model,'sbi_section'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_loop'); ?>
		<?php echo $form->textField($model,'sbi_loop'); ?>
		<?php echo $form->error($model,'sbi_loop'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_tradecircle'); ?>
		<?php echo $form->textField($model,'sbi_tradecircle'); ?>
		<?php echo $form->error($model,'sbi_tradecircle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_busway'); ?>
		<?php echo $form->textField($model,'sbi_busway',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'sbi_busway'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_address'); ?>
		<?php echo $form->textField($model,'sbi_address',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'sbi_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_foreign'); ?>
		<?php echo $form->textField($model,'sbi_foreign'); ?>
		<?php echo $form->error($model,'sbi_foreign'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_openingtime'); ?>
		<?php echo $form->textField($model,'sbi_openingtime'); ?>
		<?php echo $form->error($model,'sbi_openingtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_propertyname'); ?>
		<?php echo $form->textField($model,'sbi_propertyname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sbi_propertyname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_developer'); ?>
		<?php echo $form->textField($model,'sbi_developer',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'sbi_developer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_berthnum'); ?>
		<?php echo $form->textField($model,'sbi_berthnum'); ?>
		<?php echo $form->error($model,'sbi_berthnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_rentberth'); ?>
		<?php echo $form->textField($model,'sbi_rentberth'); ?>
		<?php echo $form->error($model,'sbi_rentberth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_propertyprice'); ?>
		<?php echo $form->textField($model,'sbi_propertyprice'); ?>
		<?php echo $form->error($model,'sbi_propertyprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_propertydegree'); ?>
		<?php echo $form->textField($model,'sbi_propertydegree'); ?>
		<?php echo $form->error($model,'sbi_propertydegree'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_elevatornum'); ?>
		<?php echo $form->textField($model,'sbi_elevatornum'); ?>
		<?php echo $form->error($model,'sbi_elevatornum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_fireelevatornum'); ?>
		<?php echo $form->textField($model,'sbi_fireelevatornum'); ?>
		<?php echo $form->error($model,'sbi_fireelevatornum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_buildingarea'); ?>
		<?php echo $form->textField($model,'sbi_buildingarea'); ?>
		<?php echo $form->error($model,'sbi_buildingarea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_floorarea'); ?>
		<?php echo $form->textField($model,'sbi_floorarea'); ?>
		<?php echo $form->error($model,'sbi_floorarea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_floor'); ?>
		<?php echo $form->textField($model,'sbi_floor'); ?>
		<?php echo $form->error($model,'sbi_floor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_floordownground'); ?>
		<?php echo $form->textField($model,'sbi_floordownground'); ?>
		<?php echo $form->error($model,'sbi_floordownground'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_floorupground'); ?>
		<?php echo $form->textField($model,'sbi_floorupground'); ?>
		<?php echo $form->error($model,'sbi_floorupground'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_roomnum'); ?>
		<?php echo $form->textField($model,'sbi_roomnum'); ?>
		<?php echo $form->error($model,'sbi_roomnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_buildingintroduce'); ?>
		<?php echo $form->textArea($model,'sbi_buildingintroduce',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sbi_buildingintroduce'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_peripheral'); ?>
		<?php echo $form->textArea($model,'sbi_peripheral',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sbi_peripheral'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_traffic'); ?>
		<?php echo $form->textArea($model,'sbi_traffic',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sbi_traffic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_decoration'); ?>
		<?php echo $form->textArea($model,'sbi_decoration',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sbi_decoration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_floorinformation'); ?>
		<?php echo $form->textArea($model,'sbi_floorinformation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sbi_floorinformation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_parkinginformation'); ?>
		<?php echo $form->textArea($model,'sbi_parkinginformation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sbi_parkinginformation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_otherinformation'); ?>
		<?php echo $form->textArea($model,'sbi_otherinformation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sbi_otherinformation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_titlepic'); ?>
		<?php echo $form->textField($model,'sbi_titlepic'); ?>
		<?php echo $form->error($model,'sbi_titlepic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_avgrentprice'); ?>
		<?php echo $form->textField($model,'sbi_avgrentprice'); ?>
		<?php echo $form->error($model,'sbi_avgrentprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_avgsellprice'); ?>
		<?php echo $form->textField($model,'sbi_avgsellprice'); ?>
		<?php echo $form->error($model,'sbi_avgsellprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_isnew'); ?>
		<?php echo $form->textField($model,'sbi_isnew'); ?>
		<?php echo $form->error($model,'sbi_isnew'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_x'); ?>
		<?php echo $form->textField($model,'sbi_x',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'sbi_x'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_y'); ?>
		<?php echo $form->textField($model,'sbi_y',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'sbi_y'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_tag'); ?>
		<?php echo $form->textField($model,'sbi_tag',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'sbi_tag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_recordtime'); ?>
		<?php echo $form->textField($model,'sbi_recordtime'); ?>
		<?php echo $form->error($model,'sbi_recordtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_updatetime'); ?>
		<?php echo $form->textField($model,'sbi_updatetime'); ?>
		<?php echo $form->error($model,'sbi_updatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbi_tel'); ?>
		<?php echo $form->textField($model,'sbi_tel',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sbi_tel'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->