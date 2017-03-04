<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'twittersuggest-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'ts_userid'); ?>
		<?php echo $form->textField($model,'ts_userid'); ?>
		<?php echo $form->error($model,'ts_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ts_buildingid'); ?>
		<?php echo $form->textField($model,'ts_buildingid'); ?>
		<?php echo $form->error($model,'ts_buildingid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ts_content'); ?>
		<?php echo $form->textField($model,'ts_content',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'ts_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ts_suggesttime'); ?>
		<?php echo $form->textField($model,'ts_suggesttime'); ?>
		<?php echo $form->error($model,'ts_suggesttime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->