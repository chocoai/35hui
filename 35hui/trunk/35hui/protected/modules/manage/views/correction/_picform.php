<style type="text/css">
.upic{float: left;height: 130px;overflow: hidden;padding: 5px 10px;width: 110px;}
.btnDiv{ height: 35px; overflow: hidden; position: absolute; cursor: pointer; width: 105px; margin: 0px; padding: 0px;}
.single_up{ width:20; height:10; size:0;border:0; background-color:#fff;filter:alpha(opacity=0);-moz-opacity:0; opacity:0; margin:0;  padding:0; font-size:80px;  margin-left:-330px;  cursor:pointer;}
.single_up_btn{ border: 0px; color: white; cursor: pointer; font-weight: bold; height: 35px;  padding-top: 18px; width: 105px; background:url(<?=IMAGE_URL?>/dzup.gif) no-repeat ;}
#uploadframeform{height: 30px}
</style>
<?php $picType = array("2"=>"外景图","1"=>"平面图","3"=>"室内图")?>
<form action="/manage/correction/uploadpic" method="post" target="upload_one_pic" enctype="multipart/form-data" id="uploadframeform">
    <div class="btnDiv">
        <input size="4" class="single_up" type="file" onchange="return onePicFileDialog()" id="picfile" name="Filedata">
    </div>
    <input type="button" class="single_up_btn" />
    <span id="message" style="display:none" >
        <font style='color:red'>上传中</font><img src='<?=IMAGE_URL?>/uploadPicLoad.gif' />
    </span>
</form>
<iframe name="upload_one_pic" id="upload_one_pic" style="display:none"></iframe>
<div style="width:100%" id="allPics"></div>
<div style="display:none" id="templetePic">
    <div class="upic" attr="">
        <img src="" height="80" width="110" />
        <div class="line">
            <font style="color:blue;cursor:pointer" onClick="delDiv(this)">删除</font>&nbsp;&nbsp;<?=CHtml::dropDownList("picType","",$picType)?>
        </div>
    </div>
</div>

<script type="text/javascript">
/**
 *验证文件是否可以上传并判断是否达到上传最大数木
 */
function onePicFileDialog(){
    //判断是否达到最大数
    if($("#allPics").children().length>7){
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
function uploadOnePicSuccess(pic){
    $("#picfile").val("");
    $("#picfile").css("display", "");
    $("#message").css("display", "none");
    $("#templetePic div").attr("attr",pic);
    var array = pic.split(".");
    var viewPic = "<?=PIC_URL?>"+array[0]+"_small."+array[1];
    $("#templetePic div img").attr("src",viewPic);
    $("#allPics").append($("#templetePic").html());
    resetFrameHeight()
}
function uploadOnePicFalse(){
    alert("上传失败！图片最大只能是2M！")
    $("#picfile").val("");
    $("#picfile").css("display", "");
    $("#message").css("display", "none");
}
function delDiv(obj){
    $(obj).parent().parent().remove();
    resetFrameHeight()
}
</script>