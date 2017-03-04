<?php
$this->breadcrumbs=array(
	'商铺管理',
);
$this->currentMenu = 24;
$this->menu=array(
	array('label'=>'管理商铺', 'url'=>array('admin')),
);
?>

<h1>商铺列表</h1>
<?
 $type=isset($_GET["type"])?$_GET["type"]:"4";
echo CHtml::dropDownList('od',$type,
        array("4"=>'发布的房源',"8"=>'下线的房源'),
        array('onchange'=>'search()'));
?>
<div class="view">

    <b><a href="javascript:void(0);" onclick="selectAll(1)">全选</a></b>
    <b><a href="javascript:void(0);" onclick="selectAll(0)">全不选</a></b>
     <?if($type!=8){?>
    <b><a href="javascript:void(0);" onclick="checkPost(1,8)">下线</a></b>
    <?}?>
    <b><a href="javascript:void(0);" onclick="checkPost(0,1)">删除</a></b>
</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<div class="view">
    <b><a href="javascript:void(0);" onclick="selectAll(1)">全选</a></b>
    <b><a href="javascript:void(0);" onclick="selectAll(0)">全不选</a></b>
    <?if($type!=8){?>
    <b><a href="javascript:void(0);" onclick="checkPost(1,8)">下线</a></b>
    <?}?>
    <b><a href="javascript:void(0);" onclick="checkPost(0,1)">删除</a></b>
</div>
<script>
function selectAll(t){
    $(":input[name=pids[]]").each(function(){
        $(this).attr("checked",t?"checked":"");
    });
}
function checkPost(t,type,id){
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

    if(!confirm("请确认一下信息，\n操作ID："+id+"\n不操作ID："+id2)) return false;
    var com;
        if(type==8){
            com=prompt("确认下线？\n您的房源因（'|'号前）被强制下线 (6个汉字以内)\n经纪人您好，您在XX楼的房源（'|'号后）感谢您的理解，谢谢！","价格因素|价格偏低，系统认为数据不够精准而被强制下线。建议您从草稿箱中对其重新编辑发布");
        }else if(type==1){
            com=prompt("确认删除？\n您的房源因( '|'号前)被强制删除 (6个汉字以内)\n经纪人您好，您在XX楼的房源（'|'号后）感谢您的理解，谢谢！","价格因素|价格偏低，系统认为数据不够精准而被强制删除。建议您从草稿箱中对其重新编辑发布");
        }
        if(com!=null&&com!=""){
            $.ajax({
                url:"<?php echo Yii::app()->createUrl("shopbaseinfo/changetag") ?>"+"/sourceType/2/id/"+id,
                data:{"msg":com,"state":type},
                type:"POST",
                success:function(msg){
                   alert(msg);
                   window.location.reload();
                }
            });
        }
}
function search(){
    window.location.href="<?=Yii::app()->createUrl('shopbaseinfo/index',array('type'=>""));?>/"+$("#od").val();
}
</script>