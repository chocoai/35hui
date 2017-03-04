function fileQueueError(file, errorCode, message) {
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
        var filenamestr = document.getElementById("filenamestr").value;
        var numUploadNum = filenamestr.split("|").length-1;
        if(numUploadNum+numFilesSelected>10){
            var cunUploadNum = 10 - parseInt(numUploadNum);
            if(cunUploadNum==0){
                alert("您已经达到了上传图片的最大数，不能再继续上传");
            }else{
                alert("您只能再继续上传"+cunUploadNum+"张房源图片");
            }
            for(var i=0;i<numFilesSelected;i++){
                this.cancelUpload();
            }
        }else{
            try {
		if (numFilesQueued > 0) {
                    $("#message").attr("allSelect",numFilesSelected);
                    $("#message").attr("allUpload",numFilesQueued);
                    $("#message").attr("nowUpload",0);//现在正在上传的
                    getLoadImage(0,numFilesQueued);
                    $("#divLoadLine").css("display","");//显示上传进度条
                    this.setButtonDisabled(true);
                    this.startUpload();
		}else if(numFilesSelected==1&&numFilesQueued==0){
                    alert("上传图片太大，上传失败！");
                }
            } catch (ex) {
                    this.debug(ex);
            }
        }
        
	
}

function uploadProgress(file, bytesLoaded) {
}
/**
 *上传成功
 */
function uploadSuccess(file, serverData) {
	try {
            addImage(serverData);
            var nowUpload =  parseInt($("#message").attr("nowUpload"))+1;//现在正在上传的
            var allUpload =  $("#message").attr("allUpload");//所有选择的
            $("#message").attr("nowUpload",nowUpload);//现在正在上传的
            getLoadImage(nowUpload,allUpload);
		
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
                    var allSelect = $("#message").attr("allSelect");
                    var allUpload = $("#message").attr("allUpload");
                    var falseUpload = allSelect - allUpload;
                    if(falseUpload=="0"){
                        alert("成功上传"+allUpload+"张图片！");
                    }else{
                        alert("成功上传"+allUpload+"张图片，"+falseUpload+"张由于图片太大上传失败！");
                    }
                    $("#divLoadLine").css("display","none");//隐藏上传进度条
                    this.setButtonDisabled(false);
                    getTitlePic();
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
}
/**
 *验证文件是否可以上传并判断是否达到上传最大数木
 */
function onePicFileDialog(){
    //判断是否达到最大数
    var filenamestr = document.getElementById("filenamestr").value;
    var numUploadNum = filenamestr.split("|").length-1;
    if(numUploadNum>=10){
        alert("您已经达到了上传图片的最大数，不能再继续上传")
        return ;
    }
    //判断图片是否合法
    var patn = /\.jpg$|\.jpeg$|\.gif$|\.png$/i;
    if(patn.test($("#picfile").val())){
        $("#picfile").css("display", "none");
        $("#message").css("display", "");
        document.getElementById("uploadframeform").submit();
    }else{
        $("#picfile").val("");
        alert("不支持此文件格式上传！");
    }
}
function uploadOnePicSuccess(src){
    addImage(src);
    getTitlePic();
    $("#picfile").val("");
    $("#picfile").css("display", "");
    $("#message").css("display", "none");
}
function uploadOnePicFalse(){
    alert("图片太大，上传失败")
    $("#picfile").val("");
    $("#picfile").css("display", "");
    $("#message").css("display", "none");
}
/**
 *显示上传完之后的缩略图。缩略图包含域名。
 */
function addImage(src) {
        //改变现在的filenamestr
        var filenamestr = document.getElementById("filenamestr").value;
        var tmpsrc  = src.substr(src.indexOf(".com")+4);
        
        if(filenamestr!=""){
            filenamestr = filenamestr+"|"+tmpsrc;
        }else{
            filenamestr = "|"+tmpsrc;
        }
        document.getElementById("filenamestr").value = filenamestr;

        var showSrcIndex ,showsrc;
        showSrcIndex = src.lastIndexOf(".");
        showsrc = src.substr(0,showSrcIndex)+"_thumb"+src.substr(showSrcIndex);
        
	var html = '<div style="width: 110px;float: left">';
        html += '<img src="'+showsrc+'" width="100px" height="75px"/><br />';
        html += '<div style="cursor: pointer;width: 50px;float: left" attr="'+tmpsrc+'" onclick="del(this)">删除</div>';
        html += '<div style="cursor: pointer;" attr="'+tmpsrc+'" onclick="changeTitlePic(this)">设标题图</div>'
        html += '</div>';
        if($("#thumbnails").children().eq(0).attr("attr")=="default"){
            $("#thumbnails").html(html);
        }else{
            $("#thumbnails").append(html);
        }
}

function getLoadImage(nowSize,allSize){
    var size = parseInt(nowSize/allSize*100);
    var html = '<div style="width:250px;height:15px;background-color: gray">';
    html += '<div style="width:'+size+'%;height:15px;background:url(/images/uploadload.gif) repeat-x 0px;  position:relative; ">&nbsp;</div>';
    html += '</div>';
    $("#divLoadLine").html(html);
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

		var progressCancel = document.createElement("a");
		progressCancel.className = "progressCancel";
		progressCancel.href = "#";
		progressCancel.style.visibility = "hidden";
		progressCancel.appendChild(document.createTextNode(" "));

		var progressText = document.createElement("div");
		progressText.className = "progressName";
		progressText.appendChild(document.createTextNode(file.name));

		var progressBar = document.createElement("div");
		progressBar.className = "progressBarInProgress";

		var progressStatus = document.createElement("div");
		progressStatus.className = "progressBarStatus";
		progressStatus.innerHTML = "&nbsp;";

		this.fileProgressElement.appendChild(progressCancel);
		this.fileProgressElement.appendChild(progressText);
		this.fileProgressElement.appendChild(progressStatus);
		this.fileProgressElement.appendChild(progressBar);

		this.fileProgressWrapper.appendChild(this.fileProgressElement);

		document.getElementById(targetID).appendChild(this.fileProgressWrapper);
		fadeIn(this.fileProgressWrapper, 0);

	} else {
		this.fileProgressElement = this.fileProgressWrapper.firstChild;
		this.fileProgressElement.childNodes[1].firstChild.nodeValue = file.name;
	}

	this.height = this.fileProgressWrapper.offsetHeight;

}
FileProgress.prototype.setProgress = function (percentage) {
	this.fileProgressElement.className = "progressContainer green";
	this.fileProgressElement.childNodes[3].className = "progressBarInProgress";
	this.fileProgressElement.childNodes[3].style.width = percentage + "%";
};
FileProgress.prototype.setComplete = function () {
	this.fileProgressElement.className = "progressContainer blue";
	this.fileProgressElement.childNodes[3].className = "progressBarComplete";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setError = function () {
	this.fileProgressElement.className = "progressContainer red";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setCancelled = function () {
	this.fileProgressElement.className = "progressContainer";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setStatus = function (status) {
	this.fileProgressElement.childNodes[2].innerHTML = status;
};

FileProgress.prototype.toggleCancel = function (show, swfuploadInstance) {
	this.fileProgressElement.childNodes[0].style.visibility = show ? "visible" : "hidden";
	if (swfuploadInstance) {
		var fileID = this.fileProgressID;
		this.fileProgressElement.childNodes[0].onclick = function () {
			swfuploadInstance.cancelUpload(fileID);
			return false;
		};
	}
};
