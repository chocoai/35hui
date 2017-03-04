<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'mr_id'); ?>
		<?php echo $form->textField($model,'mr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mr_sendid'); ?>
		<?php echo $form->textField($model,'mr_sendid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mr_content'); ?>
		<?php echo $form->textField($model,'mr_content',array('size'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mr_time'); ?>
		<?php echo $form->textField($model,'mr_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->