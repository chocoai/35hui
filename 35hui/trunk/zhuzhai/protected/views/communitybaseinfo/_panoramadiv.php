<div class="hidden">
    <div class="panorama_navi_show">
        <a class="prev browse left disabled"></a>
        <div class="scrollable" style="width: 580px; height: 130px; margin-left: auto; margin-right: auto;">
            <div class="items" >
                <div>
                    <?
                    for($i=0;$i<count($panorama);$i++) {
                    ?>
                        <li style="width: 115px;" class="item_vessel">
                            <img alt="<?=$alt?>" src="<?=Panorama::model()->getThumbnailUrl($panorama[$i]['p_url']);?>" va="<?=substr($panorama[$i]['p_url'], strrpos($panorama[$i]['p_url'], "/")+1);?>" style="cursor: pointer"/>
                            <div class="item_title"><?=$panorama[$i]['p_title']?></div>
                        </li>
                
                    <?
                        if(($i+1)%5==0){
                           echo "</div><div style='width:580px;'>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <a class="next browse right"></a>
    </div>
</div>