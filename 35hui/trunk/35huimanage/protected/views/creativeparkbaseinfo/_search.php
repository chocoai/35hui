<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cp_id'); ?>
		<?php echo $form->textField($model,'cp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_name'); ?>
		<?php echo $form->textField($model,'cp_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_englishname'); ?>
		<?php echo $form->textField($model,'cp_englishname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_pinyinshortname'); ?>
		<?php echo $form->textField($model,'cp_pinyinshortname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_pinyinlongname'); ?>
		<?php echo $form->textField($model,'cp_pinyinlongname',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_district'); ?>
		<?php echo $form->textField($model,'cp_district'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_address'); ?>
		<?php echo $form->textField($model,'cp_address',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_avgrentprice'); ?>
		<?php echo $form->textField($model,'cp_avgrentprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_developer'); ?>
		<?php echo $form->textField($model,'cp_developer',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_propertyprice'); ?>
		<?php echo $form->textField($model,'cp_propertyprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_propertyname'); ?>
		<?php echo $form->textField($model,'cp_propertyname',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_openingtime'); ?>
		<?php echo $form->textField($model,'cp_openingtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_defanglv'); ?>
		<?php echo $form->textField($model,'cp_defanglv'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_area'); ?>
		<?php echo $form->textField($model,'cp_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_fengearea'); ?>
		<?php echo $form->textField($model,'cp_fengearea',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_floorheight'); ?>
		<?php echo $form->textField($model,'cp_floorheight',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_form'); ?>
		<?php echo $form->textField($model,'cp_form',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_introduce'); ?>
		<?php echo $form->textArea($model,'cp_introduce',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_traffic'); ?>
		<?php echo $form->textArea($model,'cp_traffic',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_carport'); ?>
		<?php echo $form->textArea($model,'cp_carport',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_propertyserver'); ?>
		<?php echo $form->textArea($model,'cp_propertyserver',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_roommating'); ?>
		<?php echo $form->textArea($model,'cp_roommating',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_peripheral'); ?>
		<?php echo $form->textArea($model,'cp_peripheral',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_x'); ?>
		<?php echo $form->textField($model,'cp_x',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cp_y'); ?>
		<?php echo $form->textField($model,'cp_y',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->