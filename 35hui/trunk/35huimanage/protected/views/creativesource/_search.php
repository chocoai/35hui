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
		<?php echo $form->label($model,'cr_cpid'); ?>
		<?php echo $form->textField($model,'cr_cpid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_userid'); ?>
		<?php echo $form->textField($model,'cr_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_dongname'); ?>
		<?php echo $form->textField($model,'cr_dongname',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_floortype'); ?>
		<?php echo $form->textField($model,'cr_floortype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_area'); ?>
		<?php echo $form->textField($model,'cr_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_dayrentprice'); ?>
		<?php echo $form->textField($model,'cr_dayrentprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_monthrentprice'); ?>
		<?php echo $form->textField($model,'cr_monthrentprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_ispanorama'); ?>
		<?php echo $form->textField($model,'cr_ispanorama'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_titlepicurl'); ?>
		<?php echo $form->textField($model,'cr_titlepicurl'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_visit'); ?>
		<?php echo $form->textField($model,'cr_visit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_releasedate'); ?>
		<?php echo $form->textField($model,'cr_releasedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_updatedate'); ?>
		<?php echo $form->textField($model,'cr_updatedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_expiredate'); ?>
		<?php echo $form->textField($model,'cr_expiredate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cr_check'); ?>
		<?php echo $form->textField($model,'cr_check'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->