<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'kdl_id'); ?>
		<?php echo $form->textField($model,'kdl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kdl_name'); ?>
		<?php echo $form->textField($model,'kdl_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kdl_url'); ?>
		<?php echo $form->textArea($model,'kdl_url',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->