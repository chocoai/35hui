sfHover = function() {
    //var sfEls = document.getElementById("navMenu").getElementsByTagName("LI");
    var sfEls = $(".navMenu LI");
    for (var i=0; i<sfEls.length; i++) {
        sfEls[i].onmouseover=function() {
            this.className+=" sfhover";
        }
        sfEls[i].onmouseout=function() {
            this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
        }
    }
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//登录后返回上一页，取得上一页，并上一页检查是否是本站页面
if(location.href.indexOf('site/login')>=0){
    $("#head-login-form").find("#backUrl").attr('value',document.referrer);
}else{
    $("#head-login-form").find("#backUrl").attr('value',location.href);
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
    if(value=="1"){//写字楼
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
function submit_button(){
    $("#headSearchForm").submit();
}
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F306fe6e44f34941fd008214b147aa51d' type='text/javascript'%3E%3C/script%3E"));