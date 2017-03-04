<?php
$this->breadcrumbs=array(
	'所有面谈记录'=>array('index'),
	$model->mr_id,
);
if($model->contact->cr_isregistered){
    $this->menu=array(
            array('label'=>'经纪人详细页', 'url'=>array('uagent/view', 'id'=>Uagent::model()->findByAttributes(array('ua_uid'=>$model->contact->cr_userid))->ua_id)),
            array('label'=>'添加购买记录', 'url'=>array('buyrecord/create', 'id'=>$model->mr_id)),
            array('label'=>'编辑面谈记录', 'url'=>array('update', 'id'=>$model->mr_id)),
    );
}else{
    $this->menu=array(
            array('label'=>'添加购买记录', 'url'=>array('buyrecord/create', 'id'=>$model->mr_id)),
            array('label'=>'购买记录列表', 'url'=>array('buy', 'id'=>$model->mr_id)),
            array('label'=>'所有面谈记录', 'url'=>array('index')),
            array('label'=>'编辑面谈记录', 'url'=>array('update', 'id'=>$model->mr_id)),
            array('label'=>'删除面谈记录', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mr_id),'confirm'=>'你确定删除该记录?')),
            array('label'=>'管理面谈记录', 'url'=>array('admin')),
    );
}
?>

<h1>查看ID为<?php echo $model->mr_id; ?>的面谈记录</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mr_id',
		'mr_remark',
		'mr_salesman',
		 array(
                'name'=>'mr_time',
                'value'=>date("Y-m-d H:i:s",$model->mr_time),
                ),
	),
)); ?>
