<?php
$comy_city = Region::model()->getNameById($communityInfo->comy_city);
$comy_district = Region::model()->getNameById($communityInfo->comy_district);
$comy_name=$communityInfo->comy_name;
$rbi_toward=Residencebaseinfo::model()->getTowardName($residenceModel->rbi_toward);
@$rs_price=$residenceModel->sellInfo->rs_price;
$agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$ownerInfo->user_id));
$keywords=$comy_name.'二手房，'.$comy_city.'房价'.$rs_price.',面积'.$residenceModel->rbi_area.'平方';
$description=$comy_city.$comy_name.'二手房，二手房房价'.$rs_price.'万元,面积：'.$residenceModel->rbi_area.'平方，朝向：'.$rbi_toward.',';
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
$this->pageTitle = $comy_name.'二手房，'.$comy_name.'360°全景看房，'.$comy_city.$comy_name.'最新房价'.$rs_price.'万,经纪人：'.$ownerInfo['user_tel'].' - 新地标';
?>
<link href="/css/zhai.css" type="text/css" rel="stylesheet" />
<link href="/css/global.css" type="text/css" rel="stylesheet" />
<style type="text/css">
    .fydj{margin-top:10px;}
    .dj_images{margin-top:10px;}
    ul,li{margin:0; padding:0;}
    .czfx{width:100%;}
    .cz,.fx{width:48%; float:left; border-bottom:0;}
    .cz p,.fx p{height: 33px; line-height: 33px;}
    .serach_moremenu{width:725px;}
    .pictureGrid {width:710px;}
    .serach_moreultwo{padding-left:10px;}
    .serach_moreultwo{_width:230px; overflow:hidden;}
    #center,#tworight{margin-top: 0;}
    .border{border:1px solid #ccc; border-top: 0;}
</style>
  <div style="text-align: left; margin-top: 3px; margin-bottom: 3px;">
  <?php 
    $this->breadcrumbs = array(
        "住宅"=>array("communitybaseinfo/index"),
        '出售' => array('sellIndex'),
        $residenceModel->rbi_title,
    );

     $this->widget('ReportWidget', array(
            'triggerId' => 'report',
            'suspectUserId' => $ownerInfo->user_id,
            'sourceId' => $residenceModel->rbi_id,
            'sourceType' => Report::residence,
    ));
  ?>
  </div>
<a name="top"></a>
<div id="center">
<div id="two_left">
    <ul class="serach_moremenu">
        <li id="menuLi0"class="one" onclick="menuClass(0);"><strong><a href="javascript:void(0);">房屋信息</a></strong></li>
        <li id="menuLi1"class="two" onclick="menuClass(1);"><strong><a href="#intro">房屋介绍</a></strong></li>
        <li id="menuLi2"class="two" onclick="menuClass(2);"><strong><a href="#photo">房源照片</a></strong></li>
        <li id="menuLi3"class="two" onclick="menuClass(3);"><strong><a href="#info">小区信息</a></strong></li>
    </ul>
    <div class="w725 border" style="width:715px; overflow:hidden; margin-bottom:10px; border:0; margin-left: 0; padding-left: 0; padding-top:10px;">
            <?php
                $variable = array('residenceModel'=>$residenceModel,'ownerInfo'=>$ownerInfo,'communityInfo'=>$communityInfo);
                if($ownerInfo->user_role==User::personal) {
                    echo $this->renderPartial('_personalModule',$variable);
                }elseif($ownerInfo->user_role==User::agent) {
                    echo $this->renderPartial('_agentModule', $variable);
                }elseif($ownerInfo->user_role==User::company) {
                    echo $this->renderPartial('_companyModule', $variable);
                }
            ?>
    </div>
    <div class="w725">
        <?php if(Panoxml::model()->checkHavePano($residenceModel->rbi_id, 5)) { ?>
        <div><h3><strong>房源实景</strong></h3><a href="#top"><div class="gotop"></div></a></div>
        <div class="loupaninfo_threelineboxtwo" style="width:723px; margin-bottom:20px; margin-top:-15px;">
            <div style="width: 710px; margin-top: 0pt; border: medium none;" class="loupaninfo_threelineboxtwo">
                <div style="margin-left: 10px;" id="brightChild1">
                    <ul id="panoramaPlayer" style="height: 400px;" class="pictureGrid">
                        <?php
                        $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($residenceModel->rbi_id, 5),));
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php if($residenceModel->rbi_residencedesc){?>
    <div class="w725">
        <a name="intro"></a>
        <div><h3><strong>房源介绍</strong></h3><a href="#top"><div class="gotop"></div></a></div>
        <div class="serach_moreleftthreebox">
            <span>
                <?=$residenceModel->rbi_residencedesc;?><br />
            </span>
        </div>
    </div>
    <?php }?>
    <div class="w725">
        <a name="photo"></a>
        <div><h3><strong>房源照片</strong></h3><a href="#top"><div class="gotop"></div></a></div>
        <div class="serach_morelefttwobox">
            <?php
                $typePictures = $pictures[Picture::$picType['indoor']];
                for($i=0;$i<count($typePictures);$i++) {
                    $picUrl=PIC_URL.Picture::showStandPic($typePictures[$i]['p_img'],"_large");
            ?>
            <img src="<?=$picUrl?>" style="margin-top:0;"alt="<?=$communityInfo->comy_name?>"/><br /><br />
            <?php
                }
                $typePictures = $pictures[Picture::$picType['outdoor']];
                for($i=0;$i<count($typePictures);$i++) {
                    $picUrl=PIC_URL.Picture::showStandPic($typePictures[$i]['p_img'],"_large");
            ?>
            <img src="<?=$picUrl?>" alt="<?=$communityInfo->comy_name?>"/><br /><br />
            <?php
                }
                $typePictures = $pictures[Picture::$picType['ichnograph']];
                for($i=0;$i<count($typePictures);$i++) {
                    $picUrl=PIC_URL.Picture::showStandPic($typePictures[$i]['p_img'],"_large");
            ?>
            <img src="<?=$picUrl?>" alt="<?=$communityInfo->comy_name?>"/><br /><br />
            <?php }?>
        </div>
    </div>
    <?=$this->renderPartial('_communityInfo',array('communityInfo'=>$communityInfo));?>
    <div class="loupan_onelineright loupaninfo_add"></div>
    </div>
    <?php 
    @$this->widget('RecentView',array("cssType"=>"residence"));
    ?>
    <!-- 投放GOOGLE广告联盟的广告-->
        <div id="tworight">
            <div class="addspace" style="height:40px;"></div>
            <div class="brow">
                <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
                <div class="br_cont" >
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
<script type="text/javascript" language="javascript">
    $("#panorama_navi > div").eq(0).show();
    $(".items img").click(function() {
        if ($(this).hasClass("active")) { return; }
        $(".items img").removeClass("active");
        $(this).addClass("active");
        var panoId = $(this).attr("va");
        clickChangePano(panoId);
    }).first().addClass("active");

    $("#panorama_type > li").click(function(){
        $("#panorama_type > li").attr('class','three');
        $(this).attr("class",'two');
        var index = $(this).index();
        $("#panorama_navi > div").hide();
        $("#panorama_navi > div").eq(index).show();
        $("#panorama_navi > div").eq(index).find('.item_vessel > img').first().click();
    }).first().attr("class",'two').css("margin-left", "0px");
    
     function store(){
        var presentId = <?=$residenceModel->rbi_id?>;
        var officeType = <?=Housecollect::residence?>;
        var rentorsell = <?=Housecollect::sell;?>;
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
                }else if(state==4){
                    alert("身份不正确");
                }else{
                    alert("收藏失败");
                }
            }
        });
    }
    
     function menuClass(type){
        $("#menuLi"+ type).removeClass().addClass("one");
        for(i=0;i < 4;i++){
            if(i != type){
                 $("#menuLi"+ i).removeClass().addClass("two");
            }
        }
     }

      function addFavorite(sURL, sTitle){
        try{
            window.external.addFavorite(sURL, sTitle);
        } catch (e){
            try{
                window.sidebar.addPanel(sTitle, sURL, "");
            }catch (e){
                alert("加入收藏失败，有劳您手动添加。");
            }
        }
    }
</script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sourceView.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/magicDiv.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sourceView.js" type="text/javascript"></script>