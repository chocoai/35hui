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
		<?php echo $form->labelEx($model,'np_title'); ?>
		<?php echo $form->textField($model,'np_title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'np_title'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'np_linkurl'); ?>
		<?php echo $form->textField($model,'np_linkurl',array('size'=>60,'maxlength'=>100)); ?>如：http://www.huihenet.com
		<?php echo $form->error($model,'np_linkurl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'np_order'); ?>
		<?php echo $form->textField($model,'np_order',array("maxlength"=>3)); ?>请输入（1-999）
		<?php echo $form->error($model,'np_order'); ?>
	</div>
    
    <?php
    if(isset($action)&&$action=="update"){
    ?>
    <div class="row">
        <?php echo CHtml::image(PIC_URL.$model->np_picurl,'',array('style'=>'width:345px;height:200px;')); ?>
    </div>
    <?php
    }
    ?>
    <div class="row">
		<?php echo $form->labelEx($model,'np_picurl'); ?>
		<?php echo $form->fileField($model,'np_picurl'); ?>
		<?php echo $form->error($model,'np_picurl'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '更新'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->