var fileAllUploadNum =0, fileNowUpload = 0;
function fileQueueError(file, errorCode, message) {
    try {
        console.log(this)
        var msg = "图片错误";
        switch (errorCode) {
            case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
                msg = "您选择的文件太多，每次只能选择"+this.settings.file_upload_limit+"个文件！";
                break;
            case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
                msg = "文件太大，单个文件最大"+this.settings.file_size_limit+"M！";
                break;
            case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                msg = "选择的文件为空，不能上传！";
                break;
            case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
                msg = "选择的文件不能上传！";
                break;
            default:
                msg = "图片错误！";
                break;;
        }
        jw.pop.alert(msg,{icon:2,autoClose:1000});
        return;
    } catch (e) {
    }
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
    try {
        if (numFilesQueued > 0) {
            fileAllUploadNum = numFilesQueued;
            fileNowUpload = 1;
            this.setButtonDisabled(true);
            this.startUpload();
        }
    } catch (ex) {
        this.debug(ex);
    }
}

function uploadProgress(file, bytesLoaded) {
    try {
        var percent = Math.ceil((bytesLoaded / file.size) * 100);

        var progress = new FileProgress(file,  this.customSettings.upload_target);
        progress.setProgress(percent);
        if(percent==100){
            progress.setStatus("创建缩略图...");
        }else{
            progress.setStatus("上传"+percent+"%");
        }
        progress.setUploadNum(fileNowUpload, fileAllUploadNum);
    } catch (ex) {
        this.debug(ex);
    }
}

function uploadSuccess(file, serverData) {
    try {
        var progress = new FileProgress(file,  this.customSettings.upload_target);

        if (serverData.substring(0, 7) === "FILEID:") {
            progress.setStatus("创建缩略图...");
            progress.setStatus("上传0%");
            addImage(serverData.substring(7));
            fileNowUpload += 1;
            progress.setUploadNum(fileNowUpload);
        } 
    } catch (ex) {
        this.debug(ex);
    }
}

function uploadComplete(file) {
    try {
        /*  I want the next upload to continue automatically so I'll call startUpload here */
        if (this.getStats().files_queued > 0) {
            this.startUpload();
        } else {
            
            var upload_target = this.customSettings.upload_target;
            var progress = new FileProgress(file,  upload_target);
            progress.setStatus("完成");
            this.setButtonDisabled(false);
            jw.pop.alert('图片加载成功，请点击立即上传！',
            {
                ok:function(){
                    document.getElementById(upload_target).innerHTML="";
                }
            }
            );
            
        }
    } catch (ex) {
        this.debug(ex);
    }
}

function uploadError(file, errorCode, message) {
}


function addImage(src) {

    var html = '<div class="sclmod">'+
    '<div class="scmod">'+
    '<div class="close bg" onClick="delImage(this)"></div>'+
    '<img src="'+src+'" width="160px" />'+
    '<input type="hidden" name="img[]" value="'+src+'" />'+
    '<div class="p"><input type="text" class="txt_04" value="我的生活照" /></div>'+
    '</div>'+
    '</div>';

    $("#thumbnails").append(html);
}
function delImage(obj){
    var url = $(obj).nextAll("input").val();
    var nowAt = parseInt($(obj).parent().parent().prevAll(".sclmod").length);
    $("#thumbnails .sclmod").eq(nowAt).remove();
    $.post("/my/albumphoto/deltmpphoto",{
        "url":url
    });
}

function fadeIn(element, opacity) {
    var reduceOpacityBy = 5;
    var rate = 30;	// 15 fps


    if (opacity < 100) {
        opacity += reduceOpacityBy;
        if (opacity > 100) {
            opacity = 100;
        }

        if (element.filters) {
            try {
                element.filters.item("DXImageTransform.Microsoft.Alpha").opacity = opacity;
            } catch (e) {
                // If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
                element.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + opacity + ')';
            }
        } else {
            element.style.opacity = opacity / 100;
        }
    }

    if (opacity < 100) {
        setTimeout(function () {
            fadeIn(element, opacity);
        }, rate);
    }
}



/* ******************************************
 *	FileProgress Object
 *	Control object for displaying file info
 * ****************************************** */

function FileProgress(file, targetID) {
    this.fileProgressID = "divFileProgress";

    this.fileProgressWrapper = document.getElementById(this.fileProgressID);
    if (!this.fileProgressWrapper) {
        this.fileProgressWrapper = document.createElement("div");
        this.fileProgressWrapper.className = "progressWrapper";
        this.fileProgressWrapper.id = this.fileProgressID;

        this.fileProgressElement = document.createElement("div");
        this.fileProgressElement.className = "progressContainer";

        //		var progressCancel = document.createElement("a");
        //		progressCancel.className = "progressCancel";
        //		progressCancel.href = "#";
        //		progressCancel.style.visibility = "hidden";
        //		progressCancel.appendChild(document.createTextNode(" "));
        //
        var progressText = document.createElement("div");
        progressText.className = "progressUploadNum";
        progressText.appendChild(document.createTextNode(file.name));

        var progressBar = document.createElement("div");
        progressBar.className = "progressBarContent";

        var progressBarInProgress = document.createElement("div")
        progressBarInProgress.className = "progressBarInProgress";
        progressBar.appendChild(progressBarInProgress);

        var progressStatus = document.createElement("div");
        progressStatus.className = "progressBarStatus";
        progressStatus.innerHTML = "&nbsp;";

        //		this.fileProgressElement.appendChild(progressCancel);
        //
		
        this.fileProgressElement.appendChild(progressBar);
        this.fileProgressElement.appendChild(progressStatus);
        this.fileProgressElement.appendChild(progressText);

        this.fileProgressWrapper.appendChild(this.fileProgressElement);

        document.getElementById(targetID).appendChild(this.fileProgressWrapper);

    } else {
        this.fileProgressElement = this.fileProgressWrapper.firstChild;
    }

    this.height = this.fileProgressWrapper.offsetHeight;

}
FileProgress.prototype.setProgress = function (percentage) {
    this.fileProgressElement.className = "progressContainer green";
    this.fileProgressElement.childNodes[0].childNodes[0].className = "progressBarInProgress";
    this.fileProgressElement.childNodes[0].childNodes[0].style.width = percentage + "%";
};
FileProgress.prototype.setComplete = function () {
    this.fileProgressElement.className = "progressContainer blue";
    this.fileProgressElement.childNodes[3].className = "progressBarComplete";
    this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setStatus = function (status) {
    this.fileProgressElement.childNodes[1].innerHTML = "进度:"+status;
};
FileProgress.prototype.setUploadNum = function (now,all) {
    if (!all) {
        all = fileAllUploadNum;
    }
    if(now > all){
        now = all;
    }
    this.fileProgressElement.childNodes[2].innerHTML = "第 "+now+"/"+all+" 张";
        
};

FileProgress.prototype.toggleCancel = function (show, swfuploadInstance) {
    this.fileProgressElement.style.visibility = show ? "visible" : "hidden";
    if (swfuploadInstance) {
        var fileID = this.fileProgressID;
        this.fileProgressElement.childNodes[0].onclick = function () {
            swfuploadInstance.cancelUpload(fileID);
            return false;
        };
    }
};
