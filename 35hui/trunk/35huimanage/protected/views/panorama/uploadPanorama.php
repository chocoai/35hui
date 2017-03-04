<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
    '上传全景'
);
?>
<?php if(Yii::app()->user->hasFlash('uploadFile')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('uploadFile'); ?>
    </div>
<?php endif; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'fileForm'=>$fileForm)); ?>