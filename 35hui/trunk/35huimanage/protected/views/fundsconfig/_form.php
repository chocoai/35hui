<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fundsconfig-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fc_rmbprice'); ?>
		<?php echo $form->textField($model,'fc_rmbprice'); ?>&nbsp;元(面议请填0)
		<?php echo $form->error($model,'fc_rmbprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fc_giveprice'); ?>
		<?php echo $form->textField($model,'fc_giveprice'); ?>&nbsp;(不赠送/面议请填0)
		<?php echo $form->error($model,'fc_giveprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fc_givepoint'); ?>
		<?php echo $form->textField($model,'fc_givepoint'); ?>&nbsp;(不赠送/面议请填0)
		<?php echo $form->error($model,'fc_givepoint'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'fc_givepanoramadevice'); ?>
		<?php echo $form->textField($model,'fc_givepanoramadevice'); ?>&nbsp;(不赠送/面议请填0)
		<?php echo $form->error($model,'fc_givepanoramadevice'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'fc_desc'); ?>
		<?php echo $form->textField($model,'fc_desc'); ?>(如2～5人)
		<?php echo $form->error($model,'fc_desc'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'fc_type'); ?>
		<?php echo $form->dropDownList($model,'fc_type',Fundsconfig::$fc_type); ?>
		<?php echo $form->error($model,'fc_type'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'fc_vipexp'); ?>
		<?php echo $form->textField($model,'fc_vipexp',array('size'=>4)); ?> 单位：月（30天）
		<?php echo $form->error($model,'fc_vipexp'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '修改'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->