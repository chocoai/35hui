<?php
$this->breadcrumbs=array(
        "我的新地标"=>array('/site/userindex'),
        '关键词推广',
);
?>
<style type="text/css">
.error{
    background: #FFF2E9 url(/images/icon/onError.gif) no-repeat 0 -4px;
    white-space: nowrap;
    padding-left: 25px;
}
.success{
    background: url(/images/icon/onValid.gif) no-repeat 0 -4px;
    white-space: nowrap;
    padding-left: 25px;
}
</style>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">
        <div style="float:left;width: 500px">关键词推广</div>
        <div style="float:right;font-weight: normal;font-size: 12px;margin-right: 10px ">
            <img src="/images/default/hint.gif" alt="">
            <?=CHtml::link("什么是关键词推广？",array("help/kwdrecommend"),array("style"=>"color:blue","target"=>"_blank"));?>
            <a style="color:blue" href="#"></a>
        </div>
    </div>
    <div class="manage_rightboxthree" style="padding-bottom:10px;padding-left: 20px">
        <form action="" method="post" id="createForm" onSubmit="return checkForm()">
            <div style="width:100%">
                <?php echo CHtml::dropDownList("buildtype","",Kwdrecommend::$kwr_buildtype,array("onChange"=>"changeType()"));?>
                <?php echo CHtml::dropDownList("sellorrent","1",Kwdrecommend::$kwr_sellorrent,array("separator"=>"&nbsp;"));?>
                <?php $this->widget('CAutoComplete',
                        array(
                        'name'=>'kwords',
                        'url'=>array('site/ajaxautocomplete'),
                        'max'=>10,//显示最大数
                        'minChars'=>1,//最小输入多少开始匹配
                        'delay'=>500, //两次按键间隔小于此值，则启动等待
                        'scrollHeight'=>200,
                        "extraParams"=>array("type"=>"js:AutoCompleteExtraParam"),//表示是楼盘、商业广场还是小区
                        'htmlOptions'=>array('size'=>'30',"onblur"=>"checkCanBuy()"),
                        "methodChain"=>".result(function(event,item){\$(\"#selectString\").val(item)})",
                ));
                ?>
                <span id="errormsg" class="" canBuy="0" >请输入大厦名称作为推广的关键词，否则系统将不予接受！</span>
                
                <input type="hidden" name="selectString" id="selectString" />
            </div>
                <div style="margin-left:480px;margin-top: 10px;clear:both">
                    <div style="float:left">
                        <input type="image" src="/images/by.png" />
                    </div>
                    <div style="float:left;padding-left:5px;padding-top: 2px">
                        <select name="buytime" style="margin:0px;padding:0px" onchange="changemoney(this)">
                            <?php
                                for($i=1;$i<=Kwdrecommend::$maxBuyDay;$i++){
                                    echo '<option value="'.$i.'">'.$i.'天</option>';
                                }
                            ?>
                        </select>
                        <span>
                            需<font color="red" id="tmpCountMoney"><?=$onDayMoney?></font>新币
                        </span>
                    </div>
                </div>
        </form>
        <div style="clear:both"></div>
    </div>
    <div class="manage_righttwoline"></div>
</div>

<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">已购买的关键词</div>
    <div class="manage_rightboxthree" style="padding-bottom:10px;">
        <span style="float:right;font-weight: normal;font-size: 12px;margin-right: 10px;margin-bottom: 10px">
            <?=CHtml::link("查看历史购买记录",array("kwdrecommend/historylist"),array("style"=>"color:blue"));?>
        </span>
        <div class="manage_rightthreeine" style="clear:both"></div>
        <div class="manage_rightfoutbox">
            <table class="manage_tabletwo" cellspacing="1" cellpadding="1" >
                <tr>
                    <th>关键词</th>
                    <th>购买时间</th>
                    <th>过期时间</th>
                    <th>房源</th>
                </tr>
                <?php
                    if($allKwdRecommend){
                        foreach($allKwdRecommend as $value){
                ?>
                <tr>
                    <td>
                        <?=CHtml::link($value->kwr_name, Kwdrecommend::model()->getShowUrl($value->kwr_name, $value->kwr_buildtype, $value->kwr_sellorrent),array("target"=>"_blank","style"=>"color:blue"))?>
                        <?="(".Kwdrecommend::model()->getSellOrRent($value->kwr_sellorrent)."、".Kwdrecommend::model()->getBuildType($value->kwr_buildtype).")"?>
                    </td>
                    <td><?=date("Y-m-d H:s",$value->kwr_buytime);?></td>
                    <td><?=date("Y-m-d H:s",$value->kwr_expiredtime);?></td>
                    <td>
                    <?php
                    if($value->kwr_sourceid){
                        echo CHtml::link("修改","#",array("onClick"=>"openTip(".$value->kwr_id.")","style"=>"color:blue"))."&nbsp;&nbsp;";
                        echo CHtml::link("查看",array("/kwdrecommend/viewsource","id"=>$value->kwr_id),array("target"=>"_blank","style"=>"color:blue"));
                    }else{
                        echo '<font style="color:red">未设置房源</font>&nbsp;'.CHtml::link("设置","#",array("onClick"=>"openTip(".$value->kwr_id.")","style"=>"color:blue"));
                    }
                    ?>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>
        <div class="manage_rightfourine"></div>
    </div>
    <div class="manage_righttwoline"></div>
</div>
<div id="newDiv" style="display:none;position: fixed;width: 640px;height: 570px;padding: 2px;background-color:white; ">
    <iframe width="640px" height="570px" frameborder="0" scrolling="no" src=""></iframe>
</div>
<script type="text/javascript">
    function AutoCompleteExtraParam(){
        var sellorrent = $("#buildtype").val();
        return sellorrent;
    }
    function checkCanBuy(){
        $("#errormsg").attr("canBuy",0);
        var kwords = $("#kwords").val();
        if(kwords==""){
            error("请输入大厦名称作为推广的关键词，否则系统将不予接受！");return ;
        }
        var select = $("#selectString").val();
        if(select==""){
            error("您输入的关键词不存在！");return ;
        }
        var select_kword = select.split(",")[0];
        if(select_kword!=kwords){
            error("您输入的关键词不存在！");return ;
        }
        
        $.ajax({
           url:"/kwdrecommend/validatecanbuy",
           type:"POST",
           data:$("#createForm").serialize(),
           success:function(msg){
               var ret = msg.split("_");
               if(ret[0]=="error"){
                   var str = "";
                   if(ret[1]!=undefined){
                       str = "此关键词已被购买<?=Kwdrecommend::$oneKwdCanByuNum;?>次，请等待<font color='red'>"+ret[1]+"</font>之后再继续购买！";
                   }else{
                       str = "此关键词已被购买<?=Kwdrecommend::$oneKwdCanByuNum;?>次，不能继续购买！";
                   }
                   error(str);return ;
               }else{
                   $("#errormsg").attr("canBuy",1);
                   success("此关键词已有"+msg+"人购买！");
               }
           }
        });
    }
    function changemoney(obj){
        var onDayMoney = <?=$onDayMoney?>;
        var value = $(obj).val();
        $("#tmpCountMoney").html(onDayMoney*value)
    }
    function error(msg){
        $("#errormsg").attr("class", "error")
        $("#errormsg").html(msg);
    }
    function success(msg){
        $("#errormsg").attr("class", "success")
        $("#errormsg").html(msg);
    }
    function checkForm(){
        if($("#kwords").val()==""){
            return false;
        }
        if($("#errormsg").attr("canBuy")=="0"){
            return false;
        }
        var money = $("#tmpCountMoney").html();
        if(confirm("确定要花费"+money+"新币来购买此关键词推广吗？")){
            return true;
        }
        return false;
    }
    function changeType(){
        error("请输入关键词！")
        $('#kwords').val('');
    }
</script>

<?php if(Yii::app()->user->hasFlash('message')): ?>
<script type="text/javascript">
    alert("<?php echo Yii::app()->user->getFlash('message'); ?>");
</script>
<?php endif; ?>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/overlay.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/toolbox.expose.min.js"></script>
<script type="text/javascript">
$("#newDiv").overlay({
    top:'center',
    mask: {
		color: '#111111',
		loadSpeed: 200,
		opacity: 0.5
	},
    closeOnClick: false
});
function openTip(id){
    $("#newDiv").children("iframe").attr("src","/kwdrecommend/choosesource/id/"+id);
    $("#newDiv").overlay().load();
}
function closetip(){
    $("#newDiv").overlay().close();
}
</script>