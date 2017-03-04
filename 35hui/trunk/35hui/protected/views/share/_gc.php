<?php
foreach($dataProvider->getData() as $index=>$data){
?>
    <tr>
        <td><?php echo $districts[$data->gc_regionid]?></td>
        <td><?php echo $data->gc_rentsell=='1'?'租':'售'?></td>
        <td><?php echo CHtml::encode($data->gc_buildname)?></td>
        <td><?php echo $data->gc_floor?></td>
        <td><?php echo $this->towards[$data->gc_toward]?></td>
        <td><?php echo $data->gc_area?>平米</td>
        <td><?php echo $data->gc_price?>元</td>
        <td><?php echo User::model()->getUserShowLink($data->gc_userid)?></td>
        <td><?php echo CHtml::encode($data->gc_contact)?></td>
        <td><?php echo date('Y-m-d H:i',$data->gc_timestamp);
        if($self) echo CHtml::link('删除',array('share/delete','tag'=>$tag,'sourceType'=>$sourceType,'id'=>$data->gc_id));
        ?></td>
    </tr>
<?php }
