<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/pu.css" />
<style type="text/css">

.searchTool .btnSearch input {background: url("/images/spbg.gif") no-repeat scroll 0 -358px transparent; *background: url("/images/spbg.gif") no-repeat scroll 10px -358px transparent; border: medium none; cursor: pointer; display: block; height: 31px; overflow: hidden; text-decoration: none;width: 65px;}
.loupan_onelineright{width: 265px; float: right;}
.loupan_onelinerightboxone {overflow: hidden;width: 100%; margin-left:8px; _margin-left:0px;}
.loupan_twoleftboxfour .serach_moreultwo {color: #4A4A4A;float: left;height: 16px;line-height: 16px;	margin-left: 8px;margin-top: 8px;overflow: hidden;	width: 100%;}
.orange{BACKGROUND-COLOR:#df5006; color:#FFF; width:70px; margin-right:10px; float:left; height:21px; line-height:21px;}
.loupan_onelinerightonedl{margin-right: 10px;}
.loupan_twoleftulone li.two { background: url("/images/sptab_02.png") no-repeat scroll right top transparent;}
.loupan_twoleftulone li.two strong { background: url("/images/loupan.gif") no-repeat scroll 0 -1475px transparent;}
.loupan_twoleftboxtwo { background: url("/images/loupanor012.png") no-repeat scroll 0 0 transparent;  margin: 0 8px 10px 8px;}
.loupan_twoleftbox{background: none;}
.loupan_twoleftulone li.one { color:#333333;}
.loupan_onelinemiddleulone li.one {background: url("/images/loupan.gif") no-repeat scroll 0 -1410px transparent;font-weight: bold; color: #333;}
.loupan_twoleftboxfour .serach_moreulone{background: url("/images/loupantitle.jpg") repeat-x scroll 0 0; width:322px;}
.dl{border-bottom:1px dashed #ccc; margin-bottom: 15px;  padding-bottom: 10px; }
.dl dt a:link, .dl dt a:visited{color: #0041D9;}
.dl dt a:hover{color: #FF6600;}
.loupan_onelinerightbox{background: none;}
a.showgreen:link {text-decoration: none; font-weight: normal; float:right; margin-right: 10px; font-size: 12px;}
a.showgre:link {text-decoration: none; font-weight: normal; margin-left: 62px; *margin-left:40px; display:inline;_float:left; _margin-left:30px; /*margin-right: 10px;*/ font-size: 12px; margin-right: 5px;}
a.showgrew:link,.showgrew {text-decoration: none; font-weight: normal; margin-left: 25px; /*margin-right: 10px;*/ font-size: 12px; /*margin-right: 5px;*/}
dl:last-child{border-bottom: none; margin-bottom: 0;}
.orange_title{background: url("/images/libg.gif") no-repeat scroll -5px -210px transparent; text-indent: 40px;}
.w265{margin-bottom: 15px;}
.orange_title a.showgreen:link,.orange_title a.showgre:link,.orange_title a.showgrew:link{color:#0041D9; }
.orange_title a.showgreen:hover,.orange_title a.showgre:hover,.orange_title a.showgrew:hover{color: #FF6600;}
.serach_moreulone {background: url("/images/loupantitle.jpg") repeat-x scroll 0 0 #FFFFFF;margin-left: 3px; width: 245px;}
.threeline_boxrighttwo{background: none;}
li.morelione, li.morelitwo, li.morelithree{font-weight: normal;}
.ulmargin23{margin:15px; padding-top:15px\0;}

    </style>
<?php
$this->pageTitle = $seotkd->stkd_title;
$this->breadcrumbs = array(
    '商业广场',
);
if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration']))) {
$searchLink = Yii::app()->createUrl("shop/rentIndex/");
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/meigong/lanrentuku_com02.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/meigong/main.js" type="text/javascript"></script>
<!--content start-->
<div class="clearfix"  style="width:1003px;margin:0px auto;background-color: #FFFFFF"></div>
  <!--oneline start-->
  <div class="clearfix">
    <div class="loupan_left">
      <div class="loupan_onelineleft">
        <div class=txt id="DivShopPaiHang_ShowPanel">
          <div class=txt11>
            <ul>
              <?php
                if (!empty($buildingrecommend)) {
                    foreach ($buildingrecommend as $key => $value) {
                ?>
              <li class="more" id="DivShopPaiHangFlag1_B<?=$key+1?>" style="display:none;height:209px;">
                <div class="productInfovb"> <a target="_blank" title="<?=@$value->buildingInfo->sbi_buildingname;?>" href="<?=Yii::app()->createUrl("/systembuildinginfo/viewshop",array("id"=>@$value->buildingInfo->sbi_buildingid));?>">
                  <?=@$value->buildingInfo->sbi_buildingname;?>
                  </a> </div>
                  <a target="_blank" title="" href="<?=Yii::app()->createUrl("/systembuildinginfo/viewshop",array("id"=>@$value->buildingInfo->sbi_buildingid));?>"> <img alt="<?=$value->buildingInfo->sbi_buildingname?>" id="Img_DivShopPaiHangFlag1_<?=$key+1?>" style="veritcal-align:middle;" height="178px" width="325px" /> </a>
                <div id="ImgSrc_DivShopPaiHangFlag1_<?=$key+1?>" style="display:none">
                  <?=Picture::model()->getPicByTitleInt(@$value->buildingInfo->sbi_titlepic,"_normal")?>
                </div>
              </li>
              <li class="num<?=$key+1?> listHeight" id="DivShopPaiHangFlag1_S<?=$key+1?>" onMouseOver="SwapPaiHangShopDiv('DivShopPaiHangFlag1','<?=$key+1?>')" style="height:31px;">
                <div class="productInfovbvc"> <a target="_blank" title="<?=@$value->buildingInfo->sbi_buildingname;?>" href="<?=Yii::app()->createUrl("/systembuildinginfo/view/top/shop",array("id"=>@$value->buildingInfo->sbi_buildingid));?>">
                  <?=@$value->buildingInfo->sbi_buildingname;?>
                  </a> </div>
              </li>
              <?php
                    }
                }
              ?>
              <li class="more" id="DivShopPaiHangFlag1_B1" style="display:none;height:209px;"></li>
              <li class="num1 listHeight" id="DivShopPaiHangFlag1_S1" onMouseOver="SwapPaiHangShopDiv('DivShopPaiHangFlag1','1')" style="height:31px;"></li>
              <li class="more" id="DivShopPaiHangFlag1_B2" style="display:none;height:209px;"></li>
              <li class="num2 listHeight" id="DivShopPaiHangFlag1_S2" onMouseOver="SwapPaiHangShopDiv('DivShopPaiHangFlag1','2')" style="height:31px;"></li>
              <li class="more" id="DivShopPaiHangFlag1_B3" style="display:none;height:209px;"></li>
              <li class="num3 listHeight" id="DivShopPaiHangFlag1_S3" onMouseOver="SwapPaiHangShopDiv('DivShopPaiHangFlag1','3')" style="height:31px;"></li>
            </ul>
          </div>
        </div>
        <script type="text/javascript">
              if(3>=1){
                  SwapPaiHangShopDiv('DivShopPaiHangFlag1','1');
              }
          </script>
      </div>
      <div class="loupan_onelinemiddle">
        <div class="loupan_onelinemiddlelineone"></div>
        <div class="loupan_onelinemiddlebox">
          <ul class="loupan_onelinemiddleulone">
            <li class="one" id="loubright1" onmouseover="loubturnit(1);">按区域搜索</li>
            <li class="two" id="loubright2" onmouseover="loubturnit(2);">按地铁搜索</li>
            <li class="two" id="loubright3" onmouseover="loubturnit(3);">按价格搜索</li>
          </ul>
          <div id="loubrightChild1" class="loupan_onelinemiddlemap">
            <!-- <img src="images/loupan01.gif" alt="" width="347px" height="216px" /> 美工原图 -->
            <div id="districts" style="width:350px;">
              <ul class="districts items">
                <?php
                  foreach ($districts as $district) {
                  ?>
                <li onclick="changeSection('<?=$district['re_id']?>',this)">
                  <?=$district['re_name']?>
                </li>
                <?
                  }
                ?>
              </ul>
            </div>
            <div class="clear"></div>
            <div id="sections" style="width:350px;"></div>
          </div>
          <div id="loubrightChild2" class="hidden" style="margin-top: 10px;">
            <img src="/images/map.gif" alt="" width="347px" height="216px" usemap="#map2"/>
                <map  name="map2">
                <area  coords="85,117,145,139" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>41)));?>" alt="1号线" >
                <area  coords="104,49,164,76" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>42)));?>" alt="2号线">
                <area coords="183,11,245,32" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>43)));?>" alt="3号线">
                <area coords="258,26,321,47" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>44)));?>" alt="4号线">
                <area coords="111,178,172,205" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>45)));?>" alt="5号线"/>
                <area  coords="270,163,334,185" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>46)));?>" alt="6号线">
                <area  coords="137,84,190,110" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>47)));?>" alt="7号线">
                <area  coords="229,83,296,109" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>48)));?>" alt="8号线">
                <area  coords="67,153,125,180" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>49)));?>" alt="9号线">
                <area  coords="203,42,256,67" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>50)));?>"alt="10号线" >
                <area  coords="8,8,68,31" target="_blank" shape="rect" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("metro"=>80)));?>" alt="11号线">
            </map>
          </div>
          <div id="loubrightChild3" class="hidden">
            <!-- <img src="images/loupan01.gif" alt="" width="347px" height="216px" /> 美工原图 -->
            <style type="text/css">
            #rent li{width:45px; display:block; float:left; height:25px; line-height:25px; margin-left:10px; margin-right:10px;}
            #sell li{display:block; display: inline; float:left; margin-right:7px; height:25px; line-height:25px;}
            </style>
            <div style="margin-top: 30px;" id="loubrightChild3" class="loupan_onelinemiddlemap">
              <div style="width: 350px; height: 50px;">
                <div class="yellow" style="cursor: pointer;">平均租金</div>
                <ul style="width: 260px; float: left;" id="rent">
                    <?php
                    foreach ($rentPriceConditions as $rentObject) {
                    ?>
                    <li><a href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("avgr"=>$rentObject['sc_id'])));?>" target="_blank"><?=$rentObject['sc_title']?></a></li>
                   <?php
                    }
                    ?>
                </ul>
              </div>
              <div class="buildingPriceModule" style="width: 350px; margin-top: 35px;">
                <div class="yellow" style="cursor: pointer;">平均售价</div>
                <ul id="sell" style="width: 260px; float: left;">
                  <?php
                    foreach ($sellPriceConditions as $sellObject) {
                    ?>
                    <li><a href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist",SearchMenu::dealOptions(array("avgs"=>$sellObject['sc_id'])));?>" target="_blank"><?=$sellObject['sc_title']?></a></li>
                    <?php
                    }
                  ?>
                </ul>
              </div>
            </div>

          </div>
        </div>
        <div class="loupan_onelinemiddlelinetwo"></div>
      </div>
        <div class="w729"> <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
    <div class="border">

      <ul class="loupan_twoleftulone">
        <li class="one">最新商业广场</li>
        <li class="two" id="louright1" onmouseover="louturnit(1,2);"><strong>本月开盘</strong></li>
        <li class="three" id="louright2" onmouseover="louturnit(2,2);"><strong>下月开盘</strong></li>
        <li class="four" id="monthlist"><a target="_blank" href="<?=Yii::app()->createUrl("systembuildinginfo/shopbuildlist");?>">更多&gt;&gt;</a></li>
      </ul>
      <div class="loupan_twoleftboxtwo">
        <div class="loupan_twoleftboxthree clearfix">
          <div id="lourightChild1" class="nohidden">
            <div class="loupan_twoleftboxfour">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?
              foreach ($curMonthBuildings as $ckey => $curBuilding) {
                  if ($ckey < 6) {
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($curBuilding->sbi_buildingname), 24),array('systembuildinginfo/viewshop','id'=>$curBuilding->sbi_buildingid),array('title'=>$curBuilding->sbi_buildingname));?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($curBuilding->sbi_district)?>
                </li>
                <li class="morelithree">
                  <?=$curBuilding->sbi_avgsellprice==0?"待定":"￥".$curBuilding->sbi_avgsellprice?>
                </li>
              </ul>
              <?
                  }
              }
              ?>
            </div>
            <div class="loupan_twoleftboxfour" style="float:right; margin-right:10px;">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?
              foreach ($curMonthBuildings as $ckey => $curBuilding) {
                  if ($ckey >= 6 && $ckey < 12) {
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($curBuilding->sbi_buildingname), 24),array('systembuildinginfo/viewshop','id'=>$curBuilding->sbi_buildingid),array('title'=>$curBuilding->sbi_buildingname));?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($curBuilding->sbi_district)?>
                </li>
                <li class="morelithree">
                  <?=$curBuilding->sbi_avgsellprice==0?"待定":"￥".$curBuilding->sbi_avgsellprice?>
                </li>
              </ul>
              <?
                  }
              }
              ?>
            </div>
          </div>
          <div id="lourightChild2"  class="hidden">
            <div class="loupan_twoleftboxfour">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?
              foreach ($nextMonthBuildings as $nkey => $nextBuilding) {
                  if ($nkey < 6) {
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($nextBuilding->sbi_buildingname), 24),array('systembuildinginfo/viewshop','id'=>$nextBuilding->sbi_buildingid),array('title'=>$nextBuilding->sbi_buildingname));?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($nextBuilding->sbi_district)?>
                </li>
                <li class="morelithree">
                  <?=$nextBuilding->sbi_avgsellprice==0?"待定":"￥".$nextBuilding->sbi_avgsellprice?>
                </li>
              </ul>
              <?
                  }
              }
              ?>
            </div>
            <div class="loupan_twoleftboxfour" style="float:right; margin-right:10px;">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?
              foreach ($nextMonthBuildings as $nkey => $nextBuilding) {
                  if ($nkey >= 6 && $neky < 12) {
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($nextBuilding->sbi_buildingname), 24),array('systembuildinginfo/viewshop','id'=>$nextBuilding->sbi_buildingid),array('title'=>$nextBuilding->sbi_buildingname));?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($nextBuilding->sbi_district)?>
                </li>
                <li class="morelithree">
                  <?=$nextBuilding->sbi_avgsellprice==0?"待定":"￥".$nextBuilding->sbi_avgsellprice?>
                </li>
              </ul>
              <?
                  }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b> </div>

    <div class="w729"> <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border">
      <ul class="loupan_twoleftulone">
        <li class="one">已开商业广场</li>
        <li class="two" id="louaright1" onmouseover="louaturnit(1);"><strong>
          <?php $n = date("n")-3;  if($n<1)echo 12+$n;else echo $n; ?>
          月</strong></li>
        <li class="three" id="louaright2" onmouseover="louaturnit(2);"><strong>
          <?php $n = date("n")-2;  if($n<1)echo 12+$n;else echo $n; ?>
          月</strong></li>
        <li class="three" id="louaright3" onmouseover="louaturnit(3);"><strong>
          <?php $n = date("n")-1;  if($n<1)echo 12+$n;else echo $n; ?>
          月</strong></li>
        <!-- <li class="four"><a href="#">更多&gt;&gt;</a></li> -->
      </ul>
      <div class="loupan_twoleftboxtwo">
        <div class="loupan_twoleftboxthree clearfix">
          <?php $changehtmllist = Systembuildinginfo::model()->getBuildinfoByMonth(date("n")-3,12,2) ?>
          <div id="louarightChild1"  class="nohidden">
            <div class="loupan_twoleftboxfour">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?php
                            if (!empty($changehtmllist)) {
                  foreach ($changehtmllist as $key => $value) {
                      if ($key < 6) {//显示前6条
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/viewshop","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
                </li>
                <li class="morelithree">
                <?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
                </li>
              </ul>
              <?php
                      }
                  }
              }
              ?>
            </div>
            <div class="loupan_twoleftboxfour" style="float:right; margin-right:10px;">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?php
              if (!empty($changehtmllist)) {
                  foreach ($changehtmllist as $key => $value) {
                      if ($key >= 6) {//显示后十条
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/viewshop","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
                </li>
                <li class="morelithree">
                  <?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
                </li>
              </ul>
              <?php
                      }
                  }
              }
              ?>
            </div>
          </div>
          <div id="louarightChild2"  class="hidden">
            <?php $changehtmllist = Systembuildinginfo::model()->getBuildinfoByMonth(date("n")-2,12,2) ?>
            <div class="loupan_twoleftboxfour">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?php
              if (!empty($changehtmllist)) {
                  foreach ($changehtmllist as $key => $value) {
                      if ($key < 6) {//显示前十条
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/viewshop","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
                </li>
                <li class="morelithree">
                  <?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
                </li>
              </ul>
              <?php
                      }
                  }
              }
              ?>
            </div>
            <div class="loupan_twoleftboxfour" style="float:right; margin-right:10px;">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?php
              if (!empty($changehtmllist)) {
                  foreach ($changehtmllist as $key => $value) {
                      if ($key >= 6) {//显示后十条
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/viewshop","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
                </li>
                <li class="morelithree">
                <?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
                </li>
              </ul>
              <?php
                      }
                  }
              }
              ?>
            </div>
          </div>
          <div id="louarightChild3"  class="hidden">
            <?php $changehtmllist = Systembuildinginfo::model()->getBuildinfoByMonth(date("n")-1,12,2) ?>
            <div class="loupan_twoleftboxfour">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?php
              if (!empty($changehtmllist)) {
                  foreach ($changehtmllist as $key => $value) {
                      if ($key < 6) {//显示前十条
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/viewshop","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
                </li>
                <li class="morelithree">
                  <?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
                </li>
              </ul>
              <?php
                      }
                  }
              }
              ?>
            </div>
            <div class="loupan_twoleftboxfour" style="float:right; margin-right:10px;">
              <ul class="serach_moreulone">
                <li class="morelione">商业广场名称</li>
                <li class="morelitwo">区县</li>
                <li class="morelithree">均价</li>
              </ul>
              <?php
              if (!empty($changehtmllist)) {
                  foreach ($changehtmllist as $key => $value) {
                      if ($key >= 6) {//显示后十条
              ?>
              <ul class="serach_moreultwo">
                <li class="morelione">
                  <?=CHtml::link(common::strCut(CHtml::encode($value->sbi_buildingname), 24),array("systembuildinginfo/viewshop","id"=>$value->sbi_buildingid),array("target"=>"_blank",'title'=>$value->sbi_buildingname)); ?>
                </li>
                <li class="morelitwo">
                  <?=Region::model()->getNameById($value->sbi_district)."-".Region::model()->getNameById($value->sbi_section); ?>
                </li>
                <li class="morelithree">
                 <?Php echo $value->sbi_avgsellprice?'￥'.$value->sbi_avgsellprice:'待定'; ?>
                </li>
              </ul>
              <?php
                      }
                  }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b> </div>

       <div class="w729"> <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
           <div class="border">
      <ul class="loupan_twoleftulone">
        <li class="one">热门商业广场</li>
        <li class="four">
          <?=CHtml::link("更多&gt;&gt;",array('systembuildinginfo/shopbuildlist'))?>
        </li>
      </ul>
      <ul class="loupan_twoleftultwo clearfix">
        <?
        foreach ($hotBuildings as $hotBuilding) {
        ?>
          <li> <a href="<?=Yii::app()->createUrl("systembuildinginfo/viewshop",array("id"=>$hotBuilding->sbi_buildingid)); ?>"> <img alt="<?=$hotBuilding->sbi_buildingname?>" class="img_border" src="<?=Picture::model()->getPicByTitleInt($hotBuilding->sbi_titlepic,"_small")?>" width="150px" height="100px" /> </a> <a href="/shop/rentIndex/district/<?php echo  $hotBuilding->sbi_district;?>" class="showblue">
          <?='['.Region::model()->getNameById($hotBuilding->sbi_district).']'?>
          </a> <strong>
          <?=CHtml::link(common::strCut(CHtml::encode($hotBuilding->sbi_buildingname), 21),array('systembuildinginfo/viewshop','id'=>$hotBuilding->sbi_buildingid),array('class'=>'colorred','title'=>$hotBuilding->sbi_buildingname));?>
          </strong><br />
          物业费：
          <?=$hotBuilding->sbi_propertyprice?'<code>'.$hotBuilding->sbi_propertyprice.'</code>元/平米·月':'暂无资料';?>
          <br />
          开发商：
          <?php echo $hotBuilding->sbi_developer?$hotBuilding->sbi_developer:'暂无资料';?>
          <br />
          <span>点击次数：
          <?=$hotBuilding->sbi_visit?>
          </span> </li>
        <?
        }
        ?>
      </ul>
    </div>
    <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b> </div>

    <div class="w729"> <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
           <div class="border">
      <ul class="loupan_twoleftulone">
        <li class="one">精品商铺推荐</li>
      </ul>
      <ul class="loupan_twoleftultwo clearfix">
        <?php
        foreach ($list as $value) {
            if($value->sp_sourceid){
        ?>
            <li>
            <a target="_blank" href="<?=Yii::app()->createUrl('/shop/view',array("id"=>$value->shopInfo->sb_shopid));?>">
                <img class="img_border" src="<?=Picture::model()->getPicByTitleInt(@$value->shopInfo->presentInfo->sp_titlepicurl,"_small");?>" width="150px" height="100px" />
            </a>
            <?=CHtml::link("[".Region::model()->getNameById(@$value->shopInfo->sb_district)."]",array($value->shopInfo->sb_sellorrent==1?"/shop/rentIndex":"/shop/sellIndex","district"=>@$value->shopInfo->sb_district),array("class"=>"showblue"));?>         
            <strong>
                <a target="_blank" href="<?=Yii::app()->createUrl('/shop/view',array("id"=>$value->shopInfo->sb_shopid));?>" class="colorred" title="<?=$value->shopInfo->presentInfo->sp_shoptitle?>"> <?php echo common::strCut($value->shopInfo->presentInfo->sp_shoptitle, 18);?> </a>
            </strong>
            <br />
            面积：<code>
            <?=$value->shopInfo->sb_shoparea;?>
            </code>平米<br />
            <?php
            if($value->shopInfo->sb_sellorrent==1){
            echo "租金：&nbsp;";
            echo "<code>".$value->shopInfo->rentInfo->sr_rentprice."</code>&nbsp;元/平米·天";
            }elseif($value->shopInfo->sb_sellorrent==2){
            echo "售价：&nbsp;";
            echo "<code>".($value->shopInfo->sellInfo->ss_avgprice)."</code>&nbsp;元/平米";
            }
            ;?>
            <br />
            <span>点击次数：
            <?=$value->shopInfo->sb_visit;?>
            </span>
            </li>
        <?php
            }
        }
        ?>
      </ul>
    </div>
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b> </div>
        <div class="w729"> <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
           <div class="border">
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
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b> </div>
    </div>
      <div class="loupan_onelineright">
          <div class="w265"> <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
            <div  class="border" style="height: 134px;">
                <div class="rbg" style="margin:3px 5px; height:128px;">
                <div class="orange_title">商业广场搜索</div>
                <div class="c"></div>
                <ul class="ulmargin23">
                    <form action="/site/searchmenu" method="post">
                        <li>
                            <div class="searchTool">
                                <input type='hidden' name='option' value='keyword' />
                                <input class="txtSearch" name="keyword" type="text" value="" />
                                <div class="btnSearch">
                                    <input value="" type="submit" />
                                </div>
                            </div>
                        </li>
                        <li class="ss_wz"><span>示例： 人民广场   中融恒瑞</span></li>
                        <input type="hidden" name="action" value="/systembuildinginfo/shopbuildlist"/>
                    </form>
                </ul>
            </div>
            </div>
            <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b> </div>
              <div class="w265"> <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
                        <div  class="border" style="height: 134px;">
                            <div class="rbg" style="margin:3px 5px; height:128px;">
                            <div class="orange_title">地图搜索</div>
                            <div class="c"></div>
                            <ul class="ulmargin23">
                                <form action="/site/searchmenu" method="post">
                                    <li>
                                        <div class="searchTool">
                                            <input class="txtSearch" name="keyword" type="text" value="" />
                                            <div class="btnSearch">
                                                <input value="" type="submit" />
                                            </div>
                                        </div>
                                    </li>
                                    <li class="ss_wz"><span>示例：  人民广场   中融恒瑞</span></li>
                                    <input type="hidden" name="action" value="/map/map" />
                                </form>
                            </ul>
                        </div>
                        </div>
                        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b> </div>

          <style type="text/css">
             .showgre{display:inline-block; position:absolute; right: 5px; top: 10px; color: #54AEAF; font-size: 12px; font-weight: normal;}
          </style>

          <div class="w265" style="position:relative;">
    <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
    <div class="border" style="padding:5px 0px 15px 3px;*padding-bottom:0px; _padding-bottom:0px;">
        <div class="orange_title" >商业广场点评
        <?=CHtml::link("更多&gt;&gt;",array('systembuildinginfo/shopcomment'),array('class'=>'showgre'))?>
      </div>

      <?php
                foreach($recentComments as $recentComment){
        ?>
      <dl class="dl">
        <dt style="width:240px; float:left; padding-left: 12px; ">
          <div style="float:left;width:180px;">
            <?=CHtml::link(common::strCut(CHtml::encode($recentComment->buildingInfo['sbi_buildingname']), 27),array('systembuildinginfo/viewshop','id'=>$recentComment->buildingInfo['sbi_buildingid']),array('title'=>$recentComment->buildingInfo['sbi_buildingname']));?>
            [
            <?=CHtml::link(common::strCut(region::model()->getNameById($recentComment->buildingInfo['sbi_district']),12),array("shop/rentIndex","district"=>$recentComment->buildingInfo['sbi_district']),array("class"=>"showblue","title"=>region::model()->getNameById($recentComment->buildingInfo['sbi_district'])))?>
            ]</div>
      </dt>
        <dd style="width:240px; display:block; float:left; margin-bottom:5px!important;_margin-bottom:0; padding-left: 12px;">
         <!-- <div style="width:40px; float:left;">点评：</div>-->
          <?php $num = round(($recentComment['sbc_traffice']+$recentComment['sbc_facility']+$recentComment['sbc_adorn'])/3);echo "<div style='float:left'>".common::getStar($num)."</div>"?>
        </dd>
        <br />
        <dd style="padding-left:12px; width: 200px;"> "&nbsp;
         <?=common::strCut(CHtml::encode($recentComment->sbc_comment),90);?>
          &nbsp;" </dd>
        <dd class="add_font" style="margin-left:12px; padding-bottom: 15px; width: 240px; display: inline;">于
          <?=common::showFormatDateTime($recentComment->sbc_comdate)?>
          发表</dd>
      </dl>
      <?
                }
        ?>
    </div>
    <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
    <div class="w265">
    <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
      <div class="border" style="padding:5px 0px 15px 3px; overflow: hidden">
          <div class="orange_title" style="text-indent:40px; width:263px; _width:258px; padding-left:0; margin-left: 0;" >最受欢迎的商业广场
        <?=CHtml::link("更多&gt;&gt;",array('systembuildinginfo/shopbuildlist'),array('class'=>'showgrew'))?>
      </div>
      <div class="loupan_onelinerightboxone clearfix">
        <?php
                foreach($welcomeBuildings as $welcomeBuilding){
                ?>
        <ul class="serach_moreultwo">
          <li class="morelione">
            <?=CHtml::link(common::strCut($welcomeBuilding->sbi_buildingname, 18),array('systembuildinginfo/viewshop','id'=>$welcomeBuilding->sbi_buildingid),array("title"=>$welcomeBuilding->sbi_buildingname));?>
          </li>
          <li class="morelitwo">
            <?=region::model()->getNameById($welcomeBuilding->sbi_district)?>
          </li>
        </ul>
        <?
                }
                ?>
      </div>
      </div>
      <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
    <div class="loupanadcss"> <a target="_blank" href="<?=Yii::app()->createUrl('/systembuildinginfo/shopbuildlist',array("filterdate"=>87))?>">查看<strong><?php echo date("n") ?></strong>月商业广场开盘汇总</a> </div>
    <div class="w265">
        <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="border" style="padding:5px 0px 15px 3px; overflow: hidden">
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





    

  <!--oneline end-->
 
<!--content end-->
<script type="text/javascript" language="javascript">
    function changeSection(district,src){
        $(src).siblings().removeClass();
        $(src).attr("class","yellow");
        $("#sections").hide();
        var searchLink = "<?=$searchLink?>";
        var link = "<? echo Yii::app()->createUrl("region/getSectionByDistrict")?>";
        $.ajax({
            url:link,
            data:"districtId="+district,
            success:function(data){
                eval("var sections = " + data + ";");
                var demostr = "<ul class='section'>";
                for(key in sections){
                    demostr += "<li><a href='"+searchLink+"/district"+district+"-section"+sections[key]['re_id']+"'>"+sections[key]['re_name']+"</a></li>";
                }
                demostr += "</ul>";
                $("#sections").html(demostr);
                $("#sections").fadeIn();
            }
        });
        return false;
    }
    function showChildTab(id,src){
        $(src).siblings("span").removeClass();
        $(src).attr("class","yellow");

        $("#"+id).siblings().hide();
        $("#"+id).fadeIn();
    }
    //改变最新商业广场更多的链接地址
    function changeUrl(value){
        var link = "<?=Yii::app()->createUrl("/systembuildinginfo/shopmonthlist")?>";
        link += "/month/"+value;
        $("#monthlist a").attr("href",link);
    }
</script>
<?php $this->endCache(); } ?>
