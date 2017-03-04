<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
?>
<link rel="stylesheet" type="text/css" href="/css/global.css" />
<link rel="stylesheet" type="text/css" href="/css/lou.css" />
<style type="text/css">
	.searchTool .btnSearch input {background:url(../images/bg.gif) 0 -1760px no-repeat;	display:block;text-decoration:none;	height:31px;overflow:hidden;width:65px;	cursor:pointer;	border:none;*+margin-left:0 !important;	}
	.searchTool .btnSearch{margin-left: 5px;}
	.loupan_onelineright{margin-top: 5px;}
	.loupan_onelinerightboxone {background: url("../images/loupan.gif") no-repeat scroll 4px -69px transparent;	overflow: hidden;width: 100%;margin-left: 8px;}
	.loupan_twoleftboxfour .serach_moreultwo {color: #4A4A4A;	float: left;height: 16px;line-height: 16px;	margin-top: 8px;overflow: hidden;width: 100%;}
	.orange{BACKGROUND-COLOR:#df5006; color:#FFF; width:70px; margin-right:10px; float:left; height:21px; line-height:21px;}
	.loupan_onelinerighttitle {	height: 29px;line-height: 29px;	margin-top: 5px;overflow: hidden;padding-top: 10px;}
	.loupan_onelinerightboxone {background: url("../images/loupan.gif") no-repeat scroll 4px -69px transparent;	height: auto;margin-bottom: 10px;margin-left: 8px;width: 100%;}
	.loupan_onelinerightlineone{margin-bottom: -3px; *+padding-bottom:-3px;}
</style>
<?php
$this->pageTitle = $seotkd->stkd_title;
$this->breadcrumbs = array(
	'楼盘',
);
if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration']))) {
	$searchLink = Yii::app()->createUrl("systembuildinginfo/buildlist");
	?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/meigong/lanrentuku_com02.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/meigong/main.js" type="text/javascript"></script>
<!--content start-->
<div class="clearfix"  style="width:1003px;margin:0px auto;background-color: #FFFFFF">
	<!--oneline start-->
	<div class="clearfix">
		<div class="loupan_left">
			<div class="loupan_onelineleft">
				<div class=txt id="DivShopPaiHang_ShowPanel">
					<div class=txt11>
						<ul>
								<?php
								if (!empty($buildingrecommend)) {
									foreach ($buildingrecommend as $key => $value) {
										?>
							<li class="more" id="DivShopPaiHangFlag1_B<?=$key+1?>" style="display:none;height:209px;">
								<div class="productInfovb"> <a target="_blank" title="<?=@$value->buildingInfo->sbi_buildingname;?>" href="<?=Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>@$value->buildingInfo->sbi_buildingid));?>">
													<?=@$value->buildingInfo->sbi_buildingname;?>
									</a> </div>
								<a target="_blank" title="" href="<?=Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>@$value->buildingInfo->sbi_buildingid));?>"> <img alt="<?=@$value->buildingInfo->sbi_buildingname?>" id="Img_DivShopPaiHangFlag1_<?=$key+1?>" style="veritcal-align:middle;" height="178px" alt="" width="325px" /> </a>
								<div id="ImgSrc_DivShopPaiHangFlag1_<?=$key+1?>" style="display:none">
												<?=Picture::model()->getPicByTitleInt(@$value->buildingInfo->sbi_titlepic,"_normal")?>
								</div>
							</li>
							<li class="num<?=$key+1?> listHeight" id="DivShopPaiHangFlag1_S<?=$key+1?>" onMouseOver="SwapPaiHangShopDiv('DivShopPaiHangFlag1','<?=$key+1?>')" style="height:31px;">
								<div class="productInfovbvc"> <a target="_blank" title="<?=@$value->buildingInfo->sbi_buildingname;?>" href="<?=Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>@$value->buildingInfo->sbi_buildingid));?>">
													<?=@$value->buildingInfo->sbi_buildingname;?>
									</a> </div>
							</li>
										<?php
									}
								}
								?>
							<li class="more" id="DivShopPaiHangFlag1_B1" style="display:none;height:209px;"></li>
							<li class="num1 listHeight" id="DivShopPaiHangFlag1_S1" onMouseOver="SwapPaiHangShopDiv('DivShopPaiHangFlag1','1')" style="height:31px;"></li>
							<li class="more" id="DivShopPaiHangFlag1_B2" style="display:none;height:209px;"></li>
							<li class="num2 listHeight" id="DivShopPaiHangFlag1_S2" onMouseOver="SwapPaiHangShopDiv('DivShopPaiHangFlag1','2')" style="height:31px;"></li>
							<li class="more" id="DivShopPaiHangFlag1_B3" style="display:none;height:209px;"></li>
							<li class="num3 listHeight" id="DivShopPaiHangFlag1_S3" onMouseOver="SwapPaiHangShopDiv('DivShopPaiHangFlag1','3')" style="height:31px;"></li>
						</ul>
					</div>
				</div>
				<script type="text/javascript">
					if(3>=1){
						SwapPaiHangShopDiv('DivShopPaiHangFlag1','1');
					}
				</script>
			</div>
			<div class="loupan_onelinemiddle">
				<div class="loupan_onelinemiddlelineone"></div>
				<div class="loupan_onelinemiddlebox">
					<ul class="loupan_onelinemiddleulone">
						<li class="one" id="loubright1" onmouseover="loubturnit(1);">按区域搜索</li>
						<li class="two" id="loubright2" onmouseover="loubturnit(2);">按地铁搜索</li>
						<li class="two" id="loubright3" onmouseover="loubturnit(3);">按价格搜索</li>
					</ul>
					<div id="loubrightChild1" class="loupan_onelinemiddlemap">
						<div id="districts" style="width:350px;">
							<ul class="districts items">
									<?php
									foreach ($districts as $district) {
										?>
								<li onclick="changeSection('<?=$district['re_id']?>',this)">
											<?=$district['re_name']?>
								</li>
										<?
									}
									?>
							</ul>
						</div>
						<div class="clear"></div>
						<div id="sections" style="width:350px;"></div>
					</div>
					<div id="loubrightChild2" class="hidden" style="margin-top: 10px;">
						<img src="/images/map.gif" alt="" width="347px" height="216px" usemap="#map2"/>
						<map  name="map2">
                            <area  coords="85,117,145,139" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>41)));?>" alt="1号线" >
							<area  coords="104,49,164,76" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>42)));?>" alt="2号线">
							<area coords="183,11,245,32" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>43)));?>" alt="3号线">
							<area coords="258,26,321,47" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>44)));?>" alt="4号线">
							<area coords="111,178,172,205" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>45)));?>" alt="5号线"/>
							<area  coords="270,163,334,185" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>46)));?>" alt="6号线">
							<area  coords="137,84,190,110" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>47)));?>" alt="7号线">
							<area  coords="229,83,296,109" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>48)));?>" alt="8号线">
							<area  coords="67,153,125,180" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>49)));?>" alt="9号线">
							<area  coords="203,42,256,67" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>50)));?>"alt="10号线" >
							<area  coords="8,8,68,31" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/buildlist",SearchMenu::dealOptions(array("metro"=>80)));?>" alt="11号线">
						</map>
					</div>
					<div id="loubrightChild3" class="hidden">

						<style type="text/css">
							#rent li{width:45px; display:block; float:left; height:25px; line-height:25px; margin-left:10px; margin-right:10px;}
							#sell li{display:block;  float:left; margin-right:7px; height:25px; line-height:25px; width: 120px;}
							#sell li a{display: block; float:left; width: 120px; text-align: center;}
						</style>
						<div style="margin-top: 30px;" id="loubrightChild3" class="loupan_onelinemiddlemap">
							<div style="width: 350px; height: 50px;">
								<div class="yellow" style="cursor: pointer;">平均租金</div>
								<ul style="width: 260px; float: left;" id="rent">
										<?php
										foreach ($rentPriceConditions as $rentObject) {
                                        ?>
                                    <li><a href="<?=Yii::app()->createUrl("buildlist",SearchMenu::dealOptions(array("avgr"=>$rentObject['sc_id'])));?>" target="_blank"><?=$rentObject['sc_title']?></a></li>
                                        <?php
										}
										?>
								</ul>
							</div>
							<div class="buildingPriceModule" style="width: 350px; margin-top: 35px;">
								<div class="yellow" style="cursor: pointer;">平均售价</div>
								<ul id="sell" style="width: 260px; float: left;">
										<?php
										foreach ($sellPriceConditions as $sellObject) {
                                        ?>
                                    <li><a href="<?=Yii::app()->createUrl("buildlist",SearchMenu::dealOptions(array("avgs"=>$sellObject['sc_id'])));?>" target="_blank"><?=$sellObject['sc_title']?></a></li>
                                        <?php
										}
										?>
								</ul>
							</div>
						</div>

					</div>
				</div>
				<div class="loupan_onelinemiddlelinetwo"></div>
			</div>
			<div class="c"></div>
			<div class="loupan_twolineoneline"></div>
			<div class="loupan_twoleftbox">
				<ul class="loupan_twoleftulone">
					<li class="one">最新楼盘</li>
					<li class="two" id="louright1" onmouseover="louturnit(1,2);"><strong>本月开盘</strong></li>
					<li class="three" id="louright2" onmouseover="louturnit(2,2);"><strong>下月开盘</strong></li>
					<li class="four" id="monthlist"><a target="_blank" href="<?=Yii::app()->createUrl("/systembuildinginfo/buildlist")?>">更多&gt;&gt;</a></li>
				</ul>
				<div class="loupan_twoleftboxtwo">
					<div class="loupan_twoleftboxthree clearfix">
						<div id="lourightChild1" class="nohidden">
							<div class="loupan_twoleftboxfour">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?
									foreach ($curMonthBuildings as $ckey => $curBuilding) {
										if ($ckey < 6) {
											?>
								<ul class="serach_moreultwo">
									<li class="morelione">
													<?=CHtml::link(common::strCut(CHtml::encode($curBuilding->sbi_buildingname), 24),array('systembuildinginfo/view','id'=>$curBuilding->sbi_buildingid),array('title'=>$curBuilding->sbi_buildingname));?>
									</li>
									<li class="morelitwo">
													<?=Region::model()->getNameById($curBuilding->sbi_district)?>
									</li>
									<li class="morelithree">
													<?=$curBuilding->sbi_avgsellprice==0?"待定":"￥".$curBuilding->sbi_avgsellprice?>
									</li>
								</ul>
											<?
										}
									}
									?>
							</div>
							<div class="loupan_twoleftboxfour" style="float:right;">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?
									foreach ($curMonthBuildings as $ckey => $curBuilding) {
										if ($ckey >= 6 && $ckey < 12) {
											?>
								<ul class="serach_moreultwo">
									<li class="morelione">
													<?=CHtml::link(common::strCut(CHtml::encode($curBuilding->sbi_buildingname), 24),array('systembuildinginfo/view','id'=>$curBuilding->sbi_buildingid),array('title'=>$curBuilding->sbi_buildingname));?>
									</li>
									<li class="morelitwo">
													<?=Region::model()->getNameById($curBuilding->sbi_district)?>
									</li>
									<li class="morelithree">
													<?=$curBuilding->sbi_avgsellprice==0?"待定":"￥".$curBuilding->sbi_avgsellprice?>
									</li>
								</ul>
											<?
										}
									}
									?>
							</div>
						</div>
						<div id="lourightChild2"  class="hidden">
							<div class="loupan_twoleftboxfour">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?
									foreach ($nextMonthBuildings as $nkey => $nextBuilding) {
										if ($nkey < 6) {
											?>
								<ul class="serach_moreultwo">
									<li class="morelione">
													<?=CHtml::link(common::strCut(CHtml::encode($nextBuilding->sbi_buildingname), 24),array('systembuildinginfo/view','id'=>$nextBuilding->sbi_buildingid),array('title'=>$nextBuilding->sbi_buildingname));?>
									</li>
									<li class="morelitwo">
													<?=Region::model()->getNameById($nextBuilding->sbi_district)?>
									</li>
									<li class="morelithree">
													<?=$nextBuilding->sbi_avgsellprice==0?"待定":"￥".$nextBuilding->sbi_avgsellprice?>
									</li>
								</ul>
											<?
										}
									}
									?>
							</div>
							<div class="loupan_twoleftboxfour" style="float:right;">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?
									foreach ($nextMonthBuildings as $nkey => $nextBuilding) {
										if ($nkey >= 6 && $neky < 12) {
											?>
								<ul class="serach_moreultwo">
									<li class="morelione">
													<?=CHtml::link(common::strCut(CHtml::encode($nextBuilding->sbi_buildingname), 24),array('systembuildinginfo/view','id'=>$nextBuilding->sbi_buildingid),array('title'=>$nextBuilding->sbi_buildingname));?>
									</li>
									<li class="morelitwo">
													<?=Region::model()->getNameById($nextBuilding->sbi_district)?>
									</li>
									<li class="morelithree">
													<?=$nextBuilding->sbi_avgsellprice==0?"待定":"￥".$nextBuilding->sbi_avgsellprice?>
									</li>
								</ul>
											<?
										}
									}
									?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="loupan_twolinetwoline"></div>
			<div class="loupan_twolineoneline"></div>
			<div class="loupan_twoleftbox">
				<ul class="loupan_twoleftulone">
					<li class="one">已开楼盘</li>
					<li class="two" id="louaright1" onmouseover="louaturnit(1);"><strong>
								<?php $n = date("n")-3;
	if($n<1)echo 12+$n;else echo $n; ?>
							月</strong></li>
					<li class="three" id="louaright2" onmouseover="louaturnit(2);"><strong>
	<?php $n = date("n")-2;
	if($n<1)echo 12+$n;else echo $n; ?>
							月</strong></li>
					<li class="three" id="louaright3" onmouseover="louaturnit(3);"><strong>
	<?php $n = date("n")-1;
	if($n<1)echo 12+$n;else echo $n; ?>
							月</strong></li>
					<!-- <li class="four"><a href="#">更多&gt;&gt;</a></li> -->
				</ul>
				<div class="loupan_twoleftboxtwo">
					<div class="loupan_twoleftboxthree clearfix">
	<?php $changehtmllist = Systembuildinginfo::model()->getBuildinfoByMonth(date("n")-3,12) ?>
						<div id="louarightChild1"  class="nohidden">
							<div class="loupan_twoleftboxfour">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?php
									if (!empty($changehtmllist)) {
		foreach ($changehtmllist as $key => $value) {
			if ($key < 6) {//显示前6条
														?>
								<ul class="serach_moreultwo">
									<li class="morelione">
														<?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/view","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
									</li>
									<li class="morelitwo">
														<?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
									</li>
									<li class="morelithree">
												<?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
									</li>
								</ul>
												<?php
											}
		}
	}
	?>
							</div>
							<div class="loupan_twoleftboxfour" style="float:right;">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?php
									if (!empty($changehtmllist)) {
		foreach ($changehtmllist as $key => $value) {
			if ($key >= 6) {//显示后十条
														?>
								<ul class="serach_moreultwo">
									<li class="morelione">
														<?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/view","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
									</li>
									<li class="morelitwo">
														<?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
									</li>
									<li class="morelithree">
												<?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
									</li>
								</ul>
												<?php
											}
		}
	}
	?>
							</div>
						</div>
						<div id="louarightChild2"  class="hidden">
	<?php $changehtmllist = Systembuildinginfo::model()->getBuildinfoByMonth(date("n")-2,12) ?>
							<div class="loupan_twoleftboxfour">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?php
									if (!empty($changehtmllist)) {
		foreach ($changehtmllist as $key => $value) {
			if ($key < 6) {//显示前十条
														?>
								<ul class="serach_moreultwo">
									<li class="morelione">
														<?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/view","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
									</li>
									<li class="morelitwo">
														<?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
									</li>
									<li class="morelithree">
												<?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
									</li>
								</ul>
												<?php
											}
		}
	}
	?>
							</div>
							<div class="loupan_twoleftboxfour" style="float:right;">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?php
									if (!empty($changehtmllist)) {
		foreach ($changehtmllist as $key => $value) {
			if ($key >= 6) {//显示后十条
														?>
								<ul class="serach_moreultwo">
									<li class="morelione">
														<?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/view","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
									</li>
									<li class="morelitwo">
														<?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
									</li>
									<li class="morelithree">
												<?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
									</li>
								</ul>
												<?php
											}
		}
	}
	?>
							</div>
						</div>
						<div id="louarightChild3"  class="hidden">
	<?php $changehtmllist = Systembuildinginfo::model()->getBuildinfoByMonth(date("n")-1,12) ?>
							<div class="loupan_twoleftboxfour">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?php
									if (!empty($changehtmllist)) {
		foreach ($changehtmllist as $key => $value) {
			if ($key < 6) {//显示前十条
														?>
								<ul class="serach_moreultwo">
									<li class="morelione">
														<?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/view","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
									</li>
									<li class="morelitwo">
														<?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
									</li>
									<li class="morelithree">
												<?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
									</li>
								</ul>
												<?php
											}
		}
	}
	?>
							</div>
							<div class="loupan_twoleftboxfour" style="float:right;">
								<ul class="serach_moreulone">
									<li class="morelione">楼盘名称</li>
									<li class="morelitwo">区县</li>
									<li class="morelithree">均价</li>
								</ul>
									<?php
									if (!empty($changehtmllist)) {
		foreach ($changehtmllist as $key => $value) {
			if ($key >= 6) {//显示后十条
														?>
								<ul class="serach_moreultwo">
									<li class="morelione">
														<?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/view","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
									</li>
									<li class="morelitwo">
														<?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
									</li>
									<li class="morelithree">
												<?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
									</li>
								</ul>
												<?php
											}
		}
	}
	?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="loupan_twolinetwoline"></div>
			<div class="loupan_twolineoneline"></div>
			<div class="loupan_twoleftbox">
				<ul class="loupan_twoleftulone">
					<li class="one">热门楼盘</li>
					<li class="four">
	<?=CHtml::link("更多&gt;&gt;",array('systembuildinginfo/buildlist'))?>
					</li>
				</ul>
				<ul class="loupan_twoleftultwo clearfix">
	<?
								foreach ($hotBuildings as $hotBuilding) {
		?>
                    <li> <a href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$hotBuilding->sbi_buildingid)); ?>"> <img alt="<?=$hotBuilding->sbi_buildingname?>" class="img_border" src="<?=Picture::model()->getPicByTitleInt($hotBuilding->sbi_titlepic,"_small")?>" width="150px" height="100px" /> </a> <a href="<?=Yii::app()->createUrl("officebaseinfo/rentIndex",array("district"=>$hotBuilding->sbi_district))?>" class="showblue">
		<?='['.Region::model()->getNameById($hotBuilding->sbi_district).']'?>
						</a> <strong>
									<?=CHtml::link(common::strCut(CHtml::encode($hotBuilding->sbi_buildingname), 21),array('systembuildinginfo/view','id'=>$hotBuilding->sbi_buildingid),array('class'=>'colorred','title'=>$hotBuilding->sbi_buildingname));?>
						</strong><br />
						物业费：<?=$hotBuilding->sbi_propertyprice?'<code>'.$hotBuilding->sbi_propertyprice.'</code>元/平米·月':'暂无资料';?><br />
						开发商：
									<?php echo $hotBuilding->sbi_developer?$hotBuilding->sbi_developer:'暂无资料';?>
						<br />
						<span>点击次数：
							<?=$hotBuilding->sbi_visit?>
						</span> </li>
		<?
	}
	?>
				</ul>
			</div>
			<div class="loupan_twolinetwoline"></div>
			<div class="loupan_twolineoneline"></div>
			<div class="loupan_twoleftbox">
				<ul class="loupan_twoleftulone">
					<li class="one">精品写字楼推荐</li>
				</ul>
				<ul class="loupan_twoleftultwo clearfix">
                <?php
                foreach ($list as $value) {
                    if($value->sp_sourceid){
                        ?>
                        <li>
                            <a target="_blank" href="<?=Yii::app()->createUrl('/office/view',array("id"=>$value->sp_sourceid));?>">
                                <img class="img_border" alt="<?=$value->baseoffice->ob_officename?>" src="<?=Picture::model()->getPicByTitleInt(@$value->baseoffice->presentInfo->op_titlepicurl,"_small");?>" width="150px" height="100px" />
                            </a>
                            <?=CHtml::link('['.Region::model()->getNameById(@$value->baseoffice->ob_district).']',array($value->baseoffice->ob_sellorrent==1?"/officebaseinfo/rentIndex":"/officebaseinfo/saleIndex","district"=>@$value->baseoffice->ob_district),array("class"=>"showblue"));?>
                            <strong>
                                <a target="_blank" href="<?=Yii::app()->createUrl('/office/view',array("id"=>$value->sp_sourceid));?>" class="colorred" title="<?=$value->baseoffice->ob_officename?>"> <?php echo common::strCut($value->baseoffice->ob_officename, 18);?> </a>
                            </strong>
                            <br />
                            面积：<code>
                                    <?=$value->baseoffice->ob_officearea;?>
                            </code>平米<br />
                                    <?php
                                    if($value->baseoffice->ob_sellorrent==1) {
                                        echo "租金：&nbsp;";
                                        echo "<code>".$value->baseoffice->rentInfo->or_rentprice."</code>&nbsp;元/平米·天";
                                    }elseif($value->baseoffice->ob_sellorrent==2) {
                                        echo "售价：&nbsp;";
                                        echo "<code>".($value->baseoffice->sellInfo->os_avgprice)."</code>&nbsp;元/平米";
                                    }?>
                            <br />
                            <span>点击次数：
                                <?=$value->baseoffice->ob_visit;?>
                            </span>
                        </li>
                    <?php
                    }
                }
                ?>
				</ul>
			</div>
                        <div class="loupan_twolinetwoline"></div>
			<div class="loupan_twolineoneline"></div>
                        <div>
                            <script type="text/javascript"><!--
                            google_ad_client = "ca-pub-7790193278112816";
                            /* 图片广告 */
                            google_ad_slot = "3250767977";
                            google_ad_width = 728;
                            google_ad_height = 90;
                            //-->
                            </script>
                            <script type="text/javascript"
                            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                            </script>
                        </div>
                        <div class="loupan_twolinetwoline"></div>
		</div>





		<div class="loupan_onelineright">
			<div class="loupan_onelinerightlineone"></div>
			<dl class="loupan_onelinerightbox" style="height:auto;">
				<div class="loupan_onelinerighttitle"><strong>楼盘搜索</strong></div>
				<div class="c"></div>
				<ul class="ulmargin" style="margin-top:10px;margin-bottom: 0px;margin-left: 0px;margin-right: 0px">
					<form action="/site/searchmenu" method="post">
						<li>
							<div class="searchTool">
                                <input type='hidden' name='option' value='keyword' />
								<input class="txtSearch" name="keyword" type="text" value="" style="margin-left:10px;" />
								<div class="btnSearch">
									<input value="" type="submit" />
								</div>
							</div>
						</li>
						<li class="ss_wz ssli" style="margin-left:12px;"><span>示例：  人民广场   中融恒瑞</span></li>
						<input type="hidden" name="action" value="/systembuildinginfo/buildlist" />
					</form>
				</ul>
			</dl>
			<div class="loupan_onelinerightlinetwo"></div>
			<div class="loupan_onelinerightlineone"></div>
			<dl class="loupan_onelinerightbox" style="height:auto;">
				<div class="loupan_onelinerighttitle"><strong>地图搜索</strong></div>
				<div class="c"></div>
				<ul class="ulmargin" style="margin-top:10px;margin-bottom: 0px;margin-left: 0px;margin-right: 0px">
					<form action="/site/searchmenu" method="post">
						<li>
							<div class="searchTool">
								<input class="txtSearch" name="kwd" type="text" value="" style="margin-left:10px;" />
								<div class="btnSearch">
									<input value="" type="submit" />
								</div>
							</div>
						</li>
						<li class="ss_wz ssli" style="margin-left:15px;"><span>示例：  人民广场   中融恒瑞</span></li>
						<input type="hidden" name="action" value="/map/map" />
					</form>
				</ul>
			</dl>
			<div class="loupan_onelinerightlinetwo"></div>
			<div class="c"></div>
			<div class="loupan_onelinerightlineone"></div>
			<div class="loupan_onelinerightbox">
				<div class="loupan_onelinerighttitle"> <strong>楼盘点评</strong>
					<?=CHtml::link("更多&gt;&gt;",array('systembuildinginfo/comment'),array('class'=>'showblue'))?>
				</div>
	<?php
	foreach($recentComments as $recentComment) {
		?>
				<dl class="loupan_onelinerightonedl">
					<dt style="width:240px; float:left; padding-left: 12px;*padding-left:3px;  *width:230px; *overflow:hidden; _padding-left: 5px;">
					<div style="float:left;width:180px;">
		<?=CHtml::link(common::strCut(CHtml::encode($recentComment->buildingInfo['sbi_buildingname']), 27),array('systembuildinginfo/view','id'=>$recentComment->buildingInfo['sbi_buildingid']),array('title'=>$recentComment->buildingInfo['sbi_buildingname']));?>
						<a href="<?=Yii::app()->createUrl("officebaseinfo/rentIndex",array("district"=>$recentComment->buildingInfo['sbi_district']));?>" class="showblue" title="<?=region::model()->getNameById($recentComment->buildingInfo['sbi_district']);?>">[
		<?=common::strCut(region::model()->getNameById($recentComment->buildingInfo['sbi_district']),12)?>
							]</a> </div>
					</dt>
					<dd style="width:240px; display:block; float:left; margin-bottom:5px!important;_margin-bottom:0;_margin-top:-10px; padding-left: 12px; _padding-left: 0;">
						<!--<div style="width:40px; float:left;">点评：</div>-->
		<?php $num = round(($recentComment['sbc_traffice']+$recentComment['sbc_facility']+$recentComment['sbc_adorn'])/3);
								echo "<div style='float:left'>".common::getStar($num)."</div>"?>
					</dd>
					<br />
					<dd style="padding-left:12px; _padding-left: 0;"> "&nbsp;
		<?=common::strCut(CHtml::encode($recentComment->sbc_comment),90);?>
						&nbsp;" </dd>
					<dd class="add_font" style="padding-left:12px; _padding-left: 0;">于
						<?=common::showFormatDateTime($recentComment->sbc_comdate)?>
						发表</dd>
				</dl>
		<?
	}
	?>
			</div>
			<div class="loupan_onelinerightlinetwo"></div>
			<div class="loupan_onelinerightlineone"></div>
			<div class="loupan_onelinerightbox" style="height:auto;">
				<div class="loupan_onelinerighttitle"> <strong>最受欢迎的楼盘</strong>
	<?=CHtml::link("更多&gt;&gt;",array('systembuildinginfo/buildlist'),array('class'=>'showblue'))?>
				</div>
				<ul class="serach_moreulone">
					<li class="morelione">楼盘名称</li>
					<li class="morelitwo">区县</li>
				</ul>
				<div class="loupan_onelinerightboxone clearfix">
	<?php
								foreach($welcomeBuildings as $welcomeBuilding) {
		?>
					<ul class="serach_moreultwo">
						<li class="morelione">
		<?=CHtml::link(common::strCut($welcomeBuilding->sbi_buildingname, 18),array('systembuildinginfo/view','id'=>$welcomeBuilding->sbi_buildingid),array("title"=>$welcomeBuilding->sbi_buildingname));?>
						</li>
						<li class="morelitwo">
							<?=region::model()->getNameById($welcomeBuilding->sbi_district)?>
						</li>
					</ul>
		<?
	}
	?>
				</div>
			</div>
			<div class="loupan_onelinerightlinetwo"></div>
			<div class="loupanadcss"> <a target="_blank" href="<?=Yii::app()->createUrl('/systembuildinginfo/buildlist',array("filterdate"=>87))?>">查看<strong><?php echo date("n") ?></strong>月楼盘开盘汇总</a> </div>
                         <!-- 投放GOOGLE广告联盟的广告-->
                        <div class="loupan_onelinerightlinetwo"></div>
			<div class="loupan_onelinerightlineone"></div>
                        <div class="loupan_onelinerightbox" style="height:auto;">
                            <script type="text/javascript"><!--
                            google_ad_client = "ca-pub-7790193278112816";
                            /* 文字广告 */
                            google_ad_slot = "1656658047";
                            google_ad_width = 250;
                            google_ad_height = 250;
                            //-->
                            </script>
                            <script type="text/javascript"
                            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                            </script>
                        </div>
                        <div class="loupan_onelinerightlinetwo"></div>
		</div>
	</div>
	<!--oneline end-->








</div>
<!--content end-->
<script type="text/javascript" language="javascript">
    function changeSection(district,src){
        $(src).siblings().removeClass();
        $(src).attr("class","yellow");
        $("#sections").hide();
        var searchLink = "<?=$searchLink?>";
        var link = "<? echo Yii::app()->createUrl("region/getSectionByDistrict")?>";
        $.ajax({
            url:link,
            data:"districtId="+district,
            success:function(data){
                eval("var sections = " + data + ";");
                var demostr = "<ul class='section'>";
                for(key in sections){
                    demostr += "<li><a href='"+searchLink+"/district"+district+"-section"+sections[key]['re_id']+"'>"+sections[key]['re_name']+"</a></li>";
                }
                demostr += "</ul>";
                $("#sections").html(demostr);
                $("#sections").fadeIn();
            }
        });
        return false;
    }
    //改变最新楼盘更多的链接地址
    function changeUrl(value){
        var link = "<?=Yii::app()->createUrl("/systembuildinginfo/monthlist")?>";
        link += "/month/"+value;
        $("#monthlist a").attr("href",link);
    }
</script>
	<?php $this->endCache();
} ?>
