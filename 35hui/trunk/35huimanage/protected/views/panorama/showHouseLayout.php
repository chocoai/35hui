<?php
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
    $sourceInformation['parent']['title']=>$sourceInformation['parent']['link'],
	$sourceInformation['current']['title']=>$sourceInformation['current']['link'],
    '查看所有房型图'
);
$this->menu=array(
	array('label'=>'新建户型绑定数据', 'url'=>array('bindingLayout','sId'=>$sId,'sType'=>$sType)),
);
?>
<style type="text/css">
.picshow img {
    height:75px;
    width: 100px;
}
</style>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'picture-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'ht_id',
        'ht_description',
        array(
            'name' => '户型图',
            'value'=> 'PIC_URL.$data->picture["p_tinyimg"]',
            'type' => 'image',
            'htmlOptions'=>array("class"=>"picshow")
        ),
        array(
            'name' => '全景图',
            'value'=> '$data->panorama["p_url"]==""?"尚未绑定全景":"<a target=\"_blank\" href=\"".PIC_URL.$data->panorama["p_url"]."/index.swf\">查看全景</a>"',
            'type' => 'html',
            'htmlOptions'=>array('class'=>'url','style'=>'cursor:pointer'),
        ),
		array(
			'class'=>'CButtonColumn',
            'buttons' =>array(
                'bangding'=>array(
                    'label'=>'绑定',
                    'url'=>'Yii::app()->createUrl("panorama/bindingLayout",array("id"=>$data->ht_id,"sId"=>$data->ht_sourceid,"sType"=>$data->ht_sourcetype))',
                )
            ),
            'template'=>'{bangding}'
        ),
	)
)); ?>
<script type="text/javascript">
$(".url a").live("click",function(){
    var url = $(this).attr("href");
    window.open(url, "全景查看");
    return false;
});
</script>