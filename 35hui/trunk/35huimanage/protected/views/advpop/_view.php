<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">ID&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link(CHtml::encode($data->adp_id), array('view', 'id'=>$data->adp_id)); ?>
        </div>
    </div>
    <b><?php echo CHtml::encode($data->getAttributeLabel('adp_id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->adp_id), array('view', 'id'=>$data->adp_id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('adp_position')); ?>:</b>
    网站板块首页弹窗 - <?php echo CHtml::encode(Advpop::$positionConfig[$data->adp_position]); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('adp_picurl')); ?>:</b>
    <?php echo CHtml::encode($data->adp_picurl); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('adp_linkurl')); ?>:</b>
    <?php echo CHtml::encode($data->adp_linkurl); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('adp_title')); ?>:</b>
    <?php echo CHtml::encode($data->adp_title); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('adp_uploadtime')); ?>:</b>
    <?php echo CHtml::encode(date('Y-m-d H:i',$data->adp_uploadtime)); ?>
    <br />


</div>