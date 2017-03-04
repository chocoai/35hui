<?php
$user = User::model()->getUserInfoById($model->dm_fromid);
$boardModel = Userboard::model()->findByPk($model->dm_objectid);
?>
<div class="dxline">
    <span class="dx_02"><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$model->dm_fromid));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($user, "_65x70")?>" width="60px"></a></span>
    <span class="dx_04">
        <h5>
            <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$model->dm_fromid));?>" target="_blank"><?=$user->u_nickname?></a> 给我<?php
            //判断是否是给相册的
            if($boardModel&&$boardModel->ub_albumid!=0){
                $album = Album::model()->findByPk($boardModel->ub_albumid);
                if($album){//假如相册也还没有被删除
                    echo "的相册&nbsp;".CHtml::link($album->am_albumtitle,array("/my/album/view","id"=>$album->am_id),array("target"=>"_blank"))."&nbsp;";
                }
            }
            ?>一张<?=@Userboard::$ub_boardtype[$model->dm_replyid]?>
            <?php
            echo Userboard::model()->getBoardImgSrc($model->dm_replyid,"30px");
            ?>
        </h5>
        <div class="p">
            <em><?=date("m月d日 H:i",$model->dm_createtime)?></em>
        </div>
    </span>
</div>