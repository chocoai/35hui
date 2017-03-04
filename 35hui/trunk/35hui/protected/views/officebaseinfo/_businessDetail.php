<ul class="serach_moremenu">
    <li class="two"><strong><?=CHtml::link("商务中心概述",array("businessSummarize",'opid'=>$officeBaseinfo->ob_officeid),array('name'=>'tab'))?></strong></li>
    <li class="one"><strong>商务中心详情</strong></li>
    <li class="two"><strong><?=CHtml::link("平面图",array("businessIchnography",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="two"><strong><?=CHtml::link("房源照片",array("businessOtherPicture",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="two"><strong><?=CHtml::link("商务中心点评",array("businessComments",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
</ul>
<div class="serach_morelefttwobox">
    <!--hiddenone start-->
    <div id="brightChild2">
        <h3><strong>商务中心基本信息</strong></h3>
        <style type="text/css">
            table tr td{
                color: black;
            }
        </style>
        <table cellpadding="0" cellspacing="0" class="serach_moretableone">
            <tr>
                <th width="106px">所在楼盘：</th>
                <td><?=$officeBaseinfo->ob_officename;?></td>
                <th>板块：</th>
                <td><?=Officebaseinfo::model()->getText($officeBaseinfo->ob_district)."&nbsp;-&nbsp;".Officebaseinfo::model()->getText($officeBaseinfo->ob_section)."(".Searchcondition::model()->getLoopName($officeBaseinfo->ob_loop).")"?></td>
            </tr>
            <tr>
                <th>写字楼级别：</th>
                <td><?php echo CHtml::encode($officeBaseinfo->OfficedegreeText)?></td>
                <th>轨道交通：</th>
                <td><?php
                if($officeBaseinfo->ob_busway){
                    $busyway = explode(",", $officeBaseinfo->ob_busway);
                    foreach($busyway as $valye){
                        echo $valye."号线&nbsp;";
                    }
                }else{
                    echo "暂无资料";
                }
                ?></td>
            </tr>
            <tr>
                <th>面积：</th>
                <td><font color="red"><?php echo CHtml::encode($officeBaseinfo->ob_officearea)?></font>&nbsp;平方米</td>
                <th>租金：</th>
                <td><font color="red"><?=$officeBaseinfo->rentInfo->or_rentprice;?></font>&nbsp;<font>元/间·月(起)</font></td>
            </tr>
            <tr>
                <th>装修程度：</th>
                <td><?php echo CHtml::encode($officeBaseinfo->AdrondegreeText)?></td>
                <th>物业公司：</th>
                <td><?php echo $officeBaseinfo->ob_propertycomname?CHtml::encode($officeBaseinfo->ob_propertycomname):"暂无资料"?></td>
            </tr>
            <tr>
                <th>物业费：</th>
                <td><?php echo $officeBaseinfo->ob_propertycost?CHtml::encode($officeBaseinfo->ob_propertycost)."元/天":"暂无资料"?></td>
                <th>是否涉外：</th>
                <td><?php echo $officeBaseinfo->ForeignText;?></td>
            </tr>
            <tr>
                <th>楼盘年代：</th>
                <td><?=$officeBaseinfo->ob_buildingera?date("Y", $officeBaseinfo->ob_buildingera)."年":"暂无资料"?></td>
                <th>楼层：</th>
                <td><?php echo Officebaseinfo::$ob_floortype[$officeBaseinfo->ob_floortype]?></td>
            </tr>
            <tr>
                <th>发布时间：</th>
                <td><?php echo date('Y/m/d H:i:s',$officeBaseinfo->ob_releasedate)?></td>
            </tr>

        </table>
        <h3><strong>基本设施信息</strong></h3>
        <?php if($officefacility){ ?>
        <table cellpadding="0" cellspacing="0" class="serach_moretableone">
            <tr>
                <th  width="106px">停车位：</th>
                <td><?php echo $officefacility->carparkingText?></td>
                <th>暖气：</th>
                <td><?php echo $officefacility->WarmingText?></td>
            </tr>

            <tr>
                <th>网络：</th>
                <td><?php echo $officefacility->NetworkText?></td>
                <th>水电：</th>
                <td><?php echo $officefacility->ElecwaterText?></td>
            </tr>

            <tr>
                <th>货梯：</th>
                <td><?php echo $officefacility->ElevatorText?></td>
                <th>电梯：</th>
                <td><?php echo $officefacility->LiftText?></td>
            </tr>

            <tr>
                <th>天然气：</th>
                <td><?php echo $officefacility->GasText ?></td>
                <th>空调：</th>
                <td><?php echo $officefacility->AirconditionText?></td>
            </tr>

            <tr>
                <th>电视：</th>
                <td><?php echo $officefacility->TvText?></td>
                <th>防盗门：</th>
                <td><?php echo $officefacility->DoorText ?></td>
            </tr>
        </table>
        <?php
            } else {
                echo "<span style='color:red'>抱歉，该房源暂未提供其基础设施的相关信息！</span>";
            }
        ?>
    </div>
    <!--hiddenone end-->
</div>