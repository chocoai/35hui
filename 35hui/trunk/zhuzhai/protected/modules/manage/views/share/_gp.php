    <tr>
        <td class="txt"><?php echo $districts[$data->gp_regionid]?></td>
        <td class="txt"><?php echo $data->gp_rentsell=='1'?'租':'售'?></td>
        <td class="txt"><?php echo $data->gp_area?>m<sup>2</sup></td>
        <td class="txt"><?php echo $data->gp_budget?>元</td>
        <td class="txt"><?php echo CHtml::encode($data->gp_buildings)?></td>
        <td class="txt"><?php echo User::model()->getUserShowLink($data->gp_userid)?></td>
        <td class="txt"><?php echo CHtml::encode($data->gp_contact)?></td>
        <td class="txt"><?php echo date('Y-m-d H:i',$data->gp_timestamp);
if($self) echo CHtml::link('删除',array('/manage/share/delete','tag'=>$tag,'sourceType'=>$sourceType,'id'=>$data->gp_id));
        ?></td>
    </tr>