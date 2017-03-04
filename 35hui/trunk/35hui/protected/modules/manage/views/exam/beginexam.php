<?php
$this->breadcrumbs=array(
        '考试',
);
?>
<div class="htit"><span style="float:right; padding-right: 10px; font-weight: normal; color: #f0f0f0;">剩余答题时间 <font size="3" color="red" id="time"></font></span>考试</div>
<div class="rgcont">
    
    <form action="" method="post">
        <?php
        foreach($allExam as $key=>$value){
        ?>
        <table border="0" cellpadding="0" cellspacing="0" class="table_01" style="display:none">
                <?php
                $choice = Examchoice::model()->RandomChoice($value);
                echo '<tr><td class="ftit" style="text-align:left">'.($key+1)."、".$value->ec_question.'</td></tr>';
                echo "<tr><td class='ks'>".CHtml::radioButtonList("answer[".($key+1)."]","",$choice[0]).CHtml::hiddenField("qid[".($key+1)."]",$choice[1].$value->ec_id)."</td></tr>";
                ?>
        </table>
        <?php
        }
        ?>
        <div style="margin-top: 10px">
            <input type="button" value="上一题" id="btn_pre"/>
            <input type="button" value="下一题" id="btn_next" />第<font id="questNum">1</font>/<?=count($allExam);?>题
            <input type="submit" value="完成" id="btn_submit"/>
        </div>
    </form>
</div>
<script type="text/javascript">
    var maxTime = <?=Oprationconfig::model()->getConfigByName("ua_exam_time", 0)?>;
    var timeId;
    $(document).ready(function(){
        $("form table").eq(0).css("display","");
        $("#btn_pre").attr("disabled",true);
        $("#btn_submit").css("display","none");
        $("#btn_pre").bind("click", "", function(){
            if(checkAnswer()){
                showQuestion("pre");
            }
        });
        $("#btn_next").bind("click", "", function(){
            if(checkAnswer()){
                showQuestion("next");
            }
        });
        //计时器
        $("#time").html(getShowTime());
        timeId = window.setInterval("time()", 1000);
    });
    function time(){
        maxTime--;
        if(maxTime==-1){
            window.clearInterval(timeId);
            if(confirm("答题时间结束，是否保存成绩？")){
                $("form").submit();
            }else{
                window.location.href="/manage/exam/index";
            }
        }else{
            $("#time").html(getShowTime());
        }
    }
    function getShowTime(){
        var m = parseInt(maxTime/60);
        var s = maxTime%60;
        s = "00"+s;
        s = s.charAt(s.length-2)+s.charAt(s.length-1);
        return m+":"+s;
    }
    function checkAnswer(){
        var check = $("form table").eq(parseInt($("#questNum").html())-1).find("input:checked").val();
        if(typeof(check)=="undefined"){
            alert("请选择答案！");
            return false;
        }else{
            return true;
        }
    }
    function showQuestion(type){
        if(type=="next"){
            $("#questNum").html(parseInt($("#questNum").html())+1);
        }else{
            $("#questNum").html(parseInt($("#questNum").html())-1);
        }
        var nowNum = $("#questNum").html();
        var maxNum = <?=count($allExam);?>;
        if(nowNum==1){
            $("#btn_pre").attr("disabled",true);
        }else{
            $("#btn_pre").attr("disabled",false);
        }
        if(nowNum==maxNum){
            $("#btn_next").attr("disabled",true);
            $("#btn_submit").css("display","");
        }else{
            $("#btn_next").attr("disabled",false);
            $("#btn_submit").css("display","none");
        }
        $("form table").css("display","none");
        $("form table").eq(parseInt(nowNum)-1).css("display","");


        resetFrameHeight();
    }
</script>
<script language=javascript type="text/javascript">
    <!--
    document.oncontextmenu=new Function('event.returnValue=false;');
    document.onselectstart=new Function('event.returnValue=false;');
    -->
</script>