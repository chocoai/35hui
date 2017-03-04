<?php
$this->breadcrumbs=array(
	'图片审核',
);
//
//$this->menu=array(
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
//);
?>

<h1>图片审核</h1>
<form method="POST" action="">
    <?=CHtml::dropDownList("sourceType",$sourceType,array('2'=>'写字楼','5'=>'商铺','8'=>'住宅','10'=>'创意园区'),array('empty'=>'请选择'))?>
    房源ID：<?=CHtml::textField("sourceid",$sourceid)?><i>多个房源ID请用英文“,”</i>
    <?=CHtml::submitButton("搜索")?>
</form>
<div class="view">
    <b><a href="javascript:void(0);" onclick="selectAll(1)">全选</a></b>
    <b><a href="javascript:void(0);" onclick="selectAll(0)">全不选</a></b> /
    <b><a href="javascript:void(0);" onclick="checkPost(1)">通过</a></b>
    <b><a href="javascript:void(0);" onclick="checkPost(0)">不通过</a></b> /
    <b><a href="javascript:void(0);" onclick="checkPost(3)">自动通过</a></b>
</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<div class="view">
    <b><a href="javascript:void(0);" onclick="selectAll(1)">全选</a></b>
    <b><a href="javascript:void(0);" onclick="selectAll(0)">全不选</a></b> /
    <b><a href="javascript:void(0);" onclick="checkPost(1)">通过</a></b>
    <b><a href="javascript:void(0);" onclick="checkPost(0)">不通过</a></b> /
    <b><a href="javascript:void(0);" onclick="checkPost(3)">自动通过</a></b>
</div>
<script type="text/javascript">
function selectAll(t){
    $(":input[name=pids[]]").each(function(){
        $(this).attr("checked",t?"checked":"");
    });
}
function checkPost(t,id){
    var _id1=[],_id0=[],id2='';
    if(id===undefined){
        $(":input[name=pids[]]").each(function(){
            if($(this).attr("checked"))
                _id1.push($(this).val());
            else
                _id0.push($(this).val());
        });
        id=_id1.join(',');//通过id
        id2=_id0.join(',');//未通过id
    }
    if(t===0){//将选中的不通过
        var _temp=id;
        id=id2;
        id2=_temp;
    }

    //alert("通过id，"+_id1.join(',')+" 不通过id"+_id0.join(','))
    if(!confirm("请确认一下信息，此操作不能恢复\n通过ID："+id+"\n不通过ID："+id2)) return false;
    $.ajax({
            url:"<?php echo Yii::app()->createUrl("/picture/piccheck") ?>",
            type:"POST",
            data:{"id":id,"id2":id2},
            success:function(str){
                alert(str=="ok"?"操作成功":"操作失败");
                window.location.reload();
            }
        })
}
</script>
