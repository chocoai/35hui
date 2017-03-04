<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
?>
<link href="/css/adjustsearch.css" rel='stylesheet' type='text/css' />
<link href="/css/global.css" rel='stylesheet' type='text/css' />
<link href="/css/lou.css" rel='stylesheet' type='text/css' />
<link href="/css/brow.css" rel='stylesheet' type='text/css' />
<link href="/css/home.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="/css/seardetail.css" />
<style type="text/css">
    .lp_images { clear:both; float:left;}
    .items{margin-top: 0;}
    .loupan_onelinerightbox .serach_moreulone{width:240px; margin-left: 0;}
    .show {display:block }
    .hidden { display:none}
    .price{width:100px; border:1px solid #333; padding-left:7px; height:20px; line-height:20px; float:left;}
    .price {border: 1px solid #999; float: left; line-height: 20px; margin: 7px 3px; padding-left: 7px; width: 100px; background:url(/images/icon_120x83.gif) no-repeat scroll 42px -62px transparent;  z-index: 1; overflow:hidden; }
    #priceTitle{width: 72px; display: block; height: 19px;}
    .pull-down {background: none repeat scroll 0 0 #FFFFFF;border:1px solid #999; font-family: Arial; position: absolute; width: 107px; z-index: 9999;}
    .pull-down dd {color: #0044CC; cursor: pointer; line-height: 22px; padding-left: 5px; width: 100px; }
	.submit_bg {position: relative;text-align: center;top:2px;top:13px\9;top:12px\0;*top:2px;_top:4px;	width: 111px;	}
	@media screen and (-webkit-min-device-pixel-ratio:0) {
		.submit_bg {padding-top:12px;position:relative;	top:6px;}
	}
	#two_right{padding-top:0;}
    #su{background: url("/images/searchouse.png") no-repeat scroll 0 0 transparent;}
	</style>
	<?php
	$this->pageTitle = $seotkd->stkd_title;
	$this->breadcrumbs = array(
		'商务中心' => array("/officebaseinfo/businessIndex"),
		'出租'
	);
	?>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/meigong/lanrentuku_com.js" type="text/javascript"></script>
	<div id="center">
		<!--banner end-->
		<Div>
            					<?php
					$this->widget('SearchMenuCondition', array(
						'options' => $options,
						'officeType' => Findcondition::business,
						'rentorsell' => Findcondition::rent,
					));
					?>
            				<div class="detail">
						<?php
						$this->widget('SearchMenu', array(
							'showMenu' => array(1, 3, 4, 15, 7), //显示的条件
							'url' => "officebaseinfo/rentBusinessList", //url
                            "autoCompleteData"=>1,//自动完成使用数据
                            "sourceType"=>"2",
                            "inputSearchBoolean"=>false,
						));
						?>
				</div>
			<div id="two_left">
                <div style="border-bottom:3px solid #0F8589;height:34px;">
					<?php
					$this->renderPartial('_officetag', array('url' => $url, 'options' => $options, 'type' => $type, 'showTab' => array(1, 5)));
					$allSource = $dataProvider->getData();
                    echo "<div style='float:right; height:20px; padding-top:10px;'>";
                        $this->widget('CDibiaoLinkPager',array(
                        'pages'=>$dataProvider->pagination,
                        "htmlOptions"=>array("style"=>"float:right","class"=>"dibiaoPage",),
                        "nextPageLabel"=>"下一页",
                        "prevPageLabel"=>"上一页",
                        "cssFile"=>"/css/otherPageLink.css",
                        ));
                        echo "</div>";
                    ?>
                </div>
				<div class="serach_lefttwobox">
					<ul class="serach_nav">
						<li id="newSummaryText" style="width: 200px;" class="one">找到相关房源<strong><?=$dataProvider->getTotalItemCount();?></strong>条</li>
						<li style="width: 400px;" class="two">
							<div style="float: left;">按日期排序：</div>
							<div onmouseout="filterdatehidden(this)" onmouseover="filterdateshow(this)" class="price">
								<span id="priceTitle">
										<?php
										$allFilterDate = Searchcondition::model()->getAllFilterDate();
										if(isset ($options['filterdate'])&&key_exists($options['filterdate'], $allFilterDate)) {
											echo $allFilterDate[$options['filterdate']];
										}else {
											echo "不限";
										}
										?>
								</span>
								<dl class="pull-down hidden" style="left: 387px;">
										<?php
										$filterdate_tmp = $options;
										foreach($allFilterDate as $key=>$value) {
                                            echo "<dd><a href='".Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "filterdate", $key))."'>".$value."</a></dd>";
										}
										?>
								</dl>
							</div>
								<?php
								if (isset($options['order']) && $options['order'] == "ru") {
									$options_tmp = 'rd';
									$class = "up";
								} else if (isset($options['order']) && $options['order'] == "rd") {
									$options_tmp = '';
									$class = "down";
								} else {
									$options_tmp = "ru";
									$class = "seabg";
								}
								?>
							<a href="<?php echo Yii::app()->createUrl($url, SearchMenu::dealOptions($options, "order", $options_tmp)) ?>" class="<?=$class?>">租金</a>
						</li>
					</ul>
				</div>
				<style type="text/css">
					.ulthreetwo a:link{color:#0041D9;}.ulthreetwo a:hover{color: #FF6600}.ulthreetwo a:visited{color: #55188A;}
				</style>
                <?php
                foreach($allSource as $data){
                    $this->renderPartial('_rentbusinessList', array('data'=>$data));
                }
                echo "<div style='clear:both; height:35px; padding-top:15px;'>";
				$this->widget('CLinkPager',array(
                'pages'=>$dataProvider->pagination,
                "htmlOptions"=>array("style"=>"float:right"),
                ));
                echo "</div>";
                ?>
			</div>
			<div id="two_right">
				<div class="clear"></div>
				<?php
				$this->widget('RecentView',array());
				?>
				<div class="serach_rightlinethree"></div>
				<div class="serach_rightboxtwo">
					<h2>商务中心推荐</h2>
					<div class="c"></div>

					<?php
					if (!empty($officerecommend)) {
						foreach ($officerecommend as $value) {
							?>
					<div class="qjlp_images">
						<div class="lp_images">
							<a href="<?= Yii::app()->createUrl("officebaseinfo/businessSummarize", array("opid" => $value->baseoffice->ob_officeid)); ?>">
                                <img alt="<?=$value->baseoffice->ob_officename?>" src="<?= Picture::model()->getPicByTitleInt($value->baseoffice->presentInfo['op_titlepicurl'], "_small"); ?>" class="bbd img_border" width="111px" height="74px"/>
							</a>
							<p class=" blue12px " title="<?=$value->baseoffice->presentInfo->op_officetitle?>"><?= CHtml::link(CHtml::encode(common::strCut($value->baseoffice->presentInfo->op_officetitle, 24)),array("officebaseinfo/businessSummarize","opid" => $value->baseoffice->ob_officeid),array("style"=>"color:blue")); ?></p>
							<p><?=Region::model()->getNameById($value->baseoffice->ob_district)."&nbsp;-&nbsp;".Region::model()->getNameById($value->baseoffice->ob_section)?></p>
							<p><span class=" orang12px"><?=$value->baseoffice->rentInfo->or_rentprice?></span>元/间·月</p>
						</div>
					</div>
							<?php
						}
					}
					?>
					<div class="c"></div>
				</div>
				<div class="serach_rightlinefour"></div>
				<div class="clear:both;"></div>

				<div class="serach_rightlinefive"></div>
				<div class="serach_rightboxthree">
					<h2>最受欢迎</h2>
					<div class="txt" id="DivShopPaiHang_ShowPanel">
						<div class="txt11">
							<ul>
								<?php
								foreach ($hits as $key => $hitInfo) {
									?>
								<li class="more" id="DivShopPaiHangFlag1_B<?= $key + 1 ?>" style="display:none">
									<a title="" href="#">
										<a href="<?=Yii::app()->createUrl("officebaseinfo/businessSummarize", array("opid" => $hitInfo->ob_officeid));?>"><img id="Img_DivShopPaiHangFlag1_<?= $key + 1 ?>" class="pimgcss" height="50px" alt="" width="75px" /></a>
									</a>
									<div class="productInfo">
										<h3><?= CHtml::link(CHtml::encode(common::strCut($hitInfo->presentInfo['op_officetitle'], 18)), array('/officebaseinfo/businessSummarize', 'opid' => $hitInfo->ob_officeid), array('title' => $hitInfo->presentInfo['op_officetitle'])); ?></h3>
										<p>点击数：<?= $hitInfo->ob_visit ?>次</p>
									</div>
									<div id="ImgSrc_DivShopPaiHangFlag1_<?= $key + 1 ?>" style="display:none">
											<?= Picture::model()->getPicByTitleInt($hitInfo->presentInfo->op_titlepicurl, '_small') ?>
									</div>
								</li>
								<li class="num<?= $key + 1 ?> listHeight" id="DivShopPaiHangFlag1_S<?= $key + 1 ?>" onMouseOver="SwapPaiHangShopDiv('DivShopPaiHangFlag1','<?= $key + 1 ?>')">
									<dl>
										<dt><a href="#"><?= CHtml::encode($hitInfo->presentInfo['op_officetitle']) ?></a></dt>
										<dd>点击：<span><?= $hitInfo->ob_visit ?></span></dd>
									</dl>
								</li>
									<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
				<div class="serach_rightlinesix"></div>
				<div class="clear:both;"></div>
                                <div class="serach_rightlinefive"></div>
                                <div class="serach_rightboxthree">
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
                                <div class="serach_rightlinesix"></div>
				<div class="clear:both;"></div>
			</div>
		</Div>
		<Div class="clear5"></Div>
		<div class="zs"> </div>
	</div>
	<SCRIPT type="text/javascript">
		SwapPaiHangShopDiv('DivShopPaiHangFlag1','1');
		function filterdateshow(obj){
			$(obj).children("dl").removeClass("hidden").addClass("show");
		}
		function filterdatehidden(obj){
			$(obj).children("dl").removeClass("show").addClass("hidden");
		}
	</SCRIPT>
    <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F579bf00bc2e83979133ed98063c70f99' type='text/javascript'%3E%3C/script%3E"));
</script> 