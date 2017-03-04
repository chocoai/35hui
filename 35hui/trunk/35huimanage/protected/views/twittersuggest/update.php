<?php
$this->breadcrumbs=array(
	'Update',
);
$this->currentMenu = 49;
$this->menu=array(
	array('label'=>'查看所有楼盘微博', 'url'=>array('buildIndex')),
	array('label'=>'查看所有小区微博', 'url'=>array('communityIndex')),
	array('label'=>'Manage Twittersuggest', 'url'=>array('admin')),
);
?>

<h1>Update Twittersuggest <?php echo $model->ts_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>