<?php
$this->breadcrumbs=array('房源展示');
?>
<div class="hntit">
    <strong>房源展示</strong>
</div>
<div class="jifentit" style="border-bottom: 1px solid #B2B2B2;">
    <?=CHtml::link("已购买的可用位置",array("/manage/buyproduct/index"))?>
    <?=CHtml::link("历史购买记录",array("/manage/buyproduct/list"))?>
</div>

<div class="fyglcont">
    <?php
    $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
            'summaryText'=>'',
    )); ?>
</div>
<div class="helpline"><em>*</em><?=CHtml::link("查看使用说明","/help/charge",array("target"=>"_blank"))?></div>
<div class="helpline"><em>*</em><?=CHtml::link("获取新币与积分的方法","/help/money",array("target"=>"_blank"))?></div>

<script type="text/javascript">
    function showOrHidden(index){
        var state = $(".fyglcont .fyglin").eq(index).css("display");
        if(state=="none"){
            $(".fyglcont .fyglin").eq(index).css("display","");
            $(".fyglcont .fygline").eq(index).find("img").attr("src","/images/btn_hideinfo.gif");
        }else{
            $(".fyglcont .fyglin").eq(index).css("display","none");
            $(".fyglcont .fygline").eq(index).find("img").attr("src","/images/btn_showinfo.gif");
        }
        //重新定义高度
        resetFrameHeight();
    }
    /**
     * 得到总价
     */
    function getTotalPrice(obj, dayPrice) {
        var value = $(obj).val();
        var TotalPrice = value*dayPrice;
        $(obj).parent().next().find("em").html(TotalPrice);
        $(obj).parent().next().next().find("span").html(value);
    }
    function buyposition(id, obj){
        var days = $(obj).next("span").html();
        var price = parseInt($(obj).parent().prev().find("em").html());
        if(confirm("确定要花费"+price+"点新币购买此页面位置吗？")){
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl('/manage/buyproduct/create');?>",
                data: {"id":id,"days":days},
                success: function(msg){
                    if(msg=="success"){
                        if(confirm("购买成功，是否去设置房源？")){
                            window.location.href = "<?=Yii::app()->createUrl("/manage/buyproduct/index");?>"
                        }else{
                            window.location.reload();
                        }
                    }else{
                        alert(msg);
                    }
                }
            });
        }
    }
</script>
