    <table widtd="100%" border="1" style="margin:0px;padding: 0px">
        <tr>
            <td width="15%"><?=Productgrid::$p_page[$data->p_page]?></td>
            <td width="15%"><?=Productgrid::$p_position[$data->p_position];?></td>
            <td width="10%">第<?php echo CHtml::encode($data->p_index); ?>格</td>
            <td width="10%"><?=$data->p_baseprice?$data->p_baseprice:"无"?></td>
            <td width="10%"><?=$data->p_nowprice?$data->p_nowprice:"无"?></td>
            <td width="7%"><?=$data->p_raisespercent?$data->p_raisespercent:"无"?></td>
            <td width="7%"><?=$data->p_droppercent?$data->p_droppercent:"无"?></td>
            <td width="13%"><?=$data->p_lastbuytime?date("m-d H:i", $data->p_lastbuytime):"无购买"?></td>
            <td><?=CHtml::link("修改",array("productgrid/update","id"=>$data->p_id))."&nbsp;&nbsp;".CHtml::link("查看",array("productgrid/view","id"=>$data->p_id))?></td>
        </tr>
    </table>