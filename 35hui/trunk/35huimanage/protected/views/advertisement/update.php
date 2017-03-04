<?php
$this->breadcrumbs=array(
	'管理广告图片'=>array('index'),
	$model->ad_id=>array('view','id'=>$model->ad_id),
	'修改广告信息',
);

$this->menu=array(
	array('label'=>'返回广告首页', 'url'=>array('index')),
	array('label'=>'查看广告', 'url'=>array('view', 'id'=>$model->ad_id)),
	array('label'=>'管理广告', 'url'=>array('admin')),
);
?>

<h1>修改广告信息 <?php echo $model->ad_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'adConfig'=>$adConfig)); ?>