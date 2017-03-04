function editAlbum(id){
    var content = "<div id='alertform'>"+$("#albumform").html()+"</div>";
    jw.pop.customtip(
        "编辑相册",
        content,
        {
            hasBtn_ok:true,
            hasBtn_cancel:true,
            zIndex:10000,
            ok: function(){
                var title = $.trim($("#alertform form input[name='title']").val());
                if(title==""){
                    jw.pop.alert("请输入相册标题！",{
                        zIndex:10001,
                        icon:2
                    });
                    return false;
                }
                if(!album_check_form()){
                    return false;
                }
                $.post("/my/album/edit/id/"+id,$("#alertform form").serialize(),function(msg){
                    if(msg!="error"){
                        window.location.reload();
                    }
                },"json")
            },
            btn_float:"center"
        }
        );
    $("#alertform input[name='title']").val($("#info_"+id).find("input[name='title']").val());
    $("#alertform textarea[name='description']").val($("#info_"+id).find("input[name='description']").val());
    var selVal = $("#info_"+id).find("input[name='type']").val();
    $('#alertform select')[0].selectedIndex = $("#alertform option[value='"+selVal+"']").attr("index");
    album_check_inputNum();
    album_check_textareaNum();
}
function createAlbum(addSuccessFun){
    var content = "<div id='alertform'>"+$("#albumform").html()+"</div>";
    jw.pop.customtip(
        "创建相册",
        content,
        {
            hasBtn_ok:true,
            hasBtn_cancel:true,
            zIndex:10000,
            ok: function(){
                var title = $.trim($("#alertform form input[name='title']").val());
                if(title==""){
                    jw.pop.alert("请输入相册标题！",{
                        zIndex:10001,
                        icon:2
                    });
                    return false;
                }
                if(!album_check_form()){
                    return false;
                }
                $.post("/my/album/create",$("#alertform form").serialize(),function(msg){
                    if(msg[0]=="error"){
                        jw.pop.alert(msg[1],{autoClose:1000,icon:2});
                    }else{
                        if(typeof(addSuccessFun)!="undefined"){
                            try{
                                addSuccessFun(msg)
                                }catch(n){}
                        }else{
                            location.href="/my/albumphoto/uploadphoto/id/"+msg[0];
                        }
                    }
                },"json")
            },
            btn_float:"center"
        }
        );
}
function delAlbum(id){
    jw.pop.alert("确定删除该相册吗？",{
        ok: function(){
            $.post("/my/album/del/id/"+id,"",function(){
                window.location.href="/my/album/index";
            },"json")
        },
        hasBtn_ok:true,
        ok_label:'确定',
        hasBtn_cancel:true,
        icon:4
    });
}
function album_check_inputNum(){
    var dom = $("#alertform");
    var n = Math.ceil(txtNum_func($(dom).find("input[name='title']").val())/2);
    $(dom).find(".numShowMsg").eq(0).html(n);
    if(n>15){
        $(dom).find(".numShowMsg").eq(0).css("color","#ff0000")
        $(dom).find("input[name='check_title']").val("0");
    }else{
        $(dom).find(".numShowMsg").eq(0).css("color","");
        $(dom).find("input[name='check_title']").val("1");
    }
}
function album_check_textareaNum(){
    var dom = $("#alertform");
    var n = Math.ceil(txtNum_func($(dom).find("textarea[name='description']").val())/2);
    $(dom).find(".numShowMsg").eq(1).html(n);
    if(n>150){
        $(dom).find(".numShowMsg").eq(1).css("color","#ff0000")
        $(dom).find("input[name='check_description']").val("0");
    }else{
        $(dom).find(".numShowMsg").eq(1).css("color","");
        $(dom).find("input[name='check_description']").val("1");
    }
}
function album_check_form(){
    var check_title = $.trim($("#alertform input[name='check_title']").val());
    var check_description = $.trim($("#alertform input[name='check_description']").val());
    if(check_title==0){
        $("#alertform input[name='title']").css("border-color","#ff0000");
        setTimeout(function(){
            $("#alertform input[name='title']").css("border-color","#D7D5D6");
        },500);
        return false;
    }
    if(check_description==0){
        $("#alertform textarea[name='description']").css("border-color","#ff0000");
        setTimeout(function(){
            $("#alertform textarea[name='description']").css("border-color","#D7D5D6");
        },500);
        return false;
    }
    return true;
}
