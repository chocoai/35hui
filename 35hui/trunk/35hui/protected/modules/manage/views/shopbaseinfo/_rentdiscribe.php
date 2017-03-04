
<tr>
    <td width="16%" class="tit"><em>*</em> 面积：</td>
    <td width="84%" class="txtlou">
        <?php echo CHtml::textField("sb_shoparea",$shopBaseInfoModel->sb_shoparea,array("onblur"=>"checkAreaAndGetAvgRentPrice(this)","size"=>"10"));?>&nbsp;平方米(大于0的数字，可保留两位小数)&nbsp;<span class="errorMessage"></span>
		<?=CHtml::checkBox("sb_cancut",$shopBaseInfoModel->sb_cancut,Shopbaseinfo::$sb_cancut,array("separator"=>"&nbsp"));?>
        是否可分
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
    <td width="16%" class="tit"> 交租方式</td>
    <?
    if($shopRentInfoModel->sr_paytype!=0){
        $shopRentInfoModel->sr_paytype=explode(',',$shopRentInfoModel->sr_paytype);
    }?>
    <td>    <?php echo CHtml::radioButton("sr_paytype[pay]",$shopRentInfoModel->sr_paytype?1:0,array('value'=>"1")) ?>
            付<?php echo CHtml::dropDownList("sr_paytype[f]",$shopRentInfoModel->sr_paytype?$shopRentInfoModel->sr_paytype[0]:'',Shopbaseinfo::$paytype,array('empty'=>'请选择')) ?>
            押<?php echo CHtml::dropDownList("sr_paytype[y]",$shopRentInfoModel->sr_paytype?$shopRentInfoModel->sr_paytype[1]:'',Shopbaseinfo::$mortgagetype,array('empty'=>'请选择')) ?>
            <?php echo CHtml::radioButton("sr_paytype[pay]",$shopRentInfoModel->sr_paytype?0:1,array('value'=>"2")) ?> 面议
	</td>
</tr>

<tr>
    <td width="16%" class="tit"> 租赁方式：</td>
    <td width="84%" class="txtlou">
        <?php echo CHtml::radioButtonList("sr_renttype",
                $shopRentInfoModel->sr_renttype?
                $shopRentInfoModel->sr_renttype
                :"1",
                Lookup::items('renttype'),array("separator"=>"&nbsp",'onclick'=>'checkType(this,2);'));?>
		<div>
		<?php
		$transferprice="";
		$transferType="3";
		if($shopRentInfoModel->sr_transferprice=="NULL"){
			$transferType="2";
		}elseif($shopRentInfoModel->sr_transferprice>0){
			$transferprice=$shopRentInfoModel->sr_transferprice;
			$transferType="1";
		}
		$arraytype=array(1=>CHtml::textField("transferprice",$transferprice,array("size"=>"10"))."万元",2=>"面议",3=>"无");
		?>
        <div id="renttype_list" ><?= CHtml::radioButtonList("sr_transferprice",$transferType,$arraytype,array("separator"=>"&nbsp"));?></div>
		</div>
    </td>
</tr>
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
</script>