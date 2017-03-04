<?php
$this->pageTitle = $seotkd->stkd_title;
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
Yii::app()->clientScript->registerScriptFile("/js/autoplay/auto.js");
Yii::app()->clientScript->registerCssFile("/js/autoplay/auto.css");

if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration']))) {
    ?>
<div class="inserch">
    <div class="intxt">
        <h2><img src="/images/jjrxf.jpg" /></h2>
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
<div class="xzdb"><img src="/images/xzdb.jpg" /></div>
<div class="in_step">
    <div class="in_model l">
        <h2 class="indexpic rsheader">最好的经纪人</h2>
        <div class="in_main">
            <div class="in_mod rbheader indexpic">
                <p>卓越</p>
                <p style="padding-left:18px;">只因止于至善</p>
            </div>
            <div class="in_mode">新地标仅与优秀、英明、诚实的经纪人合作共事。我们通过分析经纪人的历史资料、行为模式与客户反馈生成经纪人的综合评判，并动态调整。我们慎重对待客户对新地标经纪的每一次评价，并作为我们前进的动力</div>
        </div>
    </div>
    <div class="in_model l" style="margin-left:20px;">
        <h2 class="indexpic skehu">从客户角度考虑</h2>
        <div class="in_main">
            <div class="in_mod bkehu indexpic">
                <p>精心</p>
                <p style="padding-left:18px;">只为成就所托</p>
            </div>
            <div class="in_mode">将客户利益永远放在第一位的经纪人，才是值得托付的伙伴。新地标奖励经纪人对客户的每一次真情服务，通过鼓励而不是压力促进经纪人的服务品质。</div>
        </div>
    </div>
    <div class="in_model r">
        <h2 class="indexpic spai" >360的看房体验</h2>
        <div class="in_main">
            <div class="in_mod bpai indexpic">
                <p>制胜</p>
                <p style="padding-left:18px;">只以创新为本</p>
            </div>
            <div class="in_mode">科学技术是第一生产力，新地标研发团队创新的将360全景展示应用到房地产领域，并与优秀的经纪人友情分享，为找房用户提供更便捷的看房体验。</div>
        </div>
    </div>
</div>
<div class="friendly"><em>友情链接：</em>
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
    function getSelectValue(){
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
</script>
    <?php $this->endCache();
} ?>