<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sb_shopid'); ?>
		<?php echo $form->textField($model,'sb_shopid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_sysid'); ?>
		<?php echo $form->textField($model,'sb_sysid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_uid'); ?>
		<?php echo $form->textField($model,'sb_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_shoptype'); ?>
		<?php echo $form->textField($model,'sb_shoptype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_province'); ?>
		<?php echo $form->textField($model,'sb_province'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_city'); ?>
		<?php echo $form->textField($model,'sb_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_district'); ?>
		<?php echo $form->textField($model,'sb_district'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_section'); ?>
		<?php echo $form->textField($model,'sb_section'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_tradecircle'); ?>
		<?php echo $form->textField($model,'sb_tradecircle'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_busway'); ?>
		<?php echo $form->textField($model,'sb_busway',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_shopaddress'); ?>
		<?php echo $form->textField($model,'sb_shopaddress',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_shopfronttype'); ?>
		<?php echo $form->textField($model,'sb_shopfronttype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_propertycomname'); ?>
		<?php echo $form->textField($model,'sb_propertycomname',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_propertycost'); ?>
		<?php echo $form->textField($model,'sb_propertycost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_shoparea'); ?>
		<?php echo $form->textField($model,'sb_shoparea'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_shopusablearea'); ?>
		<?php echo $form->textField($model,'sb_shopusablearea'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_loop'); ?>
		<?php echo $form->textField($model,'sb_loop'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_floor'); ?>
		<?php echo $form->textField($model,'sb_floor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_allfloor'); ?>
		<?php echo $form->textField($model,'sb_allfloor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_towards'); ?>
		<?php echo $form->textField($model,'sb_towards'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_cancut'); ?>
		<?php echo $form->textField($model,'sb_cancut'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_adrondegree'); ?>
		<?php echo $form->textField($model,'sb_adrondegree'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_recommendtrade'); ?>
		<?php echo $form->textField($model,'sb_recommendtrade'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_buildingage'); ?>
		<?php echo $form->textField($model,'sb_buildingage',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_sellorrent'); ?>
		<?php echo $form->textField($model,'sb_sellorrent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_releasedate'); ?>
		<?php echo $form->textField($model,'sb_releasedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_updatedate'); ?>
		<?php echo $form->textField($model,'sb_updatedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_expiredate'); ?>
		<?php echo $form->textField($model,'sb_expiredate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_tag'); ?>
		<?php echo $form->textField($model,'sb_tag',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->