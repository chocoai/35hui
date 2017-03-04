<div class="view">
    <table border="1">
        <tr>
            <td width="30%"><b><?php echo CHtml::encode($data->getAttributeLabel('qrq_name')); ?>:</b><span title="<?=$data->qrq_name?>"><?php echo common::strCut(CHtml::encode($data->qrq_name),12); ?></span>[<?php echo CHtml::link(CHtml::encode($data->qrq_id), array('view', 'id'=>$data->qrq_id)); ?>]</td>
            <td width="30%"><b><?php echo CHtml::encode($data->getAttributeLabel('qrq_tel')); ?>:</b><span title="<?=$data->qrq_tel?>"><?php echo  common::strCut(CHtml::encode($data->qrq_tel),12);; ?></span></td>
            <td width="40%"><b><?php echo CHtml::encode($data->getAttributeLabel('qrq_email')); ?>:</b><span title="<?=$data->qrq_email?>"><?php echo  common::strCut(CHtml::encode($data->qrq_email),24);; ?><span></td>
        </tr>
        <tr>
            <td><b><?php echo $data->qrq_check?"发布状态":"审核状态" ?>:</b>
                <?php if( $data->qrq_check){
                    echo $data->qrq_check==1?"<font color='green'>发布</font>":"<font color='FF0000'>下线</font>";
                }else{
                    echo $data->qrq_settledate>time()?"<font color='#808080'>未审核</font>":"<font color='#FF0000'>已结束</font>";
                }?>
            </td>
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('qrq_releasedate')); ?>:</b><?php echo date("Y-m-d H:i:s",$data->qrq_releasedate); ?></td>
            <td>
                <b><?php echo CHtml::encode($data->getAttributeLabel('qrq_settledate')); ?>:</b>
                <font style="color:<?=$data->qrq_settledate>time()?"green":"#FF0000";?>"><?php echo date("Y-m-d H:i:s",$data->qrq_settledate); ?></font>
            </td>
        </tr>
        <tr>
            <td colspan="3"><b><?php echo CHtml::encode($data->getAttributeLabel('qrq_require')); ?>:</b><br/><?php echo CHtml::encode($data->qrq_require); ?></td>
        </tr>
    </table>
</div>