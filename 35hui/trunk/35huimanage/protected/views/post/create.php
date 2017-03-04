<?php
$this->breadcrumbs=array(
	'公告管理'=>array('index'),
	'发布公告',
);

$this->menu=array(
	array('label'=>'查看当前公告', 'url'=>array('index')),
);
?>

<h1>发布公告</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>