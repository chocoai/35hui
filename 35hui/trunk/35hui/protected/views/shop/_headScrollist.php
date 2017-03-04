<div class="banner">
    <div>
        <div id="shipin">
            <?php
                $allModel = array();
                $show = 0;
                if($scrolllist) {
                    foreach($scrolllist as $key=>$value) {
                        if($value->sp_sourceid&&$value->shopInfo->shopTag->st_ispanorama==1) {
                            $show += 1;
                            $allModel[] = $value->shopInfo;
                        }
                    }
                }
                $limit = 5-$show;
                if($limit) {
                    $otherscrolllist = Shopbaseinfo::model()->getNewPanoramaSource($limit);
                    if($otherscrolllist) {
                        foreach($otherscrolllist as $value) {
                            $allModel[] = $value;
                        }
                    }
                }
                
            if(isset($allModel[0]->sb_shopid)&&$allModel[0]->sb_shopid!=""){
                $this->widget("PanoView",array(
                    "mainXml"=>Panoxml::model()->getPanoXml($allModel[0]->sb_shopid, 4),
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