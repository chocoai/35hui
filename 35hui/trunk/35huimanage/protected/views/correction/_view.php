<div class="view">
    <table width="100%" style="margin-bottom: 0px;">
        <tr>
            <td width="5%"><?php echo CHtml::link(CHtml::encode($data->ct_id), array('view', 'id'=>$data->ct_id)); ?></td>
            <td><?php echo Correction::model()->getName($data->ct_sourceId, $data->ct_sourcetype); ?></td>
            <td width="10%"><?php echo CHtml::encode(Correction::$ct_sourcetype[$data->ct_sourcetype]); ?></td>
            <td width="10%"><?php echo CHtml::encode(User::model()->getRealNamebyid($data->ct_userid)); ?></td>
            <td width="15%"><?php echo CHtml::encode(date("m-d H:i",$data->ct_releasetime)); ?></td>
            <td width="10%"><?php echo CHtml::link(CHtml::encode("审核"), array('view', 'id'=>$data->ct_id)); ?></td>
        </tr>
    </table>
</div>
    