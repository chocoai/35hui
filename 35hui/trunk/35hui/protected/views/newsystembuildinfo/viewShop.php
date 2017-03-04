<?php
$sbi_city = Region::model()->getNameById($model->sbi_city);
$sbi_district = Region::model()->getNameById($model->sbi_district);
$sbi_section = Region::model()->getNameById($model->sbi_section);
$sbi_buildingname = $model->sbi_buildingname;
$keywords = $sbi_city.$sbi_buildingname.','.$sbi_buildingname.'商铺转让,'.$sbi_buildingname.'商铺出租,360°全景看房';
$description='找'.$sbi_city.'商铺转让和商铺出租,'.$sbi_city.'360°全景看房，就在新地标全景看房。';
$description.=$sbi_city.$sbi_district.$sbi_section.'/'.$sbi_buildingname.'最新转让商铺和出租商铺查询就上新地标。';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $keywords.' - 新地标';
?>
<link rel="stylesheet" type="text/css" href="/css/main.css" />
<link rel="stylesheet" type="text/css" href="/css/index.css" />
<link rel="stylesheet" type="text/css" href="/css/global.css" />
<link rel="stylesheet" type="text/css" href="/css/pu.css" />
<link rel="stylesheet" type="text/css" href="/css/adjustsearch.css"/>
<style type="text/css">
    .qs_list LI { TEXT-ALIGN:left; LINE-HEIGHT:24px; LIST-STYLE-TYPE:none; PADDING-LEFT:18px; DISPLAY:inline; BACKGROUND:url(images/libg.gif) 0 -34px no-repeat scroll transparent; FLOAT:left; HEIGHT:24px;  MARGIN-LEFT:10px; LIST-STYLE-IMAGE:none }
    .banner { margin-bottom:10px;}
    .threeline_boxleftone {background:url(images/leftbg1.jpg) repeat-x scroll 0 0 transparent; margin-top:-3px; padding:0px 0px 12px 14px; float:left; width:701px; color:#2F2F2F; }
    .serachbox { background:url(images/leftbg2.jpg) repeat-x scroll 0 0 transparent; float: left; height: 51px; overflow: hidden; width: 718px;}
    .center{text-align:left;}
    .loupan_onelinerightbox { margin: -5px 0 0;}
    table span{color:#FFF; padding-left:15px; font-weight:bold; padding-top:12px; padding-bottom:2px; display:block;}
    .loupaninfo_fivelinebulone li.one { float: left; padding: 0; text-align: center; width: 80px; }
    .serach_moreultwo .morelithree{text-align: left;}
    textarea {margin-top: 15px;}
    .pager .yiiPager li.selected{background: none;}
    .list-view .pager{ margin: 5px 4px 0 0; text-align: right; clear: both; float: right; }
    ul.yiiPager a:link,
    ul.yiiPager a:visited{ border:solid 1px #9aafe5; font-weight:bold; color:#0e509e; padding:2px 6px;  *padding:1px 6px!important;  height:21px; line-height:21px; text-decoration:none; }
    .wygl{width: 49%; float: left;   margin-left:0px\0;*+margin-left:-0px;}
    @media screen and (-webkit-min-device-pixel-ratio:0){ .wygl{width: 49%; float: left; margin-left: 0pt;}} }
    .loupaninfo_threelineboxtwo{border:none; margin-top:0;}
    .wyglcompany{position:relative; left:-130px; *+left:-85px; _left:-90px;}
    @media screen and (-webkit-min-device-pixel-ratio:0){ .wyglcompany{position:relative; left:0px;}} }
</style>

<div class="center">

    <?php
    $this->breadcrumbs=array(
            '商业广场'=>array('systembuildinginfo/shopIndex'),
            "搜索"=>array("shopbuildlist"),
            $model->sbi_buildingname,
    );
    ?>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/meigong/main.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/magicDiv.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/scrollable-horizontal.css" />
    <script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/jquery.tools.min.js"></script>
    <div id="twitterPost" style="display:none;">
        <table border="0" cellpadding="0" cellspacing="0" width="350">
            <tbody>
                <tr>
                    <td width="350">
                        <table border="0" cellpadding="0" cellspacing="0" width="350px">
                            <tr>
                                <td><img src="/images/dialog_lt.png" width="13" height="33" /></td>
                                <td background="/images/dialog_ct.png" width="326px"><span>播报微博内容</span></td>
                                <td width="13px"><img src="/images/dialog_rt.png" width="13" height="33" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="350px">
                            <tr>
                                <td background="/images/dialog_mlt.png" width="13px"></td>
                                <td bgcolor="#FFFFFF">
                                    <table border="0" cellpadding="0" cellspacing="0" style="margin-left:13px; margin-right:13px;line-height: 30px" width="100%">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"><textarea id="twitter" name="content" cols="40" rows="7"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="button" value="提交" onclick="submitTwitter()">&nbsp;&nbsp;
                                                    <input type="button" value="取消" onclick="magicDivOpenStart('twitterPost',500,300,700,500);">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="20px"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td background="/images/dialog_mrb.png" width="13px"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="350px" style="margin:0; padding:0">
                            <tr>
                                <td><img src="/images/dialog_lb.png" width="13" height="13" /></td>
                                <td background="/images/dialog_cb.png" width="100%"></td>
                                <td><img src="/images/dialog_rb.png" width="13" height="13" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="serror" style="display: none;">
        <form>
            <table border="0" cellpadding="0" cellspacing="0" width="350">
                <tbody>
                    <tr>
                        <td width="350">
                            <table border="0" cellpadding="0" cellspacing="0" width="350px">
                                <tr>
                                    <td><img src="/images/dialog_lt.png" width="13" height="33" /></td>
                                    <td background="/images/dialog_ct.png" width="326px"><span>请简单描述出错条目与更正信息</span></td>
                                    <td width="13px"><img src="/images/dialog_rt.png" width="13" height="33" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" width="350px">
                                <tr>
                                    <td background="/images/dialog_mlt.png" width="13px"></td>
                                    <td bgcolor="#FFFFFF">
                                        <table border="0" cellpadding="0" cellspacing="0" style="margin-left:13px; margin-right:13px;line-height: 30px" width="100%">
                                            <tbody><?PHP if(isset(Yii::app()->user->id)&&!empty(Yii::app()->user->id)) { ?>
                                                <tr>
                                                    <td colspan="2" style="padding-top:10px;"><textarea id="content" name="econtent"  cols="40" rows="5" onblur="hintAction(this,false)" onfocus="hintAction(this,true)">例如：开发商信息有误，应该是某某公司</textarea></td>
                                                </tr>

                                                <tr><td colspan="2"><?php if(extension_loaded('gd')): ?>
                                                                <?php $this->widget('CCaptcha'); ?>
                                                            <?php endif;?></td></tr>
                                                <tr><td colspan="2"><input type="text" id="verifyCode" name="verifyCode"></td></tr>
                                                <tr>
                                                    <td colspan="2"><input type="hidden" name="buildId" value="<?php echo $_GET['id'];?>"/><input type="button" onclick="sub()" value="立即‘揪’错"/>&nbsp;&nbsp;<input type="button" onclick="magicDivOpenStart('serror',350,300,500,400);" value="取消‘揪’错"/></td>
                                                </tr>
                                                <tr>
                                                    <td height="20px"></td>
                                                </tr>
                                                    <?php } else { ?>

                                                <tr>
                                                    <td align="center" height="150">
														您没有登录，请先<a href="/site/login" class="blue">登录</a>,或<a href="###" onclick="magicDivOpenStart('serror',350,300,500,400);" class="blue">取消</a>！
                                                    </td>
                                                </tr>
                                                    <?php } ?>
                                            </tbody>

                                        </table>
                                    </td>
                                    <td background="/images/dialog_mrb.png" width="13px"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" width="350px" style="margin:0; padding:0">
                                <tr>
                                    <td><img src="/images/dialog_lb.png" width="13" height="13" /></td>
                                    <td background="/images/dialog_cb.png" width="100%"></td>
                                    <td><img src="/images/dialog_rb.png" width="13" height="13" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <!--content start-->
    <div class="clearfix"  style="width:1003px;margin:0px auto; padding-top:4px; overflow:hidden;">
        <!--oneline start-->
        <div class="clearfix">
            <div class="loupaninfo_top">
                <h1><?=$model->sbi_buildingname?></h1>

            </div>
            <div class="loupaninfo_middle clearfix">
                <div class="loupaninfo_middleadddian clearfix" style="height:580px;">
                    <div class="loupaninfo_middleleft">
                        <div id="buildindexpanorama" style="height:329px; overflow:hidden;">
                        <?php $url = Picture::model()->getPicByTitleInt($model->sbi_titlepic);
                        echo '<div class="lpdivbg" style="overflow:hidden; position:relative; display:table-cell; text-align:center; vertical-align:middle; width:'.(intval(Systembuildinginfo::$pictureNorm[1]['width'])+10).'px;height:'.(intval(Systembuildinginfo::$pictureNorm[1]['height'])+10).'px; line-height:'.(intval(Systembuildinginfo::$pictureNorm[1]['height'])+10).'px; font-size:'.(intval(Systembuildinginfo::$pictureNorm[1]['height'])+10).'px;"><p style="position:static;  top:50%;"><img src="'.$url.'" alt="'.$model->sbi_buildingname.'" style="position:static;  top:-60%; left:-60%;" /></p></div>';?>
                    </div>
                        <div class="clear"></div>
                        <div style="position:absolute;width:546px;padding-bottom: 10px;z-index: 5;background-color: #daebf3; margin-top:80px; _margin-top:-10px;">
                            <dl class="loupaninfo_middledl">
                                <dt>请点击选择您对该楼盘的印象，或自己写一个</dt>
                                <dd id="label" style="background-color: #daebf3">
                                    <?
                                    if($impressions) {
                                        foreach($impressions as $impression) {
                                            echo "<a href='#_self' onclick='addPro(".$impression->im_id.")' title='".CHtml::encode($impression->im_description)."'>".common::strCut(CHtml::encode($impression->im_description),10)."</a>";
                                        }
                                    }else {
                                        echo '<font color="gray"><i>暂无印象</i></font>';
                                    }
                                    ?>
                                </dd>
                            </dl>
                            <p class="loupaninfo_palink"><a id="showmore"  href="#_self" style="cursor:pointer" onclick="showMore()">更多↓</a></p>
                            <?php echo $this->renderPartial('/impression/_form', array('model'=>$newImpression)); ?>
                        </div>
                    </div>
                    <?php
                    if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration'],'varyByParam'=>array("id")))) {
                        ?>

                    <dl class="loupaninfo_right">
                        <dt class="lp">楼盘动态</dt>
                            <?
                            if(!Yii::app()->user->isGuest) {
                                ?>
                       <a href="<?php echo Yii::app()->createUrl("/twittersuggest/index",array('type'=>1,'id'=>$model->sbi_buildingid)); ?>" style="position:absolute; left: 740px; top:15px; left:700px\9; top: 12px\9; top:14px\0; _left: 130px; _top: 12px; font-weight: normal;" class="blue">播报</a>
                                <?  } ?>
                        <dd style="border-bottom:none;"><font style="padding-top:0px;color:#63c44a;" title="<?=$twitterMessage;?>"><?=$twitterMessage?'"'.CHtml::encode(common::strCut($twitterMessage, 150)).'"':"<span style='color:gray'><i>暂无动态</i></span>";?></font></dd>

                        <dt style="margin-top:0;">基本信息 <?=CHtml::link("完善与纠错",array("/correction/index","type"=>1,"id"=>$model->sbi_buildingid),array("target"=>"_blank","class"=>"blue"));?></dt>
                        

                        <dd>
							商业广场地址：<code><?=CHtml::encode($model->sbi_address)?></code><br />
							所属板块：<code><?=CHtml::encode(Region::model()->getNameById($model->sbi_district).Region::model()->getNameById($model->sbi_section))?></code>
                        </dd>
                        <dd>
                            <span style="width:60%;">平均租金：<code style="color:#e86114; font-weight:bold; font-size: 13px;"><?=$model->sbi_avgrentprice>0?CHtml::encode($model->sbi_avgrentprice)."元/平米·天":"暂无资料"?></code></span>
                            <span style="width:38%">在租：<code><?=CHtml::link('共<b style="color:#e86114; font-size:13px;">'.CHtml::encode(Systembuildinginfo::model()->getRentNums($model->sbi_buildingid,2)).'套</b>房源',array("systembuildinginfo/shopviewrentmore","id"=>$model->sbi_buildingid),array('target'=>'_blank'));?></code></span>
                            <span style="width:60%;">平均售价：<code style="color:#e86114; font-weight: bold; font-size: 13px;"><?=$model->sbi_avgsellprice>0?$model->sbi_avgsellprice."元/平米":"暂无资料"?></code></span>
                            <span style="width:38%">在售：<code><?=CHtml::link('共<b style="color:#e86114; font-size:13px;">'.CHtml::encode(Systembuildinginfo::model()->getSellNums($model->sbi_buildingid,2)).'套</b>房源',array("systembuildinginfo/shopviewsalemore","id"=>$model->sbi_buildingid),array('target'=>'_blank'));?></code></span>
                        </dd>
                        <dd>
							开发商：<code><?=$model->sbi_developer?CHtml::encode($model->sbi_developer):"暂无资料";?></code>
                        </dd>
                        <dd>
                            <div style="width:100%; margin-bottom: 0px; margin-bottom: 0\0; height: 30px;">
                                <div style="float:left; width:45px; margin-top: 3px; margin-top: 5px\0;">评价：</div>
                                    <?php
                                    $starsNum = Systembuildinginfo::model()->getAvgStar($model->sbi_buildingid);
                                    if($starsNum) {
                                        echo "<div style='float:left; margin-top:8px; margin-top:11px\9; margin-bottom:-10px;*+margin-left:-55px; _height:16px; _overflow:hidden;'>".common::getStar($starsNum,10,'<div class="renshu">('.$commentCount.'人参与'.')</div>')."</div>";
                                    }else {
                                        echo "<div style='height:28px; line-height:35px; color:#377DA1;'>暂无资料</div>";
                                    }
                                    ?>
                            </div>
                            <div class="jibie">物业级别：<code><?=CHtml::encode($model->sbi_propertydegree?Systembuildinginfo::model()->propertyIntToDescribe($model->sbi_propertydegree):"暂无资料")?></code></div>
                            <div class="time">物业管理费：<code><?=CHtml::encode($model->sbi_propertyprice?$model->sbi_propertyprice."元/平米·月":"暂无资料")?></code></div>
                        </dd>
                        <dd style=""><div class="wyglcompany">物业管理公司：<code><?=CHtml::encode($model->sbi_propertyname?$model->sbi_propertyname:'暂无资料')?></code></div></dd>
                        <dd>物业电话：<code><?=CHtml::encode($model->sbi_propertytel?$model->sbi_propertytel:'暂无资料')?></code></dd>
                        <dd>
                            <div class="wygl">开盘时间：<code><?=$model->sbi_openingtime?date('Y年m月d日',$model->sbi_openingtime):"暂无资料"?></code></div>
                            <div>是否涉外：<code><?=$model->sbi_foreign==1?"是":"否"?></code></div>
                        </dd>
                        <dd>临近轨道：
                                <?
                                if($model->sbi_busway) {
                                    $trainWays = explode(",",$model->sbi_busway);
                                    foreach($trainWays as $way) {
                                        echo "<code>".CHtml::encode($way)."号线</code>&nbsp;&nbsp;";
                                    }
                                }else {
                                    echo "<code>暂无资料</code>";
                                }
                                ?>
                        </dd>
                        <!--<dd>
							项目特色：
                            <code><?=$model->sbi_tag?CHtml::encode($model->sbi_tag):"暂无资料";?></code>
                        </dd>-->
                                                        <dd style="border-bottom:0;">
                        <table border="0" cellpadding="0" cellspacing="0" style="height:48px;">
                            <tr>
                                <td style="width:60px; text-align:left; padding-top:7px;"><img src="/images/iphone.gif" style="display:block; float:left;"/></td>
                                <td height="49px"><table border="0" cellpadding="0" cellspacing="0">
                                        <tr><td>新地标提供的本楼盘租售信息咨询电话：</td></tr>
                                        <tr><td style="font-size:24px; font-weight:bold;"><?=CHtml::encode($model->sbi_tel?$model->sbi_tel:'暂无资料');?></td></tr>
                                        <tr><td>联系我时请说是在新地标看到的，谢谢！</td></tr>
                                    </table></td>
                            </tr>
                        </table>
                    </dd>
                            <?php
                            if($model->sbi_tel) {
                                ?>
                                <?php
                            }
                            ?>
                    </dl>
                </div>
            </div>
            <div class="loupaninfo_bottom"></div>
        </div>
        <!--oneline end-->

        <!-- 全景模块 开始 -->
            <?php
            if(Panoxml::model()->checkHavePano($model->sbi_buildingid, 1)) {
                $this->renderPartial('_panorama', array(
                    "mainXml"=>Panoxml::model()->getPanoXml($model->sbi_buildingid, 1),
                    ));
                }
            ?>
        <!-- 全景模块 结束 -->
        <!--twoline start-->

        <div class="clearfix">

            <div class="loupan_left">
                <div class="loupan_twolineoneline"></div>
                <div class="loupan_twoleftbox">
                    <ul class="loupan_twoleftulone">
                        <li class="one">详细信息</li>
                        <li class="two" id="louright1" onClick="louturnit(1,7);"><strong>商业广场介绍</strong></li>
                        <li class="three" id="louright2" onClick="louturnit(2,7);"><strong>周边配套</strong></li>
                        <li class="three" id="louright3" onClick="louturnit(3,7);"><strong>交通配套</strong></li>
                        <li class="three" id="louright4" onClick="louturnit(4,7);"><strong>建材装修</strong></li>
                        <li class="three" id="louright5" onClick="louturnit(5,7);"><strong>楼层状况</strong></li>
                        <li class="three" id="louright6" onClick="louturnit(6,7);"><strong>车位信息</strong></li>
                        <li class="three" id="louright7" onClick="louturnit(7,7);"><strong>相关信息</strong></li>
                    </ul>
                    <div class="loupan_twoleftboxtwo">
                        <div id="lourightChild1"  class="nohidden">
                            <div class="loupaninfo_twolinebox">
                                    <?php echo Keywordlink::model()->regContentByAllKeyword($model->sbi_buildingintroduce); ?>
                            </div>
                        </div>

                        <div id="lourightChild2"  class="hidden">
                            <div class="loupaninfo_twolinebox">
                                    <?=$model->sbi_peripheral?>
                            </div>
                        </div>

                        <div id="lourightChild3"  class="hidden">
                            <div class="loupaninfo_twolinebox">
                                    <?=$model->sbi_traffic?>
                            </div>
                        </div>

                        <div id="lourightChild4"  class="hidden">
                            <div class="loupaninfo_twolinebox">
                                    <?=$model->sbi_decoration?>
                            </div>
                        </div>

                        <div id="lourightChild5"  class="hidden">
                            <div class="loupaninfo_twolinebox">
                                    <?=$model->sbi_floorinformation?>
                            </div>
                        </div>

                        <div id="lourightChild6"  class="hidden">
                            <div class="loupaninfo_twolinebox">
                                    <?=$model->sbi_parkinginformation?>
                            </div>
                        </div>

                        <div id="lourightChild7"  class="hidden">
                            <div class="loupaninfo_twolinebox">
                                    <?=$model->sbi_otherinformation?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="loupan_twolinetwoline"></div>

            </div>
            <div class="loupan_onelineright loupaninfo_add">
                <div class="loupan_onelinerightlineone"></div>
                <div class="loupan_onelinerightbox clearfix" >
                    <div class="loupan_onelinerighttitle"><strong>周边商铺</strong><a href="<?=Yii::app()->createUrl("/shop/rentIndex");?>" class="showblue">更多&gt;&gt;</a></div>
                    <ul class="serach_moreulone">
                        <li class="morelione">商铺名称</li>
                        <li class="morelithree">平均租金</li>
                    </ul>

                        <?php
                        if(!empty($nearBuild)) {
                            foreach($nearBuild as $value) {
                                ?>
                    <ul class="serach_moreultwo">
                        <li class="morelione"><a href="<?php
                                        echo Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$value->sbi_buildingid));
                                                             ?>" target="_blank"><?=common::strCut($value->sbi_buildingname, 18);?>&nbsp;</a></li>
                        <li class="morelithree"><?=$value->sbi_avgrentprice>0?$value->sbi_avgrentprice."元/平米·天":"暂无数据";?></li>
                    </ul>
                                <?php
                            }
                        }
                        ?>
                </div>
                <div class="loupan_onelinerightlinetwo"></div>
            </div>
        </div>
        <!--twoline end-->

        <!--threeline start-->
        <style type="text/css">
            li.two{margin-left: 0px;}
        </style>
        <div class="loupaninfo_threelinebox clearfix">
            <div class="loupaninfo_threelineboxone clearfix">
                <ul class="loupaninfo_threelineulone">
                    <li class="one"  id="loucright1" onClick="loucturnit(1);"><img src="/images/loupanicon02.jpg" />地&nbsp;&nbsp;图</li>
                        <?php
                        if($pictures[Picture::$picType['ichnograph']]) {
                            echo '<li class="two"  id="loucright2" onClick="loucturnit(2);"><img src="/images/loupanicon03.jpg" />平面图</li>';
                        }
                        if($pictures[Picture::$picType['outdoor']]) {
                            echo '<li class="two"  id="loucright3" onClick="loucturnit(3);"><img src="/images/loupanicon04.jpg" />外景图</li>';
                        }
                        if($pictures[Picture::$picType['indoor']]) {
                            echo '<li class="two"  id="loucright4" onClick="loucturnit(4);"><img src="/images/loupanicon05.jpg" />内景图</li>';
                        }
                        ?>
                </ul>

                <div class="loupaninfo_threelineboxtwo" style="width:100%">

                    <div id="loucrightChild1"  class="nohidden">
                            <?php
                            $this->widget('ShowSmallMap',array(
                                    'x'=>$model->sbi_x,
                                    'y'=>$model->sbi_y,
                                    'name'=>$model->sbi_buildingname,
                                    'width'=>"100%",
                                    'height'=>"200px",
                                    'type'=>"all",
                            ));
                            ?>
                    </div>
                        <?php
                        if($pictures[Picture::$picType['ichnograph']]) {
                            ?>
                    <div id="loucrightChild2"  class="hidden">
                                <?
                                $typePictures = $pictures[Picture::$picType['ichnograph']];
                                $pic_len = count($typePictures)>4?4:count($typePictures);
                                echo '<ul class="loupan_twoleftulone" style="height:19px;"><li class="four" style="margin-top:-6px;">';
                                echo CHtml::link("更多>>",array('picture/gridshow','sId'=>$model->sbi_buildingid,'sType'=>Picture::$sourceType['systembuilding'],'pType'=>Picture::$picType['ichnograph']));
                                echo '</li></ul>';
                                ?>
                        <ul class="pictureGrid" style="width: 910px; padding-left: 10px;">
                                    <?
                                    for($i=0;$i<$pic_len;$i++) {
                                        echo "<li><a href='".Yii::app()->createUrl('picture/gridshow',array('sId'=>$model->sbi_buildingid,'sType'=>Picture::$sourceType['systembuilding'],'pType'=>Picture::$picType['ichnograph'],'pId'=>$typePictures[$i]['p_id']))."'>";
                                        echo CHtml::image(PIC_URL.Picture::showStandPic($typePictures[$i]['p_img'],"_normal"),$model->sbi_buildingname,array('style'=>'width:195px;height:130px;','class'=>'img_border'));
                                        echo "</a></li>";
                                    }
                                    ?>
                        </ul>
                    </div>
                            <?php
                        }
                        ?>

                        <?php
                        if($pictures[Picture::$picType['outdoor']]) {
                            ?>
                    <div id="loucrightChild3"  class="hidden">
                                <?
                                $typePictures = $pictures[Picture::$picType['outdoor']];
                                $pic_len = count($typePictures)>4?4:count($typePictures);
                                echo '<ul class="loupan_twoleftulone" style="height:19px;"><li class="four" style="margin-top:-6px;">';
                                echo CHtml::link("更多>>",array('picture/gridshow','sId'=>$model->sbi_buildingid,'sType'=>Picture::$sourceType['systembuilding'],'pType'=>Picture::$picType['outdoor']));
                                echo '</li></ul>';
                                ?>
                        <ul class="pictureGrid" style="width:910px; padding-left: 10px;">
                                    <?
                                    for($i=0;$i<$pic_len;$i++) {
                                        echo "<li><a href='".Yii::app()->createUrl('picture/gridshow',array('sId'=>$model->sbi_buildingid,'sType'=>Picture::$sourceType['systembuilding'],'pType'=>Picture::$picType['outdoor'],'pId'=>$typePictures[$i]['p_id']))."'>";
                                        echo CHtml::image(PIC_URL.Picture::showStandPic($typePictures[$i]['p_img'],"_normal"),$model->sbi_buildingname,array('style'=>'width:195px;height:130px;','class'=>'img_border'));
                                        echo "</a></li>";
                                    }
                                    ?>
                        </ul>
                    </div>
                            <?php
                        }
                        ?>

                        <?php
                        if($pictures[Picture::$picType['indoor']]) {
                            ?>
                    <div id="loucrightChild4"  class="hidden">
                                <?
                                $typePictures = $pictures[Picture::$picType['indoor']];
                                $pic_len = count($typePictures)>4?4:count($typePictures);
                                echo '<ul class="loupan_twoleftulone" style="height:19px;"><li class="four" style="margin-top:-6px;">';
                                echo CHtml::link("更多>>",array('picture/gridshow','sId'=>$model->sbi_buildingid,'sType'=>Picture::$sourceType['systembuilding'],'pType'=>Picture::$picType['indoor']));
                                echo '</li></ul>';
                                ?>
                        <ul class="pictureGrid" style="width:910px; padding-left: 10px;">
                                    <?
                                    for($i=0;$i<$pic_len;$i++) {
                                        echo "<li><a href='".Yii::app()->createUrl('picture/gridshow',array('sId'=>$model->sbi_buildingid,'sType'=>Picture::$sourceType['systembuilding'],'pType'=>Picture::$picType['indoor'],'pId'=>$typePictures[$i]['p_id']))."'>";
                                        echo CHtml::image(PIC_URL.Picture::showStandPic($typePictures[$i]['p_img'],"_normal"),$model->sbi_buildingname,array('style'=>'width:195px;height:130px;','class'=>'img_border'));
                                        echo "</a></li>";
                                    }
                                    ?>
                        </ul>
                    </div>
                            <?php
                        }
                        ?>

                </div>
            </div>
            <div class="loupaninfo_threelineline"></div>
        </div>
        <!--threeline end-->


        <!--fourline start-->
        <div class="clearfix">
            <div class="loupaninfo_fourlinebox">
                <div class="loupaninfo_fourlineone"></div>
                <div class="loupaninfo_fourlineboxtwo clearfix">

                    <ul class="loupan_twoleftulone">
                        <li class="one">此楼热租商铺</li>
                        <li class="four"><?=CHtml::link("更多&gt;&gt;",array("systembuildinginfo/shopviewrentmore","id"=>$model->sbi_buildingid),array('target'=>'_blank'));?></li>
                    </ul>
                    <ul class="serach_moreulone">
                        <li class="morelione">商铺名称</li>
                        <li class="morelitwo">面积</li>
                        <li class="morelithree">价格</li>
                    </ul>
                        <?php
                        if(!empty($shopinfo_rent)) {
                            foreach($shopinfo_rent as $key=>$value) {
                                ?>
                    <ul class="serach_moreultwo" style="width:auto;">
                        <li class="morelione"><?=CHtml::link($value->presentInfo->sp_shoptitle,array("shop/view","id"=>$value->sb_shopid),array('target'=>"_blank"));?></li>
                        <li class="morelitwo"><?php echo $value->sb_shoparea?$value->sb_shoparea.'㎡':'';?></li>
                        <li class="morelithree"><?php echo $value->rentInfo['sr_rentprice']?'￥'.$value->rentInfo['sr_rentprice']:'';?></li>
                    </ul>
                                <?php
                            }
                        }
                        ?>
                </div>
                <div class="loupaninfo_fourlinetwo"></div>
            </div>
            <div class="loupaninfo_fourlinebox" style="float:right;">
                <div class="loupaninfo_fourlineone"></div>
                <div class="loupaninfo_fourlineboxtwo clearfix">

                    <ul class="loupan_twoleftulone">
                        <li class="one">此楼热销商铺</li>
                        <li class="four"><?=CHtml::link("更多&gt;&gt;",array("systembuildinginfo/shopviewsalemore","id"=>$model->sbi_buildingid),array('target'=>'_blank'));?></li>
                    </ul>

                    <ul class="serach_moreulone">
                        <li class="morelione">商铺名称</li>
                        <li class="morelitwo">面积</li>
                        <li class="morelithree">价格</li>
                    </ul>
                        <?php
                        if(!empty($shopinfo_sell)) {
                            foreach($shopinfo_sell as $key=>$value) {
                                ?>
                    <ul class="serach_moreultwo" style="width:auto;">
                        <li class="morelione"><a href="<?php echo Yii::app()->createUrl("shop/view",array("id"=>$value->sb_shopid));?>" target="_blank"><?php echo common::strCut($value->presentInfo->sp_shoptitle,36); ?></a></li>
                        <li class="morelitwo"><?php echo $value->sb_shoparea?$value->sb_shoparea.'㎡':'';?></li>
                        <li class="morelithree"><?php echo $value->sellInfo['ss_sumprice']?'￥'.$value->sellInfo['ss_sumprice']:'';?></li>
                    </ul>
                                <?php
                            }
                        }
                        ?>
                </div>
                <div class="loupaninfo_fourlinetwo"></div>
            </div>
        </div>
        <!--fourline end-->
            <?php $this->endCache();
        } //缓存到此结束。?>
        <!--fivline start-->
        <div class="clearfix">
            <div class="loupaninfo_fivelinebox">
                <ul class="loupan_twoleftulone"><li class="one">评论列表</li></ul>
                <?php
                $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=>$commentsProvider,
                        'itemView'=>'_singleComment',
                        'summaryText'=>'共有<strong>{count}</strong>条评论',
                        'summaryCssClass'=>'',
                        'emptyText'=>'该商业广场尚无任何评论',
                ));
                ?>
            </div>
            <div class="loupaninfo_fivelinerightbox">
                <a name="comment"></a>
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'systembuildingcomment-form',
                        'action'=>'/systembuildinginfo/addcomment/id/'.$model->sbi_buildingid,
                        'enableAjaxValidation'=>true,
                        'htmlOptions'=>array('onSubmit'=>'if(!check_xing(this))return false;')
                )); ?>
                <dl>
                    <dt><strong>评分：</strong><code>点星星评分</code></dt>
                    <dd>
                        <div style="float:left;width:80px;">交&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通&nbsp;<span style="color:red">*</span>：</div>
                        <div><?php
                            $this->widget('CStarRating',array(
                                    'model'=>$newComment,
                                    'attribute'=>'sbc_traffice',
                                    'allowEmpty' => false,
                                    'maxRating' => 10,
                                    'minRating' => 2,
                                    'ratingStepSize' => 2,
                            ));?></div>
                    </dd>
                    <dd>
                        <div style="float:left;width:80px;">周围设施&nbsp;<span style="color:red">*</span>：</div>
                        <?php $this->widget('CStarRating',array(
                                'model'=>$newComment,
                                'attribute'=>'sbc_facility',
                                'allowEmpty' => false,
                                'maxRating' => 10,
                                'minRating' => 2,
                                'ratingStepSize' => 2,
                        ));?>
                    </dd>
                    <dd>
                        <div style="float:left;width:80px;">装&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;饰&nbsp;<span style="color:red">*</span>：</div>
                        <?php $this->widget('CStarRating',array(
                                'model'=>$newComment,
                                'attribute'=>'sbc_adorn',
                                'allowEmpty' => false,
                                'maxRating' => 10,
                                'minRating' => 2,
                                'ratingStepSize' => 2,
                        ));?>
                    </dd>
                    <dd style="color:#EB933C;">点评内容&nbsp;<font style="color:red">*</font>&nbsp;：<span style="color:gray">( 0-1000个字符 )</span></dd>
                    <dd><?php echo $form->textArea($newComment,'sbc_comment',array('class'=>'content f12px','id'=>'oc_comment','size'=>60,'maxlength'=>1000,'onkeyup'=>'keyPressCheck(this)','onblur'=>'check_comment_content(this,false)')); ?></dd>
                    <dd><span id="commentHint" style="color:gray">注：评论后内容<span style="color:#EB933C">不可更改</span>，请慎重输入!</span></dd>
                    <dd><?php $this->widget('CCaptcha',array('captchaAction'=>'systembuildinginfo/captcha')); ?></dd>
                    <dd><input type="text" name="verify" /></dd>
                    <dd>
                        <?php
                        if(Yii::app()->user->isGuest) {
                            echo '<a href="/site/login"><span class="loupaninfo_submitfour" style="text-align:center;line-height:25px;height:25px">请先登录</span></a>';
                        }else {
                            echo CHtml::Button('提交点评',array('onclick'=>'addComment()','class'=>"loupaninfo_submitfour"));
                        }
                        ?>
                    </dd>
                </dl>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <!--fivline end-->
    </div>
    <!--content end-->
    <div id="allPression" style="display: none"></div>
</div>
<script type="text/javascript">
    var show = 0;
    var updatePression = false;
    $(".scrollable").scrollable({
        keyboard:true
    });
    function getMoreImpression(){
        $.ajax({
            type:"get",
            url:"<?=Yii::app()->createUrl('/impression/ajaxMoreImpression',array('sourceId'=>$model->sbi_buildingid,'sourceType'=>Impression::systembuilding))?>",
            success: function(Msg){
                $("#allPression").html(Msg);
                updatePression = true;
                exchangeContent();
            }
        });
    }
    function exchangeContent(){
        var demo = $("#label").html();
        $("#label").html($("#allPression").html());
        $("#allPression").html(demo);
    }
    function showMore(){
        $("#label").slideUp("fast");
        if(show==0){
            show=1;
            if(!updatePression){
                getMoreImpression();
            }else{
                exchangeContent();
            }
            $("#showmore").text("收起↑");
        }else{
            show=0;
            exchangeContent();
            $("#showmore").text("更多↓");
        }
        $("#label").slideDown("slow");
    }
    function addPro(id){
        $.ajax({
            type:"get",
            url:"<?=Yii::app()->createUrl('/impression/ajaxAddPro',array('sourceId'=>$model->sbi_buildingid,'sourceType'=>Impression::systembuilding))?>",
            data: {id:id},
            success: function(state){
                if(state==1){
                    alert("发表成功");
                }else if(state==2){
                    alert("对不起,你已经发表过一次了.不能再发表.");
                }else if(state==3){
                    alert("对不起,请先登录.");
                }else{
                    alert("发表失败");
                }
            }
        });
    }
    function submitTwitter(){
        var buildingId = <?=$model->sbi_buildingid?>;
        var content = $.trim($("#twitter").val());
        if(buildingId==""){
            alert("商业广场信息错误,无法播报");
            return false;
        }else if(content==""){
            alert("播报内容不能为空");
        }else{
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl("/twittersuggest/create");?>',
                data: {content:content,buildingId:buildingId},
                success: function(msg){
                    magicDivOpenStart('twitterPost',500,300,false,500);
                    if(msg=="success"){
                        alert("播报成功,请等待审核");
                    }else{
                        alert(msg);
                    }
                }
            });
        }
    }
    function sub(){
        if($('#content').val()=='' || $('#content').val()=='例如：开发商信息有误，应该是某某公司'){alert('您没有输入任何内容');return;};
        if($('#verifyCode').val()==''){alert('验证码不能为空！');return;}
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createUrl("/systembuildinginfo/createerror");?>',
            data: $("form").serialize(),
            success: function(msg){
                $("#serror").hide();
                if(msg=='1'){
                    alert("‘揪’错成功！我们将在48小时内进行处理！");
                }else if(msg=='2'){
                    alert("揪’错失败！");
                }else{
                    alert(msg)
                }
            }
        });
    }
    function check_xing(obj){
        var sbc_traffice=0;
        $(obj).find("input[name='Systembuildingcomment[sbc_traffice]']").each(
        function(){if($(this).attr('checked')){sbc_traffice = $(this).val();}
        });
        var sbc_facility=0;
        $(obj).find("input[name='Systembuildingcomment[sbc_facility]']").each(function(){
            if($(this).attr('checked')){sbc_facility = $(this).val();}
        });
        var sbc_adorn=0;
        $(obj).find("input[name='Systembuildingcomment[sbc_adorn]']").each(function(){
            if($(this).attr('checked')){sbc_adorn = $(this).val();}
        });
        var str='';
        if(!sbc_traffice){
            str+='交通';
        }
        if(!sbc_facility){
            if(str)str+=',';
            str+='周围设施';
        }
        if(!sbc_adorn){
            if(str)str+=',';
            str+='装饰';
        }
        if(str){
            alert('请点击星星为'+str+('评分！'));
            return false;
        }
        return true;
    }
    var publishState = <?=$addImpression?>;
    if(publishState==1){
        alert('发表成功');
    }else if(publishState==2){
        alert('发表失败!');
    }else if(publishState==3){
        alert('印象不能为空!');
    }else if(publishState==4){
        alert('对不起,你已经发表过一次了.不能再发表!');
    }else if(publishState==5){
        alert('请先登录.');
    }else if(publishState==6){
        alert('印象的长度应保持在15字以内.');
    }
    function hintAction(obj,onFocus){
        if($(obj).val()=='例如：开发商信息有误，应该是某某公司' && onFocus){
            $(obj).val('');
        }else if($(obj).val()=='' && !onFocus){
            $(obj).val('例如：开发商信息有误，应该是某某公司');
        }
    }
    function keyPressCheck(obj){
        if($(obj).val().length>1000){
            $(obj).val($(obj).val().substring(0,1000));
        }else{
            var len=$(obj).val().length;
            if(len){
                var num=1000-len;
                if(num){
                    $('#commentHint').css('color','green')
                    $('#commentHint').html('您还可以输入'+num+'个字符');
                }else{
                    $('#commentHint').css('color','red')
                    $('#commentHint').html('抱歉，您输入的字符已达上限!多余字符已被截去.');
                }
            }else{
                $('#commentHint').html('评论内容至少2个字.');
                $('#commentHint').css('color','red');
                //$('#commentHint').html('注：评论后内容<span style="color:#EB933C">不可更改</span>，请慎重输入!</span>');
            }
        }
    }
    function addComment(){
        if(!check_xing($('#systembuildingcomment-form')) || !check_comment_content($('#oc_comment'),true))return false;
        $.ajax({
            type:"post",
            url:"<?=Yii::app()->createUrl('/systembuildinginfo/addcomment/id/'.$model->sbi_buildingid)?>",
            data: $("#systembuildingcomment-form").serialize(),
            success: function(Msg){
                alert(Msg);
                if(Msg =='发表评论成功!' || Msg =='发表评论成功！'){
                    window.location.href=window.location.href;
                }
            }
        });
    }
    function check_comment_content(obj,ifAlert){
        if($(obj).val().length<2){
            var str='评论内容至少2个字.';
            if(ifAlert){
                alert('评论内容至少2个字，请新重输入!');
            }
            $('#commentHint').css('color','red')
            $('#commentHint').html(str);
            if($('#commentHint').html() !=str){
                $(obj).focus();
            }
            return false;
        }
        return true;
    }
    document.body.oncopy = function(ev){
        ev = ev || window.event;
        alert("受保护的内容，暂不可复制！");
        return false;
    }
</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F579bf00bc2e83979133ed98063c70f99' type='text/javascript'%3E%3C/script%3E"));
</script> 
