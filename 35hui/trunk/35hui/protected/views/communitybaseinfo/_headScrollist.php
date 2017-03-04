<?php
$allModel = array();
$show = 0;
if($scrolllist) {
    foreach($scrolllist as $key=>$value) {
        if($value->sp_sourceid&&$value->residenceInfo->residenceTag->rt_ispanorama==1) {
            $show += 1;
            $allModel[] = $value->residenceInfo;
        }
    }
}
$limit = 4-$show;
if($limit) {
    $otherscrolllist = Residencebaseinfo::model()->getNewPanoramaSource($limit);
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
            if(isset($allModel[0]->rbi_id)&&$allModel[0]->rbi_id!=""){
                $this->widget("PanoView",array(
                    "mainXml"=>Panoxml::model()->getPanoXml($allModel[0]->rbi_id, 5),
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