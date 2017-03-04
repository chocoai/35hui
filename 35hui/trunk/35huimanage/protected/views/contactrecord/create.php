<?php
$this->currentMenu = 100;
$this->breadcrumbs=array(
	'联系人管理'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'查看所有联系人', 'url'=>array('index')),
	array('label'=>'管理联系人', 'url'=>array('admin')),
);
?>

<h1>新建联系人记录</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>