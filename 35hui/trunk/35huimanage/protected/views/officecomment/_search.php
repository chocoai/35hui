<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'oc_id'); ?>
		<?php echo $form->textField($model,'oc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oc_cid'); ?>
		<?php echo $form->textField($model,'oc_cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oc_officeid'); ?>
		<?php echo $form->textField($model,'oc_officeid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oc_traffice'); ?>
		<?php echo $form->textField($model,'oc_traffice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oc_facility'); ?>
		<?php echo $form->textField($model,'oc_facility'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oc_adorn'); ?>
		<?php echo $form->textField($model,'oc_adorn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oc_comment'); ?>
		<?php echo $form->textField($model,'oc_comment',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oc_comdate'); ?>
		<?php echo $form->textField($model,'oc_comdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->