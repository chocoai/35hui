<?php
$this->currentMenu = 100;
$this->breadcrumbs=array(
	'联系人管理'=>array('index'),
	$id?'编辑':'新建',
);

$this->menu=array(
	array('label'=>'查看所有联系人', 'url'=>array('index')),
	array('label'=>'管理联系人', 'url'=>array('admin')),
);
?>

<h1>联系人是否注册</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contactrecord-form',
	'enableAjaxValidation'=>false,
)); ?>
    <label>是否注册：</label>
    <?=CHtml::radioButtonList("isregister","0",array("0"=>"未注册","1"=>"已注册"),array("separator"=>"&nbsp;","style"=>"display:inline","labelOptions"=>array("style"=>"display:inline;font-weight:normal")));?>
    <?php echo $form->hiddenField($model,'id',array('value'=>$id));?>
    <div class="row buttons">
		<?php echo CHtml::submitButton('确定'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>