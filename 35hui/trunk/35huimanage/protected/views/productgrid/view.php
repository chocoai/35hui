<?php
$this->breadcrumbs=array(
	'推荐精选商务币设置'=>array('index'),
	'查看',
);
$this->currentMenu = 65;
$this->menu=array(
	array('label'=>'修改', 'url'=>array('update', 'id'=>$model->p_id)),
	array('label'=>'查看所有', 'url'=>array('index')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'p_id',
        array(
            'name'=>'p_page',
            'value'=>Productgrid::$p_page[$model->p_page]
        ),
		array(
            "name"=>"p_position",
            "value"=>Productgrid::$p_position[$model->p_position]
        ),
        array(
            "name"=>'p_index',
            "value"=>"第".CHtml::encode($model->p_index)."格"
        ),
        array(
            "name"=>"p_positiontype",
            "value"=>Productgrid::$p_positiontype[$model->p_positiontype]
        ),
        'p_baseprice',
        'p_nowprice',
        'p_raisespercent',
        'p_droppercent',
        'p_maxbuydays',
        'p_protectpricedays',
        'p_lastbuydatys',
        array(
            "name"=>'p_lastbuytime',
            "value"=>date("Y-m-d H:i", $model->p_lastbuytime),
        )
	),
)); ?>
