    <tr>
        <td width="13%"><?php echo $data->meet->mr_salesman; ?></td>
        <td width="37%">
        <?php
            if($data->br_fcid){
                $taocan='RMB'.$data->config->fc_rmbprice."   商务币".$data->config->fc_giveprice."    积分".$data->config->fc_giveprice;
                if($data->config->fc_givepanoramadevice){
                    $taocan.="   全景镜头".$data->config->fc_givepanoramadevice.'枚';
                }
                echo $taocan;
            }else{
                echo $data->br_other;
            }
        ?>
        </td>
        <td width="18%"><?php echo $data->br_amount;?></td>
        <td width="13%"><?php echo $data->br_contractno; ?></td>
        <td><?php echo date("Y-m-d H:i:s",$data->br_time); ?></td>
    </tr>