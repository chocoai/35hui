<?php
$this->currentMenu = 61;
$this->breadcrumbs=array(
	'Subpanorama'=>array('index'),
	$model->spn_id=>array('view','id'=>$model->spn_id),
);

$this->menu=array(
	array('label'=>'返回列表', 'url'=>array('index')),
);
?>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'panorama-form',
        'enableAjaxValidation'=>false,
        'method'=>'post',
    )); ?>
    <h1>请选择全景类型</h1>
    <div class="row">
        <?php echo $form->labelEx($panoramaModel,'p_type'); ?>:
        <?php echo $form->dropDownList($panoramaModel,'p_type',Panorama::$typeDescription); ?>
    </div>
    <div class="row buttons" id="submitButton">
            <?php echo CHtml::submitButton('确定'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>