<?php
$this->currentMenu = 100;
$this->breadcrumbs=array(
	'所有联系人'=>array('index'),
	$model->cr_realname,
);
$this->menu=array(
	array('label'=>'添加跟进记录', 'url'=>array('followrecord/create', 'id'=>$model->cr_id)),
	array('label'=>'新增联系人', 'url'=>array('isregister')),
	array('label'=>'编辑联系人信息', 'url'=>array('isregister', 'id'=>$model->cr_id)),
	array('label'=>'删除联系人', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cr_id),'confirm'=>'确定删除此联系人吗?')),
        array('label'=>'跟进记录列表', 'url'=>array('follow', 'id'=>$model->cr_id)),
        array('label'=>'面谈记录列表', 'url'=>array('meet', 'id'=>$model->cr_id)),
        array('label'=>'购买记录列表', 'url'=>array('buy', 'id'=>$model->cr_id)),
    array('label'=>'查看所有联系人', 'url'=>array('index')),
    array('label'=>'管理所有联系人', 'url'=>array('admin')),
);
?>
<style type="css/text">
.wordBreak{
    word-wrap: break-word;
}
</style>
<h1>查看 <?=CHtml::encode($model->cr_realname)?> 基本信息 ID为 #<?php echo $model->cr_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cr_id',
		'cr_realname',
                'cr_company',
        array(
            'name'=>'cr_mainbusiness',
            'value'=>Contactrecord::model()->getMainBussinessName($model->cr_mainbusiness)
        ),
        array(
            'name'=>'cr_province',
            'value'=>Region::model()->getNameById($model->cr_province)
        ),
        array(
            'name'=>'cr_city',
            'value'=>Region::model()->getNameById($model->cr_city)
        ),
        array(
            'name'=>'cr_district',
            'value'=>Region::model()->getNameById($model->cr_district)
        ),
        array(
            'name'=>'cr_section',
            'value'=>Region::model()->getNameById($model->cr_section)
        ),
             'cr_mobile',
             'cr_tel',
             'cr_email',
             'cr_qq',
        array(
            'name'=>'cr_isregistered',
            'value'=>$model->cr_isregistered?'是':'否'
        ),
        array(
            'name'=>'cr_grade',
            'value'=>Contactrecord::$cr_grade[$model->cr_grade]
        ),
        array(
            'name'=>'cr_type',
            'value'=>$model->cr_type?'是':'否'
        ),
            'cr_salesman',
            'cr_remark',
        array(
            'name'=>'cr_time',
            'value'=>showFormatDateTime($model->cr_time)
        ),
	),
    'htmlOptions'=>array('class'=>'detail-view','style'=>'table-layout: fixed;'),
)); ?>