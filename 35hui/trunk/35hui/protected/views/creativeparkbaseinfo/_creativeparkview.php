<?php
if($data){
   $all = Creativesource::model()->getSourceByBuildid($data->cp_id);
    ?>
<div class="schcont">
    <div class="schdes" style=" height: 150px;">
        <div class="cypic"><a href="<?=Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$data->cp_id))?>" target="_blank"><img src="<?=Picture::model()->getPicByTitleInt($data->cp_titlepic,"_large");?>" /></a></div>
        <div class="cytxt">
            <h2><a href="<?=Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$data->cp_id))?>" target="_blank"><?=$data->cp_name?></a></h2>           
            <p>[ <?=Region::model()->getNameById($data->cp_district)?> ]&nbsp;&nbsp;&nbsp;<?=$data->cp_address?></p>
            <p><span class="cy_1">得房率：<?=$data->cp_defanglv?$data->cp_defanglv."%":"暂无"?></span><span class="cy_2">改建年代：<?=$data->cp_openingtime&&$data->cp_openingtime!=0?date("Y年",$data->cp_openingtime):"暂无"?></span></p>
            <p><span class="cy_1">物业费：<?=$data->cp_propertyprice?'<em style="color:#F60">'.$data->cp_propertyprice."</em>元/平米•月":"暂无"?></span><span class="cy_2" title="<?=$data->cp_propertyname?>">物业管理：<?=$data->cp_propertyname?common::strCut($data->cp_propertyname,21):"暂无"?></span></p>
            <p>咨询热线：
			<?php
			if($all){
				$cdb=new CDbCriteria();
				$cdb->select = "ua_id,ua_realname,ua_uid";
				$cdb->addColumnCondition(array("ua_uid"=>$all['cr_userid']));
				$uagent = Uagent::model()->find($cdb);
                    if($uagent){?>
                        <a href="<?=Yii::app()->createUrl("uagent/index",array("id"=>$uagent->ua_id));?>" target="_blank"><?=$uagent?$uagent->ua_realname:"";?></a>
                        <?=@$uagent->userInfo->user_tel?$uagent->userInfo->user_tel:"<span style='color:#82B937;font-weight:bold;'>400-820-9181</span>";
                    }
            }else{echo "<span style='color:#82B937;font-weight:bold;'>400-820-9181</span>";}
			?>
			</p>
        </div>
        <div class="schpk" style=" position: relative;">
            <div style=" position: absolute;left:-58px; width: 190px;">
                <div class="pkt"><?=$data->cp_avgrentprice?"<code style='color:#808080;'>参考租金：</code><em>".$data->cp_avgrentprice."</em>元/平米•天":""?></div>
                <div class="pkb" style="padding-top:3px;"><input type="checkbox" id="build_<?=$data->cp_id?>" value="<?=$data->cp_id?>" attrprice="<?=$data->cp_avgrentprice?$data->cp_avgrentprice:"0"?>" attrname="<?=common::strCut($data->cp_name,24)?>"/> <label for="build_<?=$data->cp_id?>">加入比较</label></div>
            </div>
       </div>

        <div class="schtan" style="display:none; height: 122px;">
            <div class="schbord" style="padding: 45px 0 45px 12px;">
                <div class="rtcont" style="display:none;">
                    <a href="<?=Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$data->cp_id))?>" target="_blank"><img src="<?=Picture::model()->getOnePicExceptTitleInt($data->cp_id,9,$data->cp_titlepic,"_large");?>" width="286px" height="200px"/></a>
                    <div class="tb_up" >
                    <table class="table_09" border="0" cellpadding="0" cellspace="0">
                        <tr>
                    <?=$data->cp_developer?"<td width='24%' class=tit>开发商</td><td width='76%'>".$data->cp_developer."</td>":""?>
                        </tr>
                        <tr>
                    <?=$data->cp_fengearea?"<td width='24%' class=tit>单元分割</td><td width='76%'>".$data->cp_fengearea."平米</td>":""?></tr>
                        <tr>
                    <?=$data->cp_area?"<td width='24%' class=tit>面积</td><td width='76%'>".$data->cp_area."平米</td>":""?></tr>
                        <tr>
                    <?=$data->cp_floorheight?"<td width='24%' class=tit>层高</td><td width='76%'>".$data->cp_floorheight."米</td>":""?></tr>
                    <?php
                    $tmp = "";
                    if($data->cp_carport){
                        $carportInfo = unserialize($data->cp_carport);
                        $line = 0;
                        $tmp1 = $tmp2 = "";
                        if(!empty($carportInfo["dishang"])||!empty($carportInfo["dishangyue"])||!empty($carportInfo["dishangshi"])){
                            $line++;
                            $tmp1 .= !empty($carportInfo["dishang"])?"地上".$carportInfo["dishang"]."个":"";
                            $tmp1 .= !empty($carportInfo["dishangyue"])?" 月租金".$carportInfo["dishangyue"]."元/月":"";
                            $tmp1 .= !empty($carportInfo["dishangshi"])?" 时租金".$carportInfo["dishangshi"]."元/小时":"";
                        }
                        if(!empty($carportInfo["dixia"])||!empty($carportInfo["dixiayue"])||!empty($carportInfo["dixiashi"])){
                            $line++;
                            $tmp2 .= !empty($carportInfo["dixia"])?"地下".$carportInfo["dixia"]."个":"";
                            $tmp2 .= !empty($carportInfo["dixiayue"])?" 月租金".$carportInfo["dixiayue"]."元/月":"";
                            $tmp2 .= !empty($carportInfo["dixiashi"])?" 时租金".$carportInfo["dixiashi"]."元/小时":"";
                        }
                        $tmp = $line==2?$tmp1."<br />　　　 ".$tmp2:$tmp1.$tmp2;
                    }
                    if(trim($tmp)){
                        echo "<tr><td width='24%' class=tit>车位</td><td width='76%'>".$tmp."</td></tr>";
                    }
                    $tmp = "";
                    if($data->cp_roommating){
                        $roomInfo = explode(",", $data->cp_roommating);
                        foreach($roomInfo as $value){
                            $tmp.= @Creativeparkbaseinfo::$cp_roommating[$value]." ";
                        }
                    }
                    if(trim($tmp)){
                        echo "<tr><td width='24%' class=tit>楼内</td><td width='76%'>".$tmp."</td></tr>";
                    }
                    ?>

                    </table>
                    </div>
                </div>
                <img src="/images/ltip.jpg"/>
            </div>
        </div>
    </div>
</div>
    <?php
}
?>