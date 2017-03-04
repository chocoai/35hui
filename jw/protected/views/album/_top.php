<?php
/*上一个相册和下一个相册*/
$prevAlbum = $nextAlbum = "";
foreach($albumList as $key=>$value) {
    if($value->am_id==$albumModel->am_id) {
        isset ($albumList[$key-1]["am_id"])?$prevAlbum=$albumList[$key-1]["am_id"]:"";
        isset ($albumList[$key+1]["am_id"])?$nextAlbum=$albumList[$key+1]["am_id"]:"";
    }
}
?>
<div class="hy_m_line">
    <input type="button" class="btn_01" value="&gt;" style="float:right; margin-left:10px;" onClick="changeAlbum('next','<?=$nextAlbum?>')" title="下一个相册" />
    <input type="button" style="float:right" class="btn_01" value="&lt;" onClick="changeAlbum('prev','<?=$prevAlbum?>')" title="上一个相册" />
    <img src="/images/pdtj.jpg">
</div>
<div class="zsmes">
    <div class="zs_pic">
        <a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$albumModel->am_id))?>"><img src="<?=Album::model()->getAlbumcoverUrl($albumModel,"_230x250");?>" width="230px" height="250px"></a>
    </div>
    <div class="zs_txt">
        <p>
            <?=date("Y-m-d H:i",$albumModel->am_updatetime);?>更新
        </p>
        <div class="zsp">
            <div class="zs_mess"><?=$albumModel->am_albumtitle?></div>
            <div class="zs_pz">
                <div class="zsccont">
                    <div class="zs_model" style="border-right:1px solid #bbb;"><span class="album_red_board_num"><?=$albumModel->am_redboard?></span><br>红牌</div>
                    <div class="zs_model"><span class="album_black_board_num" style="color:#666"><?=$albumModel->am_blackboard?></span><br><span style="color:#666">黑牌</span></div>
                </div>
            </div>
        </div>
        <div class="zs_pjia">
            <a class="zsbg zs5" title="浏览数">(<?=$albumModel->am_visitnum?>)</a>
            <a class="zsbg zs6" title="评论数">(<?=$albumModel->am_replynum?>)</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    function changeAlbum(type, id){
        if(!id){
            if(type=="next"){
                jw.pop.alert("已经是最后一个相册了！",{autoClose:1000,icon:2})
            }else{
                jw.pop.alert("已经是第一个相册了！",{autoClose:1000,icon:2})
            }
            return false;
        }
        var baseUrl = "<?=Yii::app()->createUrl("/album/view",array("id"=>"88"))?>";
        baseUrl = baseUrl.replace("88",id);
        window.location.href= baseUrl;
        return true;
    }
</script>