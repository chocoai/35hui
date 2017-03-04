<?@$comment=unserialize($data->sbc_comment)?>
<div style="width:100%;margin-bottom:10px;">
    <div style="width:50px;height:65px;float:left;overflow: hidden">
        <?php 
        if($data->userInfo['user_id']){
            echo User::model()->getUserShowPic($data->userInfo['user_id'],true);
        }else{
            echo CHtml::image(DEFAULT_NORMAL,"",array('height'=>'65px','width'=>'50px'));
        }
        ?>
    </div>
    <div class="feed_content" style="width:90%;float:right" id="feed_content_apf_id_12">
        <div style="float:left;width:100px"><?php
            if($data->userInfo['user_id']){
                 echo User::model()->getUserShowLink($data->userInfo['user_id'],true);
            }else{
                echo $comment[0];
            }?></div>

        <div style="float:left;width:150px;color:#808080"><em><?=date("Y-m-d H:i:s",$data->sbc_comdate)?></em> </div>
        <div style="float:left"><?=common::getStar($data->sbc_evaluation,10,"")?></div>
        <div class="pubtime" style="width:50px;float:right;padding-right:10px;"><span><?=$data->sbc_num?></span><a style="float:right" href="javascript:;" onclick="addCommentLog(<?=$data->sbc_id?>,this)" >有用</a></div>
        <div class="clear"></div>
        <div style="width:90%;margin-top:10px;overflow:hiddenword-wrap:break-word;word-break:break-all;"><? if(is_array($comment)){echo CHtml::encode($comment[1]);}else{echo CHtml::encode($data->sbc_comment);}?></div>
    </div>
    <div class="clear" style="height:10px;border-bottom:1px #CCCCCC dashed;"></div>
</div>
	
    
