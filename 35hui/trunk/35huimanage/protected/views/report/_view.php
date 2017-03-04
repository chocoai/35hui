<table width="100%">
    <tr>
        <td width="5%">
            <?php echo CHtml::link(CHtml::encode($data->r_id), array('view', 'id'=>$data->r_id)); ?>
        </td>
        <td width="10%">
            <?php echo CHtml::encode(User::model()->getRealNamebyid($data->r_sinfuluserid)); ?>
        </td>
        <td width="10%">
            <?=Report::model()->getHouseLink($data->r_sinfulbuildid,$data->r_buildtype); ?>
        </td>
        <td width="20%">
  
            <?php echo CHtml::encode(Report::$reportmeg[$data->r_type]); ?>
        </td>
        <td width="10%">
            <?php echo CHtml::encode(Report::$buildtype[$data->r_buildtype]); ?>
        </td>
        <td width="10%">
            <?php echo $data->r_informantuserid?CHtml::encode(User::model()->getRealNamebyid($data->r_informantuserid)):"无"; ?>
        </td>
        <td width="10%">
            <?php echo CHtml::encode($data->r_informantusername); ?>
        </td>
        <td>
            <?php echo date('Y-m-d H:i',$data->r_date); ?>
        </td>
        <td width="10%">
            <?php
                if($data->r_state==0){
            ?>
            <a href="javascript:illegal(<?php echo $data->r_id; ?>)">确定违规</a>

            &nbsp;<a href="javascript:report_illegal(<?php echo $data->r_id; ?>)">不违规</a>
            <?php
                }else{
                    echo "已受理";
                }
            ?>
        </td>
    </tr>
</table>