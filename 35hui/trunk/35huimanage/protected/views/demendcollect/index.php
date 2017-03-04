<?php
$this->breadcrumbs=array(
	'所有记录',
);

$this->menu=array(
	array('label'=>'新建记录', 'url'=>array('create')),
	array('label'=>'管理记录', 'url'=>array('admin')),
);
?>

<form action="" method="get">
	<div class="row">
                房源类型：<?php echo CHtml::dropDownList('dc_buildtype',$dc_buildtype,Demendcollect::$dc_buildtype); ?>
		租售类型：<?php echo CHtml::dropDownList('dc_type',$dc_type,Demendcollect::$dc_type); ?>
                楼盘/小区名称：<?php echo CHtml::textField('dc_buildname',$dc_buildname,array('size'=>20,'maxlength'=>50)); ?>
                <input type="submit" value="搜索" onclici="$('#search-fomr').submit();"/>
	</div>
</form>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
