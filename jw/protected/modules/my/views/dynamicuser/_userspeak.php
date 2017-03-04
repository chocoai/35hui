<?php
$user = User::model()->getUserInfoById($model->du_fromid);
$content = unserialize($model->du_content);
$speakModel = Userspeak::model()->findByPk($content['usid']);
?>
<div class="dxline" id="<?=$domId?>" attr="<?=$model->du_type."_".$content['usid']."_0"?>">
    <span class="dx_02"><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$user->u_id))?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($user, "_65x70")?>" width="60px"></a></span>
    <span class="dx_04">
        <h5><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$user->u_id))?>" target="_blank"><?=$user->u_nickname?></a> 评论我：<span class="sccontent" style="word-break:break-all;"><?=CHtml::encode($speakModel->us_content)?></span></h5>
        <div class="p">
            <a href="javascript:;" onclick="show_punlun_div('<?=$domId?>')" class="punlun_btn">评论（<font class="scpunlun"><?=$speakModel->us_replynum?></font>）</a>
            <em class="sctime"><?=date("m月d日 H:i",$speakModel->us_creattime)?></em>
        </div>
        <div class="punlunloading" style="clear: both;width: 100%;text-align: center;display: none"><img src="/images/loading.gif" width="25px"/></div>
        <div class="punlun" style="clear: both; line-height: 18px; padding-top: 5px; width: 100%; display: none"></div>
    </span>
</div>