<div class="hyright">
    <div class="hyrtit" id="orderdiv">
        <ul>
            <li va="today"><a href="javascript:;">今日</a></li>
            <li va="week"><a href="javascript:;">本周</a></li>
            <li va="month"><a href="javascript:;">本月</a></li>
        </ul>
		红牌榜
    </div>
    <div id="orderdiv_today" class="orderinfo" style="display: none">
        <center><img src="/images/loading.gif" /></center>
    </div>
    <div id="orderdiv_week" class="orderinfo" style="display: none">
        <center><img src="/images/loading.gif" /></center>
    </div>
    <div id="orderdiv_month" class="orderinfo" style="display: none">
        <center><img src="/images/loading.gif" /></center>
    </div>
    <div class="hymore"><a href="<?=Yii::app()->createUrl("/member/list");?>">查看更多</a></div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#orderdiv li").click(function(){
            $("#orderdiv li").each(function(){
                $(this).removeClass("clk");
            })
            $(this).addClass("clk");
            //隐藏div
            $(".hyright .orderinfo").each(function(){
                $(this).css("display","none");
            })
            var va = $(this).attr("va");
            $("#orderdiv_"+va).css("display","");
            var length = $("#orderdiv_"+va+" > center").length;
            if(length==1){//为一的时候表明还没有获取过信息
                $.post("/userspeak/getboardorder", {"va":va,"view":"_boardorderview"}, function(msg){
                    $("#orderdiv_"+va).html(msg);
                }, "html");
            }
        }).first().click()
    });
</script>