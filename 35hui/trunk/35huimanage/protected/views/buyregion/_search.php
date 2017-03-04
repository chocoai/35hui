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
		<?php echo $form->label($model,'br_userid'); ?>
		<?php echo $form->textField($model,'br_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_regionid'); ?>
		<?php echo $form->textField($model,'br_regionid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_sourcetype'); ?>
		<?php echo $form->textField($model,'br_sourcetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_sellorrent'); ?>
		<?php echo $form->textField($model,'br_sellorrent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_buytime'); ?>
		<?php echo $form->textField($model,'br_buytime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_expiredate'); ?>
		<?php echo $form->textField($model,'br_expiredate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'br_status'); ?>
		<?php echo $form->textField($model,'br_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->