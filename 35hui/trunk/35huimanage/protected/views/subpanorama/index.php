<?php
$this->currentMenu = 61;
$this->breadcrumbs=array(
	'散拍全景',
);
?>

<h1>散拍全景列表</h1>
<form method="post" action="">
    <?=CHtml::dropDownList("spn_state",$spn_state,Subpanorama::$spn_state,array("prompt"=>"显示全部"))?>
    <?=CHtml::submitButton("搜索")?>
</form>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
