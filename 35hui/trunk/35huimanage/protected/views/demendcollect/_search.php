<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'dc_id'); ?>
		<?php echo $form->textField($model,'dc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_buildname'); ?>
		<?php echo $form->textField($model,'dc_buildname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_address'); ?>
		<?php echo $form->textField($model,'dc_address',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_area'); ?>
		<?php echo $form->textField($model,'dc_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_price'); ?>
		<?php echo $form->textField($model,'dc_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_contactname'); ?>
		<?php echo $form->textField($model,'dc_contactname',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_register'); ?>
		<?php echo $form->textField($model,'dc_register',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_time'); ?>
		<?php echo $form->textField($model,'dc_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_tel'); ?>
		<?php echo $form->textField($model,'dc_tel',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_mobile'); ?>
		<?php echo $form->textField($model,'dc_mobile',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_email'); ?>
		<?php echo $form->textField($model,'dc_email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_qq'); ?>
		<?php echo $form->textField($model,'dc_qq',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->