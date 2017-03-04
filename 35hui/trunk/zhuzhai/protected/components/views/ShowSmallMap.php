<iframe id="smalemap" name="smalemap" src="<?=Yii::app()->createUrl("map/showmap",array("width"=>$width,"height"=>$height,'type'=>$type))?>" style="width: <?=$width?>;height: <?=$height;?>" frameborder="0" scrolling="no"></iframe>
<div id="framevalue" style="display: none">
    <div id="framevalue_data"><?=$data;?></div>
    <div id="framevalue_searchAddress"><?=$searchAddress;?></div>
    <div id="framevalue_canShowTip"><?=$showTip;?></div>
    <div id="framevalue_sellorrent"><?=$sellorrent;?></div>
</div>