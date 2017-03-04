<?php
$criteria=new CDbCriteria();
//$criteria->select = "cp_titlepic,sbi_buildingname,sbi_buildingid,sbi_district,sbi_section,sbi_address,sbi_propertydegree,sbi_defanglv,sbi_avgrentprice,sbi_propertyprice,sbi_openingtime,sbi_propertyname,sbi_developer,sbi_danyuanfenge,sbi_buildingarea,sbi_floorinfo,sbi_biaozhun,sbi_carport,sbi_liftinfo,sbi_roommating";
$cyparkinfo = Creativeparkbaseinfo::model()->findByPk($data->cr_cpid,$criteria);
if($cyparkinfo){
    //获取租售信息
    $all = Creativesource::model()->getRentSourceByCondition($cyparkinfo->cp_id, @$_GET["search"]);
    ?>
<div class="schcont">
    <div class="schdes" style=" background: none; height: 140px;">
        <div class="cypic"><a href="<?=Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$data->cr_cpid))?>" target="_blank"><img src="<?=Picture::model()->getPicByTitleInt($cyparkinfo->cp_titlepic,"_large");?>" /></a></div>
        <div class="cytxt">
            <h2><a href="<?=Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$data->cr_cpid))?>" target="_blank"><?=$cyparkinfo->cp_name?></a></h2>
            <p><em><?=count($all)?></em>套房源满足需求</p>
            <p>[ <?=Region::model()->getNameById($cyparkinfo->cp_district)?> ]&nbsp;&nbsp;&nbsp;<?=$cyparkinfo->cp_address?></p>
            <p><span class="cy_1">得房率：<?=$cyparkinfo->cp_defanglv?$cyparkinfo->cp_defanglv."%":"暂无"?></span><span class="cy_2">改建年代：<?=$cyparkinfo->cp_openingtime&&$cyparkinfo->cp_openingtime!=0?date("Y年",$cyparkinfo->cp_openingtime):"暂无"?></span></p>
            <p><span class="cy_1">物业费：<?=$cyparkinfo->cp_propertyprice?"<em style='color:#F60'>".$cyparkinfo->cp_propertyprice."</em>元/平米•月":"暂无"?></span><span class="cy_2">管理公司：<?=$cyparkinfo->cp_propertyname?common::strCut($cyparkinfo->cp_propertyname,39):"暂无"?></span></p>
        </div>
        <div class="schpk" style=" position: relative;">
            <div style=" position: absolute;left:-58px; width: 190px;">
                <div class="pkt"><?=$cyparkinfo->cp_avgrentprice?"<code style='color:#808080;'>参考租金：</code><em>".$cyparkinfo->cp_avgrentprice."</em>元/平米•天":""?></div>
                <div class="pkb" style="padding-top:3px;"><input type="checkbox" id="build_<?=$data->cr_cpid?>" value="<?=$data->cr_cpid?>" attrprice="<?=$cyparkinfo->cp_avgrentprice?$cyparkinfo->cp_avgrentprice:"0"?>" attrname="<?=common::strCut($cyparkinfo->cp_name,24)?>"/> <label for="build_<?=$data->cr_cpid?>">加入比较</label></div>
            </div>
        </div>
        <div class="schtan" style="display:none; height: 122px;">
            <div class="schbord" style="padding: 45px 0 45px 12px;">
                <div class="rtcont" style="display:none;">
                    <a href="<?=Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$data->cr_cpid))?>" target="_blank"><img src="<?=Picture::model()->getOnePicExceptTitleInt($data->cr_cpid,9,$cyparkinfo->cp_titlepic,"_large");?>" width="286px" height="200px"/></a>
                    <div class="tb_up">
                    <table class="table_09" border="0" cellpadding="0" cellspace="0">
                        <tr>
                    <?=$cyparkinfo->cp_developer?"<td width='24%' class=tit>开发商</td><td width='76%'>".$cyparkinfo->cp_developer."</td>":""?>
                        </tr>
                        <tr>
                    <?=$cyparkinfo->cp_fengearea?"<td width='24%' class=tit>单元分割</td><td width='76%'>".$cyparkinfo->cp_fengearea."平米</td>":""?></tr>
                        <tr>
                    <?=$cyparkinfo->cp_area?"<td width='24%' class=tit>面积</td><td width='76%'>".$cyparkinfo->cp_area."平米</td>":""?></tr>
                        <tr>
                    <?=$cyparkinfo->cp_floorheight?"<td width='24%' class=tit>层高</td><td width='76%'>".$cyparkinfo->cp_floorheight."米</td>":""?></tr>
                    <?php
                    $tmp = "";
                    if($cyparkinfo->cp_carport){
                        $carportInfo = unserialize($cyparkinfo->cp_carport);
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
                    if($cyparkinfo->cp_roommating){
                        $roomInfo = explode(",", $cyparkinfo->cp_roommating);
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
    <div class="tabcont">
        <table border="0" cellpadding="0" cellspacing="0" class="table_01">
            <tr style="background:#E7F1FA;">
                <td class="tit" width="80px">楼栋</td>
                <td class="tit" width="50px">位置</td>
                <td class="tit" width="70px">面积</td>
                <td class="tit" width="120px">报价</td>
                <td class="tit" width="70px">联系人</td>
                <td class="tit" width="100px">联系方式</td>
                <td class="tit">看房</td>
            </tr>
                <?php
                foreach($all as $key=>$value){
                    $cdb=new CDbCriteria();
                    $cdb->select = "ua_id,ua_realname,ua_uid";
                    $cdb->addColumnCondition(array("ua_uid"=>$value->cr_userid));
                    $uagent = Uagent::model()->find($cdb);
                    if($key>2){break;}
                    ?>
            <tr>
                <td class="txt"><?=$value->cr_dongname?></td>
                <td class="txt"><?=@Officebaseinfo::$ob_floortype[$value->cr_floortype]?></td>
                <td class="txt"><?=$value->cr_area?>平米</td>
                <td class="txt"><?=$value->cr_dayrentprice."元/平米·天"?></td>
                <td class="txt"><a href="<?=Yii::app()->createUrl("uagent/index",array("id"=>$uagent->ua_id));?>" target="_blank"><?=$uagent?$uagent->ua_realname:"";?></a></td>
                <td class="txt"><?=@$uagent->userInfo->user_tel;?></td>
                <td class="txt"><?=CHtml::link("详细",array("creativesource/view","id"=>$value->cr_id),array("target"=>"_blank"));?></td>
            </tr>
                    <?php
                }
                ?>

        </table>
    </div>
    <div class="gemore">
        <span attr="<?=$data->cr_cpid?>" style="display:<?=count($all)>5?"block":"none"?>" max="<?=count($all)?>">查看更多</span>
        <span style="display: none">点击收起</span>
    </div>
</div>
    <?php
}
?>