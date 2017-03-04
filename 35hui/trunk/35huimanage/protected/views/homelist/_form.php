<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'homelist-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> 必填</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'hl_type'); ?>
		<?php echo $form->textField($model,'hl_type'); ?>
		<?php echo $form->error($model,'hl_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hl_piclist'); ?>
		<?php echo $form->textField($model,'hl_piclist',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'hl_piclist'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hl_titlelist'); ?>
		<?php echo $form->textField($model,'hl_titlelist',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'hl_titlelist'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->