<div class="form">

<?php if(Yii::app()->user->hasFlash('message')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('message'); ?>
</div>
<?php endif; ?>
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'buyregion-form',
	'enableAjaxValidation'=>false,
    "htmlOptions"=>array(
        "onSubmit"=>"return checkForm()"
    )
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'br_userid'); ?>
        <input type="text" name="companyName" id="companyName"/>
        <input type="button" value="检查" onclick="checkCompanyName(this)"/>
        <span id="usermessage">(请输入完整的公司名称)</span>
        <?php echo $form->hiddenField($model,'br_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'br_regionid'); ?>
        <?=CHtml::dropDownList("district","",Region::model()->getTarafUnits(37),array("empty"=>"--请选择--",'onChange'=>"changeChildren(this)"));?>
		<?php echo $form->dropDownList($model,'br_regionid',array("--请选择--")); ?>
		<font id="regionid" color="red"></font>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'br_sourcetype'); ?>
		<?php echo $form->dropDownList($model,'br_sourcetype',Buyregion::$br_sourcetype); ?>
		<?php echo $form->error($model,'br_sourcetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'br_sellorrent'); ?>
		<?php echo $form->dropDownList($model,'br_sellorrent',Buyregion::$br_sellorrent); ?>
		<?php echo $form->error($model,'br_sellorrent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'br_expiredate'); ?>
		<?php echo $form->dropDownList($model,'br_expiredate',array(
            "30"=>"30天",
            "60"=>"60天",
            "90"=>"90天"
            )); ?>
		<?php echo $form->error($model,'br_expiredate'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton("保存"); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
function changeChildren(obj){
    var district = $("#district").val();
    var html = "";
    if(district!=""&&district!=null){
        $.ajax({
            type: "GET",
            url: "<?=Yii::app()->createUrl('region/getListByParentId');?>",
            data: "parentid="+district,
            success: function(msg){
                var msg = eval("("+msg+")");
                $(obj).nextAll("select").html(html);//删除后面所有的选择。
                for(var i=0;i<msg.length;i++){
                   html += "<option value='"+msg[i]['re_id']+"'>"+msg[i]['re_name']+"</option>";
                }
                $(obj).next("select").html(html);
            }
        });
    }else{
        $(obj).next("select").html('<option value="0">--请选择--</option>');
    }
}
function checkCompanyName(obj){
    var name = $("#companyName").val();
    if(name==""){
        $("#usermessage").html("<img src='/images/onError.gif' /><font color='red'>不能为空！</font>");
    }
    $.ajax({
        type: "GET",
        url: "<?=Yii::app()->createUrl('buyregion/CheckCompanyName');?>",
        data: {"name":name},
        success: function(msg){
            if(msg==""){
                $("#usermessage").html("<img src='/images/onError.gif' /><font color='red'>输入的公司不存在！</font>");
            }else{
                $("#companyName").attr("readonly","true");
                $("#companyName").css("background-color","#999999");
                $(obj).css("display","none");
                $("#usermessage").html("<img src='/images/onValid.gif' /><font>ID:"+msg+"</font>");
                $("#Buyregion_br_userid").val(msg);
            }
        }
    });
}
function checkForm(){
    if($("#Buyregion_br_userid").val()==""){
        $("#usermessage").html("<img src='/images/onError.gif' /><font color='red'>公司不存在！</font>");
        return false;
    }
    if($("#Buyregion_br_regionid").val()==""||$("#Buyregion_br_regionid").val()=="0"){
        $("#regionid").html("<img src='/images/onError.gif' /><font color='red'>请选择购买的版块！</font>");
        return false;
    }
    return true;
}
</script>