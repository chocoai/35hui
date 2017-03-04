<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sw_id'); ?>
		<?php echo $form->textField($model,'sw_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sw_stationname'); ?>
		<?php echo $form->textField($model,'sw_stationname',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sw_parentid'); ?>
		<?php echo $form->textField($model,'sw_parentid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sw_x'); ?>
		<?php echo $form->textField($model,'sw_x',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sw_y'); ?>
		<?php echo $form->textField($model,'sw_y',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->