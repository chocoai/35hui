<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'creativedong-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_cpid'); ?>
		<?php echo $form->textField($model,'cd_cpid',array('readonly'=>"true",'size'=>10)); echo ' ',$parkModel->cp_name?>
		<?php echo $form->error($model,'cd_cpid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_lounum'); ?>
		<?php echo $form->textField($model,'cd_lounum',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'cd_lounum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_area'); ?>
		<?php echo $form->textField($model,'cd_area'); ?>
		<?php echo $form->error($model,'cd_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_floorarea'); ?>
		<?php echo $form->textField($model,'cd_floorarea'); ?>
		<?php echo $form->error($model,'cd_floorarea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_fengearea'); ?>
		<?php echo $form->textField($model,'cd_fengearea',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cd_fengearea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_floornum'); ?>
		<?php echo $form->textField($model,'cd_floornum'); ?>
		<?php echo $form->error($model,'cd_floornum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_form'); ?>
		<?php echo $form->textField($model,'cd_form',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cd_form'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_floorheight'); ?>
		<?php echo $form->textField($model,'cd_floorheight'); ?>
		<?php echo $form->error($model,'cd_floorheight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_liftnum'); ?>
		<?php echo $form->textField($model,'cd_liftnum'); ?>
		<?php echo $form->error($model,'cd_liftnum'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->