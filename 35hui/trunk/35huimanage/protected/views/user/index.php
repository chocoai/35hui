<?php
$this->breadcrumbs=array(
	'所有会员',
);
//
//$this->menu=array(
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
//);
?>
<style type="text/css">
.sendMail{
    position: absolute;
    margin-left:600px;
    margin-top:50px;
    width: 80px;
    height: 20px;
    line-height: 20px;
}
</style>
<h1>所有会员</h1>
<form method="POST" action="">
    <?=CHtml::dropDownList("user_role",$user_role?$user_role:2,User::$roleDescription)?>
    用户姓名：<?=CHtml::textField("user_name",$user_name)?>
    <?=CHtml::submitButton("搜索")?>
</form>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
