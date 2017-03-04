<?php
$this->breadcrumbs=array(
        '考试',
);
?>
<div class="htit">考试</div>
<div class="rgcont">
    <table class="table_01">
        <tr>
            <td colspan="4" class="itit" style=" text-align: left;"> 总分(满分100)：<font color="red"><?=$uagent->ua_source?></font></td>
        </tr>
        <?php
        foreach(Examchoice::$ec_type as $key=>$value){
            $info = Exam::model()->getExamInfoByType($model, $key);
            ?>
        <tr>
            <td width="25%"><font color="black"><?=$value?>(满分20)</font></td>
            <td width="25%"><font color="black"><?=$info["source"]?>分</font></td>
            <td width="25%">
                <?php
                if(Exam::model()->checkCanExam($info['examtime'])){
                    echo CHtml::link("开始答题",array("exam/beginexam","type"=>$key));
                }else{
                    echo "明天再来";
                }
                ?>
            </td>
            <td width="25%">
                <?=Examdescribe::model()->getDescribtionByPointAndType($key, $info["source"])?>
            </td>
        </tr>
            <?php
        }
        ?>
    </table>
</div>
