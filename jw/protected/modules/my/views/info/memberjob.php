<style type="text/css">
    .errorMessage{color:red}
</style>
<div class="zftnav">
    <ul>
        <li class="clk">我的档案</li>
    </ul>
</div>
<?php
$form=$this->beginWidget('CActiveForm', array(
        'id'=>'infobase-form',
        'enableAjaxValidation'=>false,
)); ?>
<div class="jbmain">
    <?=$this->renderPartial("_leftmembermenu")?>
    <div class="jbcont">
        <h1>工作信息</h1>
        <div class="ln">
            <?=$form->radioButtonList($model, 'type', array('1'=>'我是自由人','2'=>'我在公司工作'),array("onChange"=>"changeType(this)",'separator'=>' '));?>
        </div>
        <div id="companydivinfo" style="display: <?=$model->type=="1"?"none":""?>">
            <div class="ln">所在公司</div>
            <div class="ln">
                <?=$form->dropDownList($model, "district",$district,array("empty"=>"--请选择--","onChange"=>"changeNext(this)"))?>
                <?php echo $form->dropDownList($model, "mem_company",$companyname,array("empty"=>"--请选择--","onChange"=>"showaddress(this)"));
                echo $form->error($model,'mem_company');
                ?>
            </div>
            <div class="ln" id="address"></div>
            <div class="ln">工号</div>
            <div class="ln">
                <?php
                echo $form->textField($model,'mem_jobnumber',array('class'=>'txt_02'));
                echo $form->error($model,'mem_jobnumber');
                ?>
            </div>
        </div>
        <div class="ln" style="text-align:center;"><input type="submit" class="btn_04" value="保 存" onclick="return checkForm()"/> </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function(){
<?php if(Yii::app()->user->getFlash('message')) { ?>jw.pop.alert("修改成功",{autoClose:1000})<?php } ?>
    });
    function changeNext(obj){
        var district = $(obj).val();
        var html = "<option value>--请选择--</option>";
        if(!district){
            $(obj).nextAll("select").html(html);//删除后面所有的选择。
        }else{
            $.ajax({
                url: "<?php echo Yii::app()->createUrl("/companymanage/getcompanyname") ?>",
                type: "GET",
                data: "district="+district,
                async: false,
                success: function(msg){
                    var msg = eval("("+msg+")");
                    $(obj).nextAll("select").html(html);//删除后面所有的选择。
                    var index = "";
                    for(index in msg){
                        html += "<option value='"+index+"'>"+msg[index]+"</option>";
                    }
                    $(obj).next("select").html(html);
                }
            });
        }
    }
    function showaddress(obj){
        var company = $(obj).val();
        if(!company){
            $("#address").css("display","none");
            return false;
        }
        $("#address").css("display","");
        $("#address").html("<img src='/images/loading.gif' width='25px' />");
        $.post("/companymanage/getcompanyaddress", {"company":company}, function(msg){
            $("#address").html("地址："+msg);
        }, "text");
    }
    function changeType(obj){
        var type = $(obj).val();
        if(type==1){
            $("#companydivinfo").css("display","none");
        }else{
            $("#companydivinfo").css("display","");
        }
    }
    function checkForm(){
        var type = $("form input[name='InfoMemberJobForm[type]']:checked").val()
        $("#InfoMemberJobForm_mem_company").next('p').html("");
        $("#InfoMemberJobForm_mem_jobnumber").next('p').html("");
        if(type==2){
            var check = 0;
            var company = $("#InfoMemberJobForm_mem_company").val();
            if(!company){
                check = 1;
                $("#InfoMemberJobForm_mem_company").after('<p style="color:red">请选择所在公司</p>');
            }
            var jobNumber = $.trim($("#InfoMemberJobForm_mem_jobnumber").val())
            if(!jobNumber){
                check = 1;
                $("#InfoMemberJobForm_mem_jobnumber").after('<p style="color:red">请输入工号</p>');
            }
            if(jobNumber.length>16){
                check = 1;
                $("#InfoMemberJobForm_mem_jobnumber").after('<p style="color:red">工号最长16个字符</p>');
            }
            if(check==1){
                return false;
            }
        }
        $("form").submit();
    }
</script>