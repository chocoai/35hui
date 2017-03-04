<?php
$companyInfo = Ucom::model()->findByAttributes(array('uc_uid'=>$ownerInfo->user_id));
echo $this->renderPartial('/msg/_form', array('toUserId'=>$ownerInfo->user_id));
$this->renderPartial('_baseModule',array('residenceModel'=>$residenceModel,'communityInfo'=>$communityInfo,"tel"=>$companyInfo['uc_tel']));
?>
<div class="w215px">
    <div class="jjrpic"><a href="<?=Yii::app()->createUrl("viewuagent/index",array("ucid"=>$companyInfo->uc_id));?>"><img src="<?=User::model()->getUserHeadPic($companyInfo->uc_uid);?>" width="100" height="100" alt="" /></a></div>
    <div class="alignleft">
        <span>姓&nbsp;&nbsp;名：<?=CHtml::link(CHtml::encode($companyInfo->uc_fullname),array('viewucom/index','ucid'=>$companyInfo->uc_id))?></span>
        <br />
        <span>资&nbsp;&nbsp;质：
        <?php
            if(Ucom::model()->getComCheck($companyInfo->uc_uid)){
                echo CHtml::image(IMAGE_URL."/icon/gsdefy.gif","",array("title"=>"营业执照已认证"));
            }else{
                echo CHtml::image(IMAGE_URL."/icon/gsdefy_gray.gif","营业执照未认证",array("title"=>"营业执照未认证"));
            }
        ?>
        </span><br />
        <span>服务区域：<?=Region::model()->getNameById($companyInfo['uc_city']).Region::model()->getNameById($companyInfo['uc_district']).Region::model()->getNameById($companyInfo['uc_section'])?></span>
    </div>
    <div class="margin5"><a href="javascript:checkUser();"><img src="<?=IMAGE_URL?>/loupan033.gif" /></a></div>
    <div class="margin5"><a href="<?=Yii::app()->createUrl('viewucom/index',array('ucid'=>$companyInfo->uc_id))?>"><img src="<?=IMAGE_URL?>/loupan034.gif" /></a></div>
</div>