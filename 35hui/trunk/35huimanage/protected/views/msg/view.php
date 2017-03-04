<?php
$this->breadcrumbs=array(
	'站内信管理'=>array('index'),
	$model->msg_id,
);

$this->menu=array(
	array('label'=>'查看所有站内信', 'url'=>array('index')),
	array('label'=>'给发信人发送站内信', 'url'=>array('create','toUserId'=>$model->msg_sendid)),
	array('label'=>'给收信人发送站内信', 'url'=>array('create','toUserId'=>$model->msg_revid)),
//	array('label'=>'删除站内信', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->msg_id),'confirm'=>'你确定要删除这则站内信吗?')),
	array('label'=>'管理站内信', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('sendState')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('sendState'); ?>
    </div>
<?php endif; ?>
<h1>查看站内信 ID:<?php echo $model->msg_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'msg_id',
        array(
            'name'=>'msg_sendid',
            'value'=>$model->msg_sendid==0?"客服管理员":User::model()->getUserName($model->msg_sendid)
        ),
        array(
            'name'=>'msg_revid',
            'value'=>$model->msg_revid==0?"客服管理员":User::model()->getUserName($model->msg_revid)
        ),
		'msg_title',
		'msg_content',
        array(
            'name'=>'msg_type',
            'value'=>Msg::$msgTypeDescription[$model->msg_type]
        ),
        array(
            'name'=>'msg_time',
            'value'=>showFormatDateTime($model->msg_time)
        ),
        array(
            'name'=>'msg_senddel',
            'value'=>Msg::$delDescription[$model->msg_senddel]
        ),
        array(
            'name'=>'msg_revdel',
            'value'=>Msg::$delDescription[$model->msg_revdel],
        ),
		'msg_isread',
	),
)); ?>
