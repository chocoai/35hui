<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_salt'); ?>
		<?php echo $form->textField($model,'user_salt',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_salt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_pwd'); ?>
		<?php echo $form->textField($model,'user_pwd',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_pwd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_role'); ?>
		<?php echo $form->textField($model,'user_role'); ?>
		<?php echo $form->error($model,'user_role'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_regtime'); ?>
		<?php echo $form->textField($model,'user_regtime'); ?>
		<?php echo $form->error($model,'user_regtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_loginnum'); ?>
		<?php echo $form->textField($model,'user_loginnum'); ?>
		<?php echo $form->error($model,'user_loginnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_lasttime'); ?>
		<?php echo $form->textField($model,'user_lasttime'); ?>
		<?php echo $form->error($model,'user_lasttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_lastip'); ?>
		<?php echo $form->textField($model,'user_lastip',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_lastip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_value'); ?>
		<?php echo $form->textField($model,'user_value'); ?>
		<?php echo $form->error($model,'user_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->