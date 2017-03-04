<?php
$agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$ownerInfo->user_id));
$this->renderPartial('_baseModule',array('residenceModel'=>$residenceModel,'communityInfo'=>$communityInfo,"tel"=>$ownerInfo['user_tel']));
echo $this->renderPartial('/msg/_form', array('toUserId'=>$ownerInfo->user_id));
?>
<div class="w215px">
    <div class="jjrpic"><a href="<?=Yii::app()->createUrl("viewuagent/index",array("uaid"=>$agentInfo->ua_id));?>"><img src="<?=User::model()->getUserHeadPic($agentInfo->ua_uid);?>" width="100" height="130" alt="" /></a></div>
    <div class="alignleft">
        <span>姓&nbsp;&nbsp;名：<?=CHtml::link(CHtml::encode($agentInfo->ua_realname),array('viewuagent/index','uaid'=>$agentInfo->ua_id))?></span>
        <br />
        <span>资&nbsp;&nbsp;质：
        <?php
            if(Uagent::model()->getIdentityCertification($agentInfo->ua_uid)){
                echo CHtml::image(IMAGE_URL."/icon/sf.gif","已认证",array("title"=>"身份已认证 "));
            }else{
                echo CHtml::image(IMAGE_URL."/icon/sf_gray.gif","未认证",array("title"=>"身份未认证 "));
            }
            echo "&nbsp;";
            if(Uagent::model()->getSeniorityCertification($agentInfo->ua_uid)){
                echo CHtml::image(IMAGE_URL."/icon/zy.gif","已认证",array("title"=>"名片已认证"));
            }else{
                echo CHtml::image(IMAGE_URL."/icon/zy_gray.gif","未认证",array("title"=>"名片未认证"));
            }
            echo "&nbsp;";
            if(Uagent::model()->getBindingBusiness($agentInfo->ua_uid)){
                echo CHtml::image(IMAGE_URL."/icon/gsdefy.gif","已认证",array("title"=>"营业执照已认证"));
            }else{
                echo CHtml::image(IMAGE_URL."/icon/gsdefy_gray.gif","未认证",array("title"=>"营业执照未认证"));
            }
        ?>
        </span><br />
        <span>服务等级：<?=User::model()->getUserLevelByUserId($agentInfo['ua_uid'])?></span>
        <br />
        <span>所属区域：<?=Region::model()->getNameById($agentInfo['ua_city']).Region::model()->getNameById($agentInfo['ua_district']).Region::model()->getNameById($agentInfo['ua_section'])?></span>
        <br />
        <span>所属门店：<?=Uagent::model()->getCompanyByUaid($agentInfo)?></span>
    </div>
    <div class="margin5"><a href="javascript:checkUser();"><img src="<?=IMAGE_URL?>/loupan033.gif" alt=""/></a></div>
    <div class="margin5"><a href="<?=Yii::app()->createUrl('viewuagent/index',array('uaid'=>$agentInfo->ua_id))?>"><img src="<?=IMAGE_URL?>/loupan034.gif" alt="" /></a></div>
</div>