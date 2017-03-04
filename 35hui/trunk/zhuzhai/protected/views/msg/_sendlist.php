<table style="width: 100%" border="0">
    <tr>
        <td width="15%"><?=$data->msg_revid==0?"客服管理员":CHtml::encode(User::model()->getNamebyid($data->msg_revid));?></td>
        <td ><?=CHtml::link(CHtml::encode($data->msg_title),array('view','id'=>$data->msg_id,'menu'=>$this->temp));?></td>
        <td width="20%"><?=common::showFormatDateTime($data->msg_time); ?></td>
        <td width="10%"><?=CHtml::link("删除",'#',array('submit'=>array('delete','id'=>$data->msg_id),'confirm'=>'你确定要删除这封站内信?'))?></td>
    </tr>
</table>