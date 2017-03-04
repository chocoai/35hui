<?php
$ob_city = Region::model()->getNameById($model['ob_city']);
$ob_ditrict=Region::model()->getNameById($model['ob_district']);
$ob_officename=$model->ob_officename;
$ob_officearea=$model->ob_officearea;
$or_rentprice=$model->rentInfo['or_rentprice'];
$keywords=$ob_city.$ob_officename.'写字楼出租,面积'.$ob_officearea.'平方米,'.$or_rentprice;
$description=$ob_city.$ob_ditrict.','.$ob_officename.'租房,日租金：'.$or_rentprice.',面积'.$ob_officearea.'平方米,';
if($ownerInfo->user_role==User::personal) {
    $personalInfo = Unormal::model()->findByAttributes(array('puser_uid'=>$ownerInfo->user_id));
    $description.='业主咨询电话:'.$ownerInfo['user_tel'].'。';
}elseif($ownerInfo->user_role==User::agent) {
    $agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$ownerInfo->user_id));
    $description.='经纪人:'.$agentInfo->ua_realname.',咨询电话:'.$ownerInfo['user_tel'].'。';
}elseif($ownerInfo->user_role==User::company) {
    $companyInfo = Ucom::model()->findByAttributes(array('uc_uid'=>$ownerInfo->user_id));
    $description.='中介公司:'.$companyInfo->uc_fullname.',咨询电话:'.$companyInfo['uc_tel'].'。';
}
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $ob_officename.'出租,'.$ob_city.$ob_officename.'360°全景看房,'.$ob_officename.'租金'.$or_rentprice.'-新地标';
$this->breadcrumbs = array(
        '写字楼'=>array("/office"),
        '出租' => array('rentIndex'),
        $ob_officename,
);
/**举报虚假房源弹出层 开始 */
$this->widget('ReportWidget', array(
        'triggerId' => 'report',
        'suspectUserId' => $ownerInfo->user_id,
        'sourceId' => $model->ob_officeid,
        'sourceType' => Report::office,
));
/**举报虚假房源弹出层 开始 */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" />
<style type="text/css">
    .xiezilou_leftboxtwo { padding: 0 20px 25px;}
    .serach_moremenu li.one strong { padding:0px 6px 0px 10px;  _padding:10px 6px 10px 10px; }
    .serach_moremenu li.two strong{ padding: 0 6px 0 10px;  _padding:8px 6px 8px 10px;}
    .loupan_twoleftulone li.four {  float: right; height: 34px; line-height: 38px; overflow: hidden; padding-right: 5px; }
    .pictureGrid { width: 690px; overflow: visible; height: auto; }
    .loupan_onelineright{margin-top: -10px;}
    .pictureGrid li{height: auto;padding:0 22px;}
</style>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/scrollable-horizontal.css" />
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/brow.css" />
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/jquery.tools.min.js"></script>
<!--content start-->
<div class="clearfix"  style="width:1003px;margin:0px auto;">
    <!--oneline start-->
    <?php if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration'],'varyByParam'=>array("id")))) { ?>
    <div class="xiezilou_left">
            <?php
            $variable = array('ownerInfo'=>$ownerInfo,'model'=>$model,'rentInfo'=>$rentInfo,'buildingInfo'=>$buildingInfo,'prentInfo'=>$prentInfo,'rentorsell'=>'rent');
            if($ownerInfo->user_role==User::personal) {
                $this->renderPartial('_personalModule',$variable);
            }elseif($ownerInfo->user_role==User::agent) {
                $this->renderPartial('_agentModule', $variable);
            }elseif($ownerInfo->user_role==User::company) {
                $this->renderPartial('_companyModule', $variable);
            }
            ?>

        <!-- 写字楼全景展示 开始 -->
            <?php
            if(Panoxml::model()->checkHavePano($model->ob_officeid, 3)) {
                $this->renderPartial('_panorama', array(
                    "mainXml"=>Panoxml::model()->getPanoXml($model->ob_officeid, 3),
                ));
            }
            ?>
        <!-- 写字楼全景展示 结束 -->
        <ul class="serach_moremenu xiezilou">
            <li class="one" id="bright1"><strong><span><img src="/images/icon_calender.gif" /></span>房源介绍</strong></li>
        </ul>
        <div class="xiezilou_leftlinethree" style="width:725px;"></div>
        <div class="xiezilou_leftboxtwo clearfix xiezilou_leftboxtwott"><br />
            <div id="brightChild1">
                <span class="fontred">房源介绍：</span><br>
                    <?=$prentInfo['op_officedesc']?><br />
            </div>
        </div>
        <div class="xiezilou_leftlinefour"></div>

        <ul class="serach_moremenu xiezilou">
            <li class="one" id="bright1" onClick="bturnit(1);"><strong><span><img src="/images/icon_calender.gif" /></span>房源图片</strong></li>
        </ul>
        <div class="xiezilou_leftlinethree" style="width:725px;"></div>
        <div class="xiezilou_leftboxtwo clearfix xiezilou_leftboxtwott"><br />
            <div id="brightChild4">
                <ul class="pictureGrid">
                        <?php
                        $typePictures = $pictures[Picture::$picType['indoor']];
                        $pic_size = count($typePictures);
       
                        for($i=0;$i<$pic_size;$i++) {
                           $picUrl=PIC_URL.Picture::showStandPic($typePictures[$i]['p_img'],"_large");
                            ?>
                    <li><img alt="<?=$model->ob_officename?>" class="img_border" src="<?=$picUrl?>" /></li>

                           <?php
                        }
                        ?>
                        <?php
                        $typePictures = $pictures[Picture::$picType['outdoor']];
                        $pic_size = count($typePictures);
                        for($i=0;$i<$pic_size;$i++) {
                            $picUrl=PIC_URL.Picture::showStandPic($typePictures[$i]['p_img'],"_large");
                            ?>
                    <li><img alt="<?=$model->ob_officename?>" class="img_border" src="<?=$picUrl?>" /></li>

                           <?php 
                        }
                        ?>
                        <?php
                        $typePictures = $pictures[Picture::$picType['ichnograph']];
                        $pic_size = count($typePictures);
                        for($i=0;$i<$pic_size;$i++) {
                            $picUrl=PIC_URL.Picture::showStandPic($typePictures[$i]['p_img'],"_large");
                            ?>
                    <li><img alt="<?=$model->ob_officename?>" class="img_border" src="<?=$picUrl?>" /></li>

                           <?php
                      
                        }
                        ?>
                </ul>
            </div>
        </div>
        <div class="xiezilou_leftlinefour"></div>
        <div class="xiezilou_leftlinethree"></div>
        <div class="xiezilou_leftboxtwo clearfix xiezilou_leftboxtwott" style="padding-top:3px; padding-bottom: 35px;">
            <h1 style="height:22px; line-height: 22px; margin-bottom: -8px;"><img src="<?=IMAGE_URL;?>/gif-0858.gif" width="19" height="18" /> [ <?=CHtml::encode($model->ob_officename);?>简介 ]&nbsp;<img src="/images/loupan038.jpg"/><a target="_blank" href="<?=Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>$model->ob_sysid))?>" style="color:blue"><font style="font-size:12px">查看本案信息</font></a></h1>
            <img style="display:block; float: left;" src="<?=Picture::model()->getPicByTitleInt($buildingInfo?$buildingInfo->sbi_titlepic:"","_large");?>" alt="<?=$model->ob_officename?>" width="419px" height="254px"/>
            <div class="xiezilou_leftboxthree">
                <div class="xiezilou_leftboxfour">
                    <div>
                        <img src="/images/twittertitle.gif" width="30px"/>
                            <?php $twitter = Twitter::model()->getTwitterMessageByBuildingId($model->ob_sysid)?>
                        动态：<font title="<?=$twitter?>" style='color:#63C44A'><?=$twitter?common::strCut(CHtml::encode($twitter), 39):"暂无更新";?></font>
                    </div>
                    <div style="width:200px">
                        <div style="float:left">评价等级：</div><?php
                            $star = Systembuildinginfo::model()->getAvgStar($model->ob_sysid);
                            if($star) {
                                echo "<div style='float:left'>".common::getStar($star)."</div>";
                            }else {
                                echo "<font style='color:#2A9293'>暂无评价</font>";
                            }
                            ?>
                    </div>
                    <ul class="xiezilou_leftulthree"><li class="three">出售房源：<span><?=Systembuildinginfo::model()->getSellNums($model->ob_sysid);?>套</span></li>
                        <li class="four">出租房源：<span><?=Systembuildinginfo::model()->getRentNums($model->ob_sysid);?>套</span></li>
                        <li class="five">最新评论：<span><?php
                                    if(!empty($recentComment)) {
                                        echo common::strCut(CHtml::encode($recentComment->sbc_comment), 42);
                                    }else {
                                        echo "暂无评论";
                                    }
                                    ?></span></li>
                    </ul>
                </div>

                <dl class="loupaninfo_middledl">
                    <dt>楼盘印象：</dt>
                    <dd>
                            <?php
                            if(!empty($impressions)) {
                                foreach($impressions as $value) {
                                    ?>
                        <a href="#_self" title='<?=CHtml::encode($value->im_description)?>'><?=common::strCut(CHtml::encode($value->im_description),10)?></a>
                                    <?php
                                }
                            }else {
                                echo "<font style='color:#2A9293'>暂无印象</font>";
                            }
                            ?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="xiezilou_leftlinefour"></div>
    </div>
        <?php $this->endCache();
} ?>
    <div class="loupan_onelineright loupaninfo_add">
        <ul class="xiezilou_leftulflour">
            <li><a id="report" href="#">&nbsp;举报虚假信息</a></li>
            <li><?
                if(User::model()->getCurrentRole()==User::personal) {
    ?>
                <a href="#_self" onclick="store()">收藏房源</a>
                    <?
                }  else {
                    echo "不可收藏";
                }
?></li>
            <li><a href="#" onclick="window.print();">&nbsp;打印</a></li>
            <li><a href="#" onclick="copyText()">分享</a></li>
        </ul>

        <div class="linebgtop"></div>
        <div class="threeline_mapgoogle">
            <?php
            if($buildingInfo) {
                $this->widget('ShowSmallMap',array('x'=>$buildingInfo->sbi_x,
                        'y'=>$buildingInfo->sbi_y,
                        'name'=>$model->ob_officename,
                        'width'=>'242px',
                        'height'=>'285px',
                ));
            }
?>
        </div>
        <div class="linebgbottom"></div>

        <div style="clear:both;"></div>
        <?php
        @$this->widget('RecentView',array());
        ?>
        <!-- 投放GOOGLE广告联盟的广告 -->
        <div class="linebgtop"></div>
        <div class="threeline_mapgoogle">
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
        <div class="linebgbottom"></div>
    </div>
    <!--oneline end-->
</div>
<!--content end-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/meigong/main.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sourceView.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
    $(".scrollable").scrollable({
        keyboard:true
    });
    function store(){
        var presentId = <?=$model->ob_officeid?>;
        var officeType = <?=Housecollect::office?>;
        var rentorsell = <?=Housecollect::rent?>;
        $.ajax({
            type:'post',
            url:'<?=Yii::app()->createUrl('housecollect/ajaxAddCollect')?>',
            data:{officeType:officeType,rentorsell:rentorsell,presentId:presentId},
            success:function(state){
                if(state==2){
                    alert("收藏成功");
                }else if(state==1){
                    alert("请先登录");
                }else if(state==3){
                    alert("该房源已经收藏");
                }else{
                    alert("收藏失败");
                }
            }
        });
    }
    document.body.oncopy = function(ev){
        ev = ev || window.event;
        alert("受保护的内容，暂不可复制！");
        return false;
    }
</script>