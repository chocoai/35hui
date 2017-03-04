<table style="margin: 0px">
    <tr>
        <td width="10%"><?php echo $data->ua_id ?></td>
        <td width="10%"><?php echo $data->ua_uid ?></td>
        <td width="30%"><a href="<?=PIC_URL.$data->ua_licenseurl; ?>" target="_blank"><img src="<?=Picture::showStandPic(PIC_URL.$data->ua_licenseurl,"_large");?>" width="99px" height="70px" /></a></td>
        <td width="15%"><?php echo $data->ua_realname ?></td>
        <td width="15%"><?php echo $data->userInfo->user_tel ?></td>
        <td><a href='javascript:audit(1,<?php echo $data->ua_id ?>)'>通过</a>&nbsp;&nbsp;<a href='javascript:audit(2,<?php echo $data->ua_id; ?>)'>未通过</a></td>
    </tr>
</table>