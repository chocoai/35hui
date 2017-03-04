<tr>
<?php
$title="";
$url = "";
if($value["ahs_type"]==1){//写字楼
    $model = Officepresentinfo::model()->findByAttributes(array("op_officeid"=>$value["ahs_sourceid"]));
    $title = @$model->op_officetitle;
    $url = "/office/view";
}elseif($value["ahs_type"]==2){//商铺
    $model = Shoppresentinfo::model()->findByAttributes(array("sp_shopid"=>$value["ahs_sourceid"]));
    $title = @$model->sp_shoptitle;
    $url = "/shop/view";
}elseif($value["ahs_type"]==3){//住宅
    $model = Residencebaseinfo::model()->findByAttributes(array("rbi_id"=>$value["ahs_sourceid"]));
    $title = @$model->rbi_title;
    $url = "/communitybaseinfo/viewResidence";
}
?>
    <td class="txt"><?=CHtml::link($title,array($url,"id"=>$value["ahs_sourceid"]),array("target"=>"_blank","style"=>"color:blue"))?></td>
    <td class="txt"><?=@Applyhighsource::$ahs_type[$value["ahs_type"]]?></td>
    <td class="txt">
        <span><?=Applyhighsource::model()->getStatusName($value['ahs_status'])?></span>
        <?php
        if($value['ahs_status']==2){
        ?>
        &nbsp;&nbsp;<span onclick="showMsg(this)" style="color:blue;cursor: pointer">查看原因<font style="display:none"><?=CHtml::encode($value["ahs_message"])?></font></span>
        <?php
        }
        ?>
        &nbsp;&nbsp;<span onclick="unSetSource(<?=$value["ahs_id"]?>)" style="color:blue;cursor: pointer">取消</span>
    </td>
</tr>