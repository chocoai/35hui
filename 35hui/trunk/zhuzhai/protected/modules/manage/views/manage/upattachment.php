<?php
$this->breadcrumbs=array(
        "楼盘附件上传"
);
?>
<div class="htit">楼盘附件上传</div>
<div class="rgcont">
    <form action="" method="post" enctype="multipart/form-data" onSubmit="return validateForm(this)">
        <table border="0" cellpadding="0" cellspacing="0" class="table_01">
            <tr>
                <td width="16%" class="tit"><em>*</em> 楼盘类型：</td>
                <td width="84%" class="txtlou">
                    <?php echo CHtml::dropDownList('buidtype',$buidtype,array('1'=>'写字楼','2'=>'小区'),array('onchange'=>'resetFrom()'));?>
                </td>
            </tr>
            <tr>
                <td width="16%" class="tit"><em>*</em> 附件类型：</td>
                <td width="84%" class="txtlou">
                    <?php echo CHtml::dropDownList('atttype',$atttype,array('1'=>'楼书','2'=>'租赁合同'),array('onchange'=>'resetFrom()'));?>
                </td>
            </tr>
            <tr>
                <td width="16%" class="tit"><em>*</em> 楼盘名称：</td>
                <td width="84%" class="txtlou">
                    <?php $this->widget('CAutoComplete',
                            array(
                            'name'=>'buidname',
                            'url'=>array('/site/ajaxautocomplete'),
                            'max'=>10,//显示最大数
                            'minChars'=>1,//最小输入多少开始匹配
                            'delay'=>500, //两次按键间隔小于此值，则启动等待
                            'mustMatch'=>1,
                            'scrollHeight'=>200,
                            "extraParams"=>array("type"=>"js:AutoCompleteExtraParam"),//表示是楼盘、商业广场还是小区
                            'htmlOptions'=>array('class'=>'txt_02','id'=>'id_buidname','value'=>'世贸大厦'),
                            "methodChain"=>".result(function(event,item){setBuid(item)})",
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td width="16%" class="tit"><em>*</em> 文件：</td>
                <td width="84%" class="txtlou">
                    <input type="file" name="attachment" />
                    <em style="color:#808080;">(请上传rar或者zip格式文件，文件大小不能超过<?=$maxSize ?>MB。)</em></td>
            </tr>
            <tr>
                <td width="16%"></td>
                <td width="84%" class="txtlou">
                    <?php echo CHtml::submitButton('上传附件',array('name'=>'submit','class'=>"manage_input_button")); ?>
                </td>
            </tr>
        </table>
        <input type="hidden" id="id_buidid" name="buidid" value="<?php echo $buidid ?>"  />
    </form>
</div>
<div style="clear:both;height: 100px"></div>
<script type="text/javascript">
<?php
if(Yii::app()->user->hasFlash('showMessage')){
echo 'alert("'.Yii::app()->user->getFlash('showMessage').'");';
}
?>
    function validateForm(obj){
        var bid = $("#id_buidid").val();
        var file = $.trim(obj.attachment.value);
        if(bid == 0){
            alert("请指定楼盘。");
            return false;
        }
        if( ! file){
            alert("请选择附件。");
            return false;
        }
        return true;
    }
    function resetFrom(){
        $("#id_buidid").val('0');
        $("#id_buidname").val('');
    }
    function setBuid(Data){
        $("#id_buidid").val(Data[1]);
    }
    function AutoCompleteExtraParam(){
        var type=$("#buidtype").val();
        return type==2?'3':'1';
    }
<?php if($name){ ?>
    $(function(){
        $("#id_buidname").val("<?php echo $name ?>");
    })
    <?php } ?>
</script>