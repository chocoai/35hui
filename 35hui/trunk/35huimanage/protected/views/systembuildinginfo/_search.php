<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sbi_buildingid'); ?>
		<?php echo $form->textField($model,'sbi_buildingid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_buildingname'); ?>
		<?php echo $form->textField($model,'sbi_buildingname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_district'); ?>
        <?php echo $form->dropDownList($model,'sbi_district',Region::model()->getFormatChildrenData(35),array('onChange'=>"changeChildren('district')",'empty'=>"---请选择---")); ?>

        <?php echo $form->dropDownList($model,'sbi_section',Region::model()->getTarafUnits($model->sbi_section),array('onChange'=>"changeChildren('section')",'empty'=>"---请选择---")); ?>

		<?php echo $form->dropDownList($model,'sbi_tradecircle',Region::model()->getTarafUnits($model->sbi_tradecircle),array('empty'=>"---请选择---")); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_loop'); ?>
		<?php echo $form->dropDownList($model,'sbi_loop',Searchcondition::model()->getAllLoops()); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_busway'); ?>
		<?php echo $form->textField($model,'sbi_busway',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sbi_address'); ?>
		<?php echo $form->textField($model,'sbi_address',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('查找'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<script type="text/javascript">
    function changeChildren(type){
        var childrenHtml = "<option value>---请选择---</option>";
        var prefixStr = "Systembuildinginfo_sbi_";
        var regionArray = {
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
        }else{
            $("#"+parentEle).nextAll("select").html(childrenHtml);
        }
    }
</script>
