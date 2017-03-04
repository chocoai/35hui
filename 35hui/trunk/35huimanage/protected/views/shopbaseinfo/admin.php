<?php
$this->breadcrumbs=array(
	'商铺管理'=>array('index'),
	'Manage',
);
$this->currentMenu = 24;
$this->menu=array(
	array('label'=>'商铺列表', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('shopbaseinfo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>商铺管理</h1>

<form action="/shopbaseinfo/admin" method="post" id="search-form">
    <table width="100%" border="1">
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;ID：
                <?php echo CHtml::textField('shopid',isset($show['shopid'])?$show['shopid']:"",array('size'=>5,'maxlength'=>50)); ?>
            </td>
            <td>
                商铺标题：
                <?php echo CHtml::textField('sp_shoptitle',isset($show['sp_shoptitle'])?$show['sp_shoptitle']:"",array('size'=>15,'maxlength'=>50)); ?>
            </td>
            <td>
                状态：
                <?php echo CHtml::dropDownList('check',isset($show['check'])?$show['check']:"0",Officetag::$ot_check,array("empty"=>"---不限---")); ?>
            </td>
            <td><?php echo CHtml::submitButton('搜索'); ?></td>
        </tr>
    </table>
</form>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shopbaseinfo-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'sb_shopid',
        array('header'=>'商铺标题','value'=>'common::strCut($data->presentInfo->sp_shoptitle,10)'),
        array('header'=>'状态','value'=>'Shoptag::$st_check[$data->sb_check]'),
        'sb_uid',
        array('header'=>'最近更新日期','value'=>'date("Y-m-d",$data->sb_updatedate)'),
		/*
		'sb_district',
		'sb_section',
		'sb_tradecircle',
		'sb_busway',
		'sb_shopaddress',
		'sb_shopfronttype',
		'sb_propertycomname',
		'sb_propertycost',
		'sb_shoparea',
		'sb_shopusablearea',
		'sb_loop',
		'sb_floor',
		'sb_allfloor',
		'sb_towards',
		'sb_cancut',
		'sb_adrondegree',
		'sb_recommendtrade',
		'sb_buildingage',
		'sb_sellorrent',
		'sb_releasedate',
		'sb_updatedate',
		'sb_expiredate',
		'sb_tag',
		*/
		array(
			'class'=>'CButtonColumn',
            "template"=>"{view}"
		),
	),
)); ?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
 $('div .pager >ul').find('li >a').each(function(){
    var href=$(this).attr('href');
    $(this).attr('href','###');
    $(this).bind('click',function(){pagePost(href);});
});
}
);
function pagePost(href){
    $('#search-form').attr('action',href);
    $('#search-form')[0].submit();
}

</script>