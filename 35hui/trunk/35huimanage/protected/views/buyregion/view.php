<?php
$this->breadcrumbs=array(
	'Buyregions'=>array('index'),
	$model->br_id,
);

$this->menu=array(
	array('label'=>'列表', 'url'=>array('index')),
	array('label'=>'添加新纪录', 'url'=>array('create')),
	array('label'=>'删除纪录', 'url'=>array('delete','id'=>$model->br_id)),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('message')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('message'); ?>
</div>
<?php endif; ?>

<h1>View Buyregion #<?php echo $model->br_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'br_id',
        array(
            "name"=>"br_userid",
            "value"=>User::model()->getRealNamebyid($model->br_userid),
        ),
		array(
            "name"=>"br_regionid",
            "value"=>Buyregion::model()->getShowRegionName($model->br_regionid),
        ),
        array(
            "name"=>"br_sourcetype",
            "value"=>Buyregion::$br_sourcetype[$model->br_sourcetype],
        ),
        array(
            "name"=>"br_sellorrent",
            "value"=>Buyregion::$br_sellorrent[$model->br_sellorrent],
        ),
        array(
            "name"=>"br_buytime",
            "value"=>date("y-m-d H:i",$model->br_buytime),
        ),
        array(
            "name"=>"br_expiredate",
            "value"=>(($model->br_expiredate)/86400)."天",
        ),
        array(
            "name"=>"br_status",
            "value"=>Buyregion::$br_status[$model->br_status],
        ),
	),
)); ?>
