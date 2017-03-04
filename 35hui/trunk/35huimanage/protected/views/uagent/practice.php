<?php
$this->breadcrumbs=array(
	'会员管理',
    '经纪人管理',
    '经纪人审核'
);
$this->currentMenu = 39;
?>
<table width="100%" style="margin: 0px" >
    <tr>
        <th width="10%">ID</th>
        <th width="10%">用户Id</th>
        <th width="30%"></th>
        <th width="15%">真实姓名</th>
        <th width="15%">电话号码</th>
        <th >审核状态</th>
    </tr>
</table>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_practiceview',
    'summaryText'=>'',
    'summaryCssClass'=>'',
));
?>
<script type="text/javascript">
/**
 * 用户审核
 */
function audit(check,id){
    $.ajax({
        url:"<?php echo Yii::app()->createUrl("/uagent/auditpractice") ?>",
        type:"GET",
        data:"id="+id+"&check="+check,
        success:function(){
            window.location.reload();
        }
    })
}
</script>