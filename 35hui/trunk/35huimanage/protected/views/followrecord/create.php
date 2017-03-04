<?php
$this->breadcrumbs=array(
	'所有跟进记录'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'所有跟进记录', 'url'=>array('index')),
	array('label'=>'跟进记录管理', 'url'=>array('admin')),
);
?>

<h1>添加跟进记录</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'contactmodel'=>$contactmodel,'userid'=>$userid,'msgtip'=>$msgtip)); ?>