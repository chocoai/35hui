<div class="w725">
        <div><h3><strong>基本资料</strong></h3><a href="#top"><div class="gotop"></div></a><a name="info"></a>
            <h5><?=$communityInfo->comy_name?>&nbsp;&nbsp;基本信息</h5>
            <table border="0" width="100%" class="table">
                <tr><th width="15%">地址：</th>
                    <td width="35%"><?=$communityInfo->comy_address?></td>
                    <th width="15%">均价：</th>
                    <td width="35%"><?=$communityInfo->comy_avgsellprice?'<font class="price3">'.$communityInfo->comy_avgsellprice.'</font>元/平米':'暂无资料'?></td>
                </tr>
                <tr><th width="15%">区域板块：</th>
                    <td width="35%"><?=Region::model()->getNameById($communityInfo->comy_district);?></td>
                    <th width="15%">总建筑面积：</th>
                    <td width="35%"><?=$communityInfo->comy_buildingarea?$communityInfo->comy_buildingarea.'平方米':'暂无资料';?></td>
                </tr>
                <tr>
                    <th width="15%">物业类型：</th>
                    <td width="35%"><?=$communityInfo->getPropertytypeName($communityInfo->comy_propertytype);?></td>
                    <th width="15%">容积率：</th>
                    <td width="35%"><?=$communityInfo->comy_cubagerate?$communityInfo->comy_cubagerate:"暂无资料";?></td>
                </tr>
                <tr>
                    <th width="15%">开发商：</th>
                    <td width="35%"><?=$communityInfo->comy_developer?$communityInfo->comy_developer:"暂无资料";?></td>
                    <th width="15%">绿化率：</th>
                    <td width="35%"><?=$communityInfo->comy_afforestation?$communityInfo->comy_afforestation."%":"暂无资料";?></td>
                </tr>
                <tr><th width="15%">物业公司：</th>
                    <td width="35%"><?=$communityInfo->comy_propertyname?$communityInfo->comy_propertyname:"暂无资料";?></td>
                    <th width="15%">总户数：</th>
                    <td width="35%"><?=$communityInfo->comy_householdnum?$communityInfo->comy_householdnum."户":"暂无资料";?></td>
                </tr>
                <tr>
                    <th width="15%">物业管理费：</th>
                    <td width="35%"><?=$communityInfo->comy_propertyprice?$communityInfo->comy_propertyprice."元/平方米/月":"暂无资料";?></td>
                    <th width="15%">停车位：</th>
                    <td width="35%"><?=$communityInfo->comy_parking?$communityInfo->comy_parking."个":"暂无资料";?></td>
                </tr>
                <tr>
                    <th width="15%">竣工日期：</th>
                    <td width="35%"><?php
                    if($communityInfo->comy_buildingera){
                        if($communityInfo->comy_buildingera>3000){
                            echo date("Y年",$communityInfo->comy_buildingera);
                        }else{
                            echo $communityInfo->comy_buildingera."年";
                        }
                    }else{
                        echo "暂无资料";
                    }
                    ?></td>
                </tr>

            </table>
        </div>
        <h5><?=$communityInfo->comy_name?>&nbsp;&nbsp;周边配套</h5>
        <table border="0" width="100%" class="table">
            <tr>
                <th width="10%">学校：</th>
                <td width="90%"><?=$communityInfo->comy_school?$communityInfo->comy_school:"暂无资料";?></td>
            </tr>
            <tr><th width="10%">交通：</th>
                <td width="90%">
                    <?php
                    if($communityInfo->comy_traffic) {
                        $trafficArray = split(",",$communityInfo->comy_traffic);
                        $arraySize = count($trafficArray);
                        for($i = 0; $i < $arraySize; $i++) {
                            $Info = Subway::model()->getInfoById($trafficArray[$i]);
                            if($Info != "") {
                                $stationName = @$Info->sw_stationname;
                    ?>
                            <a alt="<?php echo $stationName;?>" title="<?php echo $stationName;?>" target="_blank" style="cursor: pointer;" href="<?=Yii::app()->createUrl("/map/map/coordinate/".$trafficArray[$i])?>"><?php echo $stationName."(".Subway::model()->getInfoById($Info->sw_parentid)->sw_stationname.")";?></a>
                    <?php
                                if($i > 0 && $i != $arraySize-2){echo "、";}
                                    }

                                }

                            } else {
                                echo "暂无资料";
                            }
                    ?>
                </td>
            </tr>
            <tr><th width="10%">购物：</th>
                <td width="90%"><?=$communityInfo->comy_shopping?$communityInfo->comy_shopping:"暂无资料";?></td>
            </tr>
            <tr><th width="10%">银行：</th>
                <td width="90%"><?=$communityInfo->comy_bank?$communityInfo->comy_bank:"暂无资料";?></td>
            </tr>
            <tr><th width="10%">医院：</th>
                <td width="90%"><?=$communityInfo->comy_hospital?$communityInfo->comy_hospital:"暂无资料";?></td>
            </tr>
            <tr><th width="10%">餐饮：</th>
                <td width="90%"><?=$communityInfo->comy_dining?$communityInfo->comy_dining:"暂无资料";?></td>
            </tr>
            <tr><th width="10%">菜场：</th>
                <td width="90%"><?=$communityInfo->comy_vegetables?$communityInfo->comy_vegetables:"暂无资料";?></td>
            </tr>
        </table>
    </div>