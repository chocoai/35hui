<div class="view" style="height: 80px">
    <div style="width: 70%;float: left;">
        <b><?php echo CHtml::encode($data->getAttributeLabel('cc_id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->cc_id), array('view', 'id'=>$data->cc_id)); ?>
        <br />
        <?php echo CHtml::link($data->cc_name,array("view",'id'=>$data->cc_id)); ?>

        <?php echo '[',CHtml::encode(Region::model()->getNameById($data->cc_district)),']' ?>
        <br />
        <?php echo CHtml::encode($data->cc_address); ?>
        <br />

        <?php echo CHtml::encode(Creativecollect::$cc_state[$data->cc_state]); ?>&nbsp;
        <?php echo date("Y-m-d H:i:s",$data->cc_releasetime); ?> 录入
        <br />
    </div>
    <div style="width: 30%;float: right;margin-top: 30px">
        <?php
        echo CHtml::link("审 核",array("view",'id'=>$data->cc_id));
        ?>
    </div>
</div>