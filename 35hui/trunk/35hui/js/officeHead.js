$(".container .nav ul li").bind("mouseenter",function(){
    var obj = $(this).children(".tnav");
    if($(obj).length){
        $(this).removeClass("clk");
        $(this).addClass("clkhover");
        $(obj).css("display","");
    }
}).bind("mouseleave",function(){
    var obj = $(this).children(".tnav");
    if($(obj).length){
        $(this).addClass("clk");
        $(this).removeClass("clkhover");
        $(obj).css("display","none");
    }
});