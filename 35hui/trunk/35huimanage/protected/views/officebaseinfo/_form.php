<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'officebaseinfo-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">标明 <span class="required">*</span> 的为必填项.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_officename'); ?>
		<?php echo $form->textField($model,'ob_officename',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ob_officename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_province'); ?>
		<?php echo $form->dropDownList($model,'ob_province',$model->ob_province?Region::model()->getTarafUnits($model->ob_province):Region::model()->getAllProvince(),array('onBlur'=>"changeChildren('province')")); ?>
		<?php echo $form->error($model,'ob_province'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_city'); ?>
		<?php echo $form->dropDownList($model,'ob_city',Region::model()->getTarafUnits($model->ob_city),array('onBlur'=>"changeChildren('city')")); ?>
		<?php echo $form->error($model,'ob_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_district'); ?>
		<?php echo $form->dropDownList($model,'ob_district',Region::model()->getTarafUnits($model->ob_district),array('onBlur'=>"changeChildren('district')")); ?>
		<?php echo $form->error($model,'ob_district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_section'); ?>
		<?php echo $form->dropDownList($model,'ob_section',Region::model()->getTarafUnits($model->ob_section),array('onBlur'=>"changeChildren('section')")); ?>
		<?php echo $form->error($model,'ob_section'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_sysid'); ?>
		<?php echo $form->dropDownList($model,'ob_sysid',Systembuildinginfo::model()->getAllBuildingName()); ?>
		<?php echo $form->error($model,'ob_sysid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_uid'); ?>
		<?php echo $form->textField($model,'ob_uid'); ?>
		<?php echo $form->error($model,'ob_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_buildingtype'); ?>
		<?php echo $form->dropDownList($model,'ob_buildingtype',Officebaseinfo::$buildingType); ?>
		<?php echo $form->error($model,'ob_buildingtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_officetype'); ?>
		<?php echo $form->dropDownList($model,'ob_officetype',Officebaseinfo::$officeType); ?>
		<?php echo $form->error($model,'ob_officetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_loop'); ?>
		<?php echo $form->textField($model,'ob_loop'); ?>(数字)
		<?php echo $form->error($model,'ob_loop'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_tradecircle'); ?>
		<?php echo $form->dropDownList($model,'ob_tradecircle',Region::model()->getTarafUnits($model->ob_tradecircle)); ?>
		<?php echo $form->error($model,'ob_tradecircle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_busway'); ?>
		<?php echo $form->textField($model,'ob_busway',array('size'=>60,'maxlength'=>200)); ?>(数字,以“,”分割)
		<?php echo $form->error($model,'ob_busway'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_officeaddress'); ?>
		<?php echo $form->textField($model,'ob_officeaddress',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'ob_officeaddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_propertycomname'); ?>
		<?php echo $form->textField($model,'ob_propertycomname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ob_propertycomname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_propertycost'); ?>
		<?php echo $form->textField($model,'ob_propertycost'); ?>(数字,如:100)
		<?php echo $form->error($model,'ob_propertycost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_foreign'); ?>
		<?php echo $form->dropDownList($model,'ob_foreign',array(0=>'否',1=>'是')); ?>
		<?php echo $form->error($model,'ob_foreign'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_officearea'); ?>
		<?php echo $form->textField($model,'ob_officearea'); ?>
		<?php echo $form->error($model,'ob_officearea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_floortype'); ?>
		<?php echo $form->textField($model,'ob_floortype'); ?>
		<?php echo $form->error($model,'ob_floortype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_floornature'); ?>
		<?php echo $form->dropDownList($model,'ob_floornature',Officebaseinfo::$floorNature); ?>
		<?php echo $form->error($model,'ob_floornature'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_property'); ?>
		<?php echo $form->textField($model,'ob_property',array('size'=>60,'maxlength'=>200)); ?>(字符串)
		<?php echo $form->error($model,'ob_property'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_industry'); ?>
		<?php echo $form->dropDownList($model,'ob_industry',Searchfor::model()->loadFormatItems(Searchfor::industry)); ?>
		<?php echo $form->error($model,'ob_industry'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_towards'); ?>
		<?php echo $form->dropDownList($model,'ob_towards',Officebaseinfo::$toward); ?>
		<?php echo $form->error($model,'ob_towards'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_buildingera'); ?>
		<?php echo $form->textField($model,'ob_buildingera'); ?>(数字)
		<?php echo $form->error($model,'ob_buildingera'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_cancut'); ?>
		<?php echo $form->dropDownList($model,'ob_cancut',array(0=>'否',1=>'是')); ?>
		<?php echo $form->error($model,'ob_cancut'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_adrondegree'); ?>
		<?php echo $form->dropDownList($model,'ob_adrondegree',Officebaseinfo::$adrondegree); ?>
		<?php echo $form->error($model,'ob_adrondegree'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_officedegree'); ?>
		<?php echo $form->dropDownList($model,'ob_officedegree',Officebaseinfo::$officedegree); ?>
		<?php echo $form->error($model,'ob_officedegree'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_sellorrent'); ?>
		<?php echo $form->dropDownList($model,'ob_sellorrent',Officebaseinfo::$rentorsell); ?>
		<?php echo $form->error($model,'ob_sellorrent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_releasedate'); ?>
		<?php echo $form->textField($model,'ob_releasedate',array('value'=>date("Y-m-d H:i:s"))); ?>(请参照“2010-07-17 22:30:10”格式)
		<?php echo $form->error($model,'ob_releasedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_updatedate'); ?>
		<?php echo $form->textField($model,'ob_updatedate',array('value'=>date("Y-m-d H:i:s"))); ?>(请参照“2010-07-17 22:30:10”格式)
		<?php echo $form->error($model,'ob_updatedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_expiredate'); ?>
		<?php echo $form->textField($model,'ob_expiredate',array('value'=>date("Y-m-d H:i:s"))); ?>(请参照“2010-07-17 22:30:10”格式)
		<?php echo $form->error($model,'ob_expiredate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ob_tag'); ?>
		<?php
            $tags = Tags::model()->getTagsByTypeAndMarke(Tags::business,Tags::rent,12);
            $tagsarr = array();
            if(!empty($model->ob_tag)){
                $tagsarr = split(",", $model->ob_tag);
            }
            if(!empty($tags)){
                foreach($tags as $key=>$value){
            ?>
            <input type="checkbox" name="tag[]" value="<?=$value->tag_name;?>" <?php if(in_array($value->tag_name,$tagsarr))echo "checked"; ?> /><?=$value->tag_name?>&nbsp;&nbsp;
            <?php
                }
            }
            ?>
		<?php echo $form->error($model,'ob_tag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '增加' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    function changeChildren(type){
        var childrenHtml = "";
        var prefixStr = "Officebaseinfo_ob_";
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
</script>