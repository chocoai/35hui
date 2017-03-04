<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ucc_id'); ?>
		<?php echo $form->textField($model,'ucc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ucc_cid'); ?>
		<?php echo $form->textField($model,'ucc_cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ucc_comid'); ?>
		<?php echo $form->textField($model,'ucc_comid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ucc_quality'); ?>
		<?php echo $form->textField($model,'ucc_quality'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ucc_service'); ?>
		<?php echo $form->textField($model,'ucc_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ucc_comment'); ?>
		<?php echo $form->textField($model,'ucc_comment',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ucc_comdate'); ?>
		<?php echo $form->textField($model,'ucc_comdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->