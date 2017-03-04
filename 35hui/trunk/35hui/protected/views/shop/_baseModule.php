<ul class="xiezilou_leftultwo">
    <li class="four"><span style="font-size: 20px; color: black;"><?=@CHtml::encode($shopModel->presentInfo->sp_shoptitle)?></span></li>
    <?
    if($shopModel->sb_sellorrent==1) {//出租
        ?>
    <li class="one">租金：<span style=" font-size: 18px; font-weight: bold; color: #ff2200;"><?=$shopModel->rentInfo->sr_rentprice?>元/㎡·天</span></li>
    <li class="one">面积：<span><?php
                echo "<font class='red' style=' font-weight: bold; '>".$shopModel->sb_shoparea."㎡</font>";
                if($shopModel->sb_sellorrent==1) {
                    echo "(".Lookup::item("renttype",$shopModel->rentInfo->sr_renttype).")";
                }
                ?></span>
    </li>
    <li class="one">月租：<span><?=$shopModel->rentInfo->sr_monthrentprice!=0?"<font class='red' style=' font-weight: bold; '>".$shopModel->rentInfo->sr_monthrentprice."元/月</font>":"暂无资料"?></span></li>
    <li class="one">区域：<span><?=Region::model()->getNameById($shopModel->sb_district)?>-<?=Region::model()->getNameById($shopModel->sb_section)?></span>
    </li>
        <?php
    }else {
        ?>
    <li class="one">总价：<span><font class="red"><?=$shopModel->sellInfo->ss_sumprice?></font>万元/套</span></li>
    <li class="one">面积：<span><?php
                echo "<font class='red'>".$shopModel->sb_shoparea."</font>㎡";
                if($shopModel->sb_sellorrent==1) {
                    echo "(".Lookup::item("renttype",$shopModel->rentInfo->sr_renttype).")";
                }
                ?></span>
    </li>
	<li class="one">单价：<span><font class="red"><?=$shopModel->sellInfo->ss_avgprice?></font>元/㎡</span></li>
    <li class="one">区域：<span><?=Region::model()->getNameById($shopModel->sb_district)?>-<?=Region::model()->getNameById($shopModel->sb_section)?></span>
        <?php
    }
    ?>
    <li class="one">楼盘：<span><?=$buildingInfo?CHtml::link(CHtml::encode($buildingInfo['sbi_buildingname']),array("/systembuildinginfo/viewshop","id"=>$buildingInfo['sbi_buildingid']),array("class"=>"blue")):"暂无资料"?></span></li>
    <li class="one">
        <ul>
            <li class="sishi">地址：</li>
            <li class="tw"><?=$shopModel->sb_shopaddress?></li>
        </ul>
    </li>
    <li class="three"><?=$tel?></li>
    <li class="one"><font class="gray">楼层：</font><span><?=$shopModel->sb_floor."层/共".$shopModel->sb_allfloor."层"?></span></li>
    <li class="one"><font class="gray">装修程度：</font><span><?=Officebaseinfo::model()->getFitment($shopModel->sb_adrondegree);?></span></li>
    <li class="one" style="clear: both; float: left;"><font class="gray">朝向：</font><span><?php
            $chaoxiang = Officebaseinfo::model()->getTowardName($shopModel->sb_towards);
            if($chaoxiang) {
                echo $chaoxiang;
            }else {
                echo "未写";
            }?></span>
    </li>
    <li class="one" style="float: left;"><font class="gray">物业管理费：</font><span><?=$shopModel->sb_propertycost?$shopModel->sb_propertycost."元/㎡·月":"暂无资料";?></span></li>
    <li class="two"><font class="gray">内部配套：</font>
        <span>
            <?php
            $facility = Shopfacilityinfo::model()->getAllFacilityShow($shopModel->sb_shopid);
            if($facility) {
                echo implode(" ",$facility);
            }else {
                echo "尚无";
            }
            ?>
        </span>
    </li>
    <li class="one"><font class="gray">建筑年代：</font><span><?=$shopModel->sb_buildingage?date("Y-m-d", $shopModel->sb_buildingage):"暂无资料";?></span></li>
    <li class="one"><font class="gray">发布时间：</font><span><?=date("Y-m-d",$shopModel->sb_releasedate)?>(<?=common::dealShowTime($shopModel->sb_updatedate)?>更新)</span></li>
    <li class="one" style="width:400px;">
        <ul><li class="ne"><font class="gray">推荐业态：</font></li>
            <li class="w340"><?=Shopbaseinfo::$sb_recommendtrade[$shopModel->sb_recommendtrade];?></li>
        </ul>
    </li>
    <?php
        $url = Yii::app()->createUrl("shop/view",array('id'=>$shopModel->sb_shopid));
        $title = $shopModel->presentInfo->sp_shoptitle;
    ?>
    <li class="one" style="width:400px;">
       <!-- JiaThis Button BEGIN -->
        <div id="ckepop">
            <a href="http://www.jiathis.com/share/" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank">分享到：</a>
            <a class="jiathis_button_qzone">QQ空间</a>
            <a class="jiathis_button_tsina">新浪微博</a>
            <a class="jiathis_button_kaixin001">开心网</a>
            <a class="jiathis_button_renren">人人网</a>
        </div>
        <script type="text/javascript" src="http://v1.jiathis.com/code/jia.js" charset="utf-8"></script>
        <!-- JiaThis Button END -->
    </li>
</ul>