<link href="/css/adjustsearch.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="/css/seardetail.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" />
<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
$this->breadcrumbs = array(
    '经纪人'
);
?>
<style type="text/css">
.area{ word-wrap: normal; width: 640px; margin-left: 40px;}
.area span { float:left; padding-right: 20px;}
.tuijian_desc{ width:100px; height: 20px; line-height: 20px; text-align: center;}
.loupan_onelinerightboxone {width:100%;	overflow:hidden;}
.serachbox {margin-bottom: 10px; _margin-bottom:0; _padding-bottom:0;}
.pager{clear: both;}
.submit_bg {position: relative;	text-align: center;	top:2px;top:13px\9;	top:12px\0;	*top:2px;_top:4px;	width: 111px;}
	@media screen and (-webkit-min-device-pixel-ratio:0) {
		.submit_bg {padding-top:12px;position:relative;	top:6px;}
	}
.loupan_onelinerightbox{padding:0 12px 20px;}
ul.yiiPager a:link, ul.yiiPager a:visited{_padding:1px 4px;}
    ul.yiiPager .selected{background:none;}

</style>
<div class="detail">
    <?php
        $this->widget('SearchMenu', array(
            'showMenu' => array(1,9), //显示的条件
            'url' => "uagent/showuagent", //url
            "sourceType"=>2,
        ));
    ?>
    </div>
<div id="header" class="clear"></div>
<div style="float:left;width:718px;background-color: white">
    
    <div class="clear"></div>
    <div>
        <?php
            $allSource = $dataProvider->getData();
            foreach($allSource as $data) {
                $this->renderPartial('_listView', array('data'=>$data));
            }
            echo "<div style='clear:both; height:35px; padding-top:15px;'>";
            $this->widget('CLinkPager',array(
                    'pages'=>$dataProvider->pagination,
                    "htmlOptions"=>array("style"=>"float:right"),
            ));
            echo "</div>";
        ?>
    </div>
</div>

<?php
if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration']))) {
    ?>
<div style="float:right;width:265px;background-color: white;">
    <div class="loupan_onelinerightlineone"></div>
    <div class="loupan_onelinerightbox" style="height:auto;">
        <div class="loupan_onelinerighttitle">
            <strong>最新加入经纪人</strong>
        </div>
        <ul class="serach_moreulone" style="width:236px;">
            <li class="morelione">经纪人</li>
            <li class="morelitwo">公司名称</li>
        </ul>
        <div class="clear"></div>
        <div style="height:120px;width:230px; padding-top: 10px;">
            <?php
                if($newAgentList && array_key_exists(0, $newAgentList)){
                $detail = $newAgentList[0];
            ?>
                <table>
                    <tr>
                        <td rowspan="5" style="padding-right:12px;">
                            <?=CHtml::link(CHtml::image(User::model()->getUserHeadPic($detail->ua_uid, "_normal"),"",array("width"=>"80","height"=>"100","class"=>"img_border")),array("/viewuagent/index",'uaid'=>$detail->ua_id));?>
                        </td>
                        <td>
                            <?=Uagent::model()->getCompanyByUaid($detail,27);?>
                        </td>
                    </tr>
                    <tr>
                        <td><?=CHtml::link(common::strCut($detail['ua_realname'],12),array("/viewuagent/index",'uaid'=>$detail->ua_id));?></td>
                    </tr>
                    <tr>
                        <td>区域：<?php echo $detail->region['re_name']; ?></td>
                    </tr>
                    <tr>
                        <td>电话：<?=$detail->userInfo['user_tel']; ?></td>
                    </tr>
                    <tr>
                        <td>注册时间：<?=date("Y-m-d", $detail->userInfo['user_regtime']);?></td>
                    </tr>
                </table>
            <?php
                }
            ?>
        </div>
        <div class="loupan_onelinerightboxone clearfix">
            <?php
               if($newAgentList){
                    $agentList = $newAgentList;
                    unset($agentList[0]);
                    foreach($agentList as $k=>$v){
            ?>
                <ul class="serach_moreultwo">
                    <li class="morelione"><?=CHtml::link($v['ua_realname'],array("/viewuagent/index",'uaid'=>$v->ua_id));?>&nbsp;</li>
                    <li class="morelitwo" style="text-align:left;width: 70px;overflow:hidden"><?=Uagent::model()->getCompanyByUaid($v,15);?></li>
                </ul>
            <?php
                    }
                }
            ?>
        </div>
    </div>
    <div class="loupan_onelinerightlinetwo"></div>
    
    <div class="loupan_onelinerightlineone"></div>
    <div class="loupan_onelinerightbox" style="height:auto;">
        <div class="loupan_onelinerighttitle">
            <strong>总积分排行榜</strong>
        </div>
        <ul class="serach_moreulone" style="width:236px;">
            <li class="morelione">经纪人</li>
            <li class="morelitwo">积分数</li>
        </ul>
        <div class="loupan_onelinerightboxone clearfix">
            <?php
                if($sortAgentInfo!=null){
                    foreach($sortAgentInfo as $key=>$v){
            ?>
                <ul class="serach_moreultwo">
                    <li class="morelione"><?=CHtml::link($v['ua_realname'],array("/viewuagent/index",'uaid'=>$v['ua_id']));?></li>
                    <li><b><?=Userproperty::model()->getUserPoint($v['ua_uid'])?></b></li>
                </ul>
            <?php 	}
                }
         
            ?>
        </div>
    </div>
    <div class="loupan_onelinerightlinetwo"></div>

   <div style="width:259px; margin-left:-1px!important;_margin-left:0px;">
        <div class="serach_rightlinefive" style="margin-top:0px;"></div>
        <div class="serach_rightboxtwo" style="padding-bottom:0;">
            <h2>中介公司推荐</h2>
            <div class="c"></div>
        <div class="qjlp_images" style="width:251px;" >
            <?php
            $headPicNormArr=Ucom::$headPicNorm[2];
            if(!empty($recommendcompany)){
                foreach($recommendcompany as $key=>$value){
            ?>
            <div style="width: 100px;float: left;margin: 5px 12px; _margin: 5px 10px;*+height:110px;_height: 110px;overflow: hidden;">
                <a href="<?php echo Yii::app()->createUrl("/viewucom/index",array("ucid"=>$value->user->companyinfo->uc_id)); ?>" target="_blank">
                    <?=CHtml::image(User::model()->getUserHeadPic($value->user->user_id),"",array("class"=>"img_border","width"=>"100px","height"=>"100px"));?>
                </a><br/>
                <div class="tuijian_desc"><?=CHtml::link(common::strCut($value->user->companyinfo->uc_fullname, 21),array("/viewucom/index","ucid"=>$value->user->companyinfo->uc_id),array("title"=>$value->user->companyinfo->uc_fullname));?></div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="serach_rightlinefour"></div>
    </div>
</div>
    <?php $this->endCache();
} ?>