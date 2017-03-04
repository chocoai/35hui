<?php
if ($p_ptype == 2) {
     $this->currentMenu = 77;
    $this->breadcrumbs=array(
        '全景小区管理'=>array('index'),
        $model->comy_name,
    );
    $this->menu=array(
        array('label'=>'查看小区信息','url'=>array("communitybaseinfo/view","id"=>$model->comy_id)),
        array('label'=>'上传全景','url'=>array('uploadPanorama','id'=>$model->comy_id, 'p_ptype'=>$p_ptype)),
    );
}elseif($p_ptype == 3){
    $this->breadcrumbs=array(
        '创意园区楼盘全景管理'=>array('index'),
        $model->cp_name,
    );
    $this->menu=array(
        array('label'=>$model->cp_name,'url'=>array("creativeparkbaseinfo/view","id"=>$model->cp_id)),
        array('label'=>'上传全景','url'=>array('uploadPanorama','id'=>$model->cp_id, 'p_ptype'=>$p_ptype)),
    );
} else {
   $this->currentMenu = 18;
   $this->breadcrumbs=array(
        '全景资源管理'=>array('index'),
        $model->sbi_buildingname,
    );
    $this->menu=array(
        array('label'=>'查看楼盘信息','url'=>array("systembuildinginfo/view","id"=>$model->sbi_buildingid)),
        array('label'=>'上传全景','url'=>array('uploadPanorama','id'=>$model->sbi_buildingid)),
    );
}
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
            <div>标题:<b><?=$panorama->p_title?></b></div>
            <div class='descrip'>描述信息:<?=$panorama->p_description?></div>
            <div>备注:<?=$panorama->p_remark?></div>
            <div>标签:<?=$panorama->p_tag?></div>
            <div>
                <span>上传时间:<?=showFormatDateTime($panorama->p_uploadtime)?></span>
                <div class='more'>
                    <?=CHtml::link("删除","#",array('style'=>'color:red','submit'=>array('delete','id'=>$panorama->p_id),'confirm'=>'你确定要删除这个全景?'))?>&nbsp;&nbsp;
                    <?=CHtml::link("修改",array('update','id'=>$panorama->p_id))?>&nbsp;&nbsp;
                    <?=CHtml::link("查看全景",array('panoramaView','id'=>$panorama->p_id),array('target'=>'_blank'))?>
                </div>
            </div>
        </li>
<?
    }
    echo "</ul>";
}
?>