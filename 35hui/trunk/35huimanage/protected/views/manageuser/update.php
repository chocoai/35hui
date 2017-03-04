<?php
$this->breadcrumbs=array(
	'用户管理'=>array('index'),
	'信息编辑',
);

$this->menu=array(
	array('label'=>'用户列表', 'url'=>array('index')),
	array('label'=>'创建用户', 'url'=>array('create')),
);
?>

<h1>Update Manageuser <?php echo $model->mag_userid; ?></h1>

<?php echo $this->renderPartial('_update', array('model'=>$model)); ?>