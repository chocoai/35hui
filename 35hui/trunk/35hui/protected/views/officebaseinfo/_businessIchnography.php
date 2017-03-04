<ul class="serach_moremenu">
    <li class="two"><strong><?=CHtml::link("商务中心概述",array("businessSummarize",'opid'=>$officeBaseinfo->ob_officeid),array('name'=>'tab'))?></strong></li>
    <li class="two"><strong><?=CHtml::link("商务中心详情",array("businessDetail",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="one"><strong>平面图</strong></li>
    <li class="two"><strong><?=CHtml::link("房源照片",array("businessOtherPicture",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="two"><strong><?=CHtml::link("商务中心点评",array("businessComments",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
</ul>
<div class="serach_morelefttwobox">
    <!--平面图 start-->
    <div id="brightChild3">
        <h3><strong>平面图</strong></h3>
        <?php $this->renderPartial('_businessPictureShow',array('pictures'=>$houseTypePictures,'type'=>'1',"alt"=>$officeBaseinfo->ob_officename)); ?>
    </div>
</div>
