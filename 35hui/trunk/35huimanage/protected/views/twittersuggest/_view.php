<style type="text/css">
.use {
    position: absolute;
    margin-top: -30px;
    margin-left: 580px;
    background-color: #f5deb3;
    width:80px;
    height:30px;
    text-align: center;
    line-height: 28px;
}
</style>
<div class="view">
    <span>
        <b><?php echo CHtml::encode($data->getAttributeLabel('ts_content')); ?>:</b>
        <?php echo CHtml::encode($data->ts_content); ?>
    </span>
    <div>
        <span><?=showFormatDateTime($data->ts_suggesttime)?></span>
        <span style="margin-left: 50px;">由<?=User::model()->getUserName($data->ts_userid)?>提供</span>
    </div>
    <div class="use"><?php echo CHtml::link("采用", array('bindTwitter', 'id'=>$data->ts_id)); ?>&nbsp;&nbsp;<?php echo CHtml::link("删除", array('delete', 'id'=>$data->ts_id),array('confirm'=>'Are you sure you want to delete this item?')); ?></div>
</div>