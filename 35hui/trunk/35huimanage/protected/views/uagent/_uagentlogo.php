    <tr>
        <td><input type="checkbox" name="userid[]" value="<?php echo $data->ua_id ?>"><?php echo $data->ua_id ?></td>
        <td><?php echo $data->ua_uid ?></td>
        <td><?=CHtml::image(User::model()->getUserHeadPic($data->ua_uid),"",array("width"=>"100px","height"=>"130px"))?></td>
        <td><?php echo $data->ua_realname ?></td>
        <td><?php echo $data->userInfo->user_tel ?></td>
        <td><a href='javascript:audit(1,<?php echo $data->ua_id ?>)'>通过</a>&nbsp;&nbsp;<a href='javascript:audit(2,<?php echo $data->ua_id; ?>)'>未通过</a></td>
    </tr>