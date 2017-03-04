<?php
$this->breadcrumbs=array(
	'Msgs'=>array('index'),
	'Create',
);
?>
<h1>编写站内信</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'to'=>$to)); ?>