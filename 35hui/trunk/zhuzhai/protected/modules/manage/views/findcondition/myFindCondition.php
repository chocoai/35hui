<?php
$this->breadcrumbs=array(
        '我的买房条件',
);?>
<div class="htit"><?=$preTitle;?></div>
<div class="jifentit">查看
    <?=CHtml::dropDownList(
            'officeType',
            $officeType,
            Findcondition::$officeTypeDes,
            array(
            'prompt'=>"所有",
            'options'=>array('id'=>'officeType',),
            )
            )?>
    买房条件
</div>

<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="10%" class="tit">房源类型</td>
            <td width="60%" class="tit">找房条件</td>
            <td width="15%" class="tit">保存时间</td>
            <td width="10%" class="tit">&nbsp;</td>
        </tr>
        <?php
        foreach($dataProvider->getData() as $data){
            $this->renderPartial('_list', array('data'=>$data));
        }
        ?>
    </table>
</div>
<div class="jefenpage">
    <?php
    $this->widget('CLinkPager',array(
            'pages'=>$dataProvider->pagination,
            "htmlOptions"=>array("style"=>"float:right"),
    ));
    ?>
</div>

<script type="text/javascript">
    var url = "<?=Yii::app()->createUrl('/manage/findcondition/myFindCondition');?>";
    $("#officeType").bind("change", function(){
        var sr = "<?=$sr?>";
        var menu = "<?=$sr==Housecollect::rent?"2_2":"1_2"?>";
        var officeType = $(this).val();
        window.location.href=url+"/officeType/"+officeType+"/sr/"+sr+"/menu/"+menu;
    });
</script>