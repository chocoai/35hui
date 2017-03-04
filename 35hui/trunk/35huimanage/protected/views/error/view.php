<?php
$this->breadcrumbs=array(
	'楼盘纠错管理'=>array('index'),
	$model->e_id,
);

$this->menu=array(
	array('label'=>'查看所有纠错信息', 'url'=>array('index')),
);
?>

<h1>查看纠错信息 #<?php echo $model->e_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'e_id',
		'e_content',
        array(
            'name'=>'e_buildid',
            'type'=>'raw',
            'value'=>"<a target='_blank' title=\"编辑本楼盘\" href='".Yii::app()->createUrl('systembuildinginfo/update',array('id'=>$model->e_buildid))."'>".Systembuildinginfo::model()->getBuildingName($model->e_buildid)."</a>",
        ),
        array(
            'type'=>'raw',
            'name'=>'e_userid',
            'value'=>User::model()->getUserShowLink($model->e_userid),
        ),
		'e_nickname',
		'e_telphone',
		'e_email',
        array(
            'name'=>'e_state',
            'value'=>Error::$stateDes[$model->e_state],
        ),
        array(
            'name'=>'e_date',
            'value'=>  showFormatDateTime($model->e_date),
        )
	),
)); ?>
<?
    if($model->e_state==0){
?>
<div style="text-align: center;margin-top: 10px;">
    <?=CHtml::link("受理",array('error/dealError','id'=>$model->e_id,'state'=>'1'));?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?=CHtml::link("不受理",array('error/dealError','id'=>$model->e_id,'state'=>'2'));?>
</div>
<?
    }
?>