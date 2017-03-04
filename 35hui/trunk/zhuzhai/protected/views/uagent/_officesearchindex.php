<?php
$criteria=new CDbCriteria();
$criteria->addColumnCondition(array("ua_uid"=>$data->ob_uid));
$uagentinfo = Uagent::model()->find($criteria);
if($uagentinfo){
    //获取租售信息
    $all = Officebaseinfo::model()->getSaleOrRentSourceByUagnet($data->ob_uid, $saleOrRent, @$_GET["search"]);
    ?>
<div class="schcont">
    <div class="schdes" style=" background: none;">
        <div class="schpic">
           <?=CHtml::link(CHtml::image(User::model()->getUserHeadPic($data->ob_uid),"",array("width"=>"100","height"=>"130")),array("/uagent/index",'id'=>$uagentinfo->ua_id),array("target"=>"_blank"));?>
        </div>
        <div class="schjtxt">
            <?php $userInfo = User::model()->findByPk($data->ob_uid);?>
            <h2><span class="jjrphone"><?=$userInfo->user_tel?></span><?=CHtml::link($uagentinfo->ua_realname,array("/uagent/index",'id'=>$uagentinfo->ua_id),array("target"=>"_blank","style"=>"margin-right:5px"));?><?=User::model()->getUserLevelByUserId($data->ob_uid,$onlineUser)?><?=Uagent::model()->getAgentComboIconUrl($uagentinfo,array("style"=>"border:0;padding:0;margin-left:5px"));?></h2>
            <p><em><?=count($all)?></em>套房源满足需求</p>
            <p>综合能力：<?=$uagentinfo->ua_source?"<em>".$uagentinfo->ua_source."</em>":"暂无资料"?></p>
            <p><span class="scht_1">所在公司：<?=$uagentinfo->ua_company?></span><span class="scht_2">从业年限：<?=$uagentinfo->ua_congyeyear?(abs(date("Y")-$uagentinfo->ua_congyeyear)."年"):"暂无资料"?></span></p>
            <p>主营大厦：
                <?php
                $str = "暂无资料";
                if($uagentinfo->ua_mainbuilds){
                    $mainbuilds = unserialize($uagentinfo->ua_mainbuilds);
                    if($mainbuilds){
                        $str = "";
                        foreach($mainbuilds as $v){
                            if($v['name']){
                                $str .= CHtml::link($v['name'],array("/systembuildinginfo/view","id"=>$v['id']),array("target"=>"_blank"));
                            }
                        }
                    }
                }
                echo $str;
                ?>
            </p>
        </div>
        <div class="schtan" style="display:none">
            <div class="schbord">
                <div class="rtcont" style="display:none;">
                    <p><em><?=$uagentinfo->ua_source?><font class="dfen">分</font></em><b><?=Uagent::model()->formatUserOrder($uagentinfo->ua_ordernew)?></b></p>
                    <a href="<?=Yii::app()->createUrl("/uagent/index",array('id'=>$uagentinfo->ua_id))?>" target="_blank"><img src="/chart/radar/data/<?=Exam::model()->getChartInfo($data->ob_uid);?>/size/286x200" width="286" height="200" /></a>
                    <?php $successInfo = Successinfo::model()->getRecentInfo($data->ob_uid, 5);?>
                    <p><b>成交案例：</b></p>
                    <table cellpadding="0" cellspacing="0" border="0" class="table_08">
                        <?php
                        foreach($successInfo as $info){
                        ?>
                        <tr>
                            <td><?php echo common::strCut($info->si_companyname, 18);?></td>
                            <td><?php echo common::strCut($info->si_buildname, 18);?></td>
                            <td><?php echo Successinfo::$si_floortype[$info->si_floortype];?></td>
                            <td><?php echo $info->si_area."平米";?></td>
                        </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <img src="/images/ltip.jpg" />
            </div>
        </div>
    </div>
    <div class="tabcont">
        <table border="0" cellpadding="0" cellspacing="0" class="table_01">
            <tr style="background:#E7F1FA;">
                <td class="tit"  width="30%">大楼</td>
                <td class="tit" width="10%" >位置</td>
                <td class="tit" width="12%">面积</td>
                <td class="tit" width="20%">报价</td>
                <td class="tit" width="18%" >物业费</td>
                <td class="tit" width="10%" >看房</td>
            </tr>
            <?php
            foreach($all as $key=>$value){
                if($key>4){break;}
            ?>
            <tr>
                <td class="txt"><a href="<?=Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>$value['ob_sysid']));?>" target="_blank"><?=@$value->buildingInfo->sbi_buildingname?$value->buildingInfo->sbi_buildingname:"";?></a></td>
                <td class="txt"><?=@Officebaseinfo::$ob_floortype[$value->ob_floortype]?></td>
                <td class="txt"><?=$value->ob_officearea?>平米</td>
                <td class="txt">
                    <?php
                    if($saleOrRent==1){
                        echo $value->ob_rentprice."元/平米·天";
                    }else{
                        echo $value->ob_sumprice."万元/套";
                    }
                    ?>
                </td>
                <td class="txt">
                    <?=@$value->buildingInfo->sbi_propertyprice?$value->buildingInfo->sbi_propertyprice."元/平米•月":"暂无"?>
                </td>
                <td class="txt"><?=CHtml::link("详细",array("officebaseinfo/view","id"=>$value->ob_officeid),array("target"=>"_blank"));?></td>
            </tr>
            <?php
            }
            ?>
            
        </table>
    </div>
    <div class="gemore">
        <span attr="<?=$data->ob_uid?>" style="display:<?=count($all)>5?"block":"none"?>" max="<?=count($all)?>">查看更多</span>
        <span style="display: none">点击收起</span>
    </div>
</div>
    <?php }?>