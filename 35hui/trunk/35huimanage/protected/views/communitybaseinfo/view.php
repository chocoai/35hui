<?php
$this->currentMenu = 77;
$this->breadcrumbs=array(
	'小区管理'=>array('index'),
	$model->comy_name,
);
$si_id= Siteindex::getData($model->comy_id,3);
$showLabel = '设置首页显示';
$showUrl = array('siteindex/create',"id"=>$model->comy_id,'type'=>3);
if($si_id){
    $showLabel = '取消首页显示';
    $showUrl = array('siteindex/delete',"id"=>$si_id);
}
$this->menu=array(
	array('label'=>'新增小区', 'url'=>array('create')),
	array('label'=>'编辑小区', 'url'=>array('update', 'id'=>$model->comy_id)),
	array('label'=>'删除小区', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->comy_id),'confirm'=>'确定删除此小区吗?')),
    array('label'=>'查看所有小区', 'url'=>array('index')),
    array('label'=>'管理所有小区', 'url'=>array('admin')),
    array('label'=>'管理小区图片','url'=>array('picture/sourceView','sId'=>$model->comy_id,'sType'=>7)),
    array("label"=>"管理小区全景","url"=>array("panorama/buildingView","id"=>$model->comy_id,"p_ptype"=>2)),
    array('label'=>'管理印象', 'url'=>array('impression',"id"=>$model->comy_id)),
    array('label'=>'管理评论', 'url'=>array('comment',"id"=>$model->comy_id)),
    array('label'=>'管理评分', 'url'=>array('rating',"id"=>$model->comy_id)),
    array('label'=>$showLabel, 'url'=>$showUrl),
);
if( $model->comy_loushu == 0 )
      $this->menu[]=  array('label'=>'上传楼书', 'url'=>array('attachment/create',"id"=>$model->comy_id,'type'=>2,'atttype'=>1));
if( $model->comy_hetong == 0 )
      $this->menu[]=  array('label'=>'上传合同', 'url'=>array('attachment/create',"id"=>$model->comy_id,'type'=>2,'atttype'=>2));
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
<h1>查看 <?=CHtml::encode($model->comy_name)?> 小区基本信息 ID为 #<?php echo $model->comy_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'comy_id',
		'comy_name',
        array(
            'name'=>'comy_province',
            'value'=>Region::model()->getNameById($model->comy_province)
        ),
        array(
            'name'=>'comy_city',
            'value'=>Region::model()->getNameById($model->comy_city)
        ),
        array(
            'name'=>'comy_district',
            'value'=>Region::model()->getNameById($model->comy_district)
        ),
        array(
            'name'=>'comy_section',
            'value'=>Region::model()->getNameById($model->comy_section)
        ),
		'comy_address',
        array(
            'name'=>'comy_propertyname',
            'value'=>$model->comy_propertyname?$model->comy_propertyname:"暂无资料"
        ),
        array(
            'name'=>'comy_propertytel',
            'value'=>$model->comy_propertytel?$model->comy_propertytel:"暂无资料"
        ),
		'comy_developer',
		'comy_propertytype',
		'comy_buildingarea',
        'comy_introduce',
        'comy_cubagerate',
        'comy_parking',
        array(
            "name"=>"comy_avgsellprice",
            "value"=>$model->comy_avgsellprice?$model->comy_avgsellprice."元/平米":'暂无',
        ),
		'comy_x',
		'comy_y',
        array(
            'name'=>'comy_inserttime',
            'value'=>showFormatDateTime($model->comy_inserttime)
        ),
	),
    'htmlOptions'=>array('class'=>'detail-view','style'=>'table-layout: fixed;'),
)); ?>
标题图片:
<?=$titlePic?CHtml::image(PIC_URL.Picture::showStandPic($titlePic->p_img,"_normal"),"",array("width"=>"300px")):""?>