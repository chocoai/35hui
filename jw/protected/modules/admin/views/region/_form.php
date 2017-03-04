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
            <?php echo $form->textField($model,'re_name'); ?>
            <?php echo $form->error($model,'re_name'); ?>
        </td>
    </tr>
    <tr>
        <td align="right">排序：</td>
        <td>
            <?php echo $form->textField($model,'re_order'); ?>
            <?php echo $form->error($model,'re_order'); ?>
        </td>
    </tr>
    <tr>
        <td align="right">首字母：</td>
        <td>
            <?php echo $form->textField($model,'re_pinyin'); ?>
            <?php echo $form->error($model,'re_pinyin'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right"><?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?></td>
    </tr>
</table>
<?php $this->endWidget(); ?>