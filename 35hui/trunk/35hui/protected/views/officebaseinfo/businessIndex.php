<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<style type="text/css">
    #footer{*+margin-top:10px!important; _margin-top:0px;}
    .threeline_boxleftone{width:700px; border: 1px solid #EBEBEB; padding: 2px 9px 9px;}
    .submit_bg {position: relative;	text-align: center;	top:2px;top:13px\9;top:12px\0;	*top:2px;_top:4px;width: 111px;	}
	@media screen and (-webkit-min-device-pixel-ratio:0) {
        .submit_bg {
			padding-top:12px;
			position:relative;
			top:6px;
		}
	}
	.twoline_ul li{width:168px; float:left; height:30px; line-height:30px;}
	.twoline_ul li img{margin-right:10px; position:relative; top:5px;}
</style>
<?php
$this->pageTitle = $seotkd->stkd_title;
$this->breadcrumbs = array(
    '商务中心'
);
if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration']))) {
?>
<div class="clear"></div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/meigong/index.js" type="text/javascript"></script>
<!--content start-->
<div style="width:984px;margin:0px auto; padding-top:4px; overflow:hidden;">
    <div class="clearfix">
        <div class="oneline_boxleft">
            <img src="/images/ad05.jpg" alt="365天在新地标您可以足不出户浏览最实时最真实最方便的写字楼商务楼信息全景图片视频指哪看哪！" width="349px" height="270px" />
        </div>
        <div class="oneline_boxright">
            <div id='con1'>
                <?
                $adContent = Advertisement::showAdvertise(3);
                if($adContent){
                    echo $adContent;
                }else{
                ?>
                <a href="#" title=""><img src="/images/ad01.jpg" alt="" width="629px" height="221px" /></a>
                <?
                }
                ?>
            </div>
            <div id='con2' style="display:none"><a href="#" title=""><img src="/images/ad02.jpg" alt="" width="629px" height="221px" /></a></div>
            <div id='con3' style="display:none"><a href="#" title=""><img src="/images/ad03.jpg" alt="" width="629px" height="221px" /></a></div>
            <div id='con4' style="display:none"><a href="#" title=""><img src="/images/ad04.jpg" alt="" width="629px" height="221px" /></a></div>
            <ul class="oneline_boxrighttitle">
                <li class="menu1On" id="m1" onmouseover="Menu(1)"><a href="#" title="服务式办公室"><img src="/images/title_01.jpg" alt="服务式办公室" width="156px" height="44px" /></a></li>
                <li class="menu2Off" id="m2" onmouseover="Menu(2)"><a href="#" title="商务功能区"><img src="/images/title_02.jpg" alt="商务功能区" width="156px" height="44px" /></a></li>
                <li class="menu3Off" id="m3" onmouseover="Menu(3)"><a href="#" title="一站式服务"><img src="/images/title_03.jpg" alt="一站式服务" width="156px" height="44px" /></a></li>
                <li class="menu4Off" id="m4" onmouseover="Menu(4)"><a href="#" title="虚拟办公室"><img src="/images/title_04.jpg" alt="虚拟办公室" width="156px" height="44px" /></a></li>
            </ul>
        </div>
    </div>

    <div class="twoline_box">
        <dl>
            <dt>商务办公室具备传统办公室的所有优点但又无需支付大量租金，最低成本拥有本地名片、电话、秘...</dt>
            <dd><a href="/help/scoffice" title="了解更多服务式办公室">了解更多</a></dd>
        </dl>

        <dl>
            <dt>虚拟办公室（Virtual Office）具有传统办公室所有特点，但不必占用空间并为此付费。拥有商务地址...</dt>
            <dd><a href="/help/scfake" title="了解更多虚拟办公室">了解更多</a></dd>
        </dl>

        <dl>
            <dt>商务中心通常位于交通便利的交通枢纽附近，一个城市CBD的甲级写字楼内。除了具备...</dt>
            <dd><a href="/help/scsol" title="了解更多促销政策">了解更多</a></dd>
        </dl>
		<ul class="twoline_ul" style="margin-top:10px;">
            <li><a href="<?=Yii::app()->createUrl("officebaseinfo/businessSummarize",array("opid"=>"210"));?>" title=""><img src="/images/ad06.jpg" alt="" width="30px" height="21px" />雷格斯商务中心</a></li>
            <li><a href="<?=Yii::app()->createUrl("officebaseinfo/businessSummarize",array("opid"=>"212"));?>" title=""><img src="/images/ad07.jpg" alt="" width="30px" height="21px" />华殿商务中心</a></li>
            <li class="three"><a href="/help" title="了解更多办公地点选择">了解更多</a></li>
        </ul>

    </div>

    <div class="clearfix">
        <!--right start-->
        <div class="threeline_boxright">
            <div class="threeline_boxrightone">
                <dl>
                    <dt><img src="/images/ad08.jpg" alt="商务中心功能" width="156px" height="31px" /></dt>
                    <dd>
                        <ul>
                            <li>提供全套办公设备</li>
                            <li>提供全方位的秘书服务</li>
                            <li>提供会议中心及设备租借</li>
                            <li>提供完善的工商咨询代办服务</li>
                            <li>提供法律、会计事务所咨询服务</li>
                            <li>提供通讯联络登记服务</li>
                        </ul>
                    </dd>
                </dl>
            </div>

            <div class="threeline_boxrightone">
                <dl>
                    <dt><img src="/images/title_05.jpg" alt="适合商务中心的企业" width="190px" height="31px" /></dt>
                    <dd>
                        <ul>
                            <li>跨国性海外公公司或办事处</li>
                            <li>新公司或分公司成立</li>
                            <li>短期办公空间扩张</li>
                            <li>专案性临时组织</li>
                            <li>公司缩小规模</li>
                            <li>专业顾问型态小公司</li>
                        </ul>
                    </dd>
                </dl>
            </div>
             <!--投放GOOGLE广告联盟的广告-->
            <div class="threeline_boxrightone">
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

        </div>
        <!--right end-->

        <!--left start-->
        <div class="threeline_boxleft" style="width:720px; overflow: hidden;">
            <form id="formsearch" action="" method="post">
                <dl class="threeline_boxleftone">
                    <dt id='quyu'><strong>区域：</strong>
                        <a class='red_white' href="#">上海市</a>
                    </dt>
                        <?php
                        $parents = Searchcondition::model()->getSearchTypes("6,15,91,40");//获取搜索类型的大类
                        foreach($parents as $parent) {
                            if($parent['sc_id']!=51&&$parent['sc_id']!=1) {
                                echo "<dd id='".$parent['sc_id']."'><strong>".$parent['sc_title']."：</strong>";
                                $children = Searchcondition::model()->findConditionsByType($parent['sc_id']);
                                foreach($children as $child) {
                                    echo "<a class='no' href='#_self' onclick='choose(this)' va='".$child['sc_id']."'>".$child['sc_title']."</a>";
                                }
                                echo '</dd>';
                            }
                        }
                    ?>
                </dl>
                <div class="serachbox">
                    <?php $this->widget('CAutoComplete',
                        array(
                            "id"=>"keyword",
                            'name'=>'keyword',
                            'url'=>array('site/ajaxautocomplete'),
                            'max'=>10,//显示最大数
                            'minChars'=>1,//最小输入多少开始匹配
                            'delay'=>500, //两次按键间隔小于此值，则启动等待
                            'scrollHeight'=>200,
                            "width"=>305,
                            "extraParams"=>array("type"=>"1"),//表示是1楼盘、2商业广场还是3小区
                            'htmlOptions'=>array('size'=>'40',"class"=>"text_bg"),
                            "methodChain"=>".result(function(event,item){sub()})",//回调函数
                        ));
                    ?>
                    <input type="button" class="submit_bg"  value="" onclick="sub()" />
                </div>
            </form>
            <div class="bodyad">
                <?
                    $ad4 = Advertisement::showAdvertise(4);
                    if($ad4){
                        echo $ad4;
                    }else{
                ?>
                <a href="#" title=""><img src="/images/ad09.jpg" alt="" width="713px" height="118px" /></a>
                <?
                    }
                ?>
            </div>

            <!--按标志物找房-->

            <div class="dt_bian" style="width:720px;">
                    <div class="dt_title" style="width:100%"></div>
                        <div class="jb">
                            <div class="lpjx" style="margin-top:3px; margin-bottom:10px; display: block;" > 按标志物找房<input type="hidden" name="biaozhi_district" id="biaozhi_district" value="<?=$alldistrict[0]["re_id"]?>" /></div>
                            <Div class="clear"></Div>
                            <div class="shoushuo" style="_margin-top:2px;">
                                <div class="ss_left"><a href="#" onClick="move(1); return false;"><img src="<?php echo IMAGE_URL; ?>/ss_left.gif" border="0" /></a></div>
                                <div class="ss_center">
                                    <ul>
                                        <?php foreach($alldistrict as $areas) {?>
                                            <li><span style="cursor:pointer;" attr="<?php echo $areas->re_id?>" onclick="renderbuild(<?php echo $areas->re_id?>,this)"><?php echo $areas->re_name?></span></li>
                                        <?php }?>
                                    </ul>
                                </div>
                                <div class="ss_left"><a href="#" onClick="move(2); return false;"><img src="<?php echo IMAGE_URL; ?>/ss_right.gif" border="0" /></a></div>
                            </div>
                            <div class="clear"></div>
                            <div class="bzw_xx">
                                <div class="bzw_left"><span><?=Region::model()->getNameById($alldistrict[0]['re_id'])?></span></div>
                                <div class="bzw_right">
                                    <div class="ls_wz2">
                                        <ul></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="c"></div>
                        <div class="dt_bottom" style="width:100%"> </div>
                    </div>

            <!--按标志物找房-->
            
            <div class="bodyad" style="display: none;">
                <?
                    $ad5 = Advertisement::showAdvertise(5);
                    if($ad5){
                        echo $ad5;
                    }else{
                ?>
                <a href="#" title=""><img src="/images/ad09.jpg" alt="" width="713px" height="118px" /></a>
                <?
                    }
                ?>
            </div>

            <div class="threeline_boxlefttwo">
                <strong>商务中心精选</strong>
            </div>

            <div class="clearfixhidden">
                <div class="threeline_boxleftsix">
                    <?php
                    if(!empty($officerecommend)){
                        foreach($officerecommend as $value){
                    ?>
                    <dl>
                        <dt>
                            <a href="<?php echo Yii::app()->createUrl("/officebaseinfo/businessSummarize",array("opid"=>$value->baseoffice->ob_officeid)) ?>">
                                <img src="<?=Picture::model()->getPicByTitleInt($value->baseoffice->presentInfo->op_titlepicurl,"_normal");?>" alt="<?=$value->baseoffice->ob_officename?>" width="180px" height="120px" />
                            </a><br/>
                            <strong><a href="<?php echo Yii::app()->createUrl("/officebaseinfo/businessSummarize",array("opid"=>$value->baseoffice->ob_officeid)) ?>" title="<?=$value->baseoffice->presentInfo->op_officetitle?>"><?=CHtml::encode(common::strCut($value->baseoffice->presentInfo->op_officetitle, 30)) ?></a></strong>
                            <font color="#C10303" style="font-size: 14px">价格：<?=$value->baseoffice->rentInfo->or_rentprice;?>&nbsp;元/间·月</font><br />
                            <span>大楼：</span><font title="<?=$value->baseoffice->ob_officename;?>"><?=common::strCut($value->baseoffice->ob_officename, 36);?></font><br />
                            <span>楼层：</span><?=Officebaseinfo::$ob_floortype[$value->baseoffice->ob_floortype]?><br />
                            <span>位置：</span><?php echo Region::model()->getNameById($value->baseoffice->ob_district)."-".Region::model()->getNameById($value->baseoffice->ob_section) ?>
                        </dt>
                        <dd>发布时间：<?=date("Y-m-d H:i", $value->baseoffice->ob_releasedate)?></dd>
                    </dl>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!--投放GOOGLE广告联盟的广告-->
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
            
        </div>
        <!--left end-->
    </div>
</div>
<!--content end-->
<script language='javascript' type="text/javascript">
 $(document).ready(function(){
    showSection(<?=json_encode(Region::model()->getChildrenById($alldistrict[0]['re_id']));?>,null);
});
/**
 *id 行政区id
 *obj 当前选择obj对象
 */
function renderbuild(id,obj){
    $("#biaozhi_district").val(id);//设置当前行政区。
    $.ajax({
        data:'id='+id,
        url: '<?php echo Yii::app()->createUrl("/officebaseinfo/getBuild");?>',
        type: 'POST',
        dataType: 'json',
        success: function(json){
            $(".ls_wz2 ul").empty();
            showSection(json,obj);
        }
    });
}
function showSection(json,obj){
    if(obj!=null){
        $(".ss_center ul li").children().css("color","black");
        $(obj).css("color","red");
        $(".bzw_left span").text($(obj).text());//改变左边名称
    }else{
        $(".ss_center ul li").children().css("color","black");
        $(".ss_center ul li span").eq(0).css("color","red");
    }
    $.each(json,function(i,n){
        var html = "<li  onclick='searchByPosition("+n["re_id"]+")'>";
        html += "<font color=green>"+n["re_name"]+"</font></li>";
        $(".ls_wz2 ul").append(html);
    });
}
/**
 *通过传入板块，实现页面跳转
 *section 板块
 */
function searchByPosition(section){
    var district = $("#biaozhi_district").val();//当前行政区。
    var link = "<?php echo Yii::app()->createUrl("officebaseinfo/rentBusinessList") ?>";
    link = link+"/district"+district+"-section"+section;
    window.open(link);
}
/**
 *按区找房左右切换
 *opt为1前翻 2后翻
 */
function move(opt){
    if(opt==1){//前翻
        $(".ss_center ul li").slice(0,11).css("display", 'block');
    }else{//后翻
        $(".ss_center ul li").slice(0,11).css("display", 'none');
    }
}

<?php
$demoPart = array(
    '6'=>"area",//面积
    '15'=>"loop",//地段,比如:内环,外环,中环
    '20'=>"sPrice",//售价
    '30'=>"rPrice",//租金
    '40'=>"metro",//附近地铁路线
    '51'=>"fitment",//装修
    '56'=>"fangyuan",//房源,比如:中介 个人
    '91'=>'rbPrice',
);
?>
    var demoPart = <?=json_encode($demoPart);?>;
    //当控件被选中时，更改其class值
    function choose(a){
        $(a).parent().children().attr("class","");
        $(a).attr("class","red_white");
    }

    //静态form搜索，提交后台处理
    function sub(){
        var action = "<?php echo Yii::app()->createUrl("/officebaseinfo/businesssearchinput");?>";
        var part;
        for(part in demoPart){
            var pa = $("#"+part+" a.red_white").attr('va');
            if(pa){
                action +="/"+demoPart[part]+"/"+pa;
            }
        }
        $("#formsearch").attr("action",action);
        $("#formsearch").submit();
    }
</script>
    <?php $this->endCache(); } ?>