<?php
$this->currentMenu = 20;
$this->breadcrumbs=array(
        '商务中心'=>array('index'),
        "合并商务中心",
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
替换包括商务中心全景、商务中心图片
<form method="post" action="" onsubmit="return validateForm()">
    <div style="width:100%;" class="oneDiv">
        <table width="100%" id="form_table">
            <tr >
                <td colspan="3">
                    <b>待删除ID：</b>
                    <input type="text" id="businesscenter_from" style="width:80px"/>
                    <input type="hidden" name="frombusinesscenterid" id="frombusinesscenterid" />
                    <input type="button" value="确定" onclick="businesscenterSearchFrom()" />
                </td>
                <td class="fenge" width="2px">&nbsp;</td>
                <td>
                    <b>合并至ID：</b>
                    <input type="text" id="businesscenter_to" style="width:80px"/>
                    <input type="hidden" name="tobusinesscenterid" id="tobusinesscenterid" />
                    <input type="button" value="确定" onclick="businesscenterSearchTo()" />
                </td>
            </tr>
            <tr>
                <td width="80px">ID：</td>
                <td class="from" attr="bc_id" width="250px">&nbsp;</td>
                <td width="10px">&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_id">&nbsp;</td>
            </tr>
            <tr>
                <td>名称：</td>
                <td class="from" attr="bc_name">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_name">&nbsp;</td>
            </tr>
            <tr>
                <td>英文名字：</td>
                <td class="from" attr="bc_englishname">&nbsp;</td>
                <td><input type="checkbox" name="bc_englishname" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_englishname">&nbsp;</td>
            </tr>
            <tr>
                <td>交通：</td>
                <td class="from" attr="bc_traffic">&nbsp;</td>
                <td><input type="checkbox" name="bc_traffic" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_traffic">&nbsp;</td>
            </tr>
            <tr>
                <td>免费服务：</td>
                <td class="from" attr="bc_freeserver">&nbsp;</td>
                <td><input type="checkbox" name="bc_freeserver" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_freeserver">&nbsp;</td>
            </tr>
            <tr>
                <td>付费服务：</td>
                <td class="from" attr="bc_payserver">&nbsp;</td>
                <td><input type="checkbox" name="bc_payserver" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_payserver">&nbsp;</td>
            </tr>
            <tr>
                <td>简介：</td>
                <td class="from" attr="bc_introduce">&nbsp;</td>
                <td><input type="checkbox" name="bc_introduce" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_introduce">&nbsp;</td>
            </tr>
            <tr>
                <td>地址：</td>
                <td class="from" attr="bc_address">&nbsp;</td>
                <td><input type="checkbox" name="bc_address" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_address">&nbsp;</td>
            </tr>
            <tr>
                <td>开盘时间：</td>
                <td class="from" attr="bc_completetime">&nbsp;</td>
                <td><input type="checkbox" name="bc_completetime" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_completetime">&nbsp;</td>
            </tr>
            <tr>
                <td>装修风格：</td>
                <td class="from" attr="bc_decoratestyle">&nbsp;</td>
                <td><input type="checkbox" name="bc_decoratestyle" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_decoratestyle">&nbsp;</td>
            </tr>
            <tr>
                <td>服务品牌：</td>
                <td class="from" attr="bc_serverbrand">&nbsp;</td>
                <td><input type="checkbox" name="bc_serverbrand" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_serverbrand">&nbsp;</td>
            </tr>
            <tr>
                <td>服务语种：</td>
                <td class="from" attr="bc_serverlanguage">&nbsp;</td>
                <td><input type="checkbox" name="bc_serverlanguage" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_serverlanguage">&nbsp;</td>
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
                <td>楼层：</td>
                <td class="from" attr="bc_floor">&nbsp;</td>
                <td><input type="checkbox" name="bc_floor" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_floor">&nbsp;</td>
            </tr>
            <tr>
                <td>租金：</td>
                <td class="from" attr="bc_rentprice">&nbsp;</td>
                <td><input type="checkbox" name="bc_rentprice" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_rentprice">&nbsp;</td>
            </tr>
            <tr>
                <td>x坐标：</td>
                <td class="from" attr="cp_x">&nbsp;</td>
                <td><input type="checkbox" name="cp_x" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="cp_x">&nbsp;</td>
            </tr>
            <tr>
                <td>标题图：</td>
                <td class="from" attr="bc_titlepic">&nbsp;</td>
                <td><input type="checkbox" name="bc_titlepic" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_titlepic">&nbsp;</td>
            </tr>
            <tr>
                <td>联系电话：</td>
                <td class="from" attr="bc_connecttel">&nbsp;</td>
                <td><input type="checkbox" name="bc_connecttel" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_connecttel">&nbsp;</td>
            </tr>
            
            <tr>
                <td>周边商业配套：</td>
                <td class="from" attr="bc_peripheral">&nbsp;</td>
                <td><input type="checkbox" name="bc_peripheral" />&nbsp;</td>
                <td class="fenge">&nbsp;</td>
                <td class="to" attr="bc_peripheral">&nbsp;</td>
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
        var fromid = $("#frombusinesscenterid").val();
        var toid = $("#tobusinesscenterid").val();
        if(fromid==""||toid==""){
            alert("请输入商务中心id");
            return false;
        }else if(fromid==toid){
            alert("不能使用两个相同的id");
            return false;
        }else{
            var info = $("form").serialize();
            var arr = info.split("&");
            if(arr.length==2){
                if(!confirm("确定不使用任何原商务中心的字段吗？")){
                    return false;
                }
            }
        }
        return true;
    }
    function businesscenterSearchFrom(){
       
        var businesscenterIdFrom = $.trim($("#businesscenter_from").val());
      
        $.ajax({
            url:"/businesscenter/getbusinesscenter",
            data:{"id":businesscenterIdFrom},
            type:"GET",
            success:function(msg){                
                if(msg!="error"){
                   var msg = eval("("+msg+")");                  
                  $("#frombusinesscenterid").val(msg["bc_id"]);
                    $("#form_table td[class='from']").each(function(){
                        var key = $(this).attr("attr");
                        console.log(msg[key]);
                        $(this).html(msg[key]);
                    })   
                }else{
                    alert("商务中心不存在")
                };
            }
        })
    }
    function businesscenterSearchTo(){
        var businesscenterIdTo = $.trim($("#businesscenter_to").val());
       
        $.ajax({
            url:"/businesscenter/getbusinesscenter",
            data:{"id":businesscenterIdTo},
            type:"GET",
            success:function(msg){
                if(msg!="error"){
                    var msg = eval("("+msg+")");                    
                    $("#tobusinesscenterid").val(msg["bc_id"]);
                    $("#form_table td[class='to']").each(function(){
                        var key = $(this).attr("attr");
                        $(this).html(msg[key]);
                    }); 
                }else{
                    alert("商务中心不存在")
                };
            }
        })
    }
</script>