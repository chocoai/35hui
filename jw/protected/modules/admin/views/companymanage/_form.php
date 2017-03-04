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
        <td align="right"><?php echo $form->labelEx($model,'cm_district'); ?></td>
        <td><?php echo $form->dropDownList($model, "cm_district",$district,array("empty"=>"--请选择--"));?></td>
        <td><?php echo $form->error($model,'cm_district'); ?></td>
    </tr>
    <tr>
        <td align="right"><?php echo $form->labelEx($model,'cm_companyname'); ?></td>
        <td><?php echo $form->textField($model,'cm_companyname'); ?></td>
        <td><?php echo $form->error($model,'cm_companyname'); ?></td>
    </tr>
    <tr>
        <td align="right"><?php echo $form->labelEx($model,'cm_companytype'); ?></td>
        <td><?php echo $form->dropDownList($model, "cm_companytype",Companytype::model()->getAllType(),array("empty"=>"--请选择--"));?></td>
        <td><?php echo $form->error($model,'cm_companytype'); ?></td>
    </tr>
    <tr>
        <td align="right"><?php echo $form->labelEx($model,'cm_address'); ?></td>
        <td><?php echo $form->textField($model,'cm_address'); ?></td>
        <td><?php echo $form->error($model,'cm_address'); ?></td>
    </tr>
    <tr>
        <td align="right"><?php echo $form->labelEx($model,'cm_avgconsume'); ?></td>
        <td><?php echo $form->textField($model,'cm_avgconsume'); ?>元</td>
        <td><?php echo $form->error($model,'cm_avgconsume'); ?></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?></td>
        <td>&nbsp;</td>
    </tr>
</table>
<?php $this->endWidget(); ?>