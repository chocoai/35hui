function show_punlun_div(domId){
    getOneDynamicComment(domId,false);
}
function getOneDynamicComment(domId,check){
    if(!check){
        if($("#"+domId+" .punlun").css("display")=="none"){
            $("#"+domId+" .punlun").css("display","");
        }else{
            $("#"+domId+" .punlun").css("display","none");
            return false;
        }
    }
    var html = $("#"+domId+" .punlun").html();
    var attr = $("#"+domId).attr("attr");
    if(html==""||check){//获取评论
        $("#"+domId+" .punlunloading").css("display","");
        $.post("/my/comment/getcomment",{
            "domId":domId,
            "attr":attr
        },function(msg){
            $("#"+domId+" .punlun").html(msg);
            $("#"+domId+" .punlunloading").css("display","none");
        },"html");
    }
    return true;
}
$(".huifu_div").live("mousemove",function(){
    $(this).css("border-color","blue");
}).live("mouseout",function(){
    $(this).css("border-color","gray");
}).live("click",function(){
    var punlunDomId = $(this).parent().attr("id");
    
    $("#"+punlunDomId).children(".huifu_div").css("display","none");
    var hiddObj = $("#"+punlunDomId).children(".huifu_div");
    show_comment_area(punlunDomId, 0,hiddObj);
});
function huifu_punlun(dynamicDomId,speakcommentid){
    var punlunDomId = dynamicDomId+"_"+speakcommentid+"_huifu";
    var hiddObj = $("#"+dynamicDomId+"_punlun");
    $(hiddObj).css("display","none");
    show_comment_area(punlunDomId,speakcommentid,hiddObj);
}
var show_Punlun_Dom_Id = "";
function show_comment_area(punlunDomId,commentId,hiddObj){
    if(show_Punlun_Dom_Id){
        $("#"+show_Punlun_Dom_Id).children(".huifu_area").html("");
        if($("#"+show_Punlun_Dom_Id).children().length>1){
            $("#"+show_Punlun_Dom_Id).children(".huifu_div").css("display","");
        }else{
            var newPunlunInfoArr = show_Punlun_Dom_Id.split("_");
            var newPunlunInfo = newPunlunInfoArr[0]+"_"+newPunlunInfoArr[1]+"_punlun";
            $("#"+newPunlunInfo).css("display","");
        }
    }
    var dom = $("#"+punlunDomId).children(".huifu_area");
    var info = $("#"+punlunDomId).children(".huifu_area").attr("attr");
    $(dom).css("display","block");
    $(dom).html('<form onsubmit="return check_comment_form(this)" method="post">\n\
        <textarea style="width: 500px;" class="taxt" name="content"></textarea><br />\n\
        <input name="info" value="'+info+'" type="hidden"/>\n\
        <input name="punlunDomId" value="'+punlunDomId+'" type="hidden" />\n\
        <input type="submit" value="发表" class="btn_02"/></form>');
    $(dom).find("textarea").focus();
    $(dom).find("textarea").blur(function(){
        if($.trim($(this).val())==""){
            $(hiddObj).css("display","block");
            $(dom).html("");
        }else{
            show_Punlun_Dom_Id = punlunDomId;
        }
    })
}
function check_comment_form(obj){
    $.post("/my/comment/create",$(obj).serialize(),function(msg){
        if(msg!="error"){
            jw.pop.alert("评论成功",{
                autoClose:1000,
                icon:1
            })
            setTimeout(function(){
                var info = msg.split("|");
                getOneDynamicComment(info[0],true);
                if(info[1]==0){//增加评论数
                    $("#"+info[0]).find(".punlun_btn .scpunlun").html(parseInt($("#"+info[0]).find(".punlun_btn .scpunlun").html())+1)
                }
            },1000);
        }
    },"text");
    return false;
}