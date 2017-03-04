<?php
$user = User::model()->getUserInfoById($model->dm_fromid);
$giftModel = Giftcenter::model()->findByPk($model->dm_objectid);
?>
<div class="dxline">
    <span class="dx_02"><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$model->dm_fromid));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($user, "_65x70")?>" width="60px"></a></span>
    <span class="dx_04">
        <h5>
            <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$model->dm_fromid));?>" target="_blank"><?=$user->u_nickname?></a> 赠送我礼物 <?=$giftModel->gc_name?>
        </h5>
        <div class="p">
            <em><?=date("m月d日 H:i",$model->dm_createtime)?></em>
        </div>
    </span>
</div>