<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
	'楼盘管理',
    '基本信息管理'
);

$this->menu=array(
	array('label'=>'新建楼盘', 'url'=>array('create')),
	array('label'=>'管理楼盘', 'url'=>array('admin')),
);
?>

<h1>楼盘基本信息</h1>
<form action="" method="get">
	<div class="row">
		楼盘名称：<?php echo CHtml::textField('buildingname',$name,array('size'=>50,'maxlength'=>50)); ?>
	</div>
<div class="row"><input type="submit" value="搜索" onclicik="$('#search-fomr').submit();"/></div>
</form>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
