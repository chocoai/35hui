<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'re_id'); ?>
		<?php echo $form->textField($model,'re_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'re_name'); ?>
		<?php echo $form->textField($model,'re_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'re_parent_id'); ?>
		<?php echo $form->textField($model,'re_parent_id'); ?>
	</div>

    <div class="row">
		<?php echo $form->label($model,'re_recommendprice'); ?>
		<?php echo $form->textField($model,'re_recommendprice'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->