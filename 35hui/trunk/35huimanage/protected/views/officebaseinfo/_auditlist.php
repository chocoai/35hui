<table style="margin: 0px">
    <tr>
        <td width="40%"><a href="<?php echo Yii::app()->createUrl('/officebaseinfo/view',array('action'=>'audit','id'=>$data->ob_officeid)) ?>"><?php echo $data->presentInfo->op_officetitle ?></a></td>
        <td width="10%"><?php echo $data->ob_uid ?></td>
        <td width="10%"><?=User::model()->getRealNamebyid($data->ob_uid);?></td>
        <td width="5%"><?=$data->ob_sellorrent==1?"租":"售"; ?></td>
        <td width="20%">
        <?php
            
        ?>
        </td>
        <td><a href="javascript:illegal(<?php echo $data->ob_officeid ?>)">违规</a>&nbsp;<a href="javascript:audit(<?php echo $data->ob_officeid ?>)">审核</a></td>
    </tr>
</table>