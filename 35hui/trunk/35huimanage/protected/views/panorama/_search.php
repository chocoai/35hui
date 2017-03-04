<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'p_id'); ?>
		<?php echo $form->textField($model,'p_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_title'); ?>
		<?php echo $form->textField($model,'p_title',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_description'); ?>
		<?php echo $form->textField($model,'p_description',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_remark'); ?>
		<?php echo $form->textField($model,'p_remark',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_tag'); ?>
		<?php echo $form->textField($model,'p_tag',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_url'); ?>
		<?php echo $form->textField($model,'p_url',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_buildingid'); ?>
		<?php echo $form->textField($model,'p_buildingid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_type'); ?>
		<?php echo $form->textField($model,'p_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_uploadtime'); ?>
		<?php echo $form->textField($model,'p_uploadtime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->