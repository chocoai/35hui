<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tags-form',
	'enableAjaxValidation'=>false,
));
//租售下拉框显示值限制
$markeytypeSelectArr=array('2'=>'不限');//楼盘1，大型项目5只有不限
?>

	<p class="note">带 <span class="required">*</span> 的必填项.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tag_name'); ?>
		<?php echo $form->textField($model,'tag_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'tag_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tag_belong'); ?>
		<?php echo $form->dropDownList($model,'tag_belong',Tags::$tag_belong,array('onchange'=>'change_markettype(this)')); ?>
		<?php echo $form->error($model,'tag_belong'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tag_frequency'); ?>
		<?php echo $form->textField($model,'tag_frequency'); ?>
		<?php echo $form->error($model,'tag_frequency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'markettype'); ?>
		<?php echo $form->dropDownList($model,'markettype',$markeytypeSelectArr); ?>
		<?php echo $form->error($model,'markettype'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script language="javascript" type="text/javascript">
    <!--

    function change_markettype(tag_belong_obj){
        var arr=new Array();
        if('234'.indexOf(tag_belong_obj.value)>=0){ //写字楼2，工厂3，商铺4，只有租和售
            arr[0]=0;
            arr[1]=1;
        }else if('157'.indexOf(tag_belong_obj.value)>=0){//楼盘1，大型项目5只有不限
            arr[0]=2;
        }else if('6'.indexOf(tag_belong_obj.value)>=0){//商务中心6只有租
            arr[0]=0;
        }
        document.getElementById('Tags_markettype').outerHTML=get_markettype_select(arr);
    }
     function get_markettype_select(arr){
        var str='<select name="Tags[markettype]" id="Tags_markettype">';
    
        for(var i=0;i<arr.length;i++){
            if(arr[i]==0){              
                str +='<option value="0">租</option>';
            }else if(arr[i]==1){
                str +='<option value="1">售</option>';
            }else if(arr[i]==2){
                str +='<option value="2">不限</option>';
            }
        }
        return str+'</select>';
     }


    --></script>