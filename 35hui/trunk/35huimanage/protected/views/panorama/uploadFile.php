<?php
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
    $sourceInformation['parent']['title']=>$sourceInformation['parent']['link'],
	$sourceInformation['current']['title']=>$sourceInformation['current']['link'],
    $titleDescription
);
?>
<?php if(Yii::app()->user->hasFlash('uploadFile')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('uploadFile'); ?>
    </div>
<?php endif; ?>
<div class="form">
<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
	<?php echo CHtml::errorSummary($model); ?>
    <div class="row">
        <?php echo CHtml::activeHiddenField($model, 'p_sourceid'); ?>
        <?php echo CHtml::activeHiddenField($model, 'p_sourcetype'); ?>
        <?php echo CHtml::activeHiddenField($model, 'p_type'); ?>
    </div>
    <div class="row">
        <?php echo CHtml::activeLabelEx($model,'p_description'); ?>
		<?php echo CHtml::activeTextArea($model, 'p_description',array('cols'=>50,'rows'=>7)); ?>
		<?php echo CHtml::error($model,'p_description'); ?>
	</div>
	<div class="row">
		<b>选择全景</b><br>
		<?php echo CHtml::activeFileField($model, 'p_url'); ?>
        <p>全景文件小于2M，格式为jpg, gif, png</p>
        <p style="color:red">注意:如果为单个全景swf文件,可以直接选中上传;如果为多个全景swf文件,请压缩成zip包进行上传,不要包含文件夹;</p>
		<?php echo CHtml::error($model,'p_url'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('上传'); ?>
	</div>
<?php echo CHtml::endForm(); ?>
</div>