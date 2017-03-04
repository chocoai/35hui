<?php
$this->breadcrumbs=array(
        '公司管理',
        '公司类型',
        '添加新类型',
);?>

<h1>添加新类型</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>