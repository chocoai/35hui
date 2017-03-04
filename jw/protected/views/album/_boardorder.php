<div class="hymain" style="border:none;" id="orderdiv">
    <div class="redtit">
        <div class="rq"><a href="javascript:;" va="today">今日</a><a href="javascript:;" va="week">本周</a><a href="javascript:;" va="month">本月</a></div>
			金窝红榜
    </div>
</div>
<div class="red_main" >
    <div id="orderdiv_today" class="orderinfo" style="display: none">
        <center><img src="/images/loading.gif" /></center>
    </div>
    <div id="orderdiv_week" class="orderinfo" style="display: none">
        <center><img src="/images/loading.gif" /></center>
    </div>
    <div id="orderdiv_month" class="orderinfo" style="display: none">
        <center><img src="/images/loading.gif" /></center>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#orderdiv a").click(function(){
            $("#orderdiv a").each(function(){
                $(this).removeClass("clk");
            })
            $(this).addClass("clk");
            //隐藏div
            $(".red_main .orderinfo").each(function(){
                $(this).css("display","none");
            })
            var va = $(this).attr("va");
            $("#orderdiv_"+va).css("display","");
            var length = $("#orderdiv_"+va+" > center").length;
            if(length==1){//为一的时候表明还没有获取过信息
                $.post("/userspeak/getboardorder", {"va":va,"view":"/album/_boardorderview"}, function(msg){
                    $("#orderdiv_"+va).html(msg);
                }, "html");
            }
        }).first().click()
    });
</script>