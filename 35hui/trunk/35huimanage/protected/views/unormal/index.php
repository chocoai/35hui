<?php
$this->breadcrumbs=array(
	'个人用户列表',
);
$this->currentMenu = 9;
?>
<?php if(Yii::app()->user->hasFlash('deleteResult')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('deleteResult'); ?>
    </div>
<?php endif; ?>

<h1>个人用户列表</h1>
<form action="" method="post" name="form">
    个人登录名：<input type="text" name="loginName" value="<?=isset($loginName)?$loginName:""?>" />
    <input type="submit" name="search" value="搜索" />
</form>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
