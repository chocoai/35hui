//下面的房源只能用在首页滚动房源处
$(".slider li").live("click",function (){
    $(this).siblings().removeClass();
    $(this).addClass("current");
    ChangeIndexScroll(this);
});
$(".slider li").first().removeClass()
                    .addClass("current");