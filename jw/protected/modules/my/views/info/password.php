<style type="text/css">
    .errorMessage{color:red}
</style>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'infopassword-form',
        'enableAjaxValidation'=>false,
)); ?>
<div class="zftnav">
    <ul>
        <li class="clk">我的档案</li>
    </ul>
</div>
<div class="jbmain">
    <?=$this->renderPartial("_leftmembermenu")?>
    <div class="jbcont">
        <h1>修改密码</h1>
        <div class="ln">原始密码</div>
        <div class="ln"><?php echo $form->passwordField($model,'oldpassword',array('class'=>'txt_02'));
            echo $form->error($model,'oldpassword'); ?>
        </div>
        <div class="ln">新密码</div>
        <div class="ln"><?php echo $form->passwordField($model,'newpassword',array('class'=>'txt_02'));
            echo $form->error($model,'newpassword');  ?>
        </div>
        <div class="ln">确认密码</div>
        <div class="ln"><?php echo $form->passwordField($model,'newpassword2',array('class'=>'txt_02'));
            echo $form->error($model,'newpassword2');  ?>
        </div>
        <div class="ln" style="text-align:center;">
            <input type="submit" class="btn_04" value="保 存" />
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>