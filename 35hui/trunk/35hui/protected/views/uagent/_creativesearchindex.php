<?php
$criteria=new CDbCriteria();
$criteria->addColumnCondition(array("ua_uid"=>$data->cr_userid));
$uagentinfo = Uagent::model()->find($criteria);
if($uagentinfo){
    //获取租售信息
    $all = Creativesource::model()->getSourceByUagnet($data->cr_userid, @$_GET["search"]);
    ?>
<div class="schcont">
    <div class="schdes" style=" background: none;">
        <div class="schpic">
           <?=CHtml::link(CHtml::image(User::model()->getUserHeadPic($data->cr_userid),"",array("width"=>"100","height"=>"130")),array("/uagent/index",'id'=>$uagentinfo->ua_id),array("target"=>"_blank"));?>
        </div>
        <div class="schjtxt">
            <?php $userInfo = User::model()->findByPk($data->cr_userid);?>
            <h2><span class="jjrphone"><?=$userInfo->user_tel?></span><?=CHtml::link($uagentinfo->ua_realname,array("/uagent/index",'id'=>$uagentinfo->ua_id),array("target"=>"_blank","style"=>"margin-right:5px"));?><?=User::model()->getUserLevelByUserId($data->cr_userid,$onlineUser)?><?=Uagent::model()->getAgentComboIconUrl($uagentinfo,array("style"=>"border:0;padding:0;margin-left:5px"));?></h2>
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
        <?if(@$successInfo||@$uagentinfo->ua_source){?>
        <div class="schtan" style="display:none">
            <div class="schbord">
                <div class="rtcont" style="display:none;">
                    <?if(@$uagentinfo->ua_source){ ?>
                    <p><em><?=$uagentinfo->ua_source?><font class="dfen">分</font></em><b><?=Uagent::model()->formatUserOrder($uagentinfo->ua_ordernew)?></b></p>
                    <a href="<?=Yii::app()->createUrl("/uagent/index",array('id'=>$uagentinfo->ua_id))?>" target="_blank"><img src="/chart/radar/data/<?=Exam::model()->getChartInfo($data->cr_userid);?>/size/286x200" width="286" height="200" /></a>
                    <?php $successInfo = Successinfo::model()->getRecentInfo($data->cr_userid, 5);?>
                    <?
                    }
                    if(@$successInfo){?>
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
                    <?}?>
                </div>
                <img src="/images/ltip.jpg" />
            </div>
        </div>
        <?}?>
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
                if($key>2){break;}
            ?>
            <tr>
                <td class="txt"><a href="<?=Yii::app()->createUrl("/creativeparkbaseinfo/view",array("id"=>$value['cr_cpid']));?>" target="_blank"><?=@$value->parkbaseinfo->cp_name?$value->parkbaseinfo->cp_name:"";?></a></td>
                <td class="txt"><?=@Officebaseinfo::$ob_floortype[$value->cr_floortype]?></td>
                <td class="txt"><?=$value->cr_area?>平米</td>
                <td class="txt"><?=$value->cr_dayrentprice."元/平米·天";?></td>
                <td class="txt">
                    <?=@$value->parkbaseinfo->cp_propertyprice?$value->parkbaseinfo->cp_propertyprice."元/平米•月":"暂无"?>
                </td>
                <td class="txt"><?=CHtml::link("详细",array("creativesource/view","id"=>$value->cr_id),array("target"=>"_blank"));?></td>
            </tr>
            <?php
            }
            ?>
            
        </table>
    </div>
    <div class="gemore">
        <span attr="<?=$data->cr_userid?>" style="display:<?=count($all)>5?"block":"none"?>" max="<?=count($all)?>">查看更多</span>
        <span style="display: none">点击收起</span>
    </div>
</div>
    <?php }?>