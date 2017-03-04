<?php
$this->breadcrumbs=array(
    'Creativedongs'=>array('admin','cpid'=>$parkModel->cp_id),
	'Create',
);

$this->menu=array(
	array('label'=>'返回', 'url'=>array('admin','cpid'=>$parkModel->cp_id)),
);
?>

<h1>Create Creativedong</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'parkModel'=>$parkModel)); ?>