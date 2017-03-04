<?php
$this->pageTitle='注册-新地标';
$this->breadcrumbs=array(
	'注册',
);
?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/register_sel.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" rel="stylesheet" type="text/css" />
<div id="center">
    <div style="width:984px;margin:0px auto;">
       <div class="register-wrap">
           <form id="reg-form" name="reg-form" action="" method="post">

          <h2 class="register-des" style="margin-top: 0px ">请选择你的注册方案</h2>
                <dl class="register-intro register-intro-n">
                    <dt class="register-title">
                        <img src="<?=IMAGE_URL;?>/reg_user.jpg" class="reg-image" /><br />
                        <font class="register-type">个人用户注册</font>
                    </dt>
                    <dd>
                        <ul class="reg-info-list">
                            <li><em>免费</em>发布个人租售信息</li>
                            <li>定期获得推荐的<em>优质房源</em>、<em>小区信息</em></li>
                        </ul>
                        <div class="entrance-box">
                            <p><a href="#" onclick="javascript:register('reg-form','<?php echo Yii::app()->createUrl("/site/personregister") ?>')" class="btn-reglog"><img src="<?=IMAGE_URL;?>/register.png"/></a></p>
                            <p class="other">已经注册了？点此<a class="btn-reglog" href="<?php echo Yii::app()->createUrl("/site/login") ?>">登录</a></p>
                        </div>
                    </dd>
                </dl>
                <dl class="register-intro register-intro-a">
                    <dt class="register-title">
                        <img src="<?=IMAGE_URL;?>/reg_agent.jpg" class="reg-image" /><br />
                        <font class="register-type">经纪人用户注册</font>
                    </dt>
                    <dd>
                        <ul class="reg-info-list">
                            <li><em>更多</em>客户来电、<em>更多</em>客户来访</li>
                            <li><em>便捷</em>制作房源单片、房型图, 提供房源描述模板、系统预约自动刷新</li>
                        </ul>
                        <div class="entrance-box">
                            <p><a href="#" onclick="javascript:register('reg-form','<?php echo Yii::app()->createUrl("/site/agentregister") ?>')" class="btn-reglog"><img src="<?=IMAGE_URL;?>/register.png"/></a></p>
                            <p class="other">已经注册了？点此<a class="btn-reglog" href="<?php echo Yii::app()->createUrl("/site/login") ?>">登录</a></p>
                        </div>
                    </dd>
                </dl>
        <? /*<dl class="register-intro register-intro-c">
                    <dt class="register-title">
                        <img src="<?=IMAGE_URL;?>/reg_com.jpg" class="reg-image" /><br />
                        <font class="register-type">中介公司或门店注册</font>
                    </dt>
                    <dd>
                        <ul class="reg-info-list">
                            <li><em>更多</em>客户来电、<em>更多</em>客户来访</li>
                            <li><em>便捷</em>制作房源单片、房型图<br>提供房源描述模板、系统预约自动刷新</li>
                        </ul>
                        <div class="entrance-box">
                            <p><a href="#" onclick="javascript:register('reg-form','<?php echo Yii::app()->createUrl("/site/companyregister") ?>')"><img src="<?=IMAGE_URL;?>/register.png"/></a></p>
                            <p class="other">已经注册了？点此<a class="btn-reglog" href="<?php echo Yii::app()->createUrl("/site/login") ?>">登录</a></p>
                      </div>
                    </dd>
                </dl>
         * */?>
         
          <input type="hidden" id="regBackUrl" name="regBackUrl" value="">
          </form>
                <!-- call-number end -->
        </div>
    </div>
</div>
<script type="text/javascript" language="javascript">
    if(document.referrer.indexOf(location.hostname)>0){$("#reg-form").find("#regBackUrl").attr('value',document.referrer);}
    function register(formId,url){
        $('#'+formId).attr('action',url);
        $('#'+formId).submit();
    }
</script>