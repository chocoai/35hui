<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'subpanorama-form',
        'enableAjaxValidation'=>false,
        'method'=>'post',
        'htmlOptions'=>array('enctype'=>'multipart/form-data',"onSubmit"=>"return changeToImage()")
    )); ?>
    <div class="row">
		<?php echo $form->labelEx($model,'spn_panoramaname'); ?>
		<?php echo CHtml::encode($model->spn_panoramaname) ?><br />
	</div>

    <div class="row">
        <label><?php echo $form->labelEx($model,'spn_fisheyephoto'); ?></label>
        <?php
        $pics = unserialize($model->spn_fisheyephoto);
        if($pics){
            foreach($pics as $value){
                $value = str_replace(".", Subpanorama::$standard[1]['suffix'].".", $value);
                echo CHtml::image(PIC_URL.$value,"",array("width"=>"100px","height"=>"75px"))."&nbsp;&nbsp;";
            }
        }
        ?>
    </div>
    
    <div class="row">
		<label><?php echo $form->labelEx($model,'spn_panoramaurl'); ?></label>
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
    <?php
    if(isset($giveMoney)&&$giveMoney){//只有在用户以上传全景图片，并成功绑定的流程下才赠送商务币和积分
    ?>
     if(!confirm("上传并绑定全景将赠送积分和商务币给此用户，确定执行吗？")){
         return false;
     }
    <?php
    }
    ?>
    $("#uploadPicLoad").css("display", "");
    $("#submitButton").css("display", "none");//隐藏上传按钮
    return true;
}
</script>