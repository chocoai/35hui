<?php
$this->breadcrumbs=array(
	'写字楼房源基本信息'=>array('index'),
	'新建',
);
$this->currentMenu = 11;
$this->menu=array(
	array('label'=>'浏览数据', 'url'=>array('index')),
	array('label'=>'管理数据', 'url'=>array('admin')),
);
?>

<h1>新建条 officebaseinfo 数据</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>