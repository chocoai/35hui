<?php
$this->currentMenu = 20;
$this->breadcrumbs=array(
        '创意园区'=>array('index'),
        "合并创意园",
);
$this->menu=array(
	array('label'=>'创建', 'url'=>array('create')),
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
替换包括创意园全景、创意园图片、商务中心房源
<form method="post" action="" onsubmit="return validateForm()">
    <div style="width:100%;" class="oneDiv">
        <table width="100%" id="form_table">
            <tr >
                <td colspan="3">
                    <b>待删除ID：</b>
                    <input type="text" id="creativepark_from" style="width:80px"/>
                    <input type="hidden" name="fromcreativeparkid" id="fromcreativeparkid" />
                    <input type="button" value="确定" onclick="creativeparkSearchFrom()" />
                </td>
                <td class="fenge" width="2px">&nbsp;</td>
                <td>
                    <b>合并至ID：</b>
                    <input type="text" id="creativepark_to" style="width:80px"/>
                    <input type="hidden" name="tocreativeparkid" id="tocreativeparkid" />
                    <input type="button" value="确定" onclick="creativeparkSearchTo()" />
                </td>
            </tr>
            <tr>
                <td width="80px">ID：</td>
                <td class="from" attr="cp_id" width="250px">&nbsp;</td>
                <td width="10px">&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_id">&nbsp;</td>
            </tr>
            <tr>
                <td>名称：</td>
                <td class="from" attr="cp_name">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_name">&nbsp;</td>
            </tr>
            <tr>
                <td>英文名字：</td>
                <td class="from" attr="cp_pinyinlongname">&nbsp;</td>
                <td><input type="checkbox" name="cp_pinyinlongname" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_pinyinlongname">&nbsp;</td>
            </tr>
            <tr>
                <td>得房率：</td>
                <td class="from" attr="cp_defanglv">&nbsp;</td>
                <td><input type="checkbox" name="cp_defanglv" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_defanglv">&nbsp;</td>
            </tr>
            <tr>
                <td>交通情况：</td>
                <td class="from" attr="cp_traffic">&nbsp;</td>
                <td><input type="checkbox" name="cp_traffic" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_traffic">&nbsp;</td>
            </tr>
            <tr>
                <td>地址：</td>
                <td class="from" attr="cp_address">&nbsp;</td>
                <td><input type="checkbox" name="cp_address" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_address">&nbsp;</td>
            </tr>
            <tr>
                <td>开盘时间：</td>
                <td class="from" attr="cp_openingtime">&nbsp;</td>
                <td><input type="checkbox" name="cp_openingtime" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_openingtime">&nbsp;</td>
            </tr>
            <tr>
                <td>物业名称：</td>
                <td class="from" attr="cp_propertyname">&nbsp;</td>
                <td><input type="checkbox" name="cp_propertyname" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_propertyname">&nbsp;</td>
            </tr>
            <tr>
                <td>开发商：</td>
                <td class="from" attr="cp_developer">&nbsp;</td>
                <td><input type="checkbox" name="cp_developer" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_developer">&nbsp;</td>
            </tr>
            <tr>
                <td>物业管理费：</td>
                <td class="from" attr="cp_propertyprice">&nbsp;</td>
                <td><input type="checkbox" name="cp_propertyprice" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_propertyprice">&nbsp;</td>
            </tr>
            <tr>
                <td>建筑总面积：</td>
                <td class="from" attr="cp_area">&nbsp;</td>
                <td><input type="checkbox" name="cp_area" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_area">&nbsp;</td>
            </tr>
            <tr>
                <td>分割面积：</td>
                <td class="from" attr="cp_fengearea">&nbsp;</td>
                <td><input type="checkbox" name="cp_fengearea" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_fengearea">&nbsp;</td>
            </tr>
            <tr>
                <td>层高：</td>
                <td class="from" attr="cp_floorheight">&nbsp;</td>
                <td><input type="checkbox" name="cp_floorheight" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_floorheight">&nbsp;</td>
            </tr>
            <tr>
                <td>平均租金：</td>
                <td class="from" attr="cp_avgrentprice">&nbsp;</td>
                <td><input type="checkbox" name="cp_avgrentprice" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_avgrentprice">&nbsp;</td>
            </tr>
            <tr>
                <td>x坐标：</td>
                <td class="from" attr="cp_x">&nbsp;</td>
                <td><input type="checkbox" name="cp_x" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_x">&nbsp;</td>
            </tr>
            <tr>
                <td>y坐标：</td>
                <td class="from" attr="cp_y">&nbsp;</td>
                <td><input type="checkbox" name="cp_y" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_y">&nbsp;</td>
            </tr>
            <tr>
                <td>园区形态：</td>
                <td class="from" attr="cp_form">&nbsp;</td>
                <td><input type="checkbox" name="cp_form" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_form">&nbsp;</td>
            </tr>
            
            <tr>
                <td>周边配套：</td>
                <td class="from" attr="cp_peripheral">&nbsp;</td>
                <td><input type="checkbox" name="cp_peripheral" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_peripheral">&nbsp;</td>
            </tr>         
            <tr>
                <td>车位配置：</td>
                <td class="from" attr="cp_carport">&nbsp;</td>
                <td><input type="checkbox" name="cp_carport" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_carport">&nbsp;</td>
            </tr>
            <tr>
                <td>园内配套：</td>
                <td class="from" attr="cp_roommating">&nbsp;</td>
                <td><input type="checkbox" name="cp_roommating" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_roommating">&nbsp;</td>
            </tr>
            <tr>
                <td>物业服务：</td>
                <td class="from" attr="cp_propertyserver">&nbsp;</td>
                <td><input type="checkbox" name="cp_propertyserver" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_propertyserver">&nbsp;</td>
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
        var fromid = $("#fromcreativeparkid").val();
        var toid = $("#tocreativeparkid").val();
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
    function creativeparkSearchFrom(){
        var creativeparkIdFrom = $.trim($("#creativepark_from").val());
        $.ajax({
            url:"/Creativeparkbaseinfo/getcreativeparkbaseinfo",
            data:{"id":creativeparkIdFrom},
            type:"GET",
            success:function(msg){                
                if(msg!="error"){
                   var msg = eval("("+msg+")");                  
                   $("#fromcreativeparkid").val(msg["cp_id"]);                  
                    $("#form_table td[class='from']").each(function(){
                        var key = $(this).attr("attr");
                        console.log(msg[key]);
                        $(this).html(msg[key]);
                    }) 
                }else{
                    alert("创意园不存在")
                };
            }
        })
    }
    function creativeparkSearchTo(){
        var creativeparkIdTo = $.trim($("#creativepark_to").val());
       
        $.ajax({
            url:"/Creativeparkbaseinfo/getcreativeparkbaseinfo",
            data:{"id":creativeparkIdTo},
            type:"GET",
            success:function(msg){
                if(msg!="error"){
                    var msg = eval("("+msg+")");                    
                   $("#tocreativeparkid").val(msg["cp_id"]);                   
                    $("#form_table td[class='to']").each(function(){
                        var key = $(this).attr("attr");
                        $(this).html(msg[key]);
                    }); 
                }else{
                    alert("创意园不存在")
                };
            }
        })
    }
</script>