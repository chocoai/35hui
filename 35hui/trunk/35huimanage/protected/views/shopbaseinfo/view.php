<?php
$this->breadcrumbs=array(
	'商铺管理'=>array('index'),
	$shopBaseInfoModel->sb_shopid,
);
$this->currentMenu = 24;
$this->menu=array(
    array('label'=>'商铺列表', 'url'=>array('index')),
    array('label'=>'管理商铺', 'url'=>array('admin')),
    array('label'=>'管理全景', 'url'=>array('subpanorama/sourcepanorama',"id"=>$shopBaseInfoModel->sb_shopid,'type'=>2)),
);

?>
<div class="view">
    

    <b>用户:</b>
    <?= isset($shopBaseInfoModel->user) ? CHtml::encode($shopBaseInfoModel->user->user_name) : ""; ?>[<?=$shopBaseInfoModel->sb_uid?>]
    <br />
    <b>状态:</b>
    <? $url = Yii::app()->createUrl('shopbaseinfo/changetag', array('id' => $shopBaseInfoModel->sb_shopid, "sourceType" => 2, "buildname" => isset($shopPresentInfoModel->sp_shoptitle) ? @$shopPresentInfoModel->sp_shoptitle : "")); ?>
    <?= Officebaseinfo::$checktype[$shopBaseInfoModel->sb_check] ?>
    <?= $shopBaseInfoModel->sb_check == 4 ? CHtml::link("下线", array(), array('onclick' => 'return subFrom("' . $url . '",8)')) : "" ?>&nbsp;
    <?= CHtml::link("删除", array(), array('onclick' => 'return subFrom("' . $url . '",1)')) ?>

    <br />
    <b>面积：</b><?= $shopBaseInfoModel->sb_shoparea  ?>平方
    <br />

    
    <b>类型:</b><?
    if($shopBaseInfoModel->sb_sellorrent==2){
        echo Shopbaseinfo::$sb_sellorrent[$shopBaseInfoModel->sb_sellorrent];
    }else {
        if(isset($shopSellOrRentInfoModel->sr_renttype))
                echo Shopbaseinfo::$renttype[$shopSellOrRentInfoModel->sr_renttype];
    }?>
    <br />


    <br />
    <b>发布时间：</b><?= date("Y-m-d H:i:s", $shopBaseInfoModel->sb_releasedate) ?>

    <br />
    <b>最近更新时间：</b><?= date("Y-m-d H:i:s", $shopBaseInfoModel->sb_updatedate) ?>

    <br>
    <b>有效期：</b><?= date("Y-m-d H:i:s", $shopBaseInfoModel->sb_expiredate) ?>
    <br />
    <? 
    if($shopBaseInfoModel->sb_sellorrent==2){
        ?>
    <b>房源总价：</b><?= $shopSellOrRentInfoModel->ss_sumprice ?>万
    <br />

    <b>平均售价：</b><?= $shopSellOrRentInfoModel->ss_avgprice ?>万/平方
    <br />
    <?}else {?>
    <b>月租金：</b><?= $shopBaseInfoModel->sr_monthrentprice  ?>元
    <br />

    <b>日租金：</b><?= $shopBaseInfoModel->sr_rentprice  ?>元/平方·日
    <br />
            <?if(isset($shopSellOrRentInfoModel->sr_renttype)&&$shopSellOrRentInfoModel->sr_renttype==2){?>
                <b>转让费：</b><?= $shopSellOrRentInfoModel->sr_transferprice  ?>万
           <? }?>
     <?}?>
    

    

	<b>描述：</b><?= $shopPresentInfoModel->sp_shopdesc   ?>
    <br />

</div>
<script>

    function subFrom(toUrl,type){
        var com;
        if(type==8){
            com=prompt("确认下线？\n您的房源因（'|'号前）被强制下线 (6个汉字以内)\n经纪人您好，您在XX楼的房源（'|'号后）感谢您的理解，谢谢！","价格因素|价格偏低，系统认为数据不够精准而被强制下线。建议您从草稿箱中对其重新编辑发布");
        }else if(type==1){
            com=prompt("确认删除？\n您的房源因( '|'号前)被强制删除 (6个汉字以内)\n经纪人您好，您在XX楼的房源（'|'号后）感谢您的理解，谢谢！","价格因素|价格偏低，系统认为数据不够精准而被强制删除。建议您从草稿箱中对其重新编辑发布");
        }
        if(com!=null&&com!=""){
            $.ajax({
                url:toUrl,
                data:{"msg":com,"state":type},
                type:"POST",
                success:function(msg){
                    alert(msg);
                    if(msg!="error"){
                        if(type==8){
                            window.location.href='<?= Yii::app()->createUrl('shopbaseinfo/view', array('id' => $shopBaseInfoModel->sb_shopid)) ?>';
                        }
                        if(type==1){
                            window.location.href='<?= Yii::app()->createUrl('shopbaseinfo/index') ?>';
                        }
                    }
                }
            });
        }
        return false

    }</script>