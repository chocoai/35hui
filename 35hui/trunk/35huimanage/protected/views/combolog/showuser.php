<?php

$this->breadcrumbs=array(
    "查看套餐信息"=>array('showall'),
	'个人使用情况 : '.Combolog::model()->getUserShowLink($id,false).'['.CHtml::encode($id).']',
    
);

$this->menu=array(
    array('label'=>'查看套餐信息', 'url'=>array('showall')),
    array('label'=>'管理套餐信息', 'url'=>array('admin')),
);
?>
<script type="text/javascript">
    $(document).ready(function(){
           var oldval=$("#mangeuser").val();
         //更改专属客服
           $("#mangeuser").change(function(){
                if(confirm("是否要修改专属客服")){
                    var id=$(this).parent("div").find("input").val();
                    var muid=$(this).val();
                    $.ajax({
                    url:"/combolog/updatemuid",
                    data:{"id":id,"muid":muid},
                    type:"POST",
                    success:function(msg){
                            if(msg){
                                alert(msg);
                                oldval=muid;
                            }else{
                                alert("修改失败");
                                $("#mangeuser").val(oldval);
                            }
                        }
                    });
                    return false;
                }else{
                    $(this).val(oldval);
                }
            })
    })
</script>
<div style="position:absolute"><div class="problock" style="width:60px" >&nbsp;&nbsp;套餐ID</div><div class="problock" style="width:200px">套餐信息</div><div class="problock" >订购时间</div><div class="problock" >到期时间</div><div class="problock" >专属客服</div></div>
<?php
    $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>"_showuser",
));
    ?>

