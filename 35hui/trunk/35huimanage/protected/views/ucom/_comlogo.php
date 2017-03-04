    <tr>
        <td><input type="checkbox" name="userid[]" value="<?php echo $data->uc_id ?>"><?php echo $data->uc_id ?></td>
        <td><?php echo $data->uc_uid ?></td>
        <td><a href="<?=PIC_URL.$data->uc_logo; ?>" target="_blank"><img src="<?=Picture::showStandPic(PIC_URL.$data->uc_logo,"");?>" alt="公司Logo丢失" /></a></td>
        <td><?php echo $data->uc_fullname ?></td>
        <td><?php echo $data->uc_officetel ?></td>
        <td><?php echo $data->uc_tel ?></td>
        <td><a href='javascript:audit(1,<?php echo $data->uc_id ?>)'>通过</a>&nbsp;&nbsp;<a href='javascript:audit(2,<?php echo $data->uc_id; ?>)'>未通过</a></td>
    </tr>