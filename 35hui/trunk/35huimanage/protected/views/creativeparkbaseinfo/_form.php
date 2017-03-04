<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/dateinput.min.js"></script>
<style type="text/css">
    table td{margin: 1px;border: 1px gray solid;}
    .row table td label{display: inline;font-weight: normal}
    .row table th{background-color: #6FACCF;color:white}
    .input-num { text-align: right; color: red;}
    div.form label { display: inline; font-weight: normal; margin-right: 5px;}
</style>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/css/dateinput.css"/>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'creativeparkbaseinfo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <table width="100%" >
            <th colspan="2">基本信息</th>
            <tr>
                <td width="50%">
                    <?php echo $form->labelEx($model,'cp_name');
                    echo $form->textField($model,'cp_name',array('size'=>60,'maxlength'=>200));
                    echo $form->error($model,'cp_name'); ?>
                </td>
                <td>
                    <?php
                    $regionsDT = array();
                    foreach(Yii::app()->db->createCommand('SELECT `re_id`,`re_name` FROM `35_region` WHERE `re_parent_id`=35 ORDER BY `re_order`')->queryAll() as $v){
                        $regionsDT[$v['re_id']]=$v['re_name'];
                    }
                    echo $form->labelEx($model,'cp_district');
                    echo $form->dropDownList($model,'cp_district',$regionsDT,array('empty'=>'==区域=='));
                    echo $form->error($model,'cp_district'); ?>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <?php echo $form->labelEx($model,'cp_englishname');
                    echo $form->textField($model,'cp_englishname',array('size'=>60,'maxlength'=>200));
                    echo $form->error($model,'cp_englishname'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'cp_avgrentprice');
                    echo $form->textField($model,'cp_avgrentprice', array('class'=>'input-num','size'=>'10')),' 元/平米';
                    echo $form->error($model,'cp_avgrentprice'); ?>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <?php echo $form->labelEx($model,'cp_address');
                    echo $form->textField($model,'cp_address',array('size'=>40,'maxlength'=>200));
                    echo $form->error($model,'cp_address'); ?>
                    <input type="button" value="获得坐标" onClick="window.frames['framemap'].geocodeSearch($('#Creativeparkbaseinfo_cp_address').val())"/><br />
                    <?php echo $form->labelEx($model,'cp_x'); ?>
                    <?php echo $form->textField($model,'cp_x',array('size'=>15,'readonly'=>"true", 'class'=>'input-num')); ?>
                    <?php echo $form->labelEx($model,'cp_y'); ?>
                    <?php echo $form->textField($model,'cp_y',array('size'=>15,'readonly'=>"true",  'class'=>'input-num')); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'cp_developer'); ?>
		<?php echo $form->textField($model,'cp_developer',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'cp_developer'); ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
        $array = array();
        if(!$model->isNewRecord){
            $array = array(
                    "name"=>urlencode("人民广场"),
            );
            $model->cp_x?$array["x"] = urlencode($model->cp_x):"";
            $model->cp_y?$array["y"] = urlencode($model->cp_y):"";
        }
        $frameurl = Yii::app()->createUrl("/map/framemap",$array);
        ?>
        <iframe id="framemap" name="framemap" src="<?=$frameurl;?>" width="100%" height="400px" frameborder="0" scrolling="no"></iframe>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <?php echo $form->labelEx($model,'cp_propertyname'); ?>
		<?php echo $form->textField($model,'cp_propertyname',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'cp_propertyname'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'cp_openingtime'); ?>
		<input type="date" name="cp_openingtime" <?if($model->cp_openingtime){ ?> value="<?=date("Y-m-d",$model->cp_openingtime);?>" <? } ?> min="1980-01-01" max="<?php echo date("Y") ?>-12-30">
		<?php echo $form->error($model,'cp_openingtime'); ?>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <?php echo $form->labelEx($model,'cp_defanglv'); ?>
		<?php echo $form->textField($model,'cp_defanglv', array('class'=>'input-num','size'=>'10')); ?> %
		<?php echo $form->error($model,'cp_defanglv'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'cp_propertyprice'); ?>
		<?php echo $form->textField($model,'cp_propertyprice', array('class'=>'input-num','size'=>'10')); ?> 元/平米/月
		<?php echo $form->error($model,'cp_propertyprice'); ?>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <?php echo $form->labelEx($model,'cp_area'); ?>
		<?php echo $form->textField($model,'cp_area', array('class'=>'input-num','size'=>'10')); ?> 平米
		<?php echo $form->error($model,'cp_area'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'cp_fengearea'); ?>
		<?php echo $form->textField($model,'cp_fengearea',array('size'=>20,'maxlength'=>20)); ?> 如：100,200
		<?php echo $form->error($model,'cp_fengearea'); ?>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <?php echo $form->labelEx($model,'cp_floorheight'); ?>
		<?php echo $form->textField($model,'cp_floorheight',array('size'=>20,'maxlength'=>20)); ?> 平米 如：4.5或者3.5-5
		<?php echo $form->error($model,'cp_floorheight'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'cp_form'); ?>
		<?php echo $form->textField($model,'cp_form',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cp_form'); ?>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <?php
                    $cp_traffic = unserialize($model->cp_traffic);
                    echo $form->labelEx($model,'cp_traffic');
                    ?>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    轨道交通:<input name="cp_traffic[guidao]" value="<?php echo @$cp_traffic['guidao']?>" type="text" size="60"/><br />
                    高　　架:<input name="cp_traffic[gaojia]" value="<?php echo @$cp_traffic['gaojia']?>" type="text" size="60"/><br />
                    机　　场:<input name="cp_traffic[jichang]" value="<?php echo @$cp_traffic['jichang']?>" type="text" size="60"/><br />
                    公 交 车:<input name="cp_traffic[gongjiao]" value="<?php echo @$cp_traffic['gongjiao']?>" type="text" size="60"/><br />
                    火 车 站:<input name="cp_traffic[huoche]" value="<?php echo @$cp_traffic['huoche']?>" type="text" size="60"/>
		<?php echo $form->error($model,'cp_traffic'); ?>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <?php
                    $cp_peripheral = unserialize($model->cp_peripheral);
                    echo $form->labelEx($model,'cp_peripheral');
                    ?>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    临近商街:<input name="cp_peripheral[shangjie]" value="<?php echo @$cp_peripheral['shangjie']?>" type="text" size="60"/><br />
                    商　　场:<input name="cp_peripheral[shangchang]" value="<?php echo @$cp_peripheral['shangchang']?>" type="text" size="60"/><br />
                    酒　　店:<input name="cp_peripheral[jiudian]" value="<?php echo @$cp_peripheral['jiudian']?>" type="text" size="60"/><br />
                    银　　行:<input name="cp_peripheral[yinhang]" value="<?php echo @$cp_peripheral['yinhang']?>" type="text" size="60"/><br />
                    餐　　饮:<input name="cp_peripheral[canyin]" value="<?php echo @$cp_peripheral['canyin']?>" type="text" size="60"/>
                    <?php echo $form->error($model,'cp_peripheral'); ?>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <?php
                    $cp_carport = unserialize($model->cp_carport);
                    echo $form->labelEx($model,'cp_carport');
                    ?>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    地上:<input name="cp_carport[dishang]" class="input-num" value="<?php echo @$cp_carport['dishang']?>" type="text" size="6" maxlength="5"/>个
                    <input name="cp_carport[dishangyue]" class="input-num" value="<?php echo @$cp_carport['dishangyue']?>" type="text" size="6" maxlength="5"/>元/月
                    <input name="cp_carport[dishangshi]" class="input-num" value="<?php echo @$cp_carport['dishangshi']?>" type="text" size="6" maxlength="5"/>元/时 <br />
                    地下:<input name="cp_carport[dixia]" class="input-num" value="<?php echo @$cp_carport['dixia']?>" type="text" size="6" maxlength="5"/>个
                    <input name="cp_carport[dixiayue]" class="input-num" value="<?php echo @$cp_carport['dixiayue']?>" type="text" size="6" maxlength="5"/>元/月
                    <input name="cp_carport[dixiashi]" class="input-num" value="<?php echo @$cp_carport['dixiashi']?>" type="text" size="6" maxlength="5"/>元/时 <br />
                    <?php echo $form->error($model,'cp_carport'); ?>
                </td>
            </tr>
        </table>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cp_introduce'); ?>：<br/>
		<?php echo $form->textArea($model,'cp_introduce',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cp_introduce'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cp_propertyserver'),'：';
        if($model->cp_propertyserver)
                $model->cp_propertyserver = explode(',', $model->cp_propertyserver);
        echo $form->checkBoxList($model,'cp_propertyserver', Creativeparkbaseinfo::$cp_propertyserver,array('separator'=>' ')); ?>
		<?php echo $form->error($model,'cp_propertyserver'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'cp_roommating'),'：';
        if($model->cp_roommating)
                $model->cp_roommating = explode(',', $model->cp_roommating);
        echo $form->checkBoxList($model,'cp_roommating', Creativeparkbaseinfo::$cp_roommating,array('separator'=>' ')); ?>
		<?php echo $form->error($model,'cp_roommating'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$(function(){
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
});
function setLocalXY(x,y){
    $("#Creativeparkbaseinfo_cp_x").val(x);
    $("#Creativeparkbaseinfo_cp_y").val(y);
}
</script>