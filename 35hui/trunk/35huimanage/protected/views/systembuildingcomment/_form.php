<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Systembuildingcomment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sbc_cid'); ?>
		<?php echo $form->textField($model,'sbc_cid'); ?>
		<?php echo $form->error($model,'sbc_cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbc_buildingid'); ?>
		<?php echo $form->textField($model,'sbc_buildingid'); ?>
		<?php echo $form->error($model,'sbc_buildingid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbc_traffice'); ?>
		<?php echo $form->textField($model,'sbc_traffice'); ?>
		<?php echo $form->error($model,'sbc_traffice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbc_facility'); ?>
		<?php echo $form->textField($model,'sbc_facility'); ?>
		<?php echo $form->error($model,'sbc_facility'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbc_adorn'); ?>
		<?php echo $form->textField($model,'sbc_adorn'); ?>
		<?php echo $form->error($model,'sbc_adorn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbc_comment'); ?>
		<?php echo $form->textField($model,'sbc_comment',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'sbc_comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sbc_comdate'); ?>
		<?php echo $form->textField($model,'sbc_comdate'); ?>
		<?php echo $form->error($model,'sbc_comdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->