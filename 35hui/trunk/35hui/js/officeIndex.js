 /**
     *按区找房左右切换
     *opt为1前翻 2后翻
     */
    function move(opt){
        if(opt==1){//前翻
            $(".ss_center ul li").slice(0,11).css("display", 'block');
        }else{//后翻
            $(".ss_center ul li").slice(0,11).css("display", 'none');
        }
    }
     function showSection(json,obj){
        if(obj!=null){
            $(".ss_center ul li").children().css("color","black");
            $(obj).css("color","red");
            $(".bzw_left span").text($(obj).text());//改变左边名称
        }else{
            $(".ss_center ul li").children().css("color","black");
            $(".ss_center ul li span").eq(0).css("color","red");
        }
        $.each(json,function(i,n){
            var html = "<li>";
            html += "<a href='#' onclick='searchByPosition("+n["re_id"]+")'><font color=green>"+n["re_name"]+"</font></a></li>";
            $(".ls_wz2 ul").append(html);
        });
    }
     /**
     * 二手房4个tab切换
     */
    function changehtml(showid,hiddenid){
        $(".cs_left .changehtml"+showid).css("display","none");
        $(".cs_left .changehtml"+hiddenid).css("display","block");
        $("#changetitle"+hiddenid).removeClass("cz_title").addClass("white_title");
        $("#changetitle"+showid).removeClass("white_title").addClass("cz_title");
    }

     /**
     * 按标志物找房。切换头部出租出售样式
     */
    function findoffice(obj,type){
        if(type==1){
            $(obj).next().css("color",'black');
        }else{
            $(obj).prev().css("color",'black');
        }
        $(obj).css("color",'red');
        $("#biaozhi_sellorrent").val(type);
    }
var index = 0;
function setTab(){
    $("#tc_bar li").eq(index).addClass('red_bg').siblings().removeClass('red_bg');
    $("#tc_ader_content>div").eq(index).show().siblings().hide();
    index++;
    if(index == 4)
        index = 0;
}
$(function () {
    $("#tc_ader_content>div").eq(1).show()
    var t = setInterval("setTab()",3000);
    $("#floatad-winpop").slideDown("slow");
    $("#close_tc").click(function(){
        $("#floatad-winpop").slideUp("normal");
    });
    $("#tc_bar li").mouseover(function(){
        index = $("#tc_bar li").index(this);
        $(this).addClass('red_bg').siblings().removeClass('red_bg');
        $("#tc_ader_content>div").eq(index).show().siblings().hide();
        clearTimeout(t);
    }).mouseout(function (){
        t = setInterval("setTab()",3000);
    });
});