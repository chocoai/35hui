<?php
$buildingName = Systembuildinginfo::model()->getBuildingName($model->p_buildingid);
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
	'修改全景信息',
);

$this->menu=array(
	array('label'=>'浏览所有全景', 'url'=>array('index')),
	array('label'=>'查看该全景', 'url'=>array('view', 'id'=>$model->p_id)),
	array('label'=>'管理全景', 'url'=>array('admin')),
);
?>
<h1>修改全景 Id: <?php echo $model->p_id; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>