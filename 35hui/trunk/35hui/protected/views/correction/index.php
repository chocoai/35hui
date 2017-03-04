<?php
$this->breadcrumbs=array(
        "我的新地标"=>array('/site/userindex'),
        '完善与纠错',
);
?>
<script  src="/js/dateinput/dateinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="/js/dateinput/dateinput.css"/>
<style type="text/css">
.error{background: #FFF2E9 url(/images/icon/onError.gif) no-repeat 0px -4px;padding-left: 25px;}
.success{background: url(/images/icon/onValid.gif) no-repeat 0px -4px;padding-left: 25px;}
</style>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">
        <div style="float:left;width: 500px">完善与纠错</div>
    </div>
    <div class="manage_rightboxthree" style="padding-bottom:10px;">
        <div class="manage_rightthreeine"></div>
        <div class="manage_rightfoutbox" style="padding: 5px 0px 10px 15px">
            <?php $config = Oprationconfig::model()->getConfigByName("correction_give");?>
            1、成功纠错将奖励大量积分和新币。奖励方式按字段来算，每纠错成功一个字段，<font color="red">奖励<?=$config[0];?>积分和<?=$config[1];?>新币</font>。<br />
            2、上传的图片请尽量上传不大于4M并且清晰的图片，图片最小规格为150px*100px。
        </div>
        <div class="manage_rightfourine"></div>
        <br />
        <?php if(Yii::app()->user->hasFlash('showMessage')): ?>
        <div style="width:100%;padding: 10px 0px 10px;background-color: #D8E5EB;color: red;margin-bottom: 10px">
            <font style="margin-left:20px"><?php echo Yii::app()->user->getFlash('showMessage'); ?></font>
        </div>
        <?php endif; ?>
        <form action="#" id="topForm" onsubmit="return topSubmit();">
            <input type="radio" name="sourcetype" id="sourcetype_1" value="1" <?=$type==1?"checked":""?> onChange="changeType()"><label for="sourcetype_1">楼盘</label>
            <input type="radio" name="sourcetype" id="sourcetype_2" value="2" <?=$type==2?"checked":""?> onChange="changeType()"><label for="sourcetype_2">小区</label>

            <div style="width:100%;margin-top: 5px">
                <span class="buildName">楼盘名称：</span>
                <?php $this->widget('CAutoComplete',
                        array(
                        'name'=>'kwords',
                        'url'=>array('site/ajaxautocomplete'),
                        'max'=>10,//显示最大数
                        'minChars'=>1,//最小输入多少开始匹配
                        'delay'=>500, //两次按键间隔小于此值，则启动等待
                        'scrollHeight'=>200,
                        "extraParams"=>array("type"=>"js:AutoCompleteExtraParam"),//表示是楼盘、商业广场还是小区
                        'htmlOptions'=>array('size'=>'30'),
                ));
                ?>
                <input type="button" value="检验输入" onclick="checkTopInput()" /><span id="checkNameMessage"></span>
            </div>
        </form>
        <div id="correctionForm">
            <div class="manage_rightthreeine"></div>
            <div class="manage_rightfoutbox" style="padding: 0px 8px 0px">
                <form action="/correction/create" id="buildform" style="display:none" method="post">
                    <input type="hidden" name="sourcetype" value="1"/>
                    <input type="hidden" name="picture" />
                    <?php $this->renderPartial("_buildform",array("districtlist"=>$districtlist));?>
                </form>
                <form action="/correction/create" id="xiaoquform" style="display:none" method="post" >
                    <input type="hidden" name="sourcetype" value="2"/>
                    <input type="hidden" name="picture" />
                    <?php $this->renderPartial("_xiaoquform",array("districtlist"=>$districtlist));?>
                </form>
                <table id="pictable" width="100%" style="margin-bottom:10px;display:none">
                    <tr>
                        <td width="100px" align="right">添加图片 ：</td>
                        <td colspan="2">
                            <?php $this->renderPartial("_picform");?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center" ><input class="manage_input_buttonlong" type="button" onclick="submitCorrection()" value="提交纠错信息"/></td>
                        <td><input class="manage_input_button" type="button" onclick="unSubmit()" value="取消"/></td>
                    </tr>
                </table>
            </div>
            <div class="manage_rightfourine"></div>
        </div>

        <div style="background-color:#D8E5EB; clear: both;padding:5px 5px">我的纠错记录</div>
        
        <div class="manage_rightthreeine"></div>
        <div class="manage_rightfoutbox" style="padding: 0px 8px 20px 10px">
            <?php
                $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_list',
                "viewData"=>array("itemCount"=>20,"page"=>isset($_GET["page"])?$_GET["page"]:"1")
            )); ?>
        </div>
        <div class="manage_rightfourine"></div>

    </div>
    <div class="manage_righttwoline"></div>
</div>
<script type="text/javascript">
function AutoCompleteExtraParam(){
    var sourcetype = $("#topForm input:checked").val();
    sourcetype==2?sourcetype=3:"";
    return sourcetype;
}
function topSubmit(){
    checkTopInput();
    return false;
}
function checkTopInput(){
    if($("#kwords").val()==""){
        $("#checkNameMessage").attr("class","error");
        $("#checkNameMessage").html("名称不能为空");
        return ;
    }
    var sourcetype = $("#topForm input:checked").val();
    $("#checkTopInputBtn").css("display","none")
    $("#checkNameMessage").html("<img src='/images/loading.gif' height='15px' style='padding-top:2px'/>");
    $.ajax({
       url:"/correction/validatebuildname",
       type:"POST",
       data:$("#topForm").serialize(),
       success:function(msg){
           var msg = msg.split("_@_");
           if(msg[0]=="success"){
               $("#checkNameMessage").attr("class","success");
               $("#checkNameMessage").html("");
               $("#buildform").css("display","none");
               $("#xiaoquform").css("display","none");
               var value = eval("("+msg[1]+")");
               if(sourcetype==1){
                   setBuildValue(value);
               }else{
                   setXiaoquValue(value);
               }
               $("#pictable").css("display","");
           }else{
               $("#checkNameMessage").attr("class","error");
               $("#checkNameMessage").html(msg[1]);
           }
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
function changeType(){
    var sourcetype = $("#topForm input:checked").val();
    var name = sourcetype==1?"楼盘名称：":"小区名称：";
    $("#topForm .buildName").html(name);
    $("#checkNameMessage").html("");
    $("#checkNameMessage").attr("class","");
    if($("#pictable").css("display")!="none"){
        $("#buildform").css("display","none");
        $("#xiaoquform").css("display","none")
        $("#kwords").val("");
        var array = new Array();
        sourcetype==1?setBuildValue(array):setXiaoquValue(array);
    }
   
}
function submitCorrection(){
    var sourcetype = $("#topForm input:checked").val();
    var pictures = "";
    for(var i=0;i<$("#allPics").children().length;i++){
        var url = $("#allPics").children().eq(i).attr("attr");
        var type = $("#allPics").children().eq(i).find("select").val();
        pictures += "|"+url+"_"+type;
    }
    if(sourcetype==1){
        $("#buildform :input[name='picture']").val(pictures);
        if($("#buildform :input[name='buildingid']").val()==""){
            $("#checkNameMessage").attr("class","error");
            $("#checkNameMessage").html("请检查输入！");
        }else{
            $("#buildform").submit();
        }
    }else{
        $("#xiaoquform :input[name='picture']").val(pictures);
        $("#xiaoquform").submit();
    }
}
function unSubmit(){
    $("#pictable").css("display","none");
    $("#xiaoquform").css("display","none");
    $("#buildform").css("display","none");
    $("#kwords").val("");
    $("#checkNameMessage").html("");
    $("#checkNameMessage").attr("class","");
}
$.tools.dateinput.localize("fr",  {
    months:        '一月,二月,三月,四月,五月,六月,七月,八月,' +
                    '九月,十月,十一月,十二月',
    shortMonths:   '一月,二月,三月,四月,五月,六月,七月,八月,九月,十月,十一月,十二月',
    days:          '星期日,星期一,星期二,星期三,星期四,星期五,星期六',
    shortDays:     '周日,周一,周二,周三,周四,周五,周六'
});
$(":date").dateinput({
    selectors: true,
    lang: 'fr',
	format: 'yyyy-mm-dd',
    yearRange: [-30,30]
});
$(document).ready(function(){
    $("#kwords").val('<?=$name?>');
    <?php
    if($name!=""){
    ?>
    checkTopInput();
    <?php
    }
    ?>
});
</script>
