<div class="view">
    <table>
        <tr>
            <td width="70%">
                <b><?php echo CHtml::encode($data->getAttributeLabel('np_id')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->np_id), array('view', 'id'=>$data->np_id)); ?>
                <br />

                <b><?php echo CHtml::encode($data->getAttributeLabel('np_title')); ?>:</b>
                <?php echo CHtml::encode($data->np_title); ?>
                <br />
                
                <b><?php echo CHtml::encode($data->getAttributeLabel('np_linkurl')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->np_linkurl),$data->np_linkurl,array("target"=>"_blank")); ?>
                <br />

                <b><?php echo CHtml::encode($data->getAttributeLabel('np_type')); ?>:</b>
                <?php echo CHtml::encode($data->np_type); ?>
                <br />
                
                <b><?php echo CHtml::encode($data->getAttributeLabel('np_order')); ?>:</b>
                <?php echo CHtml::encode($data->np_order); ?>
                <br />
            </td>
            <td>
                <?php echo CHtml::link(CHtml::image(PIC_URL.$data->np_picurl,'',array("width"=>"138px","height"=>"80px")),array('view', 'id'=>$data->np_id)); ?>
            </td>
        </tr>
    </table>

</div>