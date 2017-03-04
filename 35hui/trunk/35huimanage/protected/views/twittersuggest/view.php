<?php
$this->breadcrumbs=array(
	'微博管理'=>array('index'),
	'查看微博',
);
$this->currentMenu = 49;
$buildId='';
$showName='';
$name='';
if($type==1){
$buildId = $model->sbi_buildingid;
$showName = $model->sbi_buildingname;
$name = '楼盘名称';
}else{
    $buildId = $model->comy_id;
    $showName = $model->comy_name;
    $name = '小区名称';
}
$this->menu=array(
	array('label'=>'自行录入微博信息', 'url'=>array('diyCreate','buildingId'=>$buildId,'type'=>$type)),
);
?>
<?php if(Yii::app()->user->hasFlash('bindMessage')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('bindMessage'); ?>
    </div>
<?php endif; ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$twitter,
	'attributes'=>array(
		't_id',
        array(
            'label'=>$name,
            'value'=>$showName
        ),
        array(
            'name'=>'t_userid',
            'value'=>User::model()->getUserName($twitter->t_userid)
        ),
		't_message',
        array(
            'name'=>'t_recordtime',
            'value'=>showFormatDateTime($twitter->t_recordtime)
        )
	),
)); ?>
