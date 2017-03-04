<style type="text/css">
    .gray {background-color: #edf0f5;}
	.sishi{width: 38px; float: left; max-height: 32px;}
	.tw{width:145px; white-space:normal; word-break:break-all; float:left;  max-height:32px;}
    .w340{ width: 340px; white-space:normal; word-wrap:break-word; word-break:break-all; word-break:break-word; float:left;  max-height:32px;}
	.ne{width:60px; float:left; max-height:32px;}
</style>
<?php
$companyInfo = Ucom::model()->findByAttributes(array('uc_uid'=>$ownerInfo->user_id));
?>
<?php echo $this->renderPartial('/msg/_form', array('toUserId'=>$ownerInfo->user_id));?>
<div class="w725">
    <div style="background:url(/images/lefttop.gif) no-repeat; height: 8px; margin-bottom: -3px;"></div>
    <div class="border gray">
        <ul class="xiezilou_leftulone">
            <li class="one"><img src="<?=User::model()->getUserHeadPic($companyInfo->uc_uid);?>" height="100" width="100" class="img_border"></li>
            <li class="two">
                <span>门店名称：<?=CHtml::link(CHtml::encode($companyInfo->uc_fullname),array('viewucom/index','ucid'=>$companyInfo->uc_id))?></span><br />
                资&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;质：<?php
                if(Ucom::model()->getComCheck($companyInfo->uc_uid)){
                    echo CHtml::image(IMAGE_URL."/icon/gsdefy.gif","营业执照已认证",array("title"=>"营业执照已认证"));
                }else{
                    echo CHtml::image(IMAGE_URL."/icon/gsdefy_gray.gif","未认证",array("title"=>"执照未认证"));
                }
                ?><br />
                服务区域：<code><?=Region::model()->getNameById($companyInfo['uc_city']).Region::model()->getNameById($companyInfo['uc_district']).Region::model()->getNameById($companyInfo['uc_section'])?></code>
            </li>
            <li class="three">
                <a href="#_self" onclick="checkUser();"><img src="/images/loupan033.gif" alt="给我发站内信" /></a>
                <a href="<?=Yii::app()->createUrl('viewucom/index',array('ucid'=>$companyInfo->uc_id))?>"><img src="/images/loupan034.gif" alt="进放我的店铺" /></a>
            </li>
        </ul>
        <?php
        $this->renderPartial('_baseModule',array('shopModel'=>$shopModel,'buildingInfo'=>$buildingInfo,"tel"=>$companyInfo['uc_tel']));
        ?>
        <div style="width: 65px; height: 280px; position: absolute; margin-left: 640px; margin-left:640px\0; *margin-left:440px; _margin-left: 440px; float: right;">
            <?=Shoptag::model()->showFourFeatures($shopModel->sb_shopid)?>
        </div>
    </div>
    <div style="background:url(/images/leftbottom.gif) no-repeat; height: 11px;"></div>
</div>
