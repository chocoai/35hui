<input type="hidden" name="creativeparkid" />
<table border="0" cellpadding="0" cellspacing="0" class="table_01">
    <tr>
        <td width="16%" class="tit"><em>*</em>所属区域：</td>
        <td width="84%" class="txtlou">
            <select class="slet_01 sslect" name="cp_district" onchange="changeNext(this)" id="cp_district">
                <?php
                    foreach($districtlist as $value){
                ?>
                        <option value="<?php echo $value->re_id;?>"><?php echo $value->re_name;?></option>
                <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>地址：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="cp_address" size="30"/></td>
    </tr>
    <!--<tr>
        <td width="16%" class="tit"><em>*</em>临近轨道：</td>
        <td width="84%" class="txtlou" id="sbi_busway">
            <input type="checkbox" id="sbi_busway_1" name="sbi_busway[]" value="1"/><label for="sbi_busway_1">1号线</label>
            <input type="checkbox" id="sbi_busway_2" name="sbi_busway[]" value="2"/><label for="sbi_busway_2">2号线</label>
            <input type="checkbox" id="sbi_busway_3" name="sbi_busway[]" value="3"/><label for="sbi_busway_3">3号线</label>
            <input type="checkbox" id="sbi_busway_4" name="sbi_busway[]" value="4"/><label for="sbi_busway_4">4号线</label>
            <input type="checkbox" id="sbi_busway_5" name="sbi_busway[]" value="5"/><label for="sbi_busway_5">5号线</label>
            <input type="checkbox" id="sbi_busway_6" name="sbi_busway[]" value="6"/><label for="sbi_busway_6">6号线</label>
            <input type="checkbox" id="sbi_busway_7" name="sbi_busway[]" value="7"/><label for="sbi_busway_7">7号线</label>
            <input type="checkbox" id="sbi_busway_8" name="sbi_busway[]" value="8"/><label for="sbi_busway_8">8号线</label>
            <input type="checkbox" id="sbi_busway_9" name="sbi_busway[]" value="9"/><label for="sbi_busway_9">9号线</label>
            <input type="checkbox" id="sbi_busway_10" name="sbi_busway[]" value="10"/><label for="sbi_busway_10">10号线</label>
            <input type="checkbox" id="sbi_busway_11" name="sbi_busway[]" value="11" /><label for="sbi_busway_11">11号线</label>
            <input type="checkbox" id="sbi_busway_12" name="sbi_busway[]" value="12"/><label for="sbi_busway_12">12号线</label>
            <input type="checkbox" id="sbi_busway_13" name="sbi_busway[]" value="13"/><label for="sbi_busway_13">13号线</label>
        </td>
    </tr>
    -->
    
    <tr>
        <td width="16%" class="tit"><em>*</em>平均租金：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="cp_avgrentprice" size="20"/>&nbsp;元/平米•天</td>
    </tr>

    <tr>
        <td width="16%" class="tit"><em>*</em>开发商：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="cp_developer" size="30"/></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>物业管理费：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="cp_propertyprice" size="20"/>&nbsp;元/平米•月</td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>物业管理公司：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="cp_propertyname" size="30"/></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>开盘时间：</td>
        <td width="84%" class="txtlou">
            <input type="text" value="" name="cp_openingtime"  class="date" min="1980-01-01" max="<?=date("Y-m-d")?>"/>例：2011-12-12 或20111212
        </td>
    </tr>

    

    <tr >
        <td width="16%" class="tit"><em>*</em>项目简介：</td>
        <td width="84%" class="txtlou"><textarea name="cp_introduce" value="" style="width:300px;height:100px"></textarea></td>
    </tr>
    <tr >
        <td width="16%" class="tit"><em>*</em>层高：</td>
        <td width="84%" class="txtlou"><input name="cp_floorheight" value="" type="text" size="30">m</td>
    </tr>
    <tr >
        <td width="16%" class="tit"><em>*</em>总面积：</td>
        <td width="84%" class="txtlou"><input name="cp_area" value="" type="text" size="30">㎡</td>
    </tr>
    <tr>
        <td width="16%" class="tit"><b style="color:#000000">交通配套 </b></td>
        <td width="84%" class="txtlou"></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>轨道</td>
        <td width="84%" class="txtlou"><textarea name="cp_traffic[guidao]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>高架</td>
        <td width="84%" class="txtlou"><textarea name="cp_traffic[gaojia]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>机场</td>
        <td width="84%" class="txtlou"><textarea name="cp_traffic[jichang]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>公交</td>
        <td width="84%" class="txtlou"><textarea name="cp_traffic[gongjiao]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>火车</td>
        <td width="84%" class="txtlou"><textarea name="cp_traffic[huoche]"  style="width:300px;height:40px"></textarea></td>
    </tr>

    <tr>
        <td width="16%" class="tit"><b style="color:#000000">周边配套 </b></td>
        <td width="84%" class="txtlou"></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>商街</td>
        <td width="84%" class="txtlou"><textarea name="cp_peripheral[shangjie]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>商场</td>
        <td width="84%" class="txtlou"><textarea name="cp_peripheral[shangchang]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>酒店</td>
        <td width="84%" class="txtlou"><textarea name="cp_peripheral[jiudian]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>银行</td>
        <td width="84%" class="txtlou"><textarea name="cp_peripheral[yinhang]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>餐饮</td>
        <td width="84%" class="txtlou"><textarea name="cp_peripheral[canyin]"  style="width:300px;height:40px"></textarea></td>
    </tr>
</table>
<script type="text/javascript">
function setCreativeparkValue(value){
    
    $("#creativeparkform").css("display","");
    $("#creativeparkform :input[name='creativeparkid']").val(value.cp_id!=undefined?value.cp_id:"");
    //区域
    if(value.cp_district!=undefined){
        var length = $("#cp_district").get(0).options.length;
        for(var i=0;i<length;i++){
            if($("#cp_district").get(0).options[i].value==value.cp_district){
                $("#cp_district").get(0).selectedIndex = i;
            }
        }
        
    }
    //地址
    $("#creativeparkform :input[name='cp_address']").val(value.cp_address!=undefined?value.cp_address:"");
 
    $("#creativeparkform :input[name='cp_avgrentprice']").val(value.cp_avgrentprice!=undefined?value.cp_avgrentprice:"");
    $("#creativeparkform :input[name='cp_openingtime']").val(value.cp_openingtime!=undefined?value.cp_openingtime:"");
    $("#creativeparkform :input[name='cp_developer']").val(value.cp_developer!=undefined?value.cp_developer:"");
    $("#creativeparkform :input[name='cp_propertyprice']").val(value.cp_propertyprice!=undefined?value.cp_propertyprice:"");
    $("#creativeparkform :input[name='cp_propertyname']").val(value.cp_propertyname!=undefined?value.cp_propertyname:"");
    $("#creativeparkform :input[name='cp_introduce']").val(value.cp_introduce!=undefined?value.cp_introduce:"");
    $("#creativeparkform :input[name='cp_area']").val(value.cp_area!=undefined?value.cp_area:"");
    $("#creativeparkform :input[name='cp_floorheight']").val(value.cp_floorheight!=undefined?value.cp_floorheight:"");

    if(value.cp_traffic!=undefined){
        for(var i in value.cp_traffic){
            $("#creativeparkform :input[name='cp_traffic["+i+"]']").val(value.cp_traffic[i]);

        }
    }
    if(value.cp_peripheral!=undefined){
        for(var i in value.cp_peripheral){
         $("#creativeparkform :input[name='cp_peripheral["+i+"]']").val(value.cp_peripheral[i]);

        }
    }
}

</script>