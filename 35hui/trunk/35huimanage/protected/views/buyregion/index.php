<?php
$this->breadcrumbs=array(
	'Buyregions',
);

$this->menu=array(
	array('label'=>'添加新纪录', 'url'=>array('create')),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>版块精选</h1>
<form action="" method="post">
    <div class="row">
        <?=CHtml::dropDownList("status",@$_POST["status"],array("0"=>"全部","1"=>"未过期","2"=>"过期未下线","3"=>"已下线"));?>
        <input type="submit" value="搜索"/>
    </div>
</form>
<table width="100%" style="margin:0px;padding:0px">
    <tr>
        <th width="15px"> </th>
        <th>公司名称</th>
        <th width="100px">购买区域</th>
        <th width="60px">位置</th>
        <th width="50px">类型</th>
        <th width="70px">购买日期</th>
        <th width="50px">有效期</th>
        <th width="40px">状态</th>
    </tr>
</table>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
