<?php
$this->breadcrumbs=array(
        '站点建议/意见',
);
?>
<div class="htit">我的意见</div>
<div class="rgcont">
    <?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'msgrec-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('onSubmit'=>'return check_form();')
)); ?>
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td width="16%" class="tit"><em>*</em> 内容：</td>
            <td width="84%">
                <?php echo $form->textArea($model,'mr_content',array('onfocus'=>'msgInput_action(this,true)','onblur'=>'msgInput_action(this,false)','onkeyup'=>'keyPressCheck(this)',"class"=>"tax_01")); ?>
                <?php echo $form->error($model,'mr_content'); ?>
                <br />
                <em style="padding-top:5px; display:block;">温馨提示：您的意见和建议将会酌情使你的新币增加哦！</em><span id="commentHint" style="color:gray">( 0-1000个字符 )</span>
            </td>
        </tr>
        <tr>
            <td width="16%">&nbsp;</td>
            <td width="84%"><input type="submit" value="提交" style="width:100px;" /></td>
        </tr>
    </table>
    <?php $this->endWidget(); ?>
</div>
<div class="htit">历史记录</div>
<div class="yijiancont">
    <?php
$this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$sendProvider,
        'itemView'=>'_msgreclist',
        'summaryText'=>'',
        'summaryCssClass'=>'',
        'emptyText'=>'您暂时没有提建议/意见',
));
?>
</div>

<script type="text/javascript" language="javascript">
    var msgInfo = "请提意见，谢谢您的支持！意见被采纳将会奖励大量积分和新币！";
    function msgInput_action(obj,ifFocus){
        if(ifFocus){
            if($(obj).val()==msgInfo){
                $(obj).css('color','black');
                $(obj).val('');
            }
        }else{
            if($(obj).val()==''){
                $(obj).css('color','gray');
                $(obj).val(msgInfo);
                $('#commentHint').css('color','gray')
                $('#commentHint').html('( 0-1000个字符 )');
            }
        }
    }

    function keyPressCheck(obj){
        if($(obj).val().length>1000){
             $(obj).val($(obj).val().substring(0,1000));
        }else{
            var len=$(obj).val().length;
            if(len){
                var num=1000-len;
                if(num){
                    $('#commentHint').css('color','green')
                    $('#commentHint').html('您还可以输入'+num+'个字符');
                }else{
                    $('#commentHint').css('color','red')
                    $('#commentHint').html('抱歉，您输入的字符已达上限!多余字符已被截去.');
                }
            }
        }
    }

    function check_form(){
        if($('#Msgrec_mr_content').val()==msgInfo || $('#Msgrec_mr_content').val()==''){
            alert('抱歉，您没有输入任何建议（意见），不能发送！');
            return false;
        }
        return true;
    }
    $('#Msgrec_mr_content').css('color','gray');
    $('#Msgrec_mr_content').val(msgInfo);
</script>
