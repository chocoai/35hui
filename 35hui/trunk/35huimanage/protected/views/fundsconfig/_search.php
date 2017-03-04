<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'fc_id'); ?>
		<?php echo $form->textField($model,'fc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fc_rmbprice'); ?>
		<?php echo $form->textField($model,'fc_rmbprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fc_giveprice'); ?>
		<?php echo $form->textField($model,'fc_giveprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fc_givepoint'); ?>
		<?php echo $form->textField($model,'fc_givepoint'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fc_givepanoramadevice'); ?>
		<?php echo $form->textField($model,'fc_givepanoramadevice'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->