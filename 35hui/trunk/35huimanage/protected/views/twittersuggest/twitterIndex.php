<?php
if($type==1){
    $managerIndex =array('buildIndex');
    $showName = '查看所有楼盘微博信息';
    $buildName='sbi_buildingname';
    $itemView = '_sourceView';
}else{
    $managerIndex =array('communityIndex');
    $showName = '查看所有小区微博信息';
    $buildName='comy_name';
    $itemView = '_sourceViewC';
}
$this->breadcrumbs=array(
	'微博管理'=>$managerIndex,
    $showName
);
$this->currentMenu = 49;
?>
<h1>查看提供的微博播报信息</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'id'=>'search-from'
)); ?>
	<div class="row">
		<?php echo $form->label($model,$buildName); ?>
		<?php echo $form->textField($model,$buildName,array('size'=>50,'maxlength'=>50)); ?>
	</div>
<div class="row"><input type="submit" value="搜索" onclici="$('#search-fomr').submit();"/></div>
<?php $this->endWidget(); ?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>$itemView,
)); ?>
