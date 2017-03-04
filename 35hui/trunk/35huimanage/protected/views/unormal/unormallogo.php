<?php
$this->breadcrumbs=array(
        '会员管理',
        '普通会员Logo审核'
);
$this->currentMenu = 94;
?>
<table width="100%" style="margin: 0px" >
    <tr>
        <th width="10%">ID</th>
        <th width="10%">用户Id</th>
        <th width="20%">用户Logo</th>
        <th >审核状态</th>
    </tr>
    <tr>
        <td colspan="4"><input type="checkbox" name="select_all" onclick="checkboxSelect(this.checked)">全选
            批量操作 <a href='javascript:auditSelect(1)'>通过</a>&nbsp;/&nbsp;
            <a href='javascript:auditSelect(2)'>未通过</a></td>
    </tr>
<?php
    $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_unormallogo',
            'summaryText'=>'',
            'summaryCssClass'=>'',
    ));
    ?>
</table>
<script type="text/javascript">
    function checkboxSelect(checked){
        $(":checkbox[name='userid[]']").each(function(){
            $(this).attr("checked", checked);
        });
    }
    function auditSelect(check){
        var ids = [];
        $(":checkbox[name='userid[]']").each(function(){
            if($(this).attr("checked"))
                ids.push($(this).val());
        });
        if(ids.length)
            audit(check,ids.join(","));
        else
            alert("请选择用户!");
    }
    /**
     * 用户审核
     */
    function audit(check,id){
        $.ajax({
            url:"<?php echo Yii::app()->createUrl("/unormal/auditlogo") ?>",
            type:"GET",
            data:{"id":id,"check":check},
            success:function(str){
                alert(str=="1"?"操作成功":"操作失败");
                window.location.reload();
            }
        })
    }
</script>