<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quickrelease-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('onsubmit'=>'return checkForm()'),
));
$_notices = array(
    'qrl_floor'=>'楼层请输入整数',
    'qrl_area'=>'面积请输入整数',
    'qrl_remark'=>'请填写价格以及额外房源信息',
    'qrl_contact'=>'您的姓名方便我们及时联系您',
    'qrl_tel'=>'请输入您的手机号码',
);
foreach($_notices as $key=>$val){
    if(empty($model->{$key}))
        $model->{$key}=$val;
}
?>
<style type="text/css">
    div.errorMessage { color: red;}
</style>
<table cellpadding="0" cellspacing="0" border="0" class="table_07">
    <tr>
        <td class="xdname" align="right" width="30%">委托类型：</td>
        <td width="70%" class="txt">
        <?php echo $form->dropDownList($model,'qrl_srtp',array('1'=>'出租','2'=>'出售')); ?>
		<?php echo $form->error($model,'qrl_srtp'); ?>
        </td>
    </tr>
    <tr>
        <td class="xdname" align="right" width="30%">选择楼盘：</td>
        <td width="70%">
        <?php
        $this->widget('CAutoComplete',
                array(
                'name'=>'buidname',
                'url'=>array('/site/ajaxautocomplete'),
                'max'=>10,//显示最大数
                'minChars'=>1,//最小输入多少开始匹配
                'delay'=>500, //两次按键间隔小于此值，则启动等待
                'mustMatch'=>1,
                'multiple'=>1,
                'scrollHeight'=>200,
                "extraParams"=>array('type'=>'1'),//表示是楼盘、商业广场还是小区
                'htmlOptions'=>array('class'=>'txt_8','id'=>'qrl_autocomplete'),
                "methodChain"=>".result(function(event,item){setBuid(item)})",
        ));
        echo $form->hiddenField($model,'qrl_sysid',array('class'=>'txt_8','id'=>'Quickrelease_qrl_sysid'));
        echo $form->error($model,'qrl_sysid'); ?>
        </td>
    </tr>
    <tr>
        <td class="xdname" align="right" width="30%">所处楼层：</td>
        <td width="70%">
        <?php
        echo $form->textField($model,'qrl_floor',array('class'=>'txt_8','onblur'=>'blurNotice(this)','onfocus'=>'focusNotice(this)'));
        echo $form->error($model,'qrl_floor'); ?>
        </td>
    </tr>
    <tr>
        <td class="xdname" align="right" width="30%">房源面积：</td>
        <td width="70%">
        <?php echo $form->textField($model,'qrl_area',array('class'=>'txt_8','onblur'=>'blurNotice(this)','onfocus'=>'focusNotice(this)')); ?>
        <?php echo $form->error($model,'qrl_area'); ?>
        </td>
    </tr>
    <tr>
        <td class="xdname" align="right" width="30%">装修情况：</td>
        <td width="70%">
        <?php echo $form->dropDownList($model,'qrl_zhuang',Officebaseinfo::$adrondegree); ?>
        </td>
    </tr>
    <tr>
        <td class="xdname" align="right" width="30%">房源备注：</td>
        <td width="70%">
        <?php echo $form->textArea($model,'qrl_remark',array('class'=>'tat','onblur'=>'blurNotice(this)','onfocus'=>'focusNotice(this)')); ?>
        <?php echo $form->error($model,'qrl_remark'); ?>
        </td>
    </tr>
    <tr>
        <td class="xdname" align="right" width="30%">联系人：</td>
        <td width="70%">
        <?php echo $form->textField($model,'qrl_contact',array('class'=>'txt_8','maxlength'=>10,'onblur'=>'blurNotice(this)','onfocus'=>'focusNotice(this)')); ?>
        <?php echo $form->error($model,'qrl_contact'); ?>
        </td>
    </tr>
    <tr>
        <td class="xdname" align="right" width="30%">联系电话：</td>
        <td width="70%">
        <?php echo $form->textField($model,'qrl_tel',array('class'=>'txt_8','maxlength'=>15,'onblur'=>'blurNotice(this)','onfocus'=>'focusNotice(this)')); ?>
        <?php echo $form->error($model,'qrl_tel'); ?>
        </td>
    </tr>
    <tr>
        <td width="30%"></td>
        <td width="70%"><?php  $this->widget('CCaptcha',array('showRefreshButton'=>'','clickableImage'=>1,'imageOptions'=>array('title'=>'看不清？点击更换')));?></td>
    </tr>
    <tr>
        <td class="xdname" align="right" width="30%">验证码：</td>
        <td width="70%">
        <?php echo $form->textField($model,'verifyCode',array('class'=>'txt_8','maxlength'=>15)); ?>
        <?php echo $form->error($model,'verifyCode'); ?>
        </td>
    </tr>
    <tr>
        <td width="30%">&nbsp;</td>
        <td width="70%"><?php echo CHtml::imageButton('/images/weituo.jpg') ?></td>
    </tr>
    
</table>

<?php $this->endWidget();?>

<script type="text/javascript">
    var FormNotice = {<?php
    foreach ($_notices as $key => $value) {
        echo $key.':"'.$value.'",';
    }
    ?>};
    var _nameReg = /\[(.*?)\]/;
    function getObjName(name){
        var match = _nameReg.exec(name);
        if(match.length>1)
            return match[1];
        else
            return name;
    }
    function blurNotice(obj){
        var value = $.trim(obj.value);
        var name = getObjName(obj.name);
        if(!value)
            obj.value=FormNotice[name];
    }
    function focusNotice(obj){
        var value = $.trim(obj.value);
        var name = getObjName(obj.name);
        if(value == FormNotice[name])
            obj.value="";
    }
    function setBuid(Data){
        if(Data)
            $("#Quickrelease_qrl_sysid").val(Data[1]);
    }
    function checkForm(){
        var item,input;
        for(item in FormNotice){
            input = $("#Quickrelease_"+item);
            if(input.val()==FormNotice[item]){
                input.val("");
            }
        }
        return true;
    }
<?php
if(empty($ownerBuild))
    $ownerBuild = '请输入楼盘名称';

?>
    $(function(){
        $("#qrl_autocomplete").val("<?php echo $ownerBuild ?>");
    });
</script>