<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/overlay.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/toolbox.expose.min.js"></script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'friendlink-form',
	'enableAjaxValidation'=>false,
    "htmlOptions"=>array("onsubmit"=>"return checkForm()"),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
		<?php echo $form->labelEx($model,'fl_type'); ?>
		<?php echo $form->dropDownList($model,'fl_type',Friendlink::$fl_type,array("onChange"=>"changeType(this)")); ?>
		<?php echo $form->error($model,'fl_type'); ?>
	</div>

    <div class="row" id="form_fl_picurl" style="display: <?=$model->fl_type==Friendlink::PIC_TYPE?"":"none"?>">
		<?php echo $form->labelEx($model,'fl_picurl'); ?>
		<?php echo $form->textField($model,'fl_picurl',array('size'=>60,'maxlength'=>200)); ?>
        <input type="button" value="使用本地图片" onclick="uploadFile()" />
        <img style="display: <?=$model->fl_picurl?"":"none"?>" width="90px" height="30px" id="showPic" <?php if($model->fl_picurl) echo "src='".$model->fl_picurl."'" ?>/>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'fl_value'); ?>
		<?php echo $form->textField($model,'fl_value',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'fl_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fl_url'); ?>
		<?php echo $form->textArea($model,'fl_url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fl_url'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
<div id="uploadFileDiv" style="display:none;position: fixed;width: 350px;height: 150px;;padding: 5px;background-color:#EFEFEF; ">
    <iframe width='350px' height='150px' frameborder='no' scrolling="no"></iframe>
</div>


<script type="text/javascript">
function changeType(obj){
    var type = $(obj).val();
    if(type==<?=Friendlink::PIC_TYPE?>){
        $("#form_fl_picurl").css("display","");
    }else{
        $("#form_fl_picurl").css("display","none");
    }
}
$("#uploadFileDiv").overlay({
    top:'center',
    mask: {
		color: '#111111',
		loadSpeed: 200,
		opacity: 0.5
	},
    closeOnClick: false
});
function uploadFile() {
    $("#uploadFileDiv iframe").attr("src","/friendlink/uploadFrame");
    $("#uploadFileDiv").overlay().load();
}
function closetip(){
    $("#uploadFileDiv").overlay().close();
}
function showMsg(msg){
    alert(msg);
    closetip();
}
function uploadSuccess(url){
    $("#Friendlink_fl_picurl").val(url);
    $("#showPic").css("display","");
    $("#showPic").attr("src",url);
    closetip();
}
function checkForm(){
    var type = $("#Friendlink_fl_type").val();
    var picurl = $("#Friendlink_fl_picurl").val();
    if(type==<?=Friendlink::PIC_TYPE?>){
        if(picurl==""){
            alert("图片链接必须有图片！");
            return false;
        }
    }
    return true;
}
</script>