<?php
if(empty($_GET['cpid']) || !($parkModel=Creativeparkbaseinfo::model()->findByPk($_GET['cpid']))){
    echo $this->renderText(CHtml::link('返回创意园区',array('creativeparkbaseinfo/admin')));
    exit;
}
$dataProvider=new CActiveDataProvider('Creativedong',array(
    'criteria'=>array('condition'=>'cd_cpid='.$_GET['cpid']),
));
$this->breadcrumbs=array(
	'创意园区'=>array('creativeparkbaseinfo/admin'),
	$parkModel->cp_name,
);

$this->menu=array(
	//array('label'=>'List Creativedong', 'url'=>array('index')),
	array('label'=>'添加楼栋', 'url'=>array('create','cpid'=>$parkModel->cp_id)),
);

?>

<h1>Manage Creativedongs</h1>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'creativedong-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'cd_id',
		//'cd_cpid',
		'cd_lounum',
		'cd_area',
		'cd_floorarea',
		'cd_fengearea',
		'cd_floornum',
		'cd_form',
		'cd_floorheight',
		'cd_liftnum',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
)); ?>
