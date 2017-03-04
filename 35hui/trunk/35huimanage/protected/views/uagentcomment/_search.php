<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'uac_id'); ?>
		<?php echo $form->textField($model,'uac_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uac_cid'); ?>
		<?php echo $form->textField($model,'uac_cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uac_agentid'); ?>
		<?php echo $form->textField($model,'uac_agentid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uac_quality'); ?>
		<?php echo $form->textField($model,'uac_quality'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uac_service'); ?>
		<?php echo $form->textField($model,'uac_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uac_comment'); ?>
		<?php echo $form->textArea($model,'uac_comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uac_comdate'); ?>
		<?php echo $form->textField($model,'uac_comdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->