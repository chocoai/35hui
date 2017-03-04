<style type="text/css">
.btnDiv{ height: 35px; overflow: hidden; position: absolute; cursor: pointer; width: 105px; margin: 0px; padding: 0px;}
.single_up{ width:20; height:10; size:0;border:0; background-color:#fff;filter:alpha(opacity=0);-moz-opacity:0; opacity:0; margin:0;  padding:0; font-size:80px;  margin-left:-330px;  cursor:pointer;}
.single_up_btn{ border: 0px; color: white; cursor: pointer; font-weight: bold; height: 35px;  padding-top: 18px; width: 105px; background:url(<?=IMAGE_URL?>/dzup.gif) no-repeat ;}
.buildpic{ border: 0px;color: white; cursor: pointer; font-weight: bold; height: 35px; width: 105px;background:url(<?=IMAGE_URL?>/chooseBuildPic.gif) no-repeat ;}

.upcont{ clear:both; height:130px; border:1px solid #ccc; overflow-x:hidden;  overflow-y:scroll; padding:15px 0px}
.upcont .upic{ padding:5px 10px;height:130px; width:110px; float:left;overflow:hidden }
.upic .line{text-align:center;}
.upic .line input{ margin-right:5px;}
.upic .line a{ color:blue}
.upic img{ padding:2px; border:1px solid #ccc;}
</style>
<script type="text/javascript" src="/js/SWFUpload/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/js/SWFUpload/uploadSourcePic/handlers.js?v=1.0.1"></script>
<script type="text/javascript">
		var swfu;
		window.onload = function () {
			swfu = new SWFUpload({
				// Backend Settings
				upload_url: "/manage/imageinfo/uploadmoresourcepic",
				post_params: {"type":"<?=$type?>","sourceType":"<?=$sourceType?>","PHPSESSID": "<?php echo session_id(); ?>"},

				// File Upload Settings
				file_size_limit : "3 MB",	// 3MB
				file_types : "*.jpg;*.jpeg;*.png;*.gif",
				file_types_description : "JPG Images",
				file_upload_limit : "0",

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
				button_height:22,
				button_cursor: SWFUpload.CURSOR.HAND,
				// Flash Settings
				flash_url : "/js/SWFUpload/swfupload/swfupload.swf",
				debug: false
			});
		};
</script>

<div style="width:100%;">
    <div style="width:120px;float: left">
        <form action="/manage/imageinfo/uploadmoresourcepic" method="post" target="upload_one_pic" enctype="multipart/form-data" id="uploadframeform">
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
    <div style="float:left;width: 120px">
        <form method="post">
            <span id="spanButtonPlaceholder"></span>
        </form>
    </div>
    <?php /* if(($sourceType=='office'||$sourceType=='residence')&&$type!=3){?>
    <div style="float:left;width: 120px"><input type="button" class="buildpic" onclick="showFrame(<?=$p_type?>);"/></div>
    <?php }*/?>
    <div id="divLoadLine" style="float: left;"></div>
    <span id="message" style="display:none;" allSelect="" allUpload="" nowUpload="">
        <font style='color:red'>上传中</font><img src='<?=IMAGE_URL?>/uploadPicLoad.gif' />
    </span>
</div>
<form id="thumbnailsForm" action="" method="post">
    <div class="upcont" id="thumbnails" style="display:none">
    </div>
</form>

<script type="text/javascript">
function getPicStr(){
    var allInput = $("#thumbnailsForm input[name='imgurl[]']");
    var str = "";
    for(var i=0;i<allInput.length;i++){
        str += "|"+allInput.eq(i).val();
    }
    return str;
}
function del(obj){
    var delPic = $(obj).parents(".upic").children("input").val();
    $(obj).parents(".upic").remove();
    $.ajax({
        url:"<?php echo Yii::app()->createUrl("/manage/imageinfo/deleateimage");?>",
        type:"POST",
        data:{"delPic":delPic,"sourceType":"<?=$sourceType?>"},
        success:function(msg){
            if($("#thumbnails").children().length==0){//重设高度
                window.frameElement.style.height = "50px";
                $("#thumbnails").css("display", "none");
            }
            //查看是否是标题图。是就删除标题图
            var titlePic = window.parent.document.getElementById("titlepic_hidden").value
            if(titlePic==delPic){
                window.parent.document.getElementById("titlepic_hidden").value = "";//隐藏域为空
                window.parent.document.getElementById("titlepic_img").src = "<?=IMAGE_URL?>/p-lack.jpg";//设置表图片
            }
           
        }
    });
}
function getTitlePic(){
    //没有标题图，则设置标题图
    var title_pic = window.parent.document.getElementById("titlepic_hidden").value;
    if(title_pic==""){//还设置标题图，则设置标题图
        var title_pic = $("#thumbnails").children(".upic").eq(0).children("input").val();
        setTitlePic(title_pic);
    }
}
function changeTitlePic(obj){
    var pic = $(obj).parents(".upic").children("input").val();
    setTitlePic(pic);
    alert("设置成功！");
}
/**
 * 传递完整图片地址
 */
function setTitlePic(pic){
    window.parent.document.getElementById("titlepic_hidden").value = pic;//设置隐藏表单
    //表示图片前面有域名，还有_large
    var index = pic.lastIndexOf(".");
    var head = pic.substr(0,index);
    var last = pic.substr(index);
    var showPic = head+"_large"+last;
    window.parent.document.getElementById("titlepic_img").src = "<?=PIC_URL?>"+showPic;//设置表图片
}

function showFrame(p_type){
    if(window.parent.document.getElementById("sourceidshow").value){
        if(p_type==2){
            if(window.parent.document.getElementById("tr_basepicture").style.display=="none"){
                window.parent.document.getElementById("tr_basepicture").style.display="";
            }else{
                window.parent.document.getElementById("tr_basepicture").style.display="none";
            }
        }else if(p_type==1){
            if(window.parent.document.getElementById("tr_basepicture2").style.display=="none"){
                window.parent.document.getElementById("tr_basepicture2").style.display="";
            }else{
                window.parent.document.getElementById("tr_basepicture2").style.display="none";
            }
        }
    }else{
        alert("请选择楼盘！");
    }
}
</script>