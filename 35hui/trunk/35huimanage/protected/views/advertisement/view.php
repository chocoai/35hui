<?php
$this->breadcrumbs=array(
	'广告图片管理'=>array('index'),
	$model->ad_id,
);

$this->menu=array(
	array('label'=>'返回广告首页', 'url'=>array('index')),
	array('label'=>'修改广告', 'url'=>array('update', 'position'=>$model->ad_position)),
	array('label'=>'删除此广告', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ad_id),'confirm'=>'你确定要删除这个广告吗?')),
	array('label'=>'管理广告', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('viewAd')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('viewAd'); ?>
    </div>
<?php endif; ?>

<h1>查看 广告图片 Id #<?php echo $model->ad_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ad_id',
		'ad_position',
        array(
            'name'=>'ad_picurl',
            'type'=>'raw',
            'value'=>CHtml::image(PIC_URL.$model->ad_picurl,"",array("width"=>"500px")),
        ),
        array(
            'name'=>'ad_linkurl',
            'value'=>urldecode($model->ad_linkurl),
        ),
		'ad_alt',
        array(
            'name'=>'ad_uploadtime',
            'value'=>showFormatDateTime($model->ad_uploadtime),
        ),
	),
)); ?>
