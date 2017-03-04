<?php
$this->breadcrumbs=array(
	'Attachments',
);
$this->currentMenu = 89;
$this->menu=array(
	//array('label'=>'Create Attachment', 'url'=>array('create')),
	//array('label'=>'Manage Attachment', 'url'=>array('admin')),
);
?>

<h1>楼盘附件</h1>
<form action="" method="get" id="search-form">
    <table width="100%" border="0">
        <tr>
            <td>
                <b>房源ID：</b><?php echo CHtml::textField('buidid',isset($_GET['buidid'])?$_GET['buidid']:"",array('size'=>12,'maxlength'=>10)); ?>
                <b>楼盘类型：</b><?php echo CHtml::dropDownList('buidtype',isset($_GET['buidtype'])?$_GET['buidtype']:'',Attachment::$buidTypeName,array("empty"=>"--不限--")); ?>
                <b>附件类型：</b><?php echo CHtml::dropDownList('atttype',isset($_GET['atttype'])?$_GET['atttype']:'',Attachment::$attTypeName,array("empty"=>"--不限--")); ?>
            </td>
            <td><?php echo CHtml::submitButton('搜索'); ?></td>
        </tr>
    </table>
</form>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
