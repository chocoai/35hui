<?php
$this->pageTitle='登录-新地标';
$this->breadcrumbs=array(
        '登录',
);
?>

<div class="loginmain">
    <div class="lm_left">
        <ul id="logg">
            <li class="clk"><a>普通用户登录</a></li>
            <li><a href="<?=Yii::app()->createUrl("/site/personregister");?>">普通用户注册</a></li>
        </ul>
        <div class="lm_line">
            <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login',
                        'enableAjaxValidation'=>false,
                        'htmlOptions'=>array("onSubmit"=>"changeDefaultValue('submit')")
                )); ?>
            <table width="100%" style="clear:both;">
                <tr>
                    <td class="lm_01">用户名：</td>
                    <td>
                        <?php $def = "输入用户名/电话号码/邮箱"; ?>
                        <?=CHtml::textField("LoginForm[username]",$model->username?$model->username:$def,array("class"=>"txt_7","onfocus"=>"changeDefaultValue('on')", "onblur"=>"changeDefaultValue('out')"));?>
                        <span><?="<em>".@$model->errors["username"][0]."</em>"?></span>
                    </td>
                </tr>
                <tr>
                    <td class="lm_01">密码：</td>
                    <td>
                        <?php echo $form->passwordField($model,'password',array("class"=>"txt_7")); ?>
                        <span><?="<em>".@$model->errors["password"][0]."</em>"?></span>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" class="btn_3" value="" />
                        <span style="margin-left:50px"><a href="/site/findpwd">忘记密码？</a></span>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <a href="/site/agentlogin"><img src="/images/jjrdl.png" /></a>
                    </td>
                </tr>
            </table>
            <?php $this->endWidget(); ?>
        </div>
    </div>
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
function changeDefaultValue(type){
    var def = "<?=$def?>";
    var obj = $("#LoginForm_username");
    var val = $.trim($(obj).val());
    if(type=="on"&&def==val){
        $(obj).val("");
    }else if (type=="out"&&val==""){
        $(obj).val(def);
    }else if (type=="submit"&&def==val){
        $(obj).val("");
    }
}
</script>