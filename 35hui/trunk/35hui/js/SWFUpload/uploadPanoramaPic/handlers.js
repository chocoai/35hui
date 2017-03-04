var maxUploadNum = 28;
function fileQueueError(file, errorCode, message) {
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
        var nowNum = parseInt($("#nowUploadPicNum").html());
        if(nowNum+numFilesSelected>maxUploadNum){
            var cunUploadNum = maxUploadNum - nowNum;
            if(cunUploadNum==0){
                alert("您已经达到了上传图片的最大数，不能再继续上传");
            }else{
                alert("您只能再继续上传"+cunUploadNum+"张全景图片");
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
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
}
function onePicFileDialog(){
    //判断是否达到最大数
    if(parseInt($("#nowUploadPicNum").html())>=maxUploadNum){
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
    var length = parseInt($("#thumbnails .onePicture").length)
    if(length%4==0){
        var houseNum = parseInt($("#houseNum").html())+parseInt($("#thumbnails .newHouse").length)+1;
        var headHtml = "";
        if($("#thumbnails .newHouse").length!=0){
            headHtml += "<div style='clear:both;border-top: 1px dotted gray;width:500px;margin-bottom:10px' class='splitborder'></div>";
        }
        headHtml += "<div style='width:100%;margin-bottom:5px;paddint-top:10px;' class='newHouse'>房间"+houseNum+"：";
        headHtml += '<input type="text" name="panoramaname[]" />&nbsp;<font style="color:red"></font></div>'
        $("#thumbnails").append(headHtml);
    }

    var html = '<div style="width: 130px;float: left;margin-bottom:10px;margin-left:20px;border:1px gray solid;text-align:center" class="onePicture">';
    html += '<input type="hidden" name="panoramapic[]" value="'+src+'" class="panoramapic"/>';

    html += '<div style="margin-top:5px;">';
    html += '<div style="clear:both;margin-bottom:5px"><img src="'+src+'" width="100px" height="75px"/></div>';
    html += '<div style="width:50px;float: left;cursor: pointer" onclick="del(this)">';
    html += '<img src="/images/map_colsetitle14.gif" border="0" title="删除" />';
    html += '</div>';
    html += '<div style="width:80px;float: right;cursor: pointer">';
    html += '<img src="/images/change_left.gif" border="0" title="左移" onClick="moveLeft(this)"/>&nbsp;';
    html += '<img src="/images/change_right.gif" border="0" title="右移" onClick="moveRight(this)" />';
    html += '</div>';
    html += '</div>';
    
    html += '</div>';
    
    $("#thumbnails").append(html);
    
    $("#nowUploadPicNum").html(parseInt($("#nowUploadPicNum").html())+1);//已经上传的图片数加一
    $("#submitButton").css("display","");//显示提交按钮
    resetFrameHeight();
}
function moveLeft(obj){
    var leftEq = parseInt($(obj).parents(".onePicture").prevAll(".onePicture").length)-1;
    var nowHtml = $(obj).parents(".onePicture").html();
    if(leftEq!="-1"){
        var leftHtml = $("#thumbnails .onePicture").eq(leftEq).html();
        $("#thumbnails .onePicture").eq(parseInt($(obj).parents(".onePicture").prevAll(".onePicture").length)-1).html(nowHtml);//左边位置
        $(obj).parents(".onePicture").html(leftHtml);//当前位置
    }
    
}
function moveRight(obj){
    var rightEq = parseInt($(obj).parents(".onePicture").prevAll(".onePicture").length)+1;
    var nowHtml = $(obj).parents(".onePicture").html();
    var rightHtml = $("#thumbnails .onePicture").eq(rightEq).html();
    if(rightHtml){
        $("#thumbnails .onePicture").eq(rightEq).html(nowHtml);//右边位置
        $(obj).parents(".onePicture").html(rightHtml);//当前位置
    }
}
function del(obj){
    var allLength = parseInt($("#thumbnails .onePicture").length);
    var nowAt = parseInt($(obj).parents(".onePicture").prevAll(".onePicture").length)+1;
    for(var i=nowAt;i<allLength;i++){
        var tmp = $("#thumbnails .onePicture").eq(i-1).html();//当前要删除的dom
        $("#thumbnails .onePicture").eq(i-1).html($("#thumbnails .onePicture").eq(i).html());//下一个dom移动到当前位置
        $("#thumbnails .onePicture").eq(i).html(tmp);//下一个位置放当前dom
    }
    //已经保证了要删除的dom位于最后面
    //删除图片
    var delPic = $("#thumbnails .onePicture").eq(allLength-1).children(".panoramapic").val();
    $.ajax({
        url:"/imageinfo/deleatepanoramaimage",
        type:"POST",
        data:{"delPic":delPic},
        success:function(){
        }
    });
    //删除dom。
    $("#thumbnails .onePicture").eq(allLength-1).remove();
    //候判断dom的上个一是否是房间名称。是就要连房间名称一起删除
    if($("#thumbnails").children().last().attr("class")=="newHouse"){
        $("#thumbnails").children().last().remove();
        $("#thumbnails").children().last().remove();
    }
    $("#nowUploadPicNum").html(parseInt($("#nowUploadPicNum").html())-1);//已经上传的图片数减一

    if($("#thumbnails .onePicture").length==0){
        $("#submitButton").css("display","none");//隐藏提交按钮
    }else{
        $("#submitButton").css("display","");//显示提交按钮
    }
    
}
function getLoadImage(nowSize,allSize){
    var size = parseInt(nowSize/allSize*100);
    var html = '<div style="width:250px;height:15px;background-color: gray">';
    html += '<div style="width:'+size+'%;height:15px;background:url(/images/uploadload.gif) repeat-x 0px;  position:relative; ">&nbsp;</div>';
    html += '</div>';
    $("#divLoadLine").html(html);
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
