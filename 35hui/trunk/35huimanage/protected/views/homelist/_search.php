<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'hl_id'); ?>
		<?php echo $form->textField($model,'hl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hl_type'); ?>
		<?php echo $form->textField($model,'hl_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hl_piclist'); ?>
		<?php echo $form->textField($model,'hl_piclist',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hl_titlelist'); ?>
		<?php echo $form->textField($model,'hl_titlelist',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->