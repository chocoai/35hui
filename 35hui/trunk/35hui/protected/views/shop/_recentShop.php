<div class="w720">
    <b class="xtop">
        <b class="xb1"></b>
        <b class="xb2"></b>
        <b class="xb3"></b>
    </b>
    <div class="border" style="height:225px; min-height:205px; height: auto;">
        <div class="lpjx" style="margin-bottom:0px; width: 95%;"><?php echo CHtml::link("更多",array("shop/rentIndex")) ?>出租</div>
        <div class="dt_image" style="margin-top:7px;">
            <?php
            if(!empty($rentShop)) {
                $fsb_shopid=$rentShop[0]['sb_shopid'];
                $fsp_shoptitle=$rentShop[0]['presentInfo']['sp_shoptitle'];
                ?>
            <div class="das">
                <a href="<?php echo Yii::app()->createUrl("shop/view",array("id"=>$fsb_shopid)) ?>" target="_blank">
                    <img class="img_border" src="<?=Picture::model()->getPicByTitleInt($rentShop[0]->presentInfo['sp_titlepicurl'],"_small");?>" width="150px" height="100px" />
                </a>
            </div>

            <div class="das_wz">
                <ul>
                    <li style=" line-height: 35px;"><?=CHtml::link(common::strCut(CHtml::encode($fsp_shoptitle), 30),array('shop/view',"id"=>$fsb_shopid),array("target"=>"_blank","title"=>$fsp_shoptitle));?></li>
                    <li style=" line-height: 25px"><?=Region::model()->getNameById($rentShop[0]['sb_district'])."&nbsp;&nbsp;".Region::model()->getNameById($rentShop[0]['sb_section']);?></li>
                    <li><font color="red"><?php echo CHtml::encode($rentShop[0]['sb_shoparea']); ?></font>㎡</li>
                    <li><font color="red"><?php echo CHtml::encode($rentShop[0]->rentInfo['sr_rentprice']); ?></font>元/㎡·天</li>
                </ul>
            </div>
                <?php
            }
            ?>
            <ul class="cs_list" style="padding-top:6px">
                <?php
                foreach($rentShop as $key=>$value) {
                    if($key!=0&&$key<6) {
                        $sp_shoptitle=$value['presentInfo']['sp_shoptitle'];
                        ?>
                <li>
                    <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; overflow: hidden; float:left;">
                            <span class="black12px"><a href="<?php echo Yii::app()->createUrl("shop/view",array("id"=>$value['sb_shopid'])) ?>" target="_blank" title="<?=$sp_shoptitle?>"><?php echo CHtml::encode(common::strCut($sp_shoptitle, 24)); ?></a>
                            </span>
                        </div>
                        <div style="width:55px;_width:70px; float: left;">
                            <span> <?php echo Region::model()->getNameById($value['sb_district'])?> </span>
                        </div>
                        <div style="width: 73px; _width:60px; overflow: hidden; float: left;">
                            <span class="red"><?php echo $value['sb_shoparea']; ?></span>㎡
                        </div>
                        <div style="width: 95px; float: left; white-space: nowrap; overflow:hidden;">
                            <span class="red"><?php echo $value->rentInfo['sr_rentprice']; ?></span>元/㎡·天
                        </div>

                    </div>
                </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>

        <div class="lp_smail" style="margin-top:7px;">
            <ul class="cs_list">
                <?php
                foreach($rentShop as $key=>$value) {
                    if($key>5) {
                        $sp_shoptitle=$value['presentInfo']['sp_shoptitle'];
                        ?>
                <li>
                    <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; overflow: hidden; float:left;">
                            <span class="black12px"><a href="<?php echo Yii::app()->createUrl("shop/view",array("id"=>$value['sb_shopid'])) ?>" target="_blank" title="<?=$sp_shoptitle?>"><?php echo CHtml::encode(common::strCut($sp_shoptitle, 24)); ?></a>
                            </span>
                        </div>
                        <div style="width:55px;_width:70px; float: left;">
                            <span> <?php echo Region::model()->getNameById($value['sb_district'])?> </span>
                        </div>
                        <div style="width: 73px; _width:60px; overflow: hidden; float: left;">
                            <span class="red"><?php echo $value['sb_shoparea']; ?></span>㎡
                        </div>
                        <div style="width: 95px; float: left; white-space: nowrap; overflow:hidden;">
                            <span class="red"><?php echo $value->rentInfo['sr_rentprice']; ?></span>元/㎡·天
                        </div>

                    </div>
                </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <b class="xbottom">
        <b class="xb3"></b>
        <b class="xb2"></b>
        <b class="xb1"></b>
    </b>
</div>

<div class="w720">
    <b class="xtop">
        <b class="xb1"></b>
        <b class="xb2"></b>
        <b class="xb3"></b>
    </b>
    <div class="border" style="height:225px; min-height:205px; height: auto;">
        <div class="lpjx" style="margin-bottom:0px; width: 95%;"><?php echo CHtml::link("更多",array("shop/sellIndex")) ?>出售</div>
        <div class="dt_image" style="margin-top:7px;">
            <?php
            if(!empty($sellShop)) {
                $fsb_shopid=$sellShop[0]['sb_shopid'];
                $fsp_shoptitle=$sellShop[0]->presentInfo['sp_shoptitle'];
                ?>
            <div class="das">
                <a href="<?php echo Yii::app()->createUrl("shop/view",array("id"=>$fsb_shopid)) ?>" target="_blank">
                    <img class="img_border" src="<?=Picture::model()->getPicByTitleInt($fsp_shoptitle,"_small");?>" border="0" width="150px" height="100px" />
                </a>
            </div>
            <div class="das_wz">
                <ul>
                    <li style=" line-height: 35px;"><?=CHtml::link(common::strCut(CHtml::encode($fsp_shoptitle),30),array('shop/view',"id"=>$fsb_shopid),array("target"=>"_blank","title"=>$fsp_shoptitle));?></li>
                    <li style=" line-height: 25px;"><?=Region::model()->getNameById($sellShop[0]['sb_district'])."&nbsp;&nbsp;".Region::model()->getNameById($sellShop[0]['sb_section']);?></li>
                    <li><font color="red"><?php echo CHtml::encode($sellShop[0]['sb_shoparea']); ?></font>㎡</li>
                    <li><font color="red"><?php echo CHtml::encode($sellShop[0]->sellInfo['ss_sumprice']); ?></font>万元/套</li>
                </ul>
            </div>
                <?php
            }
            ?>
            <ul class="cs_list" style="padding-top:6px">
                <?php
                foreach($sellShop as $key=>$value) {
                    if($key!=0&&$key<6) {
                        $sp_shoptitle=$value['presentInfo']['sp_shoptitle'];
                        ?>
                <li>
                    <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; float:left; overflow: hidden;">
                            <span class="black12px"><a href="<?php echo Yii::app()->createUrl("shop/view",array("id"=>$value['sb_shopid'])) ?>" target="_blank" title="<?=$sp_shoptitle?>"><?php echo common::strCut($sp_shoptitle, 24); ?>                                                </a>
                            </span>
                        </div>
                        <div style="width:52px; _width:70px; float: left;">
                            <span><?php echo Region::model()->getNameById($value['sb_district'])?> </span>
                        </div>
                        <div style="width: 73px; _width:60px; overflow: hidden; float: left;">
                            <span class="red">  <?php echo $value['sb_shoparea']; ?></span>㎡
                        </div>
                        <div style="width: 95px; float: left; white-space: nowrap; overflow:hidden;">
                            <span class="red"><?php echo $value->sellInfo['ss_sumprice']; ?></span>万元/套
                        </div>

                    </div>
                </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>

        <div class="lp_smail" style="margin-top:7px;">
            <ul class="cs_list">
                <?php
                foreach($sellShop as $key=>$value) {
                    if($key>5) {
                        $sp_shoptitle=$value['presentInfo']['sp_shoptitle'];
                        ?>
                <li>
                    <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; float:left; overflow: hidden;">
                            <span class="black12px"><a href="<?php echo Yii::app()->createUrl("shop/view",array("id"=>$value['sb_shopid'])) ?>" target="_blank" title="<?=$sp_shoptitle?>"><?php echo common::strCut($sp_shoptitle, 24); ?>                                                </a>
                            </span>
                        </div>
                        <div style="width:52px; _width:70px; float: left;">
                            <span><?php echo Region::model()->getNameById($value['sb_district'])?> </span>
                        </div>
                        <div style="width: 73px; _width:60px; overflow: hidden; float: left;">
                            <span class="red">  <?php echo $value['sb_shoparea']; ?></span>㎡
                        </div>
                        <div style="width: 95px; float: left; white-space: nowrap; overflow:hidden;">
                            <span class="red"><?php echo $value->sellInfo['ss_sumprice']; ?></span>万元/套
                        </div>

                    </div>
                </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <b class="xbottom">
        <b class="xb3"></b>
        <b class="xb2"></b>
        <b class="xb1"></b>
    </b>
</div>