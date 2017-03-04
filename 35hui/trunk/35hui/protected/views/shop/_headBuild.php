<div class="w720">
    <b class="xtop">
        <b class="xb1"></b>
        <b class="xb2"></b>
        <b class="xb3"></b>
    </b>
    <div class="border" style="min-height:375px; height: 375px;">
        <div class="cs_left">
            <div class="orange_title">新推商业广场</div>
            <div class="gd" style="text-align:right; padding-top: 10px;"><a href="<?php echo Yii::app()->createUrl("systembuildinginfo/shopbuildlist"); ?>" target="_blank">更多>></a></div>
            <?php
            if($newBuild!=""&& $NBc = count($newBuild)) {//显示前两个
                ?>
            <div id="marquee-build" pause="3000" style=" height: 370px; overflow: hidden; clear:both;">
                <ul class="xtlp_xzul">
                        <?php
                        for($i=0;$i<$NBc;$i++) {
                            ?>
                    <li><div class="xtlp_xz">
                            <div class="xtlp_image ">
                                <a href="<?=Yii::app()->createUrl("systembuildinginfo/viewshop",array("id"=>$newBuild[$i]['sbi_buildingid'])) ?>" target="_blank"><?=CHtml::image(Picture::model()->getPicByTitleInt($newBuild[$i]['sbi_titlepic'],"_small"), $newBuild[$i]['sbi_buildingname'], array('class'=>'img_border','border'=>'0','width'=>"135px", 'height'=>"90px"));?></a>
                            </div>
                            <div class="house_wz2" style="width:130px">
                                <p class="lb12"><b><?=CHtml::link(common::strCut(CHtml::encode($newBuild[$i]['sbi_buildingname']),20),array('systembuildinginfo/viewshop',"id"=>$newBuild[$i]['sbi_buildingid']),array('target'=>'_blank','title'=>$newBuild[$i]['sbi_buildingname']))?></b></p>
                                        <?php $tradecircle = Region::model()->getNameById($newBuild[$i]['sbi_district']).Region::model()->getNameById($newBuild[$i]['sbi_section']);?>
                                <p class="black12px">商圈：<span class="green12px" title="<?=$tradecircle?>"><?php echo common::strCut($tradecircle,18) ?></span></p>
                                <p class="black12px">均价：<span class="green12px"><?php echo $newBuild[$i]['sbi_avgsellprice']?$newBuild[$i]['sbi_avgsellprice'].'元/㎡':'暂无资料';?></span></p>
                            </div>
                        </div>
                                <?php
                                if(isset($newBuild[++$i]['sbi_buildingid'])) {
                                    ?>
                        <div class="xtlp_xz2">
                            <div class="xtlp_image ">
                                <a href="<?=Yii::app()->createUrl("systembuildinginfo/viewshop",array("id"=>$newBuild[$i]['sbi_buildingid'])) ?>" target="_blank"><?=CHtml::image(Picture::model()->getPicByTitleInt($newBuild[$i]['sbi_titlepic'],"_small"), $newBuild[$i]['sbi_buildingname'], array('class'=>'img_border','border'=>'0','width'=>"135px", 'height'=>"90px"));?></a>
                            </div>
                            <div class="house_wz2" style="width:130px">
                                <p class="lb12"><b><?=CHtml::link(common::strCut(CHtml::encode($newBuild[$i]['sbi_buildingname']),20),array('systembuildinginfo/viewshop',"id"=>$newBuild[$i]['sbi_buildingid']),array('target'=>'_blank','title'=>$newBuild[$i]['sbi_buildingname']))?></b></p>
                                            <?php $tradecircle = Region::model()->getNameById($newBuild[$i]['sbi_district']).Region::model()->getNameById($newBuild[$i]['sbi_section']);?>
                                <p class="black12px">商圈：<span class="green12px" title="<?=$tradecircle?>"><?php echo common::strCut($tradecircle,18) ?></span></p>
                                <p class="black12px">均价：<span class="green12px"><?php echo $newBuild[$i]['sbi_avgsellprice']?$newBuild[$i]['sbi_avgsellprice'].'元/㎡':'暂无资料';?></span></p>
                            </div>
                        </div>
                                    <?php } ?>
                    </li>
                            <?php } ?>
                </ul>
            </div>
                <?php } ?>

        </div>

        <div class="jiange2"></div>
        <div class="cs_left">
            <div class="orange_title">商业广场动态</div>
            <div class="gd" style="text-align: right; padding-top: 10px;">
                <?=CHtml::link("更多>>",array("systembuildinginfo/shopIndex"),array("target"=>"_blank"))?>
            </div>
            <div class="clear5"></div>
            <div style="height: 365px; overflow: hidden; clear: both;" pause="3000" id="marquee-sygcdt" class="lpdx_xx">
                <ul>
                    <?php
                    if($twitter!="") {
                        foreach($twitter as $value) {
                            ?>
                    <li style="line-height:30px">
                        <span>
                                    <?=CHtml::link(common::strCut(CHtml::encode($value->buildingInfo->sbi_buildingname),24)."：",array("/systembuildinginfo/viewshop","id"=>$value->buildingInfo->sbi_buildingid),array("target"=>"_blank",'title'=>$value->buildingInfo->sbi_buildingname))?><font title="<?=$value->t_message?>"><?=common::strCut(CHtml::encode($value->t_message),39); ?></font>
                        </span>
                    </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <b class="xbottom">
        <b class="xb3"></b>
        <b class="xb2"></b>
        <b class="xb1"></b>
    </b>
</div>



