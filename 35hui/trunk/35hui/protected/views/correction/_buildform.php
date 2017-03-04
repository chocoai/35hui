<input type="hidden" name="buildingid" />
<table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
        <td width="100px" align="right">所属区域：</td>
        <td>
            <select name="sbi_district" onchange="changeNext(this)" id="sbi_district">
                <?php
                    foreach($districtlist as $value){
                ?>
                        <option value="<?php echo $value->re_id;?>"><?php echo $value->re_name;?></option>
                <?php
                    }
                ?>
            </select>
            <select name="sbi_section" id="sbi_section"></select>
        </td>
    </tr>
    <tr>
        <td align="right">物业地址：</td>
        <td><input type="text" value="" name="sbi_address" size="30"/></td>
    </tr>
    <tr>
        <td align="right">临近轨道：</td>
        <td id="sbi_busway">
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
    <tr>
        <td align="right">平均租金：</td>
        <td><input type="text" value="" name="sbi_avgrentprice" size="20"/>&nbsp;元/平米•天</td>
    </tr>
    <tr>
        <td align="right">平均售价：</td>
        <td><input type="text" value="" name="sbi_avgsellprice" size="20"/>&nbsp;元/平米</td>
    </tr>
    <tr>
        <td align="right">开发商：</td>
        <td><input type="text" value="" name="sbi_developer" size="30"/></td>
    </tr>
    <tr>
        <td align="right">物业管理费：</td>
        <td><input type="text" value="" name="sbi_propertyprice" size="20"/>&nbsp;元/平米•月</td>
    </tr>
    <tr>
        <td align="right">物业管理公司：</td>
        <td><input type="text" value="" name="sbi_propertyname" size="30"/></td>
    </tr>
    <tr>
        <td align="right">物业电话：</td>
        <td><input type="text" value="" name="sbi_propertytel" size="30"/></td>
    </tr>
    <tr>
        <td align="right">开盘时间：</td>
        <td>
            <input type="date" value="" name="sbi_openingtime"  min="1980-01-01" max="<?=date("Y-m-d")?>"/>
        </td>
    </tr>
</table>
<script type="text/javascript">
function setBuildValue(value){
    $("#buildform").css("display","");
    $("#buildform :input[name='buildingid']").val(value.sbi_buildingid!=undefined?value.sbi_buildingid:"");
    //区域
    if(value.sbi_district!=undefined){
        var length = $("#sbi_district").get(0).options.length;
        for(var i=0;i<length;i++){
            if($("#sbi_district").get(0).options[i].value==value.sbi_district){
                $("#sbi_district").get(0).selectedIndex = i;
                changeNext($("#sbi_district"));
            }
        }
        var length = $("#sbi_section").get(0).options.length;
        for(var i=0;i<length;i++){
            if($("#sbi_section").get(0).options[i].value==value.sbi_section){
                $("#sbi_section").get(0).selectedIndex = i;
            }
        }
    }
    //地址
    $("#buildform :input[name='sbi_address']").val(value.sbi_address!=undefined?value.sbi_address:"");
    //轨道交通
    for(var i=0;i<$("#sbi_busway input").length;i++){
        $("#sbi_busway").children("input").eq(i).get(0).checked = false;
    }
    if(value.sbi_busway!=undefined){
        var busway = value.sbi_busway.split(",");
        for(var i=0;i<busway.length;i++){
            $("#sbi_busway").children("input").eq(busway[i]-1).get(0).checked = true;
        }
    }
    $("#buildform :input[name='sbi_avgrentprice']").val(value.sbi_avgrentprice!=undefined?value.sbi_avgrentprice:"");
    $("#buildform :input[name='sbi_avgsellprice']").val(value.sbi_avgsellprice!=undefined?value.sbi_avgsellprice:"");
    $("#buildform :input[name='sbi_openingtime']").val(value.sbi_openingtime!=undefined?value.sbi_openingtime:"");
    $("#buildform :input[name='sbi_developer']").val(value.sbi_developer!=undefined?value.sbi_developer:"");
    $("#buildform :input[name='sbi_propertyprice']").val(value.sbi_propertyprice!=undefined?value.sbi_propertyprice:"");
    $("#buildform :input[name='sbi_propertytel']").val(value.sbi_propertytel!=undefined?value.sbi_propertytel:"");
    $("#buildform :input[name='sbi_propertyname']").val(value.sbi_propertyname!=undefined?value.sbi_propertyname:"");
}

</script>