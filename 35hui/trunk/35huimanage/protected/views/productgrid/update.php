<?php
$this->breadcrumbs=array(
	'推荐精选商务币设置'=>array('index'),
	'更新',
);
$this->currentMenu = 65;
$this->menu=array(
	array('label'=>'查看所有', 'url'=>array('index')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>