<?php
$this->breadcrumbs=array(
	'会员管理'=>array('index'),
    '经纪人管理',
	$model->uc_uid,
);
$this->currentMenu = 43;
$this->menu=array(
	array('label'=>'查看列表', 'url'=>array('index')),
	array('label'=>'删除用户', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uc_id),'confirm'=>'确定要删除此用户吗?')),
    array('label'=>'赠送积分和商务币', 'url'=>array('/user/givemp',"userid"=>$model->uc_uid)),
    array('label'=>'用户升级', 'url'=>array('user/upgrade', 'id'=>$model->uc_uid)),
    );
?>
<h1>查看 <?=$model->uc_uid?> 基本信息</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uc_id',
		'uc_uid',
        array(
            'name'=>'uc_province',
            'value'=>Region::model()->getNameById($model->uc_province)
        ),
        array(
            'name'=>'uc_city',
            'value'=>Region::model()->getNameById($model->uc_city)
        ),
        array(
            'name'=>'uc_district',
            'value'=>Region::model()->getNameById($model->uc_district)
        ),
        array(
            'name'=>'uc_section',
            'value'=>Region::model()->getNameById($model->uc_section)
        ),
		'uc_address',
        'uc_fullname',
        'uc_officetel',
        'uc_contact',
        'uc_tel',
        'uc_msn',
        'uc_email',
         array(
            'name'=>'uc_recogniseurl',
            'type'=>'raw',
            'value'=>$model->uc_recogniseurl!=""?CHtml::link(CHtml::image(PIC_URL.$model->uc_recogniseurl,'',array("width"=>"100px",'height'=>"100px")),PIC_URL.$model->uc_recogniseurl,array("target"=>"_blank")):"未设置"
        ),
        array(
            "name"=>"uc_recogniseaudit",
            'type'=>'raw',
            'value'=>Ucom::model()->getTextByState($model->uc_recogniseaudit),
        ),
        array(
            "name"=>"uc_recognisetime",
            'value'=>date("Y-m-d H:i",$model->uc_recognisetime),
        ),
        'uc_recognisecode',
        array(
            'name'=>'uc_logo',
            'type'=>'raw',
            'value'=>CHtml::image(User::model()->getUserHeadPic($model->uc_uid),"",array("width"=>"100px","height"=>"100px")),
        ),
        array(
            "name"=>"uc_check",
            'type'=>'raw',
            'value'=>Ucom::model()->getTextByState($model->uc_check),
        ),
        'uc_post',
		)
)); ?>
