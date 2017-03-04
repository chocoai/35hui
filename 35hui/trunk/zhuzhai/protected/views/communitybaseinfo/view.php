<?php
$c_city = Region::model()->getNameById($model->comy_city);
$c_district = Region::model()->getNameById($model->comy_district);
$c_section = Region::model()->getNameById($model->comy_section);
$c_name = $model->comy_name;
$c_price=$model->comy_avgsellprice?$model->comy_avgsellprice.'元/平米':'暂无';
$keywords = $c_city.$c_name.','.$c_name.'二手房,'.$c_name.'租房,360°全景看房';
$description='找'.$c_name.'二手房,'.$c_name.'租房,买'.$c_name.'就到新地标，新地标提供'.$c_district.$c_section.'/'.$c_city.'房价查询,';
$description.=$c_name.'均价:'.$c_price.'，新地标独家免费提供360°全景看房。';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $keywords.' - 新地标';
$this->breadcrumbs = array(
    "小区搜索"=>array("searchIndex"),
    CHtml::encode($c_name),
);
?>
<link href="/css/zhai.css" type="text/css" rel="stylesheet" />
<link href="/css/global.css" type="text/css" rel="stylesheet" />
<style type="text/css">
    .fydj{margin-top:10px;}
    .dj_images{margin-top:10px;}
    ul,li{margin:0; padding:0;}
    .yinxiang li{float:left; display:block; height:22px; _overflow:hidden; margin:1px; white-space: nowrap;}
    .yinxiang li a{display:block; padding:3px 7px; float:left; text-align:center; text-decoration:none;}
    .yinxiang li a:link,.yinxiang li a:visited{color:#fff;}
    .yinxiang li a:hover{background:#fff; color:#F60; cursor:pointer}
    .grade_notice_content dt{color:#666; display:inline; float:right; line-height:25px; margin-right:25px;}
</style>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/scrollable-horizontal.css" />
<div class="xiezilou_left">
    <h1><?=@CHtml::encode($c_name)?></h1>
    <ul class="serach_moremenu">
        <li class="one"id="louright1"><strong><?=CHtml::link("小区概况",array("communitybaseinfo/view","id"=>$model->comy_id))?></strong></li>
        <li class="two" id="louright2"><strong><a href="<?=Yii::app()->createUrl("communitybaseinfo/sellIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($c_name)))?>">二手房(<?=$model->getNums($model->comy_id,2)?>套)</a></strong></li>
        <li class="two" id="louright3"><strong><a href="<?=Yii::app()->createUrl("communitybaseinfo/rentIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($c_name)))?>">租房(<?=$model->getNums($model->comy_id,1)?>套)</a></strong></li>
        <li class="two" id="louright4"><strong><?=CHtml::link("小区图片",array("communitybaseinfo/picture","id"=>$model->comy_id))?></strong></li>
        <li class="three" id="louright5">
            <strong>
                <?=CHtml::link("小区点评",array("communitybaseinfo/comment","id"=>$model->comy_id))?>
            </strong>
        </li>
    </ul>
    <?php if(Panoxml::model()->checkHavePano($model->comy_id, 2)) { ?>
    <div class="loupaninfo_threelineboxtwo" style="width:710px; margin-bottom: 20px;">
        <div class="loupaninfo_threelineboxtwo" style="border: medium none; margin-top: 0pt; width: 710px;">
            <div style="margin-left: 10px;" id="brightChild1">
                <ul id="panoramaPlayer" style="height: 400px;" class="pictureGrid">
                    <?php
                    $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($model->comy_id, 2),));
                    ?>
                </ul>
            </div>
        </div>
    </div>
        <?php } ?>
    <div class="serach_morelefttwobox">
        <?php if($model->comy_introduce){?>
        <h3><strong>小区概述</strong></h3>
        <div class="serach_moreleftthreebox">
            <span>
                <?php echo Keywordlink::model()->regContentByAllKeyword($model->comy_introduce); ?>
            </span>
        </div>
        <?php }?>
        <h3><strong>基本信息</strong></h3>
        <table border="0" width="100%" class="table">
            <tr><th width="15%">地址：</th>
                <td width="35%"><?=$model->comy_address;?></td>
                <th width="15%">总建筑面积：</th>
                <td width="35%"><?=$model->comy_buildingarea?$model->comy_buildingarea."平方米":"暂无资料";?></td>
            </tr>
            <tr><th width="15%">区域板块：</th>
                <td width="35%">
                    <?=$c_district;?>&nbsp;
                    <?=$c_section;?>
                </td>
                <th width="15%">容积率：</th>
                <td width="35%"><?=$model->comy_cubagerate?$model->comy_cubagerate:"暂无资料";?></td>
            </tr>
            <tr><th width="15%">物业类型：</th>
                <td width="35%"><?=$model->getPropertytypeName($model->comy_propertytype);?></td>
                <th width="15%">停车位：</th>
                <td width="35%"><?=$model->comy_parking?$model->comy_parking."个":"暂无资料";?></td>
            </tr>
            <tr><th width="15%">物业管理费：</th>
                <td width="35%"><?=$model->comy_propertyprice?$model->comy_propertyprice."元/平方米/月":"暂无资料";?></td>
                <th width="15%">竣工日期：</th>
                <td width="35%"><?php
//                $model->comy_buildingera?$model->comy_buildingera."年":"暂无资料";
                if($model->comy_buildingera){
                        if($model->comy_buildingera>3000){
                            echo date("Y年",$model->comy_buildingera);
                        }else{
                            echo $model->comy_buildingera."年";
                        }
                    }else{
                        echo "暂无资料";
                    }
?></td>
            </tr>
            <tr><th width="15%">开发商：</th>
                <td width="35%"><?=$model->comy_developer?$model->comy_developer:"暂无资料";?></td>
                <th width="15%">绿化率：</th>
                <td width="35%"><?=$model->comy_afforestation?$model->comy_afforestation."%":"暂无资料";?></td>
            </tr>
        </table>
        <h3><strong>小区地图</strong></h3>
        <div class="serach_moreleftfourbox">
            <?php
            $comy_name = $model->comy_x ? $c_name:'人民广场';
            $comy_x = $model->comy_x ? $model->comy_x:'121.47536873817444';
            $comy_y = $model->comy_y ? $model->comy_y:'31.232857675162947';
            $this->widget('ShowSmallMap',array(
                    'x'=>$comy_x,
                    'y'=>$comy_y,
                    'name'=>$comy_name,
                    'width'=>"672px",
                    'height'=>"233px",
                    //'type'=>"all",
            ));
?>
        </div>
        <h3><strong>周边配套</strong></h3>
        <ul class="peitao">
            <li>
                <div class="peitaol">学校：</div>
                <div class="peitaoir"><?=$model->comy_school ? $model->comy_school : "暂无资料";?></div>
            </li>
            <li><div class="peitaol">交通：</div>
                <div class="peitaoir">
                    <?php
                    if($model->comy_traffic) {
                        $trafficArray = split(",",$model->comy_traffic);
                        $arraySize = count($trafficArray);
                        for($i = 0; $i < $arraySize; $i++) {
                            $Info = Subway::model()->getInfoById($trafficArray[$i]);
                            if($Info != "") {
                                $stationName = @$Info->sw_stationname;
            ?>
                    <a alt="<?php echo $stationName;?>" title="<?php echo $stationName;?>" target="_blank" style="cursor: pointer;" href="<?=Yii::app()->createUrl("/map/map/coordinate/".$trafficArray[$i])?>"><?php echo $stationName."(".Subway::model()->getInfoById($Info->sw_parentid)->sw_stationname.")";?></a>
            <?php
                                if($i > 0 && $i != $arraySize-2){echo "、";}
                            }

                        }

                    } else {
                        echo "暂无资料";
                    }
            ?>
                </div>
            </li>
            <li><div class="peitaol">购物：</div>
                <div class="peitaoir"><?=$model->comy_shopping ? $model->comy_shopping : "暂无资料";?></div>
            </li>
            <li><div class="peitaol">银行：</div>
                <div class="peitaoir"><?=$model->comy_bank ? $model->comy_bank : "暂无资料";?></div>
            </li>
            <li><div class="peitaol">医院：</div>
                <div class="peitaoir"><?=$model->comy_hospital ? $model->comy_hospital : "暂无资料";?></div>
            </li>
            <li><div class="peitaol">餐饮：</div>
                <div class="peitaoir"><?=$model->comy_dining ? $model->comy_dining : "暂无资料";?></div>
            </li>
            <li><div class="peitaol">菜场：</div>
                <div class="peitaoir"><?=$model->comy_vegetables ? $model->comy_vegetables : "暂无资料";?></div>
            </li>
            <li><div class="peitaol">其它：</div>
                <div class="peitaoir"><?=$model->comy_other ? $model->comy_other : "暂无资料";?></div>
            </li>
        </ul>
    </div>
</div>
<div id="tworight">
    <ul class="soucang">
        <?php
        if($model->comy_loushu){
            $temp = Attachment::model()->findbyPk($model->comy_loushu)->money;
            echo '<li>',CHtml::link('楼书下载',array('manage/download','id'=>$model->comy_loushu,'type'=>2,'atttype'=>1),array('confirm'=>"下载该附件会扣除".$temp."个新币\n重复下载不再扣除",'id'=>'cf_loushu')),'</li>';
        }else{
            echo '<li>',CHtml::link('楼书上传',array('manage/upattachment','id'=>$model->comy_id,'type'=>2,'atttype'=>1)),'</li>';
        } 
        if($model->comy_hetong){
            $temp = Attachment::model()->findbyPk($model->comy_hetong)->money;
            echo '<li>',CHtml::link('租赁合同下载',array('manage/download','id'=>$model->comy_hetong,'type'=>2,'atttype'=>2),array('confirm'=>"下载该附件会扣除".$temp."个新币\n重复下载不再扣除",'id'=>'cf_hetong')),'</li>';
        }else{
            echo '<li>',CHtml::link('租赁合同上传',array('manage/upattachment','id'=>$model->comy_id,'type'=>2,'atttype'=>2)),'</li>';
        }
        ?>
        <li class="right"><a href="javascript:addFavorite('<?php echo DOMAIN.Yii::app()->createUrl("communitybaseinfo/view",array("id"=>$model->comy_id));?>','<?=$c_name;?>');">收藏夹</a></li>
        <li><a href="javascript:window.print();">打印</a></li>
        <li class="right"><?php if(User::model()->getCurrentRole()==User::personal) ?>
            <a href="javascript:;" onclick="addFavorite('<?php echo DOMAIN.Yii::app()->createUrl("communitybaseinfo/view",array("id"=>$model->comy_id));?>','<?=$c_name;?>')">收藏房源</a>
        </li>
    </ul>
    <div class="w273">
        <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border">
            <h3>小区好评度</h3>
            <div><table border="0" width="100%" class="hptable">
                    <?php
                    $cScore = $model->comy_score;
                    if( $cScore == 0) {
                        $starsNum = 0;
                    }else {
                        $starsNum = $model->comy_score?round($model->comy_score*10/$model->comy_ratingnum)/10 : "0";
                    }
?>
                    <tr>
                        <td width="120"><?=common::getStar($starsNum);?></td>
                        <td width="60"><?=$model->comy_score;?>分</td>
                        <td width="80">(<?=$model->comy_ratingnum;?>人参与)</td>
                    </tr>
                    <tr><td colspan="3" style="text-indent:21px;"><a href="javascript:confirmSubmit(2);">我也要打分</a></td></tr>
                </table></div>
            <form  id="from_grade" name="from_grade" action="<?php Yii::app()->createUrl('/communitybaseinfo/view/'.$model->comy_id);?>" method="POST">
                <div id="grade_notice_content" class="grade_notice hidden">
                    <div class="grade_notice_content">
                        <h4>我给小区打分</h4>
                        <ul>
                            <li></li>
                        </ul>
                        <dl>
                            <div style="width:100%">
                                <dt>非常棒</dt>
                                <dd><input type="radio" value="10" id="score_10" name="score[]"/></dd>
                                <dd style="width: 80px"><label for="score_10"><div class="level5"><div style="width: 80px;" class="grade_current">&nbsp;</div></div></label></dd>
                            </div>
                            <div style="width:100%">
                                <dt>还不错</dt>
                                <dd><input type="radio" value="8" id="score_8" name="score[]"/></dd>
                                <dd style="width: 80px"><label for="score_8"><div class="level4"><div style="width: 65px;" class="grade_current">&nbsp;</div></div></label></dd>
                            </div>
                            <div style="width:100%">
                                <dt>一般般</dt>
                                <dd><input type="radio" value="6" id="score_6" name="score[]"/></dd>
                                <dd style="width: 80px"><label for="score_6"><div class="level3"><div style="width: 47px;" class="grade_current">&nbsp;</div></div></label></dd>
                            </div>
                            <div style="width:100%">
                                <dt>有点糟</dt>
                                <dd><input type="radio" value="4" id="score_4" name="score[]"/></dd>
                                <dd style="width: 80px"><label for="score_4"><div class="level2"><div style="width: 32px;" class="grade_current">&nbsp;</div></div></label></dd>
                            </div>
                            <div style="width:100%">
                                <dt>非常差</dt>
                                <dd><input type="radio" value="2" id="score_2" name="score[]"/></dd>
                                <dd style="width: 80px"><label for="score_2"><div class="level1"><div style="width: 16px;" class="grade_current">&nbsp;</div></div></label></dd>
                            </div>
                            <dt style="clear: both; float: none; height: 0px; line-height: 0pt; font-size: 0pt;">&nbsp;</dt>
                        </dl>
                        <div class="grade_submit">
                            <a href="javascript:confirmSubmit(1);" id="grade_sub" name="grade_sub" class="submit_button"><span class="grade_subspan">确认提交</span></a>
                            <a id="grade_close" href="javascript:confirmSubmit(0);"><span class="close">以后再说</span></a>
                        </div>
                    </div>
                </div>
            </form>
            <h4>请点击选择您对该小区的印象</h4>
            <ul class="yinxiang">
                <?php
                $style = array();
                $style[0] = "background-color:#E50E9D; border:1px solid #E50E9D;";
                $style[1] = "background-color:#03BDC8; border:1px solid #03BDC8;";
                $style[2] = "background:#009934; border:1px solid #009934;";
                $style[3] = "background:#7F7EE6; border:1px solid #7F7EE6;";
                $style[4] = "background:#7CD225; border:1px solid #7CD225;";
                $style[5] = "background:#405CCD; border:1px solid #405CCD;";
                $style[6] = "background:#991F1F; border:1px solid #991F1F;";
                $style[7] = "background:#99701F; border:1px solid #99701F;";
                if($impressions) {
                    foreach($impressions as $i=>$impression) {
                        $show_style =  $style[$i%8];
                        echo "<li style='".$show_style."'><a href='#_self' onclick='addPro(".$impression->im_id.")' title='".CHtml::encode($impression->im_description)."'>".CHtml::encode($impression->im_description)."</a></li>";
                    }
                }else {
                    echo '<li><font color="gray"><i>暂无印象</i></font></li>';
                }
?>
            </ul>
<?php echo $this->renderPartial('_impressionform', array('model'=>$newImpression));?>
        </div>
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
    <div class="w273">
        <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border" style="padding-bottom:20px;">
            <div> <h5>最新二手房</h5>
                <div class="gdmore"><?=CHtml::link("更多>>",Yii::app()->createUrl("communitybaseinfo/sellIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($c_name))))?></div></div>
            <?php
            if(!empty($communityinfo_sell)) {
                foreach($communityinfo_sell as $key=>$value) {
        ?>
            <div class="twohhouse">
                <div class="twohleft">
                    <a href="<?=Yii::app()->createUrl('/communitybaseinfo/viewResidence/',array("id"=>$value->rbi_id));?>" target="_blank">
                         <img alt="" src="<?=Picture::model()->getPicByTitleInt($value->rbi_titlepicurl,"_normal");?>" style="width: 100px;height:75px;">
                    </a>
                </div>
                <div class="twohright">
                    <p><?=CHtml::link(common::strCut(CHtml::encode($value->rbi_title), 24),array("/communitybaseinfo/viewResidence/","id"=>$value->rbi_id),array('target'=>"_blank",'class'=>"lpname"));?></p>
                    <p><?php echo common::strCut(CHtml::encode($model->comy_address),24);?></p>
                    <p><?php echo $value->rbi_area?$value->rbi_area.'平米':'暂无资料';?></p>
                    <p class="jiage"><?php echo $value->sellInfo->rs_price?$value->sellInfo->rs_price.'万':'暂无资料';?></p>
                </div>
            </div>
        <?php }
}
?>
        </div>
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
    <div class="w273">
        <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border" style="padding-bottom:20px;">
            <div> <h5>最新租房</h5>
                <div class="gdmore"><?=CHtml::link("更多>>",Yii::app()->createUrl("communitybaseinfo/rentIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($c_name))))?></div></div>
            <?php
            if(!empty($communityinfo_rent)) {
    foreach($communityinfo_rent as $key=>$value) {
        ?>
            <div class="twohhouse">
                <div class="twohleft"><a href="<?=Yii::app()->createUrl('/communitybaseinfo/viewResidence/',array("id"=>$value->rbi_id));?>" target="_blank">
                <img alt="" src="<?=Picture::model()->getPicByTitleInt($value->rbi_titlepicurl,"_normal");?>" style="width: 100px;height:75px;">
                    </a></div>
                <div class="twohright">
                    <p><?=CHtml::link(common::strCut(CHtml::encode($value->rbi_title), 24),array("/communitybaseinfo/viewResidence/","id"=>$value->rbi_id),array('target'=>"_blank",'class'=>"lpname"));?></p>
                    <p><?php echo common::strCut(CHtml::encode($model->comy_address),24);?></p>
                    <p><?php echo $value->rbi_area?$value->rbi_area.'平米':'暂无资料';?></p>
                    <p class="jiage"><?php echo $value->rentInfo->rr_rentprice?$value->rentInfo->rr_rentprice.'元/月':'暂无资料';?></p>
                </div>
            </div>
        <?php }
}
?>
        </div>
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
    <div class="w273">
        <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border" style="padding-bottom:20px;">
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
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
</div>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v1.jiathis.com/code/jiathis_r.js?move=0&amp;btn=r5.gif" charset="utf-8"></script>
<!-- JiaThis Button END -->
<script type="text/javascript" language="javascript">
    $("#panorama_navi > div").eq(0).show();
    $(".items img").click(function() {
        if ($(this).hasClass("active")) { return; }
        $(".items img").removeClass("active");
        $(this).addClass("active");
        var panoId = $(this).attr("va");
        clickChangePano(panoId);
    }).first().addClass("active");

    $("#panorama_type > li").click(function(){
        $("#panorama_type > li").attr('class','three');
        $(this).attr("class",'two');
        var index = $(this).index();
        $("#panorama_navi > div").hide();
        $("#panorama_navi > div").eq(index).show();
        $("#panorama_navi > div").eq(index).find('.item_vessel > img').first().click();
    }).first().attr("class",'two').css("margin-left", "0px");

      function addFavorite(sURL, sTitle){
        try{
            window.external.addFavorite(sURL, sTitle);
        } catch (e){
            try{
                window.sidebar.addPanel(sTitle, sURL, "");
            }catch (e){
                alert("加入收藏失败，有劳您手动添加。");
            }
        }
    }
    function addPro(id){
        $.ajax({
            type:"get",
            url:"<?=Yii::app()->createUrl('/impression/ajaxAddPro',array('sourceId'=>$model->comy_id,'sourceType'=>Impression::communitybaseinfo))?>",
            data: {id:id},
            success: function(state){
                if(state==1){
                    alert("评价成功");
                }else if(state==2){
                    alert("对不起,你已经评价过一次了.不能再评价.");
                }else if(state==3){
                    alert("对不起,请先登录.");
                }else{
                    alert("发表失败");
                }
            }
        });
    }
    var publishState = <?=$addImpression?>;
    if(publishState==1){
        alert('评价成功');
    }else if(publishState==2){
        alert('评价失败!');
    }else if(publishState==3){
        alert('印象不能为空!');
    }else if(publishState==4){
        alert('对不起,你已经评价过一次了.不能再评价!');
    }else if(publishState==5){
        alert('请先登录.');
    }else if(publishState==6){
        alert('印象的长度应保持在15字以内.');
    }

    function confirmSubmit(type){
        if(type == 2){
            $("#grade_notice_content").show();
        } else if(type == 1){
<?php if($result==3) {?>
                        alert("请登录");
    <?php }else if($result==2) {?>
                        alert("您已评过了");
    <?php } else {?>
                        var selectArray = document.getElementsByName("score[]");
                        var selectCount = 0;
                        for(var i=0;i < selectArray.length; i++){
                            if(selectArray[i].checked) selectCount++;
                        }
                        if(selectCount > 0){
                            document.getElementById("from_grade").submit();
                            $("#grade_notice_content").hide();
                        } else {
                            alert("请选择");
                        }
    <?php } ?>
                    } else if(type == 0) {
                        $("#grade_notice_content").hide();
                    }
                }
</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F579bf00bc2e83979133ed98063c70f99' type='text/javascript'%3E%3C/script%3E"));
</script> 