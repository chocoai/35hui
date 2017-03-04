<?php if($type=="show"){ ?>
<tr>
    <td width="16%" class="tit"><em>*</em> 面积：</td>
    <td width="84%" class="txtlou">
        <?php echo CHtml::textField("sb_shoparea",$shopBaseInfoModel->sb_shoparea,
                array("onblur"=>"checkAreaAndGetAvgPrice(this)","size"=>"10"));?>
        平方米(大于0的数字，可保留两位小数)&nbsp;<span class="errorMessage"></span>
    </td>
</tr>
<tr>
    <td width="16%" class="tit"><em>*</em> 售价：</td>
    <td width="84%" class="txtlou">
        总价 <input type="text" id="ss_sumprice" name="ss_sumprice" size="15" onblur="CheckSumSalePriceAndGetAvgPrice(this)" onkeyup="CheckSumSalePriceAndGetAvgPrice(this)" value="<?=CHtml::encode($shopSellInfoModel->ss_sumprice); ?>" />&nbsp;万元/套
        - 单价 <input type="text" id="ss_avgprice" name="ss_avgprice" size="10" onblur="CheckSalePrice(this)" value="<?=CHtml::encode($shopSellInfoModel->ss_avgprice); ?>" />&nbsp;元/平米&nbsp;&nbsp;
        <span class="errorMessage"></span>
        <?php echo CHtml::error($shopSellInfoModel,'ss_avgprice'); ?>
    </td>
</tr>
<?php } ?>
<script type="text/javascript">
//验证面积
function checkArea(obj){
    var value = $.trim($(obj).val());
    if(value!=""){
        if(isNaN(value)){
            $(obj).next("span").html("面积只能为数字");
            $(obj).focus();
            return false;
        }else if(parseFloat(value)<=0){
            $(obj).next("span").html("面积只能为正数");
            $(obj).focus();
            return false;
        }else{
            var RegExp1=new RegExp("^[0-9]+[.][0-9]{3,}$");
            if(RegExp1.test(value)){
                $(obj).next("span").html("面积只能保留两位小数");
                $(obj).focus();
                return false;
            }
            $(obj).next("span").html("");
            return true;
        }
    }else{
        $(obj).next("span").html("面积不能为空");
        return false;
    }
}
function checkAreaAndGetAvgPrice(obj){
    var check = checkArea(obj);
    if(check){
        CountAvgPrice();
    }
}
/**
 * 验证总售价
 */
var reg_float2=/^[1-9][0-9]*([.]\d{1,2})?$/;
function CheckSumSalePrice(obj){
   var value = $.trim($(obj).val());
   if(value!=""){
        if(! reg_float2.test(value)){
            $(obj).nextAll("span").html("售价只能为数字，可以有两位小数");
            $(obj).focus();
            return false;
        }else{
            $(obj).nextAll("span").html("");
            return true;
        }
    }else{
        $(obj).nextAll("span").html("售价不能为空");
        $(obj).focus();
        return false;
    }
}
/**
 * 验证总售价并得到均价
 */
function CheckSumSalePriceAndGetAvgPrice(obj){
    var check = CheckSumSalePrice(obj);
    if(check){
        CountAvgPrice();
    }
}
/**
 * 计算均价
 */
function CountAvgPrice(){
    var sum = $.trim($("#ss_sumprice").val());
    var area = $.trim($("#sb_shoparea").val());
    if(sum!=""&&area!=""){
        var avg = parseInt(parseFloat(sum)*10000/parseFloat(area));
        $("#ss_avgprice").val(avg);
    }
    
}
/**
 *验证均价
 **/
function CheckAvgPrice(obj){
    var value = $.trim($(obj).val());
    if(value==""){
        $(obj).nextAll("span").html("单价不能为空");
        return false;
    }else{
        if(isNaN(value) || value.indexOf('.')!=-1){
            $(obj).nextAll("span").html("单价只能为整数");
            return false;
        }else{
            $(obj).nextAll("span").html("");
            return true;
        }
    }
}
/**
 * 提交表单时验证
 */
function submitValidate(){
    //只有在商铺类型为2或者4的时候才查看小区
    if($("#td_sb_shoptype input:checked").val()=="2"||$("#td_sb_shoptype input:checked").val()=="4"){
        if($("#sb_sysid").val()==""){
            $("#buildName").next("span").html("请选择小区");
            $("#buildName").focus();
            return false;
        }
    }
    if(!checkAddress("#sb_shopaddress")){//验证地址
        $("#sb_shopaddress").focus();
        return false;
    }
    if(!validateNum($("#sb_propertycost"))){//验证物业费
        $("#sb_propertycost").focus();
        return false;
    }
    if(!checkArea($("#sb_shoparea"))){//验证面积
        $("#sb_shoparea").focus();
        return false;
    }
    if(!validateFloor($("#sb_floor"))){//验证楼层
        return false;
    }
    if(!CheckDataTotalFloor($("#sb_allfloor"))){//验证总楼层
        return false;
    }
    if(!CheckSumSalePrice($("#ss_sumprice"))){//验证总售价
        $("#ss_sumprice").focus();
        return false;
    }
    if(!CheckAvgPrice($("#ss_avgprice"))){//验证均价
        $("#ss_avgprice").focus();
        return false;
    }
    if(!checkSection($("#sb_section"))){//验证板块
        return false;
    }
    if(!CheckTitle($("#sp_shoptitle"))){//验证标题
        $("#sp_shoptitle").focus();
        return false;
    }
    if($.trim($("#sp_shopdesc").val())==""){
        alert("描述不能为空");
        return false;
    }
    if($("#sp_shopdesc").val().length>65535){
        alert("抱歉，您的描述内容太长！请截取一部分再试.");
        return false;
    }
    return true;
}
</script>