<?php
$this->pageTitle = $seotkd->stkd_title;
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
Yii::app()->clientScript->registerScriptFile("/js/autoplay/auto.js");
Yii::app()->clientScript->registerCssFile("/js/autoplay/auto.css");
    ?>
<div class="inserch">
    <div class="intxt">
        <h2><img src="/images/jjrxfnew1.jpg" /></h2>
        <h3>这里有<em><?=$uagentNum?></em>位资深经纪人为您服务!</h3>
        <div class="seatrine">
            <div class="in_select iconlist">
                <div class="in_ul" style="display: none">
                    <a attr="0" href="#">我要租</a>
                    <a attr="3" href="#">我要买</a>
                </div>
                <h6 attr="0">我要租</h6>
            </div>
            <div class="in_select iconlist">
                <div class="in_ul" style="display: none">
                    <a attr="1">写字楼</a>
                    <a href="<?=Yii::app()->createUrl("/businesscenter/index")?>">商务中心</a>
                    <a href="<?=Yii::app()->createUrl("/creativesource/index")?>">创意园区</a>
                </div>
                <h6 attr="1">写字楼</h6>
            </div>
                <?php
                $this->widget('CAutoComplete',
                        array(
                        "id"=>"kwords",
                        'name'=>'kwords',
                        'url'=>array('site/ajaxautocomplete'),
                        'max'=>10,//显示最大数
                        'minChars'=>1,//最小输入多少开始匹配
                        'delay'=>500, //两次按键间隔小于此值，则启动等待
                        'scrollHeight'=>200,
                        "extraParams"=>array("type"=>"js:getSelectValue"),//表示是楼盘、商业广场还是小区
                        'htmlOptions'=>array("class"=>"txt_5"),
                ));
                ?>
            <input type="button" class="btn_2" value="" onclick="inputSubmit()"/>
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
				<div class="ntytit"><a target="_blank" href="<?=Yii::app()->createUrl("officebaseinfo/rentIndex")?>">查看更多&gt;</a>写字楼出租</div>
				<div class="ntycot">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="ntab_01">
                        <? foreach($officeRent as $key=> $val){
                             $systembuildiginfo=Systembuildinginfo::model()->findByPk($val->ob_sysid);
                            if($systembuildiginfo){
                            ?>
                            <tr>
                                <td width="43%" style="<?=$key==count($officeRent)-1?"border-bottom:0px ;":""?>"><a target="_blank" href="<?=Yii::app()->createUrl("officebaseinfo/view",array("id"=>$val->ob_officeid))?>"><?=$systembuildiginfo->sbi_buildingname?common::strCut(CHtml::encode($systembuildiginfo->sbi_buildingname),24, '...'):""?></a></td>
                                <td width="18%" style="<?=$key==count($officeRent)-1?"border-bottom:0px ;":""?>"><?=Region::model()->getNameById($systembuildiginfo->sbi_district)?></td>
                                <td width="15%" style="<?=$key==count($officeRent)-1?"border-bottom:0px ;":""?>"><code><?=$val->ob_officearea?$val->ob_officearea."m²":"" ?></code></td>
                                <td width="24%" style="<?=$key==count($officeRent)-1?"border-bottom:0px ;":""?>"><em><?=$val->ob_rentprice?$val->ob_rentprice."元/m²·天":""?></em></td>
                            </tr>
                        <?}}?>
					</table>
				</div>
			</div>
			<div class="nfymod">
				<div class="ntytit"><a target="_blank" href="<?=Yii::app()->createUrl("officebaseinfo/saleIndex")?>">查看更多&gt;</a>写字楼出售</div>
				<div class="ntycot">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="ntab_01">
						 <? foreach($officeSale as $key=> $val){
                                $systembuildiginfo=Systembuildinginfo::model()->findByPk($val->ob_sysid);
                                if($systembuildiginfo){?>
                                <tr>
                                    <td width="43%" style="<?=$key==count($officeRent)-1?"border-bottom:0px ;":""?>"><a target="_blank" href="<?=Yii::app()->createUrl("officebaseinfo/view",array("id"=>$val->ob_officeid))?>"><?=$systembuildiginfo->sbi_buildingname?common::strCut(CHtml::encode($systembuildiginfo->sbi_buildingname),24, '...'):""?></a></td>
                                    <td width="18%" style="<?=$key==count($officeRent)-1?"border-bottom:0px ;":""?>"><?=Region::model()->getNameById($systembuildiginfo->sbi_district)?></td>
                                    <td width="15%" style="<?=$key==count($officeRent)-1?"border-bottom:0px ;":""?>"><code><?=$val->ob_officearea?$val->ob_officearea."m²":"" ?></code></td>
                                    <td width="24%" style="<?=$key==count($officeRent)-1?"border-bottom:0px ;":""?>" ><em><?=$val->ob_sumprice?$val->ob_sumprice."万":""?></em></td>
                                </tr>
                        <?}}?>
					</table>
				</div>
			</div>
		</div>
		<div class="xqfy">
			<h3>您可能感兴趣的房源</h3>
			<div class="xqfycot">
                  <?foreach($interestOffice as $val){
                      $systembuildiginfo=Systembuildinginfo::model()->findByPk($val->ob_sysid);
                      if($systembuildiginfo){?>
                            <div class="xq_mod">
                                <a target="_blank" title="<?=$systembuildiginfo->sbi_buildingname?$systembuildiginfo->sbi_buildingname:""?>" href="<?=Yii::app()->createUrl("officebaseinfo/view",array("id"=>$val->ob_officeid))?>"><img src="<?=Picture::model()->getPicByTitleInt($val->ob_titlepicurl,"_large");?>" /></a>
                                <p><a  target="_blank" title="<?=$systembuildiginfo->sbi_buildingname?$systembuildiginfo->sbi_buildingname:""?>" href="<?=Yii::app()->createUrl("officebaseinfo/view",array("id"=>$val->ob_officeid))?>"><?=$systembuildiginfo->sbi_buildingname?common::strCut(CHtml::encode($systembuildiginfo->sbi_buildingname?$systembuildiginfo->sbi_buildingname:""),24, '...'):""?></a></p>
                                <p><em><?=Region::model()->getNameById($systembuildiginfo->sbi_district)?>-<?=$val->ob_officearea?$val->ob_officearea."m²":"" ?></em></p>
                                <p><code><?=$val->ob_rentprice?$val->ob_rentprice."元/m²·天":""?></code></p>
                            </div>
                 <?   }
                 }?>
			</div>
		</div>
    <?if($systembuild){?>
		<div class="hotxzl">
			<div class="hottit">
				<div class="hotlf">热门写字楼：
                    <?php
                    $sections = Region::model()->getChildrenById(35);
                    foreach($sections as $key=>$child) {
                        if($key>11){break;}
                        echo   CHtml::link($child['re_name'],array("officebaseinfo/rentIndex","search"=>"district".$child["re_id"]),array("target"=>"_blank"));
                    }
                    ?>
                   </div>
				<div class="hotrt"><a  target="_blank" title="更多写字楼楼盘" href="<?=Yii::app()->createUrl("/officebaseinfo/rentIndex")?>"></a></div>
			</div>
			<div class="xzlcot">
				<div class="xzllf">
                    <?if($systembuild->hl_piclist){?>
                            <iframe width="500px;" height="310px" frameborder="0" scrolling="no" src="<?php echo $this->createUrl('site/piclist') ?>"></iframe>
                    <?}?>
				</div>
				<div class="xzlrt" style="width:212px">
                    <?if($systembuild->hl_titlelist){?>
                        <?$buildtitleid=explode("，",$systembuild->hl_titlelist);
                                foreach($buildtitleid as $val){
                                    if(!is_numeric($val))break;
                                    $build=Systembuildinginfo::model()->findByPk($val);    ?>
                                    <a target="_blank" title="<?=$build->sbi_buildingname?>" href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$build->sbi_buildingid))?>"><?=common::strCut($build->sbi_buildingname,18,"")?></a>
                    <?          }
                    }?>
                   </div>
			</div>
		</div>
    <?}if($business){?>
		<div class="hotsw" style="height:220px">
			<div class="hottit">
				<div class="hotlf">商务中心：
                    <?php
                    $sections = Region::model()->getChildrenById(35);
                    foreach($sections as $key=>$child) {
                        if($key>11){break;}
                        echo   CHtml::link($child['re_name'],array("businesscenter/list","search"=>"district".$child["re_id"]),array("target"=>"_blank"));
                    }
                    ?>
                   </div>
				<div class="hotrt1"><a target="_blank" title="更多商务中心" href="<?=Yii::app()->createUrl("/businesscenter/list")?>"></a></div>
			</div>
			<div class="xzlcot">
				<div class="xzllf" style="position:relative;padding:0px;width: 528px;height:190px">
                <?php
                if($business->hl_piclist){
                        $businesspicid=explode("，",$business->hl_piclist);
                        shuffle($businesspicid);
                        foreach($businesspicid as $key=>$val){
                             if(!is_numeric($val)||$key>7)break;
                             $leftnum=$key>3?$key-4:$key;
                             $topnum=$key>3?1:0;
                             $left=132*$leftnum;
                             $top=95*$topnum;
                             $div='<div style="display:none;left: '.$left.'px; top: '.$top.'px; width: 132px; height: 95px; position: absolute;background:url(/js/piclist/bg_trans.png) ;cursor: pointer; " id="mardiv1'.$key.'" ></div>';
                             $businesscenter=Businesscenter::model()->findByPk($val);
                             echo CHtml::link(CHtml::image(Picture::model()->getOnePicExceptTitleInt($businesscenter->bc_id,3,$businesscenter->bc_titlepic,"_large"),$businesscenter->bc_name,array("width"=>"132px","height"=>"95px")).$div,Yii::app()->createUrl("businesscenter/view",array("id"=>$businesscenter->bc_id)),array("target"=>"_blank","title"=>$businesscenter->bc_name,"onmouseover"=>"showDiv(this,1,8)","onmouseout"=>"hideDiv(1,8)"));
                        }
                }
                ?>
                </div>
				<div class="xzlrt1" style="height:170px;width: 212px;">
                    <?
                    if($business->hl_titlelist){
                        $businesstitleid=explode("，",$business->hl_titlelist);
                                foreach($businesstitleid as $key=>$val){
                                    if(!is_numeric($val))break;
                                    $businesscenter=Businesscenter::model()->findByPk($val);    ?>
                                    <a target="_blank" style="overflow:hidden" title="<?=$businesscenter->bc_name?>" href="<?=Yii::app()->createUrl("businesscenter/view",array("id"=>$businesscenter->bc_id))?>"><?=$businesscenter->bc_name?></a>
                    <?          }
                    }?>
                </div>
			</div>
		</div>
    <?}if($creativepark){?>
		<div class="hotcy" style="height: 220px;">
			<div class="hottit">
				<div class="hotlf">创意园区：
                    <?php
                    $sections = Region::model()->getChildrenById(35);
                    foreach($sections as $key=>$child) {
                        if($key>11){break;}
                        echo   CHtml::link($child['re_name'],array("creativeparkbaseinfo/creativelist","search"=>"district".$child["re_id"]),array("target"=>"_blank"));
                    }
                    ?>
                   </div>
				<div class="hotrt2"><a target="_blank" title="更多创意园" href="<?=Yii::app()->createUrl("/creativeparkbaseinfo/creativelist")?>"></a></div>
			</div>
			<div class="xzlcot">
				<div class="xzllf" style="position:relative;padding:0px;width:528px;height: 190px;">
                <?php
                if($creativepark->hl_piclist){
                        $creativeparkpicid=explode("，",$creativepark->hl_piclist);
                        shuffle($creativeparkpicid);
                       foreach($creativeparkpicid as $key=>$val){
                             if(!is_numeric($val)||$key>7)break;
                             $leftnum=$key>3?$key-4:$key;
                             $topnum=$key>3?1:0;
                             $left=132*$leftnum;
                             $top=95*$topnum;
                            $creativeparkbaseinfo=Creativeparkbaseinfo::model()->findByPk($val);
                             $div='<div style="display:none;left: '.$left.'px; top:'.$top.'px; width: 132px; height: 95px; position: absolute;cursor: pointer; background:url(/js/piclist/bg_trans.png) ;" id="mardiv2'.$key.'" ></div>';
                             echo CHtml::link(CHtml::image(Picture::model()->getPicByTitleInt($creativeparkbaseinfo->cp_titlepic,"_large"),$creativeparkbaseinfo->cp_name,array("width"=>"132px","height"=>"95px")).$div,Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$creativeparkbaseinfo->cp_id)),array("target"=>"_blank","title"=>$creativeparkbaseinfo->cp_name,"onmouseover"=>"showDiv(this,2,8)","onmouseout"=>"hideDiv(2,8)"));
                          }
                }
                ?>
                </div>
				<div class="xzlrt2" style="height: 170px;width: 212px;">
                <?
                if($creativepark->hl_titlelist){
                            $creativeparktitleid=explode("，",$creativepark->hl_titlelist);
                            foreach($creativeparktitleid as $val){
                                if(!is_numeric($val))break;
                                $creativeparkbaseinfo=Creativeparkbaseinfo::model()->findByPk($val);    ?>
                                <a target="_blank" style="overflow:hidden" title="<?=$creativeparkbaseinfo->cp_name?>"href="<?=Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$creativeparkbaseinfo->cp_id))?>"><?=common::strCut($creativeparkbaseinfo->cp_name,18,"..")?></a>
                <?          }
                }?>
                </div>
			</div>
		</div>
    <?}?>
	</div>
	<div class="newrt">
		<div class="ngg"><a title="业主委托"  target="_blank" href="<?=Yii::app()->createUrl("quickrelease")?>"><img src="/images/wt.jpg" /></a></div>
		<div class="rnews">
			<h3><a  target="_blank" href="<?=Yii::app()->createUrl("bbs/forum-37-1.html")?>">更多</a>地产资讯</h3>
            <?foreach($bbs as $key=>$val){?>
                    <p><a target="_blank" title="<?=$val->subject?>" href="<?=Yii::app()->createUrl("bbs/thread-".$val->tid."-1-1.html")?>"><?=common::strCut($val->subject, 36)?></a></p>
            <?}?>
		</div>
		<div class="rnews">
            <h3><a target="_blank" href="<?=Yii::app()->createUrl("bbs/forum.php")?>">更多</a>论坛热帖</h3>
            <?foreach($bbsAll as $key=>$val){?>
                    <p><a target="_blank"title="<?=$val->subject?>" href="<?=Yii::app()->createUrl("bbs/thread-".$val->tid."-1-1.html")?>"><?=common::strCut($val->subject, 36)?></a></p>
            <?}?>
		</div>
        <div class="rnews">
            <h3><a target="_blank" href="<?=Yii::app()->createUrl("bbs/forum-41-1.html")?>">更多</a>家具装修</h3>
            <?foreach($bbsZX as $key=>$val){?>
                    <p><a target="_blank"title="<?=$val->subject?>" href="<?=Yii::app()->createUrl("bbs/thread-".$val->tid."-1-1.html")?>"><?=common::strCut($val->subject, 36)?></a></p>
            <?}?>
		</div>
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
        var index = parseInt($(".seatrine h6").eq(0).attr("attr"))+parseInt($(".seatrine h6").eq(1).attr("attr"));
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