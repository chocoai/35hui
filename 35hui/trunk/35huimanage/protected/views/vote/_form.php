<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vote-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'vt_vote'); ?>
		<?php echo $form->textField($model,'vt_vote',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'vt_vote'); ?>
	</div>

    <div class="row" style="display: none">
		<?php echo $form->labelEx($model,'vt_parent'); ?>
		<?php echo $form->textField($model,'vt_parent'); ?>
		<?php echo $form->error($model,'vt_parent'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'vt_num'); ?>
		<?php echo $form->textField($model,'vt_num'); ?>
		<?php echo $form->error($model,'vt_num'); ?><span style="color: red"><?php echo $model->vt_parent?'':'非零数字设置成多选';?></span>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->