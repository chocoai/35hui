<div class="dt_bian">
    <div class="jb">
        <div class="dt_title"></div>
        <div class="lpjx" style="width:94%;_width:85%;"><?php echo CHtml::link("更多",array("officebaseinfo/saleIndex"))?>出租</div>
        <div class="dt_image" style="margin-top: 0px">
            <?php
                if(!empty($rentOffice)) {
                $fob_officeid=$rentOffice[0]['ob_officeid'];
                $fop_officetitle=$rentOffice[0]['presentInfo']['op_officetitle'];
                ?>
            <div class="das">
                <a href="<?php echo Yii::app()->createUrl("officebaseinfo/rentView",array("id"=>$fob_officeid)) ?>" target="_blank">
                    <img class="img_border" alt="<?=CHtml::encode($fop_officetitle)?>" src="<?=Picture::model()->getPicByTitleInt($rentOffice[0]->presentInfo['op_titlepicurl'],"_small");?>" width="150px" height="100px" />
                </a>
            </div>
            <div class="das_wz">
                <ul>
                    <li style=" line-height: 35px;"><?=CHtml::link(common::strCut(CHtml::encode($fop_officetitle), 30),array('officebaseinfo/rentView',"id"=>$fob_officeid),array("target"=>"_blank","title"=>$fop_officetitle));?></li>
                    <li style=" line-height: 25px"><?=CHtml::encode($rentOffice[0]['ob_officename'])?></li>
                    <li><font color="red"><?php echo CHtml::encode($rentOffice[0]['ob_officearea']); ?></font>㎡</li>
                    <li><font color="red"><?php echo CHtml::encode($rentOffice[0]->rentInfo['or_rentprice']); ?></font>元/平米·天</li>
                </ul>
            </div>
            <?php
                }
            ?>
            
            <ul class="cs_list" style="padding-top:6px">
                <?php
                foreach($rentOffice as $key=>$value) {
                    if($key!=0&&$key<6) {
                        $op_officetitle=$value['presentInfo']['op_officetitle'];
                        ?>
                    <li>
                        <div style="width:335px; white-space:nowrap;word-break:keep-all; overflow: hidden; float:left"><div style="width:110px; float:left;overflow: hidden">
                                <span class="black12px"><a href="<?php echo Yii::app()->createUrl("officebaseinfo/rentView",array("id"=>$value['ob_officeid'])) ?>" target="_blank" title="<?=$op_officetitle?>"><?php echo CHtml::encode(common::strCut($op_officetitle, 24)); ?></a>
                                </span>
                            </div>
                            <div style="width:52px; _width;70px; float: left; text-align: center;">
                                <span> <?php echo Region::model()->getNameById($value['ob_district'])?> </span>
                            </div>
                            <div style="width: 73px; _width:60px; float: left; text-align: center; overflow: hidden;">
                                <span class="red"><?php echo $value['ob_officearea']; ?></span>㎡
                            </div>
                            <div style="width: 100px; float: left; white-space: nowrap; overflow:hidden;">
                                <span class="red"><?php echo $value->rentInfo['or_rentprice']; ?></span>元/平米·天
                            </div>

                        </div>
                    </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="lp_smail" style="margin-top: 0px">
            <ul class="cs_list">
                <?php
                foreach($rentOffice as $key=>$value) {
                    if($key>5) {
                        $op_officetitle=$value['presentInfo']['op_officetitle'];
                        ?>
                    <li>
                        <div style="width:335px; white-space:nowrap;word-break:keep-all; overflow: hidden; float:left"><div style="width:110px; float:left;overflow: hidden">
                                <span class="black12px"><a href="<?php echo Yii::app()->createUrl("officebaseinfo/rentView",array("id"=>$value['ob_officeid'])) ?>" target="_blank" title="<?=$op_officetitle?>"><?php echo CHtml::encode(common::strCut($op_officetitle, 24)); ?></a>
                                </span>
                            </div>
                            <div style="width:52px; _width;70px; float: left; text-align: center;">
                                <span> <?php echo Region::model()->getNameById($value['ob_district'])?> </span>
                            </div>
                            <div style="width: 73px; _width:60px; float: left; text-align: center; overflow: hidden;">
                                <span class="red"><?php echo $value['ob_officearea']; ?></span>㎡
                            </div>
                            <div style="width: 100px; float: left; white-space: nowrap; overflow:hidden;">
                                <span class="red"><?php echo $value->rentInfo['or_rentprice']; ?></span>元/平米·天
                            </div>

                        </div>
                    </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="c"></div>
        <div class="dt_bottom" style="margin-top: 0px"></div>
    </div>
</div>

<div class="dt_bian">
    <div class="jb">
        <div class="dt_title"></div>
        <div class="lpjx" style="width:94%;_width:85%;"><?php echo CHtml::link("更多",array("officebaseinfo/rentIndex")) ?>出售</div>
        <div class="dt_image" style="margin-top: 0px">
            <?php
                if(!empty($sellOffice)) {
                    $fob_officeid=$sellOffice[0]['ob_officeid'];
                    $fop_officetitle=$sellOffice[0]['presentInfo']['op_officetitle'];
                    ?>
            <div class="das">
                <a href="<?php echo Yii::app()->createUrl("officebaseinfo/saleView",array("id"=>$fob_officeid)) ?>" target="_blank">
                    <img class="img_border" alt="<?=CHtml::encode($fop_officetitle)?>" src="<?=Picture::model()->getPicByTitleInt($sellOffice[0]->presentInfo['op_titlepicurl'],"_small");?>" border="0" width="150px" height="100px" />
                </a>
            </div>
            <div class="das_wz">
                <ul>
                    <li style=" line-height: 35px;"><?=CHtml::link(common::strCut(CHtml::encode($fop_officetitle),30),array('officebaseinfo/saleView',"id"=>$fob_officeid),array("target"=>"_blank",'title'=>$fop_officetitle));?></li>
                    <li style=" line-height: 25px;"><?=CHtml::encode($sellOffice[0]['ob_officename']);?></li>
                    <li><font color="red"><?php echo CHtml::encode($sellOffice[0]['ob_officearea']); ?></font>㎡</li>
                    <li><font color="red"><?php echo CHtml::encode($sellOffice[0]->sellInfo['os_sumprice']); ?></font>万元/套</li>
                </ul>
            </div>
            <?php
                }
            ?>

            <ul class="cs_list" style="padding-top:6px">
                 <?php
                foreach($sellOffice as $key=>$value) {
                    if($key!=0&&$key<6) {
                        $op_officetitle=$value['presentInfo']['op_officetitle'];
                        ?>
                    <li>
                        <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; float:left; overflow: hidden;">
                                <span class="black12px"><a href="<?php echo Yii::app()->createUrl("officebaseinfo/saleView",array("id"=>$value['ob_officeid'])) ?>" target="_blank" title="<?=$op_officetitle?>"><?php echo CHtml::encode(common::strCut($op_officetitle, 24)); ?></a>
                                </span>
                            </div>
                            <div style="width:52px; _width:70px; float: left; text-align: center;">
                                <span><?php echo Region::model()->getNameById($value['ob_district'])?> </span>
                            </div>
                            <div style="width: 73px; _width:60px; overflow: hidden; float: left; text-align: center;">
                                <span class="red">  <?php echo $value['ob_officearea']; ?></span>㎡
                            </div>
                            <div style="width: 90px; float: left; white-space: nowrap; overflow:hidden;">
                                <span class="red"><?php echo $value->sellInfo['os_sumprice']; ?></span>万元/套
                            </div>

                        </div>
                    </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="lp_smail" style="margin-top: 0px">
            <ul class="cs_list">
                <?php
                foreach($sellOffice as $key=>$value) {
                    if($key>5) {
                        $op_officetitle=$value['presentInfo']['op_officetitle'];
                        ?>
                    <li>
                        <div style="width:335px; white-space:nowrap; float:left"><div style="width:110px; float:left; overflow: hidden;">
                                <span class="black12px"><a href="<?php echo Yii::app()->createUrl("officebaseinfo/saleView",array("id"=>$value['ob_officeid'])) ?>" target="_blank" title="<?=$op_officetitle?>"><?php echo CHtml::encode(common::strCut($op_officetitle, 24)); ?></a>
                                </span>
                            </div>
                            <div style="width:52px; _width:70px; float: left; text-align: center;">
                                <span><?php echo Region::model()->getNameById($value['ob_district'])?> </span>
                            </div>
                            <div style="width: 73px; _width:60px; overflow: hidden; float: left; text-align: center;">
                                <span class="red">  <?php echo $value['ob_officearea']; ?></span>㎡
                            </div>
                            <div style="width: 90px; float: left; white-space: nowrap; overflow:hidden;">
                                <span class="red"><?php echo $value->sellInfo['os_sumprice']; ?></span>万元/套
                            </div>

                        </div>
                    </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="c"></div>
        <div class="dt_bottom" style="margin-top: 0px"></div>
    </div>
</div>
