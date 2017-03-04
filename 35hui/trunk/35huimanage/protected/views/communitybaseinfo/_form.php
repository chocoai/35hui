<script src="<?=Yii::app()->request->baseUrl;?>/js/dateinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/css/dateinput.css"/>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KE.show({
    id : 'Communitybaseinfo_comy_introduce',
    resizeMode : 1,
    allowUpload : false,
    width : "70%",
    height : "200px",
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'link']
});
KE.show({
    id : 'Communitybaseinfo_comy_school',
    resizeMode : 1,
    allowUpload : false,
    width : "70%",
    height : "200px",
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'link']
});
KE.show({
    id : 'Communitybaseinfo_comy_shopping',
    resizeMode : 1,
    allowUpload : false,
    width : "70%",
    height : "200px",
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'link']
});
KE.show({
    id : 'Communitybaseinfo_comy_bank',
    resizeMode : 1,
    allowUpload : false,
    width : "70%",
    height : "200px",
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'link']
});
KE.show({
    id : 'Communitybaseinfo_comy_hospital',
    resizeMode : 1,
    allowUpload : false,
    width : "70%",
    height : "200px",
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'link']
});
KE.show({
    id : 'Communitybaseinfo_comy_dining',
    resizeMode : 1,
    allowUpload : false,
    width : "70%",
    height : "200px",
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'link']
});
KE.show({
    id : 'Communitybaseinfo_comy_vegetables',
    resizeMode : 1,
    allowUpload : false,
    width : "70%",
    height : "200px",
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'link']
});

KE.show({
    id : 'Communitybaseinfo_comy_other',
    resizeMode : 1,
    allowUpload : false,
    width : "70%",
    height : "200px",
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'link']
});
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'communitybaseinfo-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">标注 <span class="required">*</span> 号的为必填项.</p>
	<div class="row">
		<?php echo $form->labelEx($model,'comy_name'); ?>
		<?php echo $form->textField($model,'comy_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'comy_name'); ?>
        <input type="button" value="获得坐标" onClick="window.frames['framemapcommunity'].geocodeSearch()"/>
	</div>

    <div class="row">
        <?php
        $array = array();
        if(!$model->isNewRecord){
            $array = array(
                "x"=>urlencode($model->comy_x),
                "y"=>urlencode($model->comy_y),
                "name"=>urlencode("人民广场"),
            );
        }
        $frameurl = Yii::app()->createUrl("/map/framemapcommunity",$array);
        ?>
        <iframe id="framemapcommunity" name="framemapcommunity" src="<?=$frameurl;?>" width="100%" height="400px" frameborder="0" scrolling="no"></iframe>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_x'); ?>
		<?php echo $form->textField($model,'comy_x',array('size'=>60,'maxlength'=>200,'readonly'=>"true")); ?>坐标通过点击地址后面的“获得坐标”按钮获得
		<?php echo $form->error($model,'comy_x'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comy_y'); ?>
		<?php echo $form->textField($model,'comy_y',array('size'=>60,'maxlength'=>200,'readonly'=>"true")); ?>
		<?php echo $form->error($model,'comy_y'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_address'); ?>
		<?php echo $form->textField($model,'comy_address',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'comy_address'); ?>
	</div>

    <?php echo $form->labelEx($model,'comy_traffic'); ?>
    <div class="row"id="div_displaytraffic">
        <?php
            $trafficsarr = array();
            if(!empty($model->comy_traffic)){
                $trafficsarr = split(",", $model->comy_traffic);
            }
            $arr_num = count($trafficsarr);
            $count = 0;
            for($i=0; $i < $arr_num; $i++){
                if($trafficsarr[$i] != ''){
                    $traffic_info = Subway::model()->getNameById($trafficsarr[$i]);
                    $line = Subway::model()->getNameById($traffic_info->sw_parentid);
        ?>
                    <ul id="traffic_ul_<?=$count++?>">
                        <?php echo $line->sw_stationname."&nbsp;&nbsp;&nbsp;&nbsp;".$traffic_info->sw_stationname."(".$traffic_info->sw_id.")";?><a href="javascript:delete_traffic(<?=$count-1?>);">删除</a>
                        <input type="hidden" name="Communitybaseinfo_comy_traffic[]" id="Communitybaseinfo_comy_traffic<?php echo $i;?>" value="<?=$trafficsarr[$i];?>"
                    </ul>
        <?php }}?>
    </div>
    <div class="row">
        <?php
            echo CHtml::dropDownList("Communitybaseinfo_comy_line","",Subway::model()->getTarafUnits(1),array('onChange'=>"changeTrafficChildren(this.value)"));
            echo $form->dropDownList($model,'comy_id',Subway::model()->getTarafUnits(2));
        ?>
        <a href="javascript:trafficadd();">增加</a>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'comy_district'); ?>
        <?php echo $form->dropDownList($model,'comy_district',Region::model()->getTarafUnits($model->comy_district?$model->comy_district:37),array('onChange'=>"changeChildren('district')")); ?>
		<?php echo $form->error($model,'comy_district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comy_section'); ?>
        <?php echo $form->dropDownList($model,'comy_section',$model->comy_section!=0?Region::model()->getTarafUnits($model->comy_section):array()); ?>
		<?php echo $form->error($model,'comy_section'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_avgsellprice'); ?>
		<?php echo $form->textField($model,'comy_avgsellprice'); ?>元/平米（没有请填0）
		<?php echo $form->error($model,'comy_avgsellprice'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_cubagerate'); ?>
		<?php echo $form->textField($model,'comy_cubagerate'); ?>
		<?php echo $form->error($model,'comy_cubagerate'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_afforestation'); ?>
		<?php echo $form->textField($model,'comy_afforestation'); ?>%
		<?php echo $form->error($model,'comy_afforestation'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_parking'); ?>
		<?php echo $form->textField($model,'comy_parking'); ?>个
		<?php echo $form->error($model,'comy_parking'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_buildingera'); ?>
		<?php echo $form->textField($model,'comy_buildingera'); ?>年
		<?php echo $form->error($model,'comy_buildingera'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_houseown'); ?>
		<?php echo $form->textField($model,'comy_houseown'); ?>
		<?php echo $form->error($model,'comy_houseown'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'comy_saleaddress'); ?>
		<?php echo $form->textField($model,'comy_saleaddress',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'comy_saleaddress'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_saletel'); ?>
		<?php echo $form->textField($model,'comy_saletel'); ?>
		<?php echo $form->error($model,'comy_saletel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comy_propertyname'); ?>
		<?php echo $form->textField($model,'comy_propertyname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'comy_propertyname'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_propertytel'); ?>
		<?php echo $form->textField($model,'comy_propertytel',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'comy_propertytel'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'comy_propertyprice'); ?>
		<?php echo $form->textField($model,'comy_propertyprice'); ?>元/平方米/月
		<?php echo $form->error($model,'comy_propertyprice'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'comy_propertytype'); ?>
		<?php echo $form->dropDownList($model,'comy_propertytype',Communitybaseinfo::$propertyType); ?>
		<?php echo $form->error($model,'comy_propertytype'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'comy_developer'); ?>
		<?php echo $form->textField($model,'comy_developer',array('size'=>50,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'comy_developer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comy_buildingarea'); ?>
		<?php echo $form->textField($model,'comy_buildingarea'); ?>㎡
		<?php echo $form->error($model,'comy_buildingarea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comy_householdnum'); ?>
		<?php echo $form->textField($model,'comy_householdnum'); ?>
		<?php echo $form->error($model,'comy_householdnum'); ?>
	</div>
    <!--下面的七个字段共用字段-->
    <div class="row">
		<?php echo $form->labelEx($model,'comy_introduce'); ?>
		<?php echo $form->textArea($model,'comy_introduce',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comy_introduce'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'comy_school'); ?>
		<?php echo $form->textArea($model,'comy_school',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comy_school'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'comy_shopping'); ?>
		<?php echo $form->textArea($model,'comy_shopping',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comy_shopping'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'comy_bank'); ?>
		<?php echo $form->textArea($model,'comy_bank',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comy_bank'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'comy_hospital'); ?>
		<?php echo $form->textArea($model,'comy_hospital',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comy_hospital'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'comy_dining'); ?>
		<?php echo $form->textArea($model,'comy_dining',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comy_dining'); ?>
	</div>
     <div class="row">
		<?php echo $form->labelEx($model,'comy_vegetables'); ?>
		<?php echo $form->textArea($model,'comy_vegetables',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comy_vegetables'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'comy_other'); ?>
		<?php echo $form->textArea($model,'comy_other',array('rows'=>8, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comy_other'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    function changeChildren(type){
        var childrenHtml = "";
        var prefixStr = "Communitybaseinfo_comy_";
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
            }
        };
        var parentEle = prefixStr+regionArray[type]['parent'];
        var childEle = prefixStr+regionArray[type]['child'];
        var parentId = $('#'+parentEle).val();
        if(parentId!=""&&parentId!=null){
            $.ajax({
                type: "GET",
                url: "<?=Yii::app()->createUrl('region/ajaxGetChildren');?>",
                data: type+"="+parentId,
                success: function(childrenData){
                    if(childrenData!="[]"){
                        eval("var childrenData = " + childrenData + ";");
                        for(key in childrenData){
                            childrenHtml += "<option value="+key+">"+childrenData[key]+"</option>";
                        }
                        $("#"+childEle).html(childrenHtml);
                    }else{
                        $("#"+childEle).html("");
                    }
                    //把之后的所有选择框都去除
                    var nextnode = regionArray[type]['child'];
                    while(nextnode!="section"){
                        var id = prefixStr+regionArray[nextnode]['child'];
                        $("#"+id).html("");
                        nextnode = regionArray[nextnode]['child'];
                    }
                }
            });
        }
    }
    function changeTrafficChildren(type){
        var childrenHtml = "";
        if(type){
            $.ajax({
                type: "GET",
                url: "<?=Yii::app()->createUrl('subway/ajaxGetChildren/?');?>parentid="+type,
                success: function(childrenData){
                    if(childrenData!="[]"){
                        eval("var childrenData = " + childrenData + ";");
                        for(key in childrenData){
                            childrenHtml += "<option value="+key+">"+childrenData[key]+"</option>";
                        }
                    }
                    $("#Communitybaseinfo_comy_id").html(childrenHtml);
                }
            });
        }
    }

    var traffic_num = 0;
    var select_traffic_num = 0;
    var selected_traffic = new Array();
    function trafficadd() {
        var station_obj = document.getElementById('Communitybaseinfo_comy_id');
        var station_value = station_obj.value;
        if (!p_n_in_array(selected_traffic,station_value)) {
            var div_displaytraffic = document.getElementById("div_displaytraffic");
            var childObjs = div_displaytraffic.childNodes;
            if (traffic_num==0) {
                 var comy_traffic = document.getElementsByName("Communitybaseinfo_comy_traffic[]");
                for (var i = 0; i < comy_traffic.length; i++) {
                    traffic_num++;
                    selected_traffic[traffic_num-1]=comy_traffic[i].value;
                }
            }
            var line_obj = document.getElementById('Communitybaseinfo_comy_line');
            var line_value = line_obj.value;
            var line_text = "";
            for(var i=0;i<line_obj.options.length;i++){
              if(line_obj.options[i].value == line_value){
                  line_text = line_obj.options[i].text;
              }
            }
            var station_text = "";
            for(var i=0;i<station_obj.options.length;i++){
              if(station_obj.options[i].value == station_value){
                  station_text = station_obj.options[i].text;
              }
            }
            var add_html = "";
            add_html += line_text +"&nbsp;&nbsp;"+station_text+"("+station_value+ ')&nbsp;&nbsp;<a href="javascript:delete_traffic(' + traffic_num + ');">删除</a>';
            add_html += '<input type="hidden" name="Communitybaseinfo_comy_traffic[]" id="Communitybaseinfo_comy_traffic' + traffic_num + '" value="' + station_value + '"/>';
            add_html += '<input type="hidden" name="Communitybaseinfo_comy_line[]" id="Communitybaseinfo_comy_line' + traffic_num + '" value="' + line_value + '"/>';
            var ulObj = document.createElement('ul');
            ulObj.id = 'traffic_ul_' + traffic_num;
            ulObj.innerHTML = add_html;
            div_displaytraffic.appendChild(ulObj);
            selected_traffic[traffic_num] = station_value;
            traffic_num++;
        }
    }

    function delete_traffic() {
        selected_traffic[arguments[0]] = 0;
    	var traffic_ul = document.getElementById('traffic_ul_' + arguments[0]);
    	traffic_ul.parentNode.removeChild(traffic_ul);
//        $("#div_displaytraffic #traffic_ul_"+parseInt(arguments[0]-1)).remove();
    }

    function p_n_in_array() {
        var input_array = arguments[0];
        var input_value = arguments[1];
        var exist = false;
        for (var i = 0; i < input_array.length; i++) {
            if (input_array[i] == input_value) {
                exist = true;
                break;
            }
        }
        return exist;
    }
if('<?=$model->comy_district?>' == ''){//新增小区时，默认显示37编号区，显示完后，要加载该区的所有版块
    changeChildren('district');
}
</script>