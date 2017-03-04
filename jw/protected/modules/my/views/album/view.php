<?php
$this->breadcrumbs=array(
        '展示册首页'=>"/my/album/index",
        $albummodel->am_albumtitle,
);
?>
<div class="xcleft">
    <div class="xcup">
        <span class="up_01">
            <?=CHtml::link("编辑", "javascript:;",array("onclick"=>"editAlbum('".$_GET["id"]."')"))?>
            |
            <?=CHtml::link("删除", "javascript:;",array("onclick"=>"delAlbum('".$_GET["id"]."')"))?>
            |
            <?=CHtml::link("排序", array("/my/album/sort","id"=>$_GET["id"]))?>
        </span>
        <span class="up_02"><a href="<?=Yii::app()->createUrl("/my/albumphoto/uploadphoto",array("id"=>$_GET["id"]))?>"><img src="/images/uppic.png" /></a></span>
    </div>

    <?php
    if($albumphoto) {
        foreach($albumphoto as $value) {
            ?>
    <div class="upmod">
        <a href="<?=Yii::app()->createUrl("/my/albumphoto/view",array("id"=>$value->ap_id))?>">
            <img src="<?=Albumphoto::model()->getStaticPhotoUrl($value->ap_url, "_230x250")?>" width="128px" height="140px" />
        </a>
    </div>
            <?php
        }
    }else {
        echo "相册内暂无相片";
    }
    ?>

    <div class="clear"></div>
    <div class="xcpl"><em>共有 <?=$dataProvider->getTotalItemCount()?> 个人发表该观点</em>他们评论了本展示</div>
    <?php
    foreach($dataProvider->getData() as $data) {
        $this->renderPartial('_comment', array(
                'data'=>$data,
        ));
    }?>
    <div style="clear:both;margin-top: 5px"></div>
    <?php
    $this->widget('CLinkPager',array(
            'pages'=>$dataProvider->pagination,
            "cssFile"=>"/css/pager.css"
    ));
    ?>


</div>

<div class="xcright">
    <?=$this->renderPartial('_albuminfo',array(
            "albummodel"=>$albummodel
    ));?>
</div>


<div id="albumform" style="display: none">
    <?=$this->renderPartial('_albumform');?>
</div>
<div style="display:none" id="info_<?=$albummodel->am_id?>">
    <input name="title" type="hidden" value="<?=$albummodel->am_albumtitle?>" />
    <input name="description" type="hidden" value="<?=$albummodel->am_albumdescribe?>"/>
    <input name="type" type="hidden" value="<?=$albummodel->
                   am_albumtype?>"/>
</div>