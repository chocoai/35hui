<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Officecomment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'oc_cid'); ?>
		<?php echo $form->textField($model,'oc_cid'); ?>
		<?php echo $form->error($model,'oc_cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oc_officeid'); ?>
		<?php echo $form->textField($model,'oc_officeid'); ?>
		<?php echo $form->error($model,'oc_officeid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oc_traffice'); ?>
		<?php echo $form->textField($model,'oc_traffice'); ?>
		<?php echo $form->error($model,'oc_traffice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oc_facility'); ?>
		<?php echo $form->textField($model,'oc_facility'); ?>
		<?php echo $form->error($model,'oc_facility'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oc_adorn'); ?>
		<?php echo $form->textField($model,'oc_adorn'); ?>
		<?php echo $form->error($model,'oc_adorn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oc_comment'); ?>
		<?php echo $form->textField($model,'oc_comment',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'oc_comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oc_comdate'); ?>
		<?php echo $form->textField($model,'oc_comdate'); ?>
		<?php echo $form->error($model,'oc_comdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->