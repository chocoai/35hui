<?php
$this->currentMenu = 20;
$this->breadcrumbs=array(
        '楼盘管理'=>array('index'),
        "合并楼盘",
);
?>
<style type="text/css">
    table td{border-bottom:1px dotted #009}
    .oneDiv{border: 1px solid #298DCD;width:45%;padding: 10px}
    .fenge{background-color: gray;}
    .on{background-color: #E7F1FA}
</style>
<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>
<font color="red">请勾选要替换的字段</font>
替换包括楼盘全景、楼盘图片、写字楼房源
<form method="post" action="" onsubmit="return validateForm()">
    <div style="width:100%;" class="oneDiv">
        <table width="100%" id="form_table">
            <tr>
                <td colspan="3">
                    <b>待删除ID：</b>
                    <input type="text" id="buildid_from" style="width:80px"/>
                    <input type="hidden" name="frombuildid" id="frombuildid" />
                    <input type="button" value="确定" onclick="buildSearchFrom()" />
                </td>
                <td class="fenge" width="2px">&nbsp;</td>
                <td>
                    <b>合并至ID：</b>
                    <input type="text" id="buildid_to" style="width:80px"/>
                    <input type="hidden" name="tobuildid" id="tobuildid" />
                    <input type="button" value="确定" onclick="buildSearchTo()" />
                </td>
            </tr>
            <tr>
                <td width="80px">ID：</td>
                <td class="from" attr="sbi_buildingid" width="250px">&nbsp;</td>
                <td width="10px">&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_buildingid">&nbsp;</td>
            </tr>
            <tr>
                <td>名称：</td>
                <td class="from" attr="sbi_buildingname">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_buildingname">&nbsp;</td>
            </tr>
            <tr>
                <td>英文名字：</td>
                <td class="from" attr="sbi_buildingenglishname">&nbsp;</td>
                <td><input type="checkbox" name="sbi_buildingenglishname" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_buildingenglishname">&nbsp;</td>
            </tr>
            <tr>
                <td>得房率：</td>
                <td class="from" attr="sbi_defanglv">&nbsp;</td>
                <td><input type="checkbox" name="sbi_defanglv" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_defanglv">&nbsp;</td>
            </tr>
            <tr>
                <td>临近轨道：</td>
                <td class="from" attr="sbi_busway">&nbsp;</td>
                <td><input type="checkbox" name="sbi_busway" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_busway">&nbsp;</td>
            </tr>
            <tr>
                <td>地址：</td>
                <td class="from" attr="sbi_address">&nbsp;</td>
                <td><input type="checkbox" name="sbi_address" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_address">&nbsp;</td>
            </tr>
            <tr>
                <td>开盘时间：</td>
                <td class="from" attr="sbi_openingtime">&nbsp;</td>
                <td><input type="checkbox" name="sbi_openingtime" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_openingtime">&nbsp;</td>
            </tr>
            <tr>
                <td>物业名称：</td>
                <td class="from" attr="sbi_propertyname">&nbsp;</td>
                <td><input type="checkbox" name="sbi_propertyname" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_propertyname">&nbsp;</td>
            </tr>
            <tr>
                <td>物业公司电话：</td>
                <td class="from" attr="sbi_propertytel">&nbsp;</td>
                <td><input type="checkbox" name="sbi_propertytel" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_propertytel">&nbsp;</td>
            </tr>
            <tr>
                <td>开发商：</td>
                <td class="from" attr="sbi_developer">&nbsp;</td>
                <td><input type="checkbox" name="sbi_developer" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_developer">&nbsp;</td>
            </tr>
            <tr>
                <td>物业管理费：</td>
                <td class="from" attr="sbi_propertyprice">&nbsp;</td>
                <td><input type="checkbox" name="sbi_propertyprice" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_propertyprice">&nbsp;</td>
            </tr>
            <tr>
                <td>物业级别：</td>
                <td class="from" attr="sbi_propertydegree">&nbsp;</td>
                <td><input type="checkbox" name="sbi_propertydegree" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_propertydegree">&nbsp;</td>
            </tr>
            <tr>
                <td>建筑总面积：</td>
                <td class="from" attr="sbi_buildingarea">&nbsp;</td>
                <td><input type="checkbox" name="sbi_buildingarea" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_buildingarea">&nbsp;</td>
            </tr>
            <tr>
                <td>标准层面积：</td>
                <td class="from" attr="sbi_floorarea">&nbsp;</td>
                <td><input type="checkbox" name="sbi_floorarea" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_floorarea">&nbsp;</td>
            </tr>
            <tr>
                <td>总层数：</td>
                <td class="from" attr="sbi_floor">&nbsp;</td>
                <td><input type="checkbox" name="sbi_floor" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_floor">&nbsp;</td>
            </tr>

            <tr>
                <td>平均租金：</td>
                <td class="from" attr="sbi_avgrentprice">&nbsp;</td>
                <td><input type="checkbox" name="sbi_avgrentprice" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_avgrentprice">&nbsp;</td>
            </tr>
            <tr>
                <td>平均售价：</td>
                <td class="from" attr="sbi_avgsellprice">&nbsp;</td>
                <td><input type="checkbox" name="sbi_avgsellprice" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_avgsellprice">&nbsp;</td>
            </tr>
            <tr>
                <td>x坐标：</td>
                <td class="from" attr="sbi_x">&nbsp;</td>
                <td><input type="checkbox" name="sbi_x" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_x">&nbsp;</td>
            </tr>
            <tr>
                <td>y坐标：</td>
                <td class="from" attr="sbi_y">&nbsp;</td>
                <td><input type="checkbox" name="sbi_y" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_y">&nbsp;</td>
            </tr>
            <tr>
                <td>楼书：</td>
                <td class="from" attr="sbi_loushu">&nbsp;</td>
                <td><input type="checkbox" name="sbi_loushu" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_loushu">&nbsp;</td>
            </tr>
            <tr>
                <td>合同：</td>
                <td class="from" attr="sbi_hetong">&nbsp;</td>
                <td><input type="checkbox" name="sbi_hetong" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_hetong">&nbsp;</td>
            </tr>
            <tr>
                <td>售楼电话：</td>
                <td class="from" attr="sbi_tel">&nbsp;</td>
                <td><input type="checkbox" name="sbi_tel" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_tel">&nbsp;</td>
            </tr>
            <tr>
                <td>楼宇总楼数：</td>
                <td class="from" attr="sbi_dongnum">&nbsp;</td>
                <td><input type="checkbox" name="sbi_dongnum" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_dongnum">&nbsp;</td>
            </tr>
            <tr>
                <td>外立面：</td>
                <td class="from" attr="sbi_wailimian">&nbsp;</td>
                <td><input type="checkbox" name="sbi_wailimian" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_wailimian">&nbsp;</td>
            </tr>
            <tr>
                <td>楼盘介绍：</td>
                <td class="from" attr="sbi_buildingintroduce">&nbsp;</td>
                <td><input type="checkbox" name="sbi_buildingintroduce" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_buildingintroduce">&nbsp;</td>
            </tr>
            <tr>
                <td>周边配套：</td>
                <td class="from" attr="sbi_peripheral">&nbsp;</td>
                <td><input type="checkbox" name="sbi_peripheral" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_peripheral">&nbsp;</td>
            </tr>
            <tr>
                <td>交通情况：</td>
                <td class="from" attr="sbi_traffic">&nbsp;</td>
                <td><input type="checkbox" name="sbi_traffic" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_traffic">&nbsp;</td>
            </tr>
            <tr>
                <td>大堂：</td>
                <td class="from" attr="sbi_datang">&nbsp;</td>
                <td><input type="checkbox" name="sbi_datang" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_datang">&nbsp;</td>
            </tr>
            <tr>
                <td>公共走廊：</td>
                <td class="from" attr="sbi_zoulang">&nbsp;</td>
                <td><input type="checkbox" name="sbi_zoulang" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_zoulang">&nbsp;</td>
            </tr>
            <tr>
                <td>楼层信息：</td>
                <td class="from" attr="sbi_floorinfo">&nbsp;</td>
                <td><input type="checkbox" name="sbi_floorinfo" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_floorinfo">&nbsp;</td>
            </tr>
            <tr>
                <td>单元分割：</td>
                <td class="from" attr="sbi_danyuanfenge">&nbsp;</td>
                <td><input type="checkbox" name="sbi_danyuanfenge" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_danyuanfenge">&nbsp;</td>
            </tr>
            <tr>
                <td>交屋标准：</td>
                <td class="from" attr="sbi_biaozhun">&nbsp;</td>
                <td><input type="checkbox" name="sbi_biaozhun" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_biaozhun">&nbsp;</td>
            </tr>
            <tr>
                <td>卫生间：</td>
                <td class="from" attr="sbi_toiletwater">&nbsp;</td>
                <td><input type="checkbox" name="sbi_toiletwater" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_toiletwater">&nbsp;</td>
            </tr>
            <tr>
                <td>电梯配置：</td>
                <td class="from" attr="sbi_liftinfo">&nbsp;</td>
                <td><input type="checkbox" name="sbi_liftinfo" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_liftinfo">&nbsp;</td>
            </tr>
            <tr>
                <td>通讯系统：</td>
                <td class="from" attr="sbi_communication">&nbsp;</td>
                <td><input type="checkbox" name="sbi_communication" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_communication">&nbsp;</td>
            </tr>
            <tr>
                <td>空调系统：</td>
                <td class="from" attr="sbi_aircon">&nbsp;</td>
                <td><input type="checkbox" name="sbi_aircon" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_aircon">&nbsp;</td>
            </tr>
            <tr>
                <td>安防系统：</td>
                <td class="from" attr="sbi_security">&nbsp;</td>
                <td><input type="checkbox" name="sbi_security" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_security">&nbsp;</td>
            </tr>
            <tr>
                <td>车位配置：</td>
                <td class="from" attr="sbi_carport">&nbsp;</td>
                <td><input type="checkbox" name="sbi_carport" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_carport">&nbsp;</td>
            </tr>
            <tr>
                <td>楼内配套：</td>
                <td class="from" attr="sbi_roommating">&nbsp;</td>
                <td><input type="checkbox" name="sbi_roommating" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_roommating">&nbsp;</td>
            </tr>
            <tr>
                <td>物业服务：</td>
                <td class="from" attr="sbi_propertyserver">&nbsp;</td>
                <td><input type="checkbox" name="sbi_propertyserver" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="sbi_propertyserver">&nbsp;</td>
            </tr>
        </table>
        <div style="width: 100%;border-top: 1px solid aqua;text-align: center">
            <input type="submit" value="确定合并楼盘" />
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $("#form_table tr").bind("mouseover",function(){
            $(this).addClass("on");
        }).bind("mouseout",function(){
            $(this).removeClass("on");
        })
    })
    function validateForm(){
        var fromid = $("#frombuildid").val();
        var toid = $("#tobuildid").val();
        if(fromid==""||toid==""){
            alert("请输入楼盘id");
            return false;
        }else if(fromid==toid){
            alert("不能使用两个相同的id");
            return false;
        }else{
            var info = $("form").serialize();
            var arr = info.split("&");
            if(arr.length==2){
                if(!confirm("确定不使用任何原楼盘的字段吗？")){
                    return false;
                }
            }
        }
        return true;
    }
    function buildSearchFrom(){
        var buildIdFrom = $.trim($("#buildid_from").val());
        $.ajax({
            url:"/systembuildinginfo/getbuildinfo",
            data:{"id":buildIdFrom},
            type:"GET",
            success:function(msg){
                if(msg!="error"){
                    var msg = eval("("+msg+")");
                    $("#frombuildid").val(msg["sbi_buildingid"]);
                    $("#form_table td[class='from']").each(function(){
                        var key = $(this).attr("attr");
                        $(this).html(msg[key]);
                    });
                }else{
                    alert("楼盘不存在")
                };
            }
        })
    }
    function buildSearchTo(){
        var buildIdTo = $.trim($("#buildid_to").val());
        $.ajax({
            url:"/systembuildinginfo/getbuildinfo",
            data:{"id":buildIdTo},
            type:"GET",
            success:function(msg){
                if(msg!="error"){
                    var msg = eval("("+msg+")");
                    $("#tobuildid").val(msg["sbi_buildingid"])
                    $("#form_table td[class='to']").each(function(){
                        var key = $(this).attr("attr");
                        $(this).html(msg[key]);
                    });
                }else{
                    alert("楼盘不存在")
                };
            }
        })
    }
</script>