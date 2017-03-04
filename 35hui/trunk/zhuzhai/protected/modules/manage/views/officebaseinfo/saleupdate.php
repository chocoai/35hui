<div class="htit" style="margin-bottom:10px;">修改出售写字楼信息</div>
<?php echo $this->renderPartial('_saleformdiscribe', array('ifUpdate'=>true,'model'=>$model,'modelSelect'=>"",'opt'=>"update")); ?>
<script type="text/javascript">
//点击提交时触发此函数
function validateForm(){
    if(!submitValidate()){
        return false;
    }
    return true;
}
</script>