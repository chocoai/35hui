<style type="text/css">
.scrollable {
	border:1px solid #ccc;
	background:url(<?=Yii::app()->request->baseUrl?>/tools/img/scrollable/h300.png) repeat-x;
}
</style>

<ul class="serach_moremenu">
    <li class="two"><strong><?=CHtml::link("商务中心概述",array("businessSummarize",'opid'=>$officeBaseinfo->ob_officeid),array('name'=>'tab'))?></strong></li>
    <li class="two"><strong><?=CHtml::link("商务中心详情",array("businessDetail",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="two"><strong><?=CHtml::link("平面图",array("businessIchnography",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="one"><strong>房源照片</strong></li>
    <li class="two"><strong><?=CHtml::link("商务中心点评",array("businessComments",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
</ul>
<div class="serach_morelefttwobox">
    <!--房源照片 start-->
    <div id="brightChild4">
        <h3><strong>房源照片</strong></h3>
        <?php $this->renderPartial('_businessPictureShow',array('pictures'=>$otherPictures,'type'=>2,"alt"=>$officeBaseinfo->ob_officename)); ?>
    </div>
</div>