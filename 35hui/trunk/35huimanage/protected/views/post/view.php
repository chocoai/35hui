<?php
$this->breadcrumbs=array(
	'公告管理'=>array('index'),
	$model->post_id,
);
$this->menu=array(
	array('label'=>'查看当前有效公告', 'url'=>array('index')),
	array('label'=>'发布公告', 'url'=>array('create')),
	array('label'=>'删除公告', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->post_id),'confirm'=>'你确定要删除当前公告吗?')),
    array('label'=>'修改公告', 'url'=>array('update', 'id'=>$model->post_id)),
);
?>
<?php if(Yii::app()->user->hasFlash('sendState')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('sendState'); ?>
    </div>
<?php endif; ?>
<h1>查看公告 ID:<?php echo $model->post_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'post_id',
        'post_title',
		'post_content',
        array(
            'name'=>'post_role',
            'value'=>Post::$roleDescription[$model->post_role]
        ),
        array(
            'name'=>'post_time',
            'value'=>showFormatDateTime($model->post_time)
        )
	),
)); ?>
