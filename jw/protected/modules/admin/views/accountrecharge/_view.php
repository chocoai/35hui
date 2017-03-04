<tr>
    <td><?=date("Y-m-d H:i",$data->arc_rechargetime)?></td>
    <td><?=$data->arc_moneynum?>元</td>
    <td><?=$data->arc_goldnum?></td>
    <td><?=$data->arc_ordernum?></td>
    <td><?=User::model()->getUserNameById($data->arc_userid)?></td>
    <td><?=$data->arc_alipaynum?></td>
</tr>