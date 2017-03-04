<style type="text/css">
.btnDiv{ height: 35px; overflow: hidden; position: absolute; cursor: pointer; width: 105px; margin: 0px; padding: 0px;}
.single_up{width:20; height:10; size:0;border:0; background-color:#fff;filter:alpha(opacity=0);-moz-opacity:0; opacity:0; margin:0; padding:0; font-size:80px;margin-left:-330px;  cursor:pointer;}
.single_up_btn{border: 0px; color: white;cursor: pointer; font-weight: bold; height: 35px; padding-top: 18px; width: 105px; background:url(<?=IMAGE_URL?>/dzup.gif) no-repeat ;}
</style>
<?php
$this->breadcrumbs=array(
        '房源管理',
        '全景管理',
    );
?>
<div class="msg"><em class="red">上传指导：</em><br>
1、本站提供全景下载功能，下载请拨打客服电话 021-68880132。<br/>
2、照片必须是新地标提供的鱼眼镜头拍摄的照片，按照顺时针方向拍摄。普通相机拍摄的照片无法合成。<br/>
3、每套房源最多上传7个房间的室内全景图，每个房间上传4张全景照片。照片请保留原尺寸，请勿修改。 <br/>
<a href="/help/qjdevice" target="_blank" style="color:#0F29C8;">点击查看更多指导</a>
</div>
<div class="htit">全景管理</div>
<?php
if($subPanorama){
    foreach($subPanorama as $key=>$value){
?>
<div class="qjtit">
    房间<?=$key+1?>：
    <?php echo CHtml::textField("spn_panoramaname",$value->spn_panoramaname,array("id"=>"panoramaname".$value->spn_id,"maxlength"=>"12"));
    echo CHtml::link("修改","#",array("style"=>"color:blue","onClick"=>"updateName(".$value->spn_id.")"));
    echo CHtml::link("删除此房间","#",array("style"=>"color:blue","onClick"=>"deletePanorama(".$value->spn_id.")"));
    echo $value->spn_state==2?CHtml::link("预览",array("view","id"=>$value->spn_id),array("target"=>"_blank","style"=>"color:blue")):"";?>
    <font <?=$value->spn_state==3?"color='red'":"";?>><?php echo CHtml::encode(Subpanorama::$spn_state[$value->spn_state])?></font>

</div>
<div class="qjtu">
<?php
$fisheyephoto = unserialize($value->spn_fisheyephoto);
if($fisheyephoto){
    foreach($fisheyephoto as $v){
        $img = str_replace(".", Subpanorama::$standard[1]['suffix'].".", $v);
        echo '<div class="glmodlr">'.CHtml::image(PIC_URL.$img,"",array("width"=>"100px","height"=>"75px"))."</div>";
    }
}
?>
</div>
<?php
    }
}
?>


 <div style="width:100%;margin-top: 10px">
    <div style="width:120px;float: left">
        <form action="/manage/imageinfo/uploadmorepic" method="post" target="upload_one_pic" enctype="multipart/form-data" id="uploadframeform">
            <div class="btnDiv">
                <input size="4" class="single_up" type="file" onchange="return onePicFileDialog()" id="picfile" name="Filedata" />
            </div>
            <input type="button" class="single_up_btn"/>
            <input type="hidden" name="oneUpload" value="1" />
            <input type="hidden" name="dir" value="<?=$dir?>" />
        </form>
        <iframe name="upload_one_pic" id="upload_one_pic" style="display:none"></iframe>
    </div>

    <div style="float:left;width: 150px;">
        <form method="post">
            <span id="spanButtonPlaceholder"></span>
        </form>
    </div>

    <div id="divLoadLine" style="float: left;"></div>
    <span id="message" style="display:none;" allSelect="" allUpload="" nowUpload="">
        <font style='color:red'>上传中</font><img src='<?=IMAGE_URL?>/uploadPicLoad.gif' />
    </span>
</div>

<form action="/manage/subpanorama/create" name="allPicForm" id="allPicForm" method="post" onsubmit="return validateForm()">
    <div id="nowUploadPicNum" style="display:none"><?=count($subPanorama)*4;?></div>
    <div id="houseNum" style="display:none"><?=count($subPanorama);?></div>
    <div id="thumbnails" style="clear:both"></div>
    <br />
    <div style="clear: both"></div>
    <div id="submitButton" style="display:none">
        <input type="submit" value="确定上传" class="manage_input_button" />
    </div>
    <input type="hidden" name="sourceid" value="<?=$id?>" />
    <input type="hidden" name="type" value="<?=$type?>" />
</form>
<script type="text/javascript" src="/js/SWFUpload/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/js/SWFUpload/uploadPanoramaPic/handlers.js"></script>
<script type="text/javascript">
		var swfu;
		window.onload = function () {
            resetFrameHeight();
			swfu = new SWFUpload({
				// Backend Settings
				upload_url: "/manage/imageinfo/uploadmorepic",
				post_params: {"dir":"<?=$dir?>","PHPSESSID": "<?php echo session_id(); ?>"},

				// File Upload Settings
				file_size_limit : "4 MB",	// 4MB
				file_types : "*.jpg;*.jpeg;*.png;*.gif",
				file_types_description : "JPG Images",
				file_upload_limit : "0",

				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_image_url : "/images/plup.gif",
				button_placeholder_id : "spanButtonPlaceholder",
				button_width: 104,
				button_height: 22,
				button_cursor: SWFUpload.CURSOR.HAND,

				flash_url : "/js/SWFUpload/swfupload/swfupload.swf",
				debug: false
			});
		};
</script>
<script type="text/javascript">
//点击提交时触发此函数
function validateForm(){
    var nowNum = parseInt($("#nowUploadPicNum").html());
    if(nowNum%4!=0){
        alert("很遗憾，每个房间需要四张全景图片，您上传的数目不对！");
        return false;
    }
    var len = $("#allPicForm :input[name='panoramaname[]']").length;
    var namestat = 1;
    for(var i=0;i<len;i++){
        var val = $.trim($("#allPicForm :input[name='panoramaname[]']").eq(i).val());
        if(val==""){
            namestat = 0;
            $("#allPicForm :input[name='panoramaname[]']").eq(i).next("font").html("请输入房间标题！");
        }else{
            $("#allPicForm :input[name='panoramaname[]']").eq(i).next("font").html("");
        }
    }
    if(namestat){
        return true;
    }else{
        alert("请填写房间标题！");
        return false;
    }
}
function updateName(id){
    var name = $.trim($("#panoramaname"+id).val());
    if(name!=""){
        $.ajax({
            url: "/manage/subpanorama/update",
            type: "GET",
            data: {"id":id,"name":name},
            success:function(msg){
                alert(msg);
            }
        })
    }else{
        alert("请填写标题！")
    }
}
function deletePanorama(id){
    if(confirm("确定要删除此房间全景吗？")){
        $.ajax({
            url: "/manage/subpanorama/delete",
            type: "GET",
            data: {"id":id},
            success:function(msg){
                if(msg=="success"){
                    alert("删除成功！");
                    window.location.reload();
                }else{
                    alert(msg);
                }
            }
        })
    }
}
</script>