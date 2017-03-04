<style type="text/css">
.errorMessage{color: red;}
</style>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Creativecollect-form',
	'enableAjaxValidation'=>false,
)); ?>
<table cellspacing="0" cellpadding="0" border="0" id="detailed_info" class="table_01">
    <tr>
        <td width="70px" align="right"><em>*</em> 楼盘名称：</td>
        <td>
            <?php echo $form->textField($model,'cc_name',array('id'=>'cc_name')); ?><span class="errorMessage"></span>
            <?php echo $form->error($model,'cc_name'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><em>*</em> 地　　址：</td>
        <td>
            <?php echo $form->textField($model,'cc_address',array('id'=>'cc_address')); ?><span class="errorMessage"></span>
            <?php echo $form->error($model,'cc_address'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><em>*</em> 位　　置：</td>
        <td>
            <select name="Creativecollect[cc_district]" id="cc_district">
                <option value="0">-请选择-</option>
                <?php
                if(!empty($districtlist)){
                    foreach($districtlist as $value){
                ?>
                        <option value="<?php echo $value->re_id; ?>" <?php if($model->cc_district==$value->re_id)echo "selected" ?>><?php echo $value->re_name;?></option>
                <?php
                    }
                }
                ?>
            </select>
            <span class="errorMessage"></span>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php
            echo CHtml::Button('提交',array('onClick'=>'return validateAddBuildForm()'));
            echo '   ';
            echo CHtml::Button('取消',array('onClick'=>'window.parent.closeAddBuildFrame()'));
        ?></td>
    </tr>
</table>
<?php $this->endWidget(); ?>
<script type="text/javascript">
$(document).ready(function() {
    $("#cc_name").val(window.parent.document.getElementById("parkname").value) ;
});
function validateAddBuildForm(){
    if($("#cc_name").val().length < 1){
        $("#cc_name").next("span").html("请输入名称！");
        $("#cc_name").focus();
        return false;
    }else{
        //验证楼盘名称是否已经有。
        var msg = $.ajax({
            url:"<?=Yii::app()->createUrl("/manage/Creativecollect/ajaxcheckbuildname") ?>",
            type:"POST",
            data:"buildName="+$("#cc_name").val(),
            async:false
        }).responseText;
        if(msg==1){
            $("#cc_name").next("span").html("");
        }else{
            $("#cc_name").next("span").html("楼盘名称已经存在！");
            return false;
        }
    }
    if($("#cc_address").val().length < 1){
        $("#cc_address").next("span").html("请输入地址！");
        $("#cc_address").focus();
        return false;
    }else{
        $("#cc_address").next("span").html("");
    }
    if($("#cc_district").val() == 0){
        $("#cc_district").next("span").html("请选择位置！");
        return false;
    }else{
        $("#cc_district").next("span").html("");
    }

   
    $("#Creativecollect-form").submit();
    return false;
}
</script>