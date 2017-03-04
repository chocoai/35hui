<?php
$ob_city = Region::model()->getNameById($officeBaseinfo->ob_city);
$ob_officename = $officeBaseinfo->ob_officename;
$op_officetitle=$officePresentInfo->op_officetitle;
$or_rentprice=$officeBaseinfo->rentInfo->or_rentprice;
$keywords = $ob_city.$ob_officename.'的商务中心'.$op_officetitle.'出租，'.$or_rentprice.'元/月起租';

Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($keywords,'description');
$this->pageTitle = $ob_city.$ob_officename.'的商务中心'.$op_officetitle.'出租，租金'.$or_rentprice.'元/月起租- 新地标';
?>
<style type="text/css">
	.serach_moreultwo{width:229px;}
	.serach_moreboxone {background:none;float: left;height: 35px;line-height: 35px;	margin-top: 0px;overflow: hidden;width: 715px;}
	.serach_moreboxtworight {float: right;	margin-top: 35px;position: relative;width: 259px;z-index: 1;}
	.serach_moreboxoneleft h1{ font-size: 25px; font-family: Arial,Helvetica,sans-serif; font-weight: 700; height: 45px; line-height: 45px;	}
	.threeline_boxleft{padding-top: 0;}
	.serach_moreboxoneleft{padding-left: 0;}
	.serach_moreleftthreebox{color:#000;}
</style>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/scrollable-horizontal.css" />
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/lou.css" />
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/jquery.tools.min.js"></script>
<?php
$this->breadcrumbs = array(
	'商务中心'=>array("businessIndex"),
    "出租"=>array("rentBusinessList"),
    CHtml::encode($op_officetitle),
);
if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration'],'varyByParam'=>array("opid")))) {
	?>
<!--content start-->
<div style="width:984px; _width:1000px;margin:0px auto;">

    <div class="clearfix">
			<?php $this->renderPartial("_businessviewright",array('aroundBusiness'=>$aroundBusiness));?>

        <!--left start-->
        <div class="threeline_boxleft">
			<div class="serach_moreboxone">
				<div class="serach_moreboxoneleft">
					<h1><?=$officePresentInfo->op_officetitle?></h1>
				</div>
			</div>
            <!--全景开始-->
            <?php
            if(Panoxml::model()->checkHavePano($officeBaseinfo->ob_officeid, 6)) {
            ?>
			<div style="width: 710px; margin-bottom:20px;border-top: #0F8589 solid 3px" class="loupaninfo_threelineboxtwo">
				<div class="loupaninfo_threelineboxtwo" style="width: 710px; margin-top:0; border: none;">
                    <div id="brightChild1" style="margin-left:10px">
                        <ul class="pictureGrid" style="height:400px;" id="panoramaPlayer">
                            <?php
                            $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($officeBaseinfo->ob_officeid, 6),));
                            ?>
                        </ul>
                    </div>
				</div>
			</div>
            <?php
            }
            ?>
            <!--全景结束-->
            <script language='javascript' type="text/javascript">
            <?php
            if(isset($tab)) {
            echo "document.location.hash='tab';";
            }
            ?>
            </script>
            <?php
            switch($contents){
                case "businessSummarize":
                    $this->renderPartial('_businessSummarize', array(
                        "officeBaseinfo"=>$officeBaseinfo,
                        'officePresentInfo'=>$officePresentInfo,
                        'sysbuildinfo'=>$sysbuildinfo,
                        ));
                    break;
                case "businessDetail":
                    $this->renderPartial('_businessDetail', array(
                        "officeBaseinfo"=>$officeBaseinfo,
                        'officefacility'=>$officefacility,
                        ));
                    break;
                case "businessIchnography":
                    $this->renderPartial('_businessIchnography', array(
                        "officeBaseinfo"=>$officeBaseinfo,
                        'houseTypePictures'=>$houseTypePictures,
                        ));
                    break;
                case "businessOtherPicture":
                    $this->renderPartial('_businessOtherPicture', array(
                        "officeBaseinfo"=>$officeBaseinfo,
                        'otherPictures'=>$otherPictures,
                        ));
                    break;
                case "businessComments":
                    $this->renderPartial('_businessComments', array(
                        "officeBaseinfo"=>$officeBaseinfo,
                        'recentComments'=>$recentComments,
                        'newCommentModel'=>$newCommentModel,
                        ));
                    break;
            }
            ?>
            <!--left end-->
        </div>
    </div>
    <!--left end-->
</div>
<!--content end-->
	<?php $this->endCache();
} ?>
<script type="text/javascript" language="javascript">
    $(".scrollable").scrollable({
        keyboard:true
    });
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
    document.body.oncopy = function(ev){
        ev = ev || window.event;
        alert("受保护的内容，暂不可复制！");
        return false;
    }
</script>