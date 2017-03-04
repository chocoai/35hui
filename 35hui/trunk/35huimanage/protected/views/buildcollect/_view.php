<div class="view" style="height: 80px">
    <div style="width: 70%;float: left;">
        <b><?php echo CHtml::encode($data->getAttributeLabel('bc_id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->bc_id), array('view', 'id'=>$data->bc_id)); ?>
        <br />
        <?php echo CHtml::link($data->bc_buildname,array("view",'id'=>$data->bc_id)); ?>
        
        <?php echo '[',CHtml::encode(Region::model()->getNameById($data->bc_district)),' ',
                CHtml::encode(Region::model()->getNameById($data->bc_section)),' ',
                CHtml::encode(Searchcondition::model()->getLoopName($data->bc_loop)),']' ?>
        <br />
        <?php echo CHtml::encode($data->bc_buildaddress); ?>
        <br />
        
        <?php echo CHtml::encode(Buildcollect::$bc_state[$data->bc_state]); ?>&nbsp;
        <?php echo date("Y-m-d H:i:s",$data->bc_releasetime); ?> 录入
        <br />
    </div>
    <div style="width: 30%;float: right;margin-top: 30px">
        <?php
        echo CHtml::link("审 核",array("view",'id'=>$data->bc_id));
        ?>
    </div>
</div>