<script src="<?=Yii::app()->request->baseUrl;?>/js/dateinput.min.js"></script>
<style type="text/css">
    table td{margin: 1px;border: 1px gray solid;}
    .row table td label{display: inline;font-weight: normal}
    .row table th{background-color: #6FACCF;color:white}
</style>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/css/dateinput.css"/>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'businesscenter-form',
    'htmlOptions'=>array(
        'onsubmit'=>'return setForm();'
    ),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <table width="100%" >
            <th colspan="2">基本信息</th>
            <tr>
                <td width="50%">
                    <?php echo $form->labelEx($model,'bc_name'); ?>
                    <?php echo $form->textField($model,'bc_name',array('size'=>60,'maxlength'=>200)); ?>
                    <?php echo $form->error($model,'bc_name'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'bc_englishname'); ?>
                    <?php echo $form->textField($model,'bc_englishname',array('size'=>60,'maxlength'=>200)); ?>
                    <?php echo $form->error($model,'bc_englishname'); ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                    echo $form->labelEx($model,'bc_sysid');
                    $this->widget('CAutoComplete',
                            array(
                            'name'=>'buidname',
                            'url'=>array('/site/ajaxautocomplete'),
                            'max'=>10,//显示最大数
                            'minChars'=>1,//最小输入多少开始匹配
                            'delay'=>500, //两次按键间隔小于此值，则启动等待
                            'scrollHeight'=>200,
                            "extraParams"=>array('type'=>'1'),
                            'htmlOptions'=>array('class'=>'txt_4','id'=>'sys_buidname'),
                            "methodChain"=>".result(function(event,item){setBuid(item)})",
                    ));
                    
                    echo $form->hiddenField($model,'bc_sysid',array('id'=>'Businesscenter_bc_sysid'));
                    echo $form->error($model,'bc_sysid'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'bc_address'); ?>
                    <?php echo $form->textField($model,'bc_address',array('size'=>60,'maxlength'=>200)); ?>
                    <?php echo $form->error($model,'bc_address'); ?>
                </td>
                <td>
                    <?php
                    //$_RS = Yii::app()->db->createCommand('SELECT `re_id`,`re_name` FROM `35_region` WHERE `re_parent_id`=35 ORDER BY `re_order`')->queryAll();
                    $regionsDT = array();
                    foreach(Yii::app()->db->createCommand('SELECT `re_id`,`re_name` FROM `35_region` WHERE `re_parent_id`=35 ORDER BY `re_order`')->queryAll() as $v){
                        $regionsDT[$v['re_id']]=$v['re_name'];
                    }
                    echo $form->labelEx($model,'bc_district');
                    echo $form->dropDownList($model,'bc_district',$regionsDT,array('empty'=>'选择区域'));
                    echo $form->error($model,'bc_district'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'bc_completetime'); ?>
		<input type="date" name="bc_completetime" <?if($model->bc_completetime){ ?> value="<?=date("Y-m-d",$model->bc_completetime);?>" <? } ?> min="1980-01-01" max="<?php echo date("Y") ?>-12-30">
		<?php echo $form->error($model,'bc_completetime'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'bc_floor'); ?>
		<?php echo $form->textField($model,'bc_floor',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'bc_floor'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'bc_rentprice'); ?>
		<?php echo $form->textField($model,'bc_rentprice'); ?>元/月/工位
		<?php echo $form->error($model,'bc_rentprice'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'bc_serverbrand'); ?>
		<?php echo $form->textField($model,'bc_serverbrand',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'bc_serverbrand'); ?>
                </td>
            </tr>
            <tr>
                <td>
        <?php echo $form->labelEx($model,'bc_serverlanguage'); ?>
		<?php echo $form->textField($model,'bc_serverlanguage',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'bc_serverlanguage'); ?></td>
                <td>
        <?php echo $form->labelEx($model,'bc_decoratestyle'); ?>
		<?php echo $form->textField($model,'bc_decoratestyle',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'bc_decoratestyle'); ?></td>
            </tr>
            <tr>
                <td colspan="2">
        <?php echo $form->labelEx($model,'bc_connecttel'); ?>
		<?php echo $form->textField($model,'bc_connecttel',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'bc_connecttel'); ?></td>
            </tr>
            <tr>
                <th colspan="2">
                    <?php
                    $bc_traffic = unserialize($model->bc_traffic);
                    echo $form->labelEx($model,'bc_traffic');
                    ?>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    轨道交通:<input name="bc_traffic['轨道交通']" value="<?php echo @$bc_traffic['轨道交通']?>" type="text" size="60"/><br />
                    高　　架:<input name="bc_traffic['高架']" value="<?php echo @$bc_traffic['高架']?>" type="text" size="60"/><br />
                    机　　场:<input name="bc_traffic['机场']" value="<?php echo @$bc_traffic['机场']?>" type="text" size="60"/><br />
                    公 交 车:<input name="bc_traffic['公交车']" value="<?php echo @$bc_traffic['公交车']?>" type="text" size="60"/><br />
                    火 车 站:<input name="bc_traffic['火车站']" value="<?php echo @$bc_traffic['火车站']?>" type="text" size="60"/>
		<?php echo $form->error($model,'bc_traffic'); ?>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <?php
                    $bc_peripheral = unserialize($model->bc_peripheral);
                    echo $form->labelEx($model,'bc_peripheral');
                    ?>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    临近商街:<input name="bc_peripheral['临近商街']" value="<?php echo @$bc_peripheral['临近商街']?>" type="text" size="60"/><br />
                    商　　场:<input name="bc_peripheral['商场']" value="<?php echo @$bc_peripheral['商场']?>" type="text" size="60"/><br />
                    酒　　店:<input name="bc_peripheral['酒店']" value="<?php echo @$bc_peripheral['酒店']?>" type="text" size="60"/><br />
                    银　　行:<input name="bc_peripheral['银行']" value="<?php echo @$bc_peripheral['银行']?>" type="text" size="60"/><br />
                    餐　　饮:<input name="bc_peripheral['餐饮']" value="<?php echo @$bc_peripheral['餐饮']?>" type="text" size="60"/>
                    <?php echo $form->error($model,'bc_peripheral'); ?>
                </td>
            </tr>
        </table>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bc_introduce'); ?>
		<?php echo $form->textArea($model,'bc_introduce',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'bc_introduce'); ?>
	</div>
<?php
$bcServers = $bc_freeserver = $bc_payserver = array();
foreach(Yii::app()->db->createCommand('select * from {{businessserverconfig}}')->queryAll() as $val)
        $bcServers[$val['bs_id']]=$val['bs_name'];
if(!empty($model->bc_freeserver)){
    $model->bc_freeserver = explode(',', $model->bc_freeserver);
    foreach($model->bc_freeserver as $k){
        if(!isset($bcServers[$k])) continue;
        $bc_freeserver[$k] = $bcServers[$k];
        unset($bcServers[$k]);
    }
    $model->bc_freeserver = '';
}
if(!empty($model->bc_payserver)){
    $model->bc_payserver = explode(',', $model->bc_payserver);
    foreach($model->bc_payserver as $k){
        if(!isset($bcServers[$k])) continue;
        $bc_payserver[$k] = $bcServers[$k];
        unset($bcServers[$k]);
    }
    $model->bc_payserver = '';
}
?>
	<div class="row">
        <table width="100%" >
            <th colspan="3">服务内容</th>
            <tr>
                <td width="45%">
                    <?php echo CHtml::dropDownList('server_box','',$bcServers,array('size'=>12,'multiple'=>1)); ?>
                </td>
                <td  width="10%">
                    <input type="button" value=">>免费" onclick="changeServer('bc_freeserver_box')"><br/>
                    <input type="button" value=">>收费" onclick="changeServer('bc_payserver_box')"><br/>
                    <input type="button" value="移除<<" onclick="changeServer()">
                </td>
                <td width="45%">
                    <?php echo $form->labelEx($model,'bc_freeserver'); ?><br/>
                    <?php echo $form->dropDownList($model,'bc_freeserver',$bc_freeserver,array('id'=>'bc_freeserver_box','size'=>12,'multiple'=>1,'style'=>'width:200px')); ?><br/>
                    <?php echo $form->labelEx($model,'bc_payserver'); ?><br/>
                    <?php echo $form->dropDownList($model,'bc_payserver',$bc_payserver,array('id'=>'bc_payserver_box','size'=>12,'multiple'=>1,'style'=>'width:200px')); ?>
                </td>
            </tr>
        </table>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<script type="text/javascript">
function changeServer(to){
    if(to){
        var fromObj = $("#server_box");
        var select = fromObj.val();
        if(!select) {alert('没有选择服务');return false;}
        var options = [];
        $("#server_box option:selected").each(function(){
            options.push('<option value="'+$(this).attr('value')+'">'+$(this).text()+'</option>');
            $(this).remove();
        });
        $("#"+to).append(options.join("\n")).find('option');
    }else{
        var options = [];
        var values = [];
        $("#bc_freeserver_box option:selected").each(function(){
            values.push($(this).attr('value'));
            options.push('<option value="'+$(this).attr('value')+'">'+$(this).text()+'</option>');
            $(this).remove();
        });
        $("#bc_payserver_box option:selected").each(function(){
            values.push($(this).attr('value'));
            options.push('<option value="'+$(this).attr('value')+'">'+$(this).text()+'</option>');
            $(this).remove();
        });
        $("#server_box").append(options.join("\n")).val(values);
    }
}
function setForm(){
    $("#bc_freeserver_box option").attr('selected',true);
    $("#bc_payserver_box option").attr('selected',true);

    return true;
}
function setBuid(Data){
    if(Data)
        $("#Businesscenter_bc_sysid").val(Data[1]);
}
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
   $("#bc_freeserver_box option").live('dblclick',function(){
       $("#server_box").append('<option value="'+$(this).attr('value')+'">'+$(this).text()+'</option>').val($(this).attr('value'));
       $(this).remove();
   });
   $("#bc_payserver_box option").live('dblclick',function(){
       $("#server_box").append('<option value="'+$(this).attr('value')+'">'+$(this).text()+'</option>').val($(this).attr('value'));
       $(this).remove();
   });
<?php
if($model->bc_sysid){//sys_buidname
    $_temp = Systembuildinginfo::model()->findByPk($model->bc_sysid);
    if($_temp){
        echo '$("#sys_buidname").val("'.$_temp->sbi_buildingname.'")';
    }
}
?>
});
</script>