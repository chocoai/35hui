var selectGoldHome = "";
$(document).ready(function(){
    $(".beginSplitType").bind("mouseenter", "", function(){
        $(this).css("position","relative");
        $(this).children(".sfgroup").css("display","");
        $(this).children(".sfgroup").html($("#goldhomegroup").html());
        selectGoldHome = $(this).attr("attr");
    }).bind("mouseleave", "", function(){
        $(this).css("position","");
        $(this).children(".sfgroup").css("display","none");
        $(this).children(".sfgroup").html("");
        selectGoldHome = "";
    }).find(".allgoldgroup input[type='checkbox']").live("click",function(){
        var group = $(this).val();
        $.post("/my/goldhome/changegoldgroup", {
            "group":group,
            "goldhome":selectGoldHome
        }, function(){
            window.location.reload();
        },"html");
    });
});
function addnewgoldgroup(){
    $(".beginSplitType .addnewgoldgroup_btn").css("display","none");
    $(".beginSplitType .addnewgoldgroup").css("display","");
}
function cancelnewgoldgroup(){
    $(".beginSplitType .addnewgoldgroup_btn").css("display","");
    $(".beginSplitType .addnewgoldgroup").css("display","none");
}
function savenewgoldgroup(){
    var name = $.trim($(".beginSplitType input[name='newgroupname']").val());
    if(!name){
        $(".beginSplitType input[name='newgroupname']").css("border-color","red");
        setTimeout(function(){
            $(".beginSplitType input[name='newgroupname']").css("border-color","#CCC");
        },500);
    }
    $.post("/my/goldhomegroup/create", {
        "name":name
    }, function(msg){
        if(msg[0]=="success"){
            $.post("/my/goldhome/changegoldgroup", {
                "group":msg[1],
                "goldhome":selectGoldHome
            }, function(){
                window.location.reload();
            },"html");
        }else{
            jw.pop.alert(msg[1],{
                autoClose:1000,
                icon:2
            });
        }
    },"json");
}

function delGoldHome(id){
    jw.pop.alert(
        "确定解除本收藏信息吗？",{
            ok: function(){
                $.post("/my/goldhome/delgoldhome", {
                    "ghid":id
                }, function(){
                    jw.pop.alert("解除收藏成功",{
                        autoClose:1000
                    });
                    setTimeout(function(){
                        window.location.reload();
                    },1000)
                },"html");
            },
            hasBtn_ok:true,
            ok_label:'确定',
            hasBtn_cancel:true,
            icon:4
        }
        );
}
function addNote(id){
    var content = "<div id='alertform'>"+$("#goldhomeaddnote").html()+"</div>";
    jw.pop.customtip("添加备注",content,{
        hasBtn_ok:true,
        hasBtn_cancel:true,
        ok: function(){
            var note = $.trim($("#alertform form input[name='title']").val());
            if(note==""){
                $("#alertform input[name='title']").css("border-color","#ff0000");
                setTimeout(function(){
                    $("#alertform input[name='title']").css("border-color","#D7D5D6");
                },500);
                return false;
            }
            var check_title = $("#alertform form input[name='check_title']").val();
            if(check_title==0){
                $("#alertform input[name='title']").css("border-color","#ff0000");
                setTimeout(function(){
                    $("#alertform input[name='title']").css("border-color","#D7D5D6");
                },500);
                return false;
            }
            $.post("/my/goldhome/addnote",{
                "ghid":id,
                "note":note
            },function(msg){
                if(msg=="error"){
                    jw.pop.alert("备注添加失败！",{
                        autoClose:1000,
                        icon:2
                    });
                }else{
                    jw.pop.alert("备注添加成功！",{
                        autoClose:1000
                    });
                    setTimeout(function(){
                        window.location.reload();
                    },1000);
                }
            },"text")
        },
        btn_float:"center"
    });
    if($("#note_"+id).html()){
        $.trim($("#alertform form input[name='title']").val($("#note_"+id).html()));
    }
}
function goldhomegroupdel(id){
    jw.pop.alert("删除本分组后，分组中的用户将移动至未分组类型，确定吗？",{
        ok: function(){
            $.post("/my/goldhomegroup/del", {
                "id":id
            }, function(){
                jw.pop.alert("删除分组成功",{
                    autoClose:1000
                });
                setTimeout(function(){
                    window.location.reload();
                },1000)
            },"html");
        },
        hasBtn_ok:true,
        ok_label:'确定',
        hasBtn_cancel:true,
        icon:4
    });
}
function goldhomegroupedit(id){
    var content = "<div id='alertform'>"+$("#goldhomegroupedit").html()+"</div>";
    jw.pop.customtip("编辑分组名称",content,{
        hasBtn_ok:true,
        hasBtn_cancel:true,
        ok: function(){
            var name = $.trim($("#alertform form input[name='title']").val());
            if(name==""){
                $("#alertform input[name='title']").css("border-color","#ff0000");
                setTimeout(function(){
                    $("#alertform input[name='title']").css("border-color","#D7D5D6");
                },500);
                return false;
            }
            $.post("/my/goldhomegroup/edit",{
                "id":id,
                "name":name
            },function(msg){
                if(msg=="error"){
                    jw.pop.alert("名称不符合规格！",{
                        autoClose:1000,
                        icon:2
                    });
                }else{
                    jw.pop.alert("分类修改成功！",{
                        autoClose:1000
                    });
                    setTimeout(function(){
                        window.location.reload();
                    },1000);
                }
            },"text")
        },
        btn_float:"center"
    });
}

function sendUserMessage(id){
    var content = "<div id='alertform'>"+$("#usermessageform").html()+"</div>";
    jw.pop.customtip(
        "发送消息",
        content,
        {
            hasBtn_ok:true,
            hasBtn_cancel:true,
            zIndex:10000,
            ok: function(){
                var title = $.trim($("#alertform form input[name='title']").val());
                if(title==""){
                    $("#alertform input[name='title']").css("border-color","#ff0000");
                    setTimeout(function(){
                        $("#alertform input[name='title']").css("border-color","#D7D5D6");
                    },500);
                    return false;
                }
                var check_title = $("#alertform form input[name='check_title']").val();
                if(check_title==0){
                    $("#alertform input[name='title']").css("border-color","#ff0000");
                    setTimeout(function(){
                        $("#alertform input[name='title']").css("border-color","#D7D5D6");
                    },500);
                    return false;
                }
                var content = $.trim($("#alertform form textarea[name='content']").val());
                if(content==""){
                    $("#alertform textarea[name='content']").css("border-color","#ff0000");
                    setTimeout(function(){
                        $("#alertform textarea[name='content']").css("border-color","#D7D5D6");
                    },500);
                    return false;
                }
                var check_content = $("#alertform form input[name='check_content']").val();
                if(check_content==0){
                    $("#alertform textarea[name='content']").css("border-color","#ff0000");
                    setTimeout(function(){
                        $("#alertform textarea[name='content']").css("border-color","#D7D5D6");
                    },500);
                    return false;
                }
                $.post("/my/usermessage/create",{
                    "id":id,
                    "title":title,
                    "content":content
                },function(msg){
                    if(msg=="error"){
                        jw.pop.alert("发送失败！",{
                            autoClose:1000,
                            icon:2
                        });
                    }else{
                        jw.pop.alert("消息发送成功！",{
                            autoClose:1000
                        });
                    }
                },"text")
            },
            btn_float:"center"
        }
        );
}
function message_check_inputNum(){
    var dom = $("#alertform");
    var n = Math.ceil(txtNum_func($(dom).find("input[name='title']").val())/2);
    $(dom).find(".numShowMsg").eq(0).html(n);
    if(n>50){
        $(dom).find(".numShowMsg").eq(0).css("color","#ff0000")
        $(dom).find("input[name='check_title']").val("0");
    }else{
        $(dom).find(".numShowMsg").eq(0).css("color","");
        $(dom).find("input[name='check_title']").val("1");
    }
}
function message_check_textareaNum(){
    var dom = $("#alertform");
    var n = Math.ceil(txtNum_func($(dom).find("textarea[name='content']").val())/2);
    $(dom).find(".numShowMsg").eq(1).html(n);
    if(n>150){
        $(dom).find(".numShowMsg").eq(1).css("color","#ff0000")
        $(dom).find("input[name='check_content']").val("0");
    }else{
        $(dom).find(".numShowMsg").eq(1).css("color","");
        $(dom).find("input[name='check_content']").val("1");
    }
}