<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/kuaisufabu.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" />
<?php
$type = 4;//默认按出租算
if($model->qrq_rstype==1){//代表是出售
    $type = 5;
}
$this->breadcrumbs=array(
    '快速发布信息搜索'=>array('quickrelease/searchIndex','type'=>$type),
	'快速发布需求信息'
);
?>
<!--content start-->
<div class="clearfix"  style="width:984px;margin:0px auto;">
    <div class="quick-content">
        <div class="pnreg-char">
            <dl>
                <dt><div class="info_title"><?=CHtml::encode($model->qrq_title)?></div></dt>
            </dl>
        </div>
        <div class="xiezilou_leftboxone clearfix">
            <ul class="xiezilou_leftulone">
                <li class="one"><img src="<?=DEFAULT_HEAD?>" width="142px" height="132px" alt=""></li>
                <li class="two">
                    <span>联系人：<?=CHtml::encode($model->qrq_contact)?></span><br>
                    <?=$model->qrq_qq?"<span>QQ：".CHtml::encode($model->qrq_qq)."</span><br>":""?>
                    <?=$model->qrq_msn?"<span>Msn：".CHtml::encode($model->qrq_msn)."</span><br>":""?>
                </li>
            </ul>
            <ul class="xiezilou_leftultwo">
                <li class="one">性质：<span><?=CHtml::encode(Lookup::item('relsrtype',$model->qrq_rstype))?></span></li>
                <li class="one">房源类型：<span><?=CHtml::encode(Lookup::item('usetype',$model->qrq_usetype))?></span></li>
                <li class="one">地址：<span><?=CHtml::encode($model->qrq_contact)?></span></li>
                <li class="one">行政区：<span><?=CHtml::encode(Region::model()->getNameById($model->qrq_district))?></span></li>
                <li class="three"><?=CHtml::encode($model->qrq_telephone)?></li>

                <li class="two">有效时间：<span><?=round($model->qrq_expiredate/86400).'天'?></span></li>
                <li class="two">发布时间：<span><?=common::showFormatDateTime($model->qrq_releasedate)?></span></li>
            </ul>
            <div class="info_detail">房源描述：<br><?=$model->qrq_desc?></div>
        </div>
    </div>
</div>
<!--content end-->
