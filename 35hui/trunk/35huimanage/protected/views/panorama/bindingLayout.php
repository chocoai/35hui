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
<?php echo $this->renderPartial('_houseLayoutForm', array('model'=>$model,'layoutPictrues'=>$layoutPictrues,'houseLayoutPanoramas'=>$houseLayoutPanoramas)); ?>