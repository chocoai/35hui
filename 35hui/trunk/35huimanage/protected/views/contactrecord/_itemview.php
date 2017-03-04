<table style="margin: 0px">
<tr>
        <td width="7%"><?php echo CHtml::link(CHtml::encode($data->cr_id), array('view', 'id'=>$data->cr_id)); ?></td>
        <td width="10%"><?php echo CHtml::link(CHtml::encode($data->cr_realname), array('view', 'id'=>$data->cr_id)); ?></td>
        <td width="23%"><?php echo $data->cr_company;?></td>
        <td width="11%"><?php echo $data->cr_type ? '是':'否'; ?></td>
        <td width="13%"><?php echo $data->cr_salesman; ?></td>
        <td width="13%"><?php echo $data->cr_mobile; ?></td>
        <td width="11%"><?php echo $data->cr_grade?Contactrecord::$cr_grade[$data->cr_grade]:'未知'?></td>
        <td><?php echo date("Y-m-d",$data->cr_time);?></td>
    </tr>
</table>