<tr>
    <td width="6%" class="txt"><input type="checkbox" name="check[<?php echo $data->msg_id?>]"/></td>
    <td width="40%" class="txt" align="left"><?=CHtml::link(CHtml::encode($data->msg_title),array('view','id'=>$data->msg_id));?></td>
    <td class="txt"><?=$data->msg_revid==0?"客服管理员":User::model()->getNamebyid($data->msg_revid);?></td>
    <td class="txt"><?=common::showFormatDateTime($data->msg_time);?></td>
    <td class="txt"><?=CHtml::link("查看",array('view','id'=>$data->msg_id));?> <?=CHtml::link("删除",'#',array('submit'=>array('delete','id'=>$data->msg_id),'confirm'=>'你确定要删除这封站内信?'))?></td>
</tr>