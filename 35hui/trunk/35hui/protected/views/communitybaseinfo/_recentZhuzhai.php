<div class="w720">
    <b class="xtop">
        <b class="xb1"></b>
        <b class="xb2"></b>
        <b class="xb3"></b>
    </b>
    <div style="min-height: 205px; height: auto;padding-bottom: 0px" class="border">
        <div class="lpjx" style=" width: 95%;"><?php echo CHtml::link("更多",array("communitybaseinfo/rentIndex"))?>出租</div>
        <div class="dt_image" style="margin-top:0px;height: auto">
            <?php
            if(!empty($rentZhuzhai)) {
                $frbi_id=$rentZhuzhai[0]['rbi_id'];
                $frbi_title=$rentZhuzhai[0]['rbi_title'];
                ?>
            <div class="das">
                <a target="_blank" href="<?=Yii::app()->createUrl('communitybaseinfo/viewResidence',array('id'=>$frbi_id)); ?>">
                    <img alt="<?=$rentZhuzhai[0]['community']['comy_name']?>" height="100px" width="150px" src="<?=Picture::model()->getPicByTitleInt($rentZhuzhai[0]['rbi_titlepicurl'],"_small");?>" class="img_border"/>
                </a>
            </div>

            <div class="das_wz">
                <ul>
                    <li style="line-height: 35px;"><?=CHtml::link(common::strCut(CHtml::encode($frbi_title), 30),array("communitybaseinfo/viewResidence","id"=>$frbi_id),array("target"=>"_blank","title"=>$frbi_title));?></li>
                    <li style="line-height: 25px;"><?=Region::model()->getNameById($rentZhuzhai[0]['community']['comy_district'])."&nbsp;&nbsp;".Region::model()->getNameById($rentZhuzhai[0]['community']['comy_section']);?></li>
                    <li><font color="red"><?php echo CHtml::encode($rentZhuzhai[0]['rbi_area']); ?></font>㎡</li>
                    <li><font color="red"><?php echo CHtml::encode($rentZhuzhai[0]->rentInfo['rr_rentprice']); ?></font>元/月</li>
                </ul>
            </div>
                <?php
            }
            ?>
            <ul class="cs_list" style="padding-top:15px;height: auto">
                <?php
                foreach($rentZhuzhai as $key=>$value) {
                    if($key!=0&&$key<6) {
                        $rbi_title=$value['rbi_title'];
                        ?>
                <li>
                    <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; overflow: hidden; float:left;">
                            <span><a title="<?=$rbi_title?>" target="_blank" href="<?=Yii::app()->createUrl("communitybaseinfo/viewResidence",array("id"=>$value['rbi_id']))?>"><?php echo CHtml::encode(common::strCut($rbi_title, 24)); ?></a>
                            </span>
                        </div>
                        <div style="width:55px;_width:70px; float: left;">
                            <span> <?php echo Region::model()->getNameById($value['community']['comy_district']);?> </span>
                        </div>
                        <div style="width: 73px; _width:60px; overflow: hidden; float: left;">
                            <span class="red"><?php echo $value['rbi_area']; ?></span>㎡
                        </div>
                        <div style="width: 95px; float: left; white-space: nowrap; overflow:hidden;">
                            <span class="red"><?php echo CHtml::encode($value->rentInfo['rr_rentprice']); ?></span>元/月
                        </div>
                    </div>
                </li>
                        <?php
                    }
                }?>
            </ul>

        </div>
        <div class="lp_smail" style="margin-top:0px;height:auto;width: auto;">
            <ul class="cs_list">
                <?php
                foreach($rentZhuzhai as $key=>$value) {
                    if($key>5) {
                        $rbi_title=$value['rbi_title'];
                        ?>
                <li>
                    <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; overflow: hidden; float:left;">
                            <span><a title="<?=$rbi_title?>" target="_blank" href="<?=Yii::app()->createUrl("communitybaseinfo/viewResidence",array("id"=>$value['rbi_id']))?>"><?php echo CHtml::encode(common::strCut($rbi_title, 24)); ?></a>
                            </span>
                        </div>
                        <div style="width:55px;_width:70px; float: left;">
                            <span> <?php echo Region::model()->getNameById($value['community']['comy_district']);?> </span>
                        </div>
                        <div style="width: 73px; _width:60px; overflow: hidden; float: left;">
                            <span class="red"><?php echo $value['rbi_area']; ?></span>㎡
                        </div>
                        <div style="width: 95px; float: left; white-space: nowrap; overflow:hidden;">
                            <span class="red"><?php echo CHtml::encode($value->rentInfo['rr_rentprice']); ?></span>元/月
                        </div>
                    </div>
                </li>
                        <?php
                    }
                }?>
            </ul>
        </div>
    </div>
    <b class="xbottom">
        <b class="xb3"></b>
        <b class="xb2"></b>
        <b class="xb1"></b>
    </b>
</div>

<div class="w720" style="margin-top:10px;">
    <b class="xtop">
        <b class="xb1"></b>
        <b class="xb2"></b>
        <b class="xb3"></b>
    </b>
    <div style="min-height: 205px; height: auto;padding-bottom: 0px" class="border">
        <div class="lpjx"style=" width: 95%;"><?php echo CHtml::link("更多",array("communitybaseinfo/sellIndex"))?>出售</div>
        <div class="dt_image" style="margin-top:0px;height: auto">
            <?php
            if(!empty($sellZhuzhai)) {
                $frbi_id=$sellZhuzhai[0]['rbi_id'];
                $frbi_title=$sellZhuzhai[0]['rbi_title'];
                ?>
            <div class="das">
                <a target="_blank" href="<?=Yii::app()->createUrl('communitybaseinfo/viewResidence',array('id'=>$frbi_id)); ?>">
                    <img alt="<?=$sellZhuzhai[0]['community']['comy_name']?>" height="100px" width="150px" src="<?=Picture::model()->getPicByTitleInt($sellZhuzhai[0]['rbi_titlepicurl'],"_small")?>" class="img_border"/>
                </a>
            </div>
            <div class="das_wz">
                <ul>
                        <?php
                        $cdistrict = $sellZhuzhai[0]->community['comy_district'];
                        $cdistrictName = $cdistrict==''?'':Region::model()->getNameById($cdistrict);
                        $csection = $sellZhuzhai[0]->community['comy_section'];
                        $csectionName = $cdistrict==''?'':Region::model()->getNameById($csection);
                        ?>
                    <li style="line-height: 35px;"><?=CHtml::link(common::strCut(CHtml::encode($frbi_title), 30),array('communitybaseinfo/viewResidence',"id"=>$frbi_id),array("target"=>"_blank","title"=>$frbi_title));?></li>
                    <li style="line-height: 25px;"><?=$cdistrictName."&nbsp;&nbsp;".$csectionName;?></li>
                    <li><font color="red"><?php echo CHtml::encode($sellZhuzhai[0]['rbi_area']); ?></font>㎡</li>
                    <li><font color="red"><?php echo CHtml::encode($sellZhuzhai[0]->sellInfo['rs_price']); ?></font>万元/套</li>
                </ul>
            </div>
                <?php
            }
            ?>
            <ul class="cs_list" style="padding-top:15px;height: auto">
                <?php
                foreach($sellZhuzhai as $key=>$value) {
                    if($key!=0&&$key<6) {
                        $rbi_title=$value['rbi_title'];
                        ?>
                <li>
                    <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; overflow: hidden; float:left;">
                            <span><a title="<?=$rbi_title?>" target="_blank" href="<?=Yii::app()->createUrl("communitybaseinfo/viewResidence",array("id"=>$value['rbi_id']))?>"><?php echo CHtml::encode(common::strCut($rbi_title, 24)); ?></a>
                            </span>
                        </div>
                        <div style="width:55px;_width:70px; float: left;">
                            <span> <?php echo Region::model()->getNameById($value['community']['comy_district']);?> </span>
                        </div>
                        <div style="width: 73px; _width:60px; overflow: hidden; float: left;">
                            <span class="red"><?php echo $value['rbi_area']; ?></span>㎡
                        </div>
                        <div style="width: 95px; float: left; white-space: nowrap; overflow:hidden;">
                            <span class="red"><?php echo CHtml::encode($value->sellInfo['rs_price']); ?></span>万元/套
                        </div>

                    </div>
                </li>
                <?php
                    }
                } ?>
            </ul>

        </div>
        <div class="lp_smail" style="margin-top:0px;height:auto;width: auto;">
            <ul class="cs_list">
                <?php
                foreach($sellZhuzhai as $key=>$value) {
                    if($key>5) {
                        $rbi_title=$value['rbi_title'];
                        ?>
                <li>
                    <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; overflow: hidden; float:left;">
                            <span><a title="<?=$rbi_title?>" target="_blank" href="<?=Yii::app()->createUrl("communitybaseinfo/viewResidence",array("id"=>$value['rbi_id']))?>"><?php echo CHtml::encode(common::strCut($rbi_title, 24)); ?></a>
                            </span>
                        </div>
                        <div style="width:55px;_width:70px; float: left;">
                            <span> <?php echo Region::model()->getNameById($value['community']['comy_district']);?> </span>
                        </div>
                        <div style="width: 73px; _width:60px; overflow: hidden; float: left;">
                            <span class="red"><?php echo $value['rbi_area']; ?></span>㎡
                        </div>
                        <div style="width: 95px; float: left; white-space: nowrap; overflow:hidden;">
                            <span class="red"><?php echo CHtml::encode($value->sellInfo['rs_price']); ?></span>万元/套
                        </div>

                    </div>
                </li>
                <?php
                    }
                } ?>
            </ul>
        </div>
    </div>
    <b class="xbottom">
        <b class="xb3"></b>
        <b class="xb2"></b>
        <b class="xb1"></b>
    </b>
</div>