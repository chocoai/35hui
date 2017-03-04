<div class="mright">
    <?=$this->renderPartial('_top');?>
    <div class="jbmain">
        <div id="dynamic_my_content"></div>
        <div id="dynamic_my_loading" style="clear: both;width: 100%;text-align: center;display: none"><img src="/images/loading.gif" width="25px"/></div>
</div>
</div>
<script type="text/javascript">
    var canGet = true;
    $(document).ready(function(){
        //查找动态
        getContent();
        var range = 50;             //距下边界长度/单位px
        $(window).scroll(function(){
            var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)
            var dbHiht = $("body").height();          //页面(约等于窗体)高度/单位px
            var mainHiht = $("#dynamic_my_content").height();               //主体元素高度/单位px
            if((srollPos + dbHiht) >= (mainHiht-range)&&canGet){
                getContent();
            }
        });
    });
    function getContent(){
        canGet = false;
        var currentnum = $("#dynamic_my_content").children().length;
        $("#dynamic_my_loading").css("display","block");
        $.post("/my/dynamicmy/getinfo",{"currentnum":currentnum},function(msg){
            if(msg!="zero"){
                $("#dynamic_my_content").append(msg);
                canGet = true;
            }else{
                $("#dynamic_my_content").append("<div style='width:100%;margin-top:10px'><center>已经没有更多的动态了！</center></div>");
                canGet = false;
            }
            $("#dynamic_my_loading").css("display","none");
            
        },"html");
    }
</script>
<?php Yii::app()->clientScript->registerScriptFile('/js/punlun.js',CClientScript::POS_END );?>