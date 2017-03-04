<?php
$this->breadcrumbs=array(
	'图片管理'=>array('index'),
);
?>
<h1>查看大图</h1>

    <div class="row">
        <?=CHtml::image(PIC_URL.$model->p_img,"",array("url"=>PIC_URL.$model['p_img'],"title"=>$model['p_title']));?>
    </div>
