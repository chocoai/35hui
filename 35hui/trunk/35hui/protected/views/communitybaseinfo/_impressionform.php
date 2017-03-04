<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'impression-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('onSubmit'=>'return check_impression();')
)); ?>
    <div class="new-impression">
        <table border="0" width="100%">
            <tr>
        <td width="60%"><?php echo $form->textField($model,'im_description',array('maxlength'=>4,'onfocus'=>'impressionInput_action(this,true)','onblur'=>'impressionInput_action(this,false)')); ?></td>
        <td><?php echo CHtml::submitButton('评价',array('style'=>'_border:1px solid #ccc; _width:65px; _height:22px; cursor: cursor;')); ?></td>
        </tr></table>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript" language="javascript">
    function impressionInput_action(obj,ifFocus){
        if(ifFocus){
            if($(obj).val()=='请输入您的印象'){
                $(obj).css('color','black');
                $(obj).val('');
            }
        }else{
            if($(obj).val()==''){
                $(obj).css('color','gray');
                $(obj).val('请输入您的印象');
            }
        }
    }
    function check_impression(){
        if($('#Impression_im_description').val()=='请输入您的印象' || $('#Impression_im_description').val()==''){
            alert('抱歉，您没有输入任何印象，不能评价！');
            return false;
        }
        return true;
    }
</script>