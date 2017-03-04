<script src="<?=Yii::app()->request->baseUrl;?>/js/dateinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/css/dateinput.css"/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contactrecord-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">标注 <span class="required">*</span> 号的为必填项.</p>
	<div class="row">
		<?php echo $form->labelEx($model,'cr_realname'); ?>
		<?php echo $form->textField($model,'cr_realname',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cr_realname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr_company'); ?>
		<?php echo $form->textField($model,'cr_company',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cr_company'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'cr_district'); ?>
                <?php echo $form->dropDownList($model,'cr_district',Region::model()->getTarafUnits($model->cr_district?$model->cr_district:37),array('onChange'=>"changeChildren('district')")); ?>
		<?php echo $form->error($model,'cr_district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cr_section'); ?>
                <?php echo $form->dropDownList($model,'cr_section',Region::model()->getTarafUnits($model->cr_section)); ?>
		<?php echo $form->error($model,'cr_section'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'cr_mainbusiness'); ?>
                 <?php echo $form->dropDownList($model,'cr_mainbusiness',Contactrecord::$cr_mainbusiness); ?>
		<?php echo $form->error($model,'cr_mainbusiness'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'cr_mobile'); ?>
		<?php echo $form->textField($model,'cr_mobile',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cr_mobile'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'cr_tel'); ?>
		<?php echo $form->textField($model,'cr_tel',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cr_tel'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'cr_qq'); ?>
		<?php echo $form->textField($model,'cr_qq',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cr_qq'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'cr_email'); ?>
		<?php echo $form->textField($model,'cr_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cr_email'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'cr_type'); ?>
		<?php echo $form->radioButtonList($model,'cr_type',Contactrecord::$cr_type,array("style"=>"display:inline","separator"=>"&nbsp;","labelOptions"=>array("style"=>"display:inline"))); ?>
		<?php echo $form->error($model,'cr_type'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'cr_grade'); ?>
		<?php echo $form->radioButtonList($model,'cr_grade',Contactrecord::$cr_grade,array("style"=>"display:inline","separator"=>"&nbsp;","labelOptions"=>array("style"=>"display:inline"))); ?>
		<?php echo $form->error($model,'cr_grade'); ?>
	</div>
        <?php if($model->isNewRecord=='新建'){?>
	<div class="row">
                <label>预约时间</label>
                <input type="date" name="fr_reservetime" min="1949-01-01" max="2099-12-30">
                <div></div>
	</div>
	<div class="row">
                <label>预约地址</label>
		<?php echo CHtml::textField("fr_address","",array('size'=>80,'maxlength'=>200)); ?>
                <div></div>
	</div>
        <?php }?>
	<div class="row">
		<?php echo $form->labelEx($model,'cr_remark'); ?>
		<?php echo $form->textArea($model,'cr_remark',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cr_remark'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    function changeChildren(type){
        var childrenHtml = "";
        var prefixStr = "Contactrecord_cr_";
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
if('<?=$model->cr_district?>' == ''){//新建联系人时，默认显示37编号区，显示完后，要加载该区的所有版块
    changeChildren('district');
}
</script>

