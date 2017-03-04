<?php
$this->currentMenu = 62;
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
	$model->p_title,
);

$this->menu=array(
	array('label'=>'浏览所有全景', 'url'=>array('index')),
	array('label'=>'修改全景信息', 'url'=>array('update', 'id'=>$model->p_id)),
	array('label'=>'删除该全景', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->p_id),'confirm'=>'你确定要删除该则全景吗?请慎重!?')),
	array('label'=>'管理全景', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('uploadFile')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('uploadFile'); ?>
    </div>
<?php endif; ?>
<h1>所属资源:<?php echo $model->p_buildingid; ?></h1>

<?php echo $this->renderPartial('panoramaView', array('panoramaUrl'=>$model->p_url)); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'p_id',
		'p_title',
		'p_description',
		'p_remark',
		'p_tag',
        array(
          'name'=>'p_buildingid',
          'value'=>Panorama::model()->getPanoramaViewName($model->p_buildingid)
        ),
        array(
          'name'=>'p_type',
          'value'=>Panorama::$typeDescription[$model->p_type],
        ),
        array(
          'name'=>'p_uploadtime',
          'value'=>  showFormatDateTime($model->p_uploadtime),
        ),
	),
)); ?>
