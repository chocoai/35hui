<tr>
    <td><?=($page-1)*$pageSize+($number+1)?></td>
    <td><?=Region::model()->getNameById($data->cm_district)?></td>
    <td><?=$data->cm_companyname?></td>
    <td><?=$data->cm_address?></td>
    <td>
        <a href="javascript:;" onclick="return confirmDel(<?=$data->cm_id?>)">删除</a>
        <a href="<?=Yii::app()->createUrl("/admin/companymanage/update",array("id"=>$data->cm_id))?>">修改</a>
    </td>
</tr>