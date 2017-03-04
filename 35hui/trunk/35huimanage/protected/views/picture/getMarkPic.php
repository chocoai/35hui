<form action="" name="allPicForm" id="allPicForm" method="post">
    <div style="display: inline">
	<span style="float:right">
	<a onclick="return checkDelete()" href="<?=Yii::app()->createUrl("picture/getmarkpic",array('delete'=>"1"))?>">清空所有历史数据</a><br/><br/>
    <a href="<?=Yii::app()->createUrl("picture/picsdownload",array('id'=>"all"))?>">下载所有历史数据</a>
	</span>
	<div style="float:left">
            <span style="display:none"><?php echo CHtml::dropDownList('picType',"",Picture::$typeDescription); ?></span>
			
            <input type="hidden" id="sourceType" value="<?=$dir=time().mt_rand(1000,9999)?>" />
            <span id="spanButtonPlaceholder"></span>
        </div>
        <div id="divLoadLine" style="float:left"></div>
    </div>
    
    <div id="thumbnails" style="clear:both">
        <div style="width:100%;clear: both">
            <h5></h5>
            <div class="pic_1"></div>
        </div>
        
    </div>
    <div style="clear: both"></div>
    <div id="submitButton" style="display:none">
		<a href="<?=Yii::app()->createUrl("picture/picsdownload",array('id'=>$dir))?>">下载压缩包</a>
    </div>

    <input type="hidden" id="phpsessid" value="<?php echo session_id(); ?>"/>
    <span id="message" style="display:none;" allSelect="" allUpload="" nowUpload=""></span>
</form>

<script type="text/javascript" src="/js/SWFUpload/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/js/SWFUpload/uploadBuildPic/handlers1.js"></script>
<script type="text/javascript">
		function checkDelete(){
			var r=confirm("确认清空服务器数据目录");
			if (r==true){
				return true;
			}else{
				return false;
			}
		}
		var swfu;
		window.onload = function () {
			swfu = new SWFUpload({
				// Backend Settings
				upload_url: "/picture/UploadMoreBuildPic1",
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