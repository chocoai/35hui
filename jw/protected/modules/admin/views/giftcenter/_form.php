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
            <?php echo $form->textField($model,'gc_name'); ?>
            <?php echo $form->error($model,'gc_name'); ?>
        </td>
    </tr>
    <tr>
        <td align="right">价格：</td>
        <td>
            <?php echo $form->textField($model,'gc_price'); ?>
            <?php echo $form->error($model,'gc_price'); ?>
        </td>
    </tr>
    <tr>
        <td align="right">图片：</td>
        <td>
            <?php echo $form->fileField($model,'gc_url'); ?> 尺寸(<?=Propcenter::$pc_urlSize[1]["width"]?>*<?=Propcenter::$pc_urlSize[1]["height"]?>)
            <?php echo $form->error($model,'gc_url'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right"><?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?></td>
    </tr>
</table>
<?php $this->endWidget(); ?>