<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'demendcollect-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">标注 <span class="required">*</span> 为必填项</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'dc_type'); ?>
		<?php echo $form->radioButtonList($model,'dc_type',Demendcollect::$dc_type,array("style"=>"display:inline","separator"=>"&nbsp;","labelOptions"=>array("style"=>"display:inline"))); ?>
		<?php echo $form->error($model,'dc_type'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'dc_buildtype'); ?>
		<?php echo $form->radioButtonList($model,'dc_buildtype',Demendcollect::$dc_buildtype,array("style"=>"display:inline","separator"=>"&nbsp;","labelOptions"=>array("style"=>"display:inline"))); ?>
		<?php echo $form->error($model,'dc_buildtype'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'dc_buildname'); ?>
		<?php echo $form->textField($model,'dc_buildname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'dc_buildname'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'dc_district'); ?>
                <?php echo $form->dropDownList($model,'dc_district',Region::model()->getTarafUnits($model->dc_district?$model->dc_district:37),array('onChange'=>"changeChildren('district')")); ?>
		<?php echo $form->error($model,'dc_district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_section'); ?>
                <?php echo $form->dropDownList($model,'dc_section',Region::model()->getTarafUnits($model->dc_section)); ?>
		<?php echo $form->error($model,'dc_section'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'dc_address'); ?>
		<?php echo $form->textField($model,'dc_address',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'dc_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_area'); ?>
		<?php echo $form->textField($model,'dc_area'); ?>平米
		<?php echo $form->error($model,'dc_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_price'); ?>
		<?php echo $form->textField($model,'dc_price'); ?>
		<?php echo $form->error($model,'dc_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_floor'); ?>
		<?php echo $form->textField($model,'dc_floor'); ?>层
		<?php echo $form->error($model,'dc_floor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_contactname'); ?>
		<?php echo $form->textField($model,'dc_contactname',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'dc_contactname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_tel'); ?>
		<?php echo $form->textField($model,'dc_tel',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'dc_tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_mobile'); ?>
		<?php echo $form->textField($model,'dc_mobile',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'dc_mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_email'); ?>
		<?php echo $form->textField($model,'dc_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'dc_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_qq'); ?>
		<?php echo $form->textField($model,'dc_qq',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'dc_qq'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'dc_memo'); ?>(公司行业、目前办公或住房地址、其他意向小区/大楼/地区、房源的特别要求)
		<?php echo $form->textArea($model,'dc_memo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'dc_memo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    function changeChildren(type){
        var childrenHtml = "";
        var prefixStr = "Demendcollect_dc_";
        var regionArray = {
            'province':{
                'parent':'province',
                'child':'city'
            },
            'city':{
                'parent':'city',
                'child':'district'
            },
            'district':{
                'parent':'district',
                'child':'section'
            },
            'section':{
                'parent':'section',
                'child':'tradecircle'
            }
        };
        var parentEle = prefixStr+regionArray[type]['parent'];
        var childEle = prefixStr+regionArray[type]['child'];
        var parentId = $('#'+parentEle).val();
        if(parentId!=""){
            $.ajax({
                type: "GET",
                url: "<?=Yii::app()->createUrl('region/ajaxGetChildren');?>",
                data: type+"="+parentId,
                success: function(childrenData){
                    eval("var childrenData = " + childrenData + ";");
                    for(key in childrenData){
                        childrenHtml += "<option value="+key+">"+childrenData[key]+"</option>";
                    }
                    $("#"+childEle).html(childrenHtml);
                }
            });
        }
    }
   if('<?=$model->dc_district?>' == ''){//新建联系人时，默认显示37编号区，显示完后，要加载该区的所有版块
        changeChildren('district');
    }
</script>