<?php
Yii::app()->clientScript->registerScriptFile("/js/scrollable.js",CClientScript::POS_END);
$this->topbreadcrumbs = array(
    "展示"=>array("/member/list"),
    $userModel->u_nickname=>array("/user/view","id"=>$userModel->u_id),
    "我的展示"=>array("/album/index","id"=>$albumModel->am_id),
    $albumModel->am_albumtitle
);
$this->breadcrumbs = array(
        "展示页"=>array("/album/index","id"=>$albumModel->am_userid),
        $albumModel->am_albumtitle=>array("/album/view","id"=>$albumModel->am_id),
        )
        ?>
<div class="hymain">
    <?=$this->renderPartial('_top',array(
        "albumList"=>$albumList,
        "albumModel"=>$albumModel
    ));?>
    <div class="zsc_pic">
        <?php
        foreach($photoList as $value) {
            ?>
        <div style="padding: 5px"><img src="<?=$value->ap_url?>" /></div>
            <?php
        }
        ?>
    </div>
    <div class="zscpl">
        <a href="javascript:;" onClick="addAlbumboard(1)" class="album_red_board_num"><?=$albumModel->am_redboard?></a>
        <a href="javascript:;" onClick="addAlbumboard(2)" class="hs album_black_board_num"><?=$albumModel->am_blackboard?></a>
    </div>

    <div class="zs_hdp">
        <div class="zs_hdp_lf"><a href="javascript:;" class="bg" id="move_left">&nbsp;</a></div>
        <div class="zs_hdp_mid" style="overflow:hidden;position: relative;">
            <div id="allalbumlist" style="position: absolute;">
                <?php
                foreach($albumList as $value) {
                    ?>
                <div class="hdp_model">
                    <h5 class="bg" title="图片数目"><?=$value->am_photonum?></h5>
                    <div class="hdp_mod_main">
                        <a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$value->am_id))?>" target="_blank"><img src="<?=Album::model()->getAlbumcoverUrl($value,"_230x250")?>" width="150px" height="163px" /></a>
                        <p><a class="bg" title="红牌数目"><?=$value->am_redboard?></a><a class="bg hs" title="评论数目"><?=$value->am_replynum?></a></p>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="zs_hdp_rt"><a href="javascript:;" class="bg" id="move_right">&nbsp;</a></div>
    </div>
    <div class="zss_main">
        <?php
        foreach($albumComment as $value) {
            $this->renderPartial('_comment',array("value"=>$value));
        }
        $this->renderPartial('_commentFrom',array("albumModel"=>$albumModel));
        ?>
    </div>
</div>

<script type="text/javascript">
    function addAlbumboard(type){
        var id = "<?=$albumModel->am_id?>";
        $.post("/userboard/albumborardcreate",{'id':id,"type":type},function(msg){
            if(msg=="success"){
                if(type==1){
                    $(".album_red_board_num").each(function(){
                        $(this).html(parseInt($(this).html())+1)
                    })
                }else{
                    $(".album_black_board_num").each(function(){
                        $(this).html(parseInt($(this).html())+1)
                    })
                }
                jw.pop.alert("打牌成功！",{autoClose:1000});
            }else{
                jw.pop.alert(msg,{autoClose:1000,icon:2})
            }
        },"text");
    }
</script>



