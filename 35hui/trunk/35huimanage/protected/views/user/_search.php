<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_salt'); ?>
		<?php echo $form->textField($model,'user_salt',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_pwd'); ?>
		<?php echo $form->textField($model,'user_pwd',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_role'); ?>
		<?php echo $form->textField($model,'user_role'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_regtime'); ?>
		<?php echo $form->textField($model,'user_regtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_loginnum'); ?>
		<?php echo $form->textField($model,'user_loginnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_lasttime'); ?>
		<?php echo $form->textField($model,'user_lasttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_lastip'); ?>
		<?php echo $form->textField($model,'user_lastip',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_value'); ?>
		<?php echo $form->textField($model,'user_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->