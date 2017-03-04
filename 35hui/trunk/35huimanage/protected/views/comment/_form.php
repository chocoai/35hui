<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Comment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'n_id'); ?>
		<?php echo $form->textField($model,'n_id'); ?>
		<?php echo $form->error($model,'n_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_comment'); ?>
		<?php echo $form->textArea($model,'c_comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'c_comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_date'); ?>
		<?php echo $form->textField($model,'c_date'); ?>
		<?php echo $form->error($model,'c_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->