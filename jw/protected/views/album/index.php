<?php

$this->topbreadcrumbs = array(
    "展示"=>array("/member/list"),
    $userModel->u_nickname=>array("/user/view","id"=>$userModel->u_id),
    "我的展示"
);
?>
<div>
    <?php
    foreach($album as $value) {
        ?>
    <div class="zss_model">
        <h5 class="zsbg"><em>0</em> 2012-11-12</h5>
        <div class="zs_mod_main">
            <a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$value->am_id));?>"><img src="<?=Album::model()->getAlbumcoverUrl($value,"_230x250");?>" width="230px" height="250px"></a>
            <p><a href="" class="zsbg hd">0</a><a href="" class="zsbg">0</a><a href="" class="zsbg xd">0</a></p>
        </div>
    </div>
        <?php
    }
    ?>

</div>
<?php
$this->renderPartial('_boardorder');
?>