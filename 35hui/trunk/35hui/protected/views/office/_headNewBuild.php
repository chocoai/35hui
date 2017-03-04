<div class="dt_bian">
        <div class="jb">
            <div class="dt_title"></div>
            <div class="cs_left">
                <div class="gz_title" style="margin-bottom:0;">新推楼盘</div>
                <div class="gd" style="text-align:right; padding-top: 10px;"><a href="<?php echo Yii::app()->createUrl("systembuildinginfo/buildlist"); ?>" target="_blank">更多>></a></div>
                    <?php
                    if($newBuild!=""&& $NBc = count($newBuild)) {//显示前两个
                        ?>
                <div id="marquee-build" pause="3000" style="height:370px; overflow:hidden; clear:both;">
                    <ul class="xtlp_xzul">
                                <?php
                                //$NBc = ceil($NBc/2);
                                for($i=0;$i<$NBc;$i++) {
                                    ?>
                        <li>
                            <div class="xtlp_xz">
                                <div class="xtlp_image ">
                                    <a href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$newBuild[$i]['sbi_buildingid'])) ?>" target="_blank"><?=CHtml::image(Picture::model()->getPicByTitleInt($newBuild[$i]['sbi_titlepic'],"_small"), $newBuild[$i]['sbi_buildingname'], array('class'=>'img_border','border'=>'0','width'=>"130px", 'height'=>"90px"));?></a>
                                </div>
                                <div class="house_wz2" style="width:130px">
                                    <p class="lb12"><b><?=CHtml::link(common::strCut(CHtml::encode($newBuild[$i]['sbi_buildingname']),20),array('systembuildinginfo/view',"id"=>$newBuild[$i]['sbi_buildingid']),array('target'=>'_blank','title'=>$newBuild[$i]['sbi_buildingname']))?></b></p>
                                                <?php $tradecircle = Region::model()->getNameById($newBuild[$i]['sbi_district']).Region::model()->getNameById($newBuild[$i]['sbi_section']);?>
                                    <p class="black12px">商圈：<span class="green12px" title="<?=$tradecircle?>"><?php echo common::strCut($tradecircle,18) ?></span></p>
                                    <p class="black12px">均价：<span class="green12px"><?php echo $newBuild[$i]['sbi_avgsellprice']?$newBuild[$i]['sbi_avgsellprice'].'元/平米':'暂无资料';?></span></p>
                                </div>
                            </div>
                                        <?php
                                        if(isset($newBuild[++$i]['sbi_buildingid'])) {
                                            ?>
                            <div class="xtlp_xz">
                                <div class="xtlp_image ">
                                    <a href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$newBuild[$i]['sbi_buildingid'])) ?>" target="_blank"><?=CHtml::image(Picture::model()->getPicByTitleInt($newBuild[$i]['sbi_titlepic'],"_small"), $newBuild[$i]['sbi_buildingname'], array('class'=>'img_border','border'=>'0','width'=>"135px", 'height'=>"90px"));?></a>
                                </div>
                                <div class="house_wz2" style="width:130px">
                                    <p class="lb12"><b><?=CHtml::link(common::strCut(CHtml::encode($newBuild[$i]['sbi_buildingname']),20),array('systembuildinginfo/view',"id"=>$newBuild[$i]['sbi_buildingid']),array('target'=>'_blank','title'=>$newBuild[$i]['sbi_buildingname']))?></b></p>
                                                    <?php $tradecircle = Region::model()->getNameById($newBuild[$i]['sbi_district']).Region::model()->getNameById($newBuild[$i]['sbi_section']);?>
                                    <p class="black12px">商圈：<span class=
                                                                  "green12px" title="<?=$tradecircle?>"><?php echo common::strCut($tradecircle,18) ?></span></p>
                                    <p class="black12px">均价：<span class="green12px"><?php echo $newBuild[$i]['sbi_avgsellprice']?$newBuild[$i]['sbi_avgsellprice'].'元/平米':'暂无资料';?></span></p>
                                </div>
                            </div>
                                            <?php } ?>
                        </li>
                                    <?php } ?>
                    </ul>
                </div>
                        <?php } ?>

            </div>
            <div class="jiange2"> </div>
            <div class="cs_left">
                <div class="gz_title" style="margin-bottom:0;">楼盘动态</div>
                <div class="gd" style="text-align:right; padding-top: 10px;">
                        <?=CHtml::link("更多>>",array("systembuildinginfo/index"),array("target"=>"_blank"))?>
                </div>
                <div class="clear5"></div>
                <div style="height: 365px; overflow: hidden; clear: both;" pause="3000" id="marquee-lpdt" class="lpdt_xx">
                    <ul>
                            <?php
                            if($twitter!="") {
                                foreach($twitter as $value) {
                                    ?>
                        <li>
                            <table border="0" width="335px">
                                <tr>
                                    <td>
                                         <?=CHtml::link(common::strCut(CHtml::encode($value->buildingInfo->sbi_buildingname),24)."：",array("/systembuildinginfo/view","id"=>$value->buildingInfo->sbi_buildingid),array("target"=>"_blank","title"=>$value->buildingInfo->sbi_buildingname))?><font title="<?=$value->t_message?>"><?=common::strCut(CHtml::encode($value->t_message),39); ?></font>
                                    </td>
                                </tr>
                            </table>
                        </li>
                                    <?php
                                }
                            }
                            ?>
                    </ul>
                </div>
            </div>
            <div class="c"></div>
            <div class="dt_bottom"></div>
        </div>
    </div>
