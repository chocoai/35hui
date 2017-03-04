<?php
$this->breadcrumbs=array(
	'所有购买记录'=>array('index'),
	$model->br_id,
);
if($model->contact->cr_isregistered){
    $this->menu=array(
            array('label'=>'经纪人详细页', 'url'=>array('uagent/view', 'id'=>Uagent::model()->findByAttributes(array('ua_uid'=>$model->contact->cr_userid))->ua_id)),
            array('label'=>'修改购买记录', 'url'=>array('update', 'id'=>$model->br_id)),
    );
}else{
    $this->menu=array(
            array('label'=>'所有购买记录', 'url'=>array('index')),
            array('label'=>'修改购买记录', 'url'=>array('update', 'id'=>$model->br_id)),
            array('label'=>'删除购买记录', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->br_id),'confirm'=>'确认要删除该记录?')),
            array('label'=>'管理购买记录', 'url'=>array('admin')),
    );
}
?>

<h1>查看ID为<?php echo $model->br_id; ?>的购买记录</h1>

<?php
    $taocan="";
     if($model->br_fcid){
        $taocan='RMB'.$model->config->fc_rmbprice."   商务币".$model->config->fc_giveprice."    积分".$model->config->fc_giveprice;
        if($model->config->fc_givepanoramadevice){
            $taocan.="   全景镜头".$model->config->fc_givepanoramadevice.'枚';
        }
    }else{
        $taocan=$model->br_other;
    }
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'br_id',
                array(
                'name'=>'br_mrid',
                'value'=>$model->br_mrid?$model->meet->mr_salesman:$model->br_salesman,
                ),
                array(
                'name'=>'br_fcid',
                'value'=>$taocan,
                ),
                array(
                'name'=>'br_amount',
                'value'=>$model->br_amount.'元',
                ),
		'br_contractno',
                array(
                'name'=>'br_time',
                'value'=>date("Y-m-d H:i:s",$model->br_time),
                ),
	),
)); ?>
