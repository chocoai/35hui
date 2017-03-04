<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
?>
<link rel="stylesheet" type="text/css" href="/css/global.css" />
<link rel="stylesheet" type="text/css" href="/css/pu.css" />
<link rel="stylesheet" type="text/css" href="/css/brow.css" />
<style type="text/css">
    .serach_moreulone{margin-left:0;}
    .loupan_onelinerightbox .serach_moreulone{width:240px; margin-left:0;}
    .serach_nav .three img{display:block; position: relative !important; left: 65px !important;  top: -23px!important; *+left:35px!important;  position:relative;}
    .serach_nav .four img{display:block; position: relative;  left: 35px; top: -23px; left:75px\0;}
    @-moz-document url-prefix(){ .serach_nav .four img{display:block; position: relative;  left: 75px; top: -23px;}}
    @media screen and (-webkit-min-device-pixel-ratio:0){ .serach_nav .four img{display:block; position: relative;  left: 75px; top: -23px;} }
    
    .price{width:100px; border:1px solid #333; padding-left:7px; height:20px; line-height:20px; float:left;}
    .price {border: 1px solid #999; float: left; line-height: 20px; margin: 7px 3px; padding-left: 7px; width: 100px; background:url(/images/icon_120x83.gif) no-repeat scroll 42px -62px transparent;z-index: 1; overflow:hidden;}
    #priceTitle{width: 72px; display: block; height: 19px;}
    .pull-down {background: none repeat scroll 0 0 #FFFFFF;  border:1px solid #999;  font-family: Arial; position: absolute; width: 107px; z-index: 9999; }
    .pull-down dd { color: #0044CC; cursor: pointer; line-height: 22px; padding-left: 5px; width: 100px; }
	.submit_bg {position: relative;text-align: center;top:2px;top:13px\9;top:12px\0;*top:2px;_top:4px;width: 111px;	}
	@media screen and (-webkit-min-device-pixel-ratio:0) {
		.submit_bg {padding-top:12px;position:relative;	top:6px;}
	}
	.list-view .pager{padding-top:8px; padding-top:3px\9; clear:both; text-align:right; overflow:visible;}
	ul.yiiPager a:link, ul.yiiPager a:visited{_padding:1px 4px;}
	ul.yiiPager .selected{background:none;}
	.in_qjss {height:10px;}
	</style>
	<link href="/css/adjustsearch.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" type="text/css" href="/css/seardetail.css" />
	<?php
	$this->pageTitle = $seotkd->stkd_title;
	$this->breadcrumbs = array(
		'商业广场'=>array('systembuildinginfo/shopIndex'),
		'搜索'
	);
	?>
	<div id="center">
		<!--banner end-->
		<Div >
                <?php
                $this->widget('SearchMenuCondition',array(
                        'options'=>$options,
                    ));
                ?>
            		<div class="detail">
					<?php
                    $url = $this->getId()."/".$this->action->getId();
					$this->widget('SearchMenu',array(
						'showMenu'=>array(1,4,13,14,7),//显示的条件
						'url'=>$url,//url
                        "sourceType"=>2,
                        "inputSearchBoolean"=>false,//不要输入框搜索
					));
					?>
				</div>
			<div id="two_left">

				<?php
                $this->renderPartial('_shopcss');
				?>
                <div style="border-bottom:3px solid #bb3f01;height:34px;overflow:hidden">
				<ul class="serach_moremenu">
					<li class="one"><strong>全部商业广场</strong></li>
					<li class="<?=$ifShop?"three":"two"?>"><a href="<?=Yii::app()->createUrl("/map/map",array("tab"=>"shop"))?>" target="_blank"><strong>地图搜索</strong></a></li>
				</ul>
                <?php
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
						<li id="newSummaryText" style="width: 200px;" class="one">找到相关数据<strong><?=$dataProvider->getTotalItemCount();?></strong>条</li>
						<li style="width: 400px;" class="two">
							<div style="float: left;">按日期排序：</div>
							<div onmouseout="filterdatehidden(this)" onmouseover="filterdateshow(this)" class="price">
								<span id="priceTitle">
									<?php
									$allFilterDate = Searchcondition::model()->getAllFilterOpenDate();
									if(isset ($options['filterdate'])&&key_exists($options['filterdate'], $allFilterDate)) {
										echo $allFilterDate[$options['filterdate']];
									}else {
										echo "不限";
									}
									?>
								</span>
                                <dl style="left: 388px;" class="pull-down hidden" >
									<?php
									$filterdate_tmp = $options;
									foreach($allFilterDate as $key=>$value) {
										echo "<dd><a href='".Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "filterdate", $key))."'>".$value."</a></dd>";
									}
									?>
                                </dl>
                            </div>
							<?php
							if(isset ($options['order'])&&$options['order']=="ru") {
								$options_tmp = 'rd';
								$class = "up";
							}else if(isset ($options['order'])&&$options['order']=="rd") {
								$options_tmp = '';
								$class = "down";
							}else {
								$options_tmp = "ru";
								$class = "seabg";
							}
							?>
							<a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", $options_tmp))?>" class="<?=$class?>">租价</a>
							<?php
							$options_tmp = $options;
							if(isset ($options['order'])&&$options['order']=="su") {
								$options_tmp = 'sd';
								$class = "up";
							}else if(isset ($options['order'])&&$options['order']=="sd") {
								$options_tmp = '';
								$class = "down";
							}else {
								$options_tmp = "su";
								$class = "seabg";
							}
							?>
							<a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", $options_tmp))?>" class="<?=$class?>">售价</a>

						</li>
					</ul>
				</div>
				<style type="text/css">
					.ulthreetwo a:link{color:#0041D9;}.ulthreetwo a:hover{color: #FF6600}.ulthreetwo a:visited{color: #55188A;}
				</style>
                <?php
                foreach($allSource as $data){
                    $this->renderPartial('_shopmonthlist', array('data'=>$data,"ifShop"=>$ifShop));
                }
                echo "<div style='clear:both; height:35px; padding-top:15px;'>";
				$this->widget('CLinkPager',array(
                'pages'=>$dataProvider->pagination,
                "htmlOptions"=>array("style"=>"float:right"),
                ));
                echo "</div>";
                ?>
			</div><!--two_left end-->

			<div id="two_right" style="width:273px;">
				<?php
				if($ifShop) {
					$this->widget('RecentView',array("cssType"=>"shop"));
				}else {
					$this->widget('RecentView',array());
				}
				?>
			</div>
		</Div>
		<Div class="clear5"></Div>
		<div class="zs"> </div>
	</div> <!--center end-->
	<script type="text/javascript">
		function filterdateshow(obj){
			$(obj).children("dl").removeClass("hidden").addClass("show");
		}
		function filterdatehidden(obj){
			$(obj).children("dl").removeClass("show").addClass("hidden");
		}
	</script>