<?php
$this->breadcrumbs=array(
	'所有面谈记录'=>array('index'),
	'添加面谈记录',
);

$this->menu=array(
	array('label'=>'所有面谈记录', 'url'=>array('index')),
	array('label'=>'管理面谈记录', 'url'=>array('admin')),
);
?>

<h1>添加面谈记录</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>