<?php
$this->breadcrumbs=array(
	'住宅房源基本信息'=>array('index'),
	'管理',
);
$this->currentMenu = 79;
$this->menu=array(
	array('label'=>'浏览所有数据', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('residencebaseinfo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理住宅房源</h1>

<form action="/residencebaseinfo/admin" method="post" id="search-form">
    <table width="100%" border="0">
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;ID：
                <?php echo CHtml::textField('rbi_id',isset($show['rbi_id'])?$show['rbi_id']:"",array('size'=>5,'maxlength'=>50)); ?>
            </td>
            <td>
                标题：
                <?php echo CHtml::textField('rbi_title',isset($show['rbi_title'])?$show['rbi_title']:"",array('size'=>15,'maxlength'=>50)); ?>
            </td>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td>
            </td>

            <td>
                状态：
                <?php echo CHtml::dropDownList('rt_check',isset($show['rt_check'])?$show['rt_check']:"0",Residencetag::$rt_check,array("empty"=>"---不限---")); ?>
            </td>
            <td>
                阅读：
                <?php echo CHtml::dropDownList('rt_read',isset($show['rt_read'])?$show['rt_read']:"",Residencetag::$rt_read,array("empty"=>"---不限---")); ?>
            </td>
            <td><?php echo CHtml::submitButton('搜索'); ?></td>
        </tr>
    </table>
</form>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'residencebaseinfo-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		array(
            'header'=>"id",
            "value"=>'$data->rbi_id',
        ),
        array(
            'header'=>"小区名称",
            "value"=>'$data->xiaoqu->comy_name',
        ),
        array(
            'header'=>"住宅标题",
            "value"=>'common::strCut($data->rbi_title,30)',
        ),
        array(
            'header'=>"状态",
            "value"=>'$data->tag->rt_check',
        ),
        array(
            'name'=>"发布时间",
            "value"=>'date("Y-m-d H:i",$data->rbi_releasedate)',
        ),
		array(
			'class'=>'CButtonColumn',
            "template"=>"{view}&nbsp;&nbsp;&nbsp;&nbsp;{delete}"
		),
	),
)); ?>
