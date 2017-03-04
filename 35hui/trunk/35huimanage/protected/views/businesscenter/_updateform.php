<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">修改商务中心信息</div>
    <div class="manage_rightboxthree">
        <form action="" method="post" onsubmit="return validateForm()">
            <?php echo $this->renderPartial('_formdiscribe', array('model'=>$model,'districtlist'=>$districtlist,'sectionlist'=>$sectionlist,'allLoop'=>$allLoop)); ?>
            <div style="float:right;margin-right: 55px ">
                <?php echo CHtml::submitButton('保存',array('name'=>'submit','class'=>"manage_input_button")); ?>
                <?php echo CHtml::Button('取消',array('class'=>"manage_input_button","onclick"=>"history.go(-1)")); ?>
            </div>
        </form>
    </div>
    <div class="manage_righttwoline"></div>
</div>
<script type="text/javascript">
//点击提交时触发此函数
function validateForm(){
    if($("#ob_sysid").val()==""){
        $("#ofname").next("span").html("请选择小区");
        $("#ofname").focus();
        return false;
    }
    if(!checkArea($("#ob_officearea"))){//验证面积
        $("#ob_officearea").focus();
        return false;
    }
    if(!CheckSalePrice($("#os_sumprice"))){//验证售价
        $("#os_sumprice").focus();
        return false;
    }
    if(!validateNum($("#ob_propertycost"))){//验证物业费
        $("#ob_propertycost").focus();
        return false;
    }
    if(!CheckTitle($("#op_officetitle"))){//验证标题
        $("#op_officetitle").focus();
        return false;
    }
    if($("#op_officedesc").val()==""){
        alert("描述不能为空");
        return false;
    }
}
</script>