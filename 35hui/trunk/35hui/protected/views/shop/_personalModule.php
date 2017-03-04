<style type="text/css">
    .gray {background-color: #edf0f5;}
	.sishi{width:38px; float:left; max-height:32px;}
	.tw{width:145px; white-space:normal; word-break:break-all; float:left;  max-height:32px;}
    .w340{ width: 340px; white-space:normal; word-wrap:break-word; word-break:break-all; word-break:break-word; float:left;  max-height:32px;}
	.ne{width:60px; float:left; max-height:32px;}
</style>
<?php
$personalInfo = Unormal::model()->findByAttributes(array('puser_uid'=>$ownerInfo->user_id));
?>
<?php echo $this->renderPartial('/msg/_form', array('toUserId'=>$ownerInfo->user_id));?>
<div class="w725">
	<div style="background:url(/images/lefttop.gif) no-repeat; height: 8px; margin-bottom: -3px;"></div>
	<div class="border gray">
		<ul class="xiezilou_leftulone">
			<li class="one">
                <img width="100" height="130" class="img_border" src="<?=User::model()->getUserHeadPic($personalInfo->puser_uid, "_normal");?>" />
            </li>
			<li style="text-align:center; width: 130px; color: #333"><span>业主</span></li>
			<li style="color:#333;">Email：<code><?=$ownerInfo->user_email?$ownerInfo->user_email:"未填写"?></code></li>
			<li class="three">
				<a onclick="checkUser();" href="#_self"><img alt="给我发站内信" src="/images/loupan033.gif"></a>
			</li>
		</ul>
        <?php
        $this->renderPartial('_baseModule',array('shopModel'=>$shopModel,'buildingInfo'=>$buildingInfo,"tel"=>$personalInfo->puser_tel));
        ?>
		<div style="width: 65px; height: 280px; position: absolute; margin-left: 640px; margin-left:640px\0; *margin-left:440px; _margin-left: 440px; float: right;">
			<?=Shoptag::model()->showFourFeatures($shopModel->sb_shopid)?>
        </div>
	</div>
	<div style="background: url(/images/leftbottom.gif) no-repeat; height: 11px;"><img src="/images/leftbottom.gif" width="725" height="11"></div>
</div>