<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'keywordlink-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kdl_name'); ?>
		<?php echo $form->textField($model,'kdl_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kdl_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kdl_url'); ?>
		<?php echo $form->textArea($model,'kdl_url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'kdl_url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->