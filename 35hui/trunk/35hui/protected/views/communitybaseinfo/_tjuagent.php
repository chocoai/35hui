<div class="goldjjr">
    <a href="<?php echo Yii::app()->createUrl("/viewuagent/index",array("uaid"=>$value->agentinfo->ua_id)); ?>">
    <?php
    $headPic = User::model()->getUserHeadPic($value->user_id);
    echo CHtml::image($headPic,'Logo',array('height'=>'130px','width'=>'100px','class'=>'img_border'));
    ?>
    </a>
        <div  class="re"></div>
        <div class="propinfo">
            <p class="blue12px"><?=CHtml::link(CHtml::encode($value->agentinfo->ua_realname),array("/viewuagent/index","uaid"=>$value->agentinfo->ua_id)); ?></p>
            <p><?=User::model()->getUserLevelByUserId($value->user_id);?></p>
            <p><?=Uagent::model()->getCompanyByUaid($value->agentinfo,21) ?></p>
        </div>
</div>