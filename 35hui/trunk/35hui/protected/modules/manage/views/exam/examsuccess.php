<?php
$this->breadcrumbs=array(
        '考试',
);
?>
<div class="htit">考试</div>
<div class="rgcont">
    <table class="table_01">
    <tr>
        <td  class="itit" style=" text-align: left;" > 考试完成！您本次答题正确&nbsp;&nbsp;<em class="red"><?=$zhque?></em>&nbsp;&nbsp;道，错误&nbsp;&nbsp;<em class="red"><?=10-$zhque?></em>，本次得分&nbsp;&nbsp;<em class="red"><?=$zhque*2?></em>，最高得分&nbsp;&nbsp;<em class="red"><?=$maxNum?></em></td>
    </tr>
    <?php
    if($nextArr){
        $keys = array_keys($nextArr);
        echo "<tr><td class='ks'><b>您可以选择：</b></td></tr>";
        echo "<tr><td class='ks'>".CHtml::radioButtonList("select",$keys[0],$nextArr)."</td></tr>";
        echo "<tr><td class='ks'>".CHtml::link("继续答题","#",array("onClick"=>"nextExam()"))."</td></tr>";
    }
    ?>
    </table>
    <div style="clear:both"></div>
</div>
<script type="text/javascript">
    function nextExam(){
        var type = $("input:checked").val();
        var url = "/manage/exam/beginexam/type/"+type;
        window.location.href=url;
        
    }
</script>