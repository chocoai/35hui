<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'p_id'); ?>
		<?php echo $form->textField($model,'p_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_sourceid'); ?>
		<?php echo $form->textField($model,'p_sourceid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_sourcetype'); ?>
		<?php echo $form->textField($model,'p_sourcetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_type'); ?>
		<?php echo $form->textField($model,'p_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_img'); ?>
		<?php echo $form->textField($model,'p_img',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_tinyimg'); ?>
		<?php echo $form->textField($model,'p_tinyimg',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_uploadtime'); ?>
		<?php echo $form->textField($model,'p_uploadtime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->