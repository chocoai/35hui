<?php
$this->breadcrumbs=array(
	'微博管理',
);
$this->currentMenu = 49;
$showLabel = '查看所有楼盘微博信息';
$url = array('twitterIndexBuild');
$sourceView = '_sourceView';
if($type==2){
    $showLabel = '查看所有小区微博信息';
    $url = array('twitterIndexCommunity');
    $sourceView = '_sourceViewC';
}
$this->menu=array(
	array('label'=>$showLabel, 'url'=>$url),
);
?>
<?php if(Yii::app()->user->hasFlash('bindMessage')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('bindMessage'); ?>
    </div>
<?php endif;?>
<h1>查看提供的微博播报信息</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>$sourceView,
)); ?>
