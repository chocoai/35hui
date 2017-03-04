<style type="text/css">
.errorMessage{color: red;}
</style>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'buildcollect-form',
	'enableAjaxValidation'=>false,
)); ?>
<table cellspacing="0" cellpadding="0" border="0" id="detailed_info" class="table_01">
    <tr>
        <td width="70px" align="right"><em>*</em> 楼盘名称：</td>
        <td>
            <?php echo $form->textField($model,'bc_buildname',array('id'=>'bc_buildname')); ?><span class="errorMessage"></span>
            <?php echo $form->error($model,'bc_buildname'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><em>*</em> 地　　址：</td>
        <td>
            <?php echo $form->textField($model,'bc_buildaddress',array('id'=>'bc_buildaddress')); ?><span class="errorMessage"></span>
            <?php echo $form->error($model,'bc_buildaddress'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><em>*</em> 位　　置：</td>
        <td>
            <select name="Buildcollect[bc_district]" onchange="changeNext(this)" id="bc_district">
                <option value="0">-请选择-</option>
                <?php
                if(!empty($districtlist)){
                    foreach($districtlist as $value){
                ?>
                        <option value="<?php echo $value->re_id; ?>" <?php if($model->bc_district==$value->re_id)echo "selected" ?>><?php echo $value->re_name;?></option>
                <?php
                    }
                }
                ?>
            </select>
            <select name="Buildcollect[bc_section]'" onchange="changeNext(this)" id="bc_section">
                <option value="0">-请选择-</option>
                <?php
                if(!empty($sectionlist)){
                    foreach($sectionlist as $value){
                ?>
                        <option value="<?php echo $value->re_id; ?>" <?php if($model->bc_section==$value->re_id)echo "selected" ?>><?php echo $value->re_name;?></option>
                <?php
                    }
                }
                ?>
            </select>
            <span class="errorMessage"></span>
        </td>
    </tr>
    <tr>
        <td align="right"><em>*</em> 环　　线：</td>
        <td>
            <select name="Buildcollect[bc_loop]" id="bc_loop">
                <?php
                    foreach($allLoop as $key=>$value){
                        echo "<option value='".$key."'";
                        if($model->bc_loop==$key){
                            echo "selected='selected'";
                        }
                        echo ">".$value."</option>";
                    }
                ?>
            </select>
            <?php echo $form->error($model,'bc_loop'); ?>
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
<input type="hidden" name="sbi_x" id="sbi_x" value=""/>
<input type="hidden" name="sbi_y" id="sbi_y" value=""/>
<?php $this->endWidget(); ?>
<script type="text/javascript">
$(document).ready(function() {
    $("#bc_buildname").val(window.parent.document.getElementById("ofname").value) ;
});
function changeNext(obj){
    var parentid = $(obj).val();
    var html = "<option value='0'>-请选择-</option>";
    if(parentid==0){
        $(obj).nextAll("select").html(html);//删除后面所有的选择。
    }else{
        $.ajax({
           url: "<?php echo Yii::app()->createUrl("/region/getlistbyparentid") ?>",
           type: "GET",
           data: "parentid="+parentid,
           async: false,
           success: function(msg){
               var msg = eval("("+msg+")");
               $(obj).nextAll("select").html(html);//删除后面所有的选择。
               for(var i=0;i<msg.length;i++){
                   html += "<option value='"+msg[i]['re_id']+"'>"+msg[i]['re_name']+"</option>";
               }
               $(obj).next("select").html(html);
           }
        });
    }
}
function validateAddBuildForm(){
    if($("#bc_buildname").val().length < 1){
        $("#bc_buildname").next("span").html("请输入名称！");
        $("#bc_buildname").focus();
        return false;
    }else{
        //验证楼盘名称是否已经有。
        var msg = $.ajax({
            url:"<?=Yii::app()->createUrl("/manage/buildcollect/ajaxcheckbuildname") ?>",
            type:"POST",
            data:"buildName="+$("#bc_buildname").val(),
            async:false
        }).responseText;
        if(msg==1){
            $("#bc_buildname").next("span").html("");
        }else{
            $("#bc_buildname").next("span").html("楼盘名称已经存在！");
            return false;
        }
    }
    if($("#bc_buildaddress").val().length < 1){
        $("#bc_buildaddress").next("span").html("请输入地址！");
        $("#bc_buildaddress").focus();
        return false;
    }else{
        $("#bc_buildaddress").next("span").html("");
    }
    if($("#bc_section").val() == 0){
        $("#bc_section").next("span").html("请选择位置！");
        return false;
    }else{
        $("#bc_section").next("span").html("");
    }

    var sbi_x = "121.47536873817444";
    var sbi_y = "31.232857675162947";
    $("#sbi_x").val(sbi_x);
    $("#sbi_y").val(sbi_y);
    $("#buildcollect-form").submit();
    return false;
}
</script>