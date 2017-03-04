<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'np_id'); ?>
		<?php echo $form->textField($model,'np_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'np_title'); ?>
		<?php echo $form->textField($model,'np_title',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'np_picurl'); ?>
		<?php echo $form->textField($model,'np_picurl',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'np_linkurl'); ?>
		<?php echo $form->textField($model,'np_linkurl',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'np_type'); ?>
		<?php echo $form->textField($model,'np_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'np_order'); ?>
		<?php echo $form->textField($model,'np_order'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->