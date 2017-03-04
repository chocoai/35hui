<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cb_id'); ?>
		<?php echo $form->textField($model,'cb_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cb_issuednum'); ?>
		<?php echo $form->textField($model,'cb_issuednum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cb_inputnum'); ?>
		<?php echo $form->textField($model,'cb_inputnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cb_refreshnum'); ?>
		<?php echo $form->textField($model,'cb_refreshnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cb_comboprice'); ?>
		<?php echo $form->textField($model,'cb_comboprice'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->