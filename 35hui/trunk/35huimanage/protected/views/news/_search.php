<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'n_id'); ?>
		<?php echo $form->textField($model,'n_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_title'); ?>
		<?php echo $form->textField($model,'n_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_content'); ?>
		<?php echo $form->textArea($model,'n_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_date'); ?>
		<?php echo $form->textField($model,'n_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_from'); ?>
		<?php echo $form->textField($model,'n_from',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_state'); ?>
		<?php echo $form->textField($model,'n_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_click'); ?>
		<?php echo $form->textField($model,'n_click'); ?>
	</div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'n_leave'); ?>
        <?php echo $form->dropDownList($model,'n_leave',News::$leave); ?>
        <?php echo $form->error($model,'n_leave'); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'n_keyword'); ?>
		<?php echo $form->textField($model,'n_keyword',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->