<tr>
    <td><?=date("Y-m-d H:i",$data->cl_recodetime)?></td>
    <td><?=($data->cl_gainorlose==Consumelog::GAIN?"+":"-").$data->cl_goldnum?></td>
    <td><?=$data->cl_description?></td>
</tr>