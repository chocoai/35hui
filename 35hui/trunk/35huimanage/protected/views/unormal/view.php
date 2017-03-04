<?php
$this->breadcrumbs=array(
	'Unormals'=>array('index'),
	$model->puser_id,
);
$this->currentMenu = 9;
$this->menu=array(
	array('label'=>'查看列表', 'url'=>array('index')),
	array('label'=>'删除用户', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->puser_id),'confirm'=>'确定要删除此用户吗?')),
    array('label'=>'赠送积分和商务币', 'url'=>array('/user/givemp',"userid"=>$model->puser_uid)),
);
?>

<h1>查看个人用户 #<?php echo $model->puser_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'puser_id',
		'puser_uid',
        array(
            'name'=>"puser_logopath",
            'value'=>CHtml::image(User::model()->getUserHeadPic($model->puser_uid),"",array("width"=>"100px","height"=>"130px")),
            'type'=>'raw',
        ),
		'puser_vip',
	),
)); ?>
