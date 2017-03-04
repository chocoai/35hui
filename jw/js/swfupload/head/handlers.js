function swfUploadLoaded() {
    var btnSubmit = document.getElementById("submitHeadPicBtn");
    $(btnSubmit).children("img").click(doSubmit)
}
function doSubmit(e) {
    var txtFileName = document.getElementById("txtFileName");
    if (txtFileName.value === "") {
        jw.pop.alert("请选择文件！",{autoClose:1000,icon:2})
        return false;
    }
    try {
        uploadPicShow("show");
        swfu.startUpload();
    } catch (ex) {

    }
    return false;
}
function uploadPicShow(type){
    if(type=="show"){
        $("#fsUploadProgress").css("display","");
        $("#submitHeadPicBtn").css("display", "none");
    }else{
        $("#fsUploadProgress").css("display","none");
        $("#submitHeadPicBtn").css("display", "");
    }
}
function fileQueueError(file, errorCode, message)  {
    try {
        switch (errorCode) {
            case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
                jw.pop.alert("只能选择一张照片！",{autoClose:1000,icon:2})
                return;
            case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
                jw.pop.alert("所选文件超过最大限额！",{autoClose:1000,icon:2})
                return;
            case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                jw.pop.alert("所选文件为空！",{autoClose:1000,icon:2})
                return;
            case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
                jw.pop.alert("所选文件类型不允许上传！",{autoClose:1000,icon:2})
                return;
            default:
                jw.pop.alert("内部错误",{autoClose:1000,icon:2})
                return;
        }
    } catch (e) {
    }
}

function fileQueued(file) {
    try {
        var txtFileName = document.getElementById("txtFileName");
        txtFileName.value = file.name;
    } catch (e) {
    }
}
var pic_now_upload_id = ""
function uploadSuccess(file, serverData) {
    try {
        if (serverData.substring(0, 7) === "FILEID:") {
            pic_now_upload_id = serverData.substring(7);
        } else {
        }
    } catch (ex) {
        this.debug(ex);
    }
}
function uploadComplete(file) {
    if(pic_now_upload_id){
        var href = window.location.href;
        href = href.replace(/\?[\w.=]+$/,"");
        window.location.href = href+"?picid="+pic_now_upload_id;
    }else{
        jw.pop.alert("内部错误，上传失败！",{autoClose:1000,icon:2})
        uploadPicShow("hidden");
    }
}
function uploadError(file, errorCode, message) {
    jw.pop.alert("内部错误，上传失败！",{autoClose:1000,icon:2})
}
