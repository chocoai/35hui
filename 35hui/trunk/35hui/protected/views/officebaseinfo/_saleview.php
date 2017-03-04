<?php
$criteria=new CDbCriteria();
$criteria->select = "sbi_titlepic,sbi_buildingname,sbi_buildingid,sbi_district,sbi_section,sbi_address,sbi_propertydegree,sbi_defanglv,sbi_avgsellprice,sbi_avgrentprice,sbi_propertyprice,sbi_openingtime,sbi_propertyname,sbi_developer,sbi_danyuanfenge,sbi_buildingarea,sbi_floorinfo,sbi_biaozhun,sbi_carport,sbi_liftinfo,sbi_roommating";
$buildinfo = Systembuildinginfo::model()->findByPk($data->ob_sysid,$criteria);
if($buildinfo){
    //获取租售信息
    $all = Officebaseinfo::model()->getSaleOrRentSourceByCondition($buildinfo->sbi_buildingid, 2, @$_GET["search"]);
    ?>
<div class="schcont">
    <div class="schdes" style=" background: none;">
        <div class="schpic"><a href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$data->ob_sysid,"srtp"=>"2"))?>" target="_blank"><img src="<?=Picture::model()->getPicByTitleInt($buildinfo->sbi_titlepic,"_normal");?>" /></a></div>
        <div class="schtxt">
            <h2><a href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$data->ob_sysid,"srtp"=>"2"))?>" target="_blank"><?=$buildinfo->sbi_buildingname?></a></h2>
            <p><em><?=count($all)?></em>套房源满足需求</p>
            <p><?php
                    echo "[ ".Region::model()->getNameById($buildinfo->sbi_district)." ".Region::model()->getNameById($buildinfo->sbi_section)." ]&nbsp;&nbsp;&nbsp;";
                    echo common::strCut($buildinfo->sbi_address,42)."&nbsp;&nbsp;&nbsp; ";
                    echo Systembuildinginfo::model()->propertyIntToDescribe($buildinfo->sbi_propertydegree);
                    ?></p>
            <p><span class="scht_1">得房率：<?=$buildinfo->sbi_defanglv?$buildinfo->sbi_defanglv."%":"暂无"?></span><span class="scht_2">竣工时间：<?=$buildinfo->sbi_openingtime&&$buildinfo->sbi_openingtime!=0?date("Y年",$buildinfo->sbi_openingtime):"暂无"?></span></p>
            <p><span class="scht_1">物业费：<?=$buildinfo->sbi_propertyprice?'<em style="color:#F60">'.$buildinfo->sbi_propertyprice."</em>元/平米•月":"暂无"?></span><span class="scht_2">物业管理：<?=$buildinfo->sbi_propertyname?common::strCut($buildinfo->sbi_propertyname,39):"暂无"?></span></p>
            <p>开发商：<?=$buildinfo->sbi_developer?$buildinfo->sbi_developer:"暂无"?></p>
        </div>
        <div class="schpk" style="position: relative;">
            <div style=" position: absolute;left:-58px; width: 190px;">
                <div class="pkt"><?=$buildinfo->sbi_avgsellprice?"<code style='color:#808080;'>参考售价：</code><em>".$buildinfo->sbi_avgsellprice."</em>元/平米":""?></div>
            <div class="pkb" style="padding-top:23px;"><input type="checkbox" id="build_<?=$data->ob_sysid?>" value="<?=$data->ob_sysid?>" attrprice="<?=$buildinfo->sbi_avgsellprice?$buildinfo->sbi_avgsellprice:"0"?>" attrname="<?=common::strCut($buildinfo->sbi_buildingname,24)?>"/> <label for="build_<?=$data->ob_sysid?>">加入比较</label></div>
        </div></div>

        <div class="schtan" style="display:none">
            <div class="schbord">
                <div class="rtcont" style="display:none">
                    <a href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$data->ob_sysid,"srtp"=>"2"))?>" target="_blank"><img src="<?=Picture::model()->getOnePicExceptTitleInt($data->ob_sysid,1,$buildinfo->sbi_titlepic,"_large");?>" width="286px" height="200px"/></a>
                    <div class="tb_up">
                    <table class="table_09" border="0" cellpadding="0" cellspace="0">
                        <tr>
                    <?=$buildinfo->sbi_developer?' <td width="24%" class=tit>开发商</td><td width="76%">'.$buildinfo->sbi_developer.'</td>':""?></tr>
                        <tr>
                    <?=$buildinfo->sbi_danyuanfenge?' <td width="24%" class=tit>单元分割</td><td width="76%">'.$buildinfo->sbi_danyuanfenge."平米".'</td>':""?></tr>
                        <tr>
                    <?=$buildinfo->sbi_buildingarea?'<td width="24%" class=tit>面积</td><td width="76%">'.$buildinfo->sbi_buildingarea."平米".'</td>':""?></tr>
                    <?php
                    $tmp="";
                    if($buildinfo->sbi_floorinfo){
                        $floorInfo = unserialize($buildinfo->sbi_floorinfo);
                        if(isset($floorInfo["净层高"])&&$floorInfo["净层高"]){
                            $tmp = $floorInfo["净层高"]."米";
                        }
                    }
                    if(trim($tmp)){
                        echo "<tr><td width='24%' class=tit>净层高</td><td width='76%'>".$tmp."</td></tr>";
                    }
                    $tmp="";
                    if($buildinfo->sbi_biaozhun){
                        $biaozhunInfo = unserialize($buildinfo->sbi_biaozhun);
                        $tmp = implode(" ", $biaozhunInfo);

                    }
                    if(trim($tmp)){
                        echo "<tr><td width='24%' class=tit>交屋标准</td><td width='76%'>".$tmp."</td></tr>";
                    }
                    $tmp="";
                    if($buildinfo->sbi_carport){
                        $carportInfo = unserialize($buildinfo->sbi_carport);
                        if(isset($carportInfo["地上"])&&$carportInfo["地上"]){
                            $tmp .= "地上".$carportInfo["地上"]."个";
                        }
                        if(isset($carportInfo["地下"])&&$carportInfo["地下"]){
                            $tmp .= " 地下".$carportInfo["地下"]."个";
                        }
                    }
                    if(trim($tmp)){
                        echo "<tr><td width='24%' class=tit>车位配置</td><td width='76%'>".$tmp."</td></tr>";
                    }
                    $tmp="";
                    if($buildinfo->sbi_liftinfo){
                        $liftInfo = unserialize($buildinfo->sbi_liftinfo);
                        if(isset($liftInfo["客梯"])&&$liftInfo["客梯"]){
                            $tmp .= "客梯".$liftInfo["客梯"]."部";
                        }
                        if(isset($carportInfo["货梯"])&&$carportInfo["货梯"]){
                            $tmp .= " 货梯".$liftInfo["货梯"]."部";
                        }
                    }
                    if(trim($tmp)){
                        echo"<tr><td width='24%' class=tit>电梯配置</td><td width='76%'>".$tmp."</td></tr>";
                    }
                    $tmp="";
                    if($buildinfo->sbi_roommating){
                        $roomInfo = unserialize($buildinfo->sbi_roommating);
                        foreach($roomInfo as $key=>$value){
                            if($value){
                                $tmp.=$key." ";
                            }
                        }
                    }
                    if(trim($tmp)){
                        echo"<tr><td width='24%' class=tit>楼内配置</td><td width='76%'>".$tmp."</td></tr>";
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
                <td class="tit" width="50px">位置</td>
                <td class="tit" width="70px">面积</td>
                <td class="tit" width="120px">售价</td>
                <td class="tit" width="70px">联系人</td>
                <td class="tit" width="200px">联系方式</td>
                <td class="tit">看房</td>
            </tr>
                <?php
                foreach($all as $key=>$value){
                    $cdb=new CDbCriteria();
                    $cdb->select = "ua_id,ua_uid,ua_realname";
                    $cdb->addColumnCondition(array("ua_uid"=>$value->ob_uid));
                    $uagent = Uagent::model()->find($cdb);
                    if($key>2){break;}
                    ?>
            <tr>
                <td class="txt"><?=@Officebaseinfo::$ob_floortype[$value->ob_floortype]?></td>
                <td class="txt"><?=$value->ob_officearea?>平米</td>
                <td class="txt"><?=$value->ob_sumprice."万元/套"?></td>
                <td class="txt"><a href="<?=Yii::app()->createUrl("uagent/index",array("id"=>$uagent->ua_id));?>" target="_blank"><?=$uagent?$uagent->ua_realname:"";?></a></td>
                <td class="txt"><?=$uagent?$uagent->userInfo->user_tel:"";?></td>
                <td class="txt"><?=CHtml::link("详细",array("officebaseinfo/view","id"=>$value->ob_officeid),array("target"=>"_blank"));?></td>
            </tr>
                    <?php
                }
                ?>

        </table>
    </div>
    <div class="gemore">
        <span attr="<?=$data->ob_sysid?>" style="display:<?=count($all)>5?"block":"none"?>" max="<?=count($all)?>">查看更多</span>
        <span style="display: none">点击收起</span>
    </div>
</div>
    <?php
}
?>