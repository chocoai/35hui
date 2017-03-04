<?php
$this->breadcrumbs=array(
    '商务中心列表',
);
?>

<div style="background-color:#FFFFFF">
    <div id="two_left">
        <div style="line-height:24px;">
            <?php $this->widget('SearchMenu',array(
                'showMenu'=>array(1,3,4,5,6,7,8,10),//显示的条件
                'url'=>"officebaseinfo/rentbusinessList",//url
                "autoCompleteData"=>1,//自动完成使用数据
            ));
            ?>
            <div class="clear"></div>
            <!--商务中心精选开始-->
            <div class="lpjx" > 商务中心列表</div>
            <div class="clear"></div>
            <?php foreach($officeStr as $office) {?>
            <table align="left" width="680px" border="0" cellspacing="4" cellpadding="0">
                <tr>
                    <td width="190" rowspan="4" valign="top"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/007.jpg" border="0" /></a> </td>
                    <td colspan="2"  align="left"><?php echo CHtml::link(($office->ob_officename),array('/officebaseinfo/businessSummarize','opid'=>$office->ob_officeid));?>
                            <?php $officeTag = Officetag::model()->getAlltagByoffceid($office->ob_officeid);
                            foreach($officeTag as $tag) {
                                echo $tag->ot_ishigh.$tag->ot_isrecommend.$tag->ot_ishomepage.$tag->ot_isvideo.$tag->ot_ispanorama.$tag->ot_isnew.$tag->ot_ishurry;
                            }?>
                    </td>
                    <td width="50" rowspan="4">地图</td>
                </tr>
                <tr>
                    <td colspan="2" align="left"><a href="<?php echo Yii::app()->createUrl('/site/contact'); ?>">RMB:联系我们</a></td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                    <?php
                        $p = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$office->ob_officeid));
                        echo $p->op_officedesc ;
                    ?>
                    </td>
                </tr>
                <tr>
                    <td width="202" align="right"><?php echo CHtml::link('GOOGLE地图');?>|<?php echo CHtml::link('图片');?> </td>
                    <td width="218"  align="right"><?php echo CHtml::link('要求参观办公室');?> </td>
                </tr>
            </table><?php }?>
            <div class="clear"></div>
                <?php if ($pages->pageCount > 1) {?>
            <div>
                <?php $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'header' => '翻页',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '末页',
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                ));?>
            </div>
    <?php }?>
            <!--商务中心精选结束-->
        </div>
    </div>
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
        </div>
        <!--qjss end-->
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
        </div>
        <!--同商圈楼盘开始-->
        <div class="qjss_bottom">
<?php $this->renderPartial('/officebaseinfo/tradecircle',array('tradecircle'=>$tradecircle)); ?>
        </div>
        <!--同商圈楼盘结束-->
        <!--qjss end-->
        <div class="clear5"></div>
        <Div class="ggao2"></Div>
        <div class="clear5"></div>
        <Div class="clear5"></Div>
    </div>
</div>
