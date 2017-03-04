<form action="" name="allPicForm" id="allPicForm" method="post">
    <div style="display: inline">
        <div style="float:left">
            图片类型：<?php echo CHtml::dropDownList('picType',"",Picture::$typeDescription); ?>
            <input type="hidden" id="sourceType" value="<?=$_GET["sType"]?>" />
            <span id="spanButtonPlaceholder"></span>
        </div>
        <div id="divLoadLine" style="float:left"></div>
    </div>
    
    <div id="thumbnails" style="clear:both">
        <div style="width:100%;clear: both">
            <h5>平面图</h5>
            <div class="pic_1"></div>
        </div>
        <div style="width:100%;clear: both">
            <h5>外景图</h5>
            <div class="pic_2"></div>
        </div>
        <div style="width:100%;clear: both">
            <h5>室内图</h5>
            <div class="pic_3"></div>
        </div>
    </div>
    <div style="clear: both"></div>
    <div id="submitButton" style="display:none">
        <input type="submit" value="确定上传" class="manage_input_button" />
    </div>

    <input type="hidden" id="phpsessid" value="<?php echo session_id(); ?>"/>
    <span id="message" style="display:none;" allSelect="" allUpload="" nowUpload=""></span>
</form>

<script type="text/javascript" src="/js/SWFUpload/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/js/SWFUpload/uploadBuildPic/handlers.js"></script>
<script type="text/javascript">
		var swfu;
		window.onload = function () {
			swfu = new SWFUpload({
				// Backend Settings
				upload_url: "/picture/UploadMoreBuildPic",
				post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

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
				button_height: 31,
				button_cursor: SWFUpload.CURSOR.HAND,

				flash_url : "/js/SWFUpload/swfupload/swfupload.swf",
				debug: false
			});
		};
</script>