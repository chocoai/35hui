<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sbi_buildingid'); ?>
		<?php echo $form->textField($model,'sbi_buildingid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_buildingname'); ?>
		<?php echo $form->textField($model,'sbi_buildingname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_pinyinshortname'); ?>
		<?php echo $form->textField($model,'sbi_pinyinshortname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_province'); ?>
		<?php echo $form->textField($model,'sbi_province'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_city'); ?>
		<?php echo $form->textField($model,'sbi_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_district'); ?>
		<?php echo $form->textField($model,'sbi_district'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_section'); ?>
		<?php echo $form->textField($model,'sbi_section'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_loop'); ?>
		<?php echo $form->textField($model,'sbi_loop'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_tradecircle'); ?>
		<?php echo $form->textField($model,'sbi_tradecircle'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_busway'); ?>
		<?php echo $form->textField($model,'sbi_busway',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_address'); ?>
		<?php echo $form->textField($model,'sbi_address',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_foreign'); ?>
		<?php echo $form->textField($model,'sbi_foreign'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_openingtime'); ?>
		<?php echo $form->textField($model,'sbi_openingtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_propertyname'); ?>
		<?php echo $form->textField($model,'sbi_propertyname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_developer'); ?>
		<?php echo $form->textField($model,'sbi_developer',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_berthnum'); ?>
		<?php echo $form->textField($model,'sbi_berthnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_rentberth'); ?>
		<?php echo $form->textField($model,'sbi_rentberth'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_propertyprice'); ?>
		<?php echo $form->textField($model,'sbi_propertyprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_propertydegree'); ?>
		<?php echo $form->textField($model,'sbi_propertydegree'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_elevatornum'); ?>
		<?php echo $form->textField($model,'sbi_elevatornum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_fireelevatornum'); ?>
		<?php echo $form->textField($model,'sbi_fireelevatornum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_buildingarea'); ?>
		<?php echo $form->textField($model,'sbi_buildingarea'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_floorarea'); ?>
		<?php echo $form->textField($model,'sbi_floorarea'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_floor'); ?>
		<?php echo $form->textField($model,'sbi_floor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_floordownground'); ?>
		<?php echo $form->textField($model,'sbi_floordownground'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_floorupground'); ?>
		<?php echo $form->textField($model,'sbi_floorupground'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_roomnum'); ?>
		<?php echo $form->textField($model,'sbi_roomnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_buildingintroduce'); ?>
		<?php echo $form->textArea($model,'sbi_buildingintroduce',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_peripheral'); ?>
		<?php echo $form->textArea($model,'sbi_peripheral',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_traffic'); ?>
		<?php echo $form->textArea($model,'sbi_traffic',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_decoration'); ?>
		<?php echo $form->textArea($model,'sbi_decoration',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_floorinformation'); ?>
		<?php echo $form->textArea($model,'sbi_floorinformation',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_parkinginformation'); ?>
		<?php echo $form->textArea($model,'sbi_parkinginformation',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_otherinformation'); ?>
		<?php echo $form->textArea($model,'sbi_otherinformation',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_titlepic'); ?>
		<?php echo $form->textField($model,'sbi_titlepic'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_avgrentprice'); ?>
		<?php echo $form->textField($model,'sbi_avgrentprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_avgsellprice'); ?>
		<?php echo $form->textField($model,'sbi_avgsellprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_isnew'); ?>
		<?php echo $form->textField($model,'sbi_isnew'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_x'); ?>
		<?php echo $form->textField($model,'sbi_x',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_y'); ?>
		<?php echo $form->textField($model,'sbi_y',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_tag'); ?>
		<?php echo $form->textField($model,'sbi_tag',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_recordtime'); ?>
		<?php echo $form->textField($model,'sbi_recordtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_updatetime'); ?>
		<?php echo $form->textField($model,'sbi_updatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_tel'); ?>
		<?php echo $form->textField($model,'sbi_tel',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->