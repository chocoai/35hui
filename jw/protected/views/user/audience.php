<?php
Yii::app()->clientScript->registerScriptFile('/js/jquery.validity/jquery.validate.js',CClientScript::POS_BEGIN);
?>
<div id="topman" class="reg-header"><a title="" href="/"><img src="/images/reg_logo.jpg" /></a></div>
<div class="reg-step-1"><img src="/images/reg_step_1.jpg" /></div>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'audienceRegister-form',
        'enableAjaxValidation'=>false,
        //"htmlOptions"=>array("onSubmit"=>"return checkForm()"),
)); ?>
<div class="zycont">
    <div class="reg-box">
        <h3>真实姓名</h3>
        <div class="reg-line">
            <?php echo $form->textField($model,'nickname',array('name'=>'nickname',"autocomplete"=>"off","class"=>$model->hasErrors('nickname')?'cltext':'text')); ?>
        </div>
        <?php echo $model->myError('nickname'); ?>
    </div>
    <div class="reg-box">
        <h3>登录邮箱</h3>
        <div class="reg-line">
            <?php echo $form->textField($model,'email',array('name'=>'email',"autocomplete"=>"off","class"=>$model->hasErrors('email')?'cltext':'text')); ?>
        </div>
        <?php echo $model->myError('email'); ?>
    </div>
    <div class="reg-box">
        <h3>密码</h3>
        <div class="reg-line">
            <?php echo $form->passwordField($model,'password',array('name'=>'password',"autocomplete"=>"off","class"=>$model->hasErrors('password')?'cltext':'text')); ?>
        </div>
        <?php echo $model->myError('password'); ?>
    </div>
    <div class="reg-box">
        <h3>确认密码</h3>
        <div class="reg-line">
            <?php echo $form->passwordField($model,'repassword',array('name'=>'repassword',"class"=>$model->hasErrors('repassword')?'cltext':'text')); ?>
        </div>
        <?php echo $model->myError('repassword'); ?>
    </div>
    <div class="reg-box">
        <h3>籍贯</h3>
        <div class="reg-line">
            <?=$form->dropDownList($model, "nativeprovince",Region::model()->getAllGroupList(0),array("name"=>"nativeprovince","empty"=>"--请选择--"))?>
        </div>
        <?php echo $model->myError('nativeprovince'); ?>
    </div>
    <div class="reg-box">
        <h3>所在地</h3>
        <div class="reg-line">
            <?=$form->dropDownList($model, "district",Region::model()->getAllGroupList(),array("name"=>"district","empty"=>"--请选择--","onChange"=>"changeNext(this)"))?>
            <?php echo $form->dropDownList($model, "section",array(),array("name"=>"section","empty"=>"--请选择--"));?>
        </div>
        <?php echo $model->myError('section'); ?>
    </div>
    <div class="reg-box">
        <h3>验证码</h3>
        <div class="reg-line">
            <?php
            echo $form->textField($model,'verifyCode',array('name'=>'verifyCode',"class"=>'texto'));
            $this->widget('CCaptcha',array('showRefreshButton'=>'','clickableImage'=>1,'imageOptions'=>array('title'=>'看不清？点击更换')));?></div>
        <?php echo $model->myError('verifyCode'); ?>
    </div>
    <div class="reg-submit">
        <p><input type="checkbox" id="serviceprotocol" checked="checked" name="service"> <label for="serviceprotocol">已经阅读并同意</label>
            <a title="MOKO!服务条款" target="_blank" href="http://html.moko.cc/html/about/reg.html">MOKO!服务条款</a></p>
        <input type="button" id="btnRegisterSave" value="继续" class="btn" onclick="return checkForm()"/>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    function checkForm(){
        var serviceprotocol = $("#serviceprotocol").val();
        if(serviceprotocol){
            $("form").submit();
        }else{
            jw.pop.alert("您必须同意服务条款",{autoClose:1000,icon:2})
        }
    }
    $.validator.setDefaults({
        submitHandler: function(form) {
            form.submit();
        }
    });
    $(function() {
        $("#audienceRegister-form").validate({
            debug: true,
            errorClass: "cltext",
            errorElement: "p",
            rules: {
                nickname: {
                    required: true,
                    minlength: 2,
                    maxlength: 20,
                    remote: "/user/isused"
                },
                email: {
                    required: true,
                    email: true,
                    remote: "/user/isused"
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                repassword: {
                    required: true,
                    equalTo: "#password"
                },
                section:"required",
                nativeprovince:"required",
                service: 'required',
                verifyCode: 'required'
            },
            messages: {
                nickname: {
                    required: "请填写您的真实姓名,长度2-20个字符或汉字",
                    minlength: "长度2-20个字符或汉字",
                    maxlength: "长度2-20个字符或汉字",
                    remote: "该名称已经存在"
                },
                email: {
                    required: "请填写一个正确的有效邮箱",
                    email: "邮箱格式不正确",
                    remote: "该邮箱已经存在"
                },
                password: {
                    required: "请填写登录密码",
                    minlength: "密码长度为6-20个字符",
                    maxlength: "密码长度为6-20个字符"
                },
                repassword: {
                    required: "请确认登录密码",
                    equalTo: "两次密码输入不相同"
                },
                section: "请选择所在地",
                nativeprovince:"请选择籍贯",
                service: "请选择我们的服务条款",
                verifyCode: "验证码不能为空"
            }
        });
    });
    function changeNext(obj){
        var parentid = $(obj).val();
        var html = "<option value>--请选择--</option>";
        if(!parentid){
            $(obj).nextAll("select").html(html);//删除后面所有的选择。
        }else{
            $.ajax({
                url: "<?php echo Yii::app()->createUrl("/region/getlistbyparentid") ?>",
                type: "GET",
                data: "parentid="+parentid,
                async: false,
                success: function(msg){
                    var msg = eval("("+msg+")");
                    $(obj).nextAll("select").html(html);//删除后面所有的选择。
                    var index = "";
                    for(index in msg){
                        html += "<option value='"+index+"'>"+msg[index]+"</option>";
                    }
                    $(obj).next("select").html(html);
                }
            });
        }
    }
</script>