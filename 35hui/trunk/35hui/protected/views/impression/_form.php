<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'impression-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('onSubmit'=>'return check_impression();')
)); ?>
    <div class="loupaninfo_pinput">
        
        <span><?php echo $form->textField($model,'im_description',array('size'=>10,'maxlength'=>20,'style'=>'color:gray','value'=>'请输入您的印象','onfocus'=>'impressionInput_action(this,true)','onblur'=>'impressionInput_action(this,false)')); ?></span>
        <?php echo CHtml::submitButton('发表',array('class'=>'loupaninfo_submit')); ?>
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
            alert('抱歉，您没有输入任何印象，不能发表！');
            return false;
        }
        return true;
    }
</script>