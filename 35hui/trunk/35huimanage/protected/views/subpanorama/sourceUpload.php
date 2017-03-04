<?php
$this->currentMenu = 24;
$this->menu=array(
	array('label'=>'返回', 'url'=>array('subpanorama/sourcepanorama','id'=>$sourceId,"type"=>3)),
);
?>

<h1>上传商务中心全景</h1>

<?php echo $this->renderPartial('_sourceUploadForm', array('model'=>$model,'fileForm'=>$fileForm)); ?>