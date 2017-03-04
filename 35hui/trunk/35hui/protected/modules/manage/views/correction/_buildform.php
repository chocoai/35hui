<input type="hidden" name="buildingid" />
<table border="0" cellpadding="0" cellspacing="0" class="table_01">
    <tr>
        <td width="16%" class="tit"><em>*</em>所属区域：</td>
        <td width="84%" class="txtlou">
            <select class="slet_01 sslect" name="sbi_district" onchange="changeNext(this)" id="sbi_district">
                <?php
                    foreach($districtlist as $value){
                ?>
                        <option value="<?php echo $value->re_id;?>"><?php echo $value->re_name;?></option>
                <?php
                    }
                ?>
            </select>
            <select class="slet_01 sslect" name="sbi_section" id="sbi_section"></select>
        </td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>物业地址：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="sbi_address" size="30"/></td>
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
        <td width="84%" class="txtlou"><input type="text" value="" name="sbi_avgrentprice" size="20"/>&nbsp;元/平米•天</td>
    </tr>

    <tr>
        <td width="16%" class="tit"><em>*</em>平均售价：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="sbi_avgsellprice" size="20"/>&nbsp;元/平米</td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>开发商：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="sbi_developer" size="30"/></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>物业管理费：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="sbi_propertyprice" size="20"/>&nbsp;元/平米•月</td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>物业管理公司：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="sbi_propertyname" size="30"/></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>物业电话：</td>
        <td width="84%" class="txtlou"><input type="text" value="" name="sbi_propertytel" size="30"/></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>开盘时间：</td>
        <td width="84%" class="txtlou">
            <input type="date" value="" name="sbi_openingtime"  class="date" min="1980-01-01" max="<?=date("Y-m-d")?>"/>
        </td>
    </tr>

    

    <tr >
        <td width="16%" class="tit"><em>*</em>项目简介：</td>
        <td width="84%" class="txtlou"><textarea name="sbi_buildingintroduce" value="" style="width:300px;height:100px"></textarea></td>
    </tr>
    <tr >
        <td width="16%" class="tit"><em>*</em>总层数：</td>
        <td width="84%" class="txtlou"><input name="sbi_floor" value="" type="text" size="30">层</td>
    </tr>
    <tr >
        <td width="16%" class="tit"><em>*</em>标准层面积：</td>
        <td width="84%" class="txtlou"><input name="sbi_floorarea" value="" type="text" size="30">㎡</td>
    </tr>
    
     <tr style="display:none">
        <td width="16%" class="tit"><em>*</em>面积</td>
        <td width="84%" class="txtlou"><input name="sbi_floorinfo[面积]" value="" type="text" size="30">㎡</td>
    </tr>
    <tr style="display:none">
        <td width="16%" class="tit"><em>*</em>层高：</td>
        <td width="84%" class="txtlou"><input name="sbi_floorinfo[层高]" value="" type="text" size="30">m</td>
    </tr>
    <tr >
        <td width="16%" class="tit"><em>*</em>净层高：</td>
        <td width="84%" class="txtlou"><input name="sbi_floorinfo[净层高]" value="" type="text" size="30">m</td>
    </tr>
    <tr style="display:none">
        <td width="16%" class="tit"><em>*</em>有架空地板</td>
        <td width="84%" class="txtlou"><input id="avc" name="sbi_floorinfo[有架空地板]" value="1" type="checkbox"></td>
    </tr>
     <tr>
        <td width="16%" class="tit"><b style="color:#000000">交通配套 </b></td>
        <td width="84%" class="txtlou"></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>轨道交通</td>
        <td width="84%" class="txtlou"><textarea name="sbi_traffic[轨道交通]"  style="width:300px;height:40px"></textarea></td>
    </tr>
     <tr>
        <td width="16%" class="tit"><em>*</em>高架</td>
        <td width="84%" class="txtlou"><textarea name="sbi_traffic[高架]"   style="width:300px;height:40px"></textarea></td>
    </tr>
   
    <tr>
        <td width="16%" class="tit"><em>*</em>机场：</td>
        <td width="84%" class="txtlou"><textarea name="sbi_traffic[机场]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>公交车：</td>
        <td width="84%" class="txtlou"><textarea name="sbi_traffic[公交车]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>火车站：</td>
        <td width="84%" class="txtlou"><textarea name="sbi_traffic[火车站]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><b style="color:#000000">周边配套</b></td>
        <td width="84%" class="txtlou"></td>
    </tr>
       <tr>
        <td width="16%" class="tit"><em>*</em>临近商街</td>
        <td width="84%" class="txtlou"><textarea name="sbi_peripheral[临近商街]"   style="width:300px;height:40px"></textarea></td>
    </tr>

    <tr>
        <td width="16%" class="tit"><em>*</em>商场：</td>
        <td width="84%" class="txtlou"><textarea name="sbi_peripheral[商场]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>酒店：</td>
        <td width="84%" class="txtlou"><textarea name="sbi_peripheral[酒店]"  style="width:300px;height:40px"></textarea></td>
    </tr>
    <tr>
        <td width="16%" class="tit"><em>*</em>银行：</td>
        <td width="84%" class="txtlou"><textarea name="sbi_peripheral[银行]" style="width:300px;height:40px"></textarea></td>
    </tr>
     <tr>
        <td width="16%" class="tit"><em>*</em>餐饮：</td>
        <td width="84%" class="txtlou"><textarea  name="sbi_peripheral[餐饮]"  style="width:300px;height:40px"></textarea></td>
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
//    for(var i=0;i<$("#sbi_busway input").length;i++){
//        $("#sbi_busway").children("input").eq(i).get(0).checked = false;
//    }
//    if(value.sbi_busway!=undefined){
//        var busway = value.sbi_busway.split(",");
//        for(var i=0;i<busway.length;i++){
//            $("#sbi_busway").children("input").eq(busway[i]-1).get(0).checked = true;
//        }
//    }
    $("#buildform :input[name='sbi_avgrentprice']").val(value.sbi_avgrentprice!=undefined?value.sbi_avgrentprice:"");
    $("#buildform :input[name='sbi_avgsellprice']").val(value.sbi_avgsellprice!=undefined?value.sbi_avgsellprice:"");
    $("#buildform :input[name='sbi_openingtime']").val(value.sbi_openingtime!=undefined?value.sbi_openingtime:"");
    $("#buildform :input[name='sbi_developer']").val(value.sbi_developer!=undefined?value.sbi_developer:"");
    $("#buildform :input[name='sbi_propertyprice']").val(value.sbi_propertyprice!=undefined?value.sbi_propertyprice:"");
    $("#buildform :input[name='sbi_propertytel']").val(value.sbi_propertytel!=undefined?value.sbi_propertytel:"");
    $("#buildform :input[name='sbi_propertyname']").val(value.sbi_propertyname!=undefined?value.sbi_propertyname:"");
    $("#buildform :input[name='sbi_buildingintroduce']").val(value.sbi_buildingintroduce!=undefined?value.sbi_buildingintroduce:"");
    $("#buildform :input[name='sbi_floorarea']").val(value.sbi_floorarea!=undefined?value.sbi_floorarea:"");
    $("#buildform :input[name='sbi_floor']").val(value.sbi_floor!=undefined?value.sbi_floor:"");
    if(value.sbi_floorinfo!=undefined){
        for(var i in value.sbi_floorinfo){
            if(i=="有架空地板"&&value.sbi_floorinfo[i]==1){
               
                $("#buildform :input[name='sbi_floorinfo["+i+"]']").attr("checked","checked")
            }else{
                $("#buildform :input[name='sbi_floorinfo["+i+"]']").val(value.sbi_floorinfo[i]);
            }
        }
    }
    if(value.sbi_traffic!=undefined){
        for(var i in value.sbi_traffic){
           
           $("#buildform :input[name='sbi_traffic["+i+"]']").val(value.sbi_traffic[i]);
            
        }
    }
    if(value.sbi_peripheral!=undefined){
        for(var i in value.sbi_peripheral){
         
         $("#buildform :input[name='sbi_peripheral["+i+"]']").val(value.sbi_peripheral[i]);
            
        }
    }
}

</script>