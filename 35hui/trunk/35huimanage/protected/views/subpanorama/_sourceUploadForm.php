<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'subpanorama-form',
        'enableAjaxValidation'=>false,
        'method'=>'post',
        'htmlOptions'=>array('enctype'=>'multipart/form-data',"onSubmit"=>"return changeToImage()")
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
		<?php echo $form->labelEx($model,'spn_panoramaname'); ?>
		<?php echo $form->textField($model,'spn_panoramaname',array('size'=>60,'maxlength'=>12)); ?><br />
		<?php echo $form->error($model,'spn_panoramaname'); ?>
	</div>
    
    <div class="row">
        <label>导览全景间链接前缀</label>
		<?php echo $form->textField($model,'spn_panoramaurl',array('size'=>30,'maxlength'=>100,'readonly'=>"true")); ?><br />
		<?php echo $form->error($model,'spn_panoramaurl'); ?>
	</div>
    
    <div class="row">
		<label>选择全景</label>
		<?php echo $form->fileField($fileForm, 'panoramaFile'); ?><br />
        <?php echo $form->error($fileForm,'panoramaFile'); ?><br />
        <span>提示:请将全景文件以及缩略图文件一起压缩成小于10M的<font color="red">zip</font>包进行上传,不要包含文件夹。</span><br />
        1、图片全景：包含全景参数文件<font color="red">parameter.txt</font>、全景图<font color="red">panorama.jpg</font>、缩略图<font color="red">thumbnail.jpg</font>(100*75)还有合成全景的6张图片<br />
        2、swf全景：包含全景文件<font color="red">index.swf</font>、全景图<font color="red">panorama.jpg</font>、缩略图<font color="red">thumbnail.jpg</font>(100*75)<br />

	</div>


    <div class="row buttons" id="submitButton">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '上传'); ?>
	</div>
    
    <div class="row" id="uploadPicLoad" style="display: none">
        <font style='color:red'>上传中</font><img src='<?=IMAGE_URL?>/uploadPicLoad.gif' />
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
function changeToImage(){
    $("#uploadPicLoad").css("display", "");
    $("#submitButton").css("display", "none");//隐藏上传按钮
    return true;
}
</script>