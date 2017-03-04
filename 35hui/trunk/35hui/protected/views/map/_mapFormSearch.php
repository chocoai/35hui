<div id="SourceType" class="style" style="display:none" onmouseover="listshow(this);" onmouseout="listhidden(this);" attr="1">
    <span id="priceTitle"><?=Systembuildinginfo::$sbi_buildtype[1]?></span>
    <dl style="left: 330px;" class="pull-down hidden" >
        <?php
        $allYype = array(1=>"写字楼", 2=>'商业广场', 3=>'小区');
        foreach($allYype as $key=>$value){
        ?>
        <dd><span onClick="changeSourceType(this)" attr="<?=$key?>"><?=$value;?></span></dd>
        <?php
        }
        ?>
    </dl>
</div>

<div id="SourcePrice" class="price" onmouseover="listshow(this);" onmouseout="listhidden(this);" attr="0-0">
    <span id="roomTitle">平均售价</span>
    <dl style="left: 330px;width:100px" class="pull-down hidden">
        <dd style="color: orange;">单位(元/平米)</dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="0" attrMax="0">售价不限</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="0" attrMax="8000">8000以下</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="8000" attrMax="10000">8000-10000</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="10000" attrMax="15000">10000-15000</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="15000" attrMax="20000">15000-20000</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="20000" attrMax="30000">20000-30000</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="30000" attrMax="50000">30000-50000</span></dd>
        <dd><span onClick="changeSourcePrice(this)" attrMin="50000" attrMax="">50000以上</span></dd>
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
function changeSourcePrice(obj){
    //removeOverlays();
    $("#SourcePrice").children("span").html($(obj).html());
    listhidden($("#SourcePrice"));
    $("#SourcePrice").attr("attr", $(obj).attr("attrMin")+"-"+$(obj).attr("attrMax"));
    changeDatas();
}
</script>