<form action="" method="post" enctype="multipart/form-data" style="border: 1px solid blue" onsubmit="return checkForm()">
    <table width="100%" style="line-height: 30px" border="0">
        <tr>
            <td colspan="2">上传的文件格式为：jpg、jpeg、gif、png，且小于2M</td>
        </tr>
        <tr style="height:50px">
            <td colspan="2">
                <input type="file" name="uploadFile" id="uploadFile"/>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="上传" /></td>
            <td><input type="button" value="取消" onclick="cancel()"/></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
function cancel(){
    window.parent.closetip();
}
function checkForm(){
    var patn = /\.jpg$|\.jpeg$|\.gif$|\.png$/i;
    if($("#uploadFile").val()==""){
        alert("请选择文件！");
        return false;
    }
    if(patn.test($("#uploadFile").val())){
        return true;
    }else{
        alert("不支持此文件格式上传！");
        return false;
    }
}
</script>