<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'dk_id'); ?>
		<?php echo $form->textField($model,'dk_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dk_name'); ?>
		<?php echo $form->textField($model,'dk_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kd_key'); ?>
		<?php echo $form->textField($model,'kd_key',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->