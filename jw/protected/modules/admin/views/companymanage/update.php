<?php
$this->breadcrumbs=array(
        '公司管理',
        '添加新公司',
);?>

<h1>修改公司 <?=$model->cm_id?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,"district"=>$district)); ?>