<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
	'楼盘管理'=>array('index'),
	'管理楼盘',
);

$this->menu=array(
	array('label'=>'查看所有楼盘', 'url'=>array('index')),
	array('label'=>'新建楼盘', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('systembuildinginfo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理楼盘信息</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<form action="/systembuildinginfo/admin" method="post" id="search-form">
        <table width="100%" border="1">
        <tr>
            <td>
                ID：
                <?php echo CHtml::textField('sbi_buildingid',isset($show['sbi_buildingid'])?$show['sbi_buildingid']:"",array('size'=>10,'maxlength'=>50)); ?>
            </td>
           <td>
                名称：
               <?php echo CHtml::textField('sbi_buildingname',isset($show['sbi_buildingname'])?$show['sbi_buildingname']:"",array('size'=>10,'maxlength'=>50)); ?>
            </td>
            <td>
                类型：
                <?php echo CHtml::dropDownList('sbi_buildtype',isset($show['sbi_buildtype'])?$show['sbi_buildtype']:"0",array(1=>'楼盘',2=>'商业广场'),array("empty"=>"---不限---")); ?>
            </td>
            <!--<td>
                所属城市：
               <?php echo CHtml::textField('sbi_city',isset($show['sbi_city'])?$show['sbi_city']:"",array('size'=>10,'maxlength'=>50)); ?>
            </td>-->
           <td>
                所属行政区：
                <?php
                echo CHtml::dropDownList("sbi_district",isset($show['sbi_district'])?$show['sbi_district']:"",Region::model()->getFormatChildrenData(35),array("empty"=>"---请选择---"));
                $section = array();
                if(isset($show['sbi_district'])?$show['sbi_district']:""){
                    $section = Region::model()->getFormatChildrenData(isset($show['sbi_district'])?$show['sbi_district']:"");
                }
            ?>
            </td>
             <td>
                所属版块：
                <?php
                echo "&nbsp;&nbsp;".CHtml::dropDownList("sbi_section",isset($show['sbi_section'])?$show['sbi_section']:"",$section,array("empty"=>"---请选择---"));
            ?>
            </td>
              <td>
                临近轨道：
               <?php echo CHtml::textField('sbi_busway',isset($show['sbi_busway'])?$show['sbi_busway']:"",array('size'=>10,'maxlength'=>50)); ?>
            </td>
            <td><?php echo CHtml::submitButton('搜索'); ?></td>
        </tr>
    </table>
</form>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'systembuildinginfo-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		'sbi_buildingid',
		'sbi_buildingname',
        array(
            'name'=>'sbi_buildtype',
            'value'=>'@Systembuildinginfo::$sbi_buildtype[$data->sbi_buildtype]'
        ),
        array(
          'name'=>'sbi_city',
          'value'=>'Region::model()->getNameById($data->sbi_city)."(".$data->sbi_city.")"'
        ),
		array(
          'name'=>'sbi_district',
          'value'=>'Region::model()->getNameById($data->sbi_district)."(".$data->sbi_district.")"'
        ),
		array(
          'name'=>'sbi_section',
          'value'=>'Region::model()->getNameById($data->sbi_section)."(".$data->sbi_section.")"'
        ),
        'sbi_busway',
        /*
		'sbi_propertyname',
		'sbi_developer',
		'sbi_berthnum',
		'sbi_rentberth',
		'sbi_propertyprice',
		'sbi_propertydegree',
		'sbi_elevatornum',
		'sbi_fireelevatornum',
		'sbi_buildingarea',
		'sbi_floorarea',
		'sbi_floor',
		'sbi_floordownground',
		'sbi_floorupground',
		'sbi_roomnum',
		'sbi_buildingintroduce',
		'sbi_peripheral',
		'sbi_traffic',
		'sbi_decoration',
		'sbi_floorinformation',
		'sbi_parkinginformation',
		'sbi_otherinformation',
		'sbi_titlepic',
		'sbi_avgrentprice',
		'sbi_avgsellprice',
		'sbi_isnew',
		'sbi_x',
		'sbi_y',
		'sbi_tag',
		'sbi_recordtime',
		'sbi_updatetime',
		'sbi_tel',
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
$("#sbi_district").change(
    function(){
        changeNext(this);
    }
);
function changeNext(obj){
    var parentid = $(obj).val();
    var html = "<option value=''>---请选择---</option>";
    if(parentid==0){
        $("#sbi_section").html(html);//删除后面所有的选择。
    }else{
        $.ajax({
           url: "<?php echo Yii::app()->createUrl("/region/getlistbyparentid") ?>",
           type: "GET",
           data: "parentid="+parentid,
           async: false,
           success: function(msg){
               var msg = eval("("+msg+")");
               $(obj).nextAll("select").html(html);//删除后面所有的选择。
               for(var i=0;i<msg.length;i++){
                   html += "<option value='"+msg[i]['re_id']+"'>"+msg[i]['re_name']+"</option>";
               }
               $("#sbi_section").html(html);
           }
        });
    }
}

function pagePost(href){
    $('#search-form').attr('action',href);
    $('#search-form').submit();
}

</script>