<div class="wide form">

<?php
    $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));?>

	<div class="row">
		<?php echo $form->label($model,'ts_id'); ?>
		<?php echo $form->textField($model,'ts_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ts_userid'); ?>
		<?php echo $form->textField($model,'ts_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ts_buildingid'); ?>
		<?php echo $form->textField($model,'ts_buildingid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ts_content'); ?>
		<?php echo $form->textField($model,'ts_content',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ts_suggesttime'); ?>
		<?php echo $form->textField($model,'ts_suggesttime'); ?>
	</div>

  

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->