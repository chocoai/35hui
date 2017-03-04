<?php
$this->breadcrumbs=array(
	'创意园区'=>array('admin'),
	$model->cp_id,
);

$this->menu=array(
	array('label'=>'创建', 'url'=>array('create')),
	array('label'=>'修改', 'url'=>array('update', 'id'=>$model->cp_id)),
    array('label'=>'图片', 'url'=>array('picture/sourceView','sId'=>$model->cp_id,'sType'=>'9')),
    array('label'=>'全景', 'url'=>array('panorama/buildingView', 'id'=>$model->cp_id,'p_ptype'=>'3')),
    array('label'=>'楼栋', 'url'=>array('creativedong/admin', 'cpid'=>$model->cp_id)),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cp_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理', 'url'=>array('admin')),
    array('label'=>'过滤房源', 'url'=>array('filtersource',"id"=>$model->cp_id)),
);
?>

<h1>View Creativeparkbaseinfo #<?php echo $model->cp_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cp_id',
		'cp_name',
		'cp_englishname',
		'cp_pinyinshortname',
		'cp_pinyinlongname',
		'cp_district',
		'cp_address',
		'cp_avgrentprice',
		'cp_developer',
		'cp_propertyprice',
		'cp_propertyname',
		'cp_openingtime',
		'cp_defanglv',
		'cp_area',
		'cp_fengearea',
		'cp_floorheight',
		'cp_form',
		'cp_introduce',
		'cp_traffic',
		'cp_carport',
		'cp_propertyserver',
		'cp_roommating',
		'cp_peripheral',
		'cp_x',
		'cp_y',
	),
)); ?>
