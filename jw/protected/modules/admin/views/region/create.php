<?php
$this->breadcrumbs=array(
        '地区配置',
    '新建信息',
);?>
<?php
    if($parent){
        echo "父级：".$parent->re_name;
    }else{
        echo "顶级";
    }
?>

<?=$this->renderPartial("_form",array(
    "model"=>$model,
))?>