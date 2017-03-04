<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'oprationconfig-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ocf_name'); ?>
		<?php echo !$model->isNewRecord?$model->ocf_name:$form->textField($model,'ocf_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ocf_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ocf_key'); ?>
		<?php echo !$model->isNewRecord?$model->ocf_key:$form->textField($model,'ocf_key',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ocf_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ocf_val'); ?>
		<?php echo $form->textField($model,'ocf_val',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ocf_val'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ocf_desc'); ?>
		<?php echo $form->textArea($model,'ocf_desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ocf_desc'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->