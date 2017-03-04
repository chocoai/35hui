<?php
$this->breadcrumbs=array(
	'系统权限管理',
);
$this->currentMenu = 92;
?>
<h1>系统权限管理</h1>
<table>
    <tr>
        <th>角色名称（Role）</th><th>描述</th><th>规则</th><th>操作</th>
    </tr>
    <tr>
        <td><font color="red"><b><?php echo Yii::app()->params['systemAdministrator'];?></b></font></td>
        <td><font color="red">系统管理员拥有最高权限</font></td>
        <td></td>
        <td>权限设置 | 删除</td>
    </tr>
<?php
foreach($roles as $role){
    if($role->getName() ==Yii::app()->params['systemAdministrator']) continue;
?>
    <tr>
        <td><b><?php echo $role->getName();?></b></td>
        <td><?php echo $role->getDescription();?></td>
        <td><?php echo $role->getBizrule();?></td>
        <td><?=CHtml::link("权限设置",array("/authmanage/authorizationview",'name'=>$role->getName()));?> |
            <?=CHtml::link("删除","#",array('submit'=>array('delete','name'=>$role->getName()),'confirm'=>"确定删除[{$role->getName()}]角色？"));?></td>
    </tr>
<?php
}
?>
    <tr>
        <td><?=CHtml::link("创建角色",array("/authmanage/create",'authtype'=>'role'));?></td>
        <td></td>
        <td></td>
    </tr>
</table>

<table>
    <tr>
        <th>任务名称(TASK)</th><th>描述</th><th>规则</th><th>操作</th>
    </tr>
<?php
foreach($tasks as $task){
?>
    <tr>
        <td><b><?php echo $task->getName();?></b></td>
        <td><?php echo $task->getDescription();?></td>
        <td><?php echo $task->getBizrule();?></td>
        <td><?=CHtml::link("权限设置",array("/authmanage/authorizationview",'name'=>$task->getName()));?> |
            <?=CHtml::link("删除","#",array('submit'=>array('delete','name'=>$task->getName()),'confirm'=>"确定删除[{$task->getName()}]任务及其所有的子项？"));?>
        </td>
    </tr>

<?php
}
?>
    <tr>
        <td><?=CHtml::link("创建任务",array("/authmanage/create",'authtype'=>'task'));?></td>
        <td><?=CHtml::link("创建操作",array("/authmanage/create",'authtype'=>'operation'));?></td>
        <td></td>
    </tr>
</table>
<table>
    <tr>
        <th>选项名称(OPERATION)</th><th>描述</th><th>操作</th>
    </tr>
    <tr>
        <td><?=CHtml::link("查看所有操作",array("/authmanage/operation"));?></td>
        <td><?=CHtml::link("创建操作",array("/authmanage/create",'authtype'=>'operation'));?></td>
        <td></td>
    </tr>
</table>
