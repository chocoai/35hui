<style type="text/css">
    div.form label{display: inline}
</style>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'examchoice-form',
            'enableAjaxValidation'=>false,
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <table width="100%">
        <tr>
            <td><?php echo $form->labelEx($model,'ec_question'); ?></td>
            <td>
                <?php echo $form->textArea($model,'ec_question',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->error($model,'ec_question'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'ec_a'); ?></td>
            <td>
                <?php echo $form->textArea($model,'ec_a',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->error($model,'ec_a'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'ec_b'); ?></td>
            <td>
                <?php echo $form->textArea($model,'ec_b',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->error($model,'ec_b'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'ec_c'); ?></td>
            <td>
                <?php echo $form->textArea($model,'ec_c',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->error($model,'ec_c'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'ec_d'); ?></td>
            <td>
                <?php echo $form->textArea($model,'ec_d',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'ec_d'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'ec_answer'); ?></td>
            <td>
<?php echo $form->radioButtonList($model,'ec_answer',Examchoice::$ec_answer,array("separator"=>"&nbsp;")); ?>
        <?php echo $form->error($model,'ec_answer'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'ec_type'); ?></td>
            <td>
               <?php echo $form->dropDownList($model,'ec_type',Examchoice::$ec_type); ?>
        <?php echo $form->error($model,'ec_type'); ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
        </tr>
    </table>

    <?php $this->endWidget(); ?>

</div><!-- form -->