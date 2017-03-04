<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
	'楼盘管理'=>array('index'),
	$model->sbi_buildingname,
);
$si_id= Siteindex::getData($model->sbi_buildingid,1);
$showLabel = '设置首页显示';
$showUrl = array('siteindex/create',"id"=>$model->sbi_buildingid,'type'=>1);
if($si_id){
    $showLabel = '取消首页显示';
    $showUrl = array('siteindex/delete',"id"=>$si_id);
}
$this->menu=array(
	array('label'=>'新增楼盘', 'url'=>array('create')),
	array('label'=>'编辑楼盘', 'url'=>array('update', 'id'=>$model->sbi_buildingid)),
	array('label'=>'删除楼盘', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sbi_buildingid),'confirm'=>'确定删除此楼盘吗?')),
    array('label'=>'查看所有楼盘', 'url'=>array('index')),
    array('label'=>'管理所有楼盘', 'url'=>array('admin')),
    array('label'=>'管理楼盘图片','url'=>array('picture/sourceView','sId'=>$model->sbi_buildingid,'sType'=>Picture::$sourceType['systembuilding'])),
    array("label"=>"管理楼盘全景","url"=>array("panorama/buildingView","id"=>$model->sbi_buildingid)),
    array('label'=>'管理印象', 'url'=>array('impression',"id"=>$model->sbi_buildingid)),
    array('label'=>'过滤房源', 'url'=>array('filtersource',"id"=>$model->sbi_buildingid)),
    array('label'=>$showLabel, 'url'=>$showUrl),
);
if( $model->sbi_loushu == 0 )
      $this->menu[]=  array('label'=>'上传楼书', 'url'=>array('attachment/create',"id"=>$model->sbi_buildingid,'type'=>1,'atttype'=>1));
if( $model->sbi_hetong == 0 )
      $this->menu[]=  array('label'=>'上传合同', 'url'=>array('attachment/create',"id"=>$model->sbi_buildingid,'type'=>1,'atttype'=>2));
?>
<?php if(Yii::app()->user->hasFlash('bindPanorama')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('bindPanorama'); ?>
    </div>
<?php endif; ?>
<style type="css/text">
.wordBreak{
    word-wrap: break-word;
}
</style>
<h1>查看 <?=CHtml::encode($model->sbi_buildingname)?> 楼盘基本信息 ID为 #<?php echo $model->sbi_buildingid; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sbi_buildingid',
		'sbi_buildingname',
		'sbi_pinyinshortname',
		'sbi_pinyinlongname',
        'sbi_buildingenglishname',
        array(
            "name"=>"sbi_defanglv",
            "value"=>$model->sbi_defanglv."%"
        ),
		array(
            'name'=>'sbi_buildtype',
            'value'=>Systembuildinginfo::$sbi_buildtype[$model->sbi_buildtype]
        ),
		array(
            'name'=>'sbi_province',
            'value'=>Region::model()->getNameById($model->sbi_province)
        ),
		array(
            'name'=>'sbi_city',
            'value'=>Region::model()->getNameById($model->sbi_city)
        ),
        array(
            'name'=>'sbi_district',
            'value'=>Region::model()->getNameById($model->sbi_district)
        ),
		array(
            'name'=>'sbi_section',
            'value'=>Region::model()->getNameById($model->sbi_section)
        ),
		array(
            'name'=>'sbi_loop',
            'value'=>Searchcondition::model()->getLoopName($model->sbi_loop)
        ),
		array(
            'name'=>'sbi_tradecircle',
            'value'=>Region::model()->getNameById($model->sbi_tradecircle)
        ),
		'sbi_busway',
		'sbi_address',
        array(
            "name"=>"sbi_foreign",
            "value"=>$model->sbi_foreign==1?"是":"否",
        ),
		array(
            'name'=>'sbi_openingtime',
            'value'=>$model->sbi_openingtime?date("Y-m-d",$model->sbi_openingtime):"暂无资料"
        ),
		array(
            'name'=>'sbi_propertyname',
            'value'=>$model->sbi_propertyname?$model->sbi_propertyname:"暂无资料"
        ),
		array(
            'name'=>'sbi_propertytel',
            'value'=>$model->sbi_propertytel?$model->sbi_propertytel:"暂无资料"
        ),
		'sbi_developer',
		array(
            "name"=>"sbi_propertyprice",
            "value"=>$model->sbi_propertyprice?$model->sbi_propertyprice."元/平米•月":'暂无',
        ),
        array(
            "name"=>"sbi_propertydegree",
            "value"=>@Systembuildinginfo::$propertyDegree[$model->sbi_propertydegree]
        ),
        array(
            "name"=>"sbi_buildingarea",
            "value"=>$model->sbi_buildingarea."平米",
        ),
        array(
            "name"=>"sbi_floorarea",
            "value"=>$model->sbi_floorarea."平米",
        ),
        array(
            "name"=>"sbi_floor",
            "value"=>$model->sbi_floor."层",
        ),
		'sbi_buildingintroduce',
		array(
            "name"=>"sbi_avgrentprice",
            "value"=>$model->sbi_avgrentprice?$model->sbi_avgrentprice."元/平米•天":'暂无',
        ),
		array(
            "name"=>"sbi_avgsellprice",
            "value"=>$model->sbi_avgsellprice?$model->sbi_avgsellprice."元/平米":'暂无',
        ),
        array(
            "name"=>"sbi_isnew",
            "value"=>$model->sbi_isnew==1?"是":"否",
        ),
		'sbi_x',
		'sbi_y',
		'sbi_tag',
		'sbi_loushu',
		'sbi_hetong',
		array(
            'name'=>'sbi_recordtime',
            'value'=>showFormatDateTime($model->sbi_recordtime)
        ),
        array(
            'name'=>'sbi_updatetime',
            'value'=>showFormatDateTime($model->sbi_updatetime)
        ),
		'sbi_tel',
		'sbi_visit',
		'sbi_dongnum',
		'sbi_wailimian',
        'sbi_danyuanfenge',
        array(
            'name'=>'sbi_peripheral',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_peripheral),
        ),
        array(
            'name'=>'sbi_traffic',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_traffic),
        ),
        array(
            'name'=>'sbi_datang',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_datang),
        ),
        array(
            'name'=>'sbi_zoulang',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_zoulang),
        ),
        array(
            'name'=>'sbi_floorinfo',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_floorinfo,true,array("面积","层高","净层高")),
        ),
        array(
            'name'=>'sbi_biaozhun',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_biaozhun),
        ),
        array(
            'name'=>'sbi_toiletwater',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_toiletwater,true),
        ),
        array(
            'name'=>'sbi_liftinfo',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_liftinfo),
        ),
        array(
            'name'=>'sbi_communication',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_communication,true),
        ),
        array(
            'name'=>'sbi_aircon',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_aircon,true),
        ),
        array(
            'name'=>'sbi_security',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_security,true),
        ),
        array(
            'name'=>'sbi_carport',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_carport),
        ),
        array(
            'name'=>'sbi_roommating',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_roommating,true),
        ),
        array(
            'name'=>'sbi_propertyserver',
            'type'=>'raw',
            'value'=>Systembuildinginfo::model()->getFormatSerializeValue($model->sbi_propertyserver,true,array("卫生")),
        ),
	),
    'htmlOptions'=>array('class'=>'detail-view','style'=>'table-layout: fixed;'),
)); ?>
标题图片:
<?=$titlePic?CHtml::image(PIC_URL.Picture::showStandPic($titlePic->p_img,"_normal"),"",array("width"=>"300px")):""?><br/>
<?$newbuild=Newbuild::model()->find("nb_sid=".$model->sbi_buildingid);
if($newbuild){
?>
营销手段：
<?=$newbuild->nb_yingxiao?><br/>
优势：
<?=$newbuild->nb_youshi?><br/>
特色：
<?=$newbuild->nb_characteristic?><br/>
<?}?>
