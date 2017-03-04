function searchMenuInputCheck(obj){
    var all = $(obj).parent("div").find(":text");
    if($(all).eq(0).val()!=""||$(all).eq(1).val()!=""){
        $(obj).parent("div").find(":button").css("display","");
    }else{
        $(obj).parent("div").find(":button").css("display","none");
    }
}
function searchShowInputButton(obj){
    $(obj).parent("div").find(":button").css("display","");
}
function searchMenuInput(obj,tmpUrl){
    var dom = $(obj).parent().find("input");
    var start = $.trim($(dom).eq(0).val());
    var end = $.trim($(dom).eq(1).val());
    if(isNaN(start)){
        $(dom).eq(0).val("");
        return false;
    }
    if(isNaN(end)){
        $(dom).eq(1).val("");
        return false;
    }
    if(start&&end&&start>end){
        alert("输入错误，请重新输入！");
        return false;
    }
    var tmpStart = "";
    if(start){
        tmpStart = $(dom).eq(0).attr("name")+start;
    }
    var tmpEnd = "";
    if(end){
        tmpEnd = $(dom).eq(1).attr("name")+end;
    }
    var href = tmpUrl;
    if(start&&end){
        href += tmpStart+"-"+tmpEnd;
    }else{
        href += tmpStart+tmpEnd;
    }
    window.location.href=href;
    return true;
}