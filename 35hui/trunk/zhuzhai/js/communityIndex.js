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
function changehtml(showid,hiddenid){
    $(".cs_left .changehtml"+showid).css("display","none");
    $(".cs_left .changehtml"+hiddenid).css("display","block");
    $("#changetitle"+hiddenid).removeClass("cz_title").addClass("white_title");
    $("#changetitle"+showid).removeClass("white_title").addClass("cz_title");
}