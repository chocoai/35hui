<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'tag_id'); ?>
		<?php echo $form->textField($model,'tag_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tag_name'); ?>
		<?php echo $form->textField($model,'tag_name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tag_belong'); ?>
		<?php echo $form->textField($model,'tag_belong'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tag_frequency'); ?>
		<?php echo $form->textField($model,'tag_frequency'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'markettype'); ?>
		<?php echo $form->textField($model,'markettype'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->