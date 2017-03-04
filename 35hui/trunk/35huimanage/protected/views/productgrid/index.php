<?php
$this->breadcrumbs=array(
	'推荐精选商务币设置',
);
?>

<h1>推荐精选商务币设置</h1>
<form action="" method="post">
    <table width="100%" border="1">
        <tr>
            <td width="20%"><?=CHtml::dropDownList("p_page",$p_page,Productgrid::$p_page,array("empty"=>"请选择"))?></td>
            <td width="20%"><?=CHtml::dropDownList("p_position",$p_position,Productgrid::$p_position,array("empty"=>"请选择"))?></td>
            <td><?=CHtml::submitButton("搜索")?></td>
        </tr>
    </table>
</form>
<table width="100%">
    <tr>
        <th width="15%">页面</th>
        <th width="15%">模块</th>
        <th width="10%">位置</th>
        <th width="10%">基本价</th>
        <th width="10%">当前价</th>
        <th width="7%">涨幅</th>
        <th width="7%">跌幅</th>
        <th width="13%">最后购买</th>
        <th></th>
    </tr>
</table>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
