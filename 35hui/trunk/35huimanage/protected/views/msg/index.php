<?php
$this->breadcrumbs=array(
	'站内信管理',
);

$this->menu=array(
	array('label'=>'管理站内信', 'url'=>array('admin')),
	array('label'=>'选择用户发送站内信', 'url'=>array('user/index')),
);
?>
<?php if(Yii::app()->user->hasFlash('sendState')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('sendState'); ?>
    </div>
<?php endif; ?>
<h1>站内信列表</h1>
<?
 $type=isset($_GET["type"])?$_GET["type"]:"1";
echo CHtml::dropDownList('od',$type,
        array("all"=>'所有',"manage"=>'管理员信箱'),
        array('onchange'=>'search()'));
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<script>
function search(){
    window.location.href="<?=Yii::app()->createUrl('msg/index',array("m"=>"51",'type'=>""));?>/"+$("#od").val();
}
</script>