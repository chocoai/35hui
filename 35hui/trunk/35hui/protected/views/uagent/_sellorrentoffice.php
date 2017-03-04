<div style="text-align:center;line-height:24px;width:700px;padding:5px 10px 4px 10px;border-bottom:1px solid #E8E8E8">
<div style="width:90px;float:left"><?=Officebaseinfo::$rentorsell[$data->ob_sellorrent]?></div>
<div style="width:130px;float:left" title="<?=isset($data->buildingInfo)?$data->buildingInfo->sbi_buildingname:""?>"><?=isset($data->buildingInfo)?common::strCut($data->buildingInfo->sbi_buildingname,24,""):"&nbsp;"?></div>
<div style="width:95px;float:left"><?=Officebaseinfo::$ob_floortype[$data->ob_floortype]?></div>
<div style="width:95px;float:left"><?=$data->ob_officearea?>平方米</div>
<div style="width:105px;float:left">  <?php
                    if($data->ob_sellorrent==1){
                        echo $data->ob_rentprice."元/平米·天";
                    }else{
                        echo $data->ob_sumprice."万元/套";
                    }
                    ?></div>
<div style="width:100px;float:left"><?=isset($data->buildingInfo)?$data->buildingInfo->sbi_propertyprice."元/平米•月":"暂无"?></div>
<div style="width:70px;float:left;padding-left:10px;"> <a target="_blank" href="<?php echo $this->createUrl('officebaseinfo/view',array('id'=>$data->ob_officeid)) ?>">详细</a></div>
<div style="clear:both"></div>            
</div>