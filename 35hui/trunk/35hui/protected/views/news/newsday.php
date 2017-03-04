<style type="text/css">
    .gz_title { LINE-HEIGHT:27px; MARGIN-TOP:5px; TEXT-INDENT:50px; WIDTH:180px; HEIGHT:27px; COLOR:#333; MARGIN-LEFT:10px; FONT-SIZE:14px; FONT-WEIGHT:bold; margin-bottom:5px; _padding-bottom:20px; }
    .ulmargin li{padding-bottom:3px; _margin-bottom:2px;}
    .dc_title { TEXT-ALIGN:left; LINE-HEIGHT:27px; MARGIN-TOP:15px;margin-bottom:3px; TEXT-INDENT:50px; FLOAT:left; HEIGHT:27px; COLOR:#006a6e; MARGIN-LEFT:10px;FONT-SIZE:14px;FONT-WEIGHT:bold;}
    .qjss_bottom { WIDTH:263px; height:13px; margin-bottom:5px;margin-bottom:0\9; }
    .zs4_list { LIST-STYLE-TYPE:none;FLOAT:left; LIST-STYLE-IMAGE:none; margin-top:-3px;  _margin-top:-25px; }
    .dc_title{color:#333;}
    .ulmargin { margin:10px 20px 0; margin: 0 20px\9;  margin-top:10px\0; _margin-top:-10px; _margin-bottom:0; _padding-bottom:0;}
    .searchTool .btnSearch input {background:url(../images/bg.gif) 0 -1760px no-repeat; display:block;text-decoration:none; height:31px;overflow:hidden; width:65px; cursor:pointer; border:none; }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" />
<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
$this->breadcrumbs = array(
        '资讯'
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/news.css" />
<div id="center">
    <Div id="loup">
        <div id="two_left">
            <div id="news">
                <div id="in_news">
                    <div class="new_images">
                        <div style="width:350px;float:left;font-size:20px; height: 217px;">
                            <script type="text/javascript">
                                var focus_width=345;     /*幻灯片新闻图片宽度*/
                                var focus_height=200;   /*幻灯片新闻图片高度*/
                                var text_height=17;    /*幻灯片新闻文字标题高度*/
                                var swf_height = focus_height+text_height;
<?php
$pics = $links = $texts = "";
if($pic!=null) {
    $picarr = $linkarr = $textarr = array();
    foreach ($pic as $p) {
        $picarr[]  =  urlencode(PIC_URL.$p['np_picurl']);
        $linkarr[] =  urlencode($p['np_linkurl']);
        $textarr[] =  common::strCut($p['np_title'],66);
    }
    $pics = implode("|", $picarr);
    $links = implode("|", $linkarr);
    $texts = implode("|", $textarr);
}
?>
    var pics = '<?php echo $pics; ?>';
    var links = '<?php echo $links; ?>';
    var texts = '<?php echo $texts; ?>';
    document.write('<embed src="<?=Yii::app()->baseUrl?>/Upload/flash/pixviewer.swf" wmode="opaque" FlashVars="pics='+pics
        +'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+
        text_height+'" menu="false" bgcolor="#DADADA" quality="high" width="'+ focus_width +'" height="'+ swf_height +
        '" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"/>');
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!--news end-->

            <div class="qs">
                <div class="in_qs">
                    <div class="qs_bottom">
                        <div class="blue_title">今日头条</div>
                        <ul class="qs_list">
                            <?php
                            if($newsall!=null) {
                                foreach ($newsall as $value) {?>
                            <li>
                                <span class="nr">
                                    <a href="<?php echo Yii::app()->createUrl('news/newsbyid',array("nid"=>$value['n_id'])); ?>" ><font style="font-size:12px;" <?php
                                                switch ($value['n_leave']) {
                                                    default:
                                                        break;
                                                    case 1:
                                                        echo "color='red' style='font-weight:bold'";
                                                        break;
                                                    case 2:
                                                        echo "color='red'";
                                                        break;
                                                    case 3:
                                                        echo "color='#CC6600'";
                                                        break;
                                                }
                                                                                                                                                ?> title="<?=$value['n_title']?>"><?php echo common::strCut(CHtml::encode($value['n_title']), 60) ?></font></a>
                                </span>
                                <span class="date"><?php echo date("m-d",$value['n_date']); ?></span>
                            </li>
                                    <?php }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!--出租结束-->

            <div class="ganggao1">
                <?=Advertisement::showAdvertise(13);?>
            </div>

            <div class="xzldc"><!--政策法规-->
                <div class="in_dc">
                    <div class="dc_bottom">
                        <div class="dc_title"> 政策法规</div>
                        <span class="dc_more"><a href="<?php echo Yii::app()->createUrl("/news/newslist",array('n_state'=>0));?>" target="_blank">更多>></a></span>
                        <div style="clear:both;height: 0px; font-size: 0; line-height: 0;"></div>
                        <div class="dcwz_list1">
                            <ul>
                                <?php
                                if($newszc!=null) {
                                    foreach ($newszc as $value) {?>
                                <li><a href="<?php echo Yii::app()->createUrl("/news/newsbyid",array('nid'=>$value['n_id'])); ?>"  title="<?=$value['n_title']?>"><?php echo common::strCut(CHtml::encode($value['n_title']), 60) ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

            </div><!--政策法规-->

            <div class="xzldc"><!--统计数据-->
                <div class="in_dc">
                    <div class="dc_bottom">
                        <div class="dc_title"> 统计数据</div>
                        <span class="dc_more"><a href="<?php echo Yii::app()->createUrl("/news/newslist",array('n_state'=>1));?>" target="_blank">更多>></a></span>
                        <div style="clear:both;height: 0px; font-size: 0; line-height: 0;"></div>
                        <div class="dcwz_list1">
                            <ul>
                                <?php
                                if($newscj!=null) {
                                    foreach ($newscj as $value) {?>
                                <li><a href="<?php echo Yii::app()->createUrl("/news/newsbyid",array('nid'=>$value['n_id'])); ?>"  title="<?=$value['n_title']?>"><?php echo common::strCut(CHtml::encode($value['n_title']), 60) ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

            </div><!--统计数据-->

            <div class="xzldc"><!--市场行情-->
                <div class="in_dc">
                    <div class="dc_bottom">
                        <div class="dc_title"> 市场行情</div>
                        <span class="dc_more"><a href="<?php echo Yii::app()->createUrl("/news/newslist", array('n_state' => 2)); ?>" target="_blank">更多>></a></span>
                        <div style="clear:both;height: 0px; font-size: 0; line-height: 0;"></div>
                        <div class="dcwz_list1">
                            <ul>
                                <?php
                                if ($newsdc != null) {
                                    foreach ($newsdc as $value) {
                                        ?>
                                <li><a href="<?php echo Yii::app()->createUrl("/news/newsbyid", array('nid' => $value['n_id'])); ?>" title="<?=$value['n_title']?>" ><?php echo common::strCut(CHtml::encode($value['n_title']), 60) ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div><!--市场行情-->

            <div class="xzldc"><!--研究报告-->
                <div class="in_dc">
                    <div class="dc_bottom">
                        <div class="dc_title"> 研究报告</div>
                        <span class="dc_more"><a href="<?php echo Yii::app()->createUrl("/news/newslist", array('n_state' => 3)); ?>" target="_blank">更多>></a></span>
                        <div style="clear:both;height: 0px; font-size: 0; line-height: 0;"></div>
                        <div class="dcwz_list1">
                            <ul>
                                <?php
                                if ($newsyj != null) {
                                    foreach ($newsyj as $value) {
                                        ?>
                                <li><a href="<?php echo Yii::app()->createUrl("/news/newsbyid", array('nid' => $value['n_id'])); ?>" title="<?=$value['n_title']?>" ><?php echo common::strCut(CHtml::encode($value['n_title']), 60) ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

            </div><!--研究报告-->
            <!--投放GOOGLE广告联盟的广告-->
            <div class="ganggao1">
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
        </div><!--two_left end-->

        <div id="two_right">
            <div class="margintop"></div>
            <div class="qjss">
                <div class="in_qjss"></div>
                <div class="gz_title"> 热点资讯</div>
                <div class="c"></div>
                <ul class="ulmargin">
                    <form action="/site/searchmenu" method="post">
                        <li >
                            <div class="searchTool">
                                <input class="txtSearch" name="title" type="text" value="" style="margin-left:0px;" />
                                <div class="btnSearch"> 
                                    <input value="" type="submit" />
                                </div>
                            </div>
                        </li>
                        <li class="ss_wz"><span>示例：  人民广场   中融恒瑞 </span></li>
                        <input type="hidden" name="action" value="/news/newslist" />
                    </form>
                </ul>
                <div class="qjss_bottom"></div>
                <div class="c"></div>

            </div>
            <!--qjss end-->
            <div class="qjss">
                <div class="in_qjss"></div>

                <div class="gz_title"> 地图搜索</div>
                <div class="c"></div>
                <ul class="ulmargin">
                    <form action="/site/searchmenu" method="post">
                        <li >
                            <div class="searchTool">
                                <input class="txtSearch" name="kwd" type="text" value="" />
                                <div class="btnSearch"> <input value="" type="submit" /> </div>
                            </div>
                        </li>
                        <li class="ss_wz"><span>示例：  人民广场   中融恒瑞 </span></li>
                        <input type="hidden" name="action" value="/map/map" />
                    </form>
                </ul>
                <div class="qjss_bottom"></div>
                <div class="c"></div>


            </div><!--qjss end-->



            <div class="qjss" style="margin-bottom:-5px;">
                <div class="in_qjss"></div>

                <div class="gz_title"> 热点资讯</div>
                <div class="c"></div>
                <div class="zs4_list c">
                    <ul >
                        <?php
                        if($hotnews!=null) {
                            foreach ($hotnews as $value) {?>
                        <li><span class="nr" style="margin-left: 5px;"><a href="<?php echo Yii::app()->createUrl("/news/newsbyid",array('nid'=>$value['n_id']));?>" title="<?=$value['n_title']?>"><?php echo common::strCut(CHtml::encode($value['n_title']), 42) ?></a></span> <span class="td_R"><?=$value->n_click; ?>次</span></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>

                </div> <div class="c"></div>
                <div class="qjss_bottom"></div>
                <div class="c"></div>


            </div><!--qjss end-->
             <div class="qjss" style="margin-bottom:-5px;">
                <div class="in_qjss"></div>
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
                <div class="qjss_bottom"></div>
                <div class="c"></div>
             </div><!--qjss end-->
        </div>
    </Div>
    <Div class="clear5"></Div>
    <div class="zs"> </div>
</div> <!--center end-->