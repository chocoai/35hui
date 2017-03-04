<?php
$this->breadcrumbs=array(
    '商务中心',
    $model->presentInfo->op_officetitle=>array('officebaseinfo/businessComments','opid'=>$model->ob_officeid,'tab'=>1),
    '所有点评'
);
?>
<div class="clearfix">
    <div id="two_left">
        <div class="serach_morelefttwobox" style="border: 0px;">
            <!-- 评论模块 开始 -->
            <div id="brightChild5">
                <h3><strong>商务中心点评</strong></h3>
                <div class="swzxdianpin">
                    <div class="loupaninfo_fivelinebox">
                        <?php $this->widget('zii.widgets.CListView', array(
                            'dataProvider'=>$dataProvider,
                            'itemView'=>'_comments',
                            'summaryText'=>'',
                        )); ?>
                    </div>
                </div>
            </div>
            <!-- 评论模块 结束 -->
        </div>
    </div>
    <div id="two_right">
        <!--right start-->
            <div class="linebgtop"></div>
            <div class="serach_moreboxonerightbox">
                <h2>周边商务中心</h2>
                <ul class="serach_moreulone" style="height:50px;">
                    <li class="morelione">名称</li>
                    <li class="morelitwo" style="width:40px;">面积<br>(平方)</li>
                    <li class="morelithree" style="width:74px;">价格<br>(元/平方·天)</li>
                </ul>
                <?php
                if(count($aroundBusiness)>0) {
                    foreach($aroundBusiness as $dist) {
                ?>
                <ul class="serach_moreultwo">
                    <li class="morelione"><?php echo CHtml::link(($dist->ob_officename),array('/officebaseinfo/businessSummarize','opid'=>$dist->ob_officeid));?></li>
                    <li class="morelitwo"><?=$dist->ob_officearea?></li>
                    <li class="morelithree"><?=$dist->rentInfo['or_rentprice']?></li>
                </ul>
                <?php
                    }
                }else {
                ?>
                <center>暂无相关数据！</center>
                <?php
                    }
                ?>
            </div>
            <div class="linebgbottom"></div>
        <!--right end-->
    </div>
</div>
<!--center end-->