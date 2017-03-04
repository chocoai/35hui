<!--right start-->
<div class="serach_moreboxtworight">
	<div class="linebgtop"></div>
	<div class="serach_moreboxonerightbox">
		<h2>周边商务中心</h2>
		<ul class="serach_moreulone" style="height:30px; line-height: 30px; ">
			<li class="morelione">名称</li>
			<li class="morelithree" style="width: 94px; text-align: center; font-weight: normal; float: left;">价格(元/间·月)</li>
		</ul>
		<?php
		if(count($aroundBusiness)>0) {
			foreach($aroundBusiness as $dist) {
                
				?>
		<ul class="serach_moreultwo" style="width: 229px; overflow: hidden;">
			<li class="morelione"><?php echo CHtml::link(common::strCut($dist->presentInfo->op_officetitle, 24),array('/officebaseinfo/businessSummarize','opid'=>$dist->ob_officeid),array("title"=>$dist->presentInfo->op_officetitle));?></li>
			<li class="morelithree"><?php echo $dist->rentInfo['or_rentprice']?$dist->rentInfo['or_rentprice']:'暂无';?></li>
		</ul>
				<?php
			}
		}else {
			?>
		<center>暂无相关数据！</center>
			<?php
		}
		?>
	</div>
	<div class="linebgbottom"></div>
        <!--投放GOOGLE广告联盟的广告-->
        <div class="linebgtop"></div>
        <div class="serach_moreboxonerightbox">
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
        <div class="linebgbottom"></div>
</div>
<!--right end-->