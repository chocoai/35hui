<?php
$this->currentMenu = 61;
$this->breadcrumbs=array(
	'Subpanoramas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'返回', 'url'=>array('view','id'=>$model->spn_id)),
);
?>
<h1>上传散拍全景</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'fileForm'=>$fileForm,"giveMoney"=>false)); ?>