<div class="view">
    <div class="vppic"><img src="<?php echo Picture::showStandPic(PIC_URL.$data->p_img,"_large");?>" alt="图片丢失" /></div> 
    <div class="vptxt">
        <div class="vpline">
        <b><?php echo CHtml::encode($data->getAttributeLabel('p_id')); ?>:</b>
        <input id="pid_<?=$data->p_id?>" type="checkbox" name="pids[]" value="<?=$data->p_id?>">
        <label for="pid_<?=$data->p_id?>"><?=$data->p_id?></label> <a href="<?php
        echo MAINHOST;
        if($data->p_sourcetype=='2'){
            echo Yii::app()->createUrl('officebaseinfo/view',array('id'=>$data->p_sourceid));
        }elseif($data->p_sourcetype=='5'){
            echo Yii::app()->createUrl('shop/view',array('id'=>$data->p_sourceid));
        }elseif($data->p_sourcetype=='8'){
            echo Yii::app()->createUrl('communitybaseinfo/viewResidence',array('id'=>$data->p_sourceid));
        }elseif($data->p_sourcetype=='10'){
            echo Yii::app()->createUrl('creativesource/view',array('id'=>$data->p_sourceid));
        }
        ?>" target="_blank">查看房源</a>
        <?if($data->p_sourcetype=='10'||$data->p_sourcetype=='2'){?>
        <a href="<? echo Yii::app()->createUrl('picture/revertbuild',array('id'=>$data->p_id));?>">纳入图库</a>
        <?}?>
        </div>
        <div class="vpline">
        <b><?php echo CHtml::encode($data->getAttributeLabel('p_sourceid')); ?>:</b>
        <?php echo CHtml::encode($data->p_sourceid); ?>
        </div>
        <div class="vpline">
        <b><?php echo CHtml::encode($data->getAttributeLabel('p_sourcetype')); ?>:</b>
        <?=@CHtml::encode(Picture::$sourceDescription[$data->p_sourcetype])?>
        </div>
        <div class="vpline">
        <b><?php echo CHtml::encode($data->getAttributeLabel('p_type')); ?>:</b>
        <?=@CHtml::encode(Picture::$typeDescription[$data->p_type])?>
        </div>
        <div class="vpline">
        <b><?php echo CHtml::encode($data->getAttributeLabel('p_uploadtime')); ?>:</b>
        <?php echo CHtml::encode(showFormatDateTime($data->p_uploadtime)); ?>
        </div>
    </div>       
</div>