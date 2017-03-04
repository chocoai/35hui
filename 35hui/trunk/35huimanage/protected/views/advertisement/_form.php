<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertisement-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">用 <span class="required">*</span> 标记的为必填项.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ad_picurl'); ?>
        <?php echo $form->fileField($model, 'ad_picurl'); ?>
		<?php echo $form->error($model,'ad_picurl'); ?>
        <font style="color: red">图片规格最好为:宽<?=$adConfig['width']?>px,高<?=$adConfig['height']?>px;</font>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ad_linkurl'); ?>
		<?php echo $form->textField($model,'ad_linkurl',array('size'=>60,'maxlength'=>100,'value'=>urldecode($model->ad_linkurl))); ?>
		<?php echo $form->error($model,'ad_linkurl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ad_alt'); ?>
		<?php echo $form->textField($model,'ad_alt',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'ad_alt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '上传' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->