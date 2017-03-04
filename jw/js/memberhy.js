$(document).ready(function(){
    $("#userboarddiv a").bind("click",function(){
        var info = $(this).attr("tp")
        $.post("/userboard/create",{
            'info':info
        },function(msg){
            if(msg=="success"){
                jw.pop.alert("打牌成功！",{
                    autoClose:1000
                });
                setTimeout(function(){
                    window.location.reload()
                    },1000);
            }else{
                jw.pop.alert(msg,{
                    autoClose:1000,
                    icon:2
                })
            }
        },"text");
    });
});
function addAttention(id){
    $.post("/attention/create",{
        'id':id
    },function(msg){
        if(msg=="success"){
            jw.pop.alert("添加关注成功！",{
                autoClose:1000
            });
        }else{
            jw.pop.alert(msg,{
                autoClose:1000,
                icon:2
            })
        }
    },"text");
}
function addGoldHome(id){
    $.post("/goldhome/create",{
        'id':id
    },function(msg){
        if(msg=="success"){
            jw.pop.alert("成功添加至我的金屋！",{
                autoClose:1000
            });
        }else{
            jw.pop.alert(msg,{
                autoClose:1000,
                icon:2
            })
        }
    },"text");
}
function showCompanyDescribe(id){
    var html = $("#"+id).html();
    jw.pop.tip(html)
}