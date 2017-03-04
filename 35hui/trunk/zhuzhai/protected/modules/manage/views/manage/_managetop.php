<?php
$userId = Yii::app()->user->id;
$action = $this->action->getId();
$allSourceNum = Uagent::model()->getAllOperateNum($userId, 1);//可发布总数
$allFlushNum = Uagent::model()->getAllOperateNum($userId, 3);//每日可刷新总数
$sourceType = isset($show['sourceType'])?$show['sourceType']:1;
if(Yii::app()->user->hasFlash('message')){
?>
<div class="msg">
    <?php echo Yii::app()->user->getFlash('message') ?>
</div>
<?php }else{ ?>
<div class="msg">
    <table width="100%" border="0" cellpadding="5" cellspacing="5">
        <tr>
            <?php
                $officeNum = Uagent::model()->getNowOperateNum($userId, 1);//写字楼已发布数;
                $flushNum = Uagent::model()->getNowOperateNum($userId, 3);//今日已经刷新数
            ?>
            <td>写字楼：</td>
            <td>已发布<span><?=$officeNum?></span>条</td>
            <td>还可发布<span><?=$allSourceNum-$officeNum?></span>条</td>
            <td>今日已刷新<span><?=$flushNum?></span>次</td>
            <td>今日还可刷新<span><?=$allFlushNum-$flushNum?></span>次</td>
            <td>全景房源<span><?=User::model()->countAllPanoramas($userId, 1);?></span>条</td>
        </tr>
        <tr>
            <?php
                $cyParkNum = Uagent::model()->getNowOperateNum($userId, 1, 4);//创意园区已发布数;
                $flushNum = Uagent::model()->getNowOperateNum($userId, 3, 4);//今日已经刷新数
            ?>
            <td>创意园区：</td>
            <td>已发布<span><?=$cyParkNum?></span>条</td>
            <td>还可发布<span><?=$allSourceNum-$cyParkNum?></span>条</td>
            <td>今日已刷新<span><?=$flushNum?></span>次</td>
            <td>今日还可刷新<span><?=$allFlushNum-$flushNum?></span>次</td>
            <td>全景房源<span><?=User::model()->countAllPanoramas($userId, 4);?></span>条</td>
        </tr>
    </table>
<?php
$mf_type=array('1'=>'2','2'=>'5','3'=>'8');
$_mftype=isset($mf_type[$sourceType])?$mf_type[$sourceType]:0;
$old=Yii::app()->db->createCommand("SELECT * FROM {{msgfang}} WHERE `mf_uid`='{$userId}' AND `mf_type`='{$_mftype}' AND `mf_ttg`=0")->queryRow();
if($old){?>
    <div id="notemfmsg">
        <h3>您有<?=$old['mf_title']?>张图片被删除,以下是房源ID</h3>
        <p class="tpmsg"><?=$old['mf_msg']?><a href="javascript:void(0);" onclick="delMsgfang(<?=$old['mf_id']?>)">我知道了</a></p>
    </div>
<?php } ?>
</div>
<?php
}
$sellrent=strtolower($this->getAction()->id)=='sell'?'2':'1';
$uid=Yii::app()->user->id;
if($sourceType=='1'){
    $sql='SELECT count( * ) AS n , ob_check AS col FROM {{officebaseinfo}} AS t1
        WHERE t1.ob_uid='.$uid.' AND t1.ob_sellorrent='.$sellrent.'
        GROUP BY t1.ob_check';
}elseif($sourceType=='3'){
    $sql='SELECT count( * ) AS n , t2.rt_check AS col FROM {{residencebaseinfo}} AS t1
        LEFT JOIN {{residencetag}} AS t2 ON t1.rbi_id = t2.rt_rbiid
        WHERE t1.rbi_uid='.$uid.' AND t1.rbi_rentorsell='.$sellrent.'
        GROUP BY t2.rt_check';
}elseif($sourceType=='2'){
    $sql='SELECT count( * ) AS n , t2.st_check AS col FROM {{shopbaseinfo}} AS t1
        LEFT JOIN {{shoptag}} AS t2 ON t1.sb_shopid = t2.st_shopid
        WHERE t1.sb_uid='.$uid.' AND t1.sb_sellorrent='.$sellrent.'
        GROUP BY t2.st_check';
}elseif($sourceType=='4'){
    $sql='SELECT count( * ) AS n , cr_check AS col FROM {{creativesource}} AS t1
        WHERE t1.cr_userid='.$uid.'
        GROUP BY t1.cr_check';
}
$numByTag=array();
$allrows=Yii::app()->db->createCommand($sql)->queryAll();
foreach ($allrows as $value) {
$numByTag[$value['col']]=$value['n'];
}
?>
<div class="htguanli">
    <ul>
        <li<?php if(isset($tab)&&$tab==1)echo ' class="clk"';?>><a href="<?php echo $this->createUrl("manage/".$action,array('tag'=>'','sourceType'=>$sourceType))?>"><strong>已发布房源(<?php echo isset($numByTag['4'])?$numByTag['4']:'0' ?>)</strong></a></li>
        <li<?php if(isset($tab)&&$tab==2)echo ' class="clk"';?>><a href="<?php echo $this->createUrl("manage/".$action,array('tag'=>'draft','sourceType'=>$sourceType))?>"><strong>草稿箱(<?php echo isset($numByTag['8'])?$numByTag['8']:'0' ?>)</strong></a></li>
        <li<?php if(isset($tab)&&$tab==4)echo ' class="clk"';?>><a href="<?php echo $this->createUrl("manage/".$action,array('tag'=>'outtime','sourceType'=>$sourceType))?>"><strong>过期房源(<?php echo isset($numByTag['6'])?$numByTag['6']:'0' ?>)</strong></a></li>
    </ul>
</div>
<script type="text/javascript">
function delMsgfang(id,type){
    $.get('<?=Yii::app()->createUrl('/manage/delmsgfang')?>',{"id":id},function(data){
        alert(data);
        if(data=='ok'){
            $("#notemfmsg").slideUp("slow");
        }
    });
}
function search(){
    $("#searchform").submit();
}
function changeSource(obj){
    $("#buildTypeId").val('');
    search();
    return false;
}
function changeBuildType(obj){
    search();
    return false;
}
//操作房源
function opration(state){
    var val = getCheckboxVal();
    if(val){
        oprationOne(val,state);
    }else{
        alert("请选择房源！");
    }
}
//操作单个房源
function oprationOne(id,state){
    var url = "<?=Yii::app()->createUrl('/manage/manage/changetag')?>";
    if(confirm(state==2?"删除房源将不可恢复！\n确定要删除?":"确定要执行吗？")){
        $.ajax({
            type: "GET",
            url: url,
            data: {"id":id,"state":state,"sourceType":<?=$sourceType?>},//"id="+id+"&state="+state,
            success: function(msg){
                if(msg=="error"){
                    alert("操作失败");
                }else{
                    var msg = msg.split("_");
                    alert(msg[1]);
                    if(msg[0]==1){
                        window.location.reload();
                    }
                }
            }
        });
    }
}

<?php $num=Oprationconfig::model()->getConfigByName('flushupdatedate', '0');?>
function getCheckboxVal(){
    var val = [];
    $(":input[name=chk[]]").each(function(){
       if($(this).attr('checked')) val.push($(this).val());
    });
    return val.join(',');
}
//刷新所选房源
function flushAllBuild(){
    var val = getCheckboxVal();
    if(val.length){
        flushBuild(val);
    }else{
        alert("请选择房源！");
    }
}
//刷新单个房源
function flushBuild(officeid){
    var url = "<?=Yii::app()->createUrl('/manage/manage/flushupdatedate')?>";
    //if(confirm("每刷新一则房源将扣除<?=$num?$num.'点':''?>新币，确定刷新吗？")){
        $.ajax({
            type: "POST",
            url: url,
            data: {"officeid":officeid,"sourceType":<?=$sourceType?>},
            success: function(msg){
                if(msg=="error"){
                    alert("操作失败");
                }else if(msg==0){
                    alert("对不起，您已经达到今日可刷新房源量最大值，刷新失败！");
                }else if(msg==1){
                    alert("对不起，您的新币不够，刷新失败！");
                }else{
                    var msg = msg.split("_");
                    alert("您总共可用刷新数"+msg[0]+"次，已用"+msg[1]+"次");
                    window.location.reload();
                }
            }
        });
//    }
}
//全选
function checkAll(t){
    $(":input[name=chk[]]").each(function(){
        $(this).attr("checked",t?"checked":"");
    });
}
//取消全选
function unselectall(){
    $("#chkAll").attr("checked", '');
}
</script>