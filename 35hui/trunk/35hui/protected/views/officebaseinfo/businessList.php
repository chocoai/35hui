<?php
$this->breadcrumbs=array(//这是显示当前网站位置的,比如:Home » Officebaseinfos
    '商务中心信息列表'
);
$this->pageTitle="商务中心信息列表";
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/lou.css" />
<style type="text/css">
    .content{ background-color:#FFFFFF;}
	.submit_bg {padding-top: 6px;position: relative;top:0px;top:3px\9;position:absolute\0;top:173px\0;}
	@media screen and (-webkit-min-device-pixel-ratio:0) {
		.submit_bg {position:relative;}
</style>
<div class="content">
    <div id="two_left">
        <div style="line-height:24px;">
            <?php $this->widget('SearchMenu',array(
                'showMenu'=>array(1,3,4,5,6,7,8,9,10),//显示的条件
                'url'=>"officebaseinfo/rentbusinessList",//url
                "autoCompleteData"=>1,//自动完成使用数据
            ));
            ?>
        </div>
        <div class="clear5"></div>
        <div class="clear5"></div>
        <div class="container" style="width:750px;">
            <h5>商务中心信息列表</h5>
            <div style="width: 720px; margin-left: 0pt; float: left;">
                <div id="content">
                    <div style="background-color:white;">
                        <div style="background-color:#3ea0d0;width:720px;height:20px;">
                            <div style="text-align:center;width:300px;float:left;">名称|地址</div>
                            <div style="text-align:center;width:120px;float:left;">面积</div>
                            <div style="text-align:center;width:100px;float:left;">单价</div>
                            <div style="text-align:center;width:100px;float:left;">租金</div>
                            <div style="text-align:center;width:100px;float:left;">总价</div>
                        </div>
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider'=>$dataProvider,
                            'itemView'=>'_businessList',
                            'summaryText'=>'共有<strong>{count}</strong>套符合要求的房子',
                            'summaryCssClass'=>'',
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--two_left end-->
    <div id="two_right">
        <div class="clear"></div>
        <div class="qjss">
            <div class="in_qjss">
                <div class="qjss_bottom">
                    <div class="gz_title"> 全景搜索</div>
                    <div class="ss_wz">360楼盘体验</div>
                    <div class="ss"> &nbsp;</div>
                    <div class="ss_wz"><span>示例：  人民广场   中融恒瑞 </span></div>
                </div>
            </div>
        </div><!--qjss end-->
        <div class="clear5"></div>
        <div class="qjss">
            <div class="in_qjss">
                <div class="qjss_bottom">
                    <div class="gz_title"> 地图搜索</div>
                    <div class="ss_wz">地图搜索</div>
                    <div class="ss"></div>
                    <div class="ss_wz"><span>示例：  人民广场   中融恒瑞 </span></div>
                </div>
            </div>
        </div><!--qjss end-->

        <div class="clear5"></div>
        <Div class="ggao2"></Div>
        <div class="clear5"></div>
        <!--同商圈楼盘开始-->
        <?php /*?>   <div class="qjss_bottom">
      <?php $this->renderPartial('/officebaseinfo/tradecircle',array('tradecircle'=>$tradecircle)); ?>
    </div><?php */?>
        <!--同商圈楼盘结束-->
        <div class="clear5"></div>
        <div class="qjss">
            <div class="in_qjss">
                <div class="qjss_bottom">
                    <div class="gz_title"> 全景楼盘推荐</div>
                    <div class="clear"></div>
                    <div class="qjlp_images">
                        <div class="lp_images"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/qjlp_image.jpg" class="bbd" /></a>
                            <p>番愚区-华南新城</p>
                            <p>在售31套</p>
                        </div>
                    </div>
                    <div class="qjlp_images">
                        <div class="lp_images"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/qjlp_image.jpg"  class="bbd" /></a>
                            <p>番愚区-华南新城</p>
                            <p>在售31套</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="qjlp_images">
                        <div class="lp_images"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/qjlp_image.jpg" class="bbd" /></a>
                            <p>番愚区-华南新城</p>
                            <p>在售31套</p>
                        </div>
                    </div>
                    <div class="qjlp_images">
                        <div class="lp_images"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/qjlp_image.jpg"  class="bbd" /></a>
                            <p>番愚区-华南新城</p>
                            <p>在售31套</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="qjlp_images">
                        <div class="lp_images"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/qjlp_image.jpg" class="bbd"/></a>
                            <p>番愚区-华南新城</p>
                            <p>在售31套</p>
                        </div>
                    </div>
                    <div class="qjlp_images">
                        <div class="lp_images"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/qjlp_image.jpg"  class="bbd" /></a>
                            <p>番愚区-华南新城</p>
                            <p>在售31套</p>
                        </div>
                    </div>
                    <div class="clear50"></div>
                </div>
            </div>
        </div>
        <div class="clear5"></div>
        <Div class="ggao2"></Div>
        <div class="clear5"></div>
        <div class="qjss">
            <div class="in_qjss">
                <div class="qjss_bottom">
                    <div class="gz_title"> 最受欢迎</div>
                    <div class="clear5"></div>
                    <div class="zs4_list">
                        <ul >
                            <li><Span class="nr"><a href="#">金天国际大厦</a></Span> <span class="date2">3.8万/天/平</span></li>
                            <li><Span class="nr"><a href="#">金天国际大厦</a></Span> <span class="date2">3.8万/天/平</span></li>
                            <li><Span class="nr"><a href="#">金天国际大厦</a></Span> <span class="date2">3.8万/天/平</span></li>
                            <li><Span class="nr"><a href="#">金天国际大厦</a></Span> <span class="date2">3.8万/天/平</span></li>
                            <li><Span class="nr"><a href="#">金天国际大厦</a></Span> <span class="date2">3.8万/天/平</span></li>
                            <li><Span class="nr"><a href="#">金天国际大厦</a></Span> <span class="date2">3.8万/天/平</span></li>
                            <li><Span class="nr"><a href="#">金天国际大家</a></Span> <span class="date2">3.8万/天/平</span></li>
                        </ul>
                    </div>
                    <div class="clear50"></div>
                </div>
            </div>
        </div>
        <Div class="clear5"></Div>
        <div class="zs"> </div>
    </div>
</div>