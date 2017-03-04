<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Ucompanycomment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ucc_cid'); ?>
		<?php echo $form->textField($model,'ucc_cid'); ?>
		<?php echo $form->error($model,'ucc_cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ucc_comid'); ?>
		<?php echo $form->textField($model,'ucc_comid'); ?>
		<?php echo $form->error($model,'ucc_comid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ucc_quality'); ?>
		<?php echo $form->textField($model,'ucc_quality'); ?>
		<?php echo $form->error($model,'ucc_quality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ucc_service'); ?>
		<?php echo $form->textField($model,'ucc_service'); ?>
		<?php echo $form->error($model,'ucc_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ucc_comment'); ?>
		<?php echo $form->textField($model,'ucc_comment',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'ucc_comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ucc_comdate'); ?>
		<?php echo $form->textField($model,'ucc_comdate'); ?>
		<?php echo $form->error($model,'ucc_comdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->