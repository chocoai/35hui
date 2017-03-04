<?php
$this->breadcrumbs=array(
	'系统权限管理'=>array('/authmanage/index'),
    '操作',
);
$this->currentMenu = 92;
?>
<h1>可供操作列表</h1>
<table>
    <tr>
        <th>操作名称（Operation）</th><th>描述</th><th>规则（Bizrule）</th><th>操作</th>
    </tr>
    <tr>
        <td colspan="2"><?=CHtml::link("创建操作",array("/authmanage/create",'authtype'=>'operation'));?></td>
        <td colspan="2"><?php echo implode(' | ', $links) ?></td>
    </tr>
<?php
foreach($qData as $d){
?>
    <tr>
        <td><?=$d['name']?></td><td><?=$d['description']?></td><td><?=$d['bizrule']?></td>
        <td><?=CHtml::link("删除","#",array('submit'=>array('delete','name'=>urlencode($d['name'])),'confirm'=>"确定删除[{$d['name']}]操作项并涉及到它的子项?"));?></td>
    </tr>
<?php
}
?>
    <tr>
        <td colspan="3"><?php echo implode(' | ', $links) ?></td>
        <td><?=CHtml::link("创建操作",array("/authmanage/create",'authtype'=>'operation'));?></td>
    </tr>
</table>
