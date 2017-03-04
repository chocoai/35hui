<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'panorama-form',
	'enableAjaxValidation'=>false,
    'method'=>'post',
    'htmlOptions'=>array('enctype'=>'multipart/form-data',"onSubmit"=>"return changeToImage()")
)); ?>
    所属资源：<?=Panorama::model()->getPanoramaViewName($model->p_buildingid)?>
    <div class="row">
        <?php echo $form->hiddenField($model, 'p_buildingid'); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'p_type'); ?>
        <?php echo $form->dropDownList($model,'p_type',Panorama::$typeDescription); ?>
		<?php echo $form->error($model,'p_type'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'p_title'); ?>
		<?php echo $form->textField($model,'p_title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'p_title'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'p_description'); ?>
		<?php echo $form->textArea($model, 'p_description',array('cols'=>50,'rows'=>7)); ?>
		<?php echo $form->error($model,'p_description'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'p_remark'); ?>
		<?php echo $form->textField($model,'p_remark',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'p_remark'); ?>
	</div>

    <? if($model->isNewRecord){ ?>
    <div class="row">
        <label>导览全景间链接前缀</label>
		<?php echo $form->textField($model,'p_url',array('size'=>30,'maxlength'=>100,'readonly'=>"true")); ?><br />
		<?php echo $form->error($model,'p_url'); ?>
	</div>
    <div class="row">
        <label>全景上传方式</label>
        <?=CHtml::radioButtonList("uploadType","1",array("1"=>"直接上传","2"=>"稍后上传"),array("separator"=>"&nbsp;","style"=>"display:inline","labelOptions"=>array("style"=>"display:inline;font-weight:normal")));?><font color="red">稍后上传需要直接复制全景至指定目录，记得保存上面的文件夹名</font>
    </div>
	<div class="row">
		<b>选择全景</b><br>
		<?php echo $form->fileField($fileForm, 'panoramaFile'); ?><br />
        <?php echo $form->error($fileForm,'panoramaFile'); ?><br />
        <span>提示:请将全景文件以及缩略图文件一起压缩成小于10M的<font color="red">zip</font>包进行上传,不要包含文件夹。</span><br />
        1、图片全景：包含全景参数文件<font color="red">parameter.txt</font>、全景图<font color="red">panorama.jpg</font>、缩略图<font color="red">thumbnail.jpg</font>(100*75)还有合成全景的6张图片<br />
        2、swf全景：包含全景文件<font color="red">index.swf</font>、全景图<font color="red">panorama.jpg</font>、缩略图<font color="red">thumbnail.jpg</font>(100*75)<br />
       
	</div>
    <? } ?>

    <div class="row">
		<?php echo $form->labelEx($model,'p_tag'); ?>
		<?php echo $form->textField($model,'p_tag',array('size'=>60,'maxlength'=>200)); ?>
        <p>注意:建议标签以空格分开;</p>
		<?php echo $form->error($model,'p_tag'); ?>
	</div>

	<div class="row buttons" id="submitButton">
		<?php echo CHtml::submitButton($model->isNewRecord ? '上传' : '保存'); ?>
	</div>
    <div class="row" id="uploadPicLoad" style="display: none">
        <font style='color:red'>上传中</font><img src='<?=IMAGE_URL?>/uploadPicLoad.gif' />
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
function changeToImage(){
    <? if($model->isNewRecord){ ?>
        $("#uploadPicLoad").css("display", "");
        $("#submitButton").css("display", "none");//隐藏上传按钮
    <?}?>
}
</script>