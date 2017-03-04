<div class="view">
        <div class="right-tip">
            <div class="font-20" style="float:left;">Id&nbsp;</div>
            <div class="right-id-tip deepskyblue">
                <?php echo CHtml::link(CHtml::encode($data->br_id), array('view', 'id'=>$data->br_id)); ?>
            </div>
        </div>
	<b><?php echo CHtml::encode($data->getAttributeLabel('br_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->br_id), array('view', 'id'=>$data->br_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('br_mrid')); ?>:</b>
	<?php echo CHtml::encode($data->br_mrid?$data->meet->mr_salesman:$data->br_salesman); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('br_fcid')); ?>:</b>
        <?php
            if($data->br_fcid){
                $taocan='RMB'.$data->config->fc_rmbprice."   商务币".$data->config->fc_giveprice."    积分".$data->config->fc_giveprice;
                if($data->config->fc_givepanoramadevice){
                    $taocan.="   全景镜头".$data->config->fc_givepanoramadevice.'枚';
                }
                echo CHtml::encode($taocan);
            }else{
                echo CHtml::encode($data->br_other); 
            }
        ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('br_amount')); ?>:</b>
	<?php echo CHtml::encode($data->br_amount); ?>元
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('br_contractno')); ?>:</b>
	<?php echo CHtml::encode($data->br_contractno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('br_time')); ?>:</b>
	<?php echo CHtml::encode(date("Y-m-d H:i:s",$data->br_time)); ?>
	<br />


</div>