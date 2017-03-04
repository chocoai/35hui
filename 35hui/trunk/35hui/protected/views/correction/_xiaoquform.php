<input type="hidden" name="xiaoquid" />
<table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
        <td width="100px" align="right">所属区域：</td>
        <td>
            <select name="comy_district" onchange="changeNext(this)" id="comy_district">
                <?php
                    foreach($districtlist as $value){
                ?>
                        <option value="<?php echo $value->re_id;?>"><?php echo $value->re_name;?></option>
                <?php
                    }
                ?>
            </select>
            <select name="comy_section" id="comy_section"></select>
        </td>
    </tr>
    <tr>
        <td align="right">小区地址：</td>
        <td><input type="text" value="" name="comy_address" size="30"/></td>
    </tr>
    <tr>
        <td align="right">物业类型：</td>
        <td>
            <?=CHtml::dropDownList("comy_propertytype","",Communitybaseinfo::$comy_propertytypes)?>
        </td>
    </tr>
    <tr>
        <td align="right">开发商：</td>
        <td><input type="text" value="" name="comy_developer" size="30"/></td>
    </tr>
    <tr>
        <td align="right">物业管理费：</td>
        <td><input type="text" value="" name="comy_propertyprice" size="20"/>&nbsp;元/平米•月</td>
    </tr>
    <tr>
        <td align="right">总建筑面积：</td>
        <td><input type="text" value="" name="comy_buildingarea" size="20"/>&nbsp;平米</td>
    </tr>
    <tr>
        <td align="right">容积率：</td>
        <td><input type="text" value="" name="comy_cubagerate" size="20"/></td>
    </tr>
    <tr>
        <td align="right">绿化率：</td>
        <td><input type="text" value="" name="comy_afforestation" size="5"/>&nbsp;%</td>
    </tr>
    <tr>
        <td align="right">竣工日期：</td>
        <td><input type="text" value="" name="comy_buildingera" /></td>
    </tr>
</table>
<script type="text/javascript">
function setXiaoquValue(value){
    $("#xiaoquform").css("display","");
    $("#xiaoquform :input[name='xiaoquid']").val(value.comy_id!=undefined?value.comy_id:"");
    //区域
    if(value.comy_district!=undefined){
        var length = $("#comy_district").get(0).options.length;
        for(var i=0;i<length;i++){
            if($("#comy_district").get(0).options[i].value==value.comy_district){
                $("#comy_district").get(0).selectedIndex = i;
                changeNext($("#comy_district"));
            }
        }
        var length = $("#comy_section").get(0).options.length;
        for(var i=0;i<length;i++){
            if($("#comy_section").get(0).options[i].value==value.comy_section){
                $("#comy_section").get(0).selectedIndex = i;
            }
        }
    }
    //地址
    $("#xiaoquform :input[name='comy_address']").val(value.comy_address!=undefined?value.comy_address:"");
    $("#xiaoquform :input[name='comy_propertytype']").val(value.comy_propertytype!=undefined?value.comy_propertytype:"");
    $("#xiaoquform :input[name='comy_developer']").val(value.comy_developer!=undefined?value.comy_developer:"");
    $("#xiaoquform :input[name='comy_propertyprice']").val(value.comy_propertyprice!=undefined?value.comy_propertyprice:"");
    $("#xiaoquform :input[name='comy_buildingarea']").val(value.comy_buildingarea!=undefined?value.comy_buildingarea:"");
    $("#xiaoquform :input[name='comy_cubagerate']").val(value.comy_cubagerate!=undefined?value.comy_cubagerate:"");
    $("#xiaoquform :input[name='comy_afforestation']").val(value.comy_afforestation!=undefined?value.comy_afforestation:"");
    $("#xiaoquform :input[name='comy_buildingera']").val(value.comy_buildingera!=undefined?value.comy_buildingera:"");
}
</script>