<?php $this->breadcrumbs=array('收件箱','回复');?>
<style type="text/css">
    .errorMessage{color: red}
</style>
<div class="htit">回复留言</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'msg-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td width="14%" class="tit">收件人：</td>
            <td width="86%">
            <?=$model->msg_revid==0?"客服管理员":User::model()->getNamebyid($model->msg_revid);?>
            </td>
        </tr>
        <tr>
            <td width="14%" class="tit">主题：</td>
            <td width="86%">
                <?php echo $form->textField($model,'msg_title',array('class'=>"txt_02")); ?>
                <?php echo $form->error($model,'msg_title'); ?>
            </td>
        </tr>
        <tr>
            <td width="14%" class="tit">内容：</td>
            <td width="86%">
                <?php echo $form->textArea($model,'msg_content',array('class'=>"tax_01")); ?>
                <?php echo $form->error($model,'msg_content'); ?>
            </td>
        </tr>
        <tr>
            <td width="14%">&nbsp;</td>
            <td width="86%"><input type="submit" value="提交回复" style="width:100px;" /></td>
        </tr>
    </table>
</div>
<?php $this->endWidget(); ?>