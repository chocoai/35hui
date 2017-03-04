<?php
$this->topbreadcrumbs = array(
    "展示"=>array("/member/list"),
    $userModel->u_nickname=>array("/user/view","id"=>$userModel->u_id),
    "我的展示"=>array("/album/index","id"=>$albumModel->am_id),
    $albumModel->am_albumtitle
);
$this->breadcrumbs = array(
        "展示页"=>array("/album/index","id"=>$albumModel->am_userid),
        $albumModel->am_albumtitle
        )
        ?>
<div class="hymain">
    <?=$this->renderPartial('_top',array(
        "albumList"=>$albumList,
        "albumModel"=>$albumModel
    ));?>
    <div class="zssay">
        <div class="zss_lf"><a href="#newcomment">&gt; 我来说两句</a> 共有<?=$dataProvider->totalItemCount;?>条</div>
    </div>
    <div class="zss_main">
        <?php
        foreach($dataProvider->getData() as $value) {
            $this->renderPartial('_comment',array("value"=>$value));
        }
        ?>
        <div style="height: 30px">
            <?php
            $this->widget('CLinkPager',array(
                    'pages'=>$dataProvider->pagination,
                    "cssFile"=>"/css/pager.css"
            ));
            ?>
        </div>
        <?=$this->renderPartial('_commentFrom',array("albumModel"=>$albumModel));?>
    </div>
</div>