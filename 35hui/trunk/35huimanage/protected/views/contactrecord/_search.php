<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cr_id'); ?>
		<?php echo $form->textField($model,'cr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_company'); ?>
		<?php echo $form->textField($model,'cr_company',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_realname'); ?>
		<?php echo $form->textField($model,'cr_realname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_salesman'); ?>
		<?php echo $form->textField($model,'cr_salesman'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->