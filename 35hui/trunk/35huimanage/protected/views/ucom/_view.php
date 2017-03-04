<table style="margin: 0px" id="ucom_<?php echo $data->uc_id;?>" border="0" width="1400px" bgcolor="<?=$index&1?'#CCCCCC':'#DDDDDD'?>" onclick="selectID(<?php echo $data->uc_id;?>)">
    <tr title="<?php echo '中介：',$data->uc_fullname; ?>">
        <td width="50px"><?php echo $data->uc_id;?></td>
        <td width="50px"><a href="<?php echo Yii::app()->createUrl('/ucom/view',array('id'=>$data->uc_id))?>" target="_blank"><?php echo $data->uc_uid ?></a></td>
        <td width="200px"><?php echo $data->uc_fullname ?></td>
        <td width="100px"><?php echo $data->uc_contact; ?></td>
        <td width="280px"><?php echo $data->uc_address; ?></td>
        <td width="100px">
            <?php
                $str ="";
                $data->uc_recogniseaudit==0?$str="未认证":1;
                $data->uc_recogniseaudit==1?$str="已认证":1;
                $data->uc_recogniseaudit==2?$str="<font color='red'>未通过</font>":1;
                echo $str;
            ?>
        </td>
        <td width="100px"><?php
            $str ="";
            $data->uc_check==0?$str="<a href='javascript:audit(1,".$data->uc_id.")'>通过</a>&nbsp;&nbsp;<a href='javascript:audit(2,".$data->uc_id.")'>未通过</a>":1;
            $data->uc_check==1?$str="已审核":1;
            $data->uc_check==2?$str="<font color='red'>未通过</font>":1;
            echo $str;
            ?>
        </td>
        <td width="100px"><?=round($data->userInfo->user_online*100/3600)/100?>h</td>
        <td width="100px"><?=$data->userInfo->user_loginnum?></td>
        <td width="100px"><?=date('m-d H:i',$data->userInfo->user_lasttime)?></td>
        <td width="110px"><?=$data->userInfo->user_housenum;?></td>
        <td width="110px"><?=$data->userInfo->user_subpnum;?></td>
    </tr>
</table>