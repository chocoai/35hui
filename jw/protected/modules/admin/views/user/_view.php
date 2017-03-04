<tr>
    <td><?=$data->u_id?></td>
    <td><?=$data->u_nickname?></td>
    <td><?=$data->u_email?></td>
    <td><?=User::$authRolesName[$data->u_role]?></td>
    <td><?=date("Y-m-d H:i",$data->u_regtime)?></td>
</tr>