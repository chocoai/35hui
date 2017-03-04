<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KE.show({
    id : 'Emailgroup_emailcontent',
    resizeMode : 1,
    allowUpload : true,
    imageUploadJson : '<?php echo Yii::app()->request->baseUrl; ?>/js/kindeditor/php/upload_json.php', //指定上传图片的服务器程序
    width : "100%",
    height : "600px",
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'link','image']
});
</script>
<div class="form">
    <table width="100%" style="margin: 0px" >
    <tr>
        <th width="10%">ID</th>
        <th >邮箱</th>
    </tr>
    <tr>
        <td colspan="7"><input type="checkbox" name="select_all" onclick="checkboxSelect(this.checked)">全选
            批量操作 <a href='javascript:auditSelect()'>确认选择</a>
    </tr>
    </table>
<?php
    $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_itemview',
            'summaryText'=>'',
            'summaryCssClass'=>'',
    ));
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emailgroup-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array("onSubmit"=>"return validateForm()")
)); ?>
     <div class="row">
		<?php echo $form->labelEx($model,'addressee'); ?>
		<?php echo $form->textArea($model,'addressee',array('rows'=>5, 'cols'=>60)); ?>
		<?php echo $form->error($model,'addressee'); ?>
	</div>
     <div class="row">
		<?php echo $form->labelEx($model,'emailtitle'); ?>
		<?php echo $form->textField($model,'emailtitle',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'emailtitle'); ?>
	</div>
     <div class="row">
		<?php echo $form->labelEx($model,'emailcontent'); ?>
		<?php echo $form->textArea($model,'emailcontent',array('rows'=>20, 'cols'=>100)); ?>
		<?php echo $form->error($model,'emailcontent'); ?>
	</div>
        <div class="row buttons">
		<?php echo CHtml::submitButton( '发送邮件'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    function checkboxSelect(checked){
        $(":checkbox[name='email[]']").each(function(){
            $(this).attr("checked", checked);
        });
    }
    var count = 0;
    var selected_email = new Array();
    function auditSelect(){
        var ids = [];
        $(":checkbox[name='email[]']").each(function(){
            if($(this).is(":checked")){
                ids.push($(this).val());
                if (!p_n_in_array(selected_email,$(this).val())) {
                    selected_email[count++]=$(this).val();
                    if( $("#Emailgroup_addressee").val()==''){
                        $("#Emailgroup_addressee").val($(this).val());
                    }else{
                        var addressee = $("#Emailgroup_addressee").val();
                        addressee += ";"+ $(this).val();
                        $("#Emailgroup_addressee").val(addressee);
                    }
                }
            }
        });
        if(!ids.length)
            alert("请选择用户!");
    }
    function p_n_in_array() {
	var input_array = arguments[0];
	var input_value = arguments[1];
	var exist = false;
	for (var i = 0; i < input_array.length; i++) {
		if (input_array[i] == input_value) {
			exist = true;
			break;
		}
	}
	return exist;
    }
    function validateForm(){
        if($("#Emailgroup_addressee").val()==''){
            alert("请选择收件人邮箱");
            return false;
        }
        if($("#Emailgroup_emailtitle").val()==''){
            alert("请填写邮件标题");
            return false;
        }
        if($("#Emailgroup_emailcontent").val()==''){
            alert("请填写邮件内容");
            return false;
        }
        return true;
    }
</script>
