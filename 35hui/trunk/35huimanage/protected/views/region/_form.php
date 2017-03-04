<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'region-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'re_name'); ?>
		<?php echo $form->textField($model,'re_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'re_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'re_parent_id'); ?>
		<?php echo $form->textField($model,'re_parent_id'); ?>
		<?php echo $form->error($model,'re_parent_id'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'re_recommendprice'); ?>
		<?php echo $form->textField($model,'re_recommendprice'); ?>
		<?php echo $form->error($model,'re_recommendprice'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->