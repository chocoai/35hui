<?php
$this->breadcrumbs=array(
	'楼盘纠错管理',
);
$this->menu=array(
	array('label'=>'查看纠错历史', 'url'=>array('history')),
);
?>
<?php if(Yii::app()->user->hasFlash('dealError')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('dealError'); ?>
    </div>
<?php endif; ?>
<h1>所有纠错信息</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
