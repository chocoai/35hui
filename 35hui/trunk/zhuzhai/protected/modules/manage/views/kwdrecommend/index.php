<?php
$this->breadcrumbs=array(
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
<div class="msg">
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;关键词推广是新地标网全新推出的增值服务功能，当用户输入了关键词搜索后，关键词推广房源能够显示在列表的最前面，让用户能够更快的定位到您的房源！本服务实行按天计费规则。过期时间统一为“购买时间+购买天数”的晚上12点。即如果购买了一天的推广时间，则过期时间为第二天晚上12点。</p>
</div>

<div class="htit">关键词推广</div>
<div class="rgcont">
    <form action="" method="post" id="createForm" onSubmit="return checkForm()">
        <table border="0" cellpadding="0" cellspacing="0" class="table_01">
            <tr>
                <td width="16%" class="tit"><em>*</em> 选择楼盘名称：</td>
                <td width="84%" class="txtlou">
                    <?php echo CHtml::dropDownList("buildtype",Yii::app()->user->getState("mainbusiness"),Kwdrecommend::$kwr_buildtype,array("onChange"=>"changeType()","class"=>"slet_01 sslect"));?>
                    <?php echo CHtml::dropDownList("sellorrent","1",Kwdrecommend::$kwr_sellorrent,array("separator"=>"&nbsp;","class"=>"slet_01 sslect"));?>
                    <?php $this->widget('CAutoComplete',
                            array(
                            'name'=>'kwords',
                            'url'=>array('/site/ajaxautocomplete'),
                            'max'=>10,//显示最大数
                            'minChars'=>1,//最小输入多少开始匹配
                            'delay'=>500, //两次按键间隔小于此值，则启动等待
                            'scrollHeight'=>200,
                            "extraParams"=>array("type"=>"js:AutoCompleteExtraParam"),//表示是楼盘、商业广场还是小区
                            'htmlOptions'=>array('class'=>'txt_02',"onblur"=>"checkCanBuy()"),
                            "methodChain"=>".result(function(event,item){\$(\"#selectString\").val(item)})",
                    ));
                    ?>
                    <span id="errormsg" class="" canBuy="0"style="color:#808080;" >(只能以楼盘名称为关键字，否则无效)</span>
                    <input type="hidden" name="selectString" id="selectString" />
                </td>
            </tr>
            <tr>
                <td width="16%" class="tit"><em>*</em> 推广时间：</td>
                <td width="84%" class="txtlou">
                    <select name="buytime" class="slet_01 sslect" onchange="changemoney(this)">
                        <?php
                        for($i=1;$i<=Kwdrecommend::$maxBuyDay;$i++){
                            echo '<option value="'.$i.'">'.$i.'天</option>';
                        }
                        ?>
                    </select>
                    需<font color="red" id="tmpCountMoney"><?=$onDayMoney?></font>新币
                </td>
            </tr>
            <tr>
                <td width="16%">&nbsp;</td>
                <td width="84%" class="txtlou"><input type="submit" value="购买" style="width:100px;" /></td>
            </tr>
        </table>
    </form>
</div>
<div class="intit">
    <strong>已购买</strong>
    <span style="float:right;">
        <a  href="/manage/kwdrecommend/historylist">查看历史购买记录</a>
    </span>
</div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="36%" class="tit">关键词</td>
            <td width="24%" class="tit">购买时间</td>
            <td width="20%" class="tit">过期时间</td>
            <td width="20%" class="tit">房源</td>
        </tr>
        <?php
        if($allKwdRecommend){
            foreach($allKwdRecommend as $value){
                ?>
        <tr>
            <td class="txt">
                        <?=CHtml::link($value->kwr_name, Kwdrecommend::model()->getShowUrl($value->kwr_name, $value->kwr_buildtype, $value->kwr_sellorrent),array("target"=>"_blank"))?>
                        <?="(".Kwdrecommend::model()->getSellOrRent($value->kwr_sellorrent)."、".Kwdrecommend::model()->getBuildType($value->kwr_buildtype).")"?>
            </td>
            <td class="txt"><?=date("Y-m-d H:s",$value->kwr_buytime);?></td>
            <td class="txt"><?=date("Y-m-d H:s",$value->kwr_expiredtime);?></td>
            <td class="txt">
                        <?php
                        if($value->kwr_sourceid){
                            echo CHtml::link("修改","#",array("onClick"=>"openTip(".$value->kwr_id.")"))."&nbsp;&nbsp;";
                            echo CHtml::link("查看",array("/manage/kwdrecommend/viewsource","id"=>$value->kwr_id),array("target"=>"_blank"));
                        }else{
                            echo '<em>未设置房源</em>&nbsp;'.CHtml::link("设置","#",array("onClick"=>"openTip(".$value->kwr_id.")"));
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

<script type="text/javascript">
    function openTip(id){
        var url = "/manage/kwdrecommend/choosesource/id/"+id;
        var width = "650px";
        var height = "620px";
        parent.window.openTip(url,width,height);
    }
</script>
<script type="text/javascript">
    function AutoCompleteExtraParam(){
        var sellorrent = $("#buildtype").val();
        return sellorrent;
    }
    function checkCanBuy(){
        $("#errormsg").attr("canBuy",0);
        var kwords = $("#kwords").val();
        if(kwords==""){
            error("(只能以楼盘名称为关键字，否则无效)");return ;
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
            url:"/manage/kwdrecommend/validatecanbuy",
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
            alert("请输入楼盘名称！")
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