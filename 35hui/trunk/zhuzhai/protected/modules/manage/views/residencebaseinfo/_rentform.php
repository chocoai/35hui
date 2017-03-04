<style type="text/css">
.errorMessage{  color: red;}
.suggest_link{  background-color: #FFFFFF;   padding: 2px 6px 2px 6px;}
.suggest_link_over{  cursor: pointer;   background-color: #A8F2FE;    padding: 2px 6px 2px 6px;}
#search_suggest{ position: absolute;left: 138px; top: 184px; width: auto;    background-color: #FFFFFF;    text-align: left;border: 1px solid #000000;    margin-left: 2px}
.required_title{ color:red;}
th{ border-top: 1px solid #0d6990;}
.hidden{ display: none;}
.show{ display:block;}
</style>
<script charset="utf-8" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KE.show({
    id : 'rbi_residencedesc',
    resizeMode : 1,
    allowPreviewEmoticons : false,
    allowUpload : false,
    resizeMode : 0,
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'image', 'link']
});
</script>
<form action="" method="post" onSubmit="return validateForm()">
<div class="ihtit">1、填写楼房信息<span style="font-weight:normal; font-size:12px; padding-left:10px; color:#000033;"><em class="red">*</em> 号为必填</span></div>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tr>
            <td width="16%" class="tit"><em>*</em> 小区名称：</td>
            <td width="84%" class="txtlou">
                <input type="hidden" id="rbi_communityid" name="rbi_communityid" value="<?php echo $model->rbi_communityid; ?>" />
                <input type="text" id="ofname" name="comy_name" size="30" autocomplete="off"<?php
                    if($model->rbi_communityid){
                        $temp = Communitybaseinfo::model()->findByPk($model->rbi_communityid);
                    ?> value="<?=$temp->comy_name?>" style="background-color:#CCC; color:#999;display:inline" readonly="true"<?php
                    } else{
                   ?>
                     value="" style="display:inline;"   onkeyup="searchBuildName(this);"  onblur="checkName(this)"<?php }?>/>
                <span class="errorMessage" id="errorMessageSpan"></span>
                <?php if(!$model->rbi_communityid){?><div><span style="color:#999999" >输入楼盘关键字->选择楼盘 楼盘名称必须从查询结果中选择或者添加新楼盘</span></div><?php }?>
                <div id="search_suggest" style="display:none"></div>
                <div <?php if(!$modelSelect){?>style="display:none"<?php }?>>
                    您曾经选择过的小区：
                    <?php
                    if($modelSelect){
                        foreach($modelSelect as $value){
                            if($value->community){
                                echo CHtml::link($value->community->comy_name,"#",array("onclick"=>"getOtherBuildInfo(".$value->rbi_communityid.",".$value->community->comy_buildingera.",'".$value->community->comy_name."','".$value->community->comy_address."')","class"=>"suggest_link"));
                            }
                        }
                    }
                    ?>
                </div>
                <div id="add_build" style="display:none"></div>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"> 地址：</td>
            <td width="84%" class="txtlou">
                <input style="background-color:#CCC; color:#999;" type="text" id="officeaddress" name="ob_officeaddress" size="55" value="<?=empty($temp->comy_address)?'':$temp->comy_address ?>" readonly="true"/><span class="errorMessage"></span></td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 建筑面积：</td>
            <td width="84%" class="txtlou">
                <input type="text" id="rbi_area" onblur="checkArea(this)" onkeyup="checkArea(this)" name="rbi_area" size="10" maxlength="10" value="<?=$model->rbi_area?>" />
                平方米<span class="errorMessage"></span>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 租金：</td>
            <td width="84%" class="txtlou">
                <input type="text" id="rr_rentprice" name="rr_rentprice" onblur="validateNum(this)" onkeyup="validateNum(this)" size="10"  value="<?=$rentModel->rr_rentprice ?>" />
                元/月 此租金为“买卖双方税费自理价”，请正确、真实填写。如有虚假，一经核实将严厉处理。<span class="errorMessage"></span>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit">租赁方式：</td>
            <td width="84%" class="txtlou">
                <input type="radio" name="rr_renttype" value="1"<?=$rentModel->rr_renttype==1?' checked':'' ?>/><label for="rr_renttype_0">整组</label>&nbsp;&nbsp;
                <input type="radio" name="rr_renttype" value="2"<?=$rentModel->rr_renttype==1?'':' checked' ?> /><label for="rr_renttype_1">合租</label>&nbsp;&nbsp;
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 楼层：</td>
            <td width="84%" class="txtlou">
                第<input type="text" maxlength="4" id="rbi_floor" name="rbi_floor" size="4" value="<?=CHtml::encode($model->rbi_floor); ?>" onblur="validateFloor(this)" onkeyup="validateFloor(this)" />层
                共<input type="text" maxlength="4" id="rbi_allfloor" name="rbi_allfloor" size="4" onblur="CheckDataTotalFloor(this)" onkeyup="CheckDataTotalFloor(this)" value="<?=CHtml::encode($model->rbi_allfloor); ?>"/>层&nbsp;(若是地下室，请填负数如 -1)&nbsp;&nbsp;<span class="errorMessage"></span>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit">付款方式：</td>
            <td width="84%" class="txtlou">
                付&nbsp;
                <select name="rr_rentpay">
                    <option value="1"<?=$rentModel->rr_rentpay==1?' selected':'' ?>> 1 </option>
                    <option value="2"<?=$rentModel->rr_rentpay==2?' selected':'' ?>> 2 </option>
                    <option value="3"<?=$rentModel->rr_rentpay==3?' selected':'' ?>> 3 </option>
                    <option value="4"<?=$rentModel->rr_rentpay==4?' selected':'' ?>> 4 </option>
                    <option value="5"<?=$rentModel->rr_rentpay==5?' selected':'' ?>> 5 </option>
                    <option value="6"<?=$rentModel->rr_rentpay==6?' selected':'' ?>> 6 </option>
                </select>
                &nbsp;押&nbsp;
                <select name="rr_rentdetain">
                    <option value="0"> 0 </option>
                    <option value="1"<?=$rentModel->rr_rentdetain==1?' selected':'' ?>> 1 </option>
                    <option value="2"<?=$rentModel->rr_rentdetain==2?' selected':'' ?>> 2 </option>
                    <option value="3"<?=$rentModel->rr_rentdetain==3?' selected':'' ?>> 3 </option>
                </select>&nbsp;单位：月
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit">建筑年代：</td>
            <td width="84%" class="txtlou">
                <input type="text" id="rbi_buildingera" onblur="validateNum(this)" onkeyup="validateNum(this)" name="rbi_buildingera" size="10" maxlength="4" value="<?=CHtml::encode($model->rbi_buildingera?$model->rbi_buildingera:''); ?>" />
            <span class="errorMessage"></span>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit">房型：</td>
            <td width="84%" class="txtlou">
                <select id="rbi_room" name="rbi_room">
                    <option value="1"<?=$model->rbi_room==1?' selected':'' ?>> 1 </option>
                    <option value="2"<?=$model->rbi_room==2?' selected':'' ?>> 2 </option>
                    <option value="3"<?=$model->rbi_room==3?' selected':'' ?>> 3 </option>
                    <option value="4"<?=$model->rbi_room==4?' selected':'' ?>> 4 </option>
                    <option value="5"<?=$model->rbi_room==5?' selected':'' ?>> 5 </option>
                    <option value="6"<?=$model->rbi_room==6?' selected':'' ?>> 6 </option>
                    <option value="7"<?=$model->rbi_room==7?' selected':'' ?>> 7 </option>
                    <option value="8"<?=$model->rbi_room==8?' selected':'' ?>> 8 </option>
                    <option value="9"<?=$model->rbi_room==9?' selected':'' ?>> 9 </option>
                    <option value="10"<?=$model->rbi_room==10?' selected':'' ?>> 10 </option>
                </select>室
                <select id="rbi_office" name="rbi_office">
                    <option value="0"> 0 </option>
                    <option value="1"<?=$model->rbi_office==1?' selected':'' ?>> 1 </option>
                    <option value="2"<?=$model->rbi_office==2?' selected':'' ?>> 2 </option>
                    <option value="3"<?=$model->rbi_office==3?' selected':'' ?>> 3 </option>
                    <option value="4"<?=$model->rbi_office==4?' selected':'' ?>> 4 </option>
                    <option value="5"<?=$model->rbi_office==5?' selected':'' ?>> 5 </option>
                </select>厅
                <select id="rbi_bathroom" name="rbi_bathroom">
                    <option value="0"> 0 </option>
                    <option value="1"<?=$model->rbi_bathroom==1?' selected':'' ?>> 1 </option>
                    <option value="2"<?=$model->rbi_bathroom==2?' selected':'' ?>> 2 </option>
                    <option value="3"<?=$model->rbi_bathroom==3?' selected':'' ?>> 3 </option>
                    <option value="4"<?=$model->rbi_bathroom==4?' selected':'' ?>> 4 </option>
                    <option value="5"<?=$model->rbi_bathroom==5?' selected':'' ?>> 5 </option>
                </select>卫
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit">朝向：</td>
            <td width="84%" class="txtlou">
                <?=CHtml::radioButtonList("rbi_toward",$model->rbi_toward?$model->rbi_toward:"1",Residencebaseinfo::$rbi_towards,array("separator"=>"&nbsp"));?>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit">装修情况：</td>
            <td width="84%" class="txtlou">
                <?=CHtml::radioButtonList("rbi_decoration",$model->rbi_decoration?$model->rbi_decoration:"1",Residencebaseinfo::$rbi_adrondegree,array("separator"=>"&nbsp"));?>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit">房屋配置：</td>
            <td width="84%" class="txtlou">
                <input type="checkbox" id="selectAllFac"/><label for="selectAllFac">全选</label>
                <?php
                $have_facilitie = explode(',', $rentModel->rr_facilities);
                foreach(Residencerentinfo::$faciliti_base as $key=>$value){
                ?>
                <input type="checkbox" name="rr_facilities[]" value="<?=$key;?>"<?=in_array($key, $have_facilitie)?' checked':'';?> id="rr_facilities_<?=$key?>"/><label for="rr_facilities_<?=$key?>"><?=$value;?></label>&nbsp;&nbsp;
                <?php
                }
                ?>
            </td>
        </tr>
    </table>
</div>

<div class="ihtit" style="margin-bottom:10px;">
    2、房源描述
</div>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tr>
            <td width="16%" class="tit">房源编号：</td>
            <td width="84%" class="txtlou">
                <input type="text" name="rbi_number" value="<?=CHtml::encode($model->rbi_number)?>"  />(请输入贵公司的内部房源编号，以便客户来电时方便您的查询)
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 标题：</td>
            <td width="84%" class="txtlou">
                精确完整的标题是您增加点击量，吸引客户注意力第一步！<br />
                <input type="text" id="rbi_title" name="rbi_title" size="60" value="<?=CHtml::encode($model->rbi_title)?>" maxlength="35" onblur="CheckTitle(this)" onkeyup="CheckTitle(this)"/><span class="errorMessage"></span>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 描述：</td>
            <td width="84%" class="txtlou">
                <textarea id="rbi_residencedesc" name="rbi_residencedesc" style="width:600px;height:300px;visibility:hidden;"><?=CHtml::encode($model->rbi_residencedesc)?></textarea><span class="errorMessage"></span>
            </td>
        </tr>
    </table>
</div>
<?php if($model->isNewRecord){ ?>
<div class="ihtit" style="margin-bottom:10px;">
    3、房源图片
</div>
<div class="rgcont">
<?php echo $this->renderPartial('/common/formpicture',array('sourceType'=>'residence')); ?>
</div>
<?php } ?>
<div class="ihtit" style="margin-bottom:10px;">
    4、房源标签
</div>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tr>
            <td width="16%" class="tit">是否推荐：</td>
            <td width="84%" class="txtlou">
                <input type="radio" name="rt_isrecommend" checked value="0"/>否
                <input type="radio" name="rt_isrecommend"  <?php if($tagModel->rt_isrecommend==1)echo "checked"; ?> value="1"/>是&nbsp;&nbsp; <span>添加房源推荐图标将扣除<span style="color:red"><?php echo $releaseNeedMoney['1'];?></span>新币。被推荐的房源，将在搜索结果中排在前面。</span>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit">是否急房源：</td>
            <td width="84%" class="txtlou">
                <input type="radio" name="rt_ishurry" checked value="0"/>否
                <input type="radio" name="rt_ishurry" <?php if($tagModel->rt_ishurry==1)echo "checked"; ?> value="1"/>是&nbsp;&nbsp; <span>添加急房源图标将扣除<span style="color:red"><?php echo $releaseNeedMoney['2'];?></span>新币。</span>
            </td>
        </tr>

        <tr>
            <td width="16%" class="tit">信息有效期：</td>
            <td width="84%" class="txtlou">
                <select name="rr_validdate">
                    <?php $rr_validdate=$model->rr_validdate/86400;?>
                    <option value="30"<?=$rr_validdate==30?' selected':''?>>30天</option>
                    <option value="60"<?=$rr_validdate!=30&&$rr_validdate!=90?' selected':''?>>60天</option>
                    <option value="90"<?=$rr_validdate==90?' selected':''?>>90天</option>
                </select>
            </td>
        </tr>
        <tr>
            <td width="16%">&nbsp;</td>
            <td width="84%" class="txtlou">
                <?php
                if($model->isNewRecord){

                    echo '发布一则普通房源将扣除新币<font color="red"><?=$releaseNeedMoney[0]?></font>点&nbsp;&nbsp;&nbsp;&nbsp;';
                    echo CHtml::submitButton('发布',array('name'=>'submit','onClick'=>'return validateOptNum(this)'));
                    echo CHtml::submitButton('保存为草稿',array('name'=>'sketch','onClick'=>'return validateOptNum(this)'));
                    echo '<input type="hidden" id="sourceidshow" name="sourceidshow"/>';
                }else{
                    echo CHtml::submitButton('保存',array('name'=>'submit','onClick'=>'return validateOptNum(this)'));
                    echo CHtml::Button('取消',array("onclick"=>"history.go(-1)"));
                }
                 ?></td>
        </tr>
    </table>
</div>
</form>
<script type="text/javascript">
//通过房源id，得到需要的全部信息
function getOtherBuildInfo(id,year,name,add){
    $("#search_suggest").html("").css("display","none");
    closeAddBuildFrame();
    //隐藏域中id
    $("#rbi_communityid").val(id);
    //名称
    $("#ofname").val(name);
    //地址
    $("#officeaddress").val(add);
    //
    if(year == 0)year = '';
    $("#rbi_buildingera").val(year);
    setBasePicSrc(id);
}
function changeNext(obj){
    var parentid = $(obj).val();
    var html = "<option value='0'>-请选择-</option>";
        if(parentid==0){
            $(obj).nextAll("select").html(html);//删除后面所有的选择。
        }else{
            $.ajax({
               url: "<?php echo Yii::app()->createUrl("/region/getlistbyparentid") ?>",
               type: "GET",
               data: "parentid="+parentid,
               async: false,
               success: function(msg){
                   var msg = eval("("+msg+")");
                   $(obj).nextAll("select").html(html);//删除后面所有的选择。
                   for(var i=0;i<msg.length;i++){
                       html += "<option value='"+msg[i]['re_id']+"'>"+msg[i]['re_name']+"</option>";
                   }
                   $(obj).next("select").html(html);
               }
            });
        }

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
//验证楼层
function validateFloor(obj){
    var floorNum = $.trim($(obj).val());//当前楼层
    var allFloor = $.trim($("#rbi_allfloor").val());//总楼层
     if(floorNum!=""){
         if(isNaN(floorNum)){
             $(obj).nextAll("span").html("楼层只能为数字");
             $(obj).focus();
             return false;
         }else if(parseInt(floorNum)!=floorNum ||floorNum.indexOf(".")>=0){
             $(obj).nextAll("span").html("楼层只能为整数，不能为小数");
             $(obj).focus();
             return false;
         }else if(parseInt(floorNum)==0){
             $(obj).nextAll("span").html("楼层不能等于0，请重新输入");
             $(obj).focus();
             return false;
         }else if(parseInt(floorNum)>1000){
             $(obj).nextAll("span").html("楼层不能大于1000，请重新输入");
             $(obj).focus();
             return false;
         }else if(parseInt(floorNum)>parseInt(allFloor)){
             $(obj).nextAll("span").html("当前楼层不能大于总层");
             $(obj).focus();
             return false;
         }else {
             $(obj).nextAll("span").html("");
             return true;
         }
     }else {
         $(obj).nextAll("span").html("楼层不能为空");
         return false;
     }
}
//验证总层数
function CheckDataTotalFloor(obj){
    var currentFloor = $.trim($("#rbi_allfloor").val());
    var value = $.trim($(obj).val());
    if(value!=""){
        if(isNaN(value)){
            $(obj).next("span").html("总层只能为数字");
            $(obj).focus();
            return false;
        }else if(parseInt(value)!=value ||value.indexOf(".")>=0){
            $(obj).next("span").html("总层只能为正整数");
            $(obj).focus();
            return false;
        }else if(parseInt(value)<=0 || parseInt(value)>1000 ){
            $(obj).next("span").html("总层必须在1-1000之间，请重新输入");
            $(obj).focus();
            return false;
        }else if(parseInt(currentFloor)>parseInt(value)){
             $(obj).next("span").html("总层不能小于当前楼层");
             $(obj).focus();
             return false;
         }else {
            $(obj).next("span").html("");
            return true;
        }
    }else {
         $(obj).next("span").html("总层数不能为空");
         return false;
     }
}
/**
 * 验证总售价
 */
function CheckSumSalePrice(obj){
   var value = $.trim($(obj).val());
   if(value!=""){
        if(isNaN(value)){
            $(obj).nextAll("span").html("租金只能为数字，并且是大于0");
            $(obj).focus();
            return false;
        }else if(parseInt(value)<=0){
            $(obj).nextAll("span").html("租金必须大于0的数字");
            $(obj).focus();
            return false;
        }else{
            $(obj).nextAll("span").html("");
            return true;
        }
    }else{
        $(obj).nextAll("span").html("租金不能为空");
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
    var sum = $.trim($("#rs_price").val());
    var area = $.trim($("#rbi_area").val());
    if(sum!=""&&area!=""){
        var avg = parseInt(parseFloat(sum)*10000/parseFloat(area));
        $("#rs_unitprice").val(avg);
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
//验证标题
function CheckTitle(obj){
    $(obj).next("span").css("color", "");
    var allNum = 35;
    var value = $.trim($(obj).val());
    if(value==""){
        $(obj).next("span").html("请填写房源标题！");
        return false;
    }else if(value.length>=allNum){
        $(obj).next("span").html("房源标题最多填写"+allNum+"个字！");
        $(obj).focus();
        return false;
    }else if(value.length==allNum){
       $(obj).next("span").css("color", "black");
        $(obj).next("span").html("（<font style='font-weight:bold'>"+$(obj).val().length+"</font>/"+allNum+"个字）");
        return true;
    }else {
        $(obj).next("span").css("color", "black");
        $(obj).next("span").html("（"+$(obj).val().length+"/"+allNum+"个字）");
        return true;
    }
}
/**
 * 提交表单时验证
 */
function submitValidate(){
    if($("#rbi_communityid").val()==""){
        $("#ofname").next("span").html("请选择小区");
        $("#ofname").focus();
        return false;
    }
    if(!checkArea($("#rbi_area"))){//验证面积
        $("#rbi_area").focus();
        return false;
    }
    if(!validateFloor($("#rbi_floor"))){//验证楼层
        return false;
    }
    if(!CheckDataTotalFloor($("#rbi_allfloor"))){//验证总楼层
        return false;
    }
    if(!CheckSumSalePrice($("#rr_rentprice"))){//验证租金
        $("#rr_rentprice").focus();
        return false;
    }
    if(!CheckTitle($("#rbi_title"))){//验证标题
        $("#rbi_title").focus();
        return false;
    }
    if($.trim($("#rbi_residencedesc").val())==""){
        alert("描述不能为空");
        return false;
    }
    if($("#rbi_residencedesc").val().length>65535){
        alert("抱歉，您的描述内容太长！请截取一部分再试.");
        return false;
    }
    return true;
}

//查询楼盘名称
function searchBuildName() {
    $("#search_suggest").css("display", "");
    $("#message").css("display", "");
    $("#add_build").css("display","none");
    var inputField = document.getElementById( "ofname");
    var suggestText = document.getElementById( "search_suggest");
    $("#ob_sysid").val("");
    if (inputField.value.length > 0 && inputField.value!='请输入小区名') {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl("communitybaseinfo/searchxiaoqu");?>',
            data: {"keyw":inputField.value},
            type: 'GET',
            success: function(msg){
                msg = eval("("+msg+")");
                if(msg.length >0){
                    suggestText.style.display= "";
                    suggestText.innerHTML = "";
                    for(var i=0;i <msg.length;i++) {
                        var s=' <div onmouseover="javascript:suggestOver(this);"';
                        s+=' onmouseout= "javascript:suggestOut(this);" ';
                        s+=' onclick= "javascript:getOtherBuildInfo('+msg[i]['id']+','+msg[i]['year']+',\''+msg[i]['name']+'\',\''+msg[i]['add']+'\');" ';
                        s+=' class= "suggest_link">' +msg[i]['name']+'&nbsp;&nbsp;';
                        s+='(地址：'+msg[i]['add']+')';
                        s+='</div>';
                        suggestText.innerHTML += s;
                    }
                }
                else{
                    suggestText.style.display= "";
                    suggestText.innerHTML = "没有搜到匹配的小区<a href='javascript:addBuild()'>添加小区</a>";
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
    $("#ofname").attr("readonly","true").css("background-color","#CCC");
    var html = '<iframe src="<?php echo Yii::app()->createUrl('/communitybaseinfo/collect')?>" frameborder="0" width="500px" height="210px" style="margin-top:10px"></iframe>';
    $("#add_build").css("display","").html(html);
}

function closeAddBuildFrame(){
    $("#add_build").html("").css("display","none");
    $("#ofname").removeAttr("readonly").css("background-color","white");
}
//是否推荐或是否急房源选择时的扣除新币的提示
function money_check_hint(obj){
    if($(obj).attr('checked')){
        var index=$(obj).attr('id').charAt($(obj).attr('id').length-1);
        if(Number(index)>=1){
            $(obj).parent().find("span").css('display','inline');
        }else{
            $(obj).parent().find("span").css('display','none');
        }
    }
}
$("#selectAllFac").bind("click",function(){
    $(this).siblings("input").attr("checked",$(this).attr('checked')?"checked":'');
})
</script>