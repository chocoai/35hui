<?php
$this->breadcrumbs=array(
	'Quickrequires',
);
?>

<ul class="actions">
	<li><?php echo CHtml::link('发布需求信息',array('release')); ?></li>
</ul><!-- actions -->
<h1>查看所有快速发布需求信息</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
