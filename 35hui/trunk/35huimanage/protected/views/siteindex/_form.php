<script src="<?=Yii::app()->request->baseUrl;?>/js/dateinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/css/dateinput.css"/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'siteindex-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data',"onSubmit"=>"return CheckForm();")
)); ?>
	<p class="note">标注 <span class="required">*</span> 号的为必填项.</p>
    <input type="hidden" id="Siteindex_si_typeid" name="Siteindex[si_typeid]" value="<?php echo $id;?>"/>
    <input type="hidden" id="Siteindex_si_type" name="Siteindex[si_type]" value="<?php echo $type;?>"/>
     <div class="row">
		<?php echo $form->labelEx($model,'si_link'); ?>
		<?php echo $form->textField($model,'si_link',array('size'=>73,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'si_link'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'si_desc'); ?>
		<?php echo $form->textArea($model,'si_desc',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'si_desc'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'si_advantages'); ?>
		<?php echo $form->textArea($model,'si_advantages',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'si_advantages'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'si_inferior'); ?>
		<?php echo $form->textArea($model,'si_inferior',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'si_inferior'); ?>
	</div>
<?php if($model->isNewRecord){ ?>
    <div class="row">
		<?php echo $form->labelEx($model,'si_img'); ?>
		<?php echo $form->fileField($model,'si_img'); ?>
		<?php echo $form->error($model,'si_img'); ?>
	</div>
<?php } ?>
    <div class="row">
		<?php echo $form->labelEx($model,'si_num'); ?>
		<?php echo $form->textField($model,'si_num'); ?>
		<?php echo $form->error($model,'si_num'); ?>
	</div>

    <div class="row">
        <?php
        $radioData=Siteindex::$si_pricetype;
        $radioData['1'].=$rentPrice?$rentPrice.'元':'暂无';
        $radioData['2'].=$sellPrice?$sellPrice.'元':'暂无';
        if($type=='3') unset($radioData['1']);
        ?>
		<?php echo $form->labelEx($model,'si_pricetype'); ?>
		<?php echo $form->radioButtonList($model,'si_pricetype',$radioData); ?>
		<?php echo $form->error($model,'si_pricetype'); ?>
        <a target="_blank" href="<?php echo Yii::app()->createUrl($type==1?'systembuildinginfo/update':'communitybaseinfo/update',array('id'=>$id)) ?>">设置租售价格</a>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '设置' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
function CheckForm(){
    var file = $("#siteindex_si_img").val();
    if(file){
        var patn = /\.jpg$|\.gif$/i;
        if(!patn.test(file)){
            alert("图片格式不对！");
            return false;
        }
    }
    return true;
}
</script>
