<ul class="xiezilou_leftultwo">
    <li class="four">
        <div id="title" style="font-size: 20px; color: black; width: 85%;"><?=@CHtml::encode($model->presentInfo->op_officetitle)?></div>
    </li>
    <?php
    if($model->ob_sellorrent==1) {//出租
        ?>
    <li class="one">租金：<span style=" color: #ff2200; font-size: 18px; font-weight: bold;"><?=$model->rentInfo['or_rentprice']?>元/平米·天</span></li>
    <li class="one">面积：<span><?php
                echo "<font class='red'   style='font-weight: bold;'>".$model->ob_officearea."㎡</font>";
                if($model->ob_sellorrent==1) {
                    echo "(".Lookup::item("renttype",$model->rentInfo->or_renttype).")";
                }
                ?></span>
    </li>
    <li class="one">月租：<span><?=$model->rentInfo->or_monthrentprice!=0?"<font class='red' style='font-weight: bold;'>".$model->rentInfo->or_monthrentprice."元/月</font>":"暂无资料"?></span></li>
    <li class="one">区域：<span><?=Region::model()->getNameById($model->ob_district)?>-<?=Region::model()->getNameById($model->ob_section)?></span>
        <?php
    }else {//出售
        ?>
    <li class="one">总价：<span><font class="red"><?=$model->sellInfo->os_sumprice?></font>万元/套</span></li>
    <li class="one">面积：<span><?php
                echo "<font class='red'>".$model->ob_officearea."</font>㎡";
                ?></span>
    </li>
    <li class="one">单价：<span><font class="red"><?=$model->sellInfo['os_avgprice']?></font>元/平米</span></li>
    <li class="one">区域：<span><?=Region::model()->getNameById($model->ob_district)?>-<?=Region::model()->getNameById($model->ob_section)?></span>
        <?php
    }
    ?>
    
    <li class="one">楼盘：<span><?=$buildingInfo?CHtml::link($buildingInfo['sbi_buildingname'],array("systembuildinginfo/view","id"=>$buildingInfo['sbi_buildingid']),array("class"=>"blue")):"暂无资料"?></span></li>
    <li class="one">
        <ul>
            <li class="sishi">地址：</li>
            <li class="tw"><?=$model->ob_officeaddress?></li>
        </ul>
    </li>
    <li class="three"><?=$tel?></li>
    <li class="one"><font class="gray">楼层：</font><span><?=Officebaseinfo::$ob_floortype[$model->ob_floortype]?></span></li>
    <li class="one"><font class="gray">装修程度：</font><span><?=Officebaseinfo::model()->getFitment($model->ob_adrondegree);?></span></li>
    <li class="one" style="clear: both; float: left;"><span class="gray">朝向：</span><span><?php $chaoxiang = Officebaseinfo::model()->getTowardName($model->ob_towards);
            if($chaoxiang) {
                echo $chaoxiang;
            }else {
                echo "未写";
            }?></span></li>
    <li class="one" style="float: left;"><span class="gray">物业管理费：</span><span><?=$model->ob_propertycost?$model->ob_propertycost.'元/平米·月':'暂无资料';?></span></li>
    <li class="two"><font class="gray">内部配套：</font>
        <span>
            <?php
            $facility = Officefacilityinfo::model()->getAllFacilityShow($model->ob_officeid);
            if($facility) {
                echo implode(" ",$facility);
            }else {
                echo "尚无";
            }
            ?>
        </span>
    </li>
    <li class="one"><font class="gray">建筑年代：</font><span>
            <?php
            $time=date("Y-m-d", $model->ob_buildingera);
            echo $time=='1970-01-01'?'暂无资料':$time;
            ?></span></li>
    <li class="one"><font class="gray">发布时间：</font><span><?=date("Y-m-d",$model->ob_releasedate)?>(<?=common::dealShowTime($model->ob_updatedate)?>更新)</span></li>
    <?php
        $url = Yii::app()->createUrl("office/view",array('id'=>$model->ob_officeid));
        $title = $model->presentInfo->op_officetitle;
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