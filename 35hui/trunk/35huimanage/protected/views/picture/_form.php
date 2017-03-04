<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'picture-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'p_sourceid'); ?>
		<?php echo $form->textField($model,'p_sourceid'); ?>
		<?php echo $form->error($model,'p_sourceid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_sourcetype'); ?>
		<?php echo $form->textField($model,'p_sourcetype'); ?>
		<?php echo $form->error($model,'p_sourcetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_type'); ?>
		<?php echo $form->textField($model,'p_type'); ?>
		<?php echo $form->error($model,'p_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_img'); ?>
		<?php echo $form->textField($model,'p_img',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'p_img'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_tinyimg'); ?>
		<?php echo $form->textField($model,'p_tinyimg',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'p_tinyimg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_uploadtime'); ?>
		<?php echo $form->textField($model,'p_uploadtime'); ?>
		<?php echo $form->error($model,'p_uploadtime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->