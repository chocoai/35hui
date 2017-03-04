<?php
$this->breadcrumbs=array(
        '付币服务',
        '积分记录'
);
?>
<div class="htit">我的积分</div>
<div class="jifentit">
    <div class="ji_01">总积分：<em class="red"><?=$userProperty->m_point?></em> 　　会员级别<?php echo User::model()->getUserLevelByUserId(Yii::app()->user->id);?></div>
  　<div class="ji_02">
       本日获取：<em class="red"><?=$userProperty->m_todaypoint?></em>　
       每日获取积分上限：<em class="red"><?=Oprationconfig::model()->getConfigByName("oneday_get_max_point",0)?></em>
    <a href="/help/money" target="_blank">查看积分规则</a>
    <a href="#" onclick="clearLog('<?=Log::integral?>')">清除陈旧记录</a></div>
</div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="20%" class="tit">日期</td>
            <td width="10%" class="tit">积分</td>
            <td width="70%" class="tit">说明</td>
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