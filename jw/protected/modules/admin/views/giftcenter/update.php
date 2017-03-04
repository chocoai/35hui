<?php
$this->breadcrumbs=array(
        '礼物与道具',
        "编辑礼物"
);?>
<?=$this->renderPartial("_form",array(
    "model"=>$model,
))?>