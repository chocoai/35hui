<style type="text/css">
    .red{color: red}
    .message{color: red;padding-left: 5px}
</style>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'oprationconfig-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array("onSubmit"=>"return validateForm()")
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <table width="100%">
        <tr>
            <td width="15%" style="text-align: right"><font class="red">*</font>用户类型：</td>
            <td>
                <?=CHtml::dropDownList('assignment','',$roles);?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right"><font class="red">*</font>用户名：</td>
            <td>
                <?=CHtml::textField("mag_username",$model->mag_username,array('size'=>30,'maxlength'=>30,"onBlur"=>"checkUserName(this)"))?><span class="message"></span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right"><font class="red">*</font>密码：</td>
            <td>
                <?=CHtml::passwordField("mag_password",$model->mag_password,array('size'=>30,'maxlength'=>30,"onBlur"=>"checkPwd(this)"))?><span class="message"></span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right"><font class="red">*</font>确认密码：</td>
            <td>
                <?=CHtml::passwordField("mag_password_new","",array('size'=>30,'maxlength'=>30,"onBlur"=>"comparePwd(this)"))?><span class="message"></span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right"><font class="red">*</font>真实姓名：</td>
            <td>
                <?=CHtml::textField("mag_realname",$model->mag_realname,array('size'=>30,'maxlength'=>30,"onBlur"=>"checkRealName(this)"))?><span class="message"></span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">联系电话：</td>
            <td>
                <?=CHtml::textField("mag_tel",$model->mag_tel,array('size'=>30,'maxlength'=>11))?><span class="message"></span>
            </td>
        </tr>
    </table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '修改'); ?>
	</div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    function validateForm(){
        if(!checkUserName("#mag_username")){
            return false;
        }
        if(!checkPwd("#mag_password")){
            return false;
        }
        if(!comparePwd("#mag_password_new")){
            return false;
        }
        if(!checkRealName("#mag_realname")){
            return false;
        }
        return true;
    }
    function checkUserName(obj){
        $(obj).next().attr("style","color:red");
        var value = $(obj).val();
        if(!value){
            $(obj).next().html("用户名不能为空！");
            return false;
        }
        $.ajax({
            url:"/manageuser/checkuser",
            data:{"name":value},
            type:"POST",
            success:function(msg){
                if(msg=="1"){
                    $(obj).next().html("用户名重复！");
                    return false;
                }else{
                    $(obj).next().attr("style","color:black");
                    $(obj).next().html("可以使用！");
                    return true;
                }
                
            }
        });
        return true;
    }
    function comparePwd(obj){
        var pwd = $("#mag_password").val();
        var pwd_com = $(obj).val();
        if(pwd!=pwd_com){
            $(obj).next().html("两次密码不一致！");
            return false;
        }
        $(obj).next().html("");
        return true;
    }
    function checkPwd(obj){
        var pwd = $(obj).val();
        if(!pwd){
            $(obj).next().html("密码不能为空！");
            return false;
        }
        if(pwd.length>20){
            $(obj).next().html("密码最多20位！");
            return false;
        }
        $(obj).next().html("");
        return true;
    }
    function checkRealName(obj){
        var name = $(obj).val();
        if(!name){
            $(obj).next().html("真实姓名不能为空！");
            return false;
        }
        $(obj).next().html("");
        return true;
    }
</script>