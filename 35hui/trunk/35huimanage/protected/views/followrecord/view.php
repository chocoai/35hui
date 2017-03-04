<?php
$this->breadcrumbs=array(
	'Followrecords'=>array('index'),
	$model->fr_id,
);
if($model->contact->cr_isregistered){
    $this->menu=array(
            array('label'=>'经纪人详细页', 'url'=>array('uagent/view', 'id'=>Uagent::model()->findByAttributes(array('ua_uid'=>$model->contact->cr_userid))->ua_id)),
            array('label'=>'添加面谈记录', 'url'=>array('meetrecord/create', 'id'=>$model->fr_id)),
            array('label'=>'编辑跟进记录', 'url'=>array('update', 'id'=>$model->fr_id)),
    );
}else{
    $this->menu=array(
            array('label'=>'添加面谈记录', 'url'=>array('meetrecord/create', 'id'=>$model->fr_id)),
            array('label'=>'面谈记录列表', 'url'=>array('meet', 'id'=>$model->fr_id)),
            array('label'=>'所有跟进记录', 'url'=>array('index')),
            array('label'=>'编辑跟进记录', 'url'=>array('update', 'id'=>$model->fr_id)),
            array('label'=>'删除跟进记录', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fr_id),'confirm'=>'确定删除这条记录吗?')),
    );
}
?>

<h1>查看ID为<?php echo $model->fr_id; ?>的跟进记录</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fr_id',
		'fr_content',
		'fr_salesman',
		array(
                'name'=>'fr_followtime',
                'value'=>date("Y-m-d H:i:s",$model->fr_followtime),
                ),
		'fr_remindtime',
		'fr_reservetime',
		'fr_address',
                array(
                'name'=>'fr_status',
                'value'=>$model->fr_status?'已完成':'预约面谈'
                 ),
	),
)); ?>