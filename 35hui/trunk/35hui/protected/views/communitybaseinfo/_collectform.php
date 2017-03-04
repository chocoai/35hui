<style type="text/css">
.errorMessage{ color: red;}
</style>
<link href="/css/umanage.css" rel="stylesheet" type="text/css" />
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'buildcollect-form',
	'enableAjaxValidation'=>false,
)); ?>

<table cellspacing="0" cellpadding="0" border="0" id="detailed_info" class="table_01">
    <tr>
        <td align="right"><em>*</em> 小区名称：</td>
        <td>
            <input type="text" value="" maxlength="50" name="comy_name" id="comy_name"><span class="errorMessage"></span>
        </td>
    </tr>
    <tr>
        <td align="right"><em>*</em> 小区地址：</td>
        <td>
            <input type="text" value="" maxlength="50" name="comy_address" id="comy_address"><span class="errorMessage"></span>
        </td>
    </tr>
    <tr>
        <td align="right"><em>*</em> 位　　置：</td>
        <td>
            <select name="comy_district" onchange="changeNext(this)" id="comy_district">
                <option value="0">-请选择-</option>
                <?php
                if(!empty($districtlist)){
                    foreach($districtlist as $value){
                ?>
                        <option value="<?php echo $value->re_id; ?>"><?php echo $value->re_name;?></option>
                <?php
                    }
                }
                ?>
            </select>
            <select name="comy_section" id="comy_section">
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
        <td align="right">物业类型：</td>
        <td>
            <select name="Buildcollect[bc_loop]" id="bc_loop">
                <option value="0">-请选择-</option>
                <?php
                    foreach(Communitybaseinfo::$comy_propertytypes as $key=>$value){
                echo "<option value='".$key."'>".$value."</option>";
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo CHtml::Button('提交',array('onClick'=>'return validateAddBuildForm()')); 
        echo '　';
        echo CHtml::Button('取消',array('onClick'=>'window.parent.closeAddBuildFrame()')); ?></td>
    </tr>
</table>
<?php $this->endWidget(); ?>
<script type="text/javascript">
$(document).ready(function() {
    $("#comy_name").val(window.parent.document.getElementById("ofname").value) ;
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
    var nameObj = $("#comy_name");
    var name = $.trim(nameObj.val());
    if(name.length < 1){
        nameObj.next("span").html("请输入名称！").focus();
        return false;
    }
    //验证楼盘名称是否已经有。
    $.get("<?=Yii::app()->createUrl("/communitybaseinfo/ishave") ?>", {'name':name}, function(data){
        if(data == 1){
            nameObj.next("span").html("楼盘名称已经存在！");
            return false;
        }else{
            nameObj.next("span").html("");
        }
    });
    if($("#comy_address").val().length < 1){
        $("#comy_address").next("span").html("请输入地址！").focus();
        return false;
    }else{
        $("#comy_address").next("span").html("");
    }
    if($("#comy_section").val() == 0){
        $("#comy_section").next("span").html("请选择位置！");
        return false;
    }else{
        $("#comy_section").next("span").html("");
    }
    $("#buildcollect-form").submit();
    return false;
}
</script>