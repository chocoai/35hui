<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
?>
<link href="/css/adjustsearch.css" type="text/css" rel="stylesheet" />
<link href="/css/seardetail.css" type="text/css" rel="stylesheet" />
<link href="/css/homespecial.css" type="text/css" rel="stylesheet" />
<link href="/css/zhai.css" type="text/css" rel="stylesheet" />
<link href="/css/global.css" type="text/css" rel="stylesheet" />
<style type="text/css">
    .fydj {	margin-top:10px;}
    .dj_images {margin-top:10px;}
    #tworight{width:273px;}
    .qjlp_images{width:105px;}
    .border{padding-left:0;}
    li.ulthreefour{margin-left: 40px;}
    .ulthreetwo span{color:#999;}
    .serach_nav li.two a.seabg{float:right;}
</style>
<div>
    <div style="text-align: left; margin-top: 5px; margin-bottom: 8px;">
        <?php
        $this->pageTitle = $seotkd->stkd_title;
        $this->breadcrumbs = array(
                "住宅"=>array("communitybaseinfo/index"),
                '出租',
        );
        ?>
    </div>
    <div style="margin-top: -3px;" id="center">
        <div id="yw0" class="portlet">
            <div class="portlet-content">
                <div style="margin-top: -3px; margin-bottom: -7px;" class="tab10">
                    <dl>
                        <dt class="<?=$this->Action->getId()=="rentIndex"?"now":"out"?>"><a href="<?=Yii::app()->createUrl("communitybaseinfo/rentIndex")?>">按区域查找</a></dt>
                        <dt class="<?=$this->Action->getId()=="dtrentIndex"?"now":"out"?>"><a href="<?=Yii::app()->createUrl("communitybaseinfo/dtrentIndex")?>">按地铁查找</a></dt>
                    </dl>
                </div>
                <?php
                $url = Yii::app()->createUrl("communitybaseinfo/rentIndex");
                $this->widget('SearchMenuCondition',array(
                        'options'=>$options,
                        'officeType'=>Findcondition::residence,
                        'rentorsell'=>Findcondition::rent,
                        'backGroundColor'=>"#fca074",
                ));
                ?>
            </div>
        </div>
        <div class="detail">
            <div id="yw1" class="portlet">
                <div class="portlet-content">
                    <?php
                    $url = $this->getId()."/".$this->getAction()->getId();
                    $this->widget('SearchMenu',array(
                            'showMenu'=>$searchMenu,//显示的条件
                            'url'=>$url,//url
                            "autoCompleteData"=>3,//自动完成使用数据
                            "sourceType"=>3,
                            "inputSearchBoolean"=>false,//不要输入框搜索
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div id="two_left">
            <div style="border-bottom:3px solid #76b535;;height:34px;overflow:hidden">
            <?php
            $this->renderPartial('_residencetag', array('url'=>$url,'options'=>$options,'type'=>$type));
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
                    <li class="one" style="width: 200px;" id="newSummaryText">找到相关房源<strong><?=$dataProvider->getTotalItemCount();?></strong>条</li>
                    <li class="two" style="width: 400px;">
                        <div style="float: left;">按日期排序：</div>
                        <div class="price" onmouseover="filterdateshow(this)" onmouseout="filterdatehidden(this)">
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
                            <dl class="pull-down hidden" style="left: 388px; _left:348px;">
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
                        <a class="<?=$class?>" href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", $options_tmp))?>">租金</a>
                        <?php
                        $options_tmp = $options;
                        if(isset ($options['order'])&&$options['order']=="au") {
                            $options_tmp = 'ad';
                            $class = "up";
                        }else if(isset ($options['order'])&&$options['order']=="ad") {
                            $options_tmp = '';
                            $class = "down";
                        }else {
                            $options_tmp = "au";
                            $class = "seabg";
                        }
                        ?>
                        <a class="<?=$class?>" href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", $options_tmp))?>">面积</a>
                    </li>
                </ul>
            </div>
            <div class="list-view" id="yw3">
                <?php
                foreach($allSource as $data) {
                    $this->renderPartial('_rentIndex', array('data'=>$data));
                }
                echo "<div style='clear:both; height:35px; padding-top:15px;'>";
                $this->widget('CLinkPager',array(
                        'pages'=>$dataProvider->pagination,
                        "htmlOptions"=>array("style"=>"float:right;"),
                ));
                echo "</div>";
                ?>
            </div>
        </div>
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
</div>
<script type="text/javascript" src="/js/tabs.js"></script>
<script type="text/javascript">
    function filterdateshow(obj){
        $(obj).children("dl").removeClass("hidden").addClass("show");
    }
    function filterdatehidden(obj){
        $(obj).children("dl").removeClass("show").addClass("hidden");
    }
</script>
<script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F579bf00bc2e83979133ed98063c70f99' type='text/javascript'%3E%3C/script%3E"));
</script> 