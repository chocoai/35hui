<style type="text/css">
    span.required{color:red}
    .errorMessage{color:red}
</style>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'companymanage-form',
        'enableAjaxValidation'=>false,
)); ?>

<table>
    <tr>
        <td align="right"><?php echo $form->labelEx($model,'ct_name'); ?></td>
        <td><?php echo $form->textField($model,'ct_name'); ?></td>
        <td><?php echo $form->error($model,'ct_name'); ?></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php $this->endWidget(); ?>