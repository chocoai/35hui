<?php
$this->breadcrumbs=array(
        '完善与纠错',
);
?>
<script  src="/js/dateinput/dateinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="/js/dateinput/dateinput.css"/>
<style type="text/css">
.error{background: #FFF2E9 url(/images/icon/onError.gif) no-repeat 0px -4px;padding-left: 25px;}
.success{background: url(/images/icon/onValid.gif) no-repeat 0px -4px;padding-left: 25px;}
</style>
<?php if(Yii::app()->user->hasFlash('showMessage')){ ?>
<div style="width:100%;padding: 10px 0px 10px;background-color: #D8E5EB;color: red;margin-bottom: 10px">
    <font style="margin-left:20px"><?php echo Yii::app()->user->getFlash('showMessage'); ?></font>
</div>
<?php }else{ ?>
<div class="msg">
    <?php $config = Oprationconfig::model()->getConfigByName("correction_give");?>
            1、成功纠错将奖励大量积分。奖励方式按字段来算，每纠错成功一个字段，<font color="red">奖励<?=$config[0];?>积分</font>。<br />
            2、上传的图片请尽量上传不大于4M并且清晰的图片，图片最小规格为150px*100px。
</div>
<?php } ?>
<div class="htit">完善纠错</div>
<div class="rgcont">
    <form action="#" id="topForm" onsubmit="return topSubmit();">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td width="16%" class="tit"><em>*</em> 楼盘类型：</td>
            <td width="84%" class="txtlou">
                <input type="radio" name="sourcetype" id="sourcetype_1" value="1" <?=$type==1?"checked":""?> onChange="changeType()"><label for="sourcetype_1">楼盘</label>
                <input type="radio" name="sourcetype" id="sourcetype_3" value="5" <?=$type==5?"checked":""?> onChange="changeType()"><label for="sourcetype_5">创意园</label>
                <?//功能完好暂挺使用入口
                /*?><input type="radio" name="sourcetype" id="sourcetype_2" value="3" <?=$type==3?"checked":""?> onChange="changeType()"><label for="sourcetype_3">小区</label><?*/?>
            </td>
        </tr>
        <tr>
            <td class="tit"><em>*</em> 楼盘名称：</td>
            <td class="txtlou">
                <?php $this->widget('CAutoComplete',
                        array(
                        'name'=>'kwords',
                        'url'=>array('/site/ajaxautocomplete'),
                        'max'=>10,//显示最大数
                        'minChars'=>1,//最小输入多少开始匹配
                        'delay'=>500, //两次按键间隔小于此值，则启动等待
                        'scrollHeight'=>200,
                        "extraParams"=>array("type"=>"js:AutoCompleteExtraParam"),//表示是楼盘、商业广场还是小区
                        'htmlOptions'=>array('size'=>'30','class'=>'txt_02'),
                ));
                ?>
                <input type="button" value="检验输入" onclick="checkTopInput()" class="btn_01" /><span id="checkNameMessage"></span>
            </td>
        </tr>
    </table>
    </form>
    <form action="/manage/correction/create" id="buildform" style="display:none" method="post">
        <input type="hidden" name="sourcetype" value="1"/>
        <input type="hidden" name="picture" />
        <?php $this->renderPartial("_buildform",array("districtlist"=>$districtlist));?>
    </form>
    <?//功能完好暂挺使用入口
                /*?>
    <form action="/manage/correction/create" id="xiaoquform" style="display:none" method="post" >
        <input type="hidden" name="sourcetype" value="2"/>
        <input type="hidden" name="picture" />
        <?php $this->renderPartial("_xiaoquform",array("districtlist"=>$districtlist));?>
    </form>
    <?*/?>
    <form action="/manage/correction/create" id="creativeparkform" style="display:none" method="post">
        <input type="hidden" name="sourcetype" value="3"/>
        <input type="hidden" name="picture" />
        <?php $this->renderPartial("_creativeparkform",array("districtlist"=>$districtlist));?>
    </form>
    
    <table border="0" cellpadding="0" cellspacing="0" class="table_01" id="pictable" style="display:none">
        
        <tr>
            <td width="16%" class="tit"><em>*</em> 添加图片：</td>
            <td width="84%" class="txtlou"><span style="color:#A90000">请提供合适的平面图、外景图或者楼盘周边配套图</span><?php $this->renderPartial("_picform");?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="txtlou">
                <input class="manage_input_buttonlong" type="button" onclick="submitCorrection()" value="提交纠错信息"/>
                <input class="manage_input_button" type="button" onclick="unSubmit()" value="取消"/>
            </td>
        </tr>
    </table>
</div>
<div class="intit"><strong>纠错历史</strong></div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="6%" class="tit"></td>
            <td width="21%" class="tit">楼盘名称</td>
            <td width="42%" class="tit">处理结果</td>
            <td width="10%" class="tit">状态</td>
            <td width="21%" class="tit">日期</td>
        </tr>
        <?php
            foreach($dataProvider->getData() as $index=>$data){
                $this->renderPartial('_list', array(
                    'data'=>$data,
                    'index'=>$index,
                    )
                );
            }
            ?>
    </table>
</div>
<div class="jefenpage">
	<?php
        $this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
        "htmlOptions"=>array("style"=>"float:right"),
        ));
    ?>
</div>

<script type="text/javascript">
function AutoCompleteExtraParam(){
    var sourcetype = $("#topForm input:checked").val();
    
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
       url:"/manage/correction/validatebuildname",
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
               }else if(sourcetype==3){
                   setXiaoquValue(value);
               }else if(sourcetype==5){
                   setCreativeparkValue(value);
               }else{
                   
               }
               $("#pictable").css("display","");
               resetFrameHeight();
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
   resetFrameHeight();
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
    }else if(sourcetype==3){
        $("#xiaoquform :input[name='picture']").val(pictures);
        $("#xiaoquform").submit();
    }else if(sourcetype==5){
        $("#creativeparkform :input[name='picture']").val(pictures);
        if($("#creativeparkform :input[name='creativeparkid']").val()==""){
            $("#checkNameMessage").attr("class","error");
            $("#checkNameMessage").html("请检查输入！");
        }else{
            $("#creativeparkform").submit();
        }
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
