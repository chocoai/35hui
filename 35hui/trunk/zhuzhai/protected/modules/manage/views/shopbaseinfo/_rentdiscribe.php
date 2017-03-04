<?php if($type=="show"){ ?>
<tr>
    <td width="16%" class="tit"><em>*</em> 面积：</td>
    <td width="84%" class="txtlou">
        <?php echo CHtml::textField("sb_shoparea",$shopBaseInfoModel->sb_shoparea,array("onblur"=>"checkAreaAndGetAvgRentPrice(this)","size"=>"10"));?>&nbsp;平方米(大于0的数字，可保留两位小数)&nbsp;<span class="errorMessage"></span>
    </td>
</tr>
<tr>
    <td width="16%" class="tit"><em>*</em> 日租金：</td>
    <td width="84%" class="txtlou">
        <?php echo CHtml::textField("sr_rentprice",$shopRentInfoModel->sr_rentprice,array("onblur"=>"checkRentPriceAndGetAvgRentPrice(this)","size"=>"10"));?>&nbsp;元/平米·天&nbsp;&nbsp;-&nbsp;
        月租金<font class="required_title">*</font>
        <?php echo CHtml::textField("sr_monthrentprice",$shopRentInfoModel->sr_monthrentprice!=0?$shopRentInfoModel->sr_monthrentprice:"",array("onblur"=>"checkMonthPrice(this)","size"=>"10"));?>
        &nbsp;元/月&nbsp;&nbsp;<span class="errorMessage"></span>
        <?php echo CHtml::error($shopRentInfoModel,'sr_monthrentprice'); ?>
    </td>
</tr>
<tr>
    <td width="16%" class="tit"> 起租年限：</td>
    <td width="84%" class="txtlou">
        <?php echo CHtml::textField("sr_basetime",$shopRentInfoModel->sr_basetime,array("maxlength"=>"4","size"=>5,"onblur"=>"CheckTime(this)"));?>&nbsp;年&nbsp;(代表最少要租多少年)&nbsp;<span class="errorMessage"></span>
    </td>
</tr>
<?php }else{ ?>
<tr>
    <td width="16%" class="tit"> 是否包含物业费：</td>
    <td width="84%" class="txtlou">
        <?php echo CHtml::radioButtonList("sr_iscontainprocost",
                $shopRentInfoModel->sr_iscontainprocost?
                    $shopRentInfoModel->sr_iscontainprocost
                    :"0",
                Shopbaseinfo::$sb_cancut,array("separator"=>"&nbsp"));?>
    </td>
</tr>
<tr>
    <td width="16%" class="tit"> 租赁方式：</td>
    <td width="84%" class="txtlou">
        <?php echo CHtml::radioButtonList("sr_renttype",
                $shopRentInfoModel->sr_renttype?
                $shopRentInfoModel->sr_renttype
                :"1",
                Lookup::items('renttype'),array("separator"=>"&nbsp"));?>
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
function checkAreaAndGetAvgRentPrice(obj){
    var check = checkArea(obj);
    if(check){
        CountAvgRentPrice();//计算月租金
    }
}
//验证租金
function CheckRentPrice(obj){
    var value = $.trim($(obj).val());
    if(value!=""){
        if(isNaN(value)){
            $(obj).nextAll("span").html("日租金只能为数字");
            $(obj).focus();
            return false;
        }else if(parseFloat(value)<=0 || parseInt(value)>=1000){
            $(obj).nextAll("span").html("日租金不合法，在0-1000之间，请重新输入");
            $(obj).focus();
            return false;
        }else{
            $(obj).nextAll("span").html("");
            return true;
        }
    }else {
         $(obj).nextAll("span").html("日租金不能为空");
         return false;
     }
}
function checkRentPriceAndGetAvgRentPrice(obj){
    var check = CheckRentPrice(obj);
    if(check){
        CountAvgRentPrice();
    }
}

/**
 *计算月租金
 **/
function CountAvgRentPrice(){
    var price = $.trim($("#sr_rentprice").val());
    var area = $.trim($("#sb_shoparea").val());
    if(price!=""&&area!=""){
        var avgprice = parseInt(parseFloat(price)*parseFloat(area)*365/12);
        $("#sr_monthrentprice").val(avgprice);
    }
}
/**
 * 验证月租金
 */
function checkMonthPrice(obj){
    var value = $.trim($(obj).val());
    if(value==""){
        $(obj).nextAll("span").html("月租金不能为空");
        return false;
    }else{
        if(isNaN(value)){
            $(obj).nextAll("span").html("月租金只能为数字");
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
    if(!CheckRentPrice($("#sr_rentprice"))){//验证租金
        $("#sr_rentprice").focus();
        return false;
    }
    if(!checkMonthPrice($("#sr_monthrentprice"))){//验证月租金
        $("#sr_monthrentprice").focus();
        return false;
    }
    if(!CheckTime($("#sr_basetime"))){//验证起租年限
        $("#sr_basetime").focus();
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