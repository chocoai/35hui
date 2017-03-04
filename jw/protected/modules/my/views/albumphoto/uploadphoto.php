<form method="post" action="<?=Yii::app()->createUrl("/my/albumphoto/save");?>" id="imgform" >
    <div class="slctit">
        <span class="slc_1">选择展示相册</span>
        <span class="slc_2">
            <select name="album" id="album" class="txt_03">
                <?php
                foreach($albums as $value){
                    $select = $value->am_id==$albumsId?"selected":"";
                    echo "<option value='".$value->am_id."' ".$select.">".$value->am_albumtitle."[".$value->am_photonum."]</option>";
                }
                ?>
            </select>
        </span>
        <span class="slc_3"><a href="javascript:;" onclick="return createAlbum()">创建展示册</a></span>
        <div id="divFileProgressContainer" style="float:left"></div>
        <span class="slc_4"><a href="<?=Yii::app()->createUrl("/my/album/index")?>">返回相册&gt;&gt;</a></span>
    </div>
    <div class="scc_main">
        <div id="thumbnails" style="min-height:200px"></div>
        <div class="sc_btn" style="">
            <div style="float:left;margin-left: 300px"><span id="spanButtonPlaceholder" style="width:155px;" ></span></div>
            <div style="float:left;margin-left: 20px"><input type="button" value=" " class="bg btn_09" onclick="checkForm()" id="submitbtn"  /></div>
        </div>
    </div>
</form>

<link href="/js/swfupload/default.css" rel="stylesheet"/>
<script type="text/javascript" src="/js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/js/swfupload/photo/handlers.js"></script>
<script type="text/javascript">
    var swfu;
    window.onload = function () {
        swfu = new SWFUpload({
            upload_url: "<?=Yii::app()->createUrl("/my/albumphoto/upload");?>",
            post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

            file_size_limit : "5 MB",	// 2MB
            file_types : "*.jpg",
            file_types_description : "JPG Images",
            file_upload_limit : "10",

            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess,
            upload_complete_handler : uploadComplete,

            button_image_url : "/js/swfupload/photo/albumphoto.gif",
            button_placeholder_id : "spanButtonPlaceholder",
            button_width: 156,
            button_height:47,
            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_cursor: SWFUpload.CURSOR.HAND,

            flash_url : "/js/swfupload/swfupload.swf",

            custom_settings : {
                upload_target : "divFileProgressContainer"
            },
            debug: false
        });
    }
</script>
<div id="albumform" style="display: none">
    <?=$this->renderPartial('/album/_albumform');?>
</div>
<script type="text/javascript">
    function checkForm(){
        var albumNum = $("#album option").length;
        if(albumNum==0){
            createAlbum(addalbumsuccess);
            return false;
        }
        var len = $("#thumbnails").children().length;
        if(len==0){
            jw.pop.alert("请先选择图片！",{ok_label:'确定',icon:2});
            return false;
        }
        //检查是否还能上传图片
        var amId = $("#album").val();
        $.post("/my/albumphoto/checksave",{"picNum":len,"amId":amId},function(msg){
            msg = eval(msg);
            if(msg[0]=="success"){
                $("#imgform").submit();
            }else{
                jw.pop.alert(msg[1],{ok_label:'确定',icon:2});
            }
        },"text");
    }
    var addalbumsuccess = function(msg){
        var html = "<option value='"+msg[0]+"'>"+msg[1]+"</option>";
        $("#album").append(html);
        $('#album')[0].selectedIndex = $("#album option:last").attr("index");
    }
</script>