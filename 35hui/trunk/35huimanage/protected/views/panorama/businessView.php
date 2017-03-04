<?php
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
    '商务中心'=>array('businessIndex'),
	$model->bc_name,
);

$this->menu=array(
	array('label'=>'更换首页全景', 'url'=>array('changeIndexShow','sId'=>$model->bc_id,'sType'=>Panorama::business)),
    array('label'=>'上传房型图','url'=>array('picture/uploadPic','sId'=>$model->bc_id,'sType'=>Picture::$sourceType['businesscenter'],'pType'=>Picture::$picType['ichnograph'])),
    array('label'=>'上传房型图全景','url'=>array('uploadHouseLayout','sId'=>$model->bc_id,'sType'=>Panorama::business)),
	array('label'=>'绑定房型图全景', 'url'=>array('showHouseLayout','sId'=>$model->bc_id,'sType'=>Panorama::business)),
	array('label'=>'上传散拍全景', 'url'=>array('uploadScatter','sId'=>$model->bc_id,'sType'=>Panorama::business)),
	array('label'=>'上传导览全景房源', 'url'=>array('uploadNavigation','sId'=>$model->bc_id,'sType'=>Panorama::business)),
);
?>
<style type="text/css">
.stick{
    width: 710px;
    height:20px;
    background-color: #4ECDC4;
    color:white;
    font-weight: bold;
    line-height: 20px;
    margin-bottom: 7px;
    clear: right;
}
.list{
    list-style: none;
}
.list li{
    background-color: #eeeeee;
    line-height: 18px;
    margin: 2px 0px;
}
.descrip {
    overflow: hidden;
    word-wrap: break-word;
    display: inline;
}
.more{
    float: right;
    display: inline-block;
    height: 23px;
    padding-right: 10px;
}
</style>
<?php if(Yii::app()->user->hasFlash('uploadFile')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('uploadFile'); ?>
    </div>
<?php endif; ?>
<?
foreach($allPanoramas as $type=>$panoramas){
    echo "<div class='stick'>".Panorama::$typeDescription[$type]."<div style='float:right;display:inline-block'>查看更多</div></div>";
    echo "<ul class='list'>";
    foreach($panoramas as $panorama){
?>
        <li>
        <div class='descrip'>描述信息:<?=$panorama->p_description?></div>
        <div>
            <span>上传时间:<?=showFormatDateTime($panorama->p_recordtime)?></span>
            <div class='more'>
                <?=CHtml::link("删除","#",array('style'=>'color:red','submit'=>array('delete','id'=>$panorama->p_id),'confirm'=>'你确定要删除这个全景?'))?>
                <?=CHtml::link("修改信息",array('update','id'=>$panorama->p_id))?>
                <?=CHtml::link("查看全景",array('panoramaView','id'=>$panorama->p_id),array('target'=>'_blank'))?>
            </div>
        </div>
        </li>
<?
    }
    echo "</ul>";
}
?>