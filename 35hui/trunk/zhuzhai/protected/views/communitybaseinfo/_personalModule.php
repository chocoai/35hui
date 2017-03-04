<?php
$personalInfo = Unormal::model()->findByAttributes(array('puser_uid'=>$ownerInfo->user_id));
$this->renderPartial('/msg/_form', array('toUserId'=>$ownerInfo->user_id));
$this->renderPartial('_baseModule',array('residenceModel'=>$residenceModel,'communityInfo'=>$communityInfo,"tel"=>$personalInfo->puser_tel));
?>
<div class="w215px">
    <div class="jjrpic"><img src="<?=User::model()->getUserHeadPic($personalInfo->puser_uid);?>" width="100" height="130" alt="" /></div>
    <div class="alignleft" style="text-align: center">
        <span>业主</span>
        <br />
        <span>Email：<?=$ownerInfo->user_email?$ownerInfo->user_email:"未填写"?></span><br />
    </div>
    <div class="margin5"><a href="javascript:checkUser();"><img src="<?=IMAGE_URL?>/loupan033.gif" /></a></div>
</div>