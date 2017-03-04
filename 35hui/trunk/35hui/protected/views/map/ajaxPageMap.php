<?php if($type!=3){?>
<div class="qipao" style="display: block; ">
<div id="maptip_bar" class="qipaobt">
        <div class="l"><span title="<?php echo $buildInfo['sbi_buildingname']?>"><?php echo $buildInfo['sbi_buildingname']?></span></div>
        <div class="r">
           
        </div>
	</div>
	<div class="qipaonr">
		<div class="qipaonr01">
			<div class="qipaonr01l">
                <ul>
                    <li>楼盘地址：<?php echo $buildInfo->sbi_address; ?></li>
                    <li>开盘时间：<?php 
                    $time=date("Y-m-d", $buildInfo->sbi_openingtime);
                    echo $time=='1970-01-01'?'暂无资料':$time;
                    ?></li>
                    <li>开发商：<?php echo $buildInfo->sbi_developer?$buildInfo->sbi_developer:'暂无资料' ;?></li>
                    <li>平均租金：<span><?php echo $buildInfo->sbi_avgrentprice<=0?'暂无资料':$buildInfo->sbi_avgrentprice.'元/平米·天';?></span></li>
                    <li>平均售价：<span><?php echo $buildInfo->sbi_avgsellprice<=0?'暂无资料':$buildInfo->sbi_avgsellprice.'元/平米';?></span></li>
                    <li class="link"><a target="_blank" href="<?=Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>$buildInfo['sbi_buildingid']))?>">查看楼盘详情 &gt;&gt; </a></li>
                </ul>
			</div>
			<div class="qipaonr01r">
                <a target="_blank" href="<?=Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>$buildInfo['sbi_buildingid']))?>">
                    <img border="0" width="168" height="112" src="<?=Picture::model()->getPicByTitleInt($buildInfo['sbi_titlepic'],"_large");?>" alt="<?php echo $buildInfo['sbi_buildingname']?>">
                </a>
            </div>
			<div class="clear"></div>
		</div>
	</div>

</div>
<?php } else{?>
<div class="qipao" style="display: block; ">
    <div id="maptip_bar" class="qipaobt">
        <div class="l"><span title="<?php echo $buildInfo['comy_name']?>"><?php echo $buildInfo['comy_name']?></span></div>
        <div class="r">
            <span onclick="closeTip();" style="cursor:pointer;"><img alt="关闭" src="<?=IMAGE_URL;?>/map_colsetitle14.gif"></span>
        </div>
	</div>
	<div class="qipaonr">
		<div class="qipaonr01">
			<div class="qipaonr01l">
                <ul>
                    <li>小区地址：<?php echo $buildInfo->comy_address; ?></li>
                    <li>建筑年代：<?php
                    echo $buildInfo->comy_buildingera?$buildInfo->comy_buildingera.'年':'暂无资料';
                    ?></li>
                    <li>开发商：<?php echo $buildInfo->comy_developer?$buildInfo->comy_developer:'暂无资料' ;?></li>
                    <li>平均售价：<span><?php echo $buildInfo->comy_avgsellprice<=0?'暂无资料':$buildInfo->comy_avgsellprice.'元/平米';?></span></li>
                    <li class="link"><a target="_blank" href="<?=Yii::app()->createUrl("/communitybaseinfo/view",array("id"=>$buildInfo['comy_id']))?>">查看小区详情 &gt;&gt; </a></li>
                </ul>
			</div>
			<div class="qipaonr01r">
                <a target="_blank" href="<?=Yii::app()->createUrl("/communitybaseinfo/view",array("id"=>$buildInfo['comy_id']))?>">
                    <img border="0" width="168" height="112" src="<?=Picture::model()->getPicByTitleInt($buildInfo['comy_titlepic'],"_normal");?>" alt="<?php echo $buildInfo['comy_name']?>">
                </a>
            </div>
			<div class="clear"></div>
		</div>
	</div>
	
</div>
<?php }?>

<style type="text/css">
.qipao{width:425px;position:absolute;display:none;}
.qipaobt{width:405px;height:33px;line-height:33px;padding:0px 10px;}
.qipaobt .l{float:left;height:33px;line-height:33px;}
.qipaobt .l span,.qipaobt .l span a{font-size:14px;color:#000;font-weight:bold;}
.qipaobt .r{float:right;height:20px; margin-top:8px;}
.qipaonr{width:405px; padding:5px 10px;}
.qipaonr01{width:405px;}
.qipaonr01l{float:left;width:228px;}
.qipaonr01l ul{list-style-type: none}
.qipaonr01l li{line-height:22px;}
.qipaonr01l li.link{color:#0041d9;}
.qipaonr01l li.link a{color:#0041d9;}
.qipaonr01l li span{font-family:Arial;font-size:18px;font-weight:bold; color:#ff6600}
.qipaonr01r{float:right;width:167px;padding-top:5px;}

</style>