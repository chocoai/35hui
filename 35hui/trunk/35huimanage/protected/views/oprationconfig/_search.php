<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ocf_id'); ?>
		<?php echo $form->textField($model,'ocf_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ocf_name'); ?>
		<?php echo $form->textField($model,'ocf_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ocf_key'); ?>
		<?php echo $form->textField($model,'ocf_key',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ocf_val'); ?>
		<?php echo $form->textField($model,'ocf_val',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ocf_desc'); ?>
		<?php echo $form->textArea($model,'ocf_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->