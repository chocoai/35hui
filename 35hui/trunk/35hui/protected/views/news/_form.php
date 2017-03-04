<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'n_title'); ?>
		<?php echo $form->textField($model,'n_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'n_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_content'); ?>
		<?php echo $form->textArea($model,'n_content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'n_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_date'); ?>
		<?php echo $form->textField($model,'n_date'); ?>
		<?php echo $form->error($model,'n_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_picture'); ?>
		<?php echo $form->textField($model,'n_picture',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'n_picture'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_from'); ?>
		<?php echo $form->textField($model,'n_from',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'n_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_state'); ?>
		<?php echo $form->textField($model,'n_state'); ?>
		<?php echo $form->error($model,'n_state'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->