<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'qrq_id'); ?>
		<?php echo $form->textField($model,'qrq_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qrq_require'); ?>
		<?php echo $form->textField($model,'qrq_require',array('size'=>60,'maxlength'=>3000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qrq_tel'); ?>
		<?php echo $form->textField($model,'qrq_tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qrq_name'); ?>
		<?php echo $form->textField($model,'qrq_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qrq_email'); ?>
		<?php echo $form->textField($model,'qrq_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qrq_check'); ?>
		<?php echo $form->textField($model,'qrq_check'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qrq_releasedate'); ?>
		<?php echo $form->textField($model,'qrq_releasedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qrq_settledate'); ?>
		<?php echo $form->textField($model,'qrq_settledate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->