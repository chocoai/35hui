<style type="text/css">
.errorMessage{
        color: red;
}
.suggest_link{
    background-color: #FFFFFF;
    padding: 2px 6px 2px 6px;
}
.suggest_link_over{
    cursor: pointer;
    background-color: #A8F2FE;
    padding: 2px 6px 2px 6px;
}
#search_suggest{
    position: absolute;
    background-color: #FFFFFF;
    text-align: left;
    border: 1px solid #000000;
    margin-left: 2px
}
.required_title{
    color:red
}
th{
    border-top: 1px solid #0d6990;
}
.hidden{
    display: none;
}
.show{
    display:block;
}
</style>
<script charset="utf-8" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KE.show({
    id : 'op_officedesc',
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
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="manage_tabletwo">
    <tr>
        <th colspan="2" style="text-align:left;"><font style="margin-left:15px">基本信息</font></th>
    </tr>
    <tr>
        <td style="text-align:right">写字楼名称<span class="required_title">*</span></td>
        <td style="text-align:left">
            <input type="hidden" id="ob_sysid" name="ob_sysid" value="<?php echo $model->ob_sysid; ?>" />
            <input type="text" id="ofname" name="ob_officename" size="30" autocomplete="off" value="<?php echo $model->ob_officename; ?>" onkeyup="searchBuildName();" size="20" onblur="checkName(this)" />&nbsp;&nbsp;<span class="errorMessage"></span><?php echo CHtml::error($model,'ob_officename'); ?>
            <div id="search_suggest" style="display:none"></div>
            <div id="add_build" style="display:none"></div>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">地址</td>
        <td style="text-align:left"><input style="background-color:#CCC; color:#999;" type="text" id="officeaddress" name="ob_officeaddress" size="55" value="<?php echo $model->ob_officeaddress; ?>" readonly="true"/></td>
    </tr>
    <tr>
        <td style="text-align:right">
            写字楼性质<span class="required_title">*</span>
        </td>
        <td style="text-align:left">
            <input type="radio" name="ob_officetype" value="2" checked id="ob_officetype_2"/><label for="ob_officetype_2"><?php echo Officebaseinfo::$officeType[2]; ?></label>&nbsp;&nbsp;
            <input type="radio" name="ob_officetype" <?php if($model->ob_officetype==1)echo "checked"; ?>  value="1" id="ob_officetype_1"/><label for="ob_officetype_1"><?php echo Officebaseinfo::$officeType[1]; ?></label>&nbsp;&nbsp;
            <input type="radio" name="ob_officetype" <?php if($model->ob_officetype==3)echo "checked"; ?> value="3" id="ob_officetype_3"/><label for="ob_officetype_3"><?php echo Officebaseinfo::$officeType[3]; ?></label>&nbsp;&nbsp;
            <input type="radio" name="ob_officetype" <?php if($model->ob_officetype==4)echo "checked"; ?> value="4" id="ob_officetype_4"/><label for="ob_officetype_4"><?php echo Officebaseinfo::$officeType[4]; ?></label>&nbsp;&nbsp;
            <?php echo CHtml::error($model,'ob_officetype'); ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right">写字楼面积<span class="required_title">*</span></td>
        <td style="text-align:left">
            <input type="text" id="ob_officearea" name="ob_officearea" size="5" value="<?=CHtml::encode($model->ob_officearea); ?>" onblur="checkArea(this)"/>&nbsp;平方米&nbsp;&nbsp;(大于0的数字，只能保留一位小数)&nbsp;<span class="errorMessage"></span>
            <?php echo CHtml::error($model,'ob_officearea'); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">楼层</td>
        <td style="text-align:left">
            <?php echo CHtml::dropDownList("ob_floortype",$model->ob_floortype,Officebaseinfo::$ob_floortype) ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">朝向</td>
        <td style="text-align:left">
            <?php
            foreach(Officebaseinfo::$towards as $key=>$value){
            ?>
            <input type="radio" name="ob_towards" value="<?=$key;?>" <?php if($model->ob_towards==$key)echo "checked"; ?> id="ob_officedegree_<?=$key?>"/><label for="ob_officedegree_<?=$key?>"><?=$value;?></label>&nbsp;&nbsp;
            <?php
            }
            ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right"><?php echo CHtml::activeLabelEx($model,'ob_adrondegree'); ?></td>
        <td style="text-align:left">
            <input type="radio" name="ob_adrondegree" value="1" checked id="ob_adrondegree_1"/><label for="ob_adrondegree_1"><?php echo Officebaseinfo::$adrondegree[1]; ?></label>&nbsp;&nbsp;
            <input type="radio" name="ob_adrondegree" value="2" <?php if($model->ob_adrondegree==2)echo "checked"; ?> id="ob_adrondegree_2"/><label for="ob_adrondegree_2"><?php echo Officebaseinfo::$adrondegree[2]; ?></label>&nbsp;&nbsp;
            <input type="radio" name="ob_adrondegree" value="3" <?php if($model->ob_adrondegree==3)echo "checked"; ?> id="ob_adrondegree_3"/><label for="ob_adrondegree_3"><?php echo Officebaseinfo::$adrondegree[3]; ?></label>&nbsp;&nbsp;
            <input type="radio" name="ob_adrondegree" value="4" <?php if($model->ob_adrondegree==4)echo "checked"; ?> id="ob_adrondegree_4"/><label for="ob_adrondegree_4"><?php echo Officebaseinfo::$adrondegree[4]; ?></label>&nbsp;&nbsp;
            <?php echo CHtml::error($model,'ob_adrondegree'); ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right">租金<span class="required_title">*</span></td>
        <td style="text-align:left">
            <input type="text" id="or_rentprice" name="or_rentprice" size="5" value="<?=CHtml::encode($model->or_rentprice); ?>" onblur="CheckRentPrice(this)"/>&nbsp;元/间·月&nbsp;&nbsp;<span class="errorMessage"></span>
            <?php echo CHtml::error($model,'or_rentprice'); ?>
        </td>
    </tr>

    <tr>
        <td style="text-align:right">起租年限</td>
        <td style="text-align:left">
            <input type="text" name="or_basetime" id="or_basetime" maxlength="4" size="5" onblur="CheckTime(this)" value="<?php if($model->or_basetime!=""&&$model->or_basetime!="0")echo $model->or_basetime; ?>"/>&nbsp;年&nbsp;(代表最少要租多少年)&nbsp;&nbsp;<span class="errorMessage"></span>
            <?php echo CHtml::error($model,'or_basetime'); ?>
        </td>
    </tr>
</table>

<table width="100%" border="0" cellpadding="5" cellspacing="5" class="manage_tabletwo" style="margin-top:20px">
    <tr>
        <th style="text-align:left;">
            <div><font style="margin-left:15px;float: left">高级信息</font></div>
            <div><span id="gaojiinfo" style="cursor:pointer;float: right;margin-right: 20px"><?=CHtml::image("/images/btn_showinfo.gif")?></span></div>
        </th>
    </tr>
</table>

<table width="100%" border="0" cellpadding="5" cellspacing="5" class="hidden manage_tabletwo" id="detailed_info">
    <tr style="width:100%">
        <td style="text-align:right" width="15%">位置</td>
        <td style="text-align:left">
            <select name="ob_district" onchange="changeNext(this)" id="ob_district">
                <option value="0">-请选择-</option>
                <?php
                if(!empty($districtlist)){
                    foreach($districtlist as $value){
                ?>
                        <option value="<?php echo $value->re_id;?>"<?php if($model->ob_district==$value->re_id)echo "selected='selected'"; ?>><?php echo $value->re_name;?></option>
                <?php
                    }
                }
                ?>
            </select>
            <select name="ob_section" onchange="changeNext(this)" id="ob_section">
                <option value="0">-请选择-</option>
                <?php
                if(!empty($sectionlist)){
                    foreach($sectionlist as $value){
                ?>
                        <option value="<?php echo $value->re_id; ?>" <?=$value->re_id==$model->ob_section?"selected":""?>><?php echo $value->re_name;?></option>
                <?php
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td style="text-align:right"><?php echo CHtml::activeLabelEx($model,'ob_loop'); ?></td>
        <td style="text-align:left">
            <select name="ob_loop" id="ob_loop">
                <?php
                    foreach($allLoop as $key=>$value){
                        echo "<option value='".$key."'";
                        if($model->ob_loop==$key){
                            echo "selected='selected'";
                        }
                        echo ">".$value."</option>";
                    }
                ?>
            </select>
            <?php echo CHtml::error($model,'ob_loop'); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right" valign="top"><?php echo CHtml::activeLabelEx($model,'ob_busway'); ?></td>
        <td id="ob_busway" style="text-align:left">
            <?php
                $ob_busway = array();
                if($model->ob_busway!=""){
                    $ob_busway = split(",", $model->ob_busway);
                }
            ?>
            <input type="checkbox" id="ob_busway_1" name="ob_busway[]" value="1" <?php if(in_array(1, $ob_busway))echo "checked"; ?>/><label for="ob_busway_1">1号线</label>
            <input type="checkbox" id="ob_busway_2" name="ob_busway[]" value="2" <?php if(in_array(2, $ob_busway))echo "checked"; ?>/><label for="ob_busway_2">2号线</label>
            <input type="checkbox" id="ob_busway_3" name="ob_busway[]" value="3" <?php if(in_array(3, $ob_busway))echo "checked"; ?>/><label for="ob_busway_3">3号线</label>
            <input type="checkbox" id="ob_busway_4" name="ob_busway[]" value="4" <?php if(in_array(4, $ob_busway))echo "checked"; ?>/><label for="ob_busway_4">4号线</label>
            <input type="checkbox" id="ob_busway_5" name="ob_busway[]" value="5" <?php if(in_array(5, $ob_busway))echo "checked"; ?>/><label for="ob_busway_5">5号线</label>
            <input type="checkbox" id="ob_busway_6" name="ob_busway[]" value="6" <?php if(in_array(6, $ob_busway))echo "checked"; ?>/><label for="ob_busway_6">6号线</label>
            <input type="checkbox" id="ob_busway_7" name="ob_busway[]" value="7" <?php if(in_array(7, $ob_busway))echo "checked"; ?>/><label for="ob_busway_7">7号线</label>
            <input type="checkbox" id="ob_busway_8" name="ob_busway[]" value="8" <?php if(in_array(8, $ob_busway))echo "checked"; ?>/><label for="ob_busway_8">8号线</label>
            <input type="checkbox" id="ob_busway_9" name="ob_busway[]" value="9" <?php if(in_array(9, $ob_busway))echo "checked"; ?>/><label for="ob_busway_9">9号线</label>
            <input type="checkbox" id="ob_busway_10" name="ob_busway[]" value="10" <?php if(in_array(10, $ob_busway))echo "checked"; ?>/><label for="ob_busway_10">10号线</label>
            <input type="checkbox" id="ob_busway_11" name="ob_busway[]" value="11" <?php if(in_array(11, $ob_busway))echo "checked"; ?> /><label for="ob_busway_11">11号线</label>
            <input type="checkbox" id="ob_busway_12" name="ob_busway[]" value="12" <?php if(in_array(12, $ob_busway))echo "checked"; ?>/><label for="ob_busway_12">12号线</label>
            <input type="checkbox" id="ob_busway_13" name="ob_busway[]" value="13" <?php if(in_array(13, $ob_busway))echo "checked"; ?>/><label for="ob_busway_13">13号线</label>
            <?php echo CHtml::error($model,'ob_busway'); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">是否可分</td>
        <td style="text-align:left">
            <input type="radio" name="ob_cancut" checked value="0"/>否
            <input type="radio" name="ob_cancut" <?php if($model->ob_cancut==1)echo "checked"; ?> value="1"/>是
        </td>
    </tr>
    <tr>
        <td style="text-align:right">写字楼级别</td>
        <td style="text-align:left">
            <input type="radio" name="ob_officedegree" value="1" checked id="ob_officedegree_1"/><label for="ob_officedegree_1"><?php echo Officebaseinfo::$officedegree[1]; ?></label>&nbsp;&nbsp;
            <input type="radio" name="ob_officedegree" value="2" <?php if($model->ob_officedegree==2)echo "checked"; ?> id="ob_officedegree_2"/><label for="ob_officedegree_2"><?php echo Officebaseinfo::$officedegree[2]; ?></label>&nbsp;&nbsp;
            <input type="radio" name="ob_officedegree" value="3" <?php if($model->ob_officedegree==3)echo "checked"; ?> id="ob_officedegree_3"/><label for="ob_officedegree_3"><?php echo Officebaseinfo::$officedegree[3]; ?></label>&nbsp;&nbsp;
            <input type="radio" name="ob_officedegree" value="4" <?php if($model->ob_officedegree==4)echo "checked"; ?> id="ob_officedegree_4"/><label for="ob_officedegree_4"><?php echo Officebaseinfo::$officedegree[4]; ?></label>&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
        <td style="text-align:right">相关设施</td>
        <td style="text-align:left">
            <input id="selectAllFac" type="checkbox">
            <label>全选</label>
            <input type="checkbox" id="of_carparking" name="of_carparking" value="1" <?php if($model->of_carparking==1)echo "checked"; ?>/>
            <label for="of_carparking">停车场</label>
            <input type="checkbox" id="of_warming" name="of_warming" value="1" <?php if($model->of_warming==1)echo "checked"; ?>/>
            <label for="of_warming">暖气</label>
            <input type="checkbox" id="of_network" name="of_network" value="1" <?php if($model->of_network==1)echo "checked"; ?>/>
            <label for="of_network">网络</label>
            <input type="checkbox" id="of_lift" name="of_lift" value="1" <?php if($model->of_lift==1)echo "checked"; ?>/>
            <label for="of_lift">电梯</label>
            <input type="checkbox" id="of_elevator" name="of_elevator" value="1" <?php if($model->of_elevator==1)echo "checked"; ?>/>
            <label for="of_elevator">货梯</label>
            <input type="checkbox" id="of_gas" name="of_gas" value="1" <?php if($model->of_gas==1)echo "checked"; ?>/>
            <label for="of_gas">天然气</label>
            <input type="checkbox" id="of_aircondition" name="of_aircondition" value="1" <?php if($model->of_aircondition==1)echo "checked"; ?>/>
            <label for="of_aircondition">空调</label>
            <input type="checkbox" id="of_tv" name="of_tv" value="1" <?php if($model->of_tv==1)echo "checked"; ?>/>
            <label for="of_tv">电视</label>
            <input type="checkbox" id="of_door" name="of_door" value="1" <?php if($model->of_door==1)echo "checked"; ?>/>
            <label for="of_door">防盗门</label>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">物业公司</td>
        <td style="text-align:left">
            <input type="text" id="ob_propertycomname" name="ob_propertycomname" value="<?=CHtml::encode($model->ob_propertycomname); ?>"/>
            <?php echo CHtml::error($model,'ob_propertycomname'); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">物业费</td>
        <td style="text-align:left">
            <input type="text" id="ob_propertycost" name="ob_propertycost"  size="5" value="<?=CHtml::encode($model->ob_propertycost); ?>" onblur="validateNum(this)"/>&nbsp;元/平米·月&nbsp;&nbsp;<span class="errorMessage"></span>
            <?php echo CHtml::error($model,'ob_propertycost'); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">是否包含物业费</td>
        <td style="text-align:left">
            <input type="radio" name="or_iscontainprocost" checked value="0"/>否
            <input type="radio" name="or_iscontainprocost" value="1" <?php if($model->or_iscontainprocost==1)echo "checked"; ?>/>是
            <?php echo CHtml::error($model,'or_iscontainprocost'); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">出租方式</td>
        <td style="text-align:left">
            <?php
                foreach(Lookup::items('renttype') as $key=>$value){
                    ?>
                    <input type="radio" name="or_renttype" value="<?php echo $key;?>" <?php if($key==1)echo "checked"; ?> <?php if($model->or_renttype==$key&&$key!=1)echo "checked"; ?>/><?php echo $value ?>&nbsp;
                    <?php
                }
            ?>
        </td>
    </tr>
</table>

<table width="100%" border="0" cellpadding="5" cellspacing="5" class="manage_tabletwo"  style="margin-top:20px">
    <tr>
        <th colspan="2" style="text-align:left;"><font style="margin-left:15px">房源描述</font></th>
    </tr>
    <tr>
        <td style="text-align:right" width="15%">内部编号</td>
        <td style="text-align:left">
            <input type="text" name="op_serialnum" value="<?=CHtml::encode($model->op_serialnum); ?>"  />&nbsp;(请输入贵公司的内部房源编号，以便客户来电时方便您的查询)
        </td>
    </tr>
    <tr>
        <td style="text-align:right">标题<span class="required_title">*</span></td>
        <td style="text-align:left">
            精确完整的标题是您增加点击量，吸引客户注意力第一步！<br />
            <input type="text" id="op_officetitle" name="op_officetitle" size="60" value="<?=CHtml::encode($model->op_officetitle); ?>" maxlength="35" onblur="CheckTitle(this)" onkeyup="CheckTitle(this)"/><span class="errorMessage"></span>
            <?php echo CHtml::error($model,'op_officetitle'); ?>
        </td>
    </tr>
    <tr>
        <td valign="top" style="text-align:right">描述<span class="required_title">*</span></td>
        <td style="text-align:left">
            <textarea id="op_officedesc" name="op_officedesc" style="width:600px;height:300px;visibility:hidden;"><?=CHtml::encode($model->op_officedesc); ?></textarea><span class="errorMessage"></span>
            <?php echo CHtml::error($model,'op_officedesc'); ?>
        </td>
    </tr>
    
    <tr>
        <td style="text-align:right">
            <?php echo CHtml::activeLabelEx($model,'ot_isrecommend'); ?>
        </td>
        <td style="text-align:left">
            <input type="radio" name="ot_isrecommend" id="ot_isrecommend0" checked value="0">否
            <input type="radio" name="ot_isrecommend" id="ot_isrecommend1" value="1" <?php if($model->ot_isrecommend==1)echo "checked"; ?>/>是
            <?php echo CHtml::error($model,'ot_isrecommend'); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right"><?php echo CHtml::activeLabelEx($model,'ot_ishurry'); ?></td>
        <td style="text-align:left">
            <input type="radio" name="ot_ishurry" id="ot_ishurry0" checked value="0"/>否
            <input type="radio" name="ot_ishurry" id="ot_ishurry1" value="1" <?php if($model->ot_ishurry==1)echo "checked"; ?>/>是
            <?php echo CHtml::error($model,'ot_ishurry'); ?>
        </td>
    </tr>
    
    <tr>
        <td style="text-align:right" valign="top">房源标签</td>
        <td style="text-align:left" id="officetag">
            <?php
            $tags = Tags::model()->getTagsByTypeAndMarke(Tags::office,Tags::rent,12);
            $tagsarr = array();
            if(!empty($model->ob_tag)){
                $tagsarr = split(",", $model->ob_tag);
            }
            if(!empty($tags)){
                foreach($tags as $key=>$value){
            ?>
            <input type="checkbox" name="tag[]" value="<?=CHtml::encode($value->tag_name);?>" id="tag_<?=$key+1?>" <?php if(in_array($value->tag_name,$tagsarr))echo "checked"; ?> onclick="checkTagNum(this)" /><label for="tag_<?=$key+1?>"><?=CHtml::encode($value->tag_name)?></label>&nbsp;&nbsp;
            <?php
                }
            }
            ?>
        </td>
    </tr>
    <tr>
        <td style="text-align:right">信息有效期</td>
        <td style="text-align:left">
            <select name="ob_expiredate">
                <option value="1">1天</option>
                <option value="60" selected>60天</option>
            </select>
        </td>
    </tr>
</table>
<script type="text/javascript">
function checkTagNum(obj){
    var num = $("#officetag input:checked").length;
    if(num>3){
        alert("很遗憾，最多只能选择三个标签！")
        $(obj).get(0).checked = 0;
    }
}
//详细信息展开
$("#gaojiinfo").toggle(
    function () {
        $("#detailed_info").removeClass("hidden").addClass("show");
        $("#gaojiinfo").children("img").attr("src","/images/btn_hideinfo.gif");
    },
    function () {
        $("#detailed_info").removeClass("show").addClass("hidden");
        $("#gaojiinfo").children("img").attr("src","/images/btn_showinfo.gif");
    }
);
//通过房源id，得到需要的全部信息
function getOtherBuildInfo(id){
    $("#search_suggest").html("").css("display","none");
    closeAddBuildFrame();
    $.ajax({
        type: "GET",
        url: "<?php echo Yii::app()->createUrl("/businesscenter/getbuildinfo"); ?>",
        data: "buildingid="+id,
        success: function (msg){
            msg = eval("("+msg+")");
            //隐藏域中id
            $("#ob_sysid").val(msg['sbi_buildingid']);
            //名称
            $("#ofname").val(msg['sbi_buildingname']);
            //地址
            $("#officeaddress").val(msg['sbi_address']);
            //环线
            $("#ob_loop").get(0).selectedIndex=msg['sbi_loop']-1;
            //位置
            var length = $("#ob_district").get(0).options.length;
            for(var i=0;i<length;i++){
                if($("#ob_district").get(0).options[i].value==msg['sbi_district']){
                    $("#ob_district").get(0).selectedIndex = i;
                    changeNext($("#ob_district"));
                }
            }
            length = $("#ob_section").get(0).options.length;
            for(var i=0;i<length;i++){
                if($("#ob_section").get(0).options[i].value==msg['sbi_section']){
                    $("#ob_section").get(0).selectedIndex = i;
                }
            }
            //轨道
            var busway = msg['sbi_busway'].split(",");
            for(var i=0;i<busway.length;i++){
                $("#ob_busway").children("input").eq(busway[i]-1).get(0).checked = true;
            }
            //物业公司
            $("#ob_propertycomname").val(msg['sbi_propertyname']);
            //物业费
            $("#ob_propertycost").val(msg['sbi_propertyprice']);
        }
    });
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
    var value = $(obj).val();
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
    if($(obj).val()==""){
        $(obj).next("span").html("名称不能为空");
        return false;
    }else{
        $(obj).next("span").html("");
        return true;
    }
}
//验证面积
function checkArea(obj){
    var value = $(obj).val();
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
            var RegExp1=new RegExp("^[0-9]+[.][0-9]{2,}$");
            if(RegExp1.test(value)){
                $(obj).next("span").html("面积只能保留一位小数");
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
//验证租金
function CheckRentPrice(obj){
    var value = $(obj).val();
    if(value!=""){
        if(isNaN(value)){
            $(obj).next("span").html("租金只能为数字");
            $(obj).focus();
            return false;
        }else if(parseFloat(value)<=0 || parseInt(value)>100000){
            $(obj).next("span").html("租金不合法，在0-100000之间，请重新输入");
            $(obj).focus();
            return false;
        }else{
            $(obj).next("span").html("");
            return true;
        }
    }else {
         $(obj).next("span").html("租金不能为空");
         return false;
     }
}
//验证起租年限
function CheckTime(obj){
    var value = $(obj).val();
    if(value!=""){
        if(isNaN(value)){
            $(obj).next("span").html("年代只能为数字");
            $(obj).focus();
            return false;
        }else if(parseInt(value)<=0){
            $(obj).next("span").html("至少为1年,请按规定填写");
            $(obj).focus();
            return false;
        }else{
            $(obj).next("span").html("");
            return true;
        }
    }else {
         $(obj).next("span").html("");
         return true;
     }
}
//验证标题
function CheckTitle(obj){
    $(obj).next("span").css("color", "");
    var allNum = 35*3;
    var value = $(obj).val();
    value = value.replace(/([\u0391-\uFFE5])/ig,'111');
    if(value==""){
        $(obj).next("span").html("请填写房源标题！");
        return false;
    }else if(value.length>allNum){
        $(obj).next("span").html("房源标题最多填写"+allNum+"个字符！");
        $(obj).focus();
        return false;
    }else if(value.length==allNum){
       $(obj).next("span").css("color", "black");
        $(obj).next("span").html("（<font style='font-weight:bold'>"+value.length+"</font>/"+allNum+"个字符）");
        return true;
    }else {
        $(obj).next("span").css("color", "black");
        $(obj).next("span").html("（"+value.length+"/"+allNum+"个字符）");
        return true;
    }
}
//查询楼盘名称
function searchBuildName() {
    $("#add_build").css("display","none");
    var inputField = document.getElementById( "ofname");
    var suggestText = document.getElementById( "search_suggest");
    $("#ob_sysid").val("");
    if (inputField.value.length > 0) {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl("businesscenter/showlikename");?>',
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
                        s+=' onclick= "javascript:getOtherBuildInfo('+msg[i]['sbi_buildingid']+');" ';
                        s+=' class= "suggest_link">' +msg[i]['sbi_buildingname']+'&nbsp;&nbsp;';
                        s+='(地址：'+msg[i]['sbi_address']+')';
                        s+='</div>';
                        suggestText.innerHTML += s;
                    }
                }
                else{
                    suggestText.style.display= "";
                    suggestText.innerHTML = '没有搜到匹配的小区<?=CHtml::link("添加楼盘",array("systembuildinginfo/create"))?>';
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
    var html = '<iframe src="<?php echo Yii::app()->createUrl('/buildcollect/create')?>" frameborder="0" width="400px" height="210px" style="margin-top:10px"></iframe>';
    $("#add_build").css("display","").html(html);
}
var checkAllFacility = false;
$("#selectAllFac").bind("click",function(){
    if(checkAllFacility){
        $(this).siblings("input").removeAttr("checked");
        checkAllFacility=false;
    }else{
       $(this).siblings("input").attr("checked","checked");
       checkAllFacility=true;
    }
})
function closeAddBuildFrame(){
    $("#add_build").html("").css("display","none");
    $("#ofname").removeAttr("readonly").css("background-color","white");
}
</script>