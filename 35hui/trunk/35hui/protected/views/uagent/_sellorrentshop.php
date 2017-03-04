<div style="text-align:center;line-height:24px;width:700px;padding:5px 10px 4px 10px;border-bottom:1px solid #E8E8E8">
<div style="width:90px;float:left"><?=$data->sb_sellorrent==2?Shopbaseinfo::$sb_sellorrent[$data->sb_sellorrent]:Shopbaseinfo::$rengtype[$data->rentInfo->sr_renttype]?></div>
<div style="width:130px;float:left" title="<?=$data->presentInfo->sp_shoptitle?>"><?=common::strCut($data->presentInfo->sp_shoptitle,30);?></div>
<div style="width:95px;float:left"><?=Region::model()->getNameById($data->sb_district)?>&nbsp;<?=Region::model()->getNameById($data->sb_section)?></div>
<div style="width:95px;float:left"><?=$data->sb_shoparea?>㎡</div>
<div style="width:105px;float:left"><?
if($data->sb_sellorrent==2){
	echo $data->sellInfo->ss_sumprice."万/套";
}else{
	echo $data->rentInfo->sr_monthrentprice."元/月" ;
	
}
?></div>
<div style="width:100px;float:left"><?
if($data->sb_sellorrent==2){
	echo $data->sellInfo->ss_avgprice."元/㎡";
}else{
	if($data->rentInfo->sr_renttype==1){
		echo $data->rentInfo->sr_rentprice."元/㎡·天";
	}else{
		$tmp="转让费面议";
		if($data->rentInfo->sr_transferprice>0){
			$tmp="<em>{$data->rentInfo->sr_transferprice}</em>万元 转让";
		}else if($data->rentInfo->sr_transferprice=="0"){
			$tmp="无转让费";
		}
		echo $tmp;
	}
}
?></div>
<div style="width:70px;float:left;padding-left:10px;"> <a target="_blank" href="<?=Yii::app()->createUrl("shop/view",array("id"=>$data->sb_shopid))?>">详细</a></div>
<div style="clear:both"></div>            
</div>