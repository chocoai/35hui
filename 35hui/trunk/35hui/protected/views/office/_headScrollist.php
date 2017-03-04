<?php
$allModel = array();
$show = 0;
if($scrolllist) {
    foreach($scrolllist as $key=>$value) {
        if($value->sp_sourceid&&$value->baseoffice->offictag->ot_ispanorama==1) {
            $show += 1;
            $allModel[] = $value->baseoffice;
        }
    }
}
$limit = 5-$show;
if($limit) {
    $otherscrolllist = Officebaseinfo::model()->getNewPanoramaSource($limit);
    if($otherscrolllist) {
        foreach($otherscrolllist as $value) {
            $allModel[] = $value;
        }
    }
}
?>
<div class="banner">
    <div>
        <div id="shipin">
            <?php
            if(isset($allModel[0]->ob_officeid)&&$allModel[0]->ob_officeid!=""){
                $this->widget("PanoView",array(
                    "mainXml"=>Panoxml::model()->getPanoXml($allModel[0]->ob_officeid, 3),
                ));
            }
            ?>
        </div>
        <ul class="slider">
            <?php
            foreach($allModel as $k=>$v){
                $this->renderPartial('_headScroll',array("model"=>$v));
            }
            ?>
        </ul>
    </div>
</div>
<!--banner end-->
