<?php
$this->pageTitle = $seotkd->stkd_title;
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
Yii::app()->clientScript->registerScriptFile("/js/autoplay/auto.js");
Yii::app()->clientScript->registerCssFile("/js/autoplay/auto.css");
    ?>
    <div class="inserch">
    <div class="intxt">
        <h2><img src="../images/jjrxfnew2.jpg" /></h2>
        <h3>这里有<em><?=$uagentNum?></em>位资深经纪人为您服务!</h3>
        <div class="seatrine">
            <div class="in_select iconlist">
                <div class="in_ul" style="display: none">
                    <a attr="2" href="#">我要租</a>
                    <a attr="5" href="#">我要买</a>
                    <a attr="7" href="#">求转让</a>
                </div>
                <h6 attr="2">我要买</h6>
            </div>
                <input class="txt_s5" id="kwords" name="kwords" type="text" value="" /><input type="button" class="btn_2" value="" onclick="inputSubmit()"/>
        </div>
 <div class="seacont">

            <div class="inline">
                <em>区域：</em>
                    <?php
                    $sections = Region::model()->getChildrenById(35);
                    foreach($sections as $key=>$child) {
                        if($key>10){break;}
                        echo "<a href='#' onclick='clickToSearch(\"district\",\"".$child["re_id"]."\")'>".$child['re_name']."</a>";
                    }
                    ?>
                <a href="#" onClick="clickToSearch()">>></a>
            </div>
            <div class="inline">
                <em>面积：</em>
                    <?php
                    $children = Searchcondition::model()->findConditionsByType(6);
                    foreach($children as $key=>$child) {
                        if($key>5){break;}
                        $name = $child['sc_title'];
                        if($key==0){
                            $tmp = explode("以下", $name);
                            $name = $tmp[0]."㎡以下";
                        }else{
                            $name = $name."㎡";
                        }
                        echo "<a href='#' onclick='clickToSearch(\"area\",\"".$child["sc_id"]."\")'>".$name."</a>";
                    }
                    ?>
                <a href="#" onClick="clickToSearch()">>></a>
            </div>
                <?php
                $this->renderPartial("_indexSearch");
                ?>
        </div>

    </div>
    <div class="inpic">

        <div id="autoplayer">
            <ul class="Limg">
                <?php
                foreach($scrollPicture as $value){
                    echo "<li>".CHtml::link(CHtml::image(PIC_URL.$value->sp_picture,"",array("width"=>"430px","height"=>"280px")),$value->sp_link,array("target"=>"_blank"))."</li>";
                }
                ?>
            </ul>
            <cite class="Nubbt">
                <?php
                foreach($scrollPicture as $key=>$value){
                    if($key==0){
                        echo '<span class="on">&nbsp;</span>';
                    }else{
                        echo '<span>&nbsp;</span>';
                    }
                }
                ?>
            </cite>
            <div class="bag">
                <?php
                foreach($scrollPicture as $key=>$value){
                    if($key==0){
                        echo '<span class="">'.$value->sp_title.'</span>';
                    }else{
                        echo '<span class="hidden">'.$value->sp_title.'</span>';
                    }
                }
                ?>
            </div>
        </div>

    </div>
</div>
<div class="newlf">
	<div class="nfy">
			<div class="nfymod">
				<div class="ntytit"><a target="_blank" href="<?=Yii::app()->createUrl("shop/rentindex")?>">查看更多&gt;</a>商铺出租</div>
				<div class="ntycot">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="ntab_01">
                         <? foreach($rentShop as $key=> $val){ ?>
                         <tr>
                             <td width="43%" style=""><a target="_blank" title="<?=$val->presentInfo->sp_shoptitle?>" href="<?=Yii::app()->createUrl("shop/view",array("id"=>$val->sb_shopid))?>"><?=common::strCut($val->presentInfo->sp_shoptitle,30);?></a></td>
                                <td width="18%" style=""><?=Region::model()->getNameById($val->sb_district)?></td>
                                <td width="15%" style=""><code><?=$val->sb_shoparea?>m²</code></td>
                                <td width="24%" style=""><em><?=round($val->rentInfo->sr_rentprice,1)?>元/m²·天</em></td>
                            </tr>
                        <?}?>
                    </table>
				</div>
			</div>
			<div class="nfymod">
				<div class="ntytit"><a target="_blank" href="<?=Yii::app()->createUrl("shop/sellindex")?>">查看更多&gt;</a>商铺出售</div>
				<div class="ntycot">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="ntab_01">
						 <? foreach($sellShop as $key=> $val){ ?>
                         <tr>
                             <td width="43%" style=""><a target="_blank" title="<?=$val->presentInfo->sp_shoptitle?>" href="<?=Yii::app()->createUrl("shop/view",array("id"=>$val->sb_shopid))?>"><?=common::strCut($val->presentInfo->sp_shoptitle,30);?></a></td>
                                <td width="18%" style=""><?=Region::model()->getNameById($val->sb_district)?></td>
                                <td width="15%" style=""><code><?=$val->sb_shoparea?>m²</code></td>
                                <td width="24%" style=""><em><?=$val->sellInfo->ss_sumprice?>万</em></td>
                            </tr>
                        <?}?>
                      </table>
				</div>
			</div>
		</div>
	<div class="xqfy">
			<h3><a href="<?=Yii::app()->createUrl("shop/transferindex")?>">查看更多&gt;</a>商铺转让</h3>
			<div class="xqfycot">
                <? foreach($transferShop as $key=> $val){ ?>
                        <div class="xq_mod">
                    <a target="_blank" title="<?=$val->presentInfo->sp_shoptitle?>" href="<?=Yii::app()->createUrl("shop/view",array("id"=>$val->sb_shopid))?>"><img src="<?=Picture::model()->getPicByTitleInt($val->presentInfo->sp_titlepicurl,"_large")?>" /></a>
                    <p><a  target="_blank" title="<?=$val->presentInfo->sp_shoptitle?>" href="<?=Yii::app()->createUrl("shop/view",array("id"=>$val->sb_shopid))?>"><?=common::strCut($val->presentInfo->sp_shoptitle,30);?></a></p>
                    <p><em><?=Region::model()->getNameById($val->sb_district)?>-<?=$val->sb_shoparea?>m²</em></p>
                    <p><code><?=@$val->rentInfo->sr_rentprice?>元/m²·天</code></p>
                 </div>
                  <?}?>
                 
                 
          	</div>
		</div>
    <div class="nfy">
			<div class="nfymod">
				<div class="ntytit"><a target="_blank" href="<?=Yii::app()->createUrl("bbs/forum.php")?>">更多&gt;</a>热门讨论</div>
				<div class="ntycot">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="ntab_01">
                        <?foreach($bbsAll as $key=>$val){?>
                            <tr>
                                <td width="43%" style="<?=$key==5?'border-bottom:0px':''?>"><a target="_blank"title="<?=$val->subject?>" href="<?=Yii::app()->createUrl("bbs/thread-".$val->tid."-1-1.html")?>"><?=common::strCut($val->subject, 72)?></a></td>
                            </tr>
                         <?}?>    
                     </table>
				</div>
			</div>
			<div class="nfymod">
				<div class="ntytit"><a target="_blank" href="<?=Yii::app()->createUrl("bbs/forum-37-1.html")?>">更多&gt;</a>地产资讯</div>
				<div class="ntycot">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="ntab_01">
						   <?foreach($bbs as $key=>$val){?>
                            <tr>
                                <td width="43%" style="<?=$key==5?'border-bottom:0px':''?>"><a target="_blank"title="<?=$val->subject?>" href="<?=Yii::app()->createUrl("bbs/thread-".$val->tid."-1-1.html")?>"><?=common::strCut($val->subject, 72)?></a></td>
                            </tr>
                         <?}?>  
                     </table>
				</div>
			</div>
		</div>
</div>
<div class="newrt">
	<?php
    $gg=Advertisement::model()->findAll("ad_position =1 or ad_position =2 or ad_position=3");
	foreach ($gg as $val){
    ?>
	<div class="ngg"><?=CHtml::link(CHtml::image(PIC_URL.$val->ad_picurl ,""),urldecode($val->ad_linkurl),array("target"=>"_blank","title"=>$val->ad_alt))?></div>
	<?php
    }
    ?>
    </div>
<div class="frmesg">即时发布最新的上海写字楼创意园商务中心出租出售价格信息每日提供数万条真实有效的办公选址房源信息</div>
<div class="friendly"><em>合作伙伴：</em>
        <?php
        if($friendLink){
            foreach($friendLink as $value){
                echo CHtml::link(common::strCut($value->fl_value, 18),$value->fl_url,array("target"=>"_blank","title"=>$value->fl_value));
            }
        }
        ?>
</div>
<script language=javascript type="text/javascript">
    var player1 = new player('autoplayer');
    $(document).ready(function(){
        $(".seatrine div").bind("mouseover", function(){
            $(this).find(".in_ul").css("display","block");
        }).bind("mouseout", function(){
            $(this).find(".in_ul").css("display","none");
        }).find("a").bind("click",function(){
            $(this).parent().next("h6").html($(this).text());
            $(this).parent().next("h6").attr("attr",$(this).attr("attr"));
            $(this).parent().css("display","none");
            var index = getType();
            $("#searchOneTab div").each(function(){
                $(this).css("display","none");
            }).eq(index-1).css("display","block");
        })
    });
    function getSelectValue()   {
        var va = $(".seatrine h6").eq(1).attr("attr");
        return va;
    }
    function clickToSearch(key, value){
        var baseUrl = "/site/indexsearch";
        baseUrl += "/type/"+getType();
        if(value!=undefined){
            baseUrl = baseUrl+"/search/"+key+value;
        }
        window.open(baseUrl);
    }
    function inputSubmit(){
        var kwords = $("#kwords").val();
        clickToSearch("keyword",encodeURI(kwords));
    }
    function getType(){
        var index = parseInt($(".seatrine h6").eq(0).attr("attr"));
        return index;
    }
    function showDiv(obj,id,num){
                    for(i=0;i<num;i++){
                        $("#mardiv"+id+i).css({"display":"inline"});
                    }
                    $(obj).find("div").css({"display":"none"});
                }
   function hideDiv(id,num){
                    for(i=0;i<num;i++){
                        $("#mardiv"+id+i).css({"display":"none"})
                    }
   }
</script>