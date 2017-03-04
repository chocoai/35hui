<?php $this->breadcrumbs=array('公告设置');?>
<div class="htit">店铺公告设置</div>
<div class="rgcont">
    <?php echo CHtml::beginForm('','post'); ?>
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td width="16%" class="tit"><em>*</em> 公告信息：</td>
            <td width="84%">
                <?php echo CHtml::activeTextArea($model,'ua_post',array('onkeyup'=>'keyPressCheck(this)',"class"=>"tax_01")); ?>
                <?php echo CHtml::error($model,'ua_post'); ?>
                <br />
                <em style="padding-top:5px; display:block; color:#808080;">温馨提示：您可以把您的介绍、最新的优惠信息或者是店铺的精华内容放到公告中！</em>
                <span id="commentHint" style="color:gray;display:none">( 0-400个字符 )</span>
            </td>
        </tr>
        <tr>
            <td width="16%">&nbsp;</td>
            <td width="84%"><input type="submit" value="提交" style="width:100px;" /></td>
        </tr>
    </table>
    <?php echo CHtml::endForm(); ?>
</div>
<script type="text/javascript" language="javascript">
<?php
if(Yii::app()->user->hasFlash('message')){
    echo "alert('".Yii::app()->user->getFlash('message')."');";
}
?>

    function keyPressCheck(obj){
        $('#commentHint').css("display","");
        if($(obj).val().length>400){
            $(obj).val($(obj).val().substring(0,400));
        }else{
            var len=$(obj).val().length;
            if(len){
                var num=400-len;
                if(num){
                    $('#commentHint').css('color','green')
                    $('#commentHint').html('您还可以输入'+num+'个字符');
                }else{
                    $('#commentHint').css('color','red')
                    $('#commentHint').html('抱歉，您输入的字符已达上限!多余字符已被截去.');
                }
            }
        }
    }
</script>
