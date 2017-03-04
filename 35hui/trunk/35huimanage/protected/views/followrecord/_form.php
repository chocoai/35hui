<script src="<?=Yii::app()->request->baseUrl;?>/js/dateinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/css/dateinput.css"/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'followrecord-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">标注 <span class="required">*</span> 号的为必填项.</p>

	<?php 
            echo $form->errorSummary($model);
            if($model->isNewRecord){
        ?>
            <input type="hidden" id="Followrecord_fr_crid" name="Followrecord[fr_crid]" value="<?php echo $id;?>"/>
        <?php }?>
	<div class="row">
		<?php echo $form->labelEx($model,'fr_content'); ?>
		<?php echo $form->textArea($model,'fr_content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fr_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fr_remindtime'); ?>
                <input type="date" name="Followrecord[fr_remindtime]"<?if($model->fr_remindtime){ ?> value="<?=$model->fr_remindtime;?>" <? } ?> min="1949-01-01" max="2099-12-30">
		<?php echo $form->error($model,'fr_remindtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fr_reservetime'); ?>
                <input type="date" name="Followrecord[fr_reservetime]" <?if($model->fr_reservetime){ ?> value="<?=$model->fr_reservetime;?>" <? } ?> min="1949-01-01" max="2099-12-30">
		<?php echo $form->error($model,'fr_reservetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fr_address'); ?>
		<?php echo $form->textField($model,'fr_address',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'fr_address'); ?>
	</div>
	 <div class="row">
		<?php echo $form->labelEx($contactmodel,'cr_type'); ?>
		<?php echo $form->radioButtonList($contactmodel,'cr_type',Contactrecord::$cr_type,array("style"=>"display:inline","separator"=>"&nbsp;","labelOptions"=>array("style"=>"display:inline"))); ?>
		<?php echo $form->error($contactmodel,'cr_type'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($contactmodel,'cr_grade'); ?>
		<?php echo $form->radioButtonList($contactmodel,'cr_grade',Contactrecord::$cr_grade,array("style"=>"display:inline","separator"=>"&nbsp;","labelOptions"=>array("style"=>"display:inline"))); ?>
		<?php echo $form->error($contactmodel,'cr_grade'); ?>
	</div>
        <?php if(!$userid){?>
            <div class="row">
                    <?php echo $form->labelEx($contactmodel,'cr_isregistered'); ?>
                    <?php echo $form->radioButtonList($contactmodel,'cr_isregistered',Contactrecord::$cr_type,array("style"=>"display:inline","separator"=>"&nbsp;","labelOptions"=>array("style"=>"display:inline"))); ?>
                    <?php echo $form->error($contactmodel,'cr_isregistered'); ?>
                    <span style="color: red"><?php echo $msgtip;?></span>
            </div>
        <?php }?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
     $.tools.dateinput.localize("fr",  {
    months:        '一月,二月,三月,四月,五月,六月,七月,八月,' +
                    '九月,十月,十一月,十二月',
    shortMonths:   '一月,二月,三月,四月,五月,六月,七月,八月,九月,十月,十一月,十二月',
    days:          '星期日,星期一,星期二,星期三,星期四,星期五,星期六',
    shortDays:     '周日,周一,周二,周三,周四,周五,周六'
});
$(":date").dateinput({
    selectors: true,
    lang: 'fr',
	format: 'yyyy-mm-dd'
});
</script>