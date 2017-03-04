sfHover = function() {
    var sfEls = document.getElementById("navMenu").getElementsByTagName("LI");
    for (var i=0; i<sfEls.length; i++) {
        sfEls[i].onmouseover=function() {
            this.className+=" sfhover";
        }
        sfEls[i].onmouseout=function() {
            this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
        }
    }
}

 $("#fmc").mouseover(function(){
    $("#mMenucc").attr("class","show sct_cont");
}).mouseout(function(){
    $("#mMenucc").attr("class","hidden sct_cont");
});

function ChangeHtml(value){
    var html = $("#mMenucc p").eq(parseInt(value)-1).children("a").html();
    $("#mConc").children("span").html(html);
    $("#mMenucc").attr("class","hidden sct_cont");
    $("#form_type").val(value);
    if(value=="1"){//住宅
        $("#zsc a").eq(0).addClass("clk_sear");
    }else{
        $("#zsc span").children("a").attr("class","");
    }
}
function ChangeSelect(value){
    if($("#form_type").val()==1){
        $("#zsc a").removeClass("clk_sear").eq(parseInt(value)-1).addClass("clk_sear");
        $("#form_sellorrent").val(value);
    }
}