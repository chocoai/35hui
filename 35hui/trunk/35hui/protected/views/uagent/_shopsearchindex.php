<?php
$criteria=new CDbCriteria();
$criteria->addColumnCondition(array("ua_uid"=>$data->sb_uid));
$uagentinfo = Uagent::model()->find($criteria);
if($uagentinfo){
    //获取租售信息
    $all = Shopbaseinfo::model()->getSourceByUagnet($data->sb_uid, @$_GET["search"],$type);
    ?>
<div class="schcont">
    <div class="schdes" style=" background: none;">
        <div class="schpic">
           <?=CHtml::link(CHtml::image(User::model()->getUserHeadPic($data->sb_uid),"",array("width"=>"100","height"=>"130")),array("/uagent/index",'id'=>$uagentinfo->ua_id),array("target"=>"_blank"));?>
        </div>
        <div class="schjtxt">
            <?php $userInfo = User::model()->findByPk($data->sb_uid);?>
            <h2><span class="jjrphone"><?=$userInfo->user_tel?></span><?=CHtml::link($uagentinfo->ua_realname,array("/uagent/index",'id'=>$uagentinfo->ua_id),array("target"=>"_blank","style"=>"margin-right:5px"));?><?=User::model()->getUserLevelByUserId($data->sb_uid,$onlineUser)?><?=Uagent::model()->getAgentComboIconUrl($uagentinfo,array("style"=>"border:0;padding:0;margin-left:5px"));?></h2>
            <p><em><?=count($all)?></em>套房源满足需求</p>
            <p>综合能力：<?=$uagentinfo->ua_source?"<em>".$uagentinfo->ua_source."</em>":"暂无资料"?></p>
            <p><span class="scht_1">所在公司：<?=$uagentinfo->ua_company?></span></p>
            <p><span class="scht_1">从业年限：<?=$uagentinfo->ua_congyeyear?(abs(date("Y")-$uagentinfo->ua_congyeyear)."年"):"暂无资料"?></span></p>
        </div>
        <?if(@$successInfo||@$uagentinfo->ua_source){?>
        <div class="schtan" style="display:none">
            <div class="schbord">
                <div class="rtcont" style="display:none;">
                    <?if(@$uagentinfo->ua_source){ ?>
                    <p><em><?=$uagentinfo->ua_source?><font class="dfen">分</font></em><b><?=Uagent::model()->formatUserOrder($uagentinfo->ua_ordernew)?></b></p>
                    <a href="<?=Yii::app()->createUrl("/uagent/index",array('id'=>$uagentinfo->ua_id))?>" target="_blank"><img src="/chart/radar/data/<?=Exam::model()->getChartInfo($data->sb_uid);?>/size/286x200" width="286" height="200" /></a>
                    <?php $successInfo = Successinfo::model()->getRecentInfo($data->sb_uid, 5);?>
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
                            <td><?php echo $info->si_area."㎡";?></td>
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
                <td class="tit"  width="26%">标题</td>
                <td class="tit" width="15%" >位置</td>
                <td class="tit" width="12%">面积</td>
                <td class="tit" width="20%"><?php
                    if($type==1){
                                echo "日租金";
                    }
                    if($type==2){
                                echo "单价";
                    }
                    if($type==3){
                                echo "转让费";
                    }
                    ?></td>
                <td class="tit" width="18%" ><?
                    if($type==1||$type==3){
                                echo "月租金";
                    }
                    if($type==2){
                                echo "总价";
                    }
                    ?></td>
                <td class="tit" width="10%" >看房</td>
            </tr>
            <?php
            foreach($all as $key=>$value){
                if($key>2){break;}
            ?>
            <tr>
                <td class="txt"><a href="<?=Yii::app()->createUrl("/shop/view",array("id"=>$value['sb_shopid']));?>" target="_blank" title="<?=$value->presentInfo->sp_shoptitle;?>"><?=common::strCut($value->presentInfo->sp_shoptitle,30);?></a></td>
                <td class="txt"><?=Region::model()->getNameById($value->sb_district)?>&nbsp;<?=Region::model()->getNameById($value->sb_section)?></td>
                <td class="txt"><?=$value->sb_shoparea?>㎡</td>
                <td class="txt"><?
                if($type==1){
                                echo $value->rentInfo->sr_rentprice?$value->rentInfo->sr_rentprice ."元/㎡•天":"暂无";
               }
               if($type==3){
                            $tmp="转让费面议";
                            if($data->rentInfo->sr_transferprice>0){
                                $tmp="{$data->rentInfo->sr_transferprice}万元";
                            }else if($data->rentInfo->sr_transferprice=="0"){
                                $tmp="无转让费";
                            }
                            echo $tmp;
                       
                } if($type==2){
                                echo $value->sellInfo->ss_avgprice ?$value->sellInfo->ss_avgprice  ."元/㎡":"暂无";
               }?></td>
                <td class="txt"><?php
                 if($type==1||$type==3){
                        echo $value->rentInfo->sr_monthrentprice?$value->rentInfo->sr_monthrentprice ."元/月":"暂无";
                 }else{
                        echo $value->sellInfo->ss_sumprice?$value->sellInfo->ss_sumprice ."万":"暂无";
                     
                 }?></td>
                <td class="txt"><?=CHtml::link("详细",array("shop/view","id"=>$value->sb_shopid),array("target"=>"_blank"));?></td>
            </tr>
            <?php
            }
            ?>
            
        </table>
    </div>
    <div class="gemore">
        <span attr="<?=$data->sb_uid?>" style="display:<?=count($all)>3?"block":"none"?>" max="<?=count($all)?>">查看更多</span>
        <span style="display: none">点击收起</span>
    </div>
</div>
    <?php }?>