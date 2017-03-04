<?php
$this->breadcrumbs=array(
	'房源标签管理',
);

$this->menu=array(
	array('label'=>'新建标签', 'url'=>array('create')),
	array('label'=>'管理标签', 'url'=>array('admin')),
);
//租售下拉框显示值限制
$markeytypeSelectArr=Tags::$markettype;
strstr('234',$tag_belong) && $markeytypeSelectArr=array('0'=>'租','1'=>'售');//写字楼2，工厂3，商铺4，只有租和售
strstr('157',$tag_belong) && $markeytypeSelectArr=array('2'=>'不限');//楼盘1，大型项目5只有不限
strstr('6',$tag_belong) &&$markeytypeSelectArr=array('0'=>'租');//商务中心6只有租

?>

<h1>标签</h1>
<?php
$arr=array_merge(array('0'=>'不限'),Tags::$tag_belong);
echo CHtml::dropdownlist('select_change_belong',$tag_belong,$arr,array('id'=>'select_change_belong','onchange'=>'location.href="/tags/index/tag_belong/"+this.value'));
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::dropdownlist('select_change_markettype',$markettype,$markeytypeSelectArr,array('id'=>'select_change_markettype','onchange'=>'var obj=document.getElementById(\'select_change_belong\');location.href=\'/tags/index/tag_belong/\'+obj.value+\'/markettype/\'+this.value'));
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
