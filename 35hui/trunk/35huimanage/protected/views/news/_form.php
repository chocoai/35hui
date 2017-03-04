<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KE.show({
    id : 'News_n_content',
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
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo CHtml::errorSummary($model); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="row">
		<?php echo $form->labelEx($model,'n_title'); ?>
		<?php echo $form->textField($model,'n_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'n_title'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'n_summary'); ?>
		<?php echo $form->textArea($model,'n_summary',array('rows'=>5, 'cols'=>80)); ?>
        <br />
		<?php echo $form->error($model,'n_summary'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'n_content'); ?>
		<?php echo $form->textArea($model,'n_content',array('rows'=>20, 'cols'=>80)); ?>
        <br />
		<?php echo $form->error($model,'n_content'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'n_from'); ?>
		<?php echo $form->textField($model,'n_from',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'n_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_state'); ?>
		<?php echo $form->dropDownList($model,'n_state',News::$state); ?>
		<?php echo $form->error($model,'n_state'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'n_leave'); ?>
		<?php echo $form->dropDownList($model,'n_leave',News::$leave,array("onChange"=>"getMsg(this)")); ?><span><?php if($model->n_leave==1)echo "您选择了头条，此头条信息将会覆盖已有的头条！"; ?></span>
		<?php echo $form->error($model,'n_leave'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'n_keyword'); ?>
		<?php echo $form->textField($model,'n_keyword',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'n_keyword'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '更新'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    function getMsg(obj){
        if($(obj).val()==1){//选择了头条，则要有提示
            $(obj).next("span").html("您选择了头条，此头条信息将会覆盖已有的头条！");
        }else{
            $(obj).next("span").html("");
        }
    }
</script>