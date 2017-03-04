<style type="text/css">
    .errorMessage{ color: red;}
    .suggest_link{ background-color: #FFFFFF; padding: 2px 6px 2px 6px;}
    .suggest_link_over{ cursor: pointer; background-color: #A8F2FE; padding: 2px 6px 2px 6px;}
    #search_suggest{ position: absolute;left: 130px;top: 190px;width: auto; background-color: #FFFFFF; text-align: left; border: 1px solid #000000;  margin-left: 2px;}
    .required_title{ color:red;}
    th{ border-top: 1px solid #0d6990;}
    .hidden{ display: none;}
    .show{ display:block;}
</style>
<form action="" method="post" onSubmit="return validateForm()">
    <div class="ihtit">1、填写楼房信息<span style="font-weight:normal; font-size:12px; padding-left:10px; color:#000033;"><em class="red">*</em> 号为必填</span></div>
    <div class="rgcont">
        <table cellspacing="0" cellpadding="0" border="0" class="table_01">
            <tr>
                <td width="16%" class="tit" valign="top"><em>*</em> 创意园名称：</td>
                <td width="84%" class="txtlou">
                    <input type="hidden" id="cr_cpid" name="cr_cpid" value="<?php echo $model->cr_cpid; ?>" />
                    <input class="txt_02" type="text" id="parkname" name="parkname" size="30" autocomplete="off" value="<?=$model->parkbaseinfo?$model->parkbaseinfo->cp_name:""; ?>"
                           <?php  if(isset($ifUpdate)){ ?> style="background-color:#CCC; color:#999;display:inline" readonly="true"
                               <?php } else{ ?> style="display:inline;" onkeyup="searchBuildName(this);" onblur="checkName(this)"
                               <?php } ?>/><span class="errorMessage" id="errorMessageSpan"></span><?php echo CHtml::error($model,'cr_cpid'); ?>
                    <?php  if(!isset($ifUpdate)){?><div><span style="color:#999999" >输入园区关键字->选择园区 园区名称必须从查询结果中选择或者添加新创意园区</span></div><?php }?>
                    <div id="search_suggest" style="display:none"></div>
                    <div <?php if(!$modelSelect){?>style="display:none"<?php }?>>
                        您曾经选择过的创意园：
                        <?php
                        if($modelSelect){
                            foreach($modelSelect as $value){
                                if($value->parkbaseinfo){
                                    echo CHtml::link($value->parkbaseinfo->cp_name,"#",array("onclick"=>"getOtherBuildInfo(".$value->cr_cpid.")","class"=>"suggest_link"));
                                }
                            }
                        }
                        ?>
                    </div>
                    <div id="add_build" style="display:none"></div>
                </td>
            </tr>
            <tr>
                <td class="tit"><em>*</em> 地址：</td>
                <td class="txtlou">
                    <input class="txt_02" style="background-color:#CCC; color:#999;" type="text" id="parkaddress" name="ob_parkaddress" size="55" value="<?php echo $model->parkbaseinfo?$model->parkbaseinfo->cp_address:""; ?>" readonly="true"/>
                    <em style="color:#808080;">无需修改地址修改请重新选择创意园区</em>
                </td>
            </tr>
            <tr>
                <td class="tit"><em>*</em> 面积：</td>
                <td class="txtlou">
                    <input type="text" id="cr_area" name="cr_area" size="10" value="<?=CHtml::encode($model->cr_area); ?>" onblur="checkAreaAndGetAvgPrice(this)"/>&nbsp;平方米&nbsp;&nbsp;(大于0的数字，可保留两位小数)&nbsp;<span class="errorMessage"></span>
                    <?php echo CHtml::error($model,'cr_area'); ?>
                </td>
            </tr>
            <tr>
                <td class="tit"><em>*</em> 租金：</td>
                <td class="txtlou">
                    <input type="hidden" value="" id="avgprice" />
                    <input type="text" id="cr_dayrentprice" name="cr_dayrentprice" size="10" value="<?=CHtml::encode($model->cr_dayrentprice); ?>" onblur="checkRentPriceAndGetAvgPrice(this)"/>&nbsp;元/平米·天
                    <span class="errorMessage"></span>
                    <br />
                    <input type="text" id="cr_monthrentprice" name="cr_monthrentprice" size="10" value="<?=$model->cr_monthrentprice!=0?CHtml::encode($model->cr_monthrentprice):""; ?>" onblur="checkMonthPrice(this)"/>&nbsp;元/月&nbsp;&nbsp;
                    <span class="errorMessage"></span>
                    <?php echo CHtml::error($model,'cr_dayrentprice'); ?>
                </td>
            </tr>
            <tr>
                <td class="tit"><em>*</em> 楼栋名称：</td>
                <td class="txtlou">
                    <input type="text" id="cr_dongname" name="cr_dongname" size="10" value="<?=CHtml::encode($model->cr_dongname); ?>" />&nbsp;如“1号楼”
                    <span class="errorMessage"></span>
                </td>
            </tr>
            <tr>
                <td class="tit"><em>*</em> 楼层：</td>
                <td class="txtlou">
                    <?php echo CHtml::dropDownList("cr_floortype",$model->cr_floortype,Officebaseinfo::$ob_floortype) ?>
                </td>
            </tr>
            
            <tr>
                <td class="tit"> 信息有效期：</td>
                <td class="txtlou">
                    <select name="cr_expiredate">
                        <option value="45">45天</option>
                    </select>
                    <input type="hidden" id="chuanID" name="chuanID"/>
                </td>
            </tr>
        </table>
    </div>
    <?php
    if($opt=="create"){
        ?>
    <div class="ihtit" style="margin-bottom:10px;">
        2、房源图片
    </div>
    <div class="rgcont">
            <?php echo $this->renderPartial('formpicture',array('sourceType'=>'office')); ?>
    </div>
        <?php
    }
    ?>
    <div class="rgcont">
        <table cellspacing="0" cellpadding="0" border="0" class="table_01">
            <tr>
                <td  class="txtlou" align="center">
                    <?php
                    if($model->isNewRecord){
                        echo CHtml::submitButton('发布',array('name'=>'submit','onClick'=>'return validateOptNum(this)','class'=>"manage_input_button"));
                        echo CHtml::submitButton('保存为草稿',array('name'=>'sketch','onClick'=>'return validateOptNum(this)','class'=>'manage_input_buttonlong'));
                    }else{
                        echo CHtml::submitButton('保存',array('name'=>'submit','class'=>"manage_input_button"));
                        echo CHtml::Button('取消',array('class'=>"manage_input_button","onclick"=>"history.go(-1)"));
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <input type="hidden" id="sourceidshow" name="sourceidshow"/>
</form>

<script type="text/javascript">
    //通过房源id，得到需要的全部信息
    function getOtherBuildInfo(id){
        $("#search_suggest").html("").css("display","none");
        closeAddBuildFrame();
        $.ajax({
            type: "GET",
            url: "<?php echo Yii::app()->createUrl("/manage/creativesource/getparkinfo"); ?>",
            data: "cpid="+id,
            success: function (msg){
                msg = eval("("+msg+")");
                //隐藏域中id
                $("#cr_cpid").val(msg['cp_id']);
                //名称
                $("#parkname").val(msg['cp_name']);
                //地址
                $("#parkaddress").val(msg['cp_address']);
                $("#avgprice").val(msg['cp_avgrentprice']);
            }
        });
    }
    //验证只能是数字
    function validateNum(obj){
        var value = $.trim($(obj).val());
        if(value!=""){
            if(isNaN(value)){
                $(obj).next("span").html("只能为数字");
                $(obj).focus();
                return false;
            }else{
                $(obj).next("span").html("");
                return true;
            }
        }else{
            $(obj).next("span").html("");
            return true;
        }

    }
    //验证不能为空
    function checkName(obj){
        if($.trim($(obj).val())==""){
            $(obj).next("span").html("名称不能为空");
            return false;
        }else{
            $(obj).next("span").html("");
            return true;
        }
    }
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

    //验证租金
    function CheckRentPrice(obj){
        var value = $.trim($(obj).val());
        if(value!=""){
            if(isNaN(value)){
                $(obj).next("span").html("租金只能为数字");
                $(obj).focus();
                return false;
            }else if(parseFloat(value)<=0 || parseInt(value)>=1000){
                $(obj).next("span").html("租金不合法，在0-1000之间，请重新输入");
                $(obj).focus();
                return false;
            }else{
                $(obj).next("span").html("");
                //如果有平均租金，要比较
                var avgprice = $("#avgprice").val();
                if(avgprice&&(parseFloat(avgprice)-1)>value){
                    $(obj).next("span").html("<font color='blue'>注意，您的租金与本创意园区的平均租金 "+avgprice+"元/平米·天 相差较大。</font>");
                }
                return true;
            }
        }else {
            $(obj).next("span").html("租金不能为空");
            return false;
        }
    }
    function checkRentPriceAndGetAvgPrice(obj){
        var check = CheckRentPrice(obj);
        if(check){
            CountAvgPrice();
        }
    }
    function CountAvgPrice(){
        var price = $.trim($("#cr_dayrentprice").val());
        var area = $.trim($("#cr_area").val());
        if(price!=""&&area!=""){
            var avgprice = parseInt(parseFloat(price)*parseFloat(area)*365/12);
            $("#cr_monthrentprice").val(avgprice);
        }
    }
    function checkDongName(obj){
        if($.trim($(obj).val())==""){
            $(obj).next("span").html("楼栋名称不能为空");
            return false;
        }else{
            $(obj).next("span").html("");
            return true;
        }
    }
    /**
     * 验证月租金
     */
    function checkMonthPrice(obj){
        var value = $.trim($(obj).val());
        if(value==""){
            $(obj).next("span").html("月租金不能为空");
            return false;
        }else{
            if(isNaN(value)){
                $(obj).next("span").html("月租金只能为数字");
                return false;
            }else{
                $(obj).next("span").html("");
                return true;
            }
        }
    }
    /**
     * 提交表单时验证
     */
    function submitValidate(){
        if($("#cr_cpid").val()==""){
            $("#parkname").next("span").html("请选择楼盘");
            $("#parkname").focus();
            return false;
        }
        if(!checkArea($("#cr_area"))){//验证面积
            $("#cr_area").focus();
            return false;
        }
        if(!CheckRentPrice($("#cr_dayrentprice"))){//验证租金
            $("#cr_dayrentprice").focus();
            return false;
        }
        if(!checkMonthPrice($("#cr_monthrentprice"))){//验证月租金
            $("#cr_monthrentprice").focus();
            return false;
        }
        if(!checkDongName($("#cr_dongname"))){//验证楼栋名称
            $("#cr_dongname").focus();
            return false;
        }
        return true;
    }
    //查询楼盘名称
    function searchBuildName() {
        $("#search_suggest").css("display", "");
        $("#message").css("display", "");
        $("#add_build").css("display","none");
        var inputField = document.getElementById( "parkname");
        var suggestText = document.getElementById( "search_suggest");
        $("#cr_cpid").val("");
        if (inputField.value.length > 0 && inputField.value != '请输入写字楼名') {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl("/manage/creativesource/showlikename");?>',
                data: 'keyw='+inputField.value,
                type: 'POST',
                success: function(msg){
                    msg = eval("("+msg+")");
                    if(msg.length >0){
                        suggestText.style.display= "";
                        suggestText.innerHTML = "";
                        for(var i=0;i <msg.length;i++) {
                            var s=' <div onmouseover="javascript:suggestOver(this);"';
                            s+=' onmouseout= "javascript:suggestOut(this);" ';
                            s+=' onclick= "javascript:getOtherBuildInfo('+msg[i]['cp_id']+');" ';
                            s+=' class= "suggest_link">' +msg[i]['cp_name']+'&nbsp;&nbsp;';
                            s+='(地址：'+msg[i]['cp_address']+')';
                            s+='</div>';
                            suggestText.innerHTML += s;
                        }
                    }
                    else{
                        suggestText.style.display= "";
                        suggestText.innerHTML = "没有搜到匹配的小区<a href='javascript:addBuild()' style='color:blue'>添加新创意园</a>";
                    }
                }
            });
        }
        else {
            suggestText.style.display= "none";
        }
    }

    function suggestOver(div_value){
        div_value.className = "suggest_link_over";
    }

    function suggestOut(div_value){
        div_value.className = "suggest_link";
    }
    function addBuild(){
        $("#search_suggest").html("").css("display","none");
        $("#parkname").attr("readonly","true").css("background-color","#CCC");
        var html = '<iframe src="<?php echo Yii::app()->createUrl('/manage/creativecollect/create')?>" frameborder="0" width="400px" height="150px" style="margin-top:10px"></iframe>';
        $("#add_build").css("display","").html(html);
    }
    function closeAddBuildFrame(){
        $("#add_build").html("").css("display","none");
        $("#parkname").removeAttr("readonly").css("background-color","white");
    }
</script>
