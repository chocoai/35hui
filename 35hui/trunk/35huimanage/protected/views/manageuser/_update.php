<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manageuser-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'mag_realname'); ?>
		<?php echo $form->textField($model,'mag_realname',array('maxlength'=>50)); ?>
		<?php echo $form->error($model,'mag_realname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mag_tel'); ?>
		<?php echo $form->textField($model,'mag_tel',array('maxlength'=>11)); ?>
		<?php echo $form->error($model,'mag_tel'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->