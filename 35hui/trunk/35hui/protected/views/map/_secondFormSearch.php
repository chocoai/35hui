<?php
$type = 1;
isset($_GET['tab'])&&$_GET['tab']=="shop"?$type = 2:"";
$allType = array(1=>"写字楼",2=>"商铺",4=>"住宅")
?>
<div id="SourceType" class="style" style="display:none" onmouseover="listshow(this);" onmouseout="listhidden(this);" attr="<?=$type?>">
    <span id="priceTitle"><?=$allType[$type]?></span>
    <dl style="left: 330px;" class="pull-down hidden" >
        <?php
        foreach($allType as $key=>$value){
        ?>
        <dd><span onClick="changeSourceType(this)" attr="<?=$key?>"><?=$value?></span></dd>
        <?php
        }
        ?>
    </dl>
</div>

<div id="SourceArea" class="area" onmouseover="listshow(this);" onmouseout="listhidden(this);"  attr="0-0">
    <span id="areaTitle">面积不限</span>
    <dl style=" left: 330px;width:100px;" class="pull-down hidden">
        <dd style="color: orange;">单位(平米)</dd>
        <dd><span onClick="changeSourceArea(this)" attrMin="0" attrMax="0">面积不限</span></dd>
        <dd><span onClick="changeSourceArea(this)" attrMin="0" attrMax="50">50以下</span></dd>
        <dd><span onClick="changeSourceArea(this)" attrMin="50" attrMax="70">50-70</span></dd>
        <dd><span onClick="changeSourceArea(this)" attrMin="70" attrMax="110">70-110</span></dd>
        <dd><span onClick="changeSourceArea(this)" attrMin="110" attrMax="130">110-130</span></dd>
        <dd><span onClick="changeSourceArea(this)" attrMin="130" attrMax="150">130-150</span></dd>
        <dd><span onClick="changeSourceArea(this)" attrMin="150" attrMax="200">150-200</span></dd>
        <dd><span onClick="changeSourceArea(this)" attrMin="200" attrMax="300">200-300</span></dd>
        <dd><span onClick="changeSourceArea(this)" attrMin="300" attrMax="">300以上</span></dd>
    </dl>
</div>
<div id="SourcePrice" class="price" onmouseover="listshow(this);" onmouseout="listhidden(this);" attr="0-0">
    <span id="roomTitle">售价</span>
    <dl style="left: 450px;width:100px" class="pull-down hidden">
        <dd style="color: orange;">总价(万元/套)</dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="0" attrMax="0">售价不限</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="0" attrMax="50">50以下</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="50" attrMax="100">50-100</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="100" attrMax="150">100-150</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="150" attrMax="200">150-200</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="200" attrMax="300">200-300</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="300" attrMax="500">300-500</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="500" attrMax="1000">500-1000</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="1000" attrMax="">1000以上</span></dd>
    </dl>
</div>
<script type="text/javascript">
/**
 * 改变物业类型
 */
function changeSourceType(obj){
    //removeOverlays();
    $("#SourceType").children("span").html($(obj).html());
    listhidden($("#SourceType"));
    $("#SourceType").attr("attr", $(obj).attr("attr"));
    changeDatas();
}
/**
 * 改变面积
 */
function changeSourceArea(obj){
   // removeOverlays();
    $("#SourceArea").children("span").html($(obj).html());
    listhidden($("#SourceArea"));
    $("#SourceArea").attr("attr", $(obj).attr("attrMin")+"-"+$(obj).attr("attrMax"));
    changeDatas();
}
/**
 * 改变平均售价
 */
function changeSourcePrice(obj){
   // removeOverlays();
    $("#SourcePrice").children("span").html($(obj).html());
    listhidden($("#SourcePrice"));
    $("#SourcePrice").attr("attr", $(obj).attr("attrMin")+"-"+$(obj).attr("attrMax"));
    changeDatas();
}
</script>