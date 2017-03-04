<?php
$this->currentMenu = 77;
$this->breadcrumbs=array(
	'小区管理'=>array('index'),
	'管理小区',
);

$this->menu=array(
	array('label'=>'查看所有小区', 'url'=>array('index')),
	array('label'=>'新建小区', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('communitybaseinfo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理小区信息</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<form action="/communitybaseinfo/admin" method="post" id="search-form">
        <table width="100%" border="1">
        <tr>
            <td>
                ID：
                <?php echo CHtml::textField('comy_id',isset($show['comy_id'])?$show['comy_id']:"",array('size'=>10,'maxlength'=>50)); ?>
            </td>
           <td>
                名称：
               <?php echo CHtml::textField('comy_name',isset($show['comy_name'])?$show['comy_name']:"",array('size'=>10,'maxlength'=>50)); ?>
            </td>
            <td>
                所属城市：
               <?php echo CHtml::textField('comy_city',isset($show['comy_city'])?$show['comy_city']:"",array('size'=>10,'maxlength'=>50)); ?>
            </td>
           <td>
                所属行政区：
                <?php echo CHtml::textField('comy_district',isset($show['comy_district'])?$show['comy_district']:"",array('size'=>10,'maxlength'=>50)); ?>
            </td>
             <td>
                所属版块：
               <?php echo CHtml::textField('comy_section',isset($show['comy_section'])?$show['comy_section']:"",array('size'=>10,'maxlength'=>50)); ?>
            </td>
            <td><?php echo CHtml::submitButton('搜索'); ?></td>
        </tr>
    </table>
</form>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'communitybaseinfo-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		'comy_id',
		'comy_name',
        array(
          'name'=>'comy_city',
          'value'=>'Region::model()->getNameById($data->comy_city)."(".$data->comy_city.")"'
        ),
		array(
          'name'=>'comy_district',
          'value'=>'Region::model()->getNameById($data->comy_district)."(".$data->comy_district.")"'
        ),
		array(
          'name'=>'comy_section',
          'value'=>'Region::model()->getNameById($data->comy_section)."(".$data->comy_section.")"'
        ),
        /*
		'comy_developer',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
 $('div .pager >ul').find('li >a').each(function(){
    var href=$(this).attr('href');
    $(this).attr('href',"###");
    $(this).bind('click',function(){pagePost(href);});
});
}
);

function pagePost(href){
    $('#search-form').attr('action',href);
    $('#search-form').submit();
}

</script>