<div class="w475">
    <ul class="xiezilou_leftultwo">
        <li class="four">
            <span style="font-size: 20px; color: black;"><?php echo $residenceModel->rbi_title;?></span>
            <br />
            <em>发布时间：<?php echo date("Y-m-d H:i:s",$residenceModel->rbi_releasedate);?>(<?=common::dealShowTime($residenceModel->rbi_updatedate)?>更新)</em>
        </li>
        <li class="w49" style="padding:5px 0;" >
            <?
            if($residenceModel->rbi_rentorsell==1) {//出租
                ?>
            <span style=" font-weight: bold;">租金</span>：<span class="price2"><?php echo $residenceModel->rentInfo->rr_rentprice;?></span>元/月<span class="f12px">(付：<?=$residenceModel->rentInfo->rr_rentpay==''? '面议':$residenceModel->rentInfo->rr_rentpay?>&nbsp;&nbsp;押：<?=$residenceModel->rentInfo->rr_rentdetain==''? '面议':$residenceModel->rentInfo->rr_rentdetain?></span>)
                <? } else { //出售?>
            <span style=" font-weight: bold;">售价</span>：<span class="price2"><?php echo @$residenceModel->sellInfo->rs_price;?></span>万元/套
                <? }?>
            
        </li>
        <li class="w49" style="padding:5px 0;"><?=Residencetag::model()->showFourFeatures($residenceModel->rbi_id,true)?></li>
        <li class="w49"><span style=" font-weight: bold;">产证面积</span>：<span style=" color: #ff3300; font-weight: bold;"><?php echo $residenceModel->rbi_area;?></span>平米</li>
        <li class="w49"><span style=" font-weight: bold;">房型</span>：<span style=" font-weight: bold;"><?=$residenceModel->rbi_room?></span>室<span style=" font-weight: bold;"><?= $residenceModel->rbi_office?></span>厅<span style=" font-weight: bold;"><?=$residenceModel->rbi_bathroom?></span>卫</li>
        <? if($residenceModel->rbi_rentorsell==2) {//出售?>
        <li class="w49">单价：<span style=" font-weight: bold; color: red;"><?=@$residenceModel->sellInfo->rs_unitprice?></span>元/平米</li>
            <? } ?>
        <li class="w49">楼层：<?=$residenceModel->rbi_floor?>/ <?=$residenceModel->rbi_allfloor?></li>
        <li class="w49">朝向：<?=Residencebaseinfo::model()->getTowardName($residenceModel->rbi_toward)?></li>
        <? if($residenceModel->rbi_rentorsell==1) {//出租?>
        <? } ?>
        <li class="w49">装修：<?=Residencebaseinfo::model()->getFitment($residenceModel->rbi_decoration)?></li>
        <li class="w49">小区：<span class="orange"><a href="<?=Yii::app()->createUrl("communitybaseinfo/view",array("id"=>$communityInfo->comy_id))?>"><?=$communityInfo->comy_name?></a></span></li>
        <? if($residenceModel->rbi_rentorsell==1) {//出租?>
        <li class="w49">共出租
            <span class="orange">
                <a href="<?=Yii::app()->createUrl("communitybaseinfo/rentIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($communityInfo->comy_name)))?>"><?php echo Communitybaseinfo::model()->getNums($communityInfo->comy_id,1);?></a>
            </span>套</li>
            <? } else {?>
        <li class="w49">共出售
            <span class="orange">
                <a href="<?=Yii::app()->createUrl("communitybaseinfo/sellIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($communityInfo->comy_name)))?>"><?php echo Communitybaseinfo::model()->getNums($communityInfo->comy_id,2);?></a>
            </span>套</li>
            <? } ?>
        <li class="w49">地址：<?=$communityInfo->comy_address?></li>
        <li class="w49"><span class="orange"><?=Region::model()->getNameById($communityInfo->comy_district)?>/<?=Region::model()->getNameById($communityInfo->comy_section)?></span></li>
        <li class="w49">建筑年代：<?=$residenceModel->rbi_buildingera==''||$residenceModel->rbi_buildingera==0?'暂无资料':$residenceModel->rbi_buildingera.'年'?></li>
    </ul>
<div  class="telephone">
    <div class="number">
        <span style=" color: #333;">咨询电话：</span>
        <b style=" color: #ff6600;"><?=$tel?></b>
    </div>
    <div class="tips">
        联系我时请说是在新地标看到的，谢谢！
    </div>
</div>
<ul class="prop_extend">
    <li id="print"><a href="#" onclick="window.print()">打印</a></li>
    <li id="report"><span class="police"></span><a href="#">举报虚假信息</a></li>
    <!--
    <li id="share"><a id="share_apf_id_13" href="#" onclick="copyText()">分享</a></li>
    -->
    <li id="chek">
        <a id="fav_apf_id_13" href="javascript:store();">找房单</a>
    </li>
    <li id="favor">
        <a id="fav_apf_id_13" href="#" onclick="addFavorite('<?php echo DOMAIN.Yii::app()->createUrl("communitybaseinfo/viewResidence",array("id"=>$residenceModel->rbi_id));?>','<?=$residenceModel->rbi_title;?>')">收藏夹</a>
    </li>
</ul>
<?php
$url = Yii::app()->createUrl("communitybaseinfo/viewResidence",array('id'=>$residenceModel->rbi_id));
$title = $residenceModel->rbi_title;
?>
<ul class="prop_extendfx">
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
</ul>
</div>