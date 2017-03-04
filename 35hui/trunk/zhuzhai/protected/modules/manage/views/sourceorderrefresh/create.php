
<style type="text/css">
    td {padding:5px 10px;}
    a {color: #0063B8;text-decoration: none;}
    a:hover {text-decoration: underline;	color: #f30;}
    .title {font-size:16px;}
    .shuoming {background:#F4F9FF;padding:5px;}
    .timeRegion{width: 130px; float: left; margin-bottom:5px;}
    .left{float:left;}
    .red {color:#f30;}
</style>
<form action="" method="post" style="border: 1px solid #C4CFE1;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #FFFFFF; height:500px;" align="center">
        <tr>
            <td colspan="3" style="padding: 0;">
                <table width="100%" cellspacing="0" bgcolor="#F4F9FF" style="border-bottom: 1px solid #C4CFE1;">
                    <tr>
                        <td width="50" height="5" align="center" valign="middle"></td>
                        <td width="408" height="5"></td>
                        <td width="12" height="5"></td>
                    </tr>
                    <tr>
                        <td width="50" rowspan="2" align="center" valign="middle">
                            <img src="<?=IMAGE_URL?>/clock.gif" alt="">
                        </td>
                        <td>
                            <strong class="title">
                                <span id="spMsg">
                                    您每日总共可刷新<font class="red"><?=$operateNum?></font>次。
                                    今日刷新<?php
                                    $daytype = 0;
                                    if($sourceType==1){
                                        $daytype=Dayoperation::buildFlush;
                                        $name = "写字楼";
                                    }elseif($sourceType==2){
                                        $daytype=Dayoperation::shopFlush;
                                        $name = "商铺";
                                    }elseif($sourceType==3){
                                        $daytype=Dayoperation::residenceFlush;
                                        $name = "住宅";
                                    }elseif($sourceType==4){
                                        $daytype=Dayoperation::creativesourceFlush;
                                        $name = "创意园区";
                                    }
                                    $flushNum = Dayoperation::model()->getPerationNumByUidAndType(Yii::app()->user->id, $daytype);
                                    echo $name.'<font class="red">'.$flushNum.'</font>';
                                    ?>次，
                                    今日剩余<font class="red"><?php echo ($operateNum-$flushNum);?></font>次。
                                </span>
                            </strong>
                        </td>
                        <td width="12" rowspan="2">
                            <div style="height: 60px; font-size: 16px; font-family: Arial; margin-top: -5px;
                                 margin-right: 5px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            您选择了<font color="red"><?= count(explode("_", $_GET['sourceid']))-1;?></font>条房源
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5">
                    <tr>
                        <td colspan="3">选择预约刷新方案：</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            
                            <?=CHtml::radioButton("template","",array("id"=>"template1","onClick"=>"changeTemplateValues(0)"));?><label for="template1">模板一</label>
                            <?=CHtml::radioButton("template","",array("id"=>"template2","onClick"=>"changeTemplateValues(1)"));?><label for="template2">模板二</label>
                            <?=CHtml::radioButton("template","",array("id"=>"template3","onClick"=>"changeTemplateValues(2)"));?><label for="template3">模板三</label>
                            <br />
                            <?php
                            if($schemes){
                                foreach($schemes as $key=>$value){
                                    echo CHtml::radioButton("template","",array("id"=>"userTemplate".$key,"onClick"=>"changeUserTemplateValues(this)")).'<label for="userTemplate'.$key.'">'.$value['ors_schemename'].'</label>';
                                    echo CHtml::hiddenField("userTemplate".$key,json_encode(unserialize($value['ors_schemetime'])));
                                }
                            }else{
                            ?>
                            <span style="color:#999999;">您还没有制定方案！</span>
                            <?php
                            }
                            ?>
                            <a href="#" class="bluet" onclick="goToScheme()">自定义方案</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            选择时间点：
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" id="orderFreshDiv">
                            <?php
                            $num = 8;//显示预约点的数目
                            for($nowNum = 1;$nowNum<$num+1;$nowNum++){
                                ?>
                                <div class="timeRegion">
                                <div class="left">
                                    <?=CHtml::dropDownList("hourSelect[".$nowNum."]","",Sourceorderrefresh::$hourSelect,array("onChange"=>"filterMinuteSelect(this)","id"=>"hourSelect".$nowNum))?>
                                    点
                                    <?=CHtml::dropDownList("minuteSelect[".$nowNum."]","",array_slice(Sourceorderrefresh::$minuteSelect,0,1,true),array("id"=>"minuteSelect".$nowNum))?>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td bgcolor="#f5f5f5">
                            本次预约刷新当日即可生效，请选择执行天数：
                            <?=CHtml::dropDownList("SetDay","",Sourceorderrefresh::$orderDays)?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#f5f5f5">
                            <input type="submit" id="btnSubmit" value="确定" onclick="return SaveFreshHouse()" style="width:60px">
                            &nbsp;
                            <input type="button" onclick="parent.closeTip()" value="取消" style="width:60px">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="shuoming">
                    <tr>
                        <td>
                            <strong>操作说明</strong><br>
                            1.系统将根据每日可刷新房源条数执行，如果刷新条数不足或用完，房源将不会被刷新。<br>
                            2.今天设置预约刷新的房源，在预约刷新设置之前的时间点不会被刷新。
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<?=CHtml::dropDownList("hiddentime1","",array_slice(Sourceorderrefresh::$minuteSelect,0,1,true),array("id"=>"hiddentime1","style"=>"display:none"))?>
<?=CHtml::dropDownList("hiddentime2","",array_slice(Sourceorderrefresh::$minuteSelect,1,6,true),array("id"=>"hiddentime2","style"=>"display:none"))?>
<script type="text/javascript">
    function goToScheme(){
        parent.frameLocation("/manage/orderrefreshscheme/index");
    }
    function SaveFreshHouse(){
        var tempTimeArray = new Array();
        var isChoose = 0;//是否选择了时间点
        for(var i=1;i<=<?=$num?>;i++)
        {
            var tempHour = $("#hourSelect"+i).val();
            var tempMinute = $("#minuteSelect"+i).val();
            if(tempHour !='-1' && tempMinute != '-1')
            {
                tempTimeArray.push(tempHour + tempMinute);
                isChoose = 1;
            }
        }
        if(isChoose=="0"){
            alert("请选择至少一个时间点！");
            return false;
        }
        var length1 = tempTimeArray.length;
        tempTimeArray.unique();
        var length2 = tempTimeArray.length;
        if(length1!=length2){
            alert("您选择的刷新时间有重复，请重新选择！");
            return false;
        }
        return true;
    }
    function filterMinuteSelect(obj){
        var hour = $(obj).val();
        if(hour=="-1"){
            $(obj).next("select").html($("#hiddentime1").html())
        }else{
            $(obj).next("select").html($("#hiddentime2").html());
        }
    }
    /**
     * 使用模板修改选择值
     */
    function changeTemplateValues(id){
        var template = <?=json_encode(Orderrefreshscheme::$template);?>;
        setSchemeValues(template[id]);
    }
    /**
     * 修改用户模版
     */
    function changeUserTemplateValues(obj){
        var template  = $(obj).nextAll("input").val();
        template = eval("("+template+")");
        setSchemeValues(template);
    }
    function setSchemeValues(values){
        for(var i=0;i<8;i++){
            var tmp = i+1;
            if("undefined"==typeof(values[i])){
                $("#hourSelect"+tmp).val("-1");
                filterMinuteSelect($("#hourSelect"+tmp));
            }else{
                var time = formatTime(values[i]);
                $("#hourSelect"+tmp).val(time[0]);
                filterMinuteSelect($("#hourSelect"+tmp));
                $("#minuteSelect"+tmp).val(time[1]);
            }
        }
    }
    function formatTime(saveValue){
        saveValue = "0000"+saveValue;
        var length = saveValue.length;
        var hour = saveValue.charAt(length-4)+saveValue.charAt(length-3);
        var minute = saveValue.charAt(length-2)+saveValue.charAt(length-1);
        hour.indexOf("0")==0?hour = hour.charAt(hour.length-1):"";//如果小时第一位是0，则去除0；
        return new Array(hour,minute);
    }
    function array_unique(){
        var o = new Object();
        for (var i=0,j=0; i<this.length; i++){
            if (typeof o[this[i]] == 'undefined')
            {
                o[this[i]] = j++;
            }
        }
        this.length = 0;
        for (var key in o){
            this[o[key]] = key;
        }
        return this;
    }
Array.prototype.unique = array_unique;
</script>