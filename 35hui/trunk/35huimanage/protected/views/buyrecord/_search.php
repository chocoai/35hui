<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'br_id'); ?>
		<?php echo $form->textField($model,'br_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_mrid'); ?>
		<?php echo $form->textField($model,'br_mrid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_fcid'); ?>
		<?php echo $form->textField($model,'br_fcid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_other'); ?>
		<?php echo $form->textField($model,'br_other',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_amount'); ?>
		<?php echo $form->textField($model,'br_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_contractno'); ?>
		<?php echo $form->textField($model,'br_contractno',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->