<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ad_id'); ?>
		<?php echo $form->textField($model,'ad_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ad_position'); ?>
		<?php echo $form->textField($model,'ad_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ad_picurl'); ?>
		<?php echo $form->textField($model,'ad_picurl',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ad_linkurl'); ?>
		<?php echo $form->textField($model,'ad_linkurl',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ad_alt'); ?>
		<?php echo $form->textField($model,'ad_alt',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ad_uploadtime'); ?>
		<?php echo $form->textField($model,'ad_uploadtime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->