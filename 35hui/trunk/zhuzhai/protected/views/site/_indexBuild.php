<?php
if(!empty($dataProvider)) {
    foreach($dataProvider as $key=>$value) {
        $type = $value->si_type;
        $valueId = $value->si_typeid;
        
        if($type==1){//写字楼或者商铺类型
            $data=Systembuildinginfo::model()->findByPk($valueId);
            $sourceClass = $data->sbi_buildtype==1?"lou":"pu";
            $href = Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>$data->sbi_buildingid));
            $num = Msgsubscribe::model()->getNum($valueId,$data->sbi_buildtype);
            ?>
<div class="ml_cont">
    <div class="<?php echo $sourceClass;?>">
        <h1 class="index_bg">
            <a href="<?=$href;?>"><?=Region::model()->getNameById($data->sbi_district);?> - <?=common::strCut($data->sbi_buildingname,56);?></a>
        </h1>
        <div class="pu_count">
            <div class="pu_pic">
                <?php
                $this->widget("PanoView",array(
                    "swfObjectId"=>"panoPlayerObject".$value->si_typeid,
                    "autoPlay"=>$key==0?true:false,
                    "backgroundImg"=>PIC_URL.$value->si_img,
                    "mainXml"=>Panoxml::model()->getPanoXml($value->si_typeid, 1),
                ));
                ?>
            </div>
            <div class="pu_left">
                <div class="buy<?php echo $value->si_pricetype==1?' zhujia':' shoujia' ?>">
                    <a href="<?=$href;?>">&nbsp;</a>
                <?php 
                $_price= $value->si_pricetype==1?$data->sbi_avgrentprice:$data->sbi_avgsellprice;
                echo $_price?'￥'.$_price:'暂无';?>
                </div>
                <div class="pul_count">
                    <p>开盘时间： <?=$data->sbi_openingtime?date('Y-m-d',$data->sbi_openingtime):'暂无资料';?></p>
                    <p>开 发 商：<?=$data->sbi_developer?common::strCut($data->sbi_developer,24):'暂无资料';?></p>
                    <p>物业费用：<em class="red"><?=$data->sbi_propertyprice?$data->sbi_propertyprice.'元/平米/月':'暂无资料';?></em></p>
                    <p>物业公司：<?=$data->sbi_propertyname?common::strCut($data->sbi_propertyname,24):'暂无资料';?></p>
                    <p>楼盘地址：<?=$data->sbi_address?common::strCut($data->sbi_address,50):'暂无资料';?>
                        <a href="<?=Yii::app()->createUrl("/map/map",array('id'=>'1-'.$valueId))?>" style="color:#335396;">查看地图</a></p>
                    <p>总建筑面积：<?=$data->sbi_buildingarea?$data->sbi_buildingarea.'平方米':'暂无资料';?></p>
                </div>
                <div class="pul_book">
                    <p>已经有<?=$value->si_num+$num?$value->si_num+$num:0;?>人订阅</p>
                    <p class="index_bg book"><a href="<?=$value->si_link?$value->si_link:$href;?>">本案详情</a></p>
                </div>
            </div>
            <div class="pu_right">
                <div class="title"><?=$data->sbi_buildingname;?></div>
                <div class="descrip"><?=common::strCut($value->si_desc,480);?></div>
                <div class="index_bg good_price"><?=common::strCut($value->si_advantages.$value->si_advantages,294);?></div>
                <div class="import"><?=common::strCut(Twitter::model()->getTwitterMessageByBuildingId($valueId,1),60);?></div>
                <div class="pu_phone index_bg">
                    <p>租售信息咨询电话：（工作时间：8：00-21：00）</p>
                    <p><em class="pu_big"><?=$data->sbi_tel?$data->sbi_tel:'暂无资料';?></em><em class="contdb">(联系我时请说是在新地标看到的，谢谢)</em><!-- 转 <em class="pu_big">21045</em>--></p>
                </div>
                <div class="pu_share">
                    <a href="javascript:addFavorite('<?=DOMAIN;?>','<?=$data->sbi_buildingname;?>');" class="index_bg bookread">收藏本页面</a>
                    <a href="javascript:openDivSubscribe(1,<?=$valueId;?>,'<?php echo Yii::app()->createUrl('/site/subscribeFrame');?>','<?=IMAGE_URL?>');" class="index_bg insert">订阅最新消息</a>
                </div>
            </div>
        </div>
    </div>
</div>
            <?php
        } else {//小区
            $data=Communitybaseinfo::model()->findByPk($valueId);
            $href = Yii::app()->createUrl("/communitybaseinfo/view",array("id"=>$valueId));
            $num = Msgsubscribe::model()->getNum($valueId,3);
            ?>
<div class="ml_cont">
    <div class="zhai">
        <h1 class="index_bg">
            <a href="<?=$href;?>"><?=Region::model()->getNameById($data->comy_district);?> - <?=common::strCut($data->comy_name,56);?></a>
        </h1>
        <div class="pu_count">
            <div class="pu_pic">
                <?php
                $this->widget("PanoView",array(
                    "swfObjectId"=>"panoPlayerObject".$value->si_typeid,
                    "autoPlay"=>$key==0?true:false,
                    "backgroundImg"=>PIC_URL.$value->si_img,
                    "mainXml"=>Panoxml::model()->getPanoXml($value->si_typeid, 2),
                ));
                ?>
            </div>
            <div class="pu_left">
                <div class="buy <?php echo $value->si_pricetype==1?' zhujia':' shoujia' ?>">
                    <a href="<?=$href;?>">&nbsp;</a><?=$data->comy_avgsellprice?'￥'.$data->comy_avgsellprice:'暂无';?>
                </div>
                <div class="pul_count">
                    <p>开盘时间：<?=$data->comy_inserttime?date('Y-m-d',$data->comy_inserttime):'暂无资料';?></p>
                    <p>开 发 商：<?=$data->comy_developer?common::strCut($data->comy_developer,24):'暂无资料';?></p>
                    <p>物业费用：<em class="red"><?=$data->comy_propertyprice?$data->comy_propertyprice.'元/平米/月':'暂无资料';?></em></p>
                    <p>物业公司：<?=$data->comy_propertyname?common::strCut($data->comy_propertyname,24):'暂无资料';?></p>
                    <p>小区地址：<?=$data->comy_address?common::strCut($data->comy_address,50):'暂无资料';?>
                        <a href="<?=Yii::app()->createUrl("/map/map",array('id'=>'3-'.$valueId))?>" style="color:#335396;">查看地图</a></p>
                    <p>总建筑面积：<?=$data->comy_buildingarea?$data->comy_buildingarea.'平方米':'暂无资料';?></p>
                </div>
                <div class="pul_book">
                    <p>已经有<?=$value->si_num+$num?$value->si_num+$num:0;?>人订阅</p>
                    <p class="index_bg book"><a href="<?=$value->si_link?$value->si_link:$href;?>">本案详情</a></p>
                </div>
            </div>
            <div class="pu_right">
                <div class="title"><?=$data->comy_name;?></div>
                <div class="descrip"><?=common::strCut($value->si_desc,480);?></div>
                <div class="index_bg good_price"><?=common::strCut($value->si_advantages.$value->si_advantages,294);?></div>
                <div class="import"><?=common::strCut(Twitter::model()->getTwitterMessageByBuildingId($valueId,2),60);?></div>
                <div class="pu_phone index_bg">
                    <p>租售信息咨询电话：（工作时间：8：00-21：00）</p>
                    <p><em class="pu_big"><?=$data->comy_saletel?$data->comy_saletel:'暂无资料';?></em> <!--转 <em class="pu_big">21045</em>--></p>
                </div>
                <div class="pu_share">
                    <a href="javascript:addFavorite('<?=DOMAIN;?>','<?=$data->comy_name;?>');" class="index_bg bookread">收藏本页面</a>
                    <a href="javascript:openDivSubscribe(3,<?=$valueId;?>,'<?php echo Yii::app()->createUrl('/site/subscribeFrame');?>','<?=IMAGE_URL?>');" class="index_bg insert">订阅最新消息</a>
                </div>
            </div>
        </div>
    </div>
</div>
            <?php }}}?>
