<?php
$this->breadcrumbs=array(
	'Officebaseinfos',
);

$this->menu=array(
	array('label'=>'Create officebaseinfo', 'url'=>array('create')),
	array('label'=>'Manage officebaseinfo', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText'=>'共有<strong>{count}</strong>套符合要求的房子'
)); ?>
