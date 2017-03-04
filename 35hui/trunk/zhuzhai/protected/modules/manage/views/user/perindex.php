<?php
$this->breadcrumbs=array('用户资料',);
?>

<?php $this->renderPartial('_perhead'); ?>

<?php $form=$this->beginWidget('CActiveForm',array(
        'id'=>'update_form-form',
        'htmlOptions'=>array('onSubmit'=>'return check_info();')
)); ?>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td class="tit" width="15%"><em>*</em>移动电话：</td>
            <td class="txtlou">
                <?php echo CHtml::activeTextField($model,'user_tel',array('size'=>20,'maxlength'=>20)); ?>
                <?php echo CHtml::error($model,'user_tel'); ?>
                <font id="err"></font>
            </td>
        </tr>
        <tr>
            <td class="tit"><em>*</em>Email地址：</td>
            <td class="txtlou">
                <?php echo CHtml::activeTextField($model,'user_email',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo CHtml::error($model,'user_email'); ?>
                <font id="err"></font>
            </td>
        </tr>
        <tr>
            <td width="16%">&nbsp;</td>
            <td width="84%" class="txtlou"><input type="submit" value="提交" style="width:100px;" /></td>
        </tr>
    </table>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
<?php
if(Yii::app()->user->hasFlash('message')){
    echo "alert('".Yii::app()->user->getFlash('message')."');";
}
?>
    function check_info(){
        var tel=$('input[name="User[user_tel]"]');//联系电话
        var email=$('input[name="User[user_email]"]');
        
        if($.trim(tel.val())==''){
            tel.next('#err').html('<font color="red">联系电话不能为空</font>');
            tel.focus();
            return false;
        }else{
            tel.next('#err').html('');
        }
        if($.trim(email.val())==''){
            email.next('#err').html('<font color="red">邮箱不能为空</font>');
            email.focus();
            return false;
        }else{
            email.next('#err').html('');
        }
        return true;
    }
</script>