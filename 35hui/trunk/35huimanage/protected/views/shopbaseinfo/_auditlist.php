<table style="margin: 0px">
    <tr>
        <td width="40%"><a href="<?php echo Yii::app()->createUrl('/shopbaseinfo/view',array('action'=>'audit','id'=>$data->sb_shopid)) ?>"><?php echo $data->presentInfo->sp_shoptitle ?></a></td>
        <td width="10%"><?php echo $data->sb_uid ?></td>
        <td width="10%"><?=User::model()->getRealNamebyid($data->sb_uid);?></td>
        <td width="5%"><?=$data->sb_sellorrent==1?"租":"售"; ?></td>
        <td width="20%">
        <?php
           
        ?>
        </td>
        <td><a href="javascript:illegal(<?php echo $data->sb_shopid ?>)">违规</a>&nbsp;<a href="javascript:audit(<?php echo $data->sb_shopid ?>)">审核</a></td>
    </tr>
</table>