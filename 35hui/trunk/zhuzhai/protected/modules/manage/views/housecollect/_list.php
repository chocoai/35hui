<?php
$url = "#";//链接地址
$titlePic ="";//标题图
$content = "";//内容
if($data->hc_officetype==Housecollect::office){//如果是写字楼
    if($data->hc_rentorsell==Housecollect::rent){
        $url = Yii::app()->createUrl("/officebaseinfo/rentView",array("id"=>$data->hc_presentid));
    }else{
        $url = Yii::app()->createUrl("/officebaseinfo/saleView",array("id"=>$data->hc_presentid));
    }
    $model = Officepresentinfo::model()->findByAttributes(array("op_officeid"=>$data->hc_presentid));
    if($model){
        $titlePic = $model->op_titlepicurl;
        $content  = $model->op_officetitle;
    }
}elseif($data->hc_officetype==Housecollect::business){
    $url = Yii::app()->createUrl("/officebaseinfo/businessSummarize",array("opid"=>$data->hc_presentid));
    $model = Officepresentinfo::model()->findByAttributes(array("op_officeid"=>$data->hc_presentid));
    if($model){
        $titlePic = $model->op_titlepicurl;
        $content  = $model->op_officetitle;
    }
}elseif($data->hc_officetype==Housecollect::shop){//商铺
    $url = Yii::app()->createUrl("/shop/view",array("id"=>$data->hc_presentid));
    $model = Shoppresentinfo::model()->findByAttributes(array("sp_shopid"=>$data->hc_presentid));
    if($model){
        $titlePic = $model->sp_titlepicurl;
        $content  = $model->sp_shoptitle;
    }
}elseif($data->hc_officetype==Housecollect::residence){//住宅
    $url = Yii::app()->createUrl("communitybaseinfo/viewResidence",array("id"=>$data->hc_presentid));
    $model = Residencebaseinfo::model()->findByAttributes(array("rbi_id"=>$data->hc_presentid));
    if($model){
        $titlePic = $model->rbi_titlepicurl;
        $content  = $model->rbi_title;
    }
}
?>
    <tr>
        <td class="txt"><?=@Housecollect::$officeTypeDes[$data->hc_officetype]; ?></td>
        <td class="txt">
            <a href="<?=$url?>" target="_blank">
                <?=CHtml::image(Picture::model()->getPicByTitleInt($titlePic,"_small"),'',array('style'=>'width:120px;height:80px;')); ?>
            </a>
        </td>
        <td class="txt"><a href="<?=$url?>" target="_blank"><?=$content?></a></td>
        <td class="txt"><?=common::showFormatDateTime($data->hc_recordtime);?></td>
        <td class="txt"><?=CHtml::link("删除",'#',array('submit'=>array('delete','id'=>$data->hc_id),'confirm'=>'你确定要删除此记录吗?'))?></td>
    </tr>
