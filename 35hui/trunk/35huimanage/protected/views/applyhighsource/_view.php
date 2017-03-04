<?php
$title="";
$url = "";
if($data["ahs_type"]==1){//写字楼
    $model = Officepresentinfo::model()->findByAttributes(array("op_officeid"=>$data["ahs_sourceid"]));
    $title = @$model->op_officetitle;
    $url = "office/view";
}elseif($data["ahs_type"]==2){//商铺
    $model = Shoppresentinfo::model()->findByAttributes(array("sp_shopid"=>$data["ahs_sourceid"]));
    $title = @$model->sp_shoptitle;
    $url = "shop/view";
}elseif($data["ahs_type"]==3){//住宅
    $model = Residencebaseinfo::model()->findByAttributes(array("rbi_id"=>$data["ahs_sourceid"]));
    $title = @$model->rbi_title;
    $url = "communitybaseinfo/viewResidence";
}
?>
<div class="view">
    <table width="100%">
        <tr>
            <td width="60%">
                <a href="<?php echo MAINHOST.Yii::app()->createUrl($url,array('id'=>$data->ahs_sourceid)) ?>" target="_blank" style="color:blue"><?=$title?></a>
            </td>
            <td width="8%"><?php echo @Applyhighsource::$ahs_type[$data->ahs_type]; ?></td>
            <td width="10%"><?php echo User::model()->getRealNamebyid($data->ahs_userid); ?></td>
            <td width="8%"><?=date("m-d H:s", $data->ahs_releasetime)?></td>
            <td>
                <span><?=CHtml::link("设优",array("/applyhighsource/audit","id"=>$data->ahs_id,"state"=>"pass"))?></span>
                <span><?=CHtml::link("不通过","javascript:showtip(".$data->ahs_id.")")?></span>
            </td>
        </tr>
    </table>
</div>