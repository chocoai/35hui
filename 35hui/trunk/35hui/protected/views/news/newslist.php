<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" />
<?php
    switch ($state){
        default :
            $pagename = "";
            break;
        case "0":
            $pagename = "政策法规";
            break;
        case "1":
            $pagename = "统计数据";
            break;
        case "2":
            $pagename = "市场行情";
            break;
        case "3":
            $pagename = "研究报告";
            break;
    }
?>
<style type="text/css">
    .ulmargin{margin:0 20px;}
    .searchTool .btnSearch input {background:url("/images/bg.gif") 0 -1760px no-repeat;display:block;text-decoration:none;height:31px;overflow:hidden;width:65px;cursor:pointer;border:none;}
</style>
<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
if($pagename){
    $this->breadcrumbs = array(
        '资讯',
        $pagename
    );
}else{
    $this->breadcrumbs = array(
        '资讯',
    );
}

?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/news.css" />
<div id="center">

    <Div id="loup">
        <div id="two_left">
       <div class="article_list_s2">
        <div class="head_article_list a_color_s5 clearfix">
          <div class="head_article_list_a"><?php echo $pagename; ?></div>
          <div class="head_article_list_b"></div>
        </div>
        <ul class="a_color_s2 color_s2">
            <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$dataProvider,
                    'itemView'=>'_listView',
                    'summaryText'=>'',
                    'summaryCssClass'=>'',
                ));
            ?>
        </ul>
        <!--page control, end-->
      </div>
        </div><!--two_left end-->

        <div id="two_right">
            <div class="margintop"></div>
            <!--qjss end-->
            <div>
                <div class="in_qjss"></div>
   <div class="qjss" style="margin-bottom: 1px; _margin-bottom:-5px;">
                <div class="gz_title">资讯搜索</div>
                <div class="c"></div>
                <ul class="ulmargin" style="_margin-bottom: -15px;">
                    <form action="/site/searchmenu" method="post">
                        <li>
                            <div class="searchTool">
                                <input class="txtSearch" name="title" type="text" value="<?=urldecode($title); ?>" style="margin-left:0px;" />
                                <div class="btnSearch">  <input value="" type="submit" /> </div>
                            </div>
                            <input type="hidden" name="n_state" value="<?=$state; ?>" />
                            <input type="hidden" name="action" value="/news/newslist" />
                        </li>
                        <li class="ss_wz"><span>示例：  人民广场   中融恒瑞 </span></li>
                    </form>
                </ul>

			</div>
				<div class="qjss_bottom" style="margin-top:-5px;" ></div>
            </div><!--qjss end-->

            <div class="qjss">
                <div class="in_qjss"></div>

                <div class="gz_title" style="margin-bottom: -5px"> 热点资讯</div>
                <div class="c"></div>
                <div class="zs4_list">
                    <ul >
                        <?php
                        if (!empty($hotnews)) {
                            foreach ($hotnews as $value) {
                        ?>
                        <li><span class="nr"><a href="<?php echo Yii::app()->createUrl("/news/newsbyid", array('nid' => $value['n_id'])); ?>"  title="<?=$value->n_title?>"><?php echo common::strCut(CHtml::encode($value->n_title), 42); ?></a></span> <span class="td_R"><?= $value->n_click; ?>次</span></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>

                </div> <div class="c"></div>
                <div class="qjss_bottom"></div>
                <div class="c"></div>


            </div><!--qjss end-->
            <div class="qjss">
                <div class="in_qjss"></div>

                <div class="gz_title" style="margin-bottom: -5px;"> 最新资讯</div>
                <div class="c"></div>
                <div class="zs4_list">
                    <ul >
                        <?php
                        if (!empty($recentnews)) {
                            foreach ($recentnews as $value) {
                        ?>
                        <li><span class="nrf"><a href="<?php echo Yii::app()->createUrl("/news/newsbyid", array('nid' => $value['n_id'])); ?>" title="<?=$value->n_title?>" ><?php echo common::strCut(CHtml::encode($value->n_title), 48); ?></a></span></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>

                </div> <div class="c"></div>
                <div class="qjss_bottom"></div>
                <div class="c"></div>
            </div><!--qjss end-->
        </div>
    </Div>
    <Div class="clear5"></Div>
    <div class="zs"> </div>
</div> <!--center end--> 