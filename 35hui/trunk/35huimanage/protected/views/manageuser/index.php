<?php
$this->breadcrumbs=array(
	'站点后台用户管理',
);
$this->currentMenu = 74;
$this->menu=array(
	array('label'=>'创建用户', 'url'=>array('create')),
);
?>
<table width="100%" style="padding: 10px">
    <tr>
        <th width="5%">ID</th>
        <th width="15%">登录名</th>
        <th width="13%">真实姓名</th>
        <!--<th width="15%">角色</th>-->
        <th width="20%">录入时间</th>
        <th width="8%">状态</th>
        <th width="13%">联系电话</th>
        <th>操作</th>
    </tr>
</table>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    "summaryText"=>"",
)); ?>
<script type="text/javascript">
    function del(id){
        var href = "<?=Yii::app()->createUrl("/manageuser/delete");?>/id/"+id;
        if(confirm("确定要删除吗？")){
            window.location.href = href;
        }
    }
    function update(id){
        var href = "<?=Yii::app()->createUrl("/manageuser/updatestate");?>/id/"+id;
        if(confirm("锁定的账号不能继续登录，确定执行吗？")){
            window.location.href = href;
        }
    }
</script>