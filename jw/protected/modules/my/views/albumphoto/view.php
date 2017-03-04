<?php
$this->breadcrumbs=array(
        '展示册首页'=>"/my/album/index",
        $albumModel->am_albumtitle,
);
?>
<div class="xcleft">
    <div class="xcup">
        <span class="up_01">
            <?=CHtml::link("设封面", "javascript:;",array("onclick"=>"setCover('".$_GET["id"]."')"))?>
            |
            <?=CHtml::link("删除", "javascript:;",array("onclick"=>"delAlbumphoto('".$_GET["id"]."')"))?>
        </span>
        <span class="up_02"><a href="<?=Yii::app()->createUrl("/my/albumphoto/uploadphoto",array("id"=>$photoModel->ap_amid))?>"><img src="/images/uppic.png" /></a></span>
    </div>
    <div class="xctit"><em>第 <?=$nowNum?> 张 / 共 <?=count($albumphoto)?> 张</em>我的生活照</div>
    <div class="ph_one" id="imgContainer" >
        <img src="<?=$photoModel->ap_url?>" width="500px" />
        <div style="display: none" id="previmg"><?=$prevId?></div>
        <div style="display: none" id="nextimg"><?=$nextId?></div>
        <div style="display: none" id="beginimg"><?=$albumphoto[0]["ap_id"]?></div>
        <div style="display: none" id="endimg"><?=$albumphoto[count($albumphoto)-1]["ap_id"]?></div>
    </div>
</div>
<div class="xcright">
    <?=$this->renderPartial('/album/_albuminfo',array(
        "albummodel"=>$albumModel
    ));?>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        var num = <?=count($albumphoto)?>;
        if(num>1){
            $('#imgContainer').click(function(event) {
                imgClick(event, '#imgContainer', '#previmg', '#nextimg');
            }).mousemove(function(event) {
                imageOnmousemove(event, '#imgContainer');
            });
        }
    })
    var imageOnmousemove = function(e, id) {
        if (e) {
            var cursorper = (parseInt(e.clientX) - $(id).offset().left) / $(id).width();
            if (cursorper > 0.5) {
                $(id).css('cursor', "url(/images/next.cur),auto");
            } else {
                $(id).css('cursor', "url(/images/prev.cur),auto");
            }
        } else {
            return false;
        }
    };
    var imgClick = function(e, id, preid, nextid) {
        if (e) {
            var cursorper = (parseInt(e.clientX) - $(id).offset().left) / $(id).width();
            if (cursorper < 0.5) {
                viewOtherImg($(preid).html(),"prev");
            } else {
                viewOtherImg($(nextid).html(),"next");
            }
        } else {
            return false;
        }
    };
    function viewOtherImg(id,type){
        if(<?=$photoModel->ap_id?>==$("#beginimg").html()&&type=="prev"){
            jw.pop.alert("这是是第一张，要浏览最后一张吗？",{
                ok: function(){
                    window.location.href="/my/albumphoto/view/id/"+id;
                },
                hasBtn_ok:true,
                ok_label:'确定',
                hasBtn_cancel:true,
                icon:4
            });
        }else if(<?=$photoModel->ap_id?>==$("#endimg").html()&&type=="next"){
            jw.pop.alert("已经是最后一张，要重新浏览吗？",{
                ok: function(){
                    window.location.href="/my/albumphoto/view/id/"+id;
                },
                hasBtn_ok:true,
                ok_label:'确定',
                hasBtn_cancel:true,
                icon:4
            });
        }else{
            window.location.href="/my/albumphoto/view/id/"+id;
        }
    }
    function setCover(id){
        $.post("<?=Yii::app()->createUrl("/my/album/setcover");?>", {"photoid":id}, function(msg){
            var info = "";
            if(msg=="success"){
                info = "封面设置成功！";
            }else{
                info = "封面设置失败！";
            }
            jw.pop.alert(info,{
                icon: 1,
                autoClose:1000
            });
        }, "json");
    }
    function delAlbumphoto(id){
        jw.pop.alert(
        "确定要删除此图片吗？",
        {
            ok: function(){
                $.post("<?=Yii::app()->createUrl("/my/albumphoto/delalbumphoto");?>", {"id":id}, function(msg){
                    if(msg=="error"){
                        jw.pop.alert('删除失败！',{icon: 1,autoClose:1000});
                    }else{
                        location.href="/my/album/view/id/"+msg;
                    }
                },"html");
            },
            hasBtn_ok:true,
            ok_label:'确定',
            hasBtn_cancel:true,
            icon:4
        }
    );

    }
</script>