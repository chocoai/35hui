<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ed_id'); ?>
		<?php echo $form->textField($model,'ed_id'); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'ed_type'); ?>
        <?php echo $form->dropDownList($model,'ed_type',Examchoice::$ec_type,array("empty"=>"--请选择--")); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'ed_grade'); ?>
		<?php echo $form->textField($model,'ed_grade'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ed_describe'); ?>
		<?php echo $form->textArea($model,'ed_describe',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->