<?php
$this->breadcrumbs=array(
	'管理广告图片',
);

$this->menu=array(
	array('label'=>'管理广告图片', 'url'=>array('admin')),
);
?>
<style type="text/css">
.mark{
    position: absolute;
    margin-left: 400px;
    height: 20px;
    width: 80px;
    line-height: 20px;
/*    background-color: yellow;*/
    margin-top: 10px;
    text-align: center;
}
.red{
    color: red;
}
.green{
    color:green;
}
</style>
<?php if(Yii::app()->user->hasFlash('viewAd')): ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('viewAd'); ?>
    </div>
<?php endif; ?>

<h1>管理广告栏图片</h1>

<?
    foreach(Advertisement::$advertiseConfig as $key=>$config){
?>
    <div class="view">
        <div class="right-tip">
            <div class="font-20" style="float:left;">位置&nbsp;</div>
            <div class="right-id-tip deepskyblue">
                <?=$key?>
            </div>
        </div>
        <div class="mark">
            <?=in_array($key, $positionArray)?"<font class='red'>已有广告</font>":"<font class='green'>尚无</font>"?>
        </div>
        位置介绍：<b><?=$config['description']?></b><br />
        <br />
        <?=CHtml::link('上传广告',array('advertisement/create','position'=>$key));?>&nbsp;&nbsp;
        <?=CHtml::link('查看广告',array('advertisement/view','position'=>$key));?>
    </div>
<?
    }
?>
