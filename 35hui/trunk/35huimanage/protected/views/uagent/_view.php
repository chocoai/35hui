<table style="margin: 0px" id="uagent_<?php echo $data->ua_id;?>" border="0" width="1320px" bgcolor="<?=$index&1?'#CCCCCC':'#DDDDDD'?>" onclick="selectID(<?php echo $data->ua_id;?>)">
    <tr title="<?php echo '用户：',$data->ua_realname; ?>">
        <td width="50px"><?php echo $data->ua_id; ?></td>
        <td width="50px"><a href="<?php echo Yii::app()->createUrl('/uagent/view',array('id'=>$data->ua_id))?>" target="_blank"><?php echo $data->ua_uid ?></a></td>
        <td width="110px"><?php echo User::model()->getUserName($data->ua_uid); ?></td>
        <td width="100px"><?php echo $data->ua_realname ?></td>
        <td width="110px"><?php echo $data->ua_company ?></td>
        <td width="100px">
            <?php
                $str ="";
                $data->ua_scardaudit==0?$str="未认证":1;
                $data->ua_scardaudit==1?$str="已认证":1;
                $data->ua_scardaudit==2?$str="<font color='red'>未通过</font>":1;
                echo $str;
            ?>
        </td>
        <td width="100px">
            <?php
                $str ="";
                $data->ua_bcardaudit==0?$str="未认证":1;
                $data->ua_bcardaudit==1?$str="已认证":1;
                $data->ua_bcardaudit==2?$str="<font color='red'>未通过</font>":1;
                echo $str;
            ?>
        </td>
        <td width="100px">
            <?php
                $str ="";
                $data->ua_licenseaudit==0?$str="未认证":1;
                $data->ua_licenseaudit==1?$str="已认证":1;
                $data->ua_licenseaudit==2?$str="<font color='red'>未通过</font>":1;
                echo $str;
            ?>
        </td>
        <td width="100px"><?php
            $str ="";
            $data->ua_check==0?$str="<a href='javascript:audit(1,".$data->ua_id.")'>通过</a>&nbsp;&nbsp;<a href='javascript:audit(2,".$data->ua_id.")'>未通过</a>":1;
            $data->ua_check==1?$str="已审核":1;
            $data->ua_check==2?$str="<font color='red'>未通过</font>":1;
            echo $str;
            ?>
        </td>
        <td width="100px"><?=date("Y-m-d",$data->userInfo->user_regtime)?></td>
        <td width="100px"><?=round($data->userInfo->user_online*100/3600)/100?>h</td>
        <td width="100px"><?=$data->userInfo->user_loginnum?></td>
        <td width="100px"><?=date('m-d H:i',$data->userInfo->user_lasttime)?></td>
        <td width="120px"><?=$data->userInfo->user_housenum;?></td>
        <td width="120px"><?=$data->userInfo->user_subpnum;?></td>
    </tr>
</table>