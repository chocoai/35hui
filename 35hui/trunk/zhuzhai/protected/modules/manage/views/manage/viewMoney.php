<?php
$this->breadcrumbs=array(
        '付币服务',
        '查看消费记录'
);
?>
<div class="htit">我的新币</div>
<div class="jifentit">当前的新币：<em class="red"><?=$userMoney?></em>
    <a href="/manage/buycombo/index">充值</a>
    <a href="/help/money" target="_blank">如何获取新币</a>
    <a href="#" onclick="clearLog('<?=Log::money?>')">清除陈旧记录</a></div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="20%" class="tit">日期</td>
            <td width="21%" class="tit">新币明细</td>
            <td width="59%" class="tit">说明</td>
        </tr>
        <?php
        foreach($dataProvider->getData() as $data){
            $this->renderPartial('_log', array('data'=>$data));
        }
        ?>
    </table>
</div>
<div class="jefenpage">
    <?php
    echo "<div style='clear:both; height:35px; padding-top:15px;'>";
        $this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
        "htmlOptions"=>array("style"=>"float:right"),
        ));
    ?>
</div>
<script type="text/javascript">
    function clearLog(type){
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createUrl("/manage/log/ajaxClearLog");?>',
            data: {"type":type},
            success: function(msg){
                if(msg==1){
                    alert("清除成功");
                    window.location.reload();
                }else if(msg==3){
                    alert("请先登录");
                    window.location.reload();
                }else{
                    alert("清除失败");
                }
            }
        });
    }
</script>