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
		<?php echo $form->label($model,'mr_remark'); ?>
		<?php echo $form->textArea($model,'mr_remark',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mr_salesman'); ?>
		<?php echo $form->textField($model,'mr_salesman',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->