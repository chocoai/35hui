    <tr>
        <td width="30%"><?php echo CHtml::encode($data->fr_content); ?></td>
        <td width="12%"><?php echo CHtml::encode($data->fr_salesman); ?></td>
        <td width="20%"><?php echo CHtml::encode($data->fr_reservetime); ?></td>
        <td width="19%"><?php echo CHtml::encode($data->fr_remindtime); ?></td>
        <td><?php echo CHtml::encode(date("Y-m-d H:i:s",$data->fr_followtime)); ?></td>
    </tr>