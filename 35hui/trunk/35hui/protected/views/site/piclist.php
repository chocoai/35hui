<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/js/piclist/Home_v.css" rel="stylesheet" type="text/css">
<script src="/js/piclist/jquery-2.js" type="text/javascript"></script>
<style>
.xztxt{ float:right; width:310px; height:131px;}
.xztxt h5{ clear:both; height:25px; line-height:25px; font-weight:bold; font-size:14px;}
.xztxt h5 a{font-weight:bold; font-size:14px;  color:#0167CC;}
.xztxt p{ clear:both; line-height:22px; text-indent:20px; }
.xztxt .p{ clear:both; height:25px; padding:10px 0 5px 0 ;position: absolute;bottom:0px;}
.xztxt .p span{background-color: #47799A; border-radius: 2px 2px 2px 2px; color: #FFFFFF; display: inline-block; font-size: 12px; height: 22px; line-height: 22px; margin-bottom: 5px; margin-right: 5px; padding: 0 10px;}

</style>
</head>
<body>
	<div class="PicShow clearfix fl">
        <div class="lof-slidecontent" id="lofslidecontent45"  >
            <div class="preload" style="display: none;"><div>
		</div>
	</div>
            <!-- MAIN CONTENT -->
    <div class="lof-main-outer" >
        <ul class="lof-main-wapper lof-opacity">
            <?$buildtitleid=explode("，",$systembuild->hl_piclist);
            foreach($buildtitleid as $val){
            if(!is_numeric($val)){break;}
            $build=Systembuildinginfo::model()->findByPk($val);    ?>
            <li style="opacity: 1; display: block" >
				<a target="_blank" title="<?=$build->sbi_buildingname?>" href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$build->sbi_buildingid))?>">
					<img class="img_SN" src="<?=Picture::model()->getOnePicExceptTitleInt($build->sbi_buildingid,1,$build->sbi_titlepic,"_large");?>" />
					<img class="img_LN" src="<?=Picture::model()->getOnePicExceptTitleInt($build->sbi_buildingid,1,$build->sbi_titlepic,"_large");?>" />
				</a>
				<div class="xztxt" style="left:195px;position:absolute;">
					<h5><a target="_blank"  href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$build->sbi_buildingid))?>" title="<?=$build->sbi_buildingname?>"><?=$build->sbi_buildingname?></a></h5>
					<p>  <?php echo common::strCut(CHtml::encode($build->sbi_buildingintroduce),210); ?></p>
					<div class="p">
                        <span>物业费：<?=$build->sbi_propertyprice?$build->sbi_propertyprice."元/平米•月":"暂无"?></span>
                        <span>租金：<?=$build->sbi_avgrentprice?$build->sbi_avgrentprice."元/平米•月":"暂无"?></span>
                    </div>
					</div>
            </li>
			<?}?>
        </ul>
        </div>
        <!-- END MAIN CONTENT -->
        <!-- NAVIGATOR -->
        <div class="lof-navigator-wapper" >
              <div class="lof-next" onclick="return false"></div>
              <div class="lof-navigator-outer">
                    <ul  class="lof-navigator" >
                    <?$buildtitleid=explode("，",$systembuild->hl_piclist);
                    $i=0;
                    foreach($buildtitleid as $val){
                        if(!is_numeric($val))break;
                        $build=Systembuildinginfo::model()->findByPk($val);?>
                        <li><img <?=$i?'':'class="active"'?>src="<?=Picture::model()->getPicByTitleInt($build->sbi_titlepic,"_normal");?>" alt="<?=$build->sbi_buildingname?>" title="<?=$build->sbi_buildingname?>"></li>
                         <?$i++;}?>
                     </ul>
               </div>
               <div class="lof-previous" onclick="return false"></div>
         </div>
         <script type="text/javascript" src="/js/piclist/Creativf_home.js"></script>
    </div>
</div>
</body>