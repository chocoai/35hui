<div class="form">
    <style type="text/css">
        div.form label{display:inline}
    </style>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'combo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
		<?php echo $form->labelEx($model,'cb_name'); ?>
		<?php echo $form->textField($model,'cb_name'); ?>
		<?php echo $form->error($model,'cb_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cb_issuednum'); ?>
		<?php echo $form->textField($model,'cb_issuednum'); ?>
		<?php echo $form->error($model,'cb_issuednum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cb_inputnum'); ?>
		<?php echo $form->textField($model,'cb_inputnum'); ?>
		<?php echo $form->error($model,'cb_inputnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cb_refreshnum'); ?>
		<?php echo $form->textField($model,'cb_refreshnum'); ?>
		<?php echo $form->error($model,'cb_refreshnum'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'cb_comboprice'); ?>
		<?php echo $form->textField($model,'cb_comboprice'); ?>元/月
		<?php echo $form->error($model,'cb_comboprice'); ?>
	</div>

    <div class="row">
        <?php
        $iconurl = array(
            "/images/level/grade0.gif"=>CHtml::image(MAINHOST."/images/level/grade0.gif"),
            "/images/level/grade1.gif"=>CHtml::image(MAINHOST."/images/level/grade1.gif"),
            "/images/level/grade2.gif"=>CHtml::image(MAINHOST."/images/level/grade2.gif"),
            "/images/level/grade3.gif"=>CHtml::image(MAINHOST."/images/level/grade3.gif"),
        );
        ?>
		<?php echo $form->labelEx($model,'cb_iconurl'); ?>
		<?php echo $form->radioButtonList($model,'cb_iconurl',$iconurl,array("separator"=>"&nbsp;")); ?>
		<?php echo $form->error($model,'cb_iconurl'); ?>
	</div>

    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->