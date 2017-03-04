<?php
$this->breadcrumbs=array(
	'站点后台用户管理'=>array('index'),
	'创建用户',
);
$this->currentMenu = 74;
$this->menu=array(
	array('label'=>'用户列表', 'url'=>array('index')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model,'roles'=>$roles)); ?>