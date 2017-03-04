<style type="text/css">
    .gray {background-color: #edf0f5;}
	.sishi{width:38px; float:left; max-height:32px;}
	.tw{width:145px; white-space:normal; word-break:break-all; float:left;  max-height:32px;}
</style>
<?php
$agentInfo = Uagent::model()->with('company')->findByAttributes(array('ua_uid'=>$ownerInfo->user_id));
?>
<?php echo $this->renderPartial('/msg/_form', array('toUserId'=>$ownerInfo->user_id));?>
<div class="w725 gray">
	<div style="background:url(/images/lefttop.gif) no-repeat; height: 8px; margin-bottom: -3px;"></div>
	<div class="border  gray">
		<ul class="xiezilou_leftulone">
			<li class="one"><img src="<?=User::model()->getUserHeadPic($agentInfo->ua_uid);?>" height="130" width="100" class="img_border"></li>
			<li class="two">
                <span>姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：<?=CHtml::link(CHtml::encode($agentInfo->ua_realname),array('viewuagent/index','uaid'=>$agentInfo->ua_id))?></span><br />
				资&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;质：<?php
                if(Uagent::model()->getIdentityCertification($agentInfo->ua_uid)){
                    echo CHtml::image(IMAGE_URL."/icon/sf.gif","已认证",array("title"=>"身份已认证 "));
                }else{
                    echo CHtml::image(IMAGE_URL."/icon/sf_gray.gif","未认证",array("title"=>"身份未认证 "));
                }
                echo "&nbsp;";
                if(Uagent::model()->getSeniorityCertification($agentInfo->ua_uid)){
                    echo CHtml::image(IMAGE_URL."/icon/zy.gif","已认证",array("title"=>"名片已认证 "));
                }else{
                    echo CHtml::image(IMAGE_URL."/icon/zy_gray.gif","未认证",array("title"=>"名片未认证 "));
                }
                echo "&nbsp;";
                if(Uagent::model()->getBindingBusiness($agentInfo->ua_uid)){
                    echo CHtml::image(IMAGE_URL."/icon/gsdefy.gif","已认证",array("title"=>"营业执照已认证"));
                }else{
                    echo CHtml::image(IMAGE_URL."/icon/gsdefy_gray.gif","未认证",array("title"=>"执照未认证 "));
                }
                ?><br />
				服务等级：<?=User::model()->getUserLevelByUserId($agentInfo['ua_uid'])?><br />
                所属区域：<code><?=Region::model()->getNameById($agentInfo['ua_city']).Region::model()->getNameById($agentInfo['ua_district']).Region::model()->getNameById($agentInfo['ua_section'])?></code><br />
                所属门店：<code><?=Uagent::model()->getCompanyByUaid($agentInfo)?></code>
            </li>
			<li class="three">
                <a href="#_self" onclick="checkUser();"><img src="/images/loupan033.gif" alt="给我发站内信"></a>
                <a href="<?=Yii::app()->createUrl('viewuagent/index',array('uaid'=>$agentInfo->ua_id))?>"><img src="/images/loupan034.gif" alt="进入我的店铺"></a>
            </li>
		</ul>
        <?php
        $this->renderPartial('_baseModule',array('model'=>$model,'buildingInfo'=>$buildingInfo,'tel'=>$ownerInfo['user_tel']));
        ?>
		<div style="width: 65px; height: 280px; position: absolute; margin-left: 640px; margin-left:640px\0; *margin-left:440px; _margin-left: 440px; float: right;">
            <?=Officetag::model()->showFourFeatures($model->ob_officeid)?>
        </div>
	</div>
	<div style="background: url(/images/leftbottom.gif) no-repeat; height: 11px;"></div>
</div>