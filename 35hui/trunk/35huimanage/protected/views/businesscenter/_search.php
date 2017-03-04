<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'bc_id'); ?>
		<?php echo $form->textField($model,'bc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_name'); ?>
		<?php echo $form->textField($model,'bc_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_pinyinshortname'); ?>
		<?php echo $form->textField($model,'bc_pinyinshortname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_pinyinlongname'); ?>
		<?php echo $form->textField($model,'bc_pinyinlongname',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_englishname'); ?>
		<?php echo $form->textField($model,'bc_englishname',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_sysid'); ?>
		<?php echo $form->textField($model,'bc_sysid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_address'); ?>
		<?php echo $form->textField($model,'bc_address',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_district'); ?>
		<?php echo $form->textField($model,'bc_district'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_floor'); ?>
		<?php echo $form->textField($model,'bc_floor',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_completetime'); ?>
		<?php echo $form->textField($model,'bc_completetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_rentprice'); ?>
		<?php echo $form->textField($model,'bc_rentprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_serverbrand'); ?>
		<?php echo $form->textField($model,'bc_serverbrand',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_serverlanguage'); ?>
		<?php echo $form->textField($model,'bc_serverlanguage',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_decoratestyle'); ?>
		<?php echo $form->textField($model,'bc_decoratestyle',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_introduce'); ?>
		<?php echo $form->textArea($model,'bc_introduce',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_freeserver'); ?>
		<?php echo $form->textArea($model,'bc_freeserver',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_payserver'); ?>
		<?php echo $form->textArea($model,'bc_payserver',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_traffic'); ?>
		<?php echo $form->textArea($model,'bc_traffic',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_peripheral'); ?>
		<?php echo $form->textArea($model,'bc_peripheral',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_connecttel'); ?>
		<?php echo $form->textField($model,'bc_connecttel',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_releasetime'); ?>
		<?php echo $form->textField($model,'bc_releasetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_visit'); ?>
		<?php echo $form->textField($model,'bc_visit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bc_titlepic'); ?>
		<?php echo $form->textField($model,'bc_titlepic'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->