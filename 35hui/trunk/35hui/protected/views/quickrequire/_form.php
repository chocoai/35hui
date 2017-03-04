<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kindeditor/kindeditor.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<script type="text/javascript">
KE.show({
    id : 'Quickrequire_qrq_desc',
    resizeMode : 1,
    allowPreviewEmoticons : false,
    allowUpload : false,
    resizeMode : 0,
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'image', 'link']
});
</script>
<style type="text/css">
.thiscontent{ margin-top: 8px;}
</style>
<div class="pnreg-form">
    <div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
            'id' => 'quickrelease-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
    ?>
        <div class="pnreg-tit"><h2>基本信息</h2><span><i>*</i> 为必填选项</span></div>
        <ul>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_rstype'); ?>
                    <?php 
                    foreach(Lookup::items('reqsrtype') as $key=>$value){
                    ?>
                        <input type="radio" name="Quickrequire[qrq_rstype]" value="<?=$key?>" <?=$key==0?"checked='true'":""?>/><?=$value;?>
                    <?php
                    }
                    ?>
                </div>
            </li>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_usetype'); ?>
                    <?php echo CHtml::activeDropDownList($model,'qrq_usetype',Lookup::items('usetype')); ?>
                </div>
            </li>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_district'); ?>
                    <?php echo $form->dropDownList($model,'qrq_district',Region::model()->getTarafUnits($model->qrq_district)); ?>
                </div>
            </li>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_address'); ?>
                </div>
                <div class="thiscontent">
                    <div style="width: 25%;float: left">
                        <?php echo CHtml::activeTextField($model,'qrq_address'); ?>
                    </div>
                    <div style="float:left">
                        <?php echo $form->error($model,"qrq_address");?>
                    </div>
                </div>
            </li>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_title'); ?>
                </div>
                <div class="thiscontent">
                    <div style="width: 25%;float: left">
                        <?php echo CHtml::activeTextField($model,'qrq_title',array("onkeyup"=>"CheckTitle(this)")); ?>
                    </div>
                    <div style="float:left">
                        <?php echo $form->error($model,"qrq_title");?>
                    </div>
                </div>
            </li>
            <li class="field txt-field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_desc'); ?>
                </div>
                <div class="thiscontent">
                    <div style="width: 420px;float: left">
                        <?php echo CHtml::activeTextArea($model,'qrq_desc',array("rows"=>11,"cols"=>65)); ?>
                    </div>
                    <div style="float:left">
                        <?php echo $form->error($model,"qrq_desc");?>
                    </div>
                </div>
            </li>
        </ul>
        <!--上传图片-->
        <div class="pnreg-tit" style="width:100%"><h2>联系方式</h2><span><i>*</i> 为必填选项</span></div>
        <ul>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_contact'); ?>
                </div>
                <div class="thiscontent">
                    <div style="width: 25%;float: left">
                        <?php echo CHtml::activeTextField($model,'qrq_contact'); ?>
                    </div>
                    <div style="float:left">
                        <?php echo $form->error($model,"qrq_contact");?>
                    </div>
                </div>
            </li>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_telephone'); ?>
                </div>
                <div class="thiscontent">
                    <div style="width: 25%;float: left">
                        <?php echo CHtml::activeTextField($model,'qrq_telephone'); ?>
                    </div>
                    <div style="float:left">
                        <?php echo $form->error($model,"qrq_telephone");?>
                    </div>
                </div>
            </li>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_qq'); ?>
                </div>
                <div class="thiscontent">
                    <div style="width: 25%;float: left">
                        <?php echo CHtml::activeTextField($model,'qrq_qq'); ?>
                    </div>
                    <div style="float:left">
                        <?php echo $form->error($model,"qrq_qq");?>
                    </div>
                </div>
            </li>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_msn'); ?>
                </div>
                <div class="thiscontent">
                    <div style="width: 25%;float: left">
                        <?php echo CHtml::activeTextField($model,'qrq_msn'); ?>
                    </div>
                    <div style="float:left">
                        <?php echo $form->error($model,"qrq_msn");?>
                    </div>
                </div>
            </li>
            <li class="field">
                <div class="input">
                    <?php echo CHtml::activeLabelEx($model,'qrq_expiredate'); ?>
                    <?php echo $form->dropDownList($model,'qrq_expiredate',array('604800'=>'一个星期','1209600'=>'两个星期','2592000'=>'一个月')); ?></div>
            </li>
            <li class="field" style="height:200px">
                <div class="thiscontent"> <label>验证码<i>*</i></label>
                    <?php if(extension_loaded('gd')): ?>
                      <?php  $this->widget('CCaptcha');?>
                     <?php endif;?>
                    </div>
                <div style="margin-left:170px">
                    <?php echo $form->textField($model,'verifyCode',array("style"=>"width:60px;float:left")); ?>
                    <?php echo $form->error($model,"verifyCode");?></div>
            </li>
        </ul>
        <!--联系方式-->
        <div class="submit-field">
            <input type="submit" id="toggle" name="Submit2" class="btn-submit" value="立即发布">
        </div>
    <?php $this->endWidget();?>
    </div>
</div>
<script type="text/javascript">
//验证标题
function CheckTitle(obj){
    $(obj).parent().next().children("div").css("color", "");
    $(obj).parent().next().children("div").css("display", "");
    var allNum = 50;
    var value = $(obj).val();
    value = value.replace(/([\u0391-\uFFE5])/ig,'111');
    if(value.length==0){
        $(obj).parent().next().children("div").html("");
        return true;
    }else if(value.length>allNum){
        $(obj).parent().next().children("div").html("标题最多填写"+50+"个字符！");
        $(obj).focus();
        return false;
    }else if(value.length==allNum){
        $(obj).parent().next().children("div").css("color", "black");
        $(obj).parent().next().children("div").html("（<font style='font-weight:bold'>"+value.length+"</font>/"+allNum+"个字符）");
        return true;
    }else {
        $(obj).parent().next().children("div").css("color", "black");
        $(obj).parent().next().children("div").html("（"+value.length+"/"+allNum+"个字符）");
        return true;
    }
}
$(document).ready(function(){$('#Quickrelease_verifyCode_em_').css('float','left')});
</script>