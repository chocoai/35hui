<?php
$this->currentMenu = 24;
$name = "";
$sourceUrl = "#";//返回的链接
switch ($type){
    case Subpanorama::office:
        $name = "写字楼";
        $sourceUrl = "officebaseinfo/view";
        $this->menu=array(
            array('label'=>'查看房源信息','url'=>array($sourceUrl,'id'=>$sourceId)),
        );
        break;
    case Subpanorama::shop :
        $name = "商铺";
        $sourceUrl = "shopbaseinfo/view";
        $this->menu=array(
            array('label'=>'查看房源信息','url'=>array($sourceUrl,'id'=>$sourceId)),
        );
        break;
    case Subpanorama::business:
        $name = "商务中心";
        $sourceUrl = "businesscenter/view";
        $this->menu=array(
            array('label'=>'上传全景','url'=>array('sourceupload','sourceId'=>$sourceId,'type'=>$type)),
            array('label'=>'查看房源信息','url'=>array($sourceUrl,'id'=>$sourceId)),
        );
        break;
}
$this->breadcrumbs=array(
	$name.'全景管理',
	$sourceId,
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
<div class='stick'></div>
    <ul class='list'>
<?php
if($panoramas){
   foreach($panoramas as $panorama){
    ?>
        <li style="margin-top: 10px">
            <div>标题:<b><?=$panorama->spn_panoramaname?></b></div>
            <div>
                <span>上传时间:<?=showFormatDateTime($panorama->spn_completetime)?></span>
                <div class='more'>
                    <?=CHtml::link("删除","#",array('style'=>'color:red','submit'=>array('delete','id'=>$panorama->spn_id),'confirm'=>'你确定要删除这个全景?'))?>&nbsp;&nbsp;
                    <?=CHtml::link("查看全景",array('preview','id'=>$panorama->spn_id),array('target'=>'_blank'))?>
                </div>
            </div>
        </li>
    <?php
    }
}else{
    echo "此房源还没有上传任何全景";
}
?>
    </ul>