<style type="text/css">
    .pager{
        clear: both;
        padding-top: 10px;
        padding-right: 10px
    }
</style>
<form action="" method="post">
    <table width="100%" border="0">
        <tr>
            <td width="50%">
                楼盘名称：<input type="text" name="buildName" value="<?=$buildName?>"/>
            </td>
            <td align="left">
                <input type="submit" value="搜索" />
            </td>
        </tr>
    </table>
</form>

<div style="margin-left: 10px;margin-top: 10px">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_recommendframelist',
        'summaryText'=>'',
        'summaryCssClass'=>'',
    ));
    ?>
</div>
<script type="text/javascript">
    function choosesource(sourceid) {
        if(confirm("确定要把此房源放在此位置吗？")){
            $.ajax({
                type: "GET",
                url: "<?php echo Yii::app()->createUrl('/officebaseinfo/doproduct');?>",
                data:"pgid=<?php echo $pgid?>&sourceid="+sourceid,
                async: false,
                success:function(msg){
                    alert("设置成功");
                    window.parent.location.reload();
                }
            });
        }
    }
</script>
