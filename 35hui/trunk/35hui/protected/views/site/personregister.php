<?php
$this->pageTitle='个人用户注册-新地标';
$this->breadcrumbs=array(
        '个人用户注册',
);
?>
<div class="loginmain">
    <?php
    if(Yii::app()->user->hasFlash('message')){
        $this->renderPartial('_registerSuccess', array('type'=>Yii::app()->user->getFlash('message')));
    }else{
    ?>
    <div class="lm_left">
        <ul class="logg">
            <li><a href="<?=Yii::app()->createUrl("/site/login");?>">普通用户登录</a></li>
            <li class="clkk"><a >普通用户注册</a></li>
        </ul>
        <div class="lm_line">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'personRegister',
                    'enableAjaxValidation'=>false,
                    "htmlOptions"=>array("onSubmit"=>"return checkForm()"),
            )); ?>
            <table width="100%" style="clear:both;">
                <tr>
                    <td class="lm_01"><em>* </em>用户名：</td>
                    <td>
                        <?php echo $form->textField($model,'username',array("class"=>"txt_7","onblur"=>"checkUsername()")); ?>
                        <span><?=isset($model->errors["username"][0])?"<em>".@$model->errors["username"][0]."</em>":"由5-16个数字或字母组成"?></span>
                    </td>
                </tr>
                <tr>
                    <td class="lm_01"><em>* </em>密&nbsp;&nbsp;&nbsp;码：</td>
                    <td>
                        <?php echo $form->passwordField($model,'password',array("class"=>"txt_7","onblur"=>"checkPassword()")); ?>
                        <span>6-20个字符、字母、数字组成</span>
                    </td>
                </tr>

                <tr>
                    <td class="lm_01"><em>* </em>确认密码：</td>
                    <td>
                        <?php echo $form->passwordField($model,'repassword',array("class"=>"txt_7","onblur"=>"checkRePassword()")); ?>
                        <span>请再输入一遍您上面输入的密码</span>
                    </td>
                </tr>

                <tr>
                    <td class="lm_01"><em>* </em>手机号码：</td>
                    <td>
                        <?php echo $form->textField($model,'telephone',array("class"=>"txt_7","onblur"=>"checkPhone()")); ?>
                        <span><?=isset($model->errors["telephone"][0])?"<em>".@$model->errors["telephone"][0]."</em>":""?></span>
                    </td>
                </tr>

                <tr>
                    <td class="lm_01"><em>* </em>电子邮箱：</td>
                    <td>
                        <?php echo $form->textField($model,'email',array("class"=>"txt_7","onblur"=>"checkEmail()")); ?>
                        <span><?=isset($model->errors["email"][0])?"<em>".@$model->errors["email"][0]."</em>":""?></span>
                    </td>
                </tr>
                <tr style="height:70px">
                    <td class="lm_01" style="margin-top:20px"><em>* </em>验证码：</td>
                    <td>
                        <?php echo $form->textField($model,'verifyCode',array("class"=>"txt_6","onblur"=>"checkCode()","style"=>"margin-top:15px")); ?>
                        <?php $this->widget('CCaptcha',array("buttonLabel"=>"","clickableImage"=>true,"imageOptions"=>array("title"=>"看不清？点击更换。"))); ?>
                        <span><?="<em>".@$model->errors["verifyCode"][0]."</em>"?></span>
                    </td>
                </tr>
                <tr>
                    <td class="lm_01">&nbsp;</td>
                    <td>
                        <input type="checkbox" id="xieyi" checked name="xieyi" ><label for="xieyi">我已经看过并同意</label><a href="/help/contract" target="_blank">《新地标用户服务协议》</a>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" class="btn_4" value="" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <a href="/site/agentregister"><img src="/images/jjrzc.png" /></a>
                    </td>
                </tr>
            </table>
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <?php }?>
    <div class="lm_right">
        <h2>新用户？</h2>
        <div class="lmcont">新地标倡导优质经纪人服务的理念，在这里，找到一位优质的新地标经纪人将大大提高您的找房效率，使您的找房之旅更为轻松写意。同时，拥有新地标账号，将会使得您：</div>
        <div class="lmcont1">
            <p>1、获取新地标的优惠与奖励。</p>
            <p>2、轻松管理找房订单。</p>
            <p>3、保存中意的房源与经纪人。</p>
            <p>4、获得最新的房源与经纪人信息。</p>
            <div><img src="/images/logtu.jpg" /></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var regcount = 0;//总共需要验证的数目
    function checkUsername(){
        var username=$.trim($("#PersonRegisterForm_username").val());
        if(checkBaseUserName()){
            $.ajax({
                url:"/site/ajaxregisterusername",
                data:{"name":username},
                type:"GET",
                success: function(msg){
                    if(msg==1){
                        remote_check_msg_new("PersonRegisterForm_username","",true);
                    }else{
                        remote_check_msg_new("PersonRegisterForm_username","已经被注册了，换个别的吧",false)
                    }
                }
            });
        }
    }
    function checkBaseUserName(){
        var username=$.trim($("#PersonRegisterForm_username").val());
        if(/^\d+$/.test(username)){
            remote_check_msg_new("PersonRegisterForm_username","不能使用纯数字为账户名",false);
            return false;
        }
        if(!(/^[a-zA-Z0-9_]{5,16}$/.test(username))){
            remote_check_msg_new("PersonRegisterForm_username","只能由5-16个数字、字母、_组成。",false);
            return false;
        }
        if(username==""){
            remote_check_msg_new("PersonRegisterForm_username","用户名不能为空",false);
            return false;
        }
        regcount++
        return true;
    }
    function checkPassword(){
        var password=$("#PersonRegisterForm_password").val();
        if(password.length<6||password.length>20){
            remote_check_msg_new("PersonRegisterForm_password","密码由6-20个字符、字母、数字组成",false);return false;
        }else{
            remote_check_msg_new("PersonRegisterForm_password","",true);
            regcount++
        }
    }
    function checkRePassword(){
        var password=$("#PersonRegisterForm_password").val();
        var value = $("#PersonRegisterForm_repassword").val();
        if(value.length==0){
            remote_check_msg_new("PersonRegisterForm_repassword","密码不能为空",false);return false;
        }
        if(password!=value){
            remote_check_msg_new("PersonRegisterForm_repassword","两次输入的密码不一致",false);return false;
        }else{
            remote_check_msg_new("PersonRegisterForm_repassword","",true);
            regcount++
        }
    }
    function checkBasePhone(){
        var phone=$.trim($("#PersonRegisterForm_telephone").val());
        if(!/^1[0-9]{10}$/.test(phone)){
            remote_check_msg_new("PersonRegisterForm_telephone","电话号码只能11位数字组成",false);return false;
        }
        regcount++;
        return true;
    }
    function checkPhone(){
        var tel=$.trim($("#PersonRegisterForm_telephone").val());
        if(checkBasePhone()){
            $.ajax({
                url:"/site/ajaxregisterphone",
                data:{"tel":tel},
                type:"GET",
                success: function(msg){
                    if(msg==1){
                        remote_check_msg_new("PersonRegisterForm_telephone","",true);

                    }else{
                        remote_check_msg_new("PersonRegisterForm_telephone","此电话号码已经被注册了",false)
                    }
                }
            });
        }
    }
    function checkEmail(){
        var email=$.trim($("#PersonRegisterForm_email").val());
        if(checkBaseEmail()){
            $.ajax({
                url:"/site/ajaxregisteremail",
                data:{"email":email},
                type:"GET",
                success: function(msg){
                    if(msg==1){
                        remote_check_msg_new("PersonRegisterForm_email","",true);

                    }else{
                        remote_check_msg_new("PersonRegisterForm_email","此邮箱已经被注册了",false)
                    }
                }
            });
        }

    }
    function checkBaseEmail(){
        var email=$.trim($("#PersonRegisterForm_email").val());
        if(email.length==0){
            remote_check_msg_new("PersonRegisterForm_email","邮箱不能为空",false);return false;
        }
        if(!(/^[a-zA-Z0-9_\.]+@[a-zA-Z0-9_\.]+\.[a-zA-Z0-9_\.]+$/.test(email))){
            remote_check_msg_new("PersonRegisterForm_email","邮箱格式不正确",false);return false;
        }
        regcount++;
        return true;
    }
    function checkCode(){
        var code=$.trim($("#PersonRegisterForm_verifyCode").val());
        if(code.length==0){
            remote_check_msg_new("PersonRegisterForm_verifyCode","验证码不能为空",false);return false;
        }else{
            remote_check_msg_new("PersonRegisterForm_verifyCode","",false);
            regcount++;
        }
    }
    function checkForm(){
        if(typeof($("#xieyi:checked").val())=="undefined"){
            alert("请先同意新地标协议！")
            return false;
        }
        regcount = 0;
        checkBaseUserName();
        checkPassword();
        checkRePassword();
        checkBasePhone();
        checkBaseEmail();
        checkCode();
        if(regcount==6){
            return true;
        }else{
            return false;
        }
    }
    function remote_check_msg_new(id,msg,type){
        if(type){//验证通过
            $("#"+id).nextAll("span").removeClass("error").addClass("vaok").html("");
        }else{
            $("#"+id).nextAll("span").removeClass("vaok").addClass("error").html(msg);
        }
    }
</script>