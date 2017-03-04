<div class="form">
    <style type="text/css">
        .red{color:red}
    </style>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domainkey-form',
	'enableAjaxValidation'=>false,
    "htmlOptions"=>array("onSubmit"=>"return checkForm()")
)); ?>

	<p class="note">请输入对方域名。</p>
    <?php echo $form->errorSummary($model); ?>
	<div class="row">
        <table border="1" width="100%">
            <?php
            if($model->dk_name){
                $arr = unserialize($model->dk_name);
                foreach($arr as $key=>$value){
            ?>
            <tr>
                <td width="50px"><?=$key!=0?"&nbsp;":"域名："?></td>
                <td>
                    <?=CHtml::textField("dk_name[]",$value,array("size"=>"30"));?><font>如：www.360dibiao.com (结尾不能包含/)</font><a href="javascript:void(0)" onclick="addOtherDomain()" style="<?=$key!=0?"display:none":""?>">添加</a><a href="javascript:void(0)" onclick="removeOtherDomain(this)" style="<?=$key==0?"display:none":""?>">删除</a>
                </td>
            </tr>
            <?php
                }
            }else{
            ?>
            <tr>
                <td width="50px">域名：</td>
                <td>
                    <?=CHtml::textField("dk_name[]","",array("size"=>"30"));?><font>如：www.360dibiao.com (结尾不能包含/)</font><a href="javascript:void(0)" onclick="addOtherDomain()">添加</a>
                </td>
            </tr>
            <?php
            }
            ?>
            
        </table>
        
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '保存' : '修改'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    var check;
    function addOtherDomain(){
        var html = "<tr><td>&nbsp;</td><td>";
        html += '<?=CHtml::textField("dk_name[]","",array("size"=>"30"));?><font>如：www.360dibiao.com (结尾不能包含/)</font><a href="javascript:void(0)" onclick="removeOtherDomain(this)" >删除</a>';
        html += '</td></tr>';
        $("table").append(html);
    }
    function checkForm(){
        check = 1;//验证通过
        var input = $("table input:[type='text']")
        $(input).each(function(){
            checkUrl($(this).val(),this)
        })
        if(check==1){
            return true;
        }else{
            return false;
        }
    }
    function removeOtherDomain(obj){
        $(obj).parentsUntil("tr").parent().remove();
    }
    function checkUrl(value,obj){
        value = $.trim(value);
        $(obj).next("font").html("");
        $(obj).next("font").removeClass("red");
        if(value==""){
            showError(obj,"不能为空");
        }
        var last = value.substr(value.length-1,1);
        if(last=="/"){
            showError(obj,"不能以“/”结尾！");
        }
        var first = value.substr(0,4);
        if(first=="http"){
            showError(obj,"不能包含“http”开头！");
        }
    }
    function showError(obj,msg){
        $(obj).next("font").html(msg);
        $(obj).next("font").addClass("red");
        check = 0;
    }
</script>