<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sbc_id'); ?>
		<?php echo $form->textField($model,'sbc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbc_cid'); ?>
		<?php echo $form->textField($model,'sbc_cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbc_buildingid'); ?>
		<?php echo $form->textField($model,'sbc_buildingid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbc_traffice'); ?>
		<?php echo $form->textField($model,'sbc_traffice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbc_facility'); ?>
		<?php echo $form->textField($model,'sbc_facility'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbc_adorn'); ?>
		<?php echo $form->textField($model,'sbc_adorn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbc_comment'); ?>
		<?php echo $form->textField($model,'sbc_comment',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbc_comdate'); ?>
		<?php echo $form->textField($model,'sbc_comdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->