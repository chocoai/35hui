<?php
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
	'上传全景',
);

$this->menu=array(
	array('label'=>'返回全景资源管理首页', 'url'=>array('index')),
	array('label'=>'管理全景资源', 'url'=>array('admin')),
);
?>

<h1>Create Panorama</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>