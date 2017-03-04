<?php
$this->breadcrumbs=array(
	'写字楼房源基本信息'=>array('index'),
	$model->rbi_title,
);
$this->currentMenu = 79;
$this->menu=array(
	array('label'=>'浏览所有数据', 'url'=>array('index')),
    array('label'=>'管理图片','url'=>array('picture/sourceView','sId'=>$model->rbi_id,'sType'=>Picture::$sourceType['residencebaseinfo'])),
    array('label'=>'管理全景', 'url'=>array('subpanorama/sourcepanorama',"id"=>$model->rbi_id,'type'=>4)),
    array('label'=>'删除房源', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rbi_id),'confirm'=>'你确定要删除这条数据吗?')),
);
//$model->tag->rt_ishigh==0?$this->menu[] = array('label'=>'设优', 'url'=>'javascript:showtip()',):"";//不是优质的，才能设优。
?>

<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/overlay.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/toolbox.expose.min.js"></script>
<?php if(Yii::app()->user->hasFlash('bindPanorama')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('bindPanorama'); ?>
    </div>
<?php endif; ?>
<h1>住宅房源基本信息 #<?php echo CHtml::link(CHtml::encode($model->rbi_id), MAINHOST.Yii::app()->createUrl("communitybaseinfo/viewResidence",array("id"=>$model->rbi_id)),array("target"=>"_blank"));?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rbi_id',
		array(
            'name'=>'小区名称',
            'value'=>$model->xiaoqu->comy_name,
        ),
		array(
            'name'=>'发布者',
            'value'=>$model->user->user_name,
        ),
		'rbi_rentorsell',
		'rbi_area',
		'rbi_room',
		'rbi_office',
		'rbi_bathroom',
		'rbi_floor',
		'rbi_allfloor',
		'rbi_buildingera',//Residencebaseinfo
		array(
            'name'=>'rbi_toward',
            'value'=>Residencebaseinfo::$rbi_towards[$model->rbi_toward]
        ),
        array(
            'name'=>'rbi_decoration',
            'value'=>Residencebaseinfo::$rbi_adrondegree[$model->rbi_decoration]
        ),
		'rbi_number',
		'rbi_title',
		'rbi_residencedesc',
		array(
            'name'=>'rbi_releasedate',
            'value'=>date('Y-m-d H:i',$model->rbi_releasedate)
        ),
		array(
            'name'=>'rbi_updatedate',
            'value'=>date('Y-m-d H:i',$model->rbi_updatedate)
        ),
		'rbi_titlepicurl',
		'rr_validdate',
	),
)); ?>

<div style="display:none;position: fixed;width: 300px;height: 250px;border: 1px solid #860001;padding: 5px;background-color:#EFEFEF;" id="showTip">
    <form action="/residencebaseinfo/audit" method="post" >
        <input type="hidden" name="rbi_id" value="<?=$model->rbi_id?>" />
        <div style="float:right"><img onClick="closetip('showTip')" src="<?php echo IMAGE_URL."/3.gif";?>"/></div>
        <div>
            <div id="sendpoint" style="line-height: 25px">
                请选择要赠送的积分和商务币数:<br />
                <input type="radio" name="point" value="1" checked/>1点&nbsp;
                <input type="radio" name="point" value="2" />2点&nbsp;
                <input type="radio" name="point" value="3" />3点&nbsp;
                <input type="radio" name="point" value="4" />4点&nbsp;
                <br />增加排序权重<br />
                <?php
                /*
                foreach(common::getOrderConfig('high') as $v){
                    echo '<input type="radio" name="rbi_order" value="',$v,'" />',$v,'&nbsp;';
                 }*/
                ?>
            </div>
            <input type="submit" value="确定"/>
        </div>
    </form>
</div>

<script type="text/javascript">
$("#showTip").overlay({
    top:'center',
    mask: {
		color: '#111111',
		loadSpeed: 200,
		opacity: 0.5
	},
    closeOnClick: false
});

function showtip(){
    $("#showTip").overlay().load();
    if($("#showTip").css('display')=='none'){
       $("#showTip").css('display','block');
    }
}
function closetip(id){
    $("#"+id).overlay().close();
    if($("#"+id).css('display')=='block'){
       $("#"+id).css('display','none');
    }
}
</script>
