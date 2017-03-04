<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Uagentcomment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uac_cid'); ?>
		<?php echo $form->textField($model,'uac_cid'); ?>
		<?php echo $form->error($model,'uac_cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uac_agentid'); ?>
		<?php echo $form->textField($model,'uac_agentid'); ?>
		<?php echo $form->error($model,'uac_agentid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uac_quality'); ?>
		<?php echo $form->textField($model,'uac_quality'); ?>
		<?php echo $form->error($model,'uac_quality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uac_service'); ?>
		<?php echo $form->textField($model,'uac_service'); ?>
		<?php echo $form->error($model,'uac_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uac_comment'); ?>
		<?php echo $form->textArea($model,'uac_comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'uac_comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uac_comdate'); ?>
		<?php echo $form->textField($model,'uac_comdate'); ?>
		<?php echo $form->error($model,'uac_comdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->