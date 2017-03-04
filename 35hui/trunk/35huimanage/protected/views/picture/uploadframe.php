<style type="text/css">
.btnDiv{
    height: 35px;
    overflow: hidden;
    position: absolute;
    cursor: pointer;
    width: 105px;
    margin: 0px;
    padding: 0px;
}
.single_up{
    width:20;
    height:10;
    size:0;border:0;
    background-color:#fff;filter:alpha(opacity=0);-moz-opacity:0;
    opacity:0;
    margin:0;
    padding:0;
    font-size:80px;
    margin-left:-330px;
    cursor:pointer;
}
.single_up_btn{
    border: 0px;
    color: white;
    cursor: pointer;
    font-weight: bold;
    height: 35px;
    padding-top: 18px;
    width: 105px;
    background:url(<?=IMAGE_URL?>/dzup.gif) no-repeat ;
}
</style>
<script type="text/javascript" src="/js/SWFUpload/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/js/SWFUpload/uploadSourcePic/handlers.js"></script>
<script type="text/javascript">
		var swfu;
		window.onload = function () {
			swfu = new SWFUpload({
				// Backend Settings
				upload_url: "/picture/uploadmoresourcepic",
				post_params: {"type":"<?=$type?>","sourceType":"<?=$sourceType?>","PHPSESSID": "<?php echo session_id(); ?>"},

				// File Upload Settings
				file_size_limit : "2 MB",	// 2MB
				file_types : "*.jpg;*.jpeg;*.png;*.gif",
				file_types_description : "JPG Images",
				file_upload_limit : "10",

				// Event Handler Settings - these functions as defined in Handlers.js
				//  The handlers are not part of SWFUpload but are part of my website and control how
				//  my website reacts to the SWFUpload events.
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
				button_height: 31,
				button_cursor: SWFUpload.CURSOR.HAND,

				// Flash Settings
				flash_url : "/js/SWFUpload/swfupload/swfupload.swf",
				debug: false
			});
		};
</script>

<div style="width:100%">
    <div style="width:120px;float: left">
        <form action="/picture/uploadmoresourcepic" method="post" target="upload_one_pic" enctype="multipart/form-data" id="uploadframeform">
            <div class="btnDiv">
                <input size="4" class="single_up" type="file" onchange="return onePicFileDialog()" id="picfile" name="Filedata" />
            </div>
            <input type="button" class="single_up_btn"/>
            <input type="hidden" name="type" value="<?=$type?>"  />
            <input type="hidden" name="sourceType" value="<?=$sourceType?>"  />
            <input type="hidden" name="oneUpload" value="1" />
        </form>
        <iframe name="upload_one_pic" id="upload_one_pic" style="display:none"></iframe>
    </div>
    <div style="float:left;width: 150px">
        <form method="post" enctype="multipart/form-data">
            <span id="spanButtonPlaceholder"></span>
        </form>
    </div>
    <div id="divLoadLine" style="float: left;"></div>
    <input type="hidden" name="filenamestr" value="" id="filenamestr" />
    <span id="message" style="display:none;" allSelect="" allUpload="" nowUpload="">
        <font style='color:red'>上传中</font><img src='<?=IMAGE_URL?>/uploadPicLoad.gif' />
    </span>
</div>
<div style="width: 100%;clear:both" id="thumbnails"></div>

<script type="text/javascript">
function del(obj){
    var delPic = $(obj).attr("attr");
    var filenamestr = $("#filenamestr").val();
    $.ajax({
        url:"<?php echo Yii::app()->createUrl("/picture/deleateimage");?>",
        type:"POST",
        data:{"delPic":delPic,"sourceType":"<?=$sourceType?>","filenamestr":filenamestr},
        success:function(msg){
            if(msg!=""){
                var msg = eval("("+msg+")");
                $("#filenamestr").val(msg[1]);//修改总体数据

                //修改显示图片
                $("#thumbnails").children().eq(msg[0]).remove();

                //查看是否是标题图。是就删除标题图
                var titlePic = window.parent.document.getElementById("titlepic_hidden").value
                if(titlePic==delPic){
                    window.parent.document.getElementById("titlepic_hidden").value = "";//隐藏域为空
                    window.parent.document.getElementById("titlepic_img").src = "<?=IMAGE_URL?>/p-lack.jpg";//设置表图片
                }
            }
        }
    });
}
$(document).ready(function(){
    $("#thumbnails").html("<img src='/images/p-lack.jpg' attr='default' />");
});
function getTitlePic(){
    //没有标题图，则设置标题图
    var pic = window.parent.document.getElementById("titlepic_hidden").value;
    if(pic==""){//还设置标题图，则设置标题图
        var filenamestr = $("#filenamestr").val();
        if(filenamestr!=""){//此frame中有照片
            var index = filenamestr.indexOf("|", 1);
            if(index==-1){//只有一张
                pic = filenamestr.substr(1);
            }else{//有多张
                pic = filenamestr.substr(1,index-1);
            }
            setTitlePic(pic);
        }
    }
}
function changeTitlePic(obj){
    var pic = $(obj).attr("attr");
    setTitlePic(pic);
}
/**
 * 传递完整图片地址
 */
function setTitlePic(pic){
    window.parent.document.getElementById("titlepic_hidden").value = pic;//设置隐藏表单
    //表示图片前面有域名，还有_thumb
    var index = pic.lastIndexOf(".");
    var head = pic.substr(0,index);
    var last = pic.substr(index);
    var showPic = head+"_thumb"+last;
    window.parent.document.getElementById("titlepic_img").src = "<?=PIC_URL?>"+showPic;//设置表图片
}
</script>