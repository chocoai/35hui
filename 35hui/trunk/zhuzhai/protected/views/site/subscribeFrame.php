<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tanchu.css" />
<div class="tc_email">
	<h2>邮箱订阅</h2>
    <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'Msgsubscribe-form',
                'enableAjaxValidation'=>true,
                'htmlOptions'=>array("onSubmit"=>"return checkSubmit()")
            )); ?>
	<ul style="list-style-type:none;">
		<li>
			<span class="tce_1">电子邮箱：</span>
			<span class="tce_2"><?php echo $form->textField($model,'ms_email',array('maxlength'=>200,"onblur"=>"checkEmail()",'size'=>"30")); ?></span>
		</li>
        <li>
            <span class="tce_1">&nbsp;</span>
            <span class="tce_2" style="color:red;" id="Msgtce_2"><?php echo $form->error($model,'ms_email'); ?></span>
        </li>
            <input type="hidden" id="Msgsubscribe_ms_typeid" name="Msgsubscribe[ms_typeid]" value="<?=$typeId;?>">
            <input type="hidden" id="Msgsubscribe_ms_type" name="Msgsubscribe[ms_type]" value="<?=$type;?>">
        <li>
			<span class="tce_1">验 证 码：</span>
			<span class="tce_2" id="verifyCode">
                <?php if(extension_loaded('gd')): ?>
                    <?php echo $form->textField($model,'verifyCode',array("style"=>"width:60px;")); ?>
                    <?php $this->widget('CCaptcha'); ?>
                <?php endif; ?>
            </span>
		</li>
        <li>
            <span class="tce_1">&nbsp;</span>
            <span class="tce_2" style="color:red;"><?php echo $form->error($model,'verifyCode'); ?></span>
        </li>
		<li>
			<span class="tce_1">&nbsp;</span>
			<span class="tce_2">
                <?php echo CHtml::submitButton('提交请求',array("style"=>"padding:2px;8px")); ?>
            </span>
		</li>
	</ul>
    <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //设置验证码大小
        $("#verifyCode img").attr("height","20");
    });
    function checkEmail(){
        var ms_typeid = $("#Msgsubscribe_ms_typeid").val();
        var ms_type = $("#Msgsubscribe_ms_type").val();
        var ms_email = $("#Msgsubscribe_ms_email").val();
        $.ajax({
            type: "POST",
            url: "<?=Yii::app()->createUrl('msgsubscribe/ajaxEmail');?>",
            data: {typeId:ms_typeid,type:ms_type,email:ms_email},
            success: function(result){
                if(result){
                     $("#Msgtce_2").html("该邮箱已订阅");
                }else if($("#Msgtce_2").html()=="该邮箱已订阅"){
                    $("#Msgtce_2").html("");
                }
            }
        });
    }
    function checkSubmit(){
        if($("#Msgtce_2").html() != "该邮箱已订阅"){
            return true;
        }else{
            return false;
        }
    }
</script>
