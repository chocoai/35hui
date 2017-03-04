<?php
$user = User::model()->getUserInfoById($model->dm_fromid);
$speak = Userspeak::model()->findByPk($model->dm_objectid);
$comment = Userspeakcomment::model()->getOneComment($model->dm_replyid);
?>
<div class="dxline" id="<?=$domId?>" attr="<?=$model->dm_type."_".$model->dm_objectid."_".$model->dm_replyid?>">
    <span class="dx_02"><img src="<?=User::model()->getUserHeadPhoto($user, "_65x70")?>" width="60px"></span>
    <span class="dx_04">
        <h5><a href="" class="scusername"><?=$user->u_nickname?></a> 评论我：<span class="sccontent" style="word-break:break-all;"><?=CHtml::encode($speak->us_content)?></span></h5>
        <div class="p">
            <em class="sctime"><?=date("m月d日 H:i",$speak->us_creattime)?></em>
            <em class="sctime">评论(<font class="scpunlun"><?=$speak->us_replynum?></font>)</em>
        </div>

        <div class="punlun" style="clear: both; line-height: 18px; padding-top: 5px; width: 100%; ">
            <?php
            $this->renderPartial("/comment/_userspeakcomment",array(
                    "comment"=>array($comment),
                    "domId"=>$domId,
                    "searchId"=>$model->dm_objectid,//设置了评论id，则只显示此条评论
                    "showNewComment"=>false,//隐藏新评论
            ));?>
        </div>
    </span>
</div>