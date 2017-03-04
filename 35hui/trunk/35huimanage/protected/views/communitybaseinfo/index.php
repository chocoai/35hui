<?php
$this->currentMenu = 77;
$this->breadcrumbs=array(
	'小区管理',
    '基本信息管理'
);

$this->menu=array(
	array('label'=>'新建小区', 'url'=>array('create')),
	array('label'=>'管理小区', 'url'=>array('admin')),
);
?>

<h1>小区基本信息</h1>
<form action="" method="post">
	<div class="row">
		小区名称：<?php echo CHtml::textField('comy_name',$name,array('size'=>50,'maxlength'=>50)); ?>
	</div>
<div class="row"><input type="submit" value="搜索" onclici="$('#search-fomr').submit();"/></div>
</form>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
