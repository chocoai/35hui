<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'buyrecord-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">标识 <span class="required">*</span> 号为必填.</p>

	<?php 
            echo $form->errorSummary($model);
            if($model->isNewRecord){
                echo $form->hiddenField($model,'br_mrid',array('value'=>$id));
         }?>
	<div class="row">
		<?php echo $form->labelEx($model,'br_fcid'); ?>
		<?php echo $form->radioButtonList($model,'br_fcid',Fundsconfig::model()->formatData(),array("style"=>"display:inline","separator"=>"<br/>","labelOptions"=>array("style"=>"display:inline"))); ?>
		<?php echo $form->error($model,'br_fcid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'br_other'); ?>
		<?php echo $form->textArea($model,'br_other',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'br_other'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'br_amount'); ?>
		<?php echo $form->textField($model,'br_amount'); ?>元
		<?php echo $form->error($model,'br_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'br_contractno'); ?>
		<?php echo $form->textField($model,'br_contractno',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'br_contractno'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->