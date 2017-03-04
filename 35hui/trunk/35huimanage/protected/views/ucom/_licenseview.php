<table style="margin: 0px">
    <tr>
        <td width="10%"><?php echo $data->uc_id ?></td>
        <td width="10%"><?php echo $data->uc_uid ?></td>
        <td width="20%"><a href="<?=PIC_URL.$data->uc_recogniseurl; ?>" target="_blank"><img src="<?=Picture::showStandPic(PIC_URL.$data->uc_recogniseurl,"_large");?>" width="99px" height="70px" /></a></td>
        <td width="13%"><?php echo $data->uc_fullname ?></td>
        <td width="13%"><?php echo $data->uc_officetel ?></td>
        <td width="14%"><?php echo $data->uc_tel ?></td>
        <td><a href='javascript:audit(1,<?php echo $data->uc_id ?>)'>通过</a>&nbsp;&nbsp;<a href='javascript:audit(2,<?php echo $data->uc_id; ?>)'>未通过</a></td>
    </tr>
</table>