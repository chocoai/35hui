<?php
$this->breadcrumbs=array(
        '礼物与道具',
        "添加新礼物"
);?>
<?=$this->renderPartial("_form",array(
    "model"=>$model,
))?>