    <tr>
        <td><input type="checkbox" name="userid[]" value="<?php echo $data->puser_id ?>"><?php echo $data->puser_id ?></td>
        <td><?php echo $data->puser_uid ?></td>
        <td><a href="<?=PIC_URL.$data->puser_logopath; ?>" target="_blank"><img src="<?=Picture::showStandPic(PIC_URL.$data->puser_logopath,"");?>" alt="用户图像丢失" /></a></td>
        <td><a href='javascript:audit(1,<?php echo $data->puser_id ?>)'>通过</a>&nbsp;&nbsp;<a href='javascript:audit(2,<?php echo $data->puser_id; ?>)'>未通过</a></td>
    </tr>