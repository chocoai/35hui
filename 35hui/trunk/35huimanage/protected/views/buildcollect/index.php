<?php
$this->breadcrumbs=array(
	'Buildcollects',
);
$this->currentMenu = 21;
?>

<h1>楼盘征集</h1>
<?php
$arr=array_merge(array('0'=>'不限'),Tags::$tag_belong);
echo CHtml::dropdownlist('select_bc_state',$state,$bc_state,array('id'=>'select_change_belong','onchange'=>'location.href="/buildcollect/index/state/"+this.value+"/m/21"'));
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
