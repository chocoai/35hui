<?php
foreach($dataProvider->getData() as $index=>$data){
?>
    <tr>
        <td><?php echo $districts[$data->gp_regionid]?></td>
        <td><?php echo $data->gp_rentsell=='1'?'租':'售'?></td>
        <td><?php echo $data->gp_area?>平米</td>
        <td><?php echo $data->gp_budget?>元</td>
        <td><?php echo CHtml::encode($data->gp_buildings)?></td>
        <td><?php echo User::model()->getUserShowLink($data->gp_userid)?></td>
        <td><?php echo CHtml::encode($data->gp_contact)?></td>
        <td><?php echo date('Y-m-d H:i',$data->gp_timestamp);
if($self) echo CHtml::link('删除',array('share/delete','tag'=>$tag,'sourceType'=>$sourceType,'id'=>$data->gp_id));
        ?></td>
    </tr>
<?php }