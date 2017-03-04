<?php 
if($sr=="sell"){
    $this->breadcrumbs=array(
        '房源管理',
        '管理出售房源',
        '已发布房源'
    );
}else{
    $this->breadcrumbs=array(
        '房源管理',
        '管理出租房源',
        '已发布房源'
    );
}
$temp = array('','office','shop','residence',"creative");
$this->renderPartial('_managetop',array("url"=>$url,"tab"=>"1","show"=>$show));?>
<div  id="manbrightChild1" class="rgcont">
  
    <form method="GET" action="<?=$url?>" id="searchform">
        <?php $this->renderPartial('_managesearchdiv',array("show"=>$show,'buildTypeInfo'=>$buildTypeInfo,"sr"=>$sr));?>
        <table border="0" cellpadding="0" cellspacing="0" class="table_01">
            <tr>
                <td class="ftit" colspan="2">房源基本信息</td>
                <td width="13%" class="ftit">标签</td>
                <td width="9%" class="ftit">点击量</td>
                <td width="10%" class="ftit">刷新</td>
                <td width="12%" class="ftit">最后更新</td>
                <td width="17%" class="ftit">有效日期</td>
            </tr>
        <?php
       foreach($dataProvider->getData() as $data){
            $this->renderPartial('_sellmanage', array(
                'data'=>$data,
                'sourceType'=>$show['sourceType'],
                'orderRefresh'=>$orderRefresh,
                )
            );
        }
        ?>
        </table>
    </form>
        <?php
            $num = User::model()->getOprateState(Yii::app()->user->id, 3, $show['sourceType']);//刷新数
        ?>
</div>
<div class="jefenpage">
    <?php
        $this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
        "htmlOptions"=>array("style"=>"float:right"),
        ));
        
    ?>
</div>
<div class="thline" style="padding-left:14px;">
	<div class="thinpt">
        <input id="chkAll" name="chkAll" type="checkbox" onclick='checkAll(this.checked)' /><label for="chkAll">全选</label>
        <input type="button" class="btn_01" value="刷新房源" onclick="javascript:flushAllBuild()" class="btn_01" />
        <?php if($orderRefresh){?>
            <input type="button" class="btn_02" value="预约刷新房源" onclick="javascript:orderRefresh()" />
            <input type="button" class="btn_02" value="取消预约刷新" onclick="javascript:cancelMoreOrderRefresh('<?=$temp[$show['sourceType']]?>')" />
        <?php } ?>
        <input type="button" class="btn_02" value="取消发布房源" onclick="javascript:opration(8)" />
        <input type="button" class="btn_01" value="删除房源" onclick="javascript:opration(1)" />
</div>
</div>

<script type="text/javascript" language="javascript">

function orderRefresh() {
    var orderhouses = document.getElementsByTagName('input');
    var houseidsvalue = "";//当前选择的房源id字符串
    var countorderhouse = 0;//当前是否选择了房源
    var isorder = 0;//当前选择的房源是否有已经预定的
    
    for(var i = 0 ; i < orderhouses.length ; i ++)
    {
        if(orderhouses[i].type == 'checkbox' && orderhouses[i].checked && orderhouses[i].id != 'chkAll' )
        {
            houseidsvalue += orderhouses[i].value+"_";
            countorderhouse++;
            if(document.getElementById(orderhouses[i].value+"_isOrder").value=="1")
            {
                isorder++;
            }
        }
    }
    if(countorderhouse==0){
        alert('您未选择任何房源进行预约刷新')
        return false;
    }
    if(isorder>0){
        alert("您选择的房源中有已预约的房源,请重新选择!");
        return false;
    }else{
        openTip(houseidsvalue,"<?=$temp[$show['sourceType']]?>");
        return true;
    }
    return false;
}
function oneOrderRefresh(sourceid,type){
    sourceid = sourceid+"_";
    openTip(sourceid,type);
}
function openTip(sourceid,type){
    <?php
    $userId = Yii::app()->user->id;
    $orderRefresh = false;
    $alertStr = '没有此项服务。';
    if(Yii::app()->user->getState('role') == '2'){
        $orderRefresh = Uagent::model()->getIdentityCertification($userId) && Uagent::model()->getSeniorityCertification($userId);
        $alertStr = '只有通过身份认证和执业认证，您才能使用预约刷新功能！';
    }
    if($orderRefresh){
    ?>
        var url = "/manage/sourceorderrefresh/create/sourceid/"+sourceid+"/type/"+type;
        var width = "580px";
        var height = "505px";
        parent.window.openTip(url,width,height);
    <?php
    }else{
    ?>
        alert("<?=$alertStr?>");
    <?php
    }
    ?>
    
}
function closeTip(){
    parent.window.closeTip();
}
function closeTipAndReload(){
    alert('预约刷新成功！');
    closeTip();
    window.location.reload();
}
function cancelOrderRefresh(sourceid,type){
    if(confirm("确定要取消预约刷新吗？")){
        $.ajax({
            url:"/manage/sourceorderrefresh/delete",
            data:{"sourceId":sourceid,"type":type},
            type:"POST",
            success:function(){
                window.location.reload();
            }
        })
    }
}
function cancelMoreOrderRefresh(type) {
    var orderhouses = document.getElementsByTagName('input');
    var houseidsvalue = "";//当前选择的房源id字符串
    var countorderhouse = 0;//当前是否选择了房源
    var isorder = 0;//当前选择的房源是否有已经预定的

    for(var i = 0 ; i < orderhouses.length ; i ++)
    {
        if(orderhouses[i].type == 'checkbox' && orderhouses[i].checked && orderhouses[i].id != 'chkAll' )
        {
            houseidsvalue += orderhouses[i].value+"_";
            countorderhouse++;
            if(document.getElementById(orderhouses[i].value+"_isOrder").value=="0")
            {
                isorder++;
            }
        }
    }
    if(countorderhouse==0){
        alert('您未选择任何房')
        return false;
    }
    if(isorder>0){
        alert("您选择的房源中有还未预约的房源,请重新选择!");
        return false;
    }else{
        cancelOrderRefresh(houseidsvalue, type);
        return true;
    }
    return false;
}
<?php
$release=Oprationconfig::model()->getConfigByName('release');
$release['1'];//急标签花费money
$release['2'];//推标签花费money
?>
function tagit(id,type,tag){
    var confirmStr='';
    if(tag=='hurry'){
        confirmStr="为该房源设置急标签需要<?php echo $release['1'] ?>个新币\n确定要进行？"
    }else{
        confirmStr="为该房源设置推标签需要<?php echo $release['2'] ?>个新币\n确定要进行？"
    }
    if(confirm(confirmStr)){
        $.ajax({
            url:"/manage/manage/tagit",
            data:{"id":id,"type":type,"tag":tag},
            type:"GET",
            success:function(str){
                if(str=='0'){
                    window.location.reload();
                }else{
                    alert(str);
                }
            }
        })
    }
}
</script>
