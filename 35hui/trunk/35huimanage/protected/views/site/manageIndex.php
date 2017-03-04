<?php
//require_once('util.php');
$this->breadcrumbs=array(
	'后台首页',
);
?>
<h1>当前待处理的内容</h1>
<b>待处理的散拍全景数目:</b>
<?=CHtml::link($subpanorama,array("subpanorama/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>待审核业主委托数目:</b>
<?php
echo CHtml::link(Quickrelease::model()->count(array('condition'=>'qrl_check=0')),array("quickrelease/admin"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<? /*
<b>待处理的房源设优请求:</b>
<?php echo CHtml::link($applyhighsource,array("applyhighsource/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
 *
 */?>
<b>未处理的楼盘纠错:</b>
<?=CHtml::link($correctione,array("correction/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>

<b>待通过的注册经纪人数:</b>
<?=CHtml::link($uagentCheck,array("uagent/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>待通过的执业认证数:</b>
<?=CHtml::link($uagentBcard,array("uagent/practice"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>待通过的身份认证数:</b>
<?=CHtml::link($uagentScard,array("uagent/identify"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<? /*<b>待通过的运营认证数:</b>
<?php //echo CHtml::link($uagentLicense,array("uagent/license"),array('class'=>'right-id-tip deepskyblue'));?><br/>

<b>待通过的门店审核:</b>
<?=CHtml::link($ucomCheck,array("ucom/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>待通过的门店运营认证:</b>
<?=CHtml::link($ucomLicense,array("ucom/license"),array('class'=>'right-id-tip deepskyblue'));?><br/>
 *
 */?>
<b>待回复的建议/意见数目:</b>
<?=CHtml::link($msgrec,array("msgrec/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<? /*
<b>建议/意见总数:</b>
<?=CHtml::link($msgrecTotal,array("msgrec/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
 *
 */?>
<b>待审核的楼盘征集数目:</b>
<?=CHtml::link($buildcollec,array("buildcollect/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>待审核的创意园征集数目:</b>
<?=CHtml::link($creativecollect,array("creativecollect/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<? /*
<b>楼盘征集总数:</b>
<?=CHtml::link($buildcollectTotal,array("buildcollect/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>楼盘纠错数目:</b>
<?=CHtml::link($error,array("error/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>楼盘微博数目:</b>
<?=CHtml::link($twittersuggest,array("twittersuggest/buildIndex"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>违规处理数目:</b>
<?=CHtml::link($report,array("report/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
 *
 */?>
<b>未审核经纪人logo:</b><?=CHtml::link($uagentphotoaudit,array("uagent/uagentlogo"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>未审核业主logo:</b><?=CHtml::link($unormallogo,array("unormal/unormallogo"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>未审核需求登记:</b><?=CHtml::link($quickrequire,array("quickrequire/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>清空缓存:</b><a class='right-id-tip deepskyblue' href="<?echo MAINHOST;echo Yii::app()->createUrl('site/cleancache');?>">清除</a><br/>

<?/*
<b>未审核中介公司logo:</b><?=CHtml::link($uc_logoaudit,array("ucom/comlogo"),array('class'=>'right-id-tip deepskyblue'));?><br/>
<b>过期未下线的版块精选:</b><?=CHtml::link($outdaybuyregion,array("buyregion/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>
*/?>
<b>会 员 总 数:</b>
<?=CHtml::link($user,array("user/index"),array('class'=>'right-id-tip deepskyblue'));?><br/>