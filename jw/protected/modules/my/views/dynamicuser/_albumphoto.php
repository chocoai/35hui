<?php
$user = User::model()->getUserInfoById($model->du_fromid);
$content = unserialize($model->du_content);
$albumModel = Album::model()->findByPk($content['albumid']);//其中如果相册被删除则会为空
$pic = Dynamicuser::model()->getImagesByContent($content["photoid"]);//其中如果相册被删除则会为空，相册中的图片也会被删除
?>
<div class="dxline" id="<?=$domId?>" attr="<?=$model->du_type."_".$content['albumid']."_0"?>">
    <span class="dx_02"><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$user->u_id))?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($user, "_65x70")?>" width="60px"></a></span>
    <span class="dx_04">
        <h5><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$user->u_id))?>" target="_blank"><?=$user->u_nickname?></a>&nbsp;为相册&nbsp;<a href="" class="scalbumname"><?=@$albumModel->am_albumtitle?></a>&nbsp;上传了新照片</h5>
        <p class="scimages">
            <?php
            if($albumModel){
                echo CHtml::image($pic["photos"][0]);
            }else{
                echo CHtml::image("/images/default/del.jpg");
            }
            ?>
        </p>
        <div class="scotherimgs" style="margin-top: 5px">
            <?php
            if($pic["num"]>1) {
                foreach($pic["photos"] as $p) {
                    echo CHtml::image($p,"",array("width"=>"50px"))."&nbsp;";
                }
            }
            ?>
        </div>
        <div class="scotherimgnum" style="margin-top: 5px">
            <div style="float:left">
                <?php
                if($pic["num"]>1) {
                    echo '(共有'.$pic["num"].'张照片)';
                }
                ?>
            </div>
            <div style="float:right">
                <?php
                if($albumModel){
                    ?>
                <a href="javascript:;" onclick="show_punlun_div('<?=$domId?>')" class="punlun_btn" attr="">评论（<font class="scpunlun"><?=$albumModel->am_replynum?></font>）</a>
                <?php
                }
                ?>
                <em class="sctime"></em>
            </div>
        </div>
        <div class="punlunloading" style="clear: both;width: 100%;text-align: center;display: none"><img src="/images/loading.gif" width="25px"/></div>
        <div class="punlun" style="clear: both;line-height: 18px;padding-top: 5px;width: 100%;display: none"></div>
    </span>
</div>