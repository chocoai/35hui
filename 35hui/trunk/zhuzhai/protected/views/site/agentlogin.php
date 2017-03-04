<?php
$this->pageTitle='登录-新地标';
$this->breadcrumbs=array(
        '登录',
);
?>

<div class="loginmain">
    <div class="lm_left">
        <ul id="logg">
            <li class="clk"><a>房产经纪登录</a></li>
            <li><a href="<?=Yii::app()->createUrl("/site/agentregister");?>">房产经纪注册</a></li>
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
            </table>
            <?php $this->endWidget(); ?>
        </div>
    </div>
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