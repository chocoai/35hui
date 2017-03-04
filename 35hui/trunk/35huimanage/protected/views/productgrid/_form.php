<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'newspic-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
    )
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="row">
		<?php echo $form->labelEx($model,'p_baseprice'); ?>
		<?php echo $form->textField($model,'p_baseprice'); ?>&nbsp; 点/天
		<?php echo $form->error($model,'p_baseprice'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'p_nowprice'); ?>
		<?php echo $form->textField($model,'p_nowprice'); ?>&nbsp;点/天
		<?php echo $form->error($model,'p_nowprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_raisespercent'); ?>
		<?php echo $form->textField($model,'p_raisespercent'); ?>&nbsp;请输入小于1的值
		<?php echo $form->error($model,'p_raisespercent'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'p_droppercent'); ?>
		<?php echo $form->textField($model,'p_droppercent'); ?>&nbsp;请输入小于1的值
		<?php echo $form->error($model,'p_droppercent'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'p_maxbuydays'); ?>
		<?php echo $form->textField($model,'p_maxbuydays'); ?>&nbsp;天
		<?php echo $form->error($model,'p_maxbuydays'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'p_protectpricedays'); ?>
		<?php echo $form->textField($model,'p_protectpricedays'); ?>&nbsp;天
		<?php echo $form->error($model,'p_droppercent'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('更新'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->