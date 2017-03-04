<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'meetrecord-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array("onSubmit"=>"return Checkform()")
)); ?>

	<p class="note">标识 <span class="required">*</span> 号为必填.</p>

	<?php
            echo $form->errorSummary($model);
            if($model->isNewRecord){
        ?>
        <input type="hidden" id="meetrecord_mr_frid" name="Meetrecord[mr_frid]" value="<?php echo $id;?>"/>
        <?php }?>
	<div class="row">
		<?php echo $form->labelEx($model,'mr_remark'); ?>
		<?php echo $form->textArea($model,'mr_remark',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mr_remark'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->