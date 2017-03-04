    <tr>
        <td class="txt"><?php echo @$districts[$data->gc_regionid]?></td>
        <td class="txt"><?php echo $data->gc_rentsell=='1'?'租':'售'?></td>
        <td class="txt"><?php echo CHtml::encode($data->gc_buildname)?></td>
        <td class="txt"><?php echo $data->gc_floor?></td>
        <td class="txt"><?php echo $this->towards[$data->gc_toward]?></td>
        <td class="txt"><?php echo $data->gc_area?>m<sup>2</sup></td>
        <td class="txt"><?php echo $data->gc_price?>元</td>
        <td class="txt"><?php echo User::model()->getUserShowLink($data->gc_userid)?></td>
        <td class="txt"><?php echo CHtml::encode($data->gc_contact)?></td>
        <td class="txt"><?php echo date('Y-m-d H:i',$data->gc_timestamp);
        if($self) echo CHtml::link('删除',array('/manage/share/delete','tag'=>$tag,'sourceType'=>$sourceType,'id'=>$data->gc_id));
        ?></td>
    </tr>
