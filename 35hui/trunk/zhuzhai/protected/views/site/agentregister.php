<?php
$this->pageTitle='经纪人注册-新地标';
$this->breadcrumbs=array(
        '经纪人注册',
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
            <li><a href="<?=Yii::app()->createUrl("/site/agentlogin");?>">房产经登录</a></li>
            <li class="clkk"><a>房产经纪注册</a></li>
        </ul>

        <div class="lm_line" >
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'agentRegister',
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
                    <td class="lm_01"><em>* </em>经营区域：</td>
                    <td>
                        <select name="AgentRegisterForm[district]" onchange="changeNext(this)">
                            <option value="0">-请选择-</option>
                            <?php
                            if(!empty($districtlist)){
                                foreach($districtlist as $value){
                                    ?>
                            <option value="<?php echo $value->re_id; ?>" <?php if($model->district==$value->re_id)echo "selected" ?>><?php echo $value->re_name;?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <select name="AgentRegisterForm[section]" id="AgentRegisterForm_section" onblur="checkSection()">
                            <option value="0">-请选择-</option>
                            <?php
                            if(!empty($sectionlist)){
                                foreach($sectionlist as $value){
                                    ?>
                            <option value="<?php echo $value->re_id; ?>" <?php if($model->section==$value->re_id)echo "selected" ?>><?php echo $value->re_name;?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span></span>
                    </td>
                </tr>
                <tr>
                    <td class="lm_01"><em>* </em>真实姓名：</td>
                    <td>
                        <?php echo $form->textField($model,'realname',array("class"=>"txt_7","onblur"=>"checkRealName()")); ?>
                        <span></span>
                    </td>
                </tr>
                <tr>
                    <td class="lm_01"><em>* </em>手机号码：</td>
                    <td>
                        <?php echo $form->textField($model,'tel',array("class"=>"txt_7","onblur"=>"checkPhone()")); ?>
                        <span><?="<em>".@$model->errors["tel"][0]."</em>"?></span>
                    </td>
                </tr>

                <tr>
                    <td class="lm_01"><em>* </em>电子邮箱：</td>
                    <td>
                        <?php echo $form->textField($model,'email',array("class"=>"txt_7","onblur"=>"checkEmail()")); ?>
                        <span><?="<em>".@$model->errors["email"][0]."</em>"?></span>
                    </td>
                </tr>

                <tr>
                    <td class="lm_01"><em>* </em>公司名称：</td>
                    <td>
                        <?php echo $form->textField($model,'company',array("class"=>"txt_7","onblur"=>"checkCompany()")); ?>
                        <span></span>
                    </td>
                </tr>
                <tr>
                    <td class="lm_01"><em>* </em>主营业务：</td>
                    <td>
                        <?php echo $form->dropDownList($model,'mainbusiness',User::$mainBusiness,array("empty"=>"--请选择--","onblur"=>"checkMainbusiness()")); ?>
                        <span style="margin-left:82px"></span>
                    </td>
                </tr>

                <tr>
                    <td class="lm_01"><em>* </em>从业日期：</td>
                    <td>
                        <?php
                        $beg = "1980";
                        $contyearray = array();
                        while($beg<=date("Y")){
                            $contyearray[$beg] = $beg;
                            $beg++;
                        }
                        ?>
                        <?php echo $form->dropDownList($model,'congyeyear', $contyearray,array("empty"=>"--请选择--","onblur"=>"checkCongyeyear()")); ?>
                        <span style="margin-left:82px"></span>
                    </td>
                </tr>

                <tr>
                    <td class="lm_01"><em>* </em>申请理由：</td>
                    <td>
                        <?php $def = "请简述您的房产从业经验以及申请成为新地标会员的理由。";?>
                        <textarea name="AgentRegisterForm[introduce]" id="AgentRegisterForm_introduce" onkeyup="keyPressCheck(this)" onfocus="changeTextAreaValue('on')" onblur="changeTextAreaValue('out')" ><?=$model->introduce?$model->introduce:$def?></textarea>
                        <span><?=isset($model->errors["introduce"][0])?"<em>".@$model->errors["introduce"][0]."</em>":"( 0-300个字符 )"?></span>
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
                        <input type="checkbox" id="xieyi" checked name="xieyi"><label for="xieyi">我已经看过并同意</label><a href="/help/contract" target="_blank">《新地标用户服务协议》</a>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" class="btn_4" value="" /></td>
                </tr>

            </table>
            <?php $this->endWidget(); ?>

        </div>
    </div>
    <?php }?>
    <div class="lm_right">
        <h2>新地标房产经纪</h2>
        <div class="lmcont">新地标房产经纪人有别于其他房产经纪之处在于，他们更注重于客户的服务而不是快速成交。新地标在保障站点经纪利益的同时，鼓励与促使他们提供给找房与业主客户更专业更贴心的房产服务。作为新地标房产经纪，您可以：</div>
        <div class="lmcont1" style="background:url(/images/register.jpg) 5px 14px no-repeat;">
            <div class="reg_line">
                <h3>精准的客户资源</h3>新地标关注的重心是经纪人本身的素质与能力。我们坚信，高质量的经纪人能带给客户最合适的房源。新地标将会引导找房用户及业主委托您来完成他们的需求。
            </div>
            <div class="reg_line">
                <h3>多方面的房源保障</h3>新地标为了解决经纪人房源难题，创新性的从客户、业主以及经纪人本身深度，保证经纪人房源量得供应，以解决后顾之忧。
            </div>
            <div class="reg_line">
                <h3>经纪人多维推广</h3>新地标为经纪人打造全新的在线名片，通过在线名片将经纪人在Google、Baidu、本地化社区、平面媒体等方面全面展示，力推经纪人本身的服务品质，增加经纪人本身的曝光度与知名度，打造个人品牌效应。
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var regcount = 0;//总共需要验证的数目
    function checkUsername(){
        var username=$.trim($("#AgentRegisterForm_username").val());
        if(checkBaseUserName()){
            $.ajax({
                url:"/site/ajaxregisterusername",
                data:{"name":username},
                type:"GET",
                success: function(msg){
                    if(msg==1){
                        remote_check_msg_new("AgentRegisterForm_username","",true);
                    }else{
                        remote_check_msg_new("AgentRegisterForm_username","已经被注册了，换个别的吧",false)
                    }
                }
            });
        }
    }
    function checkBaseUserName(){
        var username=$.trim($("#AgentRegisterForm_username").val());
        if(/^\d+$/.test(username)){
            remote_check_msg_new("AgentRegisterForm_username","不能使用纯数字为账户名",false);
            return false;
        }
        if(!(/^[a-zA-Z0-9_]{5,16}$/.test(username))){
            remote_check_msg_new("AgentRegisterForm_username","只能由5-16个数字、字母、_组成。",false);
            return false;
        }
        if(username==""){
            remote_check_msg_new("AgentRegisterForm_username","用户名不能为空",false);
            return false;
        }
        regcount++
        return true;
    }
    function checkPassword(){
        var password=$("#AgentRegisterForm_password").val();
        if(password.length<6||password.length>20){
            remote_check_msg_new("AgentRegisterForm_password","密码由6-20个字符、字母、数字组成",false);return false;
        }else{
            remote_check_msg_new("AgentRegisterForm_password","",true);
            regcount++
        }
    }
    function checkRePassword(){
        var password=$("#AgentRegisterForm_password").val();
        var value = $("#AgentRegisterForm_repassword").val();
        if(value.length==0){
            remote_check_msg_new("AgentRegisterForm_repassword","密码不能为空",false);return false;
        }
        if(password!=value){
            remote_check_msg_new("AgentRegisterForm_repassword","两次输入的密码不一致",false);return false;
        }else{
            remote_check_msg_new("AgentRegisterForm_repassword","",true);
            regcount++
        }
    }
    function checkSection(){
        var section=$.trim($("#AgentRegisterForm_section").val());
        if(section!=0){
            remote_check_msg_new("AgentRegisterForm_section","",true);
            regcount++
        }else{
            remote_check_msg_new("AgentRegisterForm_section","请选择区域",false);return false;
        }
    }
    function checkRealName(){
        var realname=$.trim($("#AgentRegisterForm_realname").val());
        if(realname!=""){
            remote_check_msg_new("AgentRegisterForm_realname","",true);
            regcount++
        }else{
            remote_check_msg_new("AgentRegisterForm_realname","真实姓名不能为空",false);return false;
        }
    }
    function checkBasePhone(){
        var phone=$.trim($("#AgentRegisterForm_tel").val());
        if(!/^1[0-9]{10}$/.test(phone)){
            remote_check_msg_new("AgentRegisterForm_tel","电话号码只能11位数字组成",false);return false;
        }
        regcount++;
        return true;
    }
    function checkPhone(){
        var tel=$.trim($("#AgentRegisterForm_tel").val());
        if(checkBasePhone()){
            $.ajax({
                url:"/site/ajaxregisterphone",
                data:{"tel":tel},
                type:"GET",
                success: function(msg){
                    if(msg==1){
                        remote_check_msg_new("AgentRegisterForm_tel","",true);

                    }else{
                        remote_check_msg_new("AgentRegisterForm_tel","此电话号码已经被注册了",false)
                    }
                }
            });
        }
    }
    function checkEmail(){
        var email=$.trim($("#AgentRegisterForm_email").val());
        if(checkBaseEmail()){
            $.ajax({
                url:"/site/ajaxregisteremail",
                data:{"email":email},
                type:"GET",
                success: function(msg){
                    if(msg==1){
                        remote_check_msg_new("AgentRegisterForm_email","",true);

                    }else{
                        remote_check_msg_new("AgentRegisterForm_email","此邮箱已经被注册了",false)
                    }
                }
            });
        }

    }
    function checkBaseEmail(){
        var email=$.trim($("#AgentRegisterForm_email").val());
        if(email.length==0){
            remote_check_msg_new("AgentRegisterForm_email","邮箱不能为空",false);return false;
        }
        if(!(/^[a-zA-Z0-9_\.]+@[a-zA-Z0-9_\.]+\.[a-zA-Z0-9_\.]+$/.test(email))){
            remote_check_msg_new("AgentRegisterForm_email","邮箱格式不正确",false);return false;
        }
        regcount++;
        return true;
    }
    function checkCompany(){
        var realname=$.trim($("#AgentRegisterForm_company").val());
        if(realname!=""){
            remote_check_msg_new("AgentRegisterForm_company","",true);
            regcount++
        }else{
            remote_check_msg_new("AgentRegisterForm_company","公司名称不能为空",false);return false;
        }
    }
    function checkMainbusiness(){
        var section=$.trim($("#AgentRegisterForm_mainbusiness").val());
        if(section!=0){
            remote_check_msg_new("AgentRegisterForm_mainbusiness","",true);
            regcount++
        }else{
            remote_check_msg_new("AgentRegisterForm_mainbusiness","请选择主营业务",false);return false;
        }
    }
    function checkCongyeyear(){
        var section=$.trim($("#AgentRegisterForm_congyeyear").val());
        if(section!=0){
            remote_check_msg_new("AgentRegisterForm_congyeyear","",true);
            regcount++
        }else{
            remote_check_msg_new("AgentRegisterForm_congyeyear","请选择从业日期",false);return false;
        }
    }

    function keyPressCheck(obj){
        if($(obj).val().length>300){
            $(obj).val($(obj).val().substring(0,300));
        }else{
            var len=$(obj).val().length;
            if(len){
                var num=300-len;
                if(num){
                    $(obj).nextAll("span").html('您还可以输入'+num+'个字符');
                }else{
                    $(obj).nextAll("span").html('抱歉，您输入的字符已达上限!多余字符已被截去.');
                }
            }
        }
    }

    function checkCode(){
        var code=$.trim($("#AgentRegisterForm_verifyCode").val());
        if(code.length==0){
            remote_check_msg_new("AgentRegisterForm_verifyCode","验证码不能为空",false);return false;
        }else{
            remote_check_msg_new("AgentRegisterForm_verifyCode","",false);
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
        checkSection();
        checkRealName();
        checkBasePhone();
        checkBaseEmail();
        checkCompany();
        checkMainbusiness();
        checkCongyeyear();
        checkCode();
        if(regcount==11){
            return changeTextAreaValue("submit");
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
    function changeNext(obj){
        var parentid = $(obj).val();
        var html = "<option value='0'>-请选择-</option>";
        if(parentid==0){
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
                    for(var i=0;i<msg.length;i++){
                        html += "<option value='"+msg[i]['re_id']+"'>"+msg[i]['re_name']+"</option>";
                    }
                    $(obj).next("select").html(html);
                }
            });
        }
    }
    function changeTextAreaValue(type){
        var def = "<?=$def?>";
        var obj = $("#AgentRegisterForm_introduce");
        if($(obj).val()==def&&type=="on"){
            $(obj).val("");
        }else if($(obj).val()==""&&type=="out"){
            $(obj).val(def);
        }
        if(type=="submit"){
            if($(obj).val()==def){
                remote_check_msg_new("AgentRegisterForm_introduce","申请理由不能为空",false);return false;
            }else{
                return true;
            }

        }
    }
</script>