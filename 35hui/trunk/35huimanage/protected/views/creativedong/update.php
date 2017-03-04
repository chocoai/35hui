<?php
$this->breadcrumbs=array(
	'Creativedongs'=>array('admin','cpid'=>$model->cd_cpid),
	'Update',
);

$this->menu=array(
    array('label'=>'返回', 'url'=>array('admin','cpid'=>$model->cd_cpid)),
);
?>

<h1>Update Creativedong <?php echo $model->cd_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'parkModel'=>$parkModel)); ?>