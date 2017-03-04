<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
?>
<link type="text/css" rel="stylesheet" href="/css/tanchu.css" />
<link type="text/css" rel="stylesheet" href="/css/zhai.css" />
<link type="text/css" rel="stylesheet" href="/css/global.css" />
<?php
    $this->pageTitle = $seotkd->stkd_title;
    if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration']))) {
?>
<!--<div id="center">
    <?php //$this->renderPartial('_headScrollist', array('scrolllist'=>$scrolllist));?>
<div class="clear"></div>-->
<div id="two_left">
    <?php $this->renderPartial('_recentZhuzhai', array(
        'rentZhuzhai'=>$rentZhuzhai,
        'sellZhuzhai'=>$sellZhuzhai
    ));?>
    <div class="ganggao1">
        <?=Advertisement::showAdvertise(19);?>
    </div>
    <div class="w720">
        <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border">
            <div class="lpjx">
                热门小区
            </div>
            <div class="rmxq">
            <?php foreach($hotcommunity as $key=>$value) { ?>
                <div class="subbox">
                    <a href="<?php echo Yii::app()->createUrl("/communitybaseinfo/view", array("id" => $value->community->comy_id)); ?>" rel="">
                        <img src="<?=Picture::model()->getPicByTitleInt($value['community']['comy_titlepic'],"_small");?>" alt="<?=$value['community']['comy_name']?>"/>
                    </a>
                    <div  class="re"></div>
                    <div class="propinfo">
                        <a href="<?php echo Yii::app()->createUrl("/communitybaseinfo/view", array("id" => $value->community->comy_id)); ?>" title="<?=$value['community']['comy_name']?>" target="_blank">
                        <?php echo Region::model()->getNameById($value['community']['comy_district'])?> - <?php echo common::strCut(CHtml::encode($value['community']['comy_name']), 20)?>
                        </a>
                        <br />
                    </div>
                    <div class="red"></div>
                </div>
              <?php } ?>
            </div>
        </div>
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
    <div class="w720" style="margin-top:10px;">
        <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border">
            <div class="lpjx">
                金牌经纪人
            </div>
            <div class="rmxq">
                <?php 
                    $userIdArray = array();
                    if($golduagent!="") {
                        foreach($golduagent as $value) {
                            array_push($userIdArray,$value->user->agentinfo->ua_id);
                            $this->renderPartial('_tjuagent',array("value"=>$value->user));
                        }
                    }
                    //追加用户
                    $i = count($golduagent);
                    $j = 0;
                    if($i<5) {
                        $golduagent2 = User::model()->getHighUser(5-count($golduagent));
                        foreach($golduagent2 as $value) {
                            if(in_array($value->agentinfo->ua_id,$userIdArray)) continue;
                            $j++;
                            $this->renderPartial('_tjuagent',array("value"=>$value));
                            if($i+$j==5)break;
                        }
                    }
                ?>
            </div>
        </div>
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
    <div class="ganggao1">
         <?=Advertisement::showAdvertise(20);?>
    </div>
    <div class="w720">
        <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border">
            <div class="lpjx">
                合作伙伴
            </div>
            <div class="ppzjdetail">
                <div class="pp_images">
                    <?=Advertisement::showAdvertise(22);?>
                </div>
                <div class="pp_images">
                    <?=Advertisement::showAdvertise(23);?>
                </div>
                <div class="pp_images">
                    <?=Advertisement::showAdvertise(24);?>
                </div>
                <div class="pp_images">
                    <?=Advertisement::showAdvertise(25);?>
                </div>
                <div class="pp_images">
                    <?=Advertisement::showAdvertise(26);?>
                </div>
            </div>
        </div>
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
</div>
<div id="tworight">
     <?php
    $this->widget('RecentView',array("cssType"=>"residenceIndex"));
    ?>
    <div class="rt_ader">
        <?=Advertisement::showAdvertise(21);?>
    </div>
    <div class="w273"> <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border">
            <div class="orange_title"> 上海房价行情</div>
            <div class="c"></div>
            <div class="qx_images"><img src="<?php
                if(file_exists(PIC_PATH.'/attachment/housing_trends.gif'))
                    echo PIC_URL.'/attachment/housing_trends.gif';
                else
                    echo IMAGE_URL.'/4.gif';
                ?>" title="上海本月房价走势" alt="上海本月房价走势" /></div>
        </div>
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b> </div>
        <!-- 投放GOOGLE广告联盟的广告-->
         <div class="w273"> <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
             <div class="border">
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
<div class="tc_ader" id="floatad-winpop" style="z-index: 9999; right: 0pt;  bottom: 0pt; _bottom:auto; overflow: hidden; position: fixed;_position:absolute;_top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0)));">
	<div class="tc_ader_top">
		<div class="logo"><img src="/images/llogo.gif" height="60" width="80" /></div>
		<div class="lg_tit">
			<div class="tc_close" id="close_tc"><img src="/images/tc_close.gif" /></div>
			<p>全景看房很给力！</p>
            <ul id="tc_bar">
				<li class="red_bg"><a href="">今日关注</a></li>
				<li><a href="">写字楼</a></li>
				<li><a href="">商 铺</a></li>
				<li><a href="">住 宅</a></li>
			</ul>
		</div>
	</div>
    <div class="tc_ader_cont" id="tc_ader_content">
<?php
//$adpModel = Advpop::getAdvpopByPosition(1);
for($i=1;$i<5;$i++){
    $adpModel = Advpop::getAdvpopByPosition($i);
    $c = count($adpModel);
    if($c == 1){ ?>
        <div class="tc_ader_ct" style="display: none;">
            <a href="<?php echo empty($adpModel[0]->adp_linkurl)?'#':$adpModel[0]->adp_linkurl ?>"><img src="<?php echo  PIC_URL.$adpModel[0]->adp_picurl.'?r='.$adpModel[0]->adp_uploadtime?>" height="210" width="329" /></a>
        </div>
    <?php } elseif($c>1) { ?>
        <div class="tc_ader_ct" style="display: none;">
			<div class="tcad_side" style="border-right:1px dashed #999999;">
                <a href="<?php echo empty($adpModel[0]->adp_linkurl)?'#':$adpModel[0]->adp_linkurl ?>"><img src="<?php echo  PIC_URL.$adpModel[0]->adp_picurl.'?r='.$adpModel[0]->adp_uploadtime?>" height="200" width="150" /></a>
            </div>
			<div class="tcad_side">
                <a href="<?php echo empty($adpModel[1]->adp_linkurl)?'#':$adpModel[1]->adp_linkurl ?>"><img src="<?php echo  PIC_URL.$adpModel[1]->adp_picurl.'?r='.$adpModel[0]->adp_uploadtime?>" height="200" width="150" /></a>
            </div>
		</div>
<?php    }
}
?>
	</div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/communityIndex.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/shipinnav.js"></script>
<script type="text/javascript">
    function ChangeIndexScroll(obj){
        var mainXml = $(obj).attr("mainXml");
        changePanoXml(mainXml);
    }
</script>
 <?php $this->endCache();
} ?>