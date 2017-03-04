<?php
$this->breadcrumbs=array(
	'Siteindexes'=>array('index'),
	$model->si_id=>array('view','id'=>$model->si_id),
	'Update',
);

$this->menu=array(
	array('label'=>'返回列表', 'url'=>array('index')),
);
?>

<h1><?php echo $title;?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'type'=>$type,'sellPrice'=>$sellPrice, 'rentPrice'=>$rentPrice,)); ?>