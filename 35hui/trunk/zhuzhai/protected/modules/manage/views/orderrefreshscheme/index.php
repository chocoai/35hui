<?php
$this->breadcrumbs=array('预约刷新方案');
?>
<style type="text/css">
    .tab {background-image:url(/images/tab_rowbg.gif);height: 32px;background-repeat: repeat-x;width: 680px;overflow: hidden;}
    .tab ul {float: left;height: 32px;overflow: hidden;clear: both;width: 680px;display: block;}
    .tab ul .in_on {float: left;display: block;height: 31px;border: 1px solid #9EC9EC;background-image:url(/images/icon_leftarrow.gif);background-repeat: no-repeat;line-height: 31px;background-color: #F3FBFE;font-size: 14px;color: #244BB2; border:1px solid #9EC9EC; padding-left: 50px;background-position: 20px 7px;border-bottom: 0;padding-right: 20px;margin-right: 5px;}
    .cont {clear: both;width: 668px;border: 1px solid #9EC9EC;border-top: 0;padding: 10px 5px;}
    .btudiv {clear: both;width: 100%;height: auto;padding: 15px 0;text-align: center;overflow: hidden;}
    .onerefreshtime{width:130px;float: left;margin-bottom: 10px }
    table tr{height: 50px}
</style>

<div class="msg">
    制定几套您常用的刷新方案，会大大提高您在使用预约时的效率，避免不必要的重复工作。
</div>
<div class="htit">设置预约刷新方案</div>

<div style="margin-top:10px;width:742px;">
        <?php
        $schemeName = array("方案一","方案二","方案三","方案四","方案五");
        for($schemeNum=0;$schemeNum<5;$schemeNum++){
            ?>

        <form action="" method="post" onsubmit="return validateForm(this)">
            <div class="tab ">
                <ul style="margin: 0px;">
                    <li class="in_on"><strong><?=$schemeName[$schemeNum]?></strong></li>
                </ul>
            </div>
            <div class="cont" style="padding-left: 0pt; padding-right: 0pt; width: 680px;">
                <table class="tb01" width="660px" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="font-size: 12px;" valign="middle" width="70" align="right" bgcolor="#f9f9f9">
                            方案名称：</td>
                        <td style="text-align:left">
                            <div>
                                <input name="schemeName" value="<?=isset($schemes[$schemeNum])?$schemes[$schemeNum]['ors_schemename']:$schemeName[$schemeNum]?>" size="12" type="text" maxlength="6" />
                                <span style="color: rgb(153, 153, 153); font-size: 12px;">标题可自行输入，最多六个汉字。</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align="right" bgcolor="#f9f9f9">&nbsp;</td>
                        <td valign="top" style="text-align:left">
                                <?php
                                $num = 8;//显示预约点的数目
                                $oldSerilazeDate = isset($schemes[$schemeNum])?$schemes[$schemeNum]['ors_schemetime']:array();
                                $oldDate = array();
                                if($oldSerilazeDate){
                                    $oldDate = unserialize($oldSerilazeDate);
                                }
                                for($nowNum = 1;$nowNum<$num+1;$nowNum++){
                                    ?>
                            <div class="onerefreshtime">
                                        <?=CHtml::dropDownList("hourSelect[".$nowNum."]",isset($oldDate[$nowNum-1])?intval(Sourceorderrefresh::model()->getHour($oldDate[$nowNum-1])):"",Sourceorderrefresh::$hourSelect,array("onChange"=>"filterMinuteSelect(this)"))?>
                                点
                                        <?php
                                        if(isset($oldDate[$nowNum-1])){
                                            echo CHtml::dropDownList("minuteSelect[".$nowNum."]",Sourceorderrefresh::model()->getMinute($oldDate[$nowNum-1]),array_slice(Sourceorderrefresh::$minuteSelect,1,6,true));
                                        }else{
                                            echo CHtml::dropDownList("minuteSelect[".$nowNum."]","",array_slice(Sourceorderrefresh::$minuteSelect,0,1,true));
                                        }
                                        ?>
                            </div>
                                    <?php
                                }
                                ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="btudiv">
                <input type="submit" class="btn_01" value="保存">
            </div>
            <input type="hidden" name="schemeId" value="<?=isset($schemes[$schemeNum])?$schemes[$schemeNum]['ors_id']:""?>" />
        </form>
            <?php
        }
        ?>

    </div>
    <?=CHtml::dropDownList("hiddentime1","",array_slice(Sourceorderrefresh::$minuteSelect,0,1,true),array("id"=>"hiddentime1","style"=>"display:none"))?>
    <?=CHtml::dropDownList("hiddentime2","",array_slice(Sourceorderrefresh::$minuteSelect,1,6,true),array("id"=>"hiddentime2","style"=>"display:none"))?>
    <script type="text/javascript">
        function filterMinuteSelect(obj){
            var hour = $(obj).val();
            if(hour=="-1"){
                $(obj).next("select").html($("#hiddentime1").html())
            }else{
                $(obj).next("select").html($("#hiddentime2").html());
            }
        }
        function validateForm(obj){
            var name = $(obj).find("input[name='schemeName']").val();
            if(name==""){
                alert("请输入方案名称！");
                return false;
            }

            var tempTimeArray = new Array();
            var isChoose = 0;//是否选择了时间点
            for(var i=1;i<=8;i++)
            {
                var tempHour = $(obj).find("select[name='hourSelect["+i+"]']").val();
                var tempMinute = $(obj).find("select[name='minuteSelect["+i+"]']").val();
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
            alert("预约方案设置成功！")
            return true;
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