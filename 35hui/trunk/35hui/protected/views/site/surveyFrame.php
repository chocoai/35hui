<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tanchu.css" />
<div class="tc_survey">
	<h2>请填写您想拍摄的楼盘信息</h2>
    <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'Msgsurvey-form',
                'enableAjaxValidation'=>true,
            )); ?>
	<ul style="list-style-type:none;">
		<li>
			<span class="tcs_1">拍摄地点：</span>
			<span class="tcs_2"><?php echo $form->textField($model,'ms_name',array('maxlength'=>200,'size'=>"30")); ?></span>
		</li>
		<li>
			<span class="tcs_1">&nbsp;</span>
			<span class="tcs_2" style="color:red;"><?php echo $form->error($model,'ms_name'); ?></span>
		</li>
		<li>
			<span class="tcs_1">电子邮箱：</span>
			<span class="tcs_2"><?php echo $form->textField($model,'ms_email',array('maxlength'=>200,'size'=>"30")); ?></span>
		</li>
		<li>
			<span class="tcs_1">&nbsp;</span>
			<span class="tcs_2" style="color:red;"><?php echo $form->error($model,'ms_email'); ?></span>
		</li>
		<li>
			<span class="tcs_1">验 证 码：</span>
			<span class="tcs_2" id="verifyCode">
                <?php if(extension_loaded('gd')): ?>
                    <?php echo $form->textField($model,'verifyCode',array("style"=>"width:60px;")); ?>
                    <?php $this->widget('CCaptcha'); ?>
                <?php endif; ?>
            </span>
		</li>
		<li>
			<span class="tcs_1">&nbsp;</span>
			<span class="tcs_2" style="color:red;"><?php echo $form->error($model,'verifyCode'); ?></span>
		</li>
        <li>
			<span class="tcs_1">&nbsp;</span>
			<span class="tcs_2" style="padding-top:5px;"><?php echo CHtml::submitButton('提交请求',array("style"=>"padding:2px;8px")); ?></span>
		</li>
	</ul>
    <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //设置验证码大小
        $("#verifyCode img").attr("height","20");
    });
</script>
