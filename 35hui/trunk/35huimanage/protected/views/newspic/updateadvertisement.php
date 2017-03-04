<?php
$this->breadcrumbs=array(
	'广告图片'=>array('advertisement'),
	'更新',
);
$this->currentMenu = 29;
?>

<h1>更新广告图片</h1>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'newspic-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'enctype'=>'multipart/form-data',
        )
    )); ?>
    <div class="row">
        <?php
            echo CHtml::image(PIC_URL.$model->np_picurl,"",array('style'=>'width:126px;height:90px;'));
        ?>
    </div>
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
		<?php echo $form->labelEx($model,'np_picurl'); ?>
		<?php echo $form->fileField($model,'np_picurl'); ?>
		<?php echo $form->error($model,'np_picurl'); ?>
	</div>
    <div class="row buttons">
		<?php echo CHtml::submitButton('更新'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>