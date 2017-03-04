
<div style="line-height:24px">
<div class="form">

<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'oc_traffice'); ?>
		<?php $traffic_radiobuttonList = CHtml::activeRadioButtonList($model,'oc_traffice',Lookup::items('judgecomment'),
                        array('template'=>'{input}{label}','separator'=>" "));
                 $traffic_radiobuttonList= str_replace("<label", "<span", $traffic_radiobuttonList);
                 $traffic_radiobuttonList= str_replace("</label", "</span", $traffic_radiobuttonList);
                 echo $traffic_radiobuttonList; 
		?>
		<?php echo CHtml::error($model,'oc_traffice'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'oc_facility'); ?>
		<?php $facility_radiobuttonList = CHtml::activeRadioButtonList($model,'oc_facility',Lookup::items('judgecomment'),
                        array('template'=>'{input}{label}','separator'=>" "));
                 $facility_radiobuttonList= str_replace("<label", "<span", $facility_radiobuttonList);
                 $facility_radiobuttonList= str_replace("</label", "</span", $facility_radiobuttonList);
                 echo $facility_radiobuttonList; 
		?>
		<?php echo CHtml::error($model,'oc_facility'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'oc_adorn'); ?>
		<?php $adorn_radiobuttonList = CHtml::activeRadioButtonList($model,'oc_adorn',Lookup::items('judgecomment'),
                        array('template'=>'{input}{label}','separator'=>" "));
                 $adorn_radiobuttonList= str_replace("<label", "<span", $adorn_radiobuttonList);
                 $adorn_radiobuttonList= str_replace("</label", "</span", $adorn_radiobuttonList);
                 echo $adorn_radiobuttonList; 
		?>
		<?php echo CHtml::error($model,'oc_adorn'); ?>
	</div>

	<div class="row">
		<b><?php echo CHtml::activeLabelEx($model,'oc_comment'); ?></b>
		<?php echo CHtml::activeTextArea($model,'oc_comment',array('rows'=>5, 'cols'=>60)); ?>
		<?php echo CHtml::error($model,'oc_comment'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? ' 评   论 ' : ''); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
</div>