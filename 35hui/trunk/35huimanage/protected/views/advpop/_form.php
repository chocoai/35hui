<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advpop-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'adp_position'); ?>
		<?php echo $form->dropDownList($model,'adp_position',Advpop::$positionConfig); ?>
		<?php echo $form->error($model,'adp_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adp_picurl'); ?>
		<input type="file" id="Advpop_adp_picurl" name="adp_picurl">
		<?php echo $form->error($model,'adp_picurl'); ?><font color="red">注意广告大小为<?php echo implode("&times;", Advpop::$advConfig['normal']),' 或者 ',implode("&times;", Advpop::$advConfig['more'])?></font>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adp_linkurl'); ?>
		<?php echo $form->textField($model,'adp_linkurl',array('size'=>40,'maxlength'=>125)); ?>
		<?php echo $form->error($model,'adp_linkurl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adp_title'); ?>
		<?php echo $form->textField($model,'adp_title',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'adp_title'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '修改'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->