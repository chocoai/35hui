<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'examdescribe-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ed_type'); ?>
		<?php echo Examdescribe::$ed_type[$model->ed_type]; ?>
		<?php echo $form->error($model,'ed_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ed_grade'); ?>
		<?php echo $model->ed_grade." ".Examdescribe::model()->getPoint($model->ed_grade); ?>
		<?php echo $form->error($model,'ed_grade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ed_describe'); ?>
		<?php echo $form->textArea($model,'ed_describe',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ed_describe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->