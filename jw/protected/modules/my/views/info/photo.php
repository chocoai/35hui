<div class="zftnav">
    <ul>
        <li class="clk">我的档案</li>
    </ul>
</div>
<div class="jbmain">
    <?=$this->renderPartial("_leftmembermenu")?>
    <div class="jbcont">
        <h1>修改头像</h1>
        <div class="mesg">每张图片最大可上传5MB</div>
        <div class="txpic"><img src="<?=User::model()->getUserHeadPhoto($model,"_130x140")?>" width="130px" height="140px" /></div>

        <div class="txbtn">
            <div style="width: 100%;height: 30px">
                <div style="display: none" id="fsUploadProgress"><font style="font-size: 12px">正在上传</font><img src="/js/swfupload/head/uploadPicLoad.gif" /></div>
            </div>
            <div>
                <div>
                    <div style="float:left">
                        <input type="text" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;height: 21px" />
                    </div>
                    <span id="spanButtonPlaceholder"></span>
                </div>
            </div>
            <br />
            <div id="submitHeadPicBtn"><img src="/images/uppic.png" style="cursor: pointer" alt="" /></div>
        </div>

    </div>
</div>


<script type="text/javascript" src="/js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/js/swfupload/head/handlers.js"></script>
<script type="text/javascript">
    var swfu;
    window.onload = function () {
        swfu = new SWFUpload({
            upload_url: "<?=Yii::app()->createUrl("/my/info/upload");?>",
            post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},
            file_size_limit : "5 MB",
            file_types : "*.jpg",
            file_types_description : "JPG Images",
            file_upload_limit : "0",
            file_queue_limit : "1",
            swfupload_loaded_handler : swfUploadLoaded,
            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            upload_error_handler : uploadError,
            upload_complete_handler : uploadComplete,
            upload_success_handler : uploadSuccess,
            button_image_url : "/js/swfupload/head/head.png",
            button_placeholder_id : "spanButtonPlaceholder",
            button_width: 61,
            button_height: 22,
            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_cursor: SWFUpload.CURSOR.HAND,
            flash_url : "/js/swfupload/swfupload.swf",
            debug: false
        });
    };
</script>