<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'fr_id'); ?>
		<?php echo $form->textField($model,'fr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fr_content'); ?>
		<?php echo $form->textArea($model,'fr_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fr_salesman'); ?>
		<?php echo $form->textField($model,'fr_salesman',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fr_remindtime'); ?>
		<?php echo $form->textField($model,'fr_remindtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fr_reservetime'); ?>
		<?php echo $form->textField($model,'fr_reservetime',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fr_address'); ?>
		<?php echo $form->textField($model,'fr_address',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->