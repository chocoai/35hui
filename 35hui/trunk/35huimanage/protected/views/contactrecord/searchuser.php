<?php
$this->currentMenu = 100;
$this->breadcrumbs=array(
	'联系人管理'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'查看所有联系人', 'url'=>array('index')),
	array('label'=>'管理联系人', 'url'=>array('admin')),
);
?>

<h1>确定注册的用户</h1>

<form action="" method="post" id="search-fomr">
	<div class="row">
                角色：<?php echo CHtml::dropDownList('role',$role,array(2=>'经纪人',3=>'门店')); ?>
		姓名：<?php echo CHtml::textField('user_name',$name,array('size'=>25,'maxlength'=>25)); ?>
                <input type="submit" value="搜索" onclici="$('#search-fomr').submit();"/>
	</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_searchuser',
)); ?>

</form>

