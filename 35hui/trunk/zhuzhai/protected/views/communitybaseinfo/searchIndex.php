<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
?>
<link href="/css/zhai.css" type="text/css" rel="stylesheet" />
<link href="/css/global.css" type="text/css" rel="stylesheet" />
<style type="text/css">
    .fydj { margin-top:10px; }
    .dj_images { margin-top:10px; }
    #tworight {  _width:275px; _overflow:hidden; }
    .serach_moreultwo {  padding-left:5px; }
    .loupan_onelinerighttitle {  padding-left:0; }
    .addserach .ulthreetwo{width:385px;}
</style>
<script type="text/javascript">
    function filterdateshow(obj){
        $(obj).children("dl").removeClass("hidden").addClass("show");
    }
    function filterdatehidden(obj){
        $(obj).children("dl").removeClass("show").addClass("hidden");
    }
</script>
<div style="text-align: left; margin-top: 5px; margin-bottom: 8px;">
    <?php
    $this->pageTitle = $seotkd->stkd_title;
    $this->breadcrumbs = array(
        '小区搜索',
    );
    ?>
</div>
<div style="margin-top: -3px;" class="tab10">
    <dl>
    <dt class="<?=$this->Action->getId()=="searchIndex"?"now":"out"?>"><a href="<?=Yii::app()->createUrl("communitybaseinfo/searchIndex")?>">按区域查找</a></dt>
    <dt class="<?=$this->Action->getId()=="dtsearchIndex"?"now":"out"?>"><a href="<?=Yii::app()->createUrl("communitybaseinfo/dtsearchIndex")?>">按地铁查找</a></dt>
    </dl>
</div>
<?php
$this->widget('SearchMenuCondition',array(
        'options'=>$options,
    ));
?>
<div id="panel_apf_id_10" class="condition_links2 ">
    <?php
        $url = $this->getId()."/".$this->getAction()->getId();
        $this->widget('SearchMenu',array(
            'showMenu'=>$searchMenu,//显示的条件
            'url'=>$url,//url
            "autoCompleteData"=>3,//自动完成使用数据
            "sourceType"=>1,
        ));
    ?>
</div>
        <div id="two_left">
            <div style="border-bottom:3px solid #76b535;;height:34px;overflow:hidden">
                <ul class="serach_moremenu">
                    <li class="one"><strong><a href="<?php echo $url;?>">全部楼盘</a></strong></li>
                    <li class="two"><strong><a href="<?=Yii::app()->createUrl("/map/map")?>" target="_blank">地图搜索</a></strong></li>
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
                    <li class="one" style="width: 200px;" id="newSummaryText">找到相关数据<strong><?=$dataProvider->getTotalItemCount();?></strong>条</li>
                    <li class="two" style="width: 400px;">
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
                    <a class="<?=$class?>" href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", $options_tmp))?>">售价</a> </li>
                </ul>
            </div>
            <?php
            foreach($allSource as $data){
                $this->renderPartial('_clist', array('data'=>$data));
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
    <?php
    $this->widget('RecentView',array("cssType"=>"residence"));
    ?>
    <!-- 投放GOOGLE广告联盟的广告-->
        <div id="tworight">
            <div class="addspace" style="height:40px;"></div>
            <div class="brow">
                <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
                <div class="br_cont" >
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
        
</div>
        
<script type="text/javascript" src="/js/tabs.js"></script>