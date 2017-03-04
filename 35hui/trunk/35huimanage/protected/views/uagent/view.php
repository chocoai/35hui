<?php
$this->breadcrumbs=array(
	'会员管理'=>array('index'),
    '经纪人管理',
	$model->ua_uid,
);
$this->currentMenu = 39;
$this->menu=array(
	array('label'=>'浏览所有数据', 'url'=>array('index')),
    array('label'=>'删除经纪人', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ua_id),'confirm'=>'确定删除此经纪人吗?')),
    array('label'=>'赠送积分和商务币', 'url'=>array('/user/givemp',"userid"=>$model->ua_uid)),
    array('label'=>'添加跟进记录', 'url'=>array('followrecord/create', 'userid'=>$model->ua_uid)),
    array('label'=>'添加面谈记录', 'url'=>array('meetrecord/create', 'id'=>0,'userid'=>$model->ua_uid)),
    array('label'=>'添加购买记录', 'url'=>array('buyrecord/create', 'id'=>0,'userid'=>$model->ua_uid)),
    array('label'=>'跟进记录列表', 'url'=>array('followrecord/index', 'userid'=>$model->ua_uid)),
    array('label'=>'面谈记录列表', 'url'=>array('meetrecord/index', 'userid'=>$model->ua_uid)),
    array('label'=>'购买记录列表', 'url'=>array('buyrecord/index', 'userid'=>$model->ua_uid)),
    array('label'=>'用户升级', 'url'=>array('uagent/buycombo', 'id'=>$model->ua_id)),
    );
$userModel = User::model()->findByPk($model->ua_uid);
if(empty($userModel))
    $userModel = new User();
?>

<h1>查看 <?=$model->ua_realname?> 基本信息</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ua_id',
		'ua_uid',
        array(
            'name'=>'ua_province',
            'value'=>Region::model()->getNameById($model->ua_province)
        ),
        array(
            'name'=>'ua_city',
            'value'=>Region::model()->getNameById($model->ua_city)
        ),
        array(
            'name'=>'ua_district',
            'value'=>Region::model()->getNameById($model->ua_district)
        ),
        array(
            'name'=>'ua_section',
            'value'=>Region::model()->getNameById($model->ua_section)
        ),
		'ua_realname',
        'ua_msn',
        'ua_comid',
        'ua_company',
        array(
            'name'=>'电话号码',
            'type'=>'raw',
         'value'=>$userModel->user_tel,
        ),
        array(
            'name'=>'从业年限',
            'value'=>date('Y')-$model->ua_congyeyear.'年',
            'type'=>'raw',
        ),
         array(
            'name'=>'ua_photourl',
            'value'=>CHtml::image(User::model()->getUserHeadPic($model->ua_uid),"",array("width"=>"100px","height"=>"130px")),
            'type'=>'raw',
        ),
        array(
            'name'=>'ua_scardurl',
            'type'=>'raw',
            'value'=>$model->ua_scardurl!=""?CHtml::link(CHtml::image(PIC_URL.$model->ua_scardurl,'',array("width"=>"100px",'height'=>"100px")),PIC_URL.$model->ua_scardurl,array("target"=>"_blank")):"未设置"
        ),
        array(
            "name"=>"ua_scardaudit",
            'type'=>'raw',
            'value'=>Uagent::model()->getTextByState($model->ua_scardaudit),
        ),
        array(
            "name"=>"ua_scardtime",
            'value'=>date("Y-m-d H:i",$model->ua_scardtime),
        ),
        array(
            'name'=>'ua_bcardurl',
            'type'=>'raw',
            'value'=>$model->ua_bcardurl!=""?CHtml::link(CHtml::image(PIC_URL.$model->ua_bcardurl,'',array("width"=>"100px",'height'=>"100px")),PIC_URL.$model->ua_bcardurl,array("target"=>"_blank")):"未设置"
        ),
        array(
            "name"=>"ua_bcardaudit",
            'type'=>'raw',
            'value'=>Uagent::model()->getTextByState($model->ua_bcardaudit),
        ),
        array(
            "name"=>"ua_bcardtime",
            'value'=>date("Y-m-d H:i",$model->ua_bcardtime),
        ),
//        array(
//            'name'=>'ua_licenseurl',
//            'type'=>'raw',
//            'value'=>$model->ua_licenseurl!=""?CHtml::link(CHtml::image(PIC_URL.$model->ua_licenseurl,'',array("width"=>"100px",'height'=>"100px")),PIC_URL.$model->ua_licenseurl,array("target"=>"_blank")):"未设置"
//        ),
        array(
            "name"=>"ua_licenseaudit",
            'type'=>'raw',
            'value'=>Uagent::model()->getTextByState($model->ua_licenseaudit),
        ),
        array(
            "name"=>"ua_licensetime",
            'value'=>date("Y-m-d H:i",$model->ua_licensetime),
        ),
        'ua_scardid',
        array(
            "name"=>"ua_check",
            'type'=>'raw',
            'value'=>Uagent::model()->getTextByState($model->ua_check),
        ),
        'ua_level',
        'ua_post',
        'ua_introduce'
		)
)); ?>
