<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cbl_id'); ?>
		<?php echo $form->textField($model,'cbl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cbl_uid'); ?>
		<?php echo $form->textField($model,'cbl_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cbl_content'); ?>
		<?php echo $form->textField($model,'cbl_content',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cbl_starttime'); ?>
		<?php echo $form->textField($model,'cbl_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cbl_endtime'); ?>
		<?php echo $form->textField($model,'cbl_endtime'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'cbl_muid'); ?>
		<?php echo $form->textField($model,'cbl_muid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->