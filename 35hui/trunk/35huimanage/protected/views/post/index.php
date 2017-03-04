<?php
$this->breadcrumbs=array(
	'公告管理',
);

$this->menu=array(
	array('label'=>'发布公告', 'url'=>array('create')),
);
?>
<h1>当前有效的公告列表</h1>
<form method="get" action="">
    <div>
        <?php echo CHtml::dropDownList("role",$role,Post::$roleDescription)?>
        <input type="submit" value="搜索" />
    </div>
</form>
<table>
    <tr>
        <th width="%5">ID</th>
        <th width="35%">标题</th>
        <th width="40%">内容</th>
        <th width="10%">角色</th>
        <th >发送时间</th>
    </tr>
</table>
<?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'summaryText'=>'共{count}条，显示{start}到{end}条',
        'summaryCssClass'=>'',
    ));
?>
