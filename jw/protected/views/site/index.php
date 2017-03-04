<div class="log_logo"></div>
<div class="login_m"><img src="/images/loginbg.jpg">
    <div class="login">
        <div style="float:right"><?=CHtml::link("随便看看",array("site/home"))?></div>
        <h2></h2>
        <div class="log_cont">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'memberRegister-form',
                    'enableAjaxValidation'=>false,
            )); ?>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="log_tab">
                <tr>
                    <td width="17%" align="center">EMAIL：</td>
                    <td colspan="2" width="83%">
                        <?php echo $form->textField($model,'username',array("class"=>"txt_07")); ?>
                    </td>
                </tr>
                <tr>
                    <td width="17%" align="center">密 码：</td>
                    <td colspan="2" width="83%">
                        <?php echo $form->passwordField($model,'password',array("class"=>"txt_07","autoComplete"=>"off")); ?>
                    </td>
                </tr>
                <tr>
                    <td width="17%">&nbsp;</td>
                    <td width="40%" class="psw">
                        <?php echo $form->checkBox($model,'rememberMe',array("id"=>"rememberMe")); ?>
                        <label for="rememberMe">一周内自动登录</label>
                    </td>
                    <td width="43%" class="psw">忘记密码？</td>
                </tr>
                <tr>
                    <td width="17%">&nbsp;</td>
                    <td colspan="2" width="83%" class="msg" id="showloginerrormsg">
                        <?php
                        if($model->errors&&isset($model->errors['password'])) {
                            if($model->errors['password'][0]=="邮箱还未认证") {
                                echo "邮箱未认证！".CHtml::link("重新发送认证邮件","javascript:;",array("onclick"=>"reSendCheckMail()","style"=>"color:blue"));
                            }else{
                                echo $form->error($model,'password');
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><input type="submit" class="btn_12" value="登录"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><input type="button" class="btn_13" value="注册" onclick="window.location.href='/user/register'" /></td>
                </tr>
            </table>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<div class="adlogin">1245454</div>

<script type="text/javascript">
    function reSendCheckMail(){
        var email = $.trim($("#LoginForm_username").val());
        if(email==""){
            $("#showloginerrormsg").html("请填写邮箱");
            return false;
        }
        var preg = /^.*@.*\..*$/;
        if(preg.test(email)){
            $.post("/user/reSendCheckMail", {"email":email}, function(msg){
                if(msg=="success"){
                    jw.pop.alert("重发邮件成功！请登录邮箱进行认证！",{icon:1,autoClose:1500});
                }else{
                    jw.pop.alert(msg,{icon:2,autoClose:1000});
                }
            }, "text")
        }else{
            $("#showloginerrormsg").html("邮件格式不对");
        }
    }
</script>