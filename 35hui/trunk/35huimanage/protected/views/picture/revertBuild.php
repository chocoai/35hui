<?php
$this->breadcrumbs=array(
	'图片管理'=>array('index'),
);
?>
<h1>请选择图片类型</h1>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'picture-form',
        'enableAjaxValidation'=>false,
        'method'=>'post',
    )); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'p_type'); ?>:
        <?php echo $form->dropDownList($model,'p_type',  Picture::$typeDescription); ?>
        <? if($model->p_sourcetype==2||$model->p_sourcetype==10){?>
        <?php echo $form->labelEx($model,'p_title'); ?>:
        <?php echo $form->textField($model,'p_title'); }?>
    </div>
    <div class="row buttons" id="submitButton">
            <?php echo CHtml::submitButton('确定'); ?>
    </div>
    <?php $this->endWidget(); ?>
