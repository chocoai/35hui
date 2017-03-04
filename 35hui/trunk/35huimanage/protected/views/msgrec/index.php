<?php
$this->breadcrumbs=array(
	'意见管理',
);

$this->menu=array(
	array('label'=>'管理意见', 'url'=>array('admin')),
);
?>
<h1>建议/意见列表</h1>
<form method="POST" action="">
    <?=CHtml::dropDownList("status",$status,array('所 有','未处理','已处理'),array('onchange'=>'this.form.submit()'))?>
</form>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
