<div class="hidden">
    <div class="panorama_navi_show">
        <a class="prev browse left disabled"></a>
        <div class="scrollable" style="width:580px;height:130px;margin-left: auto;margin-right: auto;">
            <div class="items">
                <div>
                <?php
                    foreach($panorama as $key=>$value){
                ?>
                    <li class="item_vessel" style="width:115px">
                        <img alt="<?=$alt?>" src="<?=Panorama::model()->getThumbnailUrl($value->spn_panoramaurl);?>" va="<?=substr($value->spn_panoramaurl, strrpos($value->spn_panoramaurl, "/")+1)?>" style="cursor: pointer">
                        <div class="item_title" title="<?=$value->spn_panoramaname?>"><?=common::strCut(CHtml::encode($value->spn_panoramaname), 18)?></div>
                    </li>
                <?php
                        if(($key+1)%5==0){
                           echo "</div><div>";
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <a class="next browse right"></a>
    </div>
</div>