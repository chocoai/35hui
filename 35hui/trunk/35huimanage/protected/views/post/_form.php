<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">用<span class="required">*</span> 标注的为必填项.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
		<?php echo $form->labelEx($model,'post_title'); ?>
		<?php echo $form->textArea($model,'post_title',array("rows"=>"5","cols"=>"80")); ?>
		<?php echo $form->error($model,'post_title'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'post_content'); ?>
		<?php echo $form->textArea($model,'post_content',array("rows"=>"10","cols"=>"80")); ?>
		<?php echo $form->error($model,'post_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_role'); ?>
		<?php echo $form->dropDownList($model,'post_role',Post::$roleDescription); ?>
		<?php echo $form->error($model,'post_role'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('发送'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->