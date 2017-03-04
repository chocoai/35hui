<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'msg_id'); ?>
		<?php echo $form->textField($model,'msg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg_sendid'); ?>
		<?php echo $form->textField($model,'msg_sendid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg_revid'); ?>
		<?php echo $form->textField($model,'msg_revid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg_title'); ?>
		<?php echo $form->textField($model,'msg_title',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg_content'); ?>
		<?php echo $form->textField($model,'msg_content',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg_type'); ?>
		<?php echo $form->textField($model,'msg_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg_time'); ?>
		<?php echo $form->textField($model,'msg_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg_senddel'); ?>
		<?php echo $form->textField($model,'msg_senddel'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg_revdel'); ?>
		<?php echo $form->textField($model,'msg_revdel'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg_isread'); ?>
		<?php echo $form->textField($model,'msg_isread'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->