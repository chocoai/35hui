<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'twittersuggest-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'t_message'); ?>
		<?php echo $form->textArea($model,'t_message'); ?>
		<?php echo $form->error($model,'t_message'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->