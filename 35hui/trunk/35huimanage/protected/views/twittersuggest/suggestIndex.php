<?php
$buildingId = '';
$buildingName = '';
$managerIndex = '';
if($type==1){
    $buildingId = $model->sbi_buildingid;
    $buildingName = $model->sbi_buildingname;
    $managerIndex = array('buildIndex');
}else{
    $buildingId = $model->comy_id;
    $buildingName = $model->comy_name;
    $managerIndex = array('communityIndex');
}
$this->breadcrumbs=array(
	'微博管理'=>$managerIndex,
    '绑定微博'
);
$this->currentMenu = 49;
$this->menu=array(
	array('label'=>'自行录入微博信息', 'url'=>array('diyCreate','buildingId'=>$buildingId,'type'=>$type)),
);
?>
<?php if(Yii::app()->user->hasFlash('bindMessage')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('bindMessage'); ?>
    </div>
<?php endif; ?>
<h1><?=$buildingName?></h1>
<h5>查看提供的微博播报信息</h5>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
