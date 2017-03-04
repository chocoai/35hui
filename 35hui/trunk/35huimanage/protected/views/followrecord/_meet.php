    <tr>
        <td width="13%"><?php echo CHtml::encode($data->follow->fr_salesman); ?></td>
        <td width="18%"><?php echo CHtml::encode($data->contact->cr_realname); ?></td>
        <td width="37%"><?php echo CHtml::encode($data->mr_remark); ?></td>
        <td width="13%"><?php echo CHtml::encode($data->mr_salesman); ?></td>
        <td><?php echo CHtml::encode(date("Y-m-d H:i:s",$data->mr_time)); ?></td>
    </tr>