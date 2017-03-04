<?php
$this->breadcrumbs=array(
        '礼物与道具',
        "编辑信息"
);?>
<style type="text/css">
    .errorMessage{color: red}
</style>
<?php $form=$this->beginWidget('CActiveForm', array(
        'enableAjaxValidation'=>false,
        "htmlOptions"=>array("enctype"=>"multipart/form-data",)

)); ?>
<table>
    <tr>
        <td align="right">名称：</td>
        <td>
            <?php echo $form->textField($model,'pc_name'); ?>
            <?php echo $form->error($model,'pc_name'); ?>
        </td>
    </tr>
    <tr>
        <td align="right">价格：</td>
        <td>
            <?php echo $form->textField($model,'pc_price'); ?>
            <?php echo $form->error($model,'pc_price'); ?>
        </td>
    </tr>
    <tr>
        <td align="right">操作数：</td>
        <td>
            <?php echo $form->textField($model,'pc_optnumber'); ?>
            <?php echo $form->error($model,'pc_optnumber'); ?>
        </td>
    </tr>
    <tr>
        <td align="right">图片：</td>
        <td>
            <?php echo $form->fileField($model,'pc_url'); ?> 尺寸(<?=Propcenter::$pc_urlSize[1]["width"]?>*<?=Propcenter::$pc_urlSize[1]["height"]?>)
            <?php echo $form->error($model,'pc_url'); ?>
        </td>
    </tr>
    <tr>
        <td align="right">描述：</td>
        <td>
            <?php echo $form->textArea($model,'pc_describe',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'pc_describe'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right"><?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?></td>
    </tr>
</table>
<?php $this->endWidget(); ?>