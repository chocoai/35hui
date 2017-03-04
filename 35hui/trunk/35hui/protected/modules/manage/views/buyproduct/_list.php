<tr>
    <td class="txt"><?=Productgrid::model()->getPageName($data->productgrid->p_page)?></td>
    <td class="txt"><?=Productgrid::model()->getPositionName($data->productgrid->p_position)?></td>
    <td class="txt"><?=$data->sp_buyprice?>&nbsp;点/天</td>
    <td class="txt"><?=$data->sp_buydays?>&nbsp;天</td>
    <td class="txt"><?=date("Y-m-d H:i", $data->sp_buytime)?></td>
    <td class="txt"><?=$data->sp_cannotusetime?date("Y-m-d H:i", $data->sp_cannotusetime):"正在使用"?></td>
    <td class="txt"><?=$data->sp_returnprice?$data->sp_returnprice."&nbsp;点":"&nbsp;"?></td>
</tr>