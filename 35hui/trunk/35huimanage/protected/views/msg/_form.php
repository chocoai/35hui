<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'msg-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'msg_revid'); ?>
        <?php echo CHtml::textField('',$model->msg_revid==0?"客服管理员":User::model()->getUserName($model->msg_revid),array('readonly'=>'true')); ?>
		<?php echo $form->hiddenField($model,'msg_revid',array('readonly'=>'true')); ?>
		<?php echo $form->error($model,'msg_revid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'msg_title'); ?>
		<?php echo $form->textField($model,'msg_title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'msg_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'msg_content'); ?>
		<?php echo $form->textField($model,'msg_content',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'msg_content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('发送'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->