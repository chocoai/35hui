<?php
$this->breadcrumbs=array(
	'广告图片管理'=>array('index'),
	'上传广告图片',
);

$this->menu=array(
	array('label'=>'返回广告首页', 'url'=>array('index')),
	array('label'=>'管理广告图片', 'url'=>array('admin')),
);
?>

<h1>上传广告图片</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'adConfig'=>$adConfig)); ?>