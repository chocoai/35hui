<?php
$this->breadcrumbs=array(
	'站内信管理'=>array('index'),
	'发送站内信',
);

$this->menu=array(
	array('label'=>'查看所有站内信', 'url'=>array('index')),
	array('label'=>'管理站内信', 'url'=>array('admin')),
);
?>

<h1>新建站内信</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>